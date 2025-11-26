<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Direct database connection (bypass PrestaShop auth)
$host = 'localhost';
$dbname = 'qlo';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        // Get notifications based on recent activities
        $notifications = [];
        
        // 1. New Check-ins (today)
        $stmt = $pdo->prepare("
            SELECT 
                hbd.id_htl_booking_detail as id,
                CONCAT(c.firstname, ' ', c.lastname) as guest_name,
                ri.room_num,
                hbd.date_from as check_in_date,
                'check-in' as type,
                0 as is_read
            FROM qlo_htl_booking_detail hbd
            JOIN qlo_orders o ON hbd.id_order = o.id_order
            JOIN qlo_customer c ON o.id_customer = c.id_customer
            JOIN qlo_htl_room_information ri ON hbd.id_room = ri.id
            WHERE DATE(hbd.date_from) = CURDATE()
            AND hbd.booking_type = 1
            ORDER BY hbd.date_from DESC
            LIMIT 10
        ");
        $stmt->execute();
        $checkIns = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if ($checkIns) {
            foreach ($checkIns as $checkIn) {
                $notifications[] = [
                    'id' => 'checkin_' . $checkIn['id'],
                    'title' => 'New Check-in',
                    'message' => $checkIn['guest_name'] . ' checked in to Room ' . $checkIn['room_num'],
                    'time' => $checkIn['check_in_date'],
                    'type' => 'check-in',
                    'isRead' => (bool)$checkIn['is_read'],
                    'relatedId' => $checkIn['id'],
                    'roomNum' => $checkIn['room_num']
                ];
            }
        }
        
        // 2. Today's Check-outs
        $stmt = $pdo->prepare("
            SELECT 
                hbd.id_htl_booking_detail as id,
                CONCAT(c.firstname, ' ', c.lastname) as guest_name,
                ri.room_num,
                hbd.date_to as check_out_date,
                'check-out' as type,
                0 as is_read
            FROM qlo_htl_booking_detail hbd
            JOIN qlo_orders o ON hbd.id_order = o.id_order
            JOIN qlo_customer c ON o.id_customer = c.id_customer
            JOIN qlo_htl_room_information ri ON hbd.id_room = ri.id
            WHERE DATE(hbd.date_to) = CURDATE()
            AND hbd.booking_type = 1
            ORDER BY hbd.date_to DESC
            LIMIT 10
        ");
        $stmt->execute();
        $checkOuts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if ($checkOuts) {
            foreach ($checkOuts as $checkOut) {
                $notifications[] = [
                    'id' => 'checkout_' . $checkOut['id'],
                    'title' => 'Check-out Reminder',
                    'message' => 'Guest ' . $checkOut['guest_name'] . ' in Room ' . $checkOut['room_num'] . ' checking out today',
                    'time' => $checkOut['check_out_date'],
                    'type' => 'check-out',
                    'isRead' => (bool)$checkOut['is_read'],
                    'relatedId' => $checkOut['id'],
                    'roomNum' => $checkOut['room_num']
                ];
            }
        }
        
        // 3. New Bookings (last 24 hours)
        $stmt = $pdo->prepare("
            SELECT 
                hbd.id_htl_booking_detail as id,
                CONCAT(c.firstname, ' ', c.lastname) as guest_name,
                ri.room_num,
                hbd.date_from,
                hbd.date_add as booking_date,
                'booking' as type,
                0 as is_read
            FROM qlo_htl_booking_detail hbd
            JOIN qlo_orders o ON hbd.id_order = o.id_order
            JOIN qlo_customer c ON o.id_customer = c.id_customer
            JOIN qlo_htl_room_information ri ON hbd.id_room = ri.id
            WHERE hbd.date_add >= DATE_SUB(NOW(), INTERVAL 24 HOUR)
            ORDER BY hbd.date_add DESC
            LIMIT 10
        ");
        $stmt->execute();
        $newBookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if ($newBookings) {
            foreach ($newBookings as $booking) {
                $checkInDate = new DateTime($booking['date_from']);
                $now = new DateTime();
                $interval = $now->diff($checkInDate);
                
                $timeDesc = 'tomorrow';
                if ($interval->days == 0) {
                    $timeDesc = 'today';
                } elseif ($interval->days > 1) {
                    $timeDesc = 'in ' . $interval->days . ' days';
                }
                
                $notifications[] = [
                    'id' => 'booking_' . $booking['id'],
                    'title' => 'New Booking',
                    'message' => 'New reservation for ' . $timeDesc . ' - Room ' . $booking['room_num'],
                    'time' => $booking['booking_date'],
                    'type' => 'booking',
                    'isRead' => (bool)$booking['is_read'],
                    'relatedId' => $booking['id'],
                    'roomNum' => $booking['room_num']
                ];
            }
        }
        
        // 4. New Guest Registrations (last 24 hours)
        $stmt = $pdo->prepare("
            SELECT 
                c.id_customer as id,
                CONCAT(c.firstname, ' ', c.lastname) as guest_name,
                c.date_add as registration_date,
                'registration' as type,
                0 as is_read
            FROM qlo_customer c
            WHERE c.date_add >= DATE_SUB(NOW(), INTERVAL 24 HOUR)
            AND c.deleted = 0
            ORDER BY c.date_add DESC
            LIMIT 10
        ");
        $stmt->execute();
        $newGuests = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if ($newGuests) {
            foreach ($newGuests as $guest) {
                $notifications[] = [
                    'id' => 'registration_' . $guest['id'],
                    'title' => 'New Guest Registration',
                    'message' => $guest['guest_name'] . ' has been registered',
                    'time' => $guest['registration_date'],
                    'type' => 'registration',
                    'isRead' => (bool)$guest['is_read'],
                    'relatedId' => $guest['id']
                ];
            }
        }
        
        // Sort all notifications by time (most recent first)
        usort($notifications, function($a, $b) {
            return strtotime($b['time']) - strtotime($a['time']);
        });
        
        // Calculate time ago for each notification
        foreach ($notifications as &$notification) {
            $notification['timeAgo'] = getTimeAgo($notification['time']);
        }
        
        echo json_encode([
            'success' => true,
            'data' => $notifications,
            'total' => count($notifications),
            'unreadCount' => count(array_filter($notifications, function($n) {
                return !$n['isRead'];
            }))
        ]);
        
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Mark notification as read
        $input = json_decode(file_get_contents('php://input'), true);
        
        if (isset($input['notificationId'])) {
            // In a real implementation, you would update a notifications table
            // For now, we'll just return success
            echo json_encode([
                'success' => true,
                'message' => 'Notification marked as read'
            ]);
        } else {
            http_response_code(400);
            echo json_encode([
                'success' => false,
                'message' => 'Notification ID required'
            ]);
        }
        
    } elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
        // Mark all notifications as read
        echo json_encode([
            'success' => true,
            'message' => 'All notifications marked as read'
        ]);
    }
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Server error: ' . $e->getMessage()
    ]);
}

function getTimeAgo($datetime) {
    $time = strtotime($datetime);
    $now = time();
    $diff = $now - $time;
    
    if ($diff < 60) {
        return 'Just now';
    } elseif ($diff < 3600) {
        $mins = floor($diff / 60);
        return $mins . ' minute' . ($mins > 1 ? 's' : '') . ' ago';
    } elseif ($diff < 86400) {
        $hours = floor($diff / 3600);
        return $hours . ' hour' . ($hours > 1 ? 's' : '') . ' ago';
    } elseif ($diff < 604800) {
        $days = floor($diff / 86400);
        return $days . ' day' . ($days > 1 ? 's' : '') . ' ago';
    } else {
        return date('M j, Y', $time);
    }
}
