<?php
// Test customer registration notification (simulate QloApps registration)
header('Content-Type: application/json');

// Allow CORS
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    
    $firstName = $input['firstName'] ?? 'Test';
    $lastName = $input['lastName'] ?? 'Customer';
    $email = $input['email'] ?? 'test@example.com';
    
    try {
        $host = 'localhost';
        $dbname = '1.idm_db';
        $username = 'root';
        $password = '';
        
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Insert into QloApps customer table (simulate registration)
        $stmt = $pdo->prepare("
            INSERT INTO qlo_customer (
                firstname, 
                lastname, 
                email, 
                date_add, 
                date_upd,
                active
            ) VALUES (?, ?, ?, NOW(), NOW(), 1)
        ");
        $stmt->execute([$firstName, $lastName, $email]);
        $customerId = $pdo->lastInsertId();
        
        // Create notification using hook
        include_once 'qloapps-hooks.php';
        notifyCustomerRegistration($customerId, $firstName, $lastName);
        
        echo json_encode([
            'success' => true,
            'message' => 'Customer registered and notification created',
            'data' => [
                'customer_id' => $customerId,
                'name' => "$firstName $lastName",
                'email' => $email
            ]
        ]);
        
    } catch (PDOException $e) {
        echo json_encode([
            'success' => false,
            'message' => 'Registration error: ' . $e->getMessage()
        ]);
    }
} else {
    // GET request - show registration form
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Test Customer Registration</title>
        <style>
            body { font-family: Arial; padding: 20px; }
            .form-group { margin-bottom: 15px; }
            label { display: block; margin-bottom: 5px; }
            input { padding: 8px; width: 300px; border: 1px solid #ddd; }
            button { padding: 10px 20px; background: #007cba; color: white; border: none; cursor: pointer; }
            .result { margin-top: 20px; padding: 10px; background: #f0f0f0; }
        </style>
    </head>
    <body>
        <h2>Test Customer Registration (QloApps Simulation)</h2>
        <form id="registrationForm">
            <div class="form-group">
                <label>First Name:</label>
                <input type="text" id="firstName" value="John" required>
            </div>
            <div class="form-group">
                <label>Last Name:</label>
                <input type="text" id="lastName" value="Doe" required>
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" id="email" value="john.doe@example.com" required>
            </div>
            <button type="submit">Register Customer</button>
        </form>
        
        <div id="result" class="result" style="display: none;"></div>
        
        <script>
            document.getElementById('registrationForm').addEventListener('submit', async function(e) {
                e.preventDefault();
                
                const firstName = document.getElementById('firstName').value;
                const lastName = document.getElementById('lastName').value;
                const email = document.getElementById('email').value;
                
                try {
                    const response = await fetch('', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ firstName, lastName, email })
                    });
                    
                    const result = await response.json();
                    const resultDiv = document.getElementById('result');
                    resultDiv.style.display = 'block';
                    resultDiv.innerHTML = '<pre>' + JSON.stringify(result, null, 2) + '</pre>';
                    
                    if (result.success) {
                        // Clear form
                        document.getElementById('firstName').value = '';
                        document.getElementById('lastName').value = '';
                        document.getElementById('email').value = '';
                        
                        alert('Customer registered! Check your Flutter app notifications.');
                    }
                } catch (error) {
                    document.getElementById('result').innerHTML = 'Error: ' + error.message;
                }
            });
        </script>
    </body>
    </html>
    <?php
}
?>