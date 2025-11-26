<?php
// Quick customer registration test
header('Content-Type: text/html');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = $_POST['firstName'] ?? '';
    $lastName = $_POST['lastName'] ?? '';
    $email = $_POST['email'] ?? '';
    
    if ($firstName && $lastName && $email) {
        try {
            $host = 'localhost';
            $dbname = '1.idm_db';
            $username = 'root';
            $password = '';
            
            $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Insert customer
            $stmt = $pdo->prepare("
                INSERT INTO qlo_customer (firstname, lastname, email, date_add, date_upd, active) 
                VALUES (?, ?, ?, NOW(), NOW(), 1)
            ");
            $stmt->execute([$firstName, $lastName, $email]);
            $customerId = $pdo->lastInsertId();
            
            // Create notification
            include_once 'create-notification.php';
            createGuestRegistrationNotification($pdo, "$firstName $lastName", $customerId);
            
            $message = "✅ Customer registered successfully! Check your Flutter app.";
        } catch (Exception $e) {
            $message = "❌ Error: " . $e->getMessage();
        }
    } else {
        $message = "❌ Please fill all fields.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Test Customer Registration</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 500px; margin: 50px auto; padding: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; }
        button { width: 100%; padding: 12px; background: #007cba; color: white; border: none; border-radius: 5px; cursor: pointer; }
        button:hover { background: #005a8a; }
        .message { padding: 15px; margin: 20px 0; border-radius: 5px; }
        .success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
    </style>
</head>
<body>
    <h2>🏨 Test Customer Registration</h2>
    <p>This simulates a customer registering in QloApps and will create a real-time notification in your Flutter app.</p>
    
    <?php if (isset($message)): ?>
        <div class="message <?= strpos($message, '✅') !== false ? 'success' : 'error' ?>">
            <?= $message ?>
        </div>
    <?php endif; ?>
    
    <form method="POST">
        <div class="form-group">
            <label>First Name:</label>
            <input type="text" name="firstName" required placeholder="Enter first name">
        </div>
        <div class="form-group">
            <label>Last Name:</label>
            <input type="text" name="lastName" required placeholder="Enter last name">
        </div>
        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" required placeholder="Enter email address">
        </div>
        <button type="submit">Register Customer</button>
    </form>
    
    <hr style="margin: 30px 0;">
    <p><strong>📱 Check your Flutter app notifications after registration!</strong></p>
    <p><small>This test adds a customer to QloApps database and creates a notification that appears in your hotel staff app.</small></p>
</body>
</html>