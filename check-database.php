<?php
// Check database records
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
    
    $sql = "SELECT * FROM guest_attachments ORDER BY upload_date DESC LIMIT 10";
    $stmt = $conn->query($sql);
    $records = $stmt->fetchAll();
    
    echo "Total records found: " . count($records) . "\n\n";
    
    foreach ($records as $record) {
        echo "ID: " . $record['id'] . "\n";
        echo "Customer ID: " . $record['id_customer'] . "\n";
        echo "Type: " . $record['attachment_type'] . "\n";
        echo "File Path: " . $record['file_path'] . "\n";
        echo "Upload Date: " . $record['upload_date'] . "\n";
        echo "--------------------\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>