<?php
header('Content-Type: application/json');

$host = 'localhost';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Get all databases
    $databases = $pdo->query("SHOW DATABASES")->fetchAll(PDO::FETCH_COLUMN);
    
    $results = [];
    
    foreach ($databases as $db) {
        if (in_array($db, ['information_schema', 'performance_schema', 'mysql', 'sys'])) {
            continue;
        }
        
        try {
            $pdo->exec("USE `$db`");
            $stmt = $pdo->query("SHOW TABLES LIKE 'roomchange'");
            $table = $stmt->fetch();
            
            if ($table) {
                $count = $pdo->query("SELECT COUNT(*) FROM roomchange")->fetchColumn();
                $results[] = [
                    'database' => $db,
                    'table' => 'roomchange',
                    'record_count' => $count,
                    'found' => true
                ];
            }
        } catch (Exception $e) {
            // Skip databases we can't access
        }
    }
    
    echo json_encode([
        'success' => true,
        'searched_databases' => array_values(array_diff($databases, ['information_schema', 'performance_schema', 'mysql', 'sys'])),
        'tables_found' => $results
    ], JSON_PRETTY_PRINT);
    
} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ], JSON_PRETTY_PRINT);
}
