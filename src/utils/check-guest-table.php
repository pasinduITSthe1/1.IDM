<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "1.idm_db";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "=== QLO_GUEST TABLE STRUCTURE ===\n";
    $stmt = $pdo->query("DESCRIBE qlo_guest");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo $row['Field'] . " (" . $row['Type'] . ")\n";
    }
    
    echo "\n=== SAMPLE GUEST RECORDS ===\n";
    $stmt = $pdo->query("SELECT * FROM qlo_guest LIMIT 5");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo json_encode($row) . "\n";
    }
    
    echo "\n=== GUEST IDs WITH CUSTOMER IDs ===\n";
    $stmt = $pdo->query("SELECT id_guest, id_customer FROM qlo_guest WHERE id_customer > 0 ORDER BY id_guest");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "Guest ID: " . $row['id_guest'] . " -> Customer ID: " . $row['id_customer'] . "\n";
    }
    
    echo "\n=== CHECK FOR CUSTOMER DATA IN OTHER TABLES ===\n";
    
    // Check qlo_customer_guest_detail table
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM qlo_customer_guest_detail");
    $result = $stmt->fetch();
    echo "qlo_customer_guest_detail records: " . $result['count'] . "\n";
    
    if ($result['count'] > 0) {
        $stmt = $pdo->query("SELECT * FROM qlo_customer_guest_detail LIMIT 3");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo json_encode($row) . "\n";
        }
    }
    
    // Check order_customer_guest_detail table
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM qlo_order_customer_guest_detail");
    $result = $stmt->fetch();
    echo "\nqlo_order_customer_guest_detail records: " . $result['count'] . "\n";
    
    if ($result['count'] > 0) {
        $stmt = $pdo->query("SELECT * FROM qlo_order_customer_guest_detail LIMIT 3");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo json_encode($row) . "\n";
        }
    }
    
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>