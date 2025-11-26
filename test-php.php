<?php
// Simple PHP test file
echo "PHP is working!<br>";
echo "PHP Version: " . phpversion() . "<br>";
echo "MySQL Connection Test:<br>";

$mysqli = new mysqli("localhost", "root", "", "1.IDM_db");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
echo "Connected successfully to database<br>";

// Test if PrestaShop tables exist
$result = $mysqli->query("SHOW TABLES LIKE 'qlo_%'");
$count = $result->num_rows;
echo "Found $count PrestaShop tables<br>";

$mysqli->close();

echo "<br><strong>All systems operational!</strong>";
?>
