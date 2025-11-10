<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "1.idm_db";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "=== FIXING ESCORT TABLE FOREIGN KEY ===\n";
    
    // First, let's see the current table structure
    $stmt = $pdo->query("SHOW CREATE TABLE guest_escorts");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "Current table structure:\n";
    echo $result['Create Table'] . "\n\n";
    
    // Drop the foreign key constraint
    echo "Dropping foreign key constraint...\n";
    $pdo->exec("ALTER TABLE guest_escorts DROP FOREIGN KEY guest_escorts_ibfk_1");
    echo "✅ Foreign key constraint dropped\n\n";
    
    // Now let's add customer data to qlo_customer table from qlo_address
    echo "Adding customer data to qlo_customer table...\n";
    
    // Get customers from address table
    $stmt = $pdo->query("SELECT * FROM qlo_address WHERE id_customer > 0");
    $addresses = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($addresses as $address) {
        // Check if customer already exists in qlo_customer
        $stmt = $pdo->prepare("SELECT COUNT(*) as count FROM qlo_customer WHERE id_customer = ?");
        $stmt->execute([$address['id_customer']]);
        $exists = $stmt->fetch()['count'];
        
        if ($exists == 0) {
            // Insert customer into qlo_customer table
            $stmt = $pdo->prepare("INSERT INTO qlo_customer (id_customer, firstname, lastname, email, date_add, date_upd, active, deleted, is_guest) 
                                  VALUES (?, ?, ?, ?, ?, ?, 1, 0, 0)");
            
            $email = $address['firstname'] . '.' . $address['lastname'] . '@hotel.com'; // Generate email
            $stmt->execute([
                $address['id_customer'],
                $address['firstname'],
                $address['lastname'],
                strtolower($email),
                $address['date_add'],
                $address['date_upd'] ?: $address['date_add']
            ]);
            
            echo "✅ Added customer: " . $address['firstname'] . " " . $address['lastname'] . " (ID: " . $address['id_customer'] . ")\n";
        } else {
            echo "⏭️  Customer " . $address['firstname'] . " " . $address['lastname'] . " already exists\n";
        }
    }
    
    // Re-create the foreign key constraint
    echo "\nRe-creating foreign key constraint...\n";
    $pdo->exec("ALTER TABLE guest_escorts 
               ADD CONSTRAINT guest_escorts_ibfk_1 
               FOREIGN KEY (id_customer) REFERENCES qlo_customer(id_customer) ON DELETE CASCADE");
    echo "✅ Foreign key constraint re-created\n\n";
    
    // Test adding an escort again
    echo "=== TESTING ESCORT ADDITION ===\n";
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
    } else {
        echo "❌ Failed to add escort\n";
    }
    
    // Verify data in both tables
    echo "\n=== VERIFICATION ===\n";
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM qlo_customer");
    $customer_count = $stmt->fetch()['count'];
    echo "qlo_customer records: $customer_count\n";
    
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM guest_escorts");
    $escort_count = $stmt->fetch()['count'];
    echo "guest_escorts records: $escort_count\n";
    
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>