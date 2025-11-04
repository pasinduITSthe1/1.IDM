<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "1.idm_db";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "=== TESTING ESCORT FUNCTIONALITY ===\n";
    
    // Check if we have existing customers
    $stmt = $pdo->query("SELECT id_customer, firstname, lastname FROM qlo_address WHERE id_customer > 0");
    $customers = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "Available customers:\n";
    foreach ($customers as $customer) {
        echo "- ID: " . $customer['id_customer'] . " - " . $customer['firstname'] . " " . $customer['lastname'] . "\n";
    }
    
    // Check existing escorts
    $stmt = $pdo->query("SELECT * FROM guest_escorts");
    $escorts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "\nExisting escorts: " . count($escorts) . "\n";
    foreach ($escorts as $escort) {
        echo "- " . $escort['first_name'] . " " . $escort['last_name'] . " (Customer ID: " . $escort['id_customer'] . ", Relationship: " . $escort['relationship_to_guest'] . ")\n";
    }
    
    // Test adding a new escort for customer ID 1 (John Doe)
    echo "\n=== ADDING TEST ESCORT ===\n";
    
    $stmt = $pdo->prepare("INSERT INTO guest_escorts (id_customer, first_name, last_name, email, phone, relationship_to_guest, created_at) 
                          VALUES (?, ?, ?, ?, ?, ?, NOW())");
    
    $result = $stmt->execute([
        1, // Customer ID (John Doe)
        'Jane',
        'Smith',
        'jane.smith@email.com',
        '123-456-7890',
        'Spouse'
    ]);
    
    if ($result) {
        echo "✅ Successfully added escort Jane Smith for customer John Doe\n";
        
        // Verify the addition
        $stmt = $pdo->query("SELECT * FROM guest_escorts WHERE id_customer = 1");
        $customer_escorts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo "John Doe now has " . count($customer_escorts) . " escort(s):\n";
        foreach ($customer_escorts as $escort) {
            echo "- " . $escort['first_name'] . " " . $escort['last_name'] . " (" . $escort['relationship_to_guest'] . ")\n";
        }
    } else {
        echo "❌ Failed to add escort\n";
    }
    
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>