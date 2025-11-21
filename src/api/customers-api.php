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
    
    // Handle GET request for customers list
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        // Get customers from qlo_customer table (primary source)
        // LEFT JOIN with address table to get address info if available
        // LEFT JOIN with guest table to get session info
        $sql = "SELECT 
                    c.id_customer as id,
                    c.firstname,
                    c.lastname,
                    c.email,
                    c.date_add,
                    c.active,
                    a.address1,
                    a.address2,
                    a.city,
                    a.postcode,
                    a.phone,
                    a.phone_mobile,
                    a.alias,
                    a.company,
                    g.id_guest,
                    g.accept_language
                FROM qlo_customer c
                LEFT JOIN qlo_address a ON c.id_customer = a.id_customer AND a.deleted = 0
                LEFT JOIN qlo_guest g ON c.id_customer = g.id_customer
                WHERE c.deleted = 0 AND c.active = 1
                GROUP BY c.id_customer
                ORDER BY c.date_add DESC 
                LIMIT 100";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $customers = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Format to match expected structure with additional address info
        $formattedCustomers = [];
        foreach ($customers as $customer) {
            // Filter out temp emails - return null instead
            $email = $customer['email'];
            if (strpos($email, '@temp.local') !== false || 
                strpos($email, 'noemail_') !== false ||
                strpos($email, '@hotel.com') !== false) {
                $email = null;
            }
            
            // Filter out placeholder phone numbers
            $phone = $customer['phone'] ?: $customer['phone_mobile'] ?: '';
            if ($phone === '0000000000' || empty($phone)) {
                $phone = null;
            }
            
            $formattedCustomers[] = [
                'id' => $customer['id'],
                'firstname' => $customer['firstname'],
                'lastname' => $customer['lastname'],
                'email' => $email, // Return null if temp email
                'phone' => $phone, // Return null if placeholder or empty
                'address1' => $customer['address1'] ?: '',
                'address2' => $customer['address2'] ?: '',
                'city' => $customer['city'] ?: '',
                'postcode' => $customer['postcode'] ?: '',
                'alias' => $customer['alias'] ?: '',
                'company' => $customer['company'] ?: '',
                'date_add' => $customer['date_add'],
                'active' => $customer['active'],
                'has_session' => !is_null($customer['id_guest']),
                'language' => $customer['accept_language'] ?: ''
            ];
        }
        
        echo json_encode([
            'customers' => $formattedCustomers,
            'total' => count($formattedCustomers),
            'source' => 'qlo_customer table (with address data if available)'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Method not allowed'
        ]);
    }
    
} catch (PDOException $e) {
    echo json_encode([
        'error' => true,
        'message' => 'Database error: ' . $e->getMessage()
    ]);
} catch (Exception $e) {
    echo json_encode([
        'error' => true,
        'message' => 'Error: ' . $e->getMessage()
    ]);
}
?>