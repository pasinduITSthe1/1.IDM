<?php
// Auto-sync real notifications every 5 minutes
// This can be called by a cron job or scheduled task

// Set execution time to avoid timeout
set_time_limit(60);

// Include the sync script
$syncUrl = 'http://localhost/1.IDM/custom-api/sync-real-notifications.php';

try {
    $response = file_get_contents($syncUrl);
    $result = json_decode($response, true);
    
    if ($result && $result['success']) {
        $logMessage = date('Y-m-d H:i:s') . " - Sync successful: " . $result['data']['total_created'] . " new notifications\n";
        file_put_contents(__DIR__ . '/sync-log.txt', $logMessage, FILE_APPEND);
        
        echo "Sync completed successfully\n";
        echo "New notifications: " . $result['data']['total_created'] . "\n";
    } else {
        $errorMessage = date('Y-m-d H:i:s') . " - Sync failed: " . ($result['message'] ?? 'Unknown error') . "\n";
        file_put_contents(__DIR__ . '/sync-log.txt', $errorMessage, FILE_APPEND);
        
        echo "Sync failed\n";
    }
} catch (Exception $e) {
    $errorMessage = date('Y-m-d H:i:s') . " - Sync exception: " . $e->getMessage() . "\n";
    file_put_contents(__DIR__ . '/sync-log.txt', $errorMessage, FILE_APPEND);
    
    echo "Sync exception: " . $e->getMessage() . "\n";
}
?>