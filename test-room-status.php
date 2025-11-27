<?php
/**
 * Quick test to check room status in database
 */

define('_DB_SERVER_', 'localhost');
define('_DB_NAME_', '1.IDM_db');
define('_DB_USER_', 'root');
define('_DB_PASSWD_', '');
define('_DB_PREFIX_', 'qlo_');

$conn = new mysqli(_DB_SERVER_, _DB_USER_, _DB_PASSWD_, _DB_NAME_);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "<h2>Room Status Check</h2>\n";

// Get all rooms with their status
$sql = "SELECT 
            hr.id,
            hr.room_num,
            hr.id_status,
            CASE 
                WHEN hr.id_status = 1 THEN 'Available'
                WHEN hr.id_status = 2 THEN 'Occupied'
                WHEN hr.id_status = 3 THEN 'Cleaning'
                WHEN hr.id_status = 4 THEN 'Maintenance'
                WHEN hr.id_status = 5 THEN 'Reserved'
                ELSE 'Unknown'
            END as status_name,
            hr.date_upd
        FROM " . _DB_PREFIX_ . "htl_room_information hr
        WHERE hr.active = 1
        ORDER BY hr.room_num
        LIMIT 10";

$result = $conn->query($sql);

echo "<table border='1' cellpadding='5'>\n";
echo "<tr><th>ID</th><th>Room Number</th><th>Status Code</th><th>Status Name</th><th>Last Updated</th></tr>\n";

while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['room_num'] . "</td>";
    echo "<td>" . $row['id_status'] . "</td>";
    echo "<td><strong>" . $row['status_name'] . "</strong></td>";
    echo "<td>" . $row['date_upd'] . "</td>";
    echo "</tr>\n";
}

echo "</table>\n";

// Check guest_checkins table
echo "<h2>Recent Check-ins</h2>\n";
$sql2 = "SELECT * FROM guest_checkins ORDER BY created_at DESC LIMIT 5";
$result2 = $conn->query($sql2);

if ($result2 && $result2->num_rows > 0) {
    echo "<table border='1' cellpadding='5'>\n";
    echo "<tr><th>ID Customer</th><th>Room ID</th><th>Room Number</th><th>Check-in Time</th></tr>\n";
    
    while ($row = $result2->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id_customer'] . "</td>";
        echo "<td>" . $row['id_room'] . "</td>";
        echo "<td>" . $row['room_number'] . "</td>";
        echo "<td>" . $row['check_in_time'] . "</td>";
        echo "</tr>\n";
    }
    echo "</table>\n";
} else {
    echo "<p>No check-ins found</p>\n";
}

$conn->close();
?>
