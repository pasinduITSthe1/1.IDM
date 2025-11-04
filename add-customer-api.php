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
        
        // Generate email if not provided
        if (empty($email)) {
            $email = strtolower($firstName . '.' . $lastName . '.' . time() . '@hotel.com');
        }
        
        // Generate phone if not provided
        if (empty($phone)) {
            $phone = '0000000000';
        }
        
        $timestamp = date('Y-m-d H:i:s');
        
        try {
            // Insert into qlo_customer table
            $stmt = $pdo->prepare("INSERT INTO qlo_customer (firstname, lastname, email, date_add, date_upd, active, deleted, is_guest) 
                                  VALUES (?, ?, ?, ?, ?, 1, 0, 0)");
            
            $result = $stmt->execute([
                $firstName,
                $lastName,
                $email,
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
                        $phone,
                        'Main Address',
                        $data['company'] ?? '',
                        $timestamp,
                        $timestamp
                    ]);
                }
                
                echo json_encode([
                    'success' => true,
                    'message' => 'Customer created successfully',
                    'customer' => [
                        'id' => $customerId,
                        'firstname' => $firstName,
                        'lastname' => $lastName,
                        'email' => $email,
                        'phone' => $phone,
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