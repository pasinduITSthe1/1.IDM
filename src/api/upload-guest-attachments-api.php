<?php
/**
 * Guest Attachments API
 * Saves guest attachment records (ID photos, documents) to database
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Handle preflight
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Database connection
require_once dirname(__FILE__) . '/../../config/config.inc.php';

$db_server = _DB_SERVER_;
$db_name = _DB_NAME_;
$db_user = _DB_USER_;
$db_password = _DB_PASSWD_;

try {
    $conn = new PDO(
        "mysql:host=$db_server;dbname=$db_name;charset=utf8",
        $db_user,
        $db_password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Database connection failed: ' . $e->getMessage()
    ]);
    exit;
}

// POST: Save attachment record
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Get JSON input
        $input = json_decode(file_get_contents('php://input'), true);
        
        if (!$input) {
            throw new Exception('Invalid JSON input');
        }

        // Validate required fields
        $customerId = $input['id_customer'] ?? null;
        $attachmentType = $input['attachment_type'] ?? null;
        $filePath = $input['file_path'] ?? null;

        if (!$customerId || !$attachmentType || !$filePath) {
            throw new Exception('Missing required fields: id_customer, attachment_type, file_path');
        }

        // Insert attachment record
        $sql = "INSERT INTO guest_attachments 
                (id_customer, attachment_type, file_path, upload_date) 
                VALUES (:id_customer, :attachment_type, :file_path, NOW())";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':id_customer' => $customerId,
            ':attachment_type' => $attachmentType,
            ':file_path' => $filePath
        ]);

        $attachmentId = $conn->lastInsertId();

        // Return success response
        echo json_encode([
            'success' => true,
            'message' => 'Attachment saved successfully',
            'data' => [
                'id' => $attachmentId,
                'id_customer' => $customerId,
                'attachment_type' => $attachmentType,
                'file_path' => $filePath,
                'upload_date' => date('Y-m-d H:i:s')
            ]
        ]);

    } catch (Exception $e) {
        http_response_code(400);
        echo json_encode([
            'success' => false,
            'message' => $e->getMessage()
        ]);
    }
}

// GET: Retrieve attachments for a customer
elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    try {
        $customerId = $_GET['id_customer'] ?? null;

        if (!$customerId) {
            throw new Exception('Missing id_customer parameter');
        }

        // Get all attachments for this customer
        $sql = "SELECT * FROM guest_attachments 
                WHERE id_customer = :id_customer 
                ORDER BY upload_date DESC";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute([':id_customer' => $customerId]);
        $attachments = $stmt->fetchAll();

        echo json_encode([
            'success' => true,
            'data' => $attachments,
            'count' => count($attachments)
        ]);

    } catch (Exception $e) {
        http_response_code(400);
        echo json_encode([
            'success' => false,
            'message' => $e->getMessage()
        ]);
    }
}

else {
    http_response_code(405);
    echo json_encode([
        'success' => false,
        'message' => 'Method not allowed'
    ]);
}
