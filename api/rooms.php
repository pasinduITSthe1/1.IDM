<?php
/**
 * Room Management API
 * Provides room status, availability, and management operations
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

// Room status constants
define('ROOM_STATUS_AVAILABLE', 1);
define('ROOM_STATUS_OCCUPIED', 2);
define('ROOM_STATUS_CLEANING', 3);
define('ROOM_STATUS_MAINTENANCE', 4);
define('ROOM_STATUS_RESERVED', 5);

class RoomAPI {
    
    /**
     * Get all rooms with their current status
     */
    public static function getAllRooms() {
        $today = date('Y-m-d');
        $tomorrow = date('Y-m-d', strtotime('+1 day'));
        
        $sql = "SELECT 
                    hr.id,
                    hr.id_product,
                    hr.id_hotel,
                    hr.room_num,
                    hr.id_status AS room_status,
                    hr.comment,
                    hr.floor,
                    hb.hotel_name,
                    hb.phone AS hotel_phone,
                    hrt.id_product AS room_type_id,
                    pl.name AS room_type_name,
                    pl.description,
                    
                    -- Get current booking info
                    (SELECT COUNT(*) 
                     FROM "._DB_PREFIX_."htl_booking_detail hbd 
                     WHERE hbd.id_room = hr.id 
                     AND hbd.date_from <= '".$tomorrow."' 
                     AND hbd.date_to > '".$today."'
                     AND hbd.id_status NOT IN (3, 7)
                    ) AS is_occupied,
                    
                    -- Get guest info if occupied
                    (SELECT CONCAT(c.firstname, ' ', c.lastname)
                     FROM "._DB_PREFIX_."htl_booking_detail hbd
                     JOIN "._DB_PREFIX_."orders o ON hbd.id_order = o.id_order
                     JOIN "._DB_PREFIX_."customer c ON o.id_customer = c.id_customer
                     WHERE hbd.id_room = hr.id 
                     AND hbd.date_from <= '".$tomorrow."' 
                     AND hbd.date_to > '".$today."'
                     AND hbd.id_status NOT IN (3, 7)
                     LIMIT 1
                    ) AS guest_name,
                    
                    -- Get check-in date
                    (SELECT hbd.date_from
                     FROM "._DB_PREFIX_."htl_booking_detail hbd
                     WHERE hbd.id_room = hr.id 
                     AND hbd.date_from <= '".$tomorrow."' 
                     AND hbd.date_to > '".$today."'
                     AND hbd.id_status NOT IN (3, 7)
                     LIMIT 1
                    ) AS check_in_date,
                    
                    -- Get check-out date
                    (SELECT hbd.date_to
                     FROM "._DB_PREFIX_."htl_booking_detail hbd
                     WHERE hbd.id_room = hr.id 
                     AND hbd.date_from <= '".$tomorrow."' 
                     AND hbd.date_to > '".$today."'
                     AND hbd.id_status NOT IN (3, 7)
                     LIMIT 1
                    ) AS check_out_date,
                    
                    -- Get booking ID
                    (SELECT hbd.id
                     FROM "._DB_PREFIX_."htl_booking_detail hbd
                     WHERE hbd.id_room = hr.id 
                     AND hbd.date_from <= '".$tomorrow."' 
                     AND hbd.date_to > '".$today."'
                     AND hbd.id_status NOT IN (3, 7)
                     LIMIT 1
                    ) AS booking_id
                    
                FROM "._DB_PREFIX_."htl_room_information hr
                JOIN "._DB_PREFIX_."htl_branch_info hb ON hr.id_hotel = hb.id
                JOIN "._DB_PREFIX_."htl_room_type hrt ON hr.id_product = hrt.id_product
                JOIN "._DB_PREFIX_."product_lang pl ON hrt.id_product = pl.id_product AND pl.id_lang = 1
                WHERE hr.active = 1
                ORDER BY hb.hotel_name, hr.floor, hr.room_num";
        
        $result = Db::getInstance()->executeS($sql);
        
        if ($result) {
            foreach ($result as &$room) {
                // Determine actual status based on booking and room status
                if ($room['is_occupied'] > 0) {
                    $room['current_status'] = 'occupied';
                    $room['status_color'] = '#dc3545'; // Red
                } else if ($room['room_status'] == 3) {
                    $room['current_status'] = 'cleaning';
                    $room['status_color'] = '#ffc107'; // Yellow
                } else if ($room['room_status'] == 4) {
                    $room['current_status'] = 'maintenance';
                    $room['status_color'] = '#6c757d'; // Gray
                } else {
                    $room['current_status'] = 'available';
                    $room['status_color'] = '#28a745'; // Green
                }
                
                // Add room features/amenities
                $room['features'] = self::getRoomFeatures($room['id_product']);
            }
        }
        
        return $result ?: [];
    }
    
    /**
     * Get room features
     */
    private static function getRoomFeatures($idProduct) {
        $sql = "SELECT hf.name
                FROM "._DB_PREFIX_."htl_room_type_feature_pricing_group hrfpg
                JOIN "._DB_PREFIX_."htl_features hf ON hrfpg.id_feature = hf.id
                WHERE hrfpg.id_product = ".(int)$idProduct."
                AND hf.active = 1";
        
        $features = Db::getInstance()->executeS($sql);
        return $features ? array_column($features, 'name') : [];
    }
    
    /**
     * Get room by ID
     */
    public static function getRoomById($roomId) {
        $rooms = self::getAllRooms();
        foreach ($rooms as $room) {
            if ($room['id'] == $roomId) {
                return $room;
            }
        }
        return null;
    }
    
    /**
     * Update room status
     */
    public static function updateRoomStatus($roomId, $status) {
        $validStatuses = [1, 2, 3, 4, 5];
        
        if (!in_array($status, $validStatuses)) {
            return ['success' => false, 'message' => 'Invalid status'];
        }
        
        $sql = "UPDATE "._DB_PREFIX_."htl_room_information 
                SET id_status = ".(int)$status.",
                    date_upd = NOW()
                WHERE id = ".(int)$roomId;
        
        $result = Db::getInstance()->execute($sql);
        
        return [
            'success' => $result,
            'message' => $result ? 'Room status updated successfully' : 'Failed to update room status'
        ];
    }
    
    /**
     * Get room statistics
     */
    public static function getRoomStatistics() {
        $today = date('Y-m-d');
        $tomorrow = date('Y-m-d', strtotime('+1 day'));
        
        $sql = "SELECT 
                    COUNT(*) AS total_rooms,
                    SUM(CASE WHEN (
                        SELECT COUNT(*) 
                        FROM "._DB_PREFIX_."htl_booking_detail hbd 
                        WHERE hbd.id_room = hr.id 
                        AND hbd.date_from <= '".$tomorrow."' 
                        AND hbd.date_to > '".$today."'
                        AND hbd.id_status NOT IN (3, 7)
                    ) > 0 THEN 1 ELSE 0 END) AS occupied_rooms,
                    SUM(CASE WHEN id_status = 3 THEN 1 ELSE 0 END) AS cleaning_rooms,
                    SUM(CASE WHEN id_status = 4 THEN 1 ELSE 0 END) AS maintenance_rooms
                FROM "._DB_PREFIX_."htl_room_information hr
                WHERE hr.active = 1";
        
        $result = Db::getInstance()->getRow($sql);
        
        if ($result) {
            $result['available_rooms'] = $result['total_rooms'] - $result['occupied_rooms'] - $result['cleaning_rooms'] - $result['maintenance_rooms'];
            $result['occupancy_rate'] = $result['total_rooms'] > 0 
                ? round(($result['occupied_rooms'] / $result['total_rooms']) * 100, 2) 
                : 0;
        }
        
        return $result ?: [
            'total_rooms' => 0,
            'occupied_rooms' => 0,
            'available_rooms' => 0,
            'cleaning_rooms' => 0,
            'maintenance_rooms' => 0,
            'occupancy_rate' => 0
        ];
    }
    
    /**
     * Get today's check-ins
     */
    public static function getTodayCheckIns() {
        $today = date('Y-m-d');
        
        $sql = "SELECT 
                    hbd.id,
                    hbd.id_room,
                    hr.room_num,
                    hb.hotel_name,
                    CONCAT(c.firstname, ' ', c.lastname) AS guest_name,
                    c.email,
                    hbd.date_from AS check_in_date,
                    hbd.date_to AS check_out_date,
                    hbd.adults,
                    hbd.children
                FROM "._DB_PREFIX_."htl_booking_detail hbd
                JOIN "._DB_PREFIX_."htl_room_information hr ON hbd.id_room = hr.id
                JOIN "._DB_PREFIX_."htl_branch_info hb ON hr.id_hotel = hb.id
                JOIN "._DB_PREFIX_."orders o ON hbd.id_order = o.id_order
                JOIN "._DB_PREFIX_."customer c ON o.id_customer = c.id_customer
                WHERE DATE(hbd.date_from) = '".$today."'
                AND hbd.id_status NOT IN (3, 7)
                ORDER BY hbd.date_from";
        
        return Db::getInstance()->executeS($sql) ?: [];
    }
    
    /**
     * Get today's check-outs
     */
    public static function getTodayCheckOuts() {
        $today = date('Y-m-d');
        
        $sql = "SELECT 
                    hbd.id,
                    hbd.id_room,
                    hr.room_num,
                    hb.hotel_name,
                    CONCAT(c.firstname, ' ', c.lastname) AS guest_name,
                    c.email,
                    hbd.date_from AS check_in_date,
                    hbd.date_to AS check_out_date,
                    hbd.adults,
                    hbd.children
                FROM "._DB_PREFIX_."htl_booking_detail hbd
                JOIN "._DB_PREFIX_."htl_room_information hr ON hbd.id_room = hr.id
                JOIN "._DB_PREFIX_."htl_branch_info hb ON hr.id_hotel = hb.id
                JOIN "._DB_PREFIX_."orders o ON hbd.id_order = o.id_order
                JOIN "._DB_PREFIX_."customer c ON o.id_customer = c.id_customer
                WHERE DATE(hbd.date_to) = '".$today."'
                AND hbd.id_status NOT IN (3, 7)
                ORDER BY hbd.date_to";
        
        return Db::getInstance()->executeS($sql) ?: [];
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
                    case 'statistics':
                        $response = [
                            'success' => true,
                            'data' => RoomAPI::getRoomStatistics()
                        ];
                        break;
                    
                    case 'today-checkins':
                        $response = [
                            'success' => true,
                            'data' => RoomAPI::getTodayCheckIns()
                        ];
                        break;
                    
                    case 'today-checkouts':
                        $response = [
                            'success' => true,
                            'data' => RoomAPI::getTodayCheckOuts()
                        ];
                        break;
                    
                    case 'get-room':
                        if (isset($_GET['id'])) {
                            $room = RoomAPI::getRoomById($_GET['id']);
                            $response = [
                                'success' => $room !== null,
                                'data' => $room,
                                'message' => $room ? 'Room found' : 'Room not found'
                            ];
                        }
                        break;
                    
                    default:
                        $response = [
                            'success' => true,
                            'data' => RoomAPI::getAllRooms()
                        ];
                }
            } else {
                $response = [
                    'success' => true,
                    'data' => RoomAPI::getAllRooms()
                ];
            }
            break;
        
        case 'PUT':
        case 'POST':
            $input = json_decode(file_get_contents('php://input'), true);
            
            if (isset($input['action']) && $input['action'] === 'update-status') {
                if (isset($input['room_id']) && isset($input['status'])) {
                    $result = RoomAPI::updateRoomStatus($input['room_id'], $input['status']);
                    $response = $result;
                } else {
                    $response = [
                        'success' => false,
                        'message' => 'Missing room_id or status parameter'
                    ];
                }
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
