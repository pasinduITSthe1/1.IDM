<?php
// Debug notifications for Flutter app
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

try {
    $host = 'localhost';
    $dbname = '1.idm_db';
    $username = 'root';
    $password = '';
    
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Get all notifications with detailed info
    $stmt = $pdo->query("
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
    ");
    
    $notifications = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Parse metadata JSON
        $metadata = null;
        if ($row['metadata']) {
            $metadata = json_decode($row['metadata'], true);
        }
        
        $notifications[] = [
            'id' => (string)$row['id'],
            'type' => $row['type'],
            'title' => $row['title'],
            'message' => $row['message'],
            'timestamp' => $row['timestamp'],
            'is_read' => (int)$row['is_read'],
            'metadata' => $metadata
        ];
    }
    
    // Group by type for analysis
    $byType = [];
    foreach ($notifications as $notif) {
        $type = $notif['type'];
        if (!isset($byType[$type])) {
            $byType[$type] = [];
        }
        $byType[$type][] = $notif;
    }
    
    echo json_encode([
        'success' => true,
        'notifications' => $notifications,
        'count' => count($notifications),
        'debug_info' => [
            'total_notifications' => count($notifications),
            'by_type' => array_map('count', $byType),
            'types_found' => array_keys($byType),
            'registration_count' => count($byType['registration'] ?? []),
            'checkin_count' => count($byType['checkin'] ?? []),
            'checkout_count' => count($byType['checkout'] ?? []),
            'latest_registration' => isset($byType['registration']) ? $byType['registration'][0] : null
        ]
    ], JSON_PRETTY_PRINT);
    
} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'error' => 'Database error: ' . $e->getMessage()
    ]);
}
?>