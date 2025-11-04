<?php
header('Content-Type: application/json');
echo json_encode([
    'success' => true,
    'message' => 'Simple API endpoint working',
    'timestamp' => date('Y-m-d H:i:s'),
    'method' => $_SERVER['REQUEST_METHOD']
]);
?>