<?php
header('Content-Type: application/json');

$host = 'localhost';
$db = '1.IDM_db';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "=== DATABASE INVESTIGATION ===\n\n";
    
    // List all tables
    echo "Available tables:\n";
    $stmt = $pdo->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    foreach ($tables as $table) {
        echo "- $table\n";
    }
    
    echo "\n=== CUSTOMER-RELATED TABLES ===\n";
    
    // Check different customer tables
    $customerTables = ['qlo_customer', 'qlo_guest', 'customer', 'guest'];
    
    foreach ($customerTables as $tableName) {
        try {
            $stmt = $pdo->query("SELECT COUNT(*) as count FROM $tableName");
            $result = $stmt->fetch();
            echo "$tableName: " . $result['count'] . " records\n";
            
            if ($result['count'] > 0) {
                // Show sample data
                $stmt = $pdo->query("SELECT * FROM $tableName LIMIT 3");
                $samples = $stmt->fetchAll(PDO::FETCH_ASSOC);
                echo "Sample data from $tableName:\n";
                foreach ($samples as $sample) {
                    echo "  " . json_encode($sample) . "\n";
                }
            }
        } catch (Exception $e) {
            echo "$tableName: Table doesn't exist\n";
        }
        echo "\n";
    }
    
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>