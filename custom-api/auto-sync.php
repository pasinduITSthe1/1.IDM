<?php
// Automatic notification sync - runs every 10 seconds
header('Content-Type: application/json');

try {
    // Trigger the main sync
    $syncUrl = 'http://localhost/1.IDM/custom-api/sync-real-notifications.php';
    $response = file_get_contents($syncUrl);
    $result = json_decode($response, true);
    
    if ($result && $result['success']) {
        echo json_encode([
            'success' => true,
            'message' => 'Auto-sync completed',
            'data' => $result['data'],
            'timestamp' => date('Y-m-d H:i:s')
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Sync failed: ' . ($result['message'] ?? 'Unknown error'),
            'timestamp' => date('Y-m-d H:i:s')
        ]);
    }
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Auto-sync error: ' . $e->getMessage(),
        'timestamp' => date('Y-m-d H:i:s')
    ]);
}
?>