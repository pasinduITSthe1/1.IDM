<?php
// Test room change update to verify database changes
header('Content-Type: text/plain; charset=utf-8');

try {
    $pdo = new PDO("mysql:host=localhost;dbname=1.idm_db;charset=utf8mb4", 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "=== ROOM CHANGE DATABASE TEST ===\n\n";
    
    // Check roomchange table
    $changes = $pdo->query("SELECT * FROM roomchange ORDER BY id DESC LIMIT 5")->fetchAll(PDO::FETCH_ASSOC);
    echo "Recent Room Changes:\n";
    foreach ($changes as $change) {
        echo "  ID: {$change['id']}\n";
        echo "  Guest: {$change['guest_name']}\n";
        echo "  From: {$change['old_room_num']} (ID: {$change['old_room_id']})\n";
        echo "  To: {$change['new_room_num']} (ID: {$change['new_room_id']})\n";
        echo "  Status: {$change['status']}\n";
        echo "  Changed: {$change['change_date']}\n";
        echo "  ---\n";
    }
    
    // Check guest_checkins table
    echo "\nActive Check-ins:\n";
    $checkins = $pdo->query("
        SELECT gc.*, c.firstname, c.lastname, r.room_num
        FROM guest_checkins gc
        LEFT JOIN qlo_customer c ON gc.id_customer = c.id_customer
        LEFT JOIN qlo_htl_room_information r ON gc.id_room = r.id
        WHERE NOT EXISTS (SELECT 1 FROM guest_checkouts WHERE id_checkin = gc.id)
        ORDER BY gc.id DESC
        LIMIT 5
    ")->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($checkins as $checkin) {
        echo "  Check-in ID: {$checkin['id']}\n";
        echo "  Customer: {$checkin['firstname']} {$checkin['lastname']} (ID: {$checkin['id_customer']})\n";
        echo "  Room: {$checkin['room_num']} (ID: {$checkin['id_room']})\n";
        echo "  Check-in: {$checkin['check_in_time']}\n";
        echo "  ---\n";
    }
    
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage();
}
