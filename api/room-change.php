<?php
/**
 * Room Change API
 * Handles guest room change operations and tracking
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

require_once(dirname(__FILE__).'/../config/config.inc.php');

class RoomChangeAPI {
    
    /**
     * Get all room changes with optional filters
     */
    public static function getAllRoomChanges($status = null, $limit = 100, $offset = 0) {
        $whereClause = $status ? "WHERE rc.status = '".pSQL($status)."'" : "";
        
        $sql = "SELECT 
                    rc.*,
                    old_room.room_num AS old_room_number,
                    old_room.floor AS old_room_floor,
                    old_hotel.hotel_name AS old_hotel_name,
                    new_room.room_num AS new_room_number,
                    new_room.floor AS new_room_floor,
                    new_hotel.hotel_name AS new_hotel_name,
                    old_rt.name AS old_room_type,
                    new_rt.name AS new_room_type
                FROM roomchange rc
                LEFT JOIN "._DB_PREFIX_."htl_room_information old_room ON rc.old_room_id = old_room.id
                LEFT JOIN "._DB_PREFIX_."htl_branch_info old_hotel ON old_room.id_hotel = old_hotel.id
                LEFT JOIN "._DB_PREFIX_."htl_room_type old_rt_ref ON old_room.id_product = old_rt_ref.id_product
                LEFT JOIN "._DB_PREFIX_."product_lang old_rt ON old_rt_ref.id_product = old_rt.id_product AND old_rt.id_lang = 1
                LEFT JOIN "._DB_PREFIX_."htl_room_information new_room ON rc.new_room_id = new_room.id
                LEFT JOIN "._DB_PREFIX_."htl_branch_info new_hotel ON new_room.id_hotel = new_hotel.id
                LEFT JOIN "._DB_PREFIX_."htl_room_type new_rt_ref ON new_room.id_product = new_rt_ref.id_product
                LEFT JOIN "._DB_PREFIX_."product_lang new_rt ON new_rt_ref.id_product = new_rt.id_product AND new_rt.id_lang = 1
                ".$whereClause."
                ORDER BY rc.change_date DESC
                LIMIT ".(int)$limit." OFFSET ".(int)$offset;
        
        return Db::getInstance()->executeS($sql) ?: [];
    }
    
    /**
     * Get room change by ID
     */
    public static function getRoomChangeById($id) {
        $sql = "SELECT 
                    rc.*,
                    old_room.room_num AS old_room_number,
                    old_room.floor AS old_room_floor,
                    old_hotel.hotel_name AS old_hotel_name,
                    new_room.room_num AS new_room_number,
                    new_room.floor AS new_room_floor,
                    new_hotel.hotel_name AS new_hotel_name,
                    old_rt.name AS old_room_type,
                    new_rt.name AS new_room_type
                FROM roomchange rc
                LEFT JOIN "._DB_PREFIX_."htl_room_information old_room ON rc.old_room_id = old_room.id
                LEFT JOIN "._DB_PREFIX_."htl_branch_info old_hotel ON old_room.id_hotel = old_hotel.id
                LEFT JOIN "._DB_PREFIX_."htl_room_type old_rt_ref ON old_room.id_product = old_rt_ref.id_product
                LEFT JOIN "._DB_PREFIX_."product_lang old_rt ON old_rt_ref.id_product = old_rt.id_product AND old_rt.id_lang = 1
                LEFT JOIN "._DB_PREFIX_."htl_room_information new_room ON rc.new_room_id = new_room.id
                LEFT JOIN "._DB_PREFIX_."htl_branch_info new_hotel ON new_room.id_hotel = new_hotel.id
                LEFT JOIN "._DB_PREFIX_."htl_room_type new_rt_ref ON new_room.id_product = new_rt_ref.id_product
                LEFT JOIN "._DB_PREFIX_."product_lang new_rt ON new_rt_ref.id_product = new_rt.id_product AND new_rt.id_lang = 1
                WHERE rc.id = ".(int)$id;
        
        return Db::getInstance()->getRow($sql);
    }
    
    /**
     * Get room changes for a specific booking
     */
    public static function getRoomChangesByBookingId($bookingId) {
        $sql = "SELECT 
                    rc.*,
                    old_room.room_num AS old_room_number,
                    new_room.room_num AS new_room_number
                FROM roomchange rc
                LEFT JOIN "._DB_PREFIX_."htl_room_information old_room ON rc.old_room_id = old_room.id
                LEFT JOIN "._DB_PREFIX_."htl_room_information new_room ON rc.new_room_id = new_room.id
                WHERE rc.booking_id = ".(int)$bookingId."
                ORDER BY rc.change_date DESC";
        
        return Db::getInstance()->executeS($sql) ?: [];
    }
    
    /**
     * Get available rooms for room change
     */
    public static function getAvailableRoomsForChange($checkInDate, $checkOutDate, $currentRoomId) {
        $sql = "SELECT 
                    hr.id,
                    hr.id_product,
                    hr.id_hotel,
                    hr.room_num,
                    hr.floor,
                    hb.hotel_name,
                    pl.name AS room_type_name,
                    pl.description,
                    hr.id_status AS room_status
                FROM "._DB_PREFIX_."htl_room_information hr
                JOIN "._DB_PREFIX_."htl_branch_info hb ON hr.id_hotel = hb.id
                JOIN "._DB_PREFIX_."htl_room_type hrt ON hr.id_product = hrt.id_product
                JOIN "._DB_PREFIX_."product_lang pl ON hrt.id_product = pl.id_product AND pl.id_lang = 1
                WHERE hr.active = 1
                AND hr.id != ".(int)$currentRoomId."
                AND hr.id_status NOT IN (4)
                AND hr.id NOT IN (
                    SELECT hbd.id_room 
                    FROM "._DB_PREFIX_."htl_booking_detail hbd
                    WHERE hbd.id_status NOT IN (3, 7)
                    AND (
                        (hbd.date_from <= '".pSQL($checkOutDate)."' AND hbd.date_to > '".pSQL($checkInDate)."')
                    )
                )
                ORDER BY hb.hotel_name, hr.floor, hr.room_num";
        
        return Db::getInstance()->executeS($sql) ?: [];
    }
    
    /**
     * Create a new room change
     */
    public static function createRoomChange($data) {
        // Validate required fields
        $required = ['booking_id', 'guest_name', 'old_room_id', 'old_room_num', 'new_room_id', 
                     'new_room_num', 'change_reason', 'changed_by', 'check_in_date', 'check_out_date'];
        
        foreach ($required as $field) {
            if (!isset($data[$field]) || empty($data[$field])) {
                return [
                    'success' => false,
                    'message' => "Missing required field: $field"
                ];
            }
        }
        
        // Check if new room is available
        $availableRooms = self::getAvailableRoomsForChange(
            $data['check_in_date'], 
            $data['check_out_date'], 
            $data['old_room_id']
        );
        
        $isAvailable = false;
        foreach ($availableRooms as $room) {
            if ($room['id'] == $data['new_room_id']) {
                $isAvailable = true;
                break;
            }
        }
        
        if (!$isAvailable) {
            return [
                'success' => false,
                'message' => 'Selected room is not available for the booking dates'
            ];
        }
        
        // Start transaction
        Db::getInstance()->execute('START TRANSACTION');
        
        try {
            // Insert room change record
            $status = isset($data['status']) ? pSQL($data['status']) : 'pending';
            $notes = isset($data['notes']) ? pSQL($data['notes']) : null;
            
            $sql = "INSERT INTO roomchange (
                        booking_id, guest_name, old_room_id, old_room_num, 
                        new_room_id, new_room_num, change_reason, changed_by,
                        check_in_date, check_out_date, status, notes, change_date
                    ) VALUES (
                        ".(int)$data['booking_id'].",
                        '".pSQL($data['guest_name'])."',
                        ".(int)$data['old_room_id'].",
                        '".pSQL($data['old_room_num'])."',
                        ".(int)$data['new_room_id'].",
                        '".pSQL($data['new_room_num'])."',
                        '".pSQL($data['change_reason'])."',
                        '".pSQL($data['changed_by'])."',
                        '".pSQL($data['check_in_date'])."',
                        '".pSQL($data['check_out_date'])."',
                        '".$status."',
                        ".($notes ? "'".$notes."'" : 'NULL').",
                        NOW()
                    )";
            
            $result = Db::getInstance()->execute($sql);
            
            if (!$result) {
                throw new Exception('Failed to insert room change record');
            }
            
            $roomChangeId = Db::getInstance()->Insert_ID();
            
            // Update the booking detail with new room
            $updateSql = "UPDATE "._DB_PREFIX_."htl_booking_detail 
                         SET id_room = ".(int)$data['new_room_id']."
                         WHERE id = ".(int)$data['booking_id'];
            
            $updateResult = Db::getInstance()->execute($updateSql);
            
            if (!$updateResult) {
                throw new Exception('Failed to update booking with new room');
            }
            
            // Commit transaction
            Db::getInstance()->execute('COMMIT');
            
            return [
                'success' => true,
                'message' => 'Room change created successfully',
                'data' => [
                    'id' => $roomChangeId,
                    'booking_id' => $data['booking_id'],
                    'old_room_num' => $data['old_room_num'],
                    'new_room_num' => $data['new_room_num']
                ]
            ];
            
        } catch (Exception $e) {
            // Rollback on error
            Db::getInstance()->execute('ROLLBACK');
            
            return [
                'success' => false,
                'message' => 'Transaction failed: ' . $e->getMessage()
            ];
        }
    }
    
    /**
     * Update room change status
     */
    public static function updateRoomChangeStatus($id, $status, $notes = null) {
        $validStatuses = ['pending', 'completed', 'cancelled'];
        
        if (!in_array($status, $validStatuses)) {
            return [
                'success' => false,
                'message' => 'Invalid status. Must be: pending, completed, or cancelled'
            ];
        }
        
        $sql = "UPDATE roomchange 
                SET status = '".pSQL($status)."'";
        
        if ($notes !== null) {
            $sql .= ", notes = '".pSQL($notes)."'";
        }
        
        $sql .= " WHERE id = ".(int)$id;
        
        $result = Db::getInstance()->execute($sql);
        
        return [
            'success' => $result,
            'message' => $result ? 'Room change status updated' : 'Failed to update status'
        ];
    }
    
    /**
     * Get room change statistics
     */
    public static function getRoomChangeStatistics($startDate = null, $endDate = null) {
        $whereClause = "";
        
        if ($startDate && $endDate) {
            $whereClause = "WHERE change_date BETWEEN '".pSQL($startDate)."' AND '".pSQL($endDate)."'";
        }
        
        $sql = "SELECT 
                    COUNT(*) as total_changes,
                    SUM(CASE WHEN status = 'pending' THEN 1 ELSE 0 END) as pending_changes,
                    SUM(CASE WHEN status = 'completed' THEN 1 ELSE 0 END) as completed_changes,
                    SUM(CASE WHEN status = 'cancelled' THEN 1 ELSE 0 END) as cancelled_changes
                FROM roomchange
                ".$whereClause;
        
        return Db::getInstance()->getRow($sql);
    }
}

// Handle API requests
$method = $_SERVER['REQUEST_METHOD'];
$response = ['success' => false];

try {
    switch ($method) {
        case 'GET':
            if (isset($_GET['action'])) {
                switch ($_GET['action']) {
                    case 'get-all':
                        $status = isset($_GET['status']) ? $_GET['status'] : null;
                        $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 100;
                        $offset = isset($_GET['offset']) ? (int)$_GET['offset'] : 0;
                        
                        $response = [
                            'success' => true,
                            'data' => RoomChangeAPI::getAllRoomChanges($status, $limit, $offset)
                        ];
                        break;
                    
                    case 'get-by-id':
                        if (isset($_GET['id'])) {
                            $data = RoomChangeAPI::getRoomChangeById($_GET['id']);
                            $response = [
                                'success' => $data !== false,
                                'data' => $data,
                                'message' => $data ? 'Room change found' : 'Room change not found'
                            ];
                        } else {
                            $response = ['success' => false, 'message' => 'Missing id parameter'];
                        }
                        break;
                    
                    case 'get-by-booking':
                        if (isset($_GET['booking_id'])) {
                            $response = [
                                'success' => true,
                                'data' => RoomChangeAPI::getRoomChangesByBookingId($_GET['booking_id'])
                            ];
                        } else {
                            $response = ['success' => false, 'message' => 'Missing booking_id parameter'];
                        }
                        break;
                    
                    case 'available-rooms':
                        if (isset($_GET['check_in_date']) && isset($_GET['check_out_date']) && isset($_GET['current_room_id'])) {
                            $response = [
                                'success' => true,
                                'data' => RoomChangeAPI::getAvailableRoomsForChange(
                                    $_GET['check_in_date'],
                                    $_GET['check_out_date'],
                                    $_GET['current_room_id']
                                )
                            ];
                        } else {
                            $response = [
                                'success' => false, 
                                'message' => 'Missing required parameters: check_in_date, check_out_date, current_room_id'
                            ];
                        }
                        break;
                    
                    case 'statistics':
                        $startDate = isset($_GET['start_date']) ? $_GET['start_date'] : null;
                        $endDate = isset($_GET['end_date']) ? $_GET['end_date'] : null;
                        
                        $response = [
                            'success' => true,
                            'data' => RoomChangeAPI::getRoomChangeStatistics($startDate, $endDate)
                        ];
                        break;
                    
                    default:
                        $response = [
                            'success' => false,
                            'message' => 'Unknown action'
                        ];
                }
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Action parameter required'
                ];
            }
            break;
        
        case 'POST':
            $input = json_decode(file_get_contents('php://input'), true);
            
            if (!$input) {
                $response = [
                    'success' => false,
                    'message' => 'Invalid JSON input'
                ];
                break;
            }
            
            if (isset($input['action'])) {
                switch ($input['action']) {
                    case 'create':
                        $response = RoomChangeAPI::createRoomChange($input);
                        break;
                    
                    case 'update-status':
                        if (isset($input['id']) && isset($input['status'])) {
                            $notes = isset($input['notes']) ? $input['notes'] : null;
                            $response = RoomChangeAPI::updateRoomChangeStatus(
                                $input['id'], 
                                $input['status'],
                                $notes
                            );
                        } else {
                            $response = [
                                'success' => false,
                                'message' => 'Missing id or status parameter'
                            ];
                        }
                        break;
                    
                    default:
                        $response = [
                            'success' => false,
                            'message' => 'Unknown action'
                        ];
                }
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Action parameter required'
                ];
            }
            break;
        
        default:
            $response = [
                'success' => false,
                'message' => 'Method not allowed'
            ];
            http_response_code(405);
    }
    
} catch (Exception $e) {
    $response = [
        'success' => false,
        'message' => 'Server error: ' . $e->getMessage()
    ];
    http_response_code(500);
}

echo json_encode($response);
?>
