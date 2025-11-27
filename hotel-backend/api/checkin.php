<?php
/**
 * Hotel Check-in API Endpoint
 * Direct database access for guest check-ins
 */

// Enable CORS for Flutter app
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Content-Type: application/json');

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Database configuration
define('_DB_SERVER_', 'localhost');
define('_DB_NAME_', '1.IDM_db');
define('_DB_USER_', 'root');
define('_DB_PASSWD_', '');
define('_DB_PREFIX_', 'qlo_');

// Connect to database
$conn = new mysqli(_DB_SERVER_, _DB_USER_, _DB_PASSWD_, _DB_NAME_);
if ($conn->connect_error) {
    http_response_code(500);
    die(json_encode(['error' => 'Database connection failed']));
}

/**
 * POST /hotel-backend/api/checkin.php
 * Record guest check-in
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    
    if (!$data || !isset($data['id_customer'], $data['id_booking'], $data['id_room'])) {
        http_response_code(400);
        echo json_encode([
            'error' => 'Missing required fields: id_customer, id_booking, id_room'
        ]);
        exit();
    }

    $id_customer = intval($data['id_customer']);
    $id_booking = intval($data['id_booking']);
    $id_room = intval($data['id_room']);
    $room_number = $conn->real_escape_string($data['room_number'] ?? '');
    $check_in_time = $data['check_in_time'] ?? date('Y-m-d H:i:s');
    $check_in_method = $conn->real_escape_string($data['check_in_method'] ?? 'app');
    $checked_in_by = $conn->real_escape_string($data['checked_in_by'] ?? 'app_user');
    $notes = $conn->real_escape_string($data['notes'] ?? '');
    
    // Debug logging
    error_log("Check-in request: customer=$id_customer, room_id=$id_room, room_number=$room_number");

    // Insert into guest_checkins table
    $sql = "INSERT INTO guest_checkins (
        id_customer, id_booking, id_room, room_number, 
        check_in_time, check_in_method, checked_in_by, notes, 
        created_at
    ) VALUES (
        $id_customer, $id_booking, $id_room, '$room_number',
        '$check_in_time', '$check_in_method', '$checked_in_by', '$notes',
        NOW()
    )";

    if ($conn->query($sql) === TRUE) {
        $checkin_id = $conn->insert_id;
        
        // ✅ UPDATE ROOM STATUS TO OCCUPIED (id_status = 2)
        if ($id_room > 0) {
            $updateRoomSql = "UPDATE " . _DB_PREFIX_ . "htl_room_information 
                              SET id_status = 2, date_upd = NOW() 
                              WHERE id = $id_room";
            $updateResult = $conn->query($updateRoomSql);
            
            if ($updateResult) {
                $affectedRows = $conn->affected_rows;
                error_log("✅ Room status update SUCCESS - Room ID: $id_room, Rows affected: $affectedRows");
            } else {
                error_log("❌ Room status update FAILED - Room ID: $id_room, Error: " . $conn->error);
            }
        } else {
            error_log("⚠️ Room ID is 0 or invalid: $id_room");
        }
        
        // Also update customer note field
        $note = "Checked in: " . date('Y-m-d H:i:s') . " - Room: $room_number";
        $updateSql = "UPDATE " . _DB_PREFIX_ . "customer SET note = '$note' WHERE id_customer = $id_customer";
        $conn->query($updateSql);

        // Get guest name for notification
        $guestSql = "SELECT CONCAT(firstname, ' ', lastname) as full_name FROM " . _DB_PREFIX_ . "customer WHERE id_customer = $id_customer";
        $guestResult = $conn->query($guestSql);
        $guestName = $guestResult->num_rows > 0 ? $guestResult->fetch_assoc()['full_name'] : 'Guest';
        
        // Create check-in notification
        include_once '../../custom-api/create-notification.php';
        
        // Create PDO connection for notification helper
        $pdo = new PDO("mysql:host=" . _DB_SERVER_ . ";dbname=" . _DB_NAME_ . ";charset=utf8", _DB_USER_, _DB_PASSWD_);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        createCheckInNotification($pdo, $guestName, $room_number, $id_customer);

        http_response_code(201);
        echo json_encode([
            'success' => true,
            'message' => 'Guest checked in successfully',
            'checkin_id' => $checkin_id,
            'room_id' => $id_room,
            'room_number' => $room_number,
            'check_in_time' => $check_in_time
        ]);
    } else {
        http_response_code(500);
        echo json_encode([
            'error' => 'Failed to insert check-in record',
            'details' => $conn->error
        ]);
    }
}

/**
 * GET /hotel-backend/api/checkin.php?customer_id=X
 * Get guest check-in status
 */
else if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['customer_id'])) {
    $customer_id = intval($_GET['customer_id']);
    
    $sql = "SELECT * FROM guest_checkins WHERE id_customer = $customer_id ORDER BY created_at DESC LIMIT 1";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $checkin = $result->fetch_assoc();
        echo json_encode([
            'success' => true,
            'checkin' => $checkin
        ]);
    } else {
        http_response_code(404);
        echo json_encode([
            'error' => 'No check-in record found',
            'customer_id' => $customer_id
        ]);
    }
}

/**
 * GET /hotel-backend/api/checkin.php (all check-ins)
 */
else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT 
                c.*,
                COALESCE(cust.firstname, '') as firstname,
                COALESCE(cust.lastname, '') as lastname,
                CONCAT(COALESCE(cust.firstname, ''), ' ', COALESCE(cust.lastname, '')) as full_name
            FROM guest_checkins c
            LEFT JOIN " . _DB_PREFIX_ . "customer cust ON c.id_customer = cust.id_customer
            ORDER BY c.created_at DESC";
    
    $result = $conn->query($sql);
    $checkins = [];
    
    while ($row = $result->fetch_assoc()) {
        $checkins[] = $row;
    }
    
    echo json_encode([
        'success' => true,
        'count' => count($checkins),
        'checkins' => $checkins
    ]);
}

else {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
}

$conn->close();
