<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "1.idm_db";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "=== ADDING TEST CUSTOMER FOR REAL-TIME UPDATE TEST ===\n";
    
    // Generate a unique customer
    $timestamp = date('Y-m-d H:i:s');
    $firstName = 'TestUser';
    $lastName = date('His'); // Hour-Minute-Second for uniqueness
    $email = 'test' . time() . '@hotel.com';
    
    // Add customer to qlo_customer table
    $stmt = $pdo->prepare("INSERT INTO qlo_customer (firstname, lastname, email, date_add, date_upd, active, deleted, is_guest) 
                          VALUES (?, ?, ?, ?, ?, 1, 0, 0)");
    
    $result = $stmt->execute([
        $firstName,
        $lastName,
        $email,
        $timestamp,
        $timestamp
    ]);
    
    $customerId = $pdo->lastInsertId();
    
    if ($result) {
        echo "✅ Added test customer: $firstName $lastName (ID: $customerId)\n";
        echo "   Email: $email\n";
        echo "   Added at: $timestamp\n";
        
        // Test the API immediately
        echo "\n=== TESTING UPDATED API ===\n";
        $apiUrl = 'http://localhost/1.IDM/customers-api.php';
        $response = file_get_contents($apiUrl);
        $data = json_decode($response, true);
        
        echo "API returned " . $data['total'] . " customers:\n";
        foreach ($data['customers'] as $customer) {
            echo "  - ID: " . $customer['id'] . " | " . $customer['firstname'] . " " . $customer['lastname'] . " | Added: " . $customer['date_add'] . "\n";
        }
        
        echo "\n🔄 The Flutter app should now show " . $data['total'] . " customers when refreshed.\n";
        echo "💡 Instructions for user:\n";
        echo "   1. Open the Flutter app\n";
        echo "   2. Pull down on the guest list to refresh\n";
        echo "   3. You should now see the new customer: $firstName $lastName\n";
        
    } else {
        echo "❌ Failed to add test customer\n";
    }
    
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>