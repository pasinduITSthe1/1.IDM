<!DOCTYPE html>
<html>
<head>
    <title>Real-time Notifications Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; background: #f5f5f5; }
        .container { max-width: 800px; margin: 0 auto; }
        .notification { padding: 15px; margin: 10px 0; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .registration { background: #f8f4fd; border-left: 4px solid #8E44AD; }
        .checkin { background: #f0fdf4; border-left: 4px solid #00B894; }
        .checkout { background: #eff6ff; border-left: 4px solid #0984E3; }
        .status { padding: 10px; margin: 10px 0; border-radius: 5px; }
        .success { background: #d4edda; color: #155724; }
        .error { background: #f8d7da; color: #721c24; }
        .controls { margin: 20px 0; }
        button { padding: 10px 20px; margin: 5px; border: none; border-radius: 5px; cursor: pointer; }
        .refresh-btn { background: #007cba; color: white; }
        .auto-btn { background: #28a745; color: white; }
        .count { font-weight: bold; color: #333; }
    </style>
</head>
<body>
    <div class="container">
        <h2>🔔 Real-time Hotel Notifications Dashboard</h2>
        
        <div class="controls">
            <button class="refresh-btn" onclick="loadNotifications()">🔄 Refresh Now</button>
            <button class="auto-btn" id="autoToggle" onclick="toggleAutoRefresh()">▶️ Start Auto-refresh</button>
            <button class="refresh-btn" onclick="syncFromQloApps()">🔄 Sync from QloApps</button>
        </div>
        
        <div id="status" class="status"></div>
        <div id="counts" style="margin: 15px 0;"></div>
        <div id="notifications"></div>
    </div>

    <script>
        let autoRefreshInterval = null;
        let isAutoRefreshActive = false;

        async function loadNotifications() {
            try {
                const response = await fetch('/1.IDM/custom-api/get-notifications.php');
                const data = await response.json();
                
                if (data.success) {
                    displayNotifications(data.notifications);
                    showStatus(`✅ Loaded ${data.count} notifications`, 'success');
                    updateCounts(data.notifications);
                } else {
                    showStatus('❌ Failed to load notifications', 'error');
                }
            } catch (error) {
                showStatus('❌ Error: ' + error.message, 'error');
            }
        }

        async function syncFromQloApps() {
            try {
                showStatus('🔄 Syncing from QloApps...', 'success');
                const response = await fetch('/1.IDM/custom-api/sync-real-notifications.php');
                const data = await response.json();
                
                if (data.success) {
                    showStatus(`✅ Sync completed: ${data.data.total_created} new notifications`, 'success');
                    setTimeout(loadNotifications, 1000); // Reload after sync
                } else {
                    showStatus('❌ Sync failed: ' + data.message, 'error');
                }
            } catch (error) {
                showStatus('❌ Sync error: ' + error.message, 'error');
            }
        }

        function displayNotifications(notifications) {
            const container = document.getElementById('notifications');
            container.innerHTML = '';
            
            notifications.forEach(notification => {
                const div = document.createElement('div');
                div.className = `notification ${notification.type}`;
                
                const readStatus = notification.is_read ? '✓ Read' : '● Unread';
                const readClass = notification.is_read ? 'read' : 'unread';
                
                div.innerHTML = `
                    <div style="display: flex; justify-content: between; align-items: center;">
                        <div style="flex: 1;">
                            <strong>${notification.title}</strong>
                            <div style="margin: 5px 0; color: #666;">${notification.message}</div>
                            <small>Type: ${notification.type} | Time: ${notification.timestamp} | ${readStatus}</small>
                        </div>
                    </div>
                `;
                
                container.appendChild(div);
            });
        }

        function updateCounts(notifications) {
            const counts = {};
            let unreadCount = 0;
            
            notifications.forEach(n => {
                counts[n.type] = (counts[n.type] || 0) + 1;
                if (!n.is_read) unreadCount++;
            });
            
            const countsDiv = document.getElementById('counts');
            countsDiv.innerHTML = `
                <div class="count">
                    📊 Total: ${notifications.length} | 
                    🔴 Unread: ${unreadCount} | 
                    🟣 Registrations: ${counts.registration || 0} | 
                    🟢 Check-ins: ${counts.checkin || 0} | 
                    🔵 Check-outs: ${counts.checkout || 0}
                </div>
            `;
        }

        function showStatus(message, type) {
            const statusDiv = document.getElementById('status');
            statusDiv.textContent = message;
            statusDiv.className = `status ${type}`;
            
            setTimeout(() => {
                statusDiv.textContent = '';
                statusDiv.className = 'status';
            }, 3000);
        }

        function toggleAutoRefresh() {
            const button = document.getElementById('autoToggle');
            
            if (isAutoRefreshActive) {
                clearInterval(autoRefreshInterval);
                button.textContent = '▶️ Start Auto-refresh';
                button.style.background = '#28a745';
                isAutoRefreshActive = false;
                showStatus('⏸️ Auto-refresh stopped', 'success');
            } else {
                autoRefreshInterval = setInterval(() => {
                    loadNotifications();
                }, 5000); // Every 5 seconds
                button.textContent = '⏸️ Stop Auto-refresh';
                button.style.background = '#dc3545';
                isAutoRefreshActive = true;
                showStatus('▶️ Auto-refresh started (5s interval)', 'success');
            }
        }

        // Load notifications on page load
        loadNotifications();
    </script>
</body>
</html>