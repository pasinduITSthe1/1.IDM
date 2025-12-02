<?php
/**
 * Guest Status API Endpoint
 * Get guest check-in/check-out status from hotel database
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
 * GET /hotel-backend/api/guest-status.php?customer_id=X
 * Get guest current status (checked_in, checked_out, pending)
 */
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['customer_id'])) {
    $customer_id = intval($_GET['customer_id']);
    
    // First check if guest has checked out
    $checkoutSql = "SELECT * FROM guest_checkouts 
                    WHERE id_customer = $customer_id 
                    ORDER BY created_at DESC LIMIT 1";
    $checkoutResult = $conn->query($checkoutSql);
    
    if ($checkoutResult->num_rows > 0) {
        $checkout = $checkoutResult->fetch_assoc();
        echo json_encode([
            'success' => true,
            'customer_id' => $customer_id,
            'status' => 'checked_out',
            'checkout_id' => $checkout['id'],
            'check_out_time' => $checkout['check_out_time'],
            'final_bill' => $checkout['final_bill'],
            'payment_status' => $checkout['payment_status']
        ]);
        exit();
    }
    
    // Check if guest is currently checked in
    $checkinSql = "SELECT gc.*, r.room_num as current_room_number
                   FROM guest_checkins gc
                   LEFT JOIN qlo_htl_room_information r ON gc.id_room = r.id
                   WHERE gc.id_customer = $customer_id 
                   AND NOT EXISTS (SELECT 1 FROM guest_checkouts WHERE id_checkin = gc.id)
                   ORDER BY gc.created_at DESC LIMIT 1";
    $checkinResult = $conn->query($checkinSql);
    
    if ($checkinResult->num_rows > 0) {
        $checkin = $checkinResult->fetch_assoc();
        // Use current_room_number from JOIN if available, fallback to stored room_number
        $roomNumber = $checkin['current_room_number'] ?? $checkin['room_number'];
        
        echo json_encode([
            'success' => true,
            'customer_id' => $customer_id,
            'status' => 'checked_in',
            'checkin_id' => $checkin['id'],
            'room_number' => $roomNumber,
            'check_in_time' => $checkin['check_in_time'],
            'id_room' => $checkin['id_room']
        ]);
        exit();
    }
    
    // Guest is pending (no check-in record)
    echo json_encode([
        'success' => true,
        'customer_id' => $customer_id,
        'status' => 'pending'
    ]);
}

/**
 * GET /hotel-backend/api/guest-status.php (all guests with status)
 * Get all guests and their current status
 */
else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Get all customers from QloApps
    $customersSql = "SELECT id_customer, firstname, lastname, email 
                     FROM " . _DB_PREFIX_ . "customer 
                     WHERE deleted = 0 
                     ORDER BY id_customer DESC";
    $customersResult = $conn->query($customersSql);
    
    $guests = [];
    
    while ($customer = $customersResult->fetch_assoc()) {
        $customer_id = $customer['id_customer'];
        $status = 'pending';
        $details = [];
        
        // Check for checkout
        $checkoutSql = "SELECT * FROM guest_checkouts 
                        WHERE id_customer = $customer_id 
                        ORDER BY created_at DESC LIMIT 1";
        $checkoutResult = $conn->query($checkoutSql);
        
        if ($checkoutResult->num_rows > 0) {
            $checkout = $checkoutResult->fetch_assoc();
            $status = 'checked_out';
            $details = [
                'checkout_id' => $checkout['id'],
                'check_out_time' => $checkout['check_out_time'],
                'final_bill' => $checkout['final_bill']
            ];
        } else {
            // Check for check-in (with room number from JOIN)
            $checkinSql = "SELECT gc.*, r.room_num as current_room_number
                          FROM guest_checkins gc
                          LEFT JOIN qlo_htl_room_information r ON gc.id_room = r.id
                          WHERE gc.id_customer = $customer_id 
                          AND NOT EXISTS (SELECT 1 FROM guest_checkouts WHERE id_checkin = gc.id)
                          ORDER BY gc.created_at DESC LIMIT 1";
            $checkinResult = $conn->query($checkinSql);
            
            if ($checkinResult->num_rows > 0) {
                $checkin = $checkinResult->fetch_assoc();
                // Use current_room_number from JOIN if available, fallback to stored room_number
                $roomNumber = $checkin['current_room_number'] ?? $checkin['room_number'];
                
                $status = 'checked_in';
                $details = [
                    'checkin_id' => $checkin['id'],
                    'room_number' => $roomNumber,
                    'check_in_time' => $checkin['check_in_time'],
                    'id_room' => $checkin['id_room']
                ];
            }
        }
        
        $guests[] = [
            'customer_id' => $customer_id,
            'id_customer' => $customer_id, // Keep backward compatibility
            'firstname' => $customer['firstname'],
            'lastname' => $customer['lastname'],
            'email' => $customer['email'],
            'status' => $status,
            'details' => $details
        ];
    }
    
    echo json_encode([
        'success' => true,
        'count' => count($guests),
        'guests' => $guests
    ]);
}

else {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
}

$conn->close();
