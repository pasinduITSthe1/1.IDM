<?php
/**
 * Dashboard Statistics API
 * Get real-time stats from hotel database
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
 * GET /hotel-backend/api/dashboard-stats.php
 * Get real-time dashboard statistics
 */
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    
    // Total guests (customers)
    $totalGuestsSql = "SELECT COUNT(*) as count FROM " . _DB_PREFIX_ . "customer WHERE deleted = 0";
    $totalGuestsResult = $conn->query($totalGuestsSql);
    $totalGuests = $totalGuestsResult->fetch_assoc()['count'];
    
    // Currently checked in guests
    $checkedInSql = "SELECT COUNT(DISTINCT ci.id_customer) as count 
                     FROM guest_checkins ci
                     LEFT JOIN guest_checkouts co ON ci.id_customer = co.id_customer 
                        AND co.created_at > ci.created_at
                     WHERE co.id IS NULL";
    $checkedInResult = $conn->query($checkedInSql);
    $checkedIn = $checkedInResult->fetch_assoc()['count'];
    
    // Checked out guests (total)
    $checkedOutSql = "SELECT COUNT(DISTINCT id_customer) as count FROM guest_checkouts";
    $checkedOutResult = $conn->query($checkedOutSql);
    $checkedOut = $checkedOutResult->fetch_assoc()['count'];
    
    // Pending guests (not checked in yet)
    $pending = $totalGuests - $checkedIn;
    
    // Today's check-ins
    $todayCheckinsSql = "SELECT COUNT(*) as count FROM guest_checkins 
                         WHERE DATE(check_in_time) = CURDATE()";
    $todayCheckinsResult = $conn->query($todayCheckinsSql);
    $todayCheckins = $todayCheckinsResult->fetch_assoc()['count'];
    
    // Today's check-outs
    $todayCheckoutsSql = "SELECT COUNT(*) as count FROM guest_checkouts 
                          WHERE DATE(check_out_time) = CURDATE()";
    $todayCheckoutsResult = $conn->query($todayCheckoutsSql);
    $todayCheckouts = $todayCheckoutsResult->fetch_assoc()['count'];
    
    // Total revenue (from checkouts)
    $revenueSql = "SELECT COALESCE(SUM(final_bill), 0) as revenue FROM guest_checkouts";
    $revenueResult = $conn->query($revenueSql);
    $totalRevenue = $revenueResult->fetch_assoc()['revenue'];
    
    // Today's revenue
    $todayRevenueSql = "SELECT COALESCE(SUM(final_bill), 0) as revenue FROM guest_checkouts 
                        WHERE DATE(check_out_time) = CURDATE()";
    $todayRevenueResult = $conn->query($todayRevenueSql);
    $todayRevenue = $todayRevenueResult->fetch_assoc()['revenue'];
    
    echo json_encode([
        'success' => true,
        'stats' => [
            'total_guests' => (int)$totalGuests,
            'checked_in' => (int)$checkedIn,
            'checked_out' => (int)$checkedOut,
            'pending' => (int)$pending,
            'today_checkins' => (int)$todayCheckins,
            'today_checkouts' => (int)$todayCheckouts,
            'total_revenue' => (float)$totalRevenue,
            'today_revenue' => (float)$todayRevenue
        ],
        'timestamp' => date('Y-m-d H:i:s')
    ]);
}

else {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
}

$conn->close();
