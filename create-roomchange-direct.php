<?php
// Direct SQL execution to create roomchange table
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: text/plain; charset=utf-8');

try {
    // Database connection
    $pdo = new PDO("mysql:host=localhost;dbname=1.idm_db;charset=utf8mb4", 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "✓ Connected to database: 1.idm_db\n\n";
    
    // Drop table if exists
    $pdo->exec("DROP TABLE IF EXISTS roomchange");
    echo "✓ Dropped existing table (if any)\n\n";
    
    // Create table with direct SQL
    $sql = "CREATE TABLE roomchange (
        id INT AUTO_INCREMENT PRIMARY KEY,
        booking_id INT NOT NULL COMMENT 'Reference to htl_booking_detail.id',
        guest_name VARCHAR(255) NOT NULL COMMENT 'Guest full name',
        old_room_id INT NOT NULL COMMENT 'Previous room ID from htl_room_information',
        old_room_num VARCHAR(50) NOT NULL COMMENT 'Previous room number',
        new_room_id INT NOT NULL COMMENT 'New room ID from htl_room_information',
        new_room_num VARCHAR(50) NOT NULL COMMENT 'New room number',
        change_reason TEXT NOT NULL COMMENT 'Reason for room change',
        changed_by VARCHAR(100) NOT NULL COMMENT 'Staff member who made the change',
        change_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'When the change was made',
        check_in_date DATE NOT NULL COMMENT 'Guest check-in date',
        check_out_date DATE NOT NULL COMMENT 'Guest check-out date',
        status ENUM('pending', 'completed', 'cancelled') DEFAULT 'pending' COMMENT 'Status of room change',
        notes TEXT COMMENT 'Additional notes about the change',
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        
        INDEX idx_booking_id (booking_id),
        INDEX idx_old_room (old_room_id),
        INDEX idx_new_room (new_room_id),
        INDEX idx_change_date (change_date),
        INDEX idx_status (status)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Guest room change tracking'";
    
    $pdo->exec($sql);
    echo "✓ Created table: roomchange\n\n";
    
    // Verify table exists
    $stmt = $pdo->query("SHOW TABLES LIKE 'roomchange'");
    if ($stmt->rowCount() === 0) {
        throw new Exception("Table verification failed - table not found!");
    }
    echo "✓ Verified table exists\n\n";
    
    // Get table structure
    $columns = $pdo->query("DESCRIBE roomchange")->fetchAll(PDO::FETCH_ASSOC);
    echo "✓ Table has " . count($columns) . " columns:\n\n";
    
    foreach ($columns as $col) {
        echo sprintf("  - %-20s %s\n", $col['Field'], $col['Type']);
    }
    
    // Get table info
    $tableInfo = $pdo->query("SHOW TABLE STATUS LIKE 'roomchange'")->fetch(PDO::FETCH_ASSOC);
    echo "\n✓ Table Info:\n";
    echo "  - Engine: " . $tableInfo['Engine'] . "\n";
    echo "  - Collation: " . $tableInfo['Collation'] . "\n";
    echo "  - Rows: " . $tableInfo['Rows'] . "\n";
    
    echo "\n========================================\n";
    echo "SUCCESS! Table 'roomchange' created successfully.\n";
    echo "Now refresh phpMyAdmin (press F5) to see the table.\n";
    echo "========================================\n";
    
} catch (Exception $e) {
    echo "\n========================================\n";
    echo "ERROR: " . $e->getMessage() . "\n";
    echo "========================================\n";
    http_response_code(500);
}
