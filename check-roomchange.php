<?php
header('Content-Type: text/plain; charset=utf-8');

try {
    $pdo = new PDO("mysql:host=localhost;dbname=1.idm_db;charset=utf8mb4", 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Check if table exists
    $stmt = $pdo->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    echo "Total tables in database: " . count($tables) . "\n\n";
    
    // Find roomchange table
    $found = false;
    foreach ($tables as $table) {
        if (strtolower($table) === 'roomchange') {
            $found = true;
            echo "✓ FOUND: $table\n\n";
            break;
        }
    }
    
    if (!$found) {
        echo "✗ Table 'roomchange' NOT FOUND\n\n";
        echo "Tables that don't start with 'qlo_':\n";
        foreach ($tables as $table) {
            if (strpos($table, 'qlo_') !== 0) {
                echo "  - $table\n";
            }
        }
    } else {
        // Show table structure
        $cols = $pdo->query("DESCRIBE roomchange")->fetchAll(PDO::FETCH_ASSOC);
        echo "Table structure (" . count($cols) . " columns):\n";
        foreach ($cols as $col) {
            echo sprintf("  %-20s %-30s %s\n", $col['Field'], $col['Type'], $col['Key']);
        }
    }
    
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage();
}
