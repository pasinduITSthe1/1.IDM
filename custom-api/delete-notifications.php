<?php
// Delete all notifications from the database
header('Content-Type: application/json');

try {
    $host = 'localhost';
    $dbname = '1.idm_db';
    $username = 'root';
    $password = '';
    
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Count notifications before deletion
    $countStmt = $pdo->query("SELECT COUNT(*) as count FROM notifications");
    $count = $countStmt->fetch(PDO::FETCH_ASSOC)['count'];
    
    // Delete all notifications
    $deleteStmt = $pdo->prepare("DELETE FROM notifications");
    $deleteStmt->execute();
    
    // Reset auto increment to start from 1
    $pdo->exec("ALTER TABLE notifications AUTO_INCREMENT = 1");
    
    echo json_encode([
        'success' => true,
        'message' => 'All notifications deleted successfully',
        'data' => [
            'deleted_count' => $count,
            'remaining_count' => 0
        ]
    ]);
    
} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error deleting notifications: ' . $e->getMessage()
    ]);
}
?>