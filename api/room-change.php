<?php
/**
 * Room Change API
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

require_once dirname(__DIR__) . '/config/config.inc.php';

class RoomChangeAPI {
    private $db;
    
    public function __construct() {
        $this->db = Db::getInstance();
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
                FROM " . _DB_PREFIX_ . "roomchange rc
                LEFT JOIN " . _DB_PREFIX_ . "htl_room_information old_room ON rc.old_room_id = old_room.id
                LEFT JOIN " . _DB_PREFIX_ . "htl_room_information new_room ON rc.new_room_id = new_room.id
                LEFT JOIN " . _DB_PREFIX_ . "htl_booking_detail bd ON rc.booking_id = bd.id
                WHERE 1=1";
            
            if ($status && in_array($status, ['pending', 'completed', 'cancelled'])) {
                $sql .= " AND rc.status = '" . pSQL($status) . "'";
            }
            
            $sql .= " ORDER BY rc.change_date DESC, rc.created_at DESC";
            $sql .= " LIMIT " . (int)$limit . " OFFSET " . (int)$offset;
            
            $results = $this->db->executeS($sql);
            
            return [
                'success' => true,
                'data' => $results ? $results : [],
                'count' => count($results ? $results : [])
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
                FROM " . _DB_PREFIX_ . "roomchange rc
                LEFT JOIN " . _DB_PREFIX_ . "htl_room_information old_room ON rc.old_room_id = old_room.id
                LEFT JOIN " . _DB_PREFIX_ . "htl_room_information new_room ON rc.new_room_id = new_room.id
                LEFT JOIN " . _DB_PREFIX_ . "htl_booking_detail bd ON rc.booking_id = bd.id
                WHERE rc.id = " . (int)$id;
            
            $result = $this->db->getRow($sql);
            
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
     * Get available rooms for a specific date range
     */
    public function getAvailableRooms($checkIn, $checkOut, $hotelId = null) {
        try {
            $sql = "SELECT 
                    ri.id,
                    ri.id_product,
                    ri.id_hotel,
                    ri.room_num,
                    ri.floor,
                    p.name as room_type,
                    hi.hotel_name,
                    ri.id_status as room_status
                FROM " . _DB_PREFIX_ . "htl_room_information ri
                LEFT JOIN " . _DB_PREFIX_ . "product_lang p ON ri.id_product = p.id_product AND p.id_lang = 1
                LEFT JOIN " . _DB_PREFIX_ . "htl_branch_info hi ON ri.id_hotel = hi.id
                WHERE ri.id NOT IN (
                    SELECT id_room 
                    FROM " . _DB_PREFIX_ . "htl_booking_detail 
                    WHERE booking_type = 1
                    AND (
                        (date_from <= '" . pSQL($checkOut) . "' AND date_to >= '" . pSQL($checkIn) . "')
                    )
                )
                AND ri.id_status IN (1, 3)"; // 1=Available, 3=Temporary Inactive/Cleaning
            
            if ($hotelId) {
                $sql .= " AND ri.id_hotel = " . (int)$hotelId;
            }
            
            $sql .= " ORDER BY ri.room_num ASC";
            
            $results = $this->db->executeS($sql);
            
            return [
                'success' => true,
                'data' => $results ? $results : []
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'error' => 'Failed to fetch available rooms: ' . $e->getMessage()
            ];
        }
    }
    
    /**
     * Get currently occupied rooms with guest details
     */
    public function getOccupiedRooms() {
        try {
            $today = date('Y-m-d');
            
            $sql = "SELECT 
                    bd.id as booking_id,
                    bd.id_room,
                    bd.id_hotel,
                    bd.date_from,
                    bd.date_to,
                    bd.adults,
                    bd.children,
                    ri.room_num,
                    ri.floor,
                    p.name as room_type,
                    hi.hotel_name,
                    o.id_customer,
                    CONCAT(c.firstname, ' ', c.lastname) as guest_name,
                    c.email as guest_email
                FROM " . _DB_PREFIX_ . "htl_booking_detail bd
                INNER JOIN " . _DB_PREFIX_ . "htl_room_information ri ON bd.id_room = ri.id
                LEFT JOIN " . _DB_PREFIX_ . "product_lang p ON ri.id_product = p.id_product AND p.id_lang = 1
                LEFT JOIN " . _DB_PREFIX_ . "htl_branch_info hi ON bd.id_hotel = hi.id
                LEFT JOIN " . _DB_PREFIX_ . "orders o ON bd.id_order = o.id_order
                LEFT JOIN " . _DB_PREFIX_ . "customer c ON o.id_customer = c.id_customer
                WHERE bd.booking_type = 1
                AND bd.date_from <= '" . pSQL($today) . "'
                AND bd.date_to >= '" . pSQL($today) . "'
                ORDER BY ri.room_num ASC";
            
            $results = $this->db->executeS($sql);
            
            return [
                'success' => true,
                'data' => $results ? $results : []
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'error' => 'Failed to fetch occupied rooms: ' . $e->getMessage()
            ];
        }
    }
    
    /**
     * Create a new room change request
     */
    public function createRoomChange($data) {
        try {
            // Validate required fields
            $required = ['booking_id', 'old_room_id', 'new_room_id', 'change_reason', 'changed_by'];
            foreach ($required as $field) {
                if (empty($data[$field])) {
                    return [
                        'success' => false,
                        'error' => "Missing required field: $field"
                    ];
                }
            }
            
            // Check if new room is available
            $booking = $this->db->getRow("
                SELECT date_from, date_to, id_hotel 
                FROM " . _DB_PREFIX_ . "htl_booking_detail 
                WHERE id = " . (int)$data['booking_id']
            );
            
            if (!$booking) {
                return [
                    'success' => false,
                    'error' => 'Booking not found'
                ];
            }
            
            // Check if the new room is actually available for this date range
            $conflictCheck = $this->db->getRow("
                SELECT id 
                FROM " . _DB_PREFIX_ . "htl_booking_detail 
                WHERE id_room = " . (int)$data['new_room_id'] . "
                AND booking_type = 1
                AND id != " . (int)$data['booking_id'] . "
                AND (
                    (date_from <= '" . pSQL($booking['date_to']) . "' AND date_to >= '" . pSQL($booking['date_from']) . "')
                )
            ");
            
            if ($conflictCheck) {
                return [
                    'success' => false,
                    'error' => 'Selected room is not available for this date range'
                ];
            }
            
            // Get room numbers
            $oldRoom = $this->db->getRow("SELECT room_num FROM " . _DB_PREFIX_ . "htl_room_information WHERE id = " . (int)$data['old_room_id']);
            $newRoom = $this->db->getRow("SELECT room_num FROM " . _DB_PREFIX_ . "htl_room_information WHERE id = " . (int)$data['new_room_id']);
            
            // Start transaction
            $this->db->execute("START TRANSACTION");
            
            try {
                // Insert room change record
                $insertData = [
                    'booking_id' => (int)$data['booking_id'],
                    'old_room_id' => (int)$data['old_room_id'],
                    'new_room_id' => (int)$data['new_room_id'],
                    'old_room_num' => pSQL($oldRoom['room_num']),
                    'new_room_num' => pSQL($newRoom['room_num']),
                    'guest_name' => pSQL($data['guest_name'] ?? ''),
                    'change_reason' => pSQL($data['change_reason']),
                    'changed_by' => pSQL($data['changed_by']),
                    'change_date' => date('Y-m-d H:i:s'),
                    'check_in_date' => pSQL($booking['date_from']),
                    'check_out_date' => pSQL($booking['date_to']),
                    'status' => pSQL($data['status'] ?? 'pending'),
                    'notes' => pSQL($data['notes'] ?? '')
                ];
                
                $result = $this->db->insert('roomchange', $insertData);
                
                if (!$result) {
                    throw new Exception('Failed to create room change record');
                }
                
                $roomChangeId = $this->db->Insert_ID();
                
                // If status is 'completed', update the booking detail
                if (isset($data['status']) && $data['status'] === 'completed') {
                    $updateResult = $this->db->update(
                        'htl_booking_detail',
                        ['id_room' => (int)$data['new_room_id']],
                        'id = ' . (int)$data['booking_id']
                    );
                    
                    if (!$updateResult) {
                        throw new Exception('Failed to update booking with new room');
                    }
                }
                
                // Commit transaction
                $this->db->execute("COMMIT");
                
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
                $this->db->execute("ROLLBACK");
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
            $roomChange = $this->db->getRow("
                SELECT * FROM " . _DB_PREFIX_ . "roomchange WHERE id = " . (int)$id
            );
            
            if (!$roomChange) {
                return [
                    'success' => false,
                    'error' => 'Room change not found'
                ];
            }
            
            // Start transaction
            $this->db->execute("START TRANSACTION");
            
            try {
                // Update room change status
                $updateData = ['status' => pSQL($status)];
                
                if ($notes !== null) {
                    $updateData['notes'] = pSQL($notes);
                }
                
                $result = $this->db->update(
                    'roomchange',
                    $updateData,
                    'id = ' . (int)$id
                );
                
                if (!$result) {
                    throw new Exception('Failed to update room change status');
                }
                
                // If status is 'completed', update the actual booking
                if ($status === 'completed') {
                    $updateBooking = $this->db->update(
                        'htl_booking_detail',
                        ['id_room' => (int)$roomChange['new_room_id']],
                        'id = ' . (int)$roomChange['booking_id']
                    );
                    
                    if (!$updateBooking) {
                        throw new Exception('Failed to update booking with new room');
                    }
                }
                
                // Commit transaction
                $this->db->execute("COMMIT");
                
                return [
                    'success' => true,
                    'message' => 'Room change status updated successfully'
                ];
                
            } catch (Exception $e) {
                $this->db->execute("ROLLBACK");
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
                FROM " . _DB_PREFIX_ . "roomchange";
            
            $result = $this->db->getRow($sql);
            
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
    $api = new RoomChangeAPI();
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
                
            case 'available-rooms':
                $checkIn = $_GET['check_in'] ?? null;
                $checkOut = $_GET['check_out'] ?? null;
                $hotelId = $_GET['hotel_id'] ?? null;
                
                if ($checkIn && $checkOut) {
                    echo json_encode($api->getAvailableRooms($checkIn, $checkOut, $hotelId));
                } else {
                    echo json_encode(['success' => false, 'error' => 'Missing check-in or check-out date']);
                }
                break;
                
            case 'occupied-rooms':
                echo json_encode($api->getOccupiedRooms());
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
