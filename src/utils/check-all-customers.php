<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "1.idm_db";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "=== CURRENT DATABASE STATE ===\n";
    
    // Check qlo_customer table
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM qlo_customer");
    $result = $stmt->fetch();
    echo "qlo_customer records: " . $result['count'] . "\n";
    
    if ($result['count'] > 0) {
        echo "\nqlo_customer data:\n";
        $stmt = $pdo->query("SELECT * FROM qlo_customer ORDER BY date_add DESC");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "  - ID: " . $row['id_customer'] . " | " . $row['firstname'] . " " . $row['lastname'] . " | Email: " . $row['email'] . " | Added: " . $row['date_add'] . "\n";
        }
    }
    
    // Check qlo_address table
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM qlo_address WHERE id_customer > 0");
    $result = $stmt->fetch();
    echo "\nqlo_address records (with customer IDs): " . $result['count'] . "\n";
    
    if ($result['count'] > 0) {
        echo "\nqlo_address data:\n";
        $stmt = $pdo->query("SELECT * FROM qlo_address WHERE id_customer > 0 ORDER BY date_add DESC");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "  - ID: " . $row['id_customer'] . " | " . $row['firstname'] . " " . $row['lastname'] . " | Address: " . $row['address1'] . " | Added: " . $row['date_add'] . "\n";
        }
    }
    
    // Check escort data
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM guest_escorts");
    $result = $stmt->fetch();
    echo "\nguest_escorts records: " . $result['count'] . "\n";
    
    if ($result['count'] > 0) {
        echo "\nguest_escorts data:\n";
        $stmt = $pdo->query("SELECT * FROM guest_escorts ORDER BY created_at DESC");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "  - Escort: " . $row['first_name'] . " " . $row['last_name'] . " | For Customer: " . $row['id_customer'] . " | Relationship: " . $row['relationship_to_guest'] . "\n";
        }
    }
    
    // Check the exact API query
    echo "\n=== TESTING API QUERY ===\n";
    $sql = "SELECT 
                a.id_customer as id,
                a.firstname,
                a.lastname,
                a.address1,
                a.address2,
                a.city,
                a.postcode,
                a.phone,
                a.phone_mobile,
                a.alias,
                a.company,
                a.date_add,
                a.active,
                g.id_guest,
                g.accept_language
            FROM qlo_address a
            LEFT JOIN qlo_guest g ON a.id_customer = g.id_customer
            WHERE a.id_customer > 0 AND a.deleted = 0
            GROUP BY a.id_customer
            ORDER BY a.date_add DESC 
            LIMIT 100";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $customers = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "API Query Results: " . count($customers) . " customers\n";
    foreach ($customers as $customer) {
        echo "  - ID: " . $customer['id'] . " | " . $customer['firstname'] . " " . $customer['lastname'] . "\n";
    }
    
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>