<?php
// Verify and create roomchange table

header('Content-Type: application/json');

try {
    // Database connection
    $host = 'localhost';
    $dbname = '1.idm_db';
    $username = 'root';
    $password = '';
    
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // First, check if table exists
    $checkStmt = $pdo->query("SHOW TABLES LIKE 'roomchange'");
    $tableExists = $checkStmt->rowCount() > 0;
    
    $result = [
        'database' => $dbname,
        'table_existed_before' => $tableExists
    ];
    
    if ($tableExists) {
        // Drop existing table to recreate it fresh
        $pdo->exec("DROP TABLE IF EXISTS roomchange");
        $result['action'] = 'Dropped existing table';
    }
    
    // Read and execute the SQL file
    $sqlFile = __DIR__ . '/database_roomchange_table.sql';
    if (!file_exists($sqlFile)) {
        throw new Exception("SQL file not found: $sqlFile");
    }
    
    $sql = file_get_contents($sqlFile);
    
    // Execute the SQL
    $pdo->exec($sql);
    $result['sql_executed'] = true;
    
    // Verify table was created
    $verifyStmt = $pdo->query("SHOW TABLES LIKE 'roomchange'");
    $nowExists = $verifyStmt->rowCount() > 0;
    
    if (!$nowExists) {
        throw new Exception("Table creation failed - table still doesn't exist");
    }
    
    // Get table structure
    $structureStmt = $pdo->query("DESCRIBE roomchange");
    $columns = $structureStmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Get table info
    $tableInfoStmt = $pdo->query("SHOW TABLE STATUS LIKE 'roomchange'");
    $tableInfo = $tableInfoStmt->fetch(PDO::FETCH_ASSOC);
    
    $result['success'] = true;
    $result['table_created'] = true;
    $result['column_count'] = count($columns);
    $result['engine'] = $tableInfo['Engine'] ?? 'unknown';
    $result['collation'] = $tableInfo['Collation'] ?? 'unknown';
    $result['columns'] = array_map(function($col) {
        return [
            'name' => $col['Field'],
            'type' => $col['Type'],
            'null' => $col['Null'],
            'key' => $col['Key'],
            'default' => $col['Default'],
            'extra' => $col['Extra']
        ];
    }, $columns);
    
    echo json_encode($result, JSON_PRETTY_PRINT);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage(),
        'trace' => $e->getTraceAsString()
    ], JSON_PRETTY_PRINT);
}
