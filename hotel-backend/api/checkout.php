<?php
/**
 * Hotel Check-out API Endpoint
 * Direct database access for guest check-outs
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
 * POST /hotel-backend/api/checkout.php
 * Record guest check-out
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    
    if (!$data || !isset($data['id_customer'], $data['id_checkin'])) {
        http_response_code(400);
        echo json_encode([
            'error' => 'Missing required fields: id_customer, id_checkin'
        ]);
        exit();
    }

    $id_customer = intval($data['id_customer']);
    $id_checkin = intval($data['id_checkin']);
    $id_room = intval($data['id_room'] ?? 0);
    $check_out_time = $data['check_out_time'] ?? date('Y-m-d H:i:s');
    $check_out_method = $conn->real_escape_string($data['check_out_method'] ?? 'app');
    $checked_out_by = $conn->real_escape_string($data['checked_out_by'] ?? 'app_user');
    $final_bill = floatval($data['final_bill'] ?? 0);
    $payment_status = $conn->real_escape_string($data['payment_status'] ?? 'pending');
    $notes = $conn->real_escape_string($data['notes'] ?? '');

    // Insert into guest_checkouts table
    $sql = "INSERT INTO guest_checkouts (
        id_customer, id_checkin, id_room,
        check_out_time, check_out_method, checked_out_by,
        final_bill, payment_status, notes, created_at
    ) VALUES (
        $id_customer, $id_checkin, $id_room,
        '$check_out_time', '$check_out_method', '$checked_out_by',
        $final_bill, '$payment_status', '$notes', NOW()
    )";

    if ($conn->query($sql) === TRUE) {
        $checkout_id = $conn->insert_id;
        
        // ✅ UPDATE ROOM STATUS TO CLEANING (id_status = 3) after checkout
        if ($id_room > 0) {
            $updateRoomSql = "UPDATE " . _DB_PREFIX_ . "htl_room_information 
                              SET id_status = 3, date_upd = NOW() 
                              WHERE id = $id_room";
            if (!$conn->query($updateRoomSql)) {
                error_log("Failed to update room status: " . $conn->error);
            }
        }
        
        // Update check-in record status
        $updateCheckin = "UPDATE guest_checkins SET status = 'checked_out' WHERE id = $id_checkin";
        $conn->query($updateCheckin);
        
        // Update customer note
        $note = "Checked out: " . date('Y-m-d H:i:s') . " - Bill: \$$final_bill";
        $updateCustomer = "UPDATE " . _DB_PREFIX_ . "customer SET note = '$note' WHERE id_customer = $id_customer";
        $conn->query($updateCustomer);

        // Get guest name and room number for notification
        $guestSql = "SELECT 
                        CONCAT(c.firstname, ' ', c.lastname) as full_name,
                        gc.room_number 
                     FROM " . _DB_PREFIX_ . "customer c 
                     LEFT JOIN guest_checkins gc ON gc.id_customer = c.id_customer 
                     WHERE c.id_customer = $id_customer AND gc.id = $id_checkin";
        $guestResult = $conn->query($guestSql);
        
        if ($guestResult->num_rows > 0) {
            $guest = $guestResult->fetch_assoc();
            $guestName = $guest['full_name'] ?: 'Guest';
            $roomNumber = $guest['room_number'] ?: 'Unknown';
            
            // Create check-out notification
            include_once '../../custom-api/create-notification.php';
            
            // Create PDO connection for notification helper
            $pdo = new PDO("mysql:host=" . _DB_SERVER_ . ";dbname=" . _DB_NAME_ . ";charset=utf8", _DB_USER_, _DB_PASSWD_);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            createCheckOutNotification($pdo, $guestName, $roomNumber, $id_customer);
        }

        http_response_code(201);
        echo json_encode([
            'success' => true,
            'message' => 'Guest checked out successfully',
            'checkout_id' => $checkout_id,
            'final_bill' => $final_bill,
            'payment_status' => $payment_status
        ]);
    } else {
        http_response_code(500);
        echo json_encode([
            'error' => 'Failed to insert check-out record',
            'details' => $conn->error
        ]);
    }
}

/**
 * GET /hotel-backend/api/checkout.php?customer_id=X
 * Get guest check-out record
 */
else if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['customer_id'])) {
    $customer_id = intval($_GET['customer_id']);
    
    $sql = "SELECT * FROM guest_checkouts WHERE id_customer = $customer_id ORDER BY created_at DESC LIMIT 1";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $checkout = $result->fetch_assoc();
        echo json_encode([
            'success' => true,
            'checkout' => $checkout
        ]);
    } else {
        http_response_code(404);
        echo json_encode([
            'error' => 'No check-out record found',
            'customer_id' => $customer_id
        ]);
    }
}

/**
 * GET /hotel-backend/api/checkout.php (all check-outs)
 */
else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT co.*, cust.firstname, cust.lastname 
            FROM guest_checkouts co
            LEFT JOIN " . _DB_PREFIX_ . "customer cust ON co.id_customer = cust.id_customer
            ORDER BY co.created_at DESC";
    
    $result = $conn->query($sql);
    $checkouts = [];
    
    while ($row = $result->fetch_assoc()) {
        $checkouts[] = $row;
    }
    
    echo json_encode([
        'success' => true,
        'count' => count($checkouts),
        'checkouts' => $checkouts
    ]);
}

else {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
}

$conn->close();
