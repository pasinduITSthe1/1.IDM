<?php
// Complete room change flow test
header('Content-Type: text/plain; charset=utf-8');

$pdo = new PDO("mysql:host=localhost;dbname=1.idm_db;charset=utf8mb4", 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

echo "=== ROOM CHANGE UPDATE TEST ===\n\n";

// Get a checked-in guest
$guestSql = "SELECT gc.id_customer, gc.id_room, gc.room_number, c.firstname, c.lastname, r.room_num as actual_room
             FROM guest_checkins gc
             JOIN qlo_customer c ON gc.id_customer = c.id_customer
             JOIN qlo_htl_room_information r ON gc.id_room = r.id
             WHERE NOT EXISTS (SELECT 1 FROM guest_checkouts WHERE id_checkin = gc.id)
             LIMIT 1";

$guest = $pdo->query($guestSql)->fetch(PDO::FETCH_ASSOC);

if (!$guest) {
    echo "No checked-in guests found. Please check in a guest first.\n";
    exit;
}

echo "Found checked-in guest:\n";
echo "  Customer ID: {$guest['id_customer']}\n";
echo "  Name: {$guest['firstname']} {$guest['lastname']}\n";
echo "  Current Room: {$guest['actual_room']} (ID: {$guest['id_room']})\n";
echo "  Stored Room Number: {$guest['room_number']}\n\n";

// Get available room
$availRoomSql = "SELECT id, room_num FROM qlo_htl_room_information 
                 WHERE id != :current_room 
                 AND id NOT IN (SELECT id_room FROM guest_checkins WHERE NOT EXISTS (SELECT 1 FROM guest_checkouts WHERE id_checkin = guest_checkins.id))
                 LIMIT 1";
$stmt = $pdo->prepare($availRoomSql);
$stmt->execute([':current_room' => $guest['id_room']]);
$newRoom = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$newRoom) {
    echo "No available rooms found for testing.\n";
    exit;
}

echo "Target room for change:\n";
echo "  Room Number: {$newRoom['room_num']}\n";
echo "  Room ID: {$newRoom['id']}\n\n";

// Test guest status API BEFORE change
echo "=== TESTING guest-status.php BEFORE CHANGE ===\n";
$url = "http://localhost/1.IDM/hotel-backend/api/guest-status.php?customer_id={$guest['id_customer']}";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

echo "Response: $response\n\n";

// Simulate room change completion
echo "=== SIMULATING ROOM CHANGE ===\n";
echo "Updating guest_checkins table...\n";

$updateSql = "UPDATE guest_checkins 
              SET id_room = :new_room_id,
                  room_number = :new_room_num
              WHERE id_customer = :customer_id
              AND NOT EXISTS (SELECT 1 FROM guest_checkouts WHERE id_checkin = guest_checkins.id)";

$stmt = $pdo->prepare($updateSql);
$stmt->execute([
    ':new_room_id' => (int)$newRoom['id'],
    ':new_room_num' => $newRoom['room_num'],
    ':customer_id' => (int)$guest['id_customer']
]);

echo "Rows affected: " . $stmt->rowCount() . "\n\n";

// Test guest status API AFTER change
echo "=== TESTING guest-status.php AFTER CHANGE ===\n";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

echo "Response: $response\n\n";

$data = json_decode($response, true);
if ($data && isset($data['room_number'])) {
    if ($data['room_number'] === $newRoom['room_num']) {
        echo "✅ SUCCESS! Room number updated correctly to {$newRoom['room_num']}\n";
    } else {
        echo "❌ FAILED! Expected {$newRoom['room_num']}, got {$data['room_number']}\n";
    }
} else {
    echo "❌ FAILED! Could not parse response\n";
}

// Rollback for clean testing
echo "\n=== ROLLING BACK CHANGES ===\n";
$rollbackSql = "UPDATE guest_checkins 
                SET id_room = :old_room_id,
                    room_number = :old_room_num
                WHERE id_customer = :customer_id";
$stmt = $pdo->prepare($rollbackSql);
$stmt->execute([
    ':old_room_id' => (int)$guest['id_room'],
    ':old_room_num' => $guest['room_number'],
    ':customer_id' => (int)$guest['id_customer']
]);

echo "Rolled back to original room: {$guest['room_number']}\n";
echo "\n=== TEST COMPLETE ===\n";
