<?php
/**
 * Mobile Staff App API Endpoints
 * Handles requests from the mobile staff application
 * Connects to QloApps backend
 */

// Enable CORS for mobile app
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
header('Content-Type: application/json');

// Handle preflight OPTIONS request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Load PrestaShop/QloApps configuration
require_once(dirname(__FILE__) . '/../../config/config.inc.php');
require_once(dirname(__FILE__) . '/../../init.php');

// Get request data
$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestUri = $_SERVER['REQUEST_URI'];
$requestData = json_decode(file_get_contents('php://input'), true);

// Get controller and action from request
$controller = isset($_GET['controller']) ? $_GET['controller'] : '';
$action = isset($_GET['action']) ? $_GET['action'] : '';

// Response helper function
function sendResponse($data, $statusCode = 200) {
    http_response_code($statusCode);
    echo json_encode($data);
    exit();
}

// Error response helper
function sendError($message, $statusCode = 400) {
    sendResponse([
        'success' => false,
        'error' => $message,
        'timestamp' => date('c'),
    ], $statusCode);
}

// Verify authentication token
function verifyToken() {
    $headers = getallheaders();
    $authHeader = isset($headers['Authorization']) ? $headers['Authorization'] : '';
    
    if (empty($authHeader)) {
        return false;
    }
    
    // Extract token from "Bearer <token>"
    $token = str_replace('Bearer ', '', $authHeader);
    
    // Verify token (implement your token verification logic)
    // For now, check if employee session is active
    if (!Context::getContext()->employee || !Context::getContext()->employee->id) {
        return false;
    }
    
    return true;
}

// ============================================
// AUTHENTICATION ENDPOINTS
// ============================================

if ($action === 'staffLogin') {
    $email = isset($requestData['email']) ? $requestData['email'] : '';
    $password = isset($requestData['passwd']) ? $requestData['passwd'] : '';
    
    if (empty($email) || empty($password)) {
        sendError('Email and password are required', 400);
    }
    
    // Authenticate employee
    $employee = new Employee();
    $authentication = $employee->getByEmail($email, $password);
    
    if (!$authentication || !$authentication->id) {
        sendError('Invalid credentials', 401);
    }
    
    // Check if employee is active
    if (!$authentication->active) {
        sendError('Account is inactive', 403);
    }
    
    // Generate token (simple implementation - enhance for production)
    $token = base64_encode($authentication->id . ':' . time() . ':' . md5($email . $password));
    
    // Set employee context
    Context::getContext()->employee = $authentication;
    
    sendResponse([
        'success' => true,
        'token' => $token,
        'user' => [
            'id' => $authentication->id,
            'firstname' => $authentication->firstname,
            'lastname' => $authentication->lastname,
            'email' => $authentication->email,
            'profile' => [
                'id' => $authentication->id_profile,
                'name' => $authentication->profile_name,
            ],
        ],
    ]);
}

if ($action === 'verifyToken') {
    if (!verifyToken()) {
        sendError('Invalid or expired token', 401);
    }
    
    sendResponse([
        'success' => true,
        'valid' => true,
    ]);
}

// ============================================
// CUSTOMER/GUEST ENDPOINTS
// ============================================

if ($controller === 'AdminCustomers') {
    // Verify authentication for all customer operations
    if (!verifyToken()) {
        sendError('Unauthorized', 401);
    }
    
    // Get all customers
    if ($action === 'getCustomers') {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 50;
        $offset = ($page - 1) * $limit;
        
        $sql = new DbQuery();
        $sql->select('c.*, a.address1, a.city, a.postcode, co.iso_code as country_code');
        $sql->from('customer', 'c');
        $sql->leftJoin('address', 'a', 'a.id_customer = c.id_customer AND a.deleted = 0');
        $sql->leftJoin('country', 'co', 'co.id_country = a.id_country');
        $sql->where('c.deleted = 0');
        $sql->orderBy('c.date_add DESC');
        $sql->limit($limit, $offset);
        
        $customers = Db::getInstance()->executeS($sql);
        
        sendResponse([
            'success' => true,
            'data' => $customers,
            'pagination' => [
                'page' => $page,
                'limit' => $limit,
                'total' => Customer::getCustomers(true),
            ],
        ]);
    }
    
    // Search customers
    if ($action === 'searchCustomers') {
        $query = isset($_GET['query']) ? pSQL($_GET['query']) : '';
        
        if (empty($query)) {
            sendError('Search query is required', 400);
        }
        
        $sql = new DbQuery();
        $sql->select('c.*, a.address1, a.city');
        $sql->from('customer', 'c');
        $sql->leftJoin('address', 'a', 'a.id_customer = c.id_customer AND a.deleted = 0');
        $sql->where('c.deleted = 0');
        $sql->where('(c.firstname LIKE "%' . $query . '%" 
                    OR c.lastname LIKE "%' . $query . '%" 
                    OR c.email LIKE "%' . $query . '%")');
        $sql->limit(20);
        
        $customers = Db::getInstance()->executeS($sql);
        
        sendResponse([
            'success' => true,
            'data' => $customers,
        ]);
    }
    
    // Get customer by ID
    if ($action === 'getCustomer') {
        $customerId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        
        if (!$customerId) {
            sendError('Customer ID is required', 400);
        }
        
        $customer = new Customer($customerId);
        
        if (!Validate::isLoadedObject($customer)) {
            sendError('Customer not found', 404);
        }
        
        $addresses = $customer->getAddresses((int)Configuration::get('PS_LANG_DEFAULT'));
        
        sendResponse([
            'success' => true,
            'data' => [
                'id' => $customer->id,
                'firstname' => $customer->firstname,
                'lastname' => $customer->lastname,
                'email' => $customer->email,
                'birthday' => $customer->birthday,
                'id_gender' => $customer->id_gender,
                'active' => $customer->active,
                'date_add' => $customer->date_add,
                'addresses' => $addresses,
            ],
        ]);
    }
    
    // Create new customer
    if ($action === 'addCustomer') {
        $customer = new Customer();
        $customer->firstname = isset($requestData['firstname']) ? pSQL($requestData['firstname']) : '';
        $customer->lastname = isset($requestData['lastname']) ? pSQL($requestData['lastname']) : '';
        $customer->email = isset($requestData['email']) ? pSQL($requestData['email']) : '';
        $customer->passwd = md5(pSQL(_COOKIE_KEY_ . rand()));
        $customer->id_gender = isset($requestData['id_gender']) ? (int)$requestData['id_gender'] : 0;
        $customer->birthday = isset($requestData['birthday']) ? pSQL($requestData['birthday']) : '0000-00-00';
        $customer->active = 1;
        
        // Validate email
        if (!Validate::isEmail($customer->email)) {
            sendError('Invalid email address', 400);
        }
        
        // Check if email already exists
        if (Customer::customerExists($customer->email)) {
            sendError('Email already exists', 409);
        }
        
        // Save customer
        if (!$customer->add()) {
            sendError('Failed to create customer', 500);
        }
        
        // Create address if provided
        if (isset($requestData['address1']) && !empty($requestData['address1'])) {
            $address = new Address();
            $address->id_customer = $customer->id;
            $address->alias = 'Main Address';
            $address->firstname = $customer->firstname;
            $address->lastname = $customer->lastname;
            $address->address1 = pSQL($requestData['address1']);
            $address->city = isset($requestData['city']) ? pSQL($requestData['city']) : '';
            $address->postcode = isset($requestData['postcode']) ? pSQL($requestData['postcode']) : '';
            $address->id_country = isset($requestData['id_country']) ? (int)$requestData['id_country'] : (int)Configuration::get('PS_COUNTRY_DEFAULT');
            $address->phone_mobile = isset($requestData['phone']) ? pSQL($requestData['phone']) : '';
            
            $address->add();
        }
        
        sendResponse([
            'success' => true,
            'message' => 'Customer created successfully',
            'data' => [
                'id' => $customer->id,
                'firstname' => $customer->firstname,
                'lastname' => $customer->lastname,
                'email' => $customer->email,
            ],
        ], 201);
    }
}

// ============================================
// BOOKING/ORDER ENDPOINTS
// ============================================

if ($controller === 'AdminOrders') {
    if (!verifyToken()) {
        sendError('Unauthorized', 401);
    }
    
    // Get all orders
    if ($action === 'getOrders') {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 50;
        $offset = ($page - 1) * $limit;
        
        $sql = new DbQuery();
        $sql->select('o.*, c.firstname, c.lastname, c.email');
        $sql->from('orders', 'o');
        $sql->leftJoin('customer', 'c', 'c.id_customer = o.id_customer');
        $sql->orderBy('o.date_add DESC');
        $sql->limit($limit, $offset);
        
        $orders = Db::getInstance()->executeS($sql);
        
        sendResponse([
            'success' => true,
            'data' => $orders,
        ]);
    }
}

// ============================================
// DASHBOARD ENDPOINTS
// ============================================

if ($controller === 'AdminDashboard') {
    if (!verifyToken()) {
        sendError('Unauthorized', 401);
    }
    
    if ($action === 'getStats') {
        $today = date('Y-m-d');
        
        // Get today's check-ins
        $checkIns = Db::getInstance()->getValue('
            SELECT COUNT(*) 
            FROM ' . _DB_PREFIX_ . 'htl_booking_detail 
            WHERE DATE(date_from) = "' . pSQL($today) . '"
        ');
        
        // Get today's check-outs
        $checkOuts = Db::getInstance()->getValue('
            SELECT COUNT(*) 
            FROM ' . _DB_PREFIX_ . 'htl_booking_detail 
            WHERE DATE(date_to) = "' . pSQL($today) . '"
        ');
        
        // Get active guests
        $activeGuests = Db::getInstance()->getValue('
            SELECT COUNT(*) 
            FROM ' . _DB_PREFIX_ . 'htl_booking_detail 
            WHERE date_from <= "' . pSQL($today) . '" 
            AND date_to >= "' . pSQL($today) . '"
        ');
        
        sendResponse([
            'success' => true,
            'data' => [
                'todayCheckIns' => (int)$checkIns,
                'todayCheckOuts' => (int)$checkOuts,
                'activeGuests' => (int)$activeGuests,
                'pendingActions' => 0,
            ],
        ]);
    }
}

// Default response for unknown endpoints
sendError('Endpoint not found', 404);
