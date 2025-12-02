<?php
header('Content-Type: text/plain');

$host = 'localhost';
$dbname = '1.idm_db';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Read the SQL file
    $sql = file_get_contents(__DIR__ . '/database_roomchange_table.sql');
    
    // Execute the SQL
    $pdo->exec($sql);
    
    echo "SUCCESS: roomchange table created in 1.idm_db database\n\n";
    
    // Verify it was created
    $stmt = $pdo->query("SHOW TABLES LIKE 'roomchange'");
    if ($stmt->fetch()) {
        echo "Table verified: roomchange exists\n";
        
        // Show structure
        $stmt = $pdo->query("DESCRIBE roomchange");
        $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo "\nTable has " . count($columns) . " columns\n";
    }
    
} catch (PDOException $e) {
    echo "ERROR: " . $e->getMessage();
}
