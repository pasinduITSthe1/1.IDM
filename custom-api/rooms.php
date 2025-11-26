<?php
/**
 * Room Management API - Custom API (bypasses PrestaShop webservice auth)
 * Created for Hotel Staff Flutter App
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

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
    exit();
}

// Room status constants
define('ROOM_STATUS_AVAILABLE', 1);
define('ROOM_STATUS_OCCUPIED', 2);
define('ROOM_STATUS_CLEANING', 3);
define('ROOM_STATUS_MAINTENANCE', 4);

class RoomAPI {
    private static $pdo;
    
    public static function setPDO($pdo) {
        self::$pdo = $pdo;
    }
    
    /**
     * Get all rooms with their current status
     */
    public static function getAllRooms() {
        $today = date('Y-m-d');
        
        $sql = "SELECT 
                    hr.id,
                    hr.id_product,
                    hr.id_hotel,
                    hr.room_num,
                    hr.id_status AS room_status,
                    hr.comment,
                    hr.floor,
                    hbl.hotel_name,
                    '' AS hotel_phone,
                    hrt.id_product AS room_type_id,
                    pl.name AS room_type_name,
                    pl.description,
                    
                    -- Check if room is currently occupied
                    (SELECT COUNT(*) 
                     FROM qlo_htl_booking_detail hbd 
                     WHERE hbd.id_room = hr.id 
                     AND DATE(:today1) BETWEEN DATE(hbd.date_from) AND DATE(hbd.date_to)
                     AND hbd.id_status NOT IN (3, 7)
                    ) AS is_occupied,
                    
                    -- Get guest info if occupied
                    (SELECT CONCAT(c.firstname, ' ', c.lastname)
                     FROM qlo_htl_booking_detail hbd
                     JOIN qlo_orders o ON hbd.id_order = o.id_order
                     JOIN qlo_customer c ON o.id_customer = c.id_customer
                     WHERE hbd.id_room = hr.id
                     AND DATE(:today2) BETWEEN DATE(hbd.date_from) AND DATE(hbd.date_to)
                     AND hbd.id_status NOT IN (3, 7)
                     LIMIT 1
                    ) AS guest_name,
                    
                    -- Get check-in date
                    (SELECT DATE(hbd.date_from)
                     FROM qlo_htl_booking_detail hbd
                     WHERE hbd.id_room = hr.id
                     AND DATE(:today3) BETWEEN DATE(hbd.date_from) AND DATE(hbd.date_to)
                     AND hbd.id_status NOT IN (3, 7)
                     LIMIT 1
                    ) AS check_in_date,
                    
                    -- Get check-out date
                    (SELECT DATE(hbd.date_to)
                     FROM qlo_htl_booking_detail hbd
                     WHERE hbd.id_room = hr.id
                     AND DATE(:today4) BETWEEN DATE(hbd.date_from) AND DATE(hbd.date_to)
                     AND hbd.id_status NOT IN (3, 7)
                     LIMIT 1
                    ) AS check_out_date,
                    
                    -- Get booking ID
                    (SELECT hbd.id
                     FROM qlo_htl_booking_detail hbd
                     WHERE hbd.id_room = hr.id
                     AND DATE(:today5) BETWEEN DATE(hbd.date_from) AND DATE(hbd.date_to)
                     AND hbd.id_status NOT IN (3, 7)
                     LIMIT 1
                    ) AS booking_id
                    
                FROM qlo_htl_room_information hr
                LEFT JOIN qlo_htl_branch_info_lang hbl ON hr.id_hotel = hbl.id AND hbl.id_lang = 1
                LEFT JOIN qlo_htl_room_type hrt ON hr.id_product = hrt.id_product
                LEFT JOIN qlo_product_lang pl ON hrt.id_product = pl.id_product AND pl.id_lang = 1
                ORDER BY hr.room_num";
        
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute([
            ':today1' => $today,
            ':today2' => $today,
            ':today3' => $today,
            ':today4' => $today,
            ':today5' => $today
        ]);
        
        $rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Add computed fields
        foreach ($rooms as &$room) {
            // Determine current status based on room_status and occupancy
            if ($room['is_occupied'] > 0) {
                $status = 'occupied';
                $color = '#FF9800';
            } else {
                switch ($room['room_status']) {
                    case ROOM_STATUS_AVAILABLE:
                        $status = 'available';
                        $color = '#4CAF50';
                        break;
                    case ROOM_STATUS_CLEANING:
                        $status = 'cleaning';
                        $color = '#2196F3';
                        break;
                    case ROOM_STATUS_MAINTENANCE:
                        $status = 'maintenance';
                        $color = '#F44336';
                        break;
                    default:
                        $status = 'available';
                        $color = '#4CAF50';
                }
            }
            
            $room['current_status'] = $status;
            $room['status_color'] = $color;
            $room['features'] = []; // Placeholder for room features
        }
        
        return $rooms;
    }
    
    /**
     * Get room statistics
     */
    public static function getRoomStatistics() {
        $today = date('Y-m-d');
        
        $sql = "SELECT 
                    COUNT(*) as total_rooms,
                    SUM(CASE 
                        WHEN EXISTS (
                            SELECT 1 FROM qlo_htl_booking_detail hbd 
                            WHERE hbd.id_room = hr.id 
                            AND DATE(:today1) BETWEEN DATE(hbd.date_from) AND DATE(hbd.date_to)
                            AND hbd.id_status NOT IN (3, 7)
                        ) THEN 1 ELSE 0 
                    END) as occupied_rooms,
                    SUM(CASE 
                        WHEN hr.id_status = " . ROOM_STATUS_AVAILABLE . " 
                        AND NOT EXISTS (
                            SELECT 1 FROM qlo_htl_booking_detail hbd 
                            WHERE hbd.id_room = hr.id 
                            AND DATE(:today2) BETWEEN DATE(hbd.date_from) AND DATE(hbd.date_to)
                            AND hbd.id_status NOT IN (3, 7)
                        ) THEN 1 ELSE 0 
                    END) as available_rooms,
                    SUM(CASE WHEN hr.id_status = " . ROOM_STATUS_CLEANING . " THEN 1 ELSE 0 END) as cleaning_rooms,
                    SUM(CASE WHEN hr.id_status = " . ROOM_STATUS_MAINTENANCE . " THEN 1 ELSE 0 END) as maintenance_rooms
                FROM qlo_htl_room_information hr";
        
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute([
            ':today1' => $today,
            ':today2' => $today
        ]);
        
        $stats = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Calculate occupancy rate
        $stats['occupancy_rate'] = $stats['total_rooms'] > 0 
            ? round(($stats['occupied_rooms'] / $stats['total_rooms']) * 100, 1) 
            : 0;
        
        return $stats;
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
                FROM qlo_htl_booking_detail hbd
                JOIN qlo_htl_room_information hr ON hbd.id_room = hr.id
                JOIN qlo_htl_branch_info hb ON hr.id_hotel = hb.id
                JOIN qlo_orders o ON hbd.id_order = o.id_order
                JOIN qlo_customer c ON o.id_customer = c.id_customer
                WHERE DATE(hbd.date_from) = :today
                AND hbd.id_status NOT IN (3, 7)
                ORDER BY hbd.date_from";
        
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute([':today' => $today]);
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
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
                FROM qlo_htl_booking_detail hbd
                JOIN qlo_htl_room_information hr ON hbd.id_room = hr.id
                JOIN qlo_htl_branch_info hb ON hr.id_hotel = hb.id
                JOIN qlo_orders o ON hbd.id_order = o.id_order
                JOIN qlo_customer c ON o.id_customer = c.id_customer
                WHERE DATE(hbd.date_to) = :today
                AND hbd.id_status NOT IN (3, 7)
                ORDER BY hbd.date_to";
        
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute([':today' => $today]);
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
    }
    
    /**
     * Update room status
     */
    public static function updateRoomStatus($roomId, $statusCode) {
        $sql = "UPDATE qlo_htl_room_information 
                SET id_status = :status 
                WHERE id = :room_id";
        
        $stmt = self::$pdo->prepare($sql);
        $result = $stmt->execute([
            ':status' => $statusCode,
            ':room_id' => $roomId
        ]);
        
        if ($result) {
            return [
                'success' => true,
                'message' => 'Room status updated successfully'
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Failed to update room status'
            ];
        }
    }
}

RoomAPI::setPDO($pdo);

// Handle API requests
$method = $_SERVER['REQUEST_METHOD'];
$response = ['success' => false];

try {
    switch ($method) {
        case 'GET':
            if (isset($_GET['action'])) {
                switch ($_GET['action']) {
                    case 'getAllRooms':
                        $response = [
                            'success' => true,
                            'data' => RoomAPI::getAllRooms()
                        ];
                        break;
                    
                    case 'getRoomStatistics':
                        $response = [
                            'success' => true,
                            'data' => RoomAPI::getRoomStatistics()
                        ];
                        break;
                    
                    case 'getTodayCheckIns':
                        $response = [
                            'success' => true,
                            'data' => RoomAPI::getTodayCheckIns()
                        ];
                        break;
                    
                    case 'getTodayCheckOuts':
                        $response = [
                            'success' => true,
                            'data' => RoomAPI::getTodayCheckOuts()
                        ];
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
            
            if (isset($input['action']) && $input['action'] === 'updateRoomStatus') {
                if (isset($input['room_id']) && isset($input['status_code'])) {
                    $result = RoomAPI::updateRoomStatus($input['room_id'], $input['status_code']);
                    $response = $result;
                } else {
                    $response = [
                        'success' => false,
                        'message' => 'Missing room_id or status_code parameter'
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
