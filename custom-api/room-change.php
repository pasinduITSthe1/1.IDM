<?php
/**
 * Room Change API - Custom API (bypasses PrestaShop webservice auth)
 * Created for Hotel Staff Flutter App
 * Handles guest room changes when they need to be moved to a different room
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Database connection
$host = 'localhost';
$dbname = '1.IDM_db';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Database connection failed: ' . $e->getMessage()
    ]);
    exit;
}

class RoomChangeAPI {
    private $pdo;
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    
    /**
     * Get all room changes with filters
     */
    public function getAllRoomChanges($status = null, $limit = 100, $offset = 0) {
        try {
            $sql = "SELECT 
                    rc.*,
                    old_room.room_num as old_room_number,
                    new_room.room_num as new_room_number,
                    bd.id_order,
                    bd.id_hotel,
                    bd.date_from as booking_check_in,
                    bd.date_to as booking_check_out,
                    DATEDIFF(bd.date_to, bd.date_from) as total_nights
                FROM roomchange rc
                LEFT JOIN qlo_htl_room_information old_room ON rc.old_room_id = old_room.id
                LEFT JOIN qlo_htl_room_information new_room ON rc.new_room_id = new_room.id
                LEFT JOIN qlo_htl_booking_detail bd ON rc.booking_id = bd.id
                WHERE 1=1";
            
            if ($status && in_array($status, ['pending', 'completed', 'cancelled'])) {
                $sql .= " AND rc.status = :status";
            }
            
            $sql .= " ORDER BY rc.change_date DESC, rc.created_at DESC";
            $sql .= " LIMIT :limit OFFSET :offset";
            
            $stmt = $this->pdo->prepare($sql);
            
            if ($status && in_array($status, ['pending', 'completed', 'cancelled'])) {
                $stmt->bindValue(':status', $status, PDO::PARAM_STR);
            }
            $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
            $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
            
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return [
                'success' => true,
                'data' => $results,
                'count' => count($results)
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'error' => 'Failed to fetch room changes: ' . $e->getMessage()
            ];
        }
    }
    
    /**
     * Get room change by ID
     */
    public function getRoomChangeById($id) {
        try {
            $sql = "SELECT 
                    rc.*,
                    old_room.room_num as old_room_number,
                    old_room.id_product as old_room_product_id,
                    new_room.room_num as new_room_number,
                    new_room.id_product as new_room_product_id,
                    bd.id_order,
                    bd.id_hotel,
                    bd.date_from as booking_check_in,
                    bd.date_to as booking_check_out,
                    bd.adults,
                    bd.children
                FROM roomchange rc
                LEFT JOIN qlo_htl_room_information old_room ON rc.old_room_id = old_room.id
                LEFT JOIN qlo_htl_room_information new_room ON rc.new_room_id = new_room.id
                LEFT JOIN qlo_htl_booking_detail bd ON rc.booking_id = bd.id
                WHERE rc.id = :id";
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
            $stmt->execute();
            
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($result) {
                return [
                    'success' => true,
                    'data' => $result
                ];
            } else {
                return [
                    'success' => false,
                    'error' => 'Room change not found'
                ];
            }
        } catch (Exception $e) {
            return [
                'success' => false,
                'error' => 'Failed to fetch room change: ' . $e->getMessage()
            ];
        }
    }
    
    /**
     * Create a new room change request
     */
    public function createRoomChange($data) {
        try {
            // Validate required fields
            $required = ['old_room_id', 'new_room_id', 'change_reason', 'changed_by'];
            foreach ($required as $field) {
                if (!isset($data[$field]) || $data[$field] === '') {
                    return [
                        'success' => false,
                        'error' => "Missing required field: $field"
                    ];
                }
            }
            
            // Get booking_id if provided, otherwise use 0 for app-based check-ins
            $booking_id = isset($data['booking_id']) ? (int)$data['booking_id'] : 0;
            
            // Get room numbers
            $stmt = $this->pdo->prepare("SELECT room_num FROM qlo_htl_room_information WHERE id = :id");
            
            $stmt->execute([':id' => (int)$data['old_room_id']]);
            $oldRoom = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $stmt->execute([':id' => (int)$data['new_room_id']]);
            $newRoom = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if (!$oldRoom || !$newRoom) {
                return [
                    'success' => false,
                    'error' => 'Invalid room ID'
                ];
            }
            
            // Check if new room is available (not occupied)
            $checkStmt = $this->pdo->prepare("
                SELECT ri.id, ri.room_num,
                    CASE 
                        WHEN ri.id_status = 2 THEN 1
                        WHEN EXISTS (
                            SELECT 1 FROM qlo_htl_booking_detail bd
                            WHERE bd.id_room = ri.id 
                            AND bd.booking_type = 1 
                            AND DATE(NOW()) BETWEEN DATE(bd.date_from) AND DATE(bd.date_to)
                        ) THEN 1
                        WHEN EXISTS (
                            SELECT 1 FROM guest_checkins gc
                            WHERE gc.id_room = ri.id 
                            AND NOT EXISTS (
                                SELECT 1 FROM guest_checkouts 
                                WHERE id_checkin = gc.id
                            )
                        ) THEN 1
                        ELSE 0
                    END as is_occupied
                FROM qlo_htl_room_information ri
                WHERE ri.id = :room_id
            ");
            $checkStmt->execute([':room_id' => (int)$data['new_room_id']]);
            $roomCheck = $checkStmt->fetch(PDO::FETCH_ASSOC);
            
            if ($roomCheck && $roomCheck['is_occupied'] == 1) {
                return [
                    'success' => false,
                    'error' => 'Selected room is currently occupied'
                ];
            }
            
            // Start transaction
            $this->pdo->beginTransaction();
            
            try {
                // Insert room change record
                $insertSql = "INSERT INTO roomchange (
                    booking_id,
                    old_room_id,
                    new_room_id,
                    old_room_num,
                    new_room_num,
                    guest_name,
                    change_reason,
                    changed_by,
                    change_date,
                    status,
                    notes,
                    created_at
                ) VALUES (
                    :booking_id,
                    :old_room_id,
                    :new_room_id,
                    :old_room_num,
                    :new_room_num,
                    :guest_name,
                    :change_reason,
                    :changed_by,
                    :change_date,
                    :status,
                    :notes,
                    NOW()
                )";
                
                $stmt = $this->pdo->prepare($insertSql);
                
                $stmt->execute([
                    ':booking_id' => $booking_id,
                    ':old_room_id' => (int)$data['old_room_id'],
                    ':new_room_id' => (int)$data['new_room_id'],
                    ':old_room_num' => $oldRoom['room_num'],
                    ':new_room_num' => $newRoom['room_num'],
                    ':guest_name' => $data['guest_name'] ?? '',
                    ':change_reason' => $data['change_reason'],
                    ':changed_by' => $data['changed_by'],
                    ':change_date' => date('Y-m-d H:i:s'),
                    ':status' => $data['status'] ?? 'pending',
                    ':notes' => $data['notes'] ?? ''
                ]);
                
                $roomChangeId = $this->pdo->lastInsertId();
                
                // If status is 'completed', update the guest check-in record if exists
                if (isset($data['status']) && $data['status'] === 'completed') {
                    // Update guest_checkins table
                    $updateCheckinSql = "UPDATE guest_checkins 
                                        SET id_room = :new_room_id 
                                        WHERE id_room = :old_room_id 
                                        AND NOT EXISTS (
                                            SELECT 1 FROM guest_checkouts WHERE id_checkin = guest_checkins.id
                                        )
                                        ORDER BY id DESC LIMIT 1";
                    
                    $updateStmt = $this->pdo->prepare($updateCheckinSql);
                    $updateStmt->execute([
                        ':new_room_id' => (int)$data['new_room_id'],
                        ':old_room_id' => (int)$data['old_room_id']
                    ]);
                    
                    // Also update booking detail if booking_id is provided
                    if ($booking_id > 0) {
                        $updateBookingSql = "UPDATE qlo_htl_booking_detail 
                                            SET id_room = :new_room_id 
                                            WHERE id = :booking_id";
                        
                        $bookingStmt = $this->pdo->prepare($updateBookingSql);
                        $bookingStmt->execute([
                            ':new_room_id' => (int)$data['new_room_id'],
                            ':booking_id' => $booking_id
                        ]);
                    }
                }
                
                // Commit transaction
                $this->pdo->commit();
                
                return [
                    'success' => true,
                    'message' => 'Room change created successfully',
                    'data' => [
                        'id' => $roomChangeId,
                        'old_room_num' => $oldRoom['room_num'],
                        'new_room_num' => $newRoom['room_num']
                    ]
                ];
                
            } catch (Exception $e) {
                $this->pdo->rollBack();
                throw $e;
            }
            
        } catch (Exception $e) {
            return [
                'success' => false,
                'error' => 'Failed to create room change: ' . $e->getMessage()
            ];
        }
    }
    
    /**
     * Update room change status
     */
    public function updateRoomChangeStatus($id, $status, $notes = null) {
        try {
            if (!in_array($status, ['pending', 'completed', 'cancelled'])) {
                return [
                    'success' => false,
                    'error' => 'Invalid status'
                ];
            }
            
            // Get the room change details
            $stmt = $this->pdo->prepare("SELECT * FROM roomchange WHERE id = :id");
            $stmt->execute([':id' => (int)$id]);
            $roomChange = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if (!$roomChange) {
                return [
                    'success' => false,
                    'error' => 'Room change not found'
                ];
            }
            
            // Start transaction
            $this->pdo->beginTransaction();
            
            try {
                // Update room change status
                $updateSql = "UPDATE roomchange SET status = :status";
                $params = [':status' => $status, ':id' => (int)$id];
                
                if ($notes !== null) {
                    $updateSql .= ", notes = :notes";
                    $params[':notes'] = $notes;
                }
                
                $updateSql .= " WHERE id = :id";
                
                $stmt = $this->pdo->prepare($updateSql);
                $stmt->execute($params);
                
                // If status is 'completed', update the actual booking/check-in
                if ($status === 'completed') {
                    // Get the specific customer ID from the booking
                    $customerSql = "SELECT bd.id_customer 
                                   FROM qlo_htl_booking_detail bd 
                                   WHERE bd.id = :booking_id";
                    $customerStmt = $this->pdo->prepare($customerSql);
                    $customerStmt->execute([':booking_id' => (int)$roomChange['booking_id']]);
                    $customerData = $customerStmt->fetch(PDO::FETCH_ASSOC);
                    $customerId = $customerData ? $customerData['id_customer'] : null;
                    
                    // Update guest_checkins table for the specific customer who is currently checked in
                    if ($customerId) {
                        // Get the new room number
                        $roomNumSql = "SELECT room_num FROM qlo_htl_room_information WHERE id = :new_room_id";
                        $roomNumStmt = $this->pdo->prepare($roomNumSql);
                        $roomNumStmt->execute([':new_room_id' => (int)$roomChange['new_room_id']]);
                        $newRoomNum = $roomNumStmt->fetchColumn();
                        
                        $updateCheckinSql = "UPDATE guest_checkins 
                                            SET id_room = :new_room_id,
                                                room_number = :new_room_num
                                            WHERE id_customer = :customer_id
                                            AND id_room = :old_room_id 
                                            AND NOT EXISTS (
                                                SELECT 1 FROM guest_checkouts WHERE id_checkin = guest_checkins.id
                                            )";
                        
                        $updateStmt = $this->pdo->prepare($updateCheckinSql);
                        $affectedRows = $updateStmt->execute([
                            ':new_room_id' => (int)$roomChange['new_room_id'],
                            ':new_room_num' => $newRoomNum,
                            ':old_room_id' => (int)$roomChange['old_room_id'],
                            ':customer_id' => (int)$customerId
                        ]);
                        
                        error_log("Room change completed: Updated {$updateStmt->rowCount()} check-in records for customer {$customerId} to room {$newRoomNum}");
                    }
                    
                    // Also update booking detail if booking_id exists
                    if ($roomChange['booking_id'] > 0) {
                        $updateBookingSql = "UPDATE qlo_htl_booking_detail 
                                            SET id_room = :new_room_id 
                                            WHERE id = :booking_id";
                        
                        $bookingStmt = $this->pdo->prepare($updateBookingSql);
                        $bookingStmt->execute([
                            ':new_room_id' => (int)$roomChange['new_room_id'],
                            ':booking_id' => (int)$roomChange['booking_id']
                        ]);
                        
                        error_log("Room change completed: Updated booking {$roomChange['booking_id']} to room {$roomChange['new_room_id']}");
                    }
                }
                
                // Commit transaction
                $this->pdo->commit();
                
                return [
                    'success' => true,
                    'message' => 'Room change status updated successfully'
                ];
                
            } catch (Exception $e) {
                $this->pdo->rollBack();
                throw $e;
            }
            
        } catch (Exception $e) {
            return [
                'success' => false,
                'error' => 'Failed to update status: ' . $e->getMessage()
            ];
        }
    }
    
    /**
     * Get room change statistics
     */
    public function getStatistics() {
        try {
            $sql = "SELECT 
                    COUNT(*) as total_changes,
                    SUM(CASE WHEN status = 'pending' THEN 1 ELSE 0 END) as pending_changes,
                    SUM(CASE WHEN status = 'completed' THEN 1 ELSE 0 END) as completed_changes,
                    SUM(CASE WHEN status = 'cancelled' THEN 1 ELSE 0 END) as cancelled_changes,
                    SUM(CASE WHEN DATE(change_date) = CURDATE() THEN 1 ELSE 0 END) as today_changes,
                    SUM(CASE WHEN DATE(change_date) >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) THEN 1 ELSE 0 END) as week_changes,
                    SUM(CASE WHEN DATE(change_date) >= DATE_SUB(CURDATE(), INTERVAL 30 DAY) THEN 1 ELSE 0 END) as month_changes
                FROM roomchange";
            
            $stmt = $this->pdo->query($sql);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            return [
                'success' => true,
                'data' => $result
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'error' => 'Failed to fetch statistics: ' . $e->getMessage()
            ];
        }
    }
    
    /**
     * Get recent room changes
     */
    public function getRecentChanges($limit = 10) {
        try {
            return $this->getAllRoomChanges(null, $limit, 0);
        } catch (Exception $e) {
            return [
                'success' => false,
                'error' => 'Failed to fetch recent changes: ' . $e->getMessage()
            ];
        }
    }
}

// Handle API requests
try {
    $api = new RoomChangeAPI($pdo);
    $method = $_SERVER['REQUEST_METHOD'];
    
    if ($method === 'GET') {
        $action = $_GET['action'] ?? 'list';
        
        switch ($action) {
            case 'list':
                $status = $_GET['status'] ?? null;
                $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 100;
                $offset = isset($_GET['offset']) ? (int)$_GET['offset'] : 0;
                echo json_encode($api->getAllRoomChanges($status, $limit, $offset));
                break;
                
            case 'get':
                $id = $_GET['id'] ?? null;
                if ($id) {
                    echo json_encode($api->getRoomChangeById($id));
                } else {
                    echo json_encode(['success' => false, 'error' => 'Missing room change ID']);
                }
                break;
                
            case 'statistics':
                echo json_encode($api->getStatistics());
                break;
                
            case 'recent':
                $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
                echo json_encode($api->getRecentChanges($limit));
                break;
                
            default:
                echo json_encode(['success' => false, 'error' => 'Invalid action']);
        }
        
    } elseif ($method === 'POST') {
        $input = json_decode(file_get_contents('php://input'), true);
        
        if (!$input) {
            echo json_encode(['success' => false, 'error' => 'Invalid JSON input']);
            exit;
        }
        
        $action = $input['action'] ?? 'create';
        
        switch ($action) {
            case 'create':
                echo json_encode($api->createRoomChange($input));
                break;
                
            case 'update-status':
                $id = $input['id'] ?? null;
                $status = $input['status'] ?? null;
                $notes = $input['notes'] ?? null;
                
                if ($id && $status) {
                    echo json_encode($api->updateRoomChangeStatus($id, $status, $notes));
                } else {
                    echo json_encode(['success' => false, 'error' => 'Missing required fields']);
                }
                break;
                
            default:
                echo json_encode(['success' => false, 'error' => 'Invalid action']);
        }
        
    } else {
        echo json_encode(['success' => false, 'error' => 'Method not allowed']);
    }
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'error' => 'Server error: ' . $e->getMessage()
    ]);
}
