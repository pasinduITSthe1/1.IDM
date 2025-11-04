<?php
header('Content-Type: application/json');
echo json_encode([
    'success' => true,
    'message' => 'Test endpoint outside api directory',
    'timestamp' => date('Y-m-d H:i:s')
]);
?>