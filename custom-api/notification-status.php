<!DOCTYPE html>
<html>
<head>
    <title>Notification Status</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        .notification { padding: 10px; margin: 5px; border-left: 4px solid; }
        .registration { border-color: #8E44AD; background: #f8f4fd; }
        .checkin { border-color: #00B894; background: #f0fdf4; }
        .checkout { border-color: #0984E3; background: #eff6ff; }
    </style>
</head>
<body>
    <h2>🔔 Current Notification Status</h2>
    
    <?php
    try {
        $host = 'localhost';
        $dbname = '1.idm_db';
        $username = 'root';
        $password = '';
        
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $stmt = $pdo->query("
            SELECT type, COUNT(*) as count 
            FROM notifications 
            GROUP BY type 
            ORDER BY type
        ");
        $counts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo "<h3>📊 Notification Counts:</h3>";
        foreach ($counts as $count) {
            echo "<p><strong>{$count['type']}</strong>: {$count['count']} notifications</p>";
        }
        
        $recentStmt = $pdo->query("
            SELECT id, type, title, message, timestamp 
            FROM notifications 
            ORDER BY timestamp DESC 
            LIMIT 10
        ");
        $recent = $recentStmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo "<h3>📱 Recent Notifications:</h3>";
        foreach ($recent as $notification) {
            $class = $notification['type'];
            echo "<div class='notification {$class}'>";
            echo "<strong>{$notification['title']}</strong><br>";
            echo "{$notification['message']}<br>";
            echo "<small>Type: {$notification['type']} | Time: {$notification['timestamp']}</small>";
            echo "</div>";
        }
        
    } catch (Exception $e) {
        echo "<p style='color: red;'>Error: " . $e->getMessage() . "</p>";
    }
    ?>
    
    <hr>
    <h3>📱 Flutter App Instructions:</h3>
    <ol>
        <li><strong>Pull down to refresh</strong> the notifications screen</li>
        <li>Check that your app is connected to the network</li>
        <li>Look for <strong>purple person icons</strong> for registration notifications</li>
        <li>Registration notifications should show: "New Guest Registration"</li>
    </ol>
    
    <p><strong>Expected in Flutter app:</strong></p>
    <ul>
        <li>🟣 Registration notifications (purple person icon)</li>
        <li>🟢 Check-in notifications (green login icon)</li>
        <li>🔵 Check-out notifications (blue logout icon)</li>
    </ul>
</body>
</html>