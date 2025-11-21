<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

try {
    // Get JSON input
    $input = json_decode(file_get_contents('php://input'), true);
    
    if (!isset($input['notification_id'])) {
        throw new Exception('Notification ID is required');
    }
    
    $notificationId = $input['notification_id'];
    
    // Database connection
    $host = 'localhost';
    $dbname = '1.idm_db';
    $username = 'root';
    $password = '';
    
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Update notification as read
    $stmt = $pdo->prepare("UPDATE notifications SET is_read = 1 WHERE id = :id");
    $stmt->execute(['id' => $notificationId]);
    
    if ($stmt->rowCount() > 0) {
        echo json_encode([
            'success' => true,
            'message' => 'Notification marked as read'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Notification not found'
        ]);
    }
    
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Database error: ' . $e->getMessage()
    ]);
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
