<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "1.idm_db";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "=== SEARCHING FOR GUEST/CUSTOMER DATA ===\n";
    
    // Check all tables that might contain guest data
    $tables_to_check = [
        'qlo_customer',
        'qlo_guest', 
        'qlo_customer_guest_detail',
        'qlo_order_customer_guest_detail',
        'qlo_htl_booking_detail',
        'qlo_orders',
        'qlo_address'
    ];
    
    foreach ($tables_to_check as $table) {
        echo "\n--- $table ---\n";
        try {
            $stmt = $pdo->query("SELECT COUNT(*) as count FROM $table");
            $result = $stmt->fetch();
            echo "Records: " . $result['count'] . "\n";
            
            if ($result['count'] > 0) {
                // Show table structure
                $stmt = $pdo->query("DESCRIBE $table");
                $columns = [];
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $columns[] = $row['Field'];
                }
                echo "Columns: " . implode(', ', $columns) . "\n";
                
                // Show sample data
                $stmt = $pdo->query("SELECT * FROM $table LIMIT 2");
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "Sample: " . json_encode($row) . "\n";
                }
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage() . "\n";
        }
    }
    
    echo "\n=== LOOKING FOR NAME/EMAIL FIELDS ===\n";
    
    // Search for tables with common customer fields
    $stmt = $pdo->query("SELECT TABLE_NAME, COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS 
                         WHERE TABLE_SCHEMA = '1.idm_db' 
                         AND (COLUMN_NAME LIKE '%name%' OR COLUMN_NAME LIKE '%email%' 
                              OR COLUMN_NAME LIKE '%guest%' OR COLUMN_NAME LIKE '%customer%')
                         ORDER BY TABLE_NAME, COLUMN_NAME");
    
    $current_table = '';
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        if ($current_table != $row['TABLE_NAME']) {
            $current_table = $row['TABLE_NAME'];
            echo "\n$current_table:\n";
        }
        echo "  - " . $row['COLUMN_NAME'] . "\n";
    }
    
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>