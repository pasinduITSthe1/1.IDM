<!DOCTYPE html>
<html>
<head>
    <title>Flutter Notification Test</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        .test-result { padding: 15px; margin: 10px 0; border-radius: 8px; }
        .success { background: #d4edda; color: #155724; }
        .error { background: #f8d7da; color: #721c24; }
        .info { background: #d1ecf1; color: #0c5460; }
        button { padding: 10px 20px; margin: 5px; border: none; border-radius: 5px; cursor: pointer; background: #007cba; color: white; }
        .notification { padding: 10px; margin: 5px; border-left: 4px solid; background: #f8f9fa; }
        .registration { border-color: #8E44AD; }
        .checkin { border-color: #00B894; }
        .checkout { border-color: #0984E3; }
    </style>
</head>
<body>
    <h2>🔔 Flutter App Notification Debugging</h2>
    
    <div class="info test-result">
        <strong>Instructions for Flutter App:</strong><br>
        1. Open notifications screen in your Flutter app<br>
        2. Tap the refresh button (🔄) in the top-right corner<br>
        3. Wait 10 seconds for auto-refresh to trigger<br>
        4. Check if registration notifications appear with purple person icons
    </div>
    
    <button onclick="testEndpoint()">Test API Endpoint</button>
    <button onclick="createTestNotification()">Create Test Registration</button>
    <button onclick="clearResults()">Clear Results</button>
    
    <div id="results"></div>

    <script>
        async function testEndpoint() {
            const resultsDiv = document.getElementById('results');
            
            try {
                resultsDiv.innerHTML += '<div class="info test-result">Testing Flutter notification endpoint...</div>';
                
                const response = await fetch('/1.IDM/custom-api/get-notifications.php');
                const data = await response.json();
                
                if (data.success) {
                    const registrations = data.notifications.filter(n => n.type === 'registration');
                    const checkins = data.notifications.filter(n => n.type === 'checkin');
                    const checkouts = data.notifications.filter(n => n.type === 'checkout');
                    
                    resultsDiv.innerHTML += `
                        <div class="success test-result">
                            <strong>✅ API Test Successful!</strong><br>
                            Total: ${data.count} notifications<br>
                            📧 Registrations: ${registrations.length}<br>
                            🟢 Check-ins: ${checkins.length}<br>
                            🔵 Check-outs: ${checkouts.length}
                        </div>
                    `;
                    
                    // Show recent registrations
                    resultsDiv.innerHTML += '<h3>Recent Registration Notifications:</h3>';
                    registrations.slice(0, 5).forEach(notification => {
                        resultsDiv.innerHTML += `
                            <div class="notification registration">
                                <strong>${notification.title}</strong><br>
                                ${notification.message}<br>
                                <small>ID: ${notification.id} | Time: ${notification.timestamp}</small>
                            </div>
                        `;
                    });
                    
                } else {
                    resultsDiv.innerHTML += `<div class="error test-result">❌ API Error: ${data.message}</div>`;
                }
            } catch (error) {
                resultsDiv.innerHTML += `<div class="error test-result">❌ Network Error: ${error.message}</div>`;
            }
        }
        
        async function createTestNotification() {
            const resultsDiv = document.getElementById('results');
            
            try {
                const customerData = {
                    firstName: 'Test',
                    lastName: 'User' + Math.floor(Math.random() * 1000),
                    email: `test${Math.floor(Math.random() * 1000)}@example.com`
                };
                
                resultsDiv.innerHTML += '<div class="info test-result">Creating test customer registration...</div>';
                
                const response = await fetch('/1.IDM/custom-api/test-customer-registration.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(customerData)
                });
                
                const result = await response.json();
                
                if (result.success) {
                    resultsDiv.innerHTML += `
                        <div class="success test-result">
                            <strong>✅ Test Customer Created!</strong><br>
                            Name: ${result.data.name}<br>
                            ID: ${result.data.customer_id}<br>
                            <br>
                            <strong>📱 Check your Flutter app now!</strong><br>
                            The new registration notification should appear within 10 seconds.
                        </div>
                    `;
                } else {
                    resultsDiv.innerHTML += `<div class="error test-result">❌ Failed to create customer: ${result.message}</div>`;
                }
            } catch (error) {
                resultsDiv.innerHTML += `<div class="error test-result">❌ Error creating customer: ${error.message}</div>`;
            }
        }
        
        function clearResults() {
            document.getElementById('results').innerHTML = '';
        }
        
        // Auto-test on load
        window.onload = function() {
            testEndpoint();
        };
    </script>
</body>
</html>