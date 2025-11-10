<?php
// Clean up duplicate guest attachments with temporary customer IDs
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
    
    echo "=== GUEST ATTACHMENTS CLEANUP ===\n\n";
    
    // First, show current state
    echo "🔍 Current guest_attachments table:\n";
    $stmt = $conn->query("SELECT * FROM guest_attachments ORDER BY id_customer, upload_date");
    $records = $stmt->fetchAll();
    
    foreach ($records as $record) {
        echo "ID: {$record['id']}, Customer: {$record['id_customer']}, Type: {$record['attachment_type']}, Date: {$record['upload_date']}\n";
    }
    
    echo "\n";
    
    // Identify and remove temporary customer IDs (very large numbers from timestamps)
    // Typical customer IDs should be reasonable numbers (< 1000000)
    // Timestamp-based IDs are much larger (1731227000000+)
    
    echo "🧹 Cleaning up temporary customer IDs...\n";
    
    $deleteStmt = $conn->prepare("DELETE FROM guest_attachments WHERE id_customer > 1000000");
    $deleteStmt->execute();
    
    $deletedCount = $deleteStmt->rowCount();
    echo "✅ Deleted $deletedCount records with temporary customer IDs\n\n";
    
    // Show final state
    echo "📊 Final guest_attachments table:\n";
    $stmt = $conn->query("SELECT * FROM guest_attachments ORDER BY id_customer, upload_date");
    $records = $stmt->fetchAll();
    
    if (count($records) > 0) {
        foreach ($records as $record) {
            echo "ID: {$record['id']}, Customer: {$record['id_customer']}, Type: {$record['attachment_type']}, Date: {$record['upload_date']}\n";
        }
    } else {
        echo "No records remaining (all were temporary)\n";
    }
    
    echo "\n✅ Cleanup complete! Future scans will only save attachments once during guest registration.\n";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage();
}
?>