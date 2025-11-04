<?php
header('Content-Type: application/json');

$host = 'localhost';
$db = '1.IDM_db';
$user = 'root';
$pass = '';

try {
    echo "Connecting to database...\n";
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Connected successfully!\n";
    
    // Test query
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM qlo_customer");
    $result = $stmt->fetch();
    
    echo "Customer count: " . $result['count'] . "\n";
    
    // Get sample data
    $stmt = $pdo->query("SELECT id_customer, firstname, lastname, email FROM qlo_customer LIMIT 5");
    $customers = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "Sample customers:\n";
    foreach ($customers as $customer) {
        echo "ID: " . $customer['id_customer'] . ", Name: " . $customer['firstname'] . " " . $customer['lastname'] . "\n";
    }
    
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>