<?php
// Check escorts in database
$db_server = 'localhost';
$db_name = '1.IDM_db';
$db_user = 'root';
$db_password = '';

try {
    $conn = new PDO(
        "mysql:host=$db_server;dbname=$db_name;charset=utf8",
        $db_user,
        $db_password,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    
    $sql = "SELECT * FROM guest_escorts ORDER BY created_at DESC LIMIT 5";
    $stmt = $conn->query($sql);
    $records = $stmt->fetchAll();
    
    echo "Total escorts found: " . count($records) . "\n\n";
    
    if (count($records) > 0) {
        foreach ($records as $record) {
            echo "Escort ID: " . $record['id'] . "\n";
            echo "Guest ID: " . $record['id_customer'] . "\n";
            echo "Name: " . $record['first_name'] . " " . $record['last_name'] . "\n";
            echo "Document: " . $record['document_number'] . "\n";
            echo "Created: " . $record['created_at'] . "\n";
            echo "--------------------\n";
        }
    } else {
        echo "No escorts found. Please add an escort first.\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>