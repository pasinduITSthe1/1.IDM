<?php
header('Content-Type: application/json');

$host = 'localhost';
$dbname = '1.IDM_db';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Check if table exists
    $stmt = $pdo->query("SHOW TABLES LIKE 'roomchange'");
    $tableExists = $stmt->fetch();
    
    if (!$tableExists) {
        echo json_encode([
            'success' => false,
            'message' => 'roomchange table does not exist'
        ], JSON_PRETTY_PRINT);
        exit;
    }
    
    // Get table structure
    $stmt = $pdo->query("DESCRIBE roomchange");
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Get latest records
    $stmt = $pdo->query("SELECT * FROM roomchange ORDER BY id DESC LIMIT 5");
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode([
        'success' => true,
        'table_exists' => true,
        'columns' => $columns,
        'latest_records' => $records,
        'total_count' => $pdo->query("SELECT COUNT(*) FROM roomchange")->fetchColumn()
    ], JSON_PRETTY_PRINT);
    
} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ], JSON_PRETTY_PRINT);
}
