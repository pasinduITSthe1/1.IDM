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
    // Database connection
    $host = 'localhost';
    $dbname = '1.idm_db';
    $username = 'root';
    $password = '';
    
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Create notifications table if it doesn't exist
    $createTableSQL = "CREATE TABLE IF NOT EXISTS notifications (
        id INT AUTO_INCREMENT PRIMARY KEY,
        type VARCHAR(50) NOT NULL DEFAULT 'general',
        title VARCHAR(255) NOT NULL,
        message TEXT NOT NULL,
        timestamp DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
        is_read TINYINT(1) NOT NULL DEFAULT 0,
        metadata JSON,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        INDEX idx_timestamp (timestamp),
        INDEX idx_is_read (is_read)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
    
    $pdo->exec($createTableSQL);
    
    // Get notifications ordered by timestamp (newest first)
    $stmt = $pdo->prepare("
        SELECT 
            id,
            type,
            title,
            message,
            timestamp,
            is_read,
            metadata
        FROM notifications
        ORDER BY timestamp DESC
        LIMIT 100
    ");
    
    $stmt->execute();
    $notifications = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Format the response
    $formattedNotifications = [];
    foreach ($notifications as $notification) {
        $formattedNotifications[] = [
            'id' => (string)$notification['id'],
            'type' => $notification['type'],
            'title' => $notification['title'],
            'message' => $notification['message'],
            'timestamp' => $notification['timestamp'],
            'is_read' => (int)$notification['is_read'],
            'metadata' => $notification['metadata'] ? json_decode($notification['metadata'], true) : null
        ];
    }
    
    echo json_encode([
        'success' => true,
        'notifications' => $formattedNotifications,
        'count' => count($formattedNotifications)
    ]);
    
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Database error: ' . $e->getMessage()
    ]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Server error: ' . $e->getMessage()
    ]);
}
