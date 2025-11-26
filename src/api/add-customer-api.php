<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}

// Database configuration
$host = 'localhost';
$db = '1.IDM_db';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Handle POST request for creating new customer
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get JSON input
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);
        
        if (!$data) {
            echo json_encode([
                'success' => false,
                'message' => 'Invalid JSON data'
            ]);
            exit;
        }
        
        // Extract customer data
        $firstName = $data['firstName'] ?? '';
        $lastName = $data['lastName'] ?? '';
        $email = $data['email'] ?? '';
        $phone = $data['phone'] ?? '';
        $dateOfBirth = $data['dateOfBirth'] ?? null;
        
        // Validate required fields
        if (empty($firstName) || empty($lastName)) {
            echo json_encode([
                'success' => false,
                'message' => 'First name and last name are required'
            ]);
            exit;
        }
        
        // Store original email for response (might be empty/null)
        $originalEmail = $email;
        
        // QloApps requires email to be unique, so generate temp one only for DB
        if (empty($email)) {
            // Use a temp email format that's clearly temporary
            $email = 'noemail_' . time() . '_' . rand(1000, 9999) . '@temp.local';
        }
        
        $timestamp = date('Y-m-d H:i:s');
        
        try {
            // Insert into qlo_customer table
            $stmt = $pdo->prepare("INSERT INTO qlo_customer (firstname, lastname, email, date_add, date_upd, active, deleted, is_guest) 
                                  VALUES (?, ?, ?, ?, ?, 1, 0, 0)");
            
            $result = $stmt->execute([
                $firstName,
                $lastName,
                $email, // Use generated temp email for DB
                $timestamp,
                $timestamp
            ]);
            
            if ($result) {
                $customerId = $pdo->lastInsertId();
                
                // Optionally add address record (if address data is provided)
                if (!empty($data['address1']) || !empty($data['city'])) {
                    $addressStmt = $pdo->prepare("INSERT INTO qlo_address (id_customer, id_country, firstname, lastname, address1, address2, city, postcode, phone, alias, company, date_add, date_upd, active, deleted) 
                                                 VALUES (?, 197, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 1, 0)");
                    $addressStmt->execute([
                        $customerId,
                        $firstName,
                        $lastName,
                        $data['address1'] ?? '',
                        $data['address2'] ?? '',
                        $data['city'] ?? '',
                        $data['postcode'] ?? '',
                        !empty($phone) ? $phone : '',
                        'Main Address',
                        $data['company'] ?? '',
                        $timestamp,
                        $timestamp
                    ]);
                }
                
                // Include notification helper
                include_once '../custom-api/create-notification.php';
                
                // Create notification for new guest registration
                $guestName = trim($firstName . ' ' . $lastName);
                createGuestRegistrationNotification($pdo, $guestName, $customerId);
                
                // Return null for email/phone if they were empty originally
                echo json_encode([
                    'success' => true,
                    'message' => 'Customer created successfully',
                    'customer' => [
                        'id' => $customerId,
                        'firstname' => $firstName,
                        'lastname' => $lastName,
                        'email' => !empty($originalEmail) ? $originalEmail : null,
                        'phone' => !empty($phone) ? $phone : null,
                        'date_add' => $timestamp
                    ]
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Failed to create customer'
                ]);
            }
            
        } catch (PDOException $e) {
            echo json_encode([
                'success' => false,
                'message' => 'Database error: ' . $e->getMessage()
            ]);
        }
        
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Method not allowed. Use POST to create customers.'
        ]);
    }
    
} catch (PDOException $e) {
    echo json_encode([
        'error' => true,
        'message' => 'Database connection error: ' . $e->getMessage()
    ]);
} catch (Exception $e) {
    echo json_encode([
        'error' => true,
        'message' => 'Error: ' . $e->getMessage()
    ]);
}
?>