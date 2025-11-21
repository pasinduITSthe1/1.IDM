<?php
// Real-time QloApps integration for notifications
// This monitors actual hotel activities and creates notifications
header('Content-Type: application/json');

try {
    $host = 'localhost';
    $dbname = '1.idm_db';
    $username = 'root';
    $password = '';
    
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    include_once 'create-notification.php';
    
    $results = [
        'new_registrations' => 0,
        'new_bookings' => 0,
        'pending_checkins' => 0,
        'pending_checkouts' => 0,
        'total_created' => 0
    ];
    
    // 1. Check for NEW CUSTOMER REGISTRATIONS (last 24 hours)
    $newCustomersStmt = $pdo->prepare("
        SELECT 
            id_customer,
            CONCAT(firstname, ' ', lastname) as full_name,
            date_add
        FROM qlo_customer 
        WHERE date_add >= DATE_SUB(NOW(), INTERVAL 24 HOUR)
        AND id_customer NOT IN (
            SELECT JSON_UNQUOTE(JSON_EXTRACT(metadata, '$.customer_id'))
            FROM notifications 
            WHERE type = 'registration' 
            AND JSON_UNQUOTE(JSON_EXTRACT(metadata, '$.customer_id')) IS NOT NULL
        )
        ORDER BY date_add DESC
    ");
    $newCustomersStmt->execute();
    $newCustomers = $newCustomersStmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($newCustomers as $customer) {
        createGuestRegistrationNotification($pdo, $customer['full_name'], $customer['id_customer']);
        $results['new_registrations']++;
        $results['total_created']++;
    }
    
    // 2. Check for NEW BOOKINGS (last 2 hours)
    $newBookingsStmt = $pdo->prepare("
        SELECT 
            bd.id,
            bd.id_customer,
            bd.room_num,
            bd.room_type_name,
            bd.total_price_tax_incl,
            bd.date_add,
            CONCAT(c.firstname, ' ', c.lastname) as guest_name
        FROM qlo_htl_booking_detail bd
        LEFT JOIN qlo_customer c ON bd.id_customer = c.id_customer
        WHERE bd.date_add >= DATE_SUB(NOW(), INTERVAL 2 HOUR)
        AND bd.id NOT IN (
            SELECT JSON_UNQUOTE(JSON_EXTRACT(metadata, '$.booking_id'))
            FROM notifications 
            WHERE type = 'booking'
            AND JSON_UNQUOTE(JSON_EXTRACT(metadata, '$.booking_id')) IS NOT NULL
        )
        ORDER BY bd.date_add DESC
    ");
    $newBookingsStmt->execute();
    $newBookings = $newBookingsStmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($newBookings as $booking) {
        $guestName = $booking['guest_name'] ?: 'Guest';
        
        createNotification(
            $pdo,
            'booking',
            'New Booking',
            "$guestName booked {$booking['room_type_name']} ({$booking['room_num']}) - $" . number_format($booking['total_price_tax_incl'], 2),
            [
                'booking_id' => $booking['id'],
                'customer_id' => $booking['id_customer'],
                'room_number' => $booking['room_num'],
                'guest_name' => $guestName,
                'room_type' => $booking['room_type_name'],
                'amount' => $booking['total_price_tax_incl']
            ]
        );
        $results['new_bookings']++;
        $results['total_created']++;
    }
    
    // 3. Check for PENDING CHECK-INS (recent bookings that haven't checked in)
    $pendingCheckinsStmt = $pdo->prepare("
        SELECT 
            bd.id,
            bd.id_customer,
            bd.room_num,
            bd.room_type_name,
            bd.date_from,
            bd.check_in,
            CONCAT(c.firstname, ' ', c.lastname) as guest_name
        FROM qlo_htl_booking_detail bd
        LEFT JOIN qlo_customer c ON bd.id_customer = c.id_customer
        WHERE (
            DATE(bd.date_from) = CURDATE() 
            OR DATE(bd.date_from) BETWEEN DATE_SUB(CURDATE(), INTERVAL 3 DAY) AND CURDATE()
        )
        AND (bd.check_in = '0000-00-00 00:00:00' OR bd.check_in IS NULL)
        AND bd.id NOT IN (
            SELECT JSON_UNQUOTE(JSON_EXTRACT(metadata, '$.booking_id'))
            FROM notifications 
            WHERE type = 'checkin'
            AND JSON_UNQUOTE(JSON_EXTRACT(metadata, '$.booking_id')) IS NOT NULL
        )
        ORDER BY bd.date_from ASC
    ");
    $pendingCheckinsStmt->execute();
    $pendingCheckins = $pendingCheckinsStmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($pendingCheckins as $checkin) {
        $guestName = $checkin['guest_name'] ?: 'Guest';
        $isOverdue = strtotime($checkin['date_from']) < strtotime('today');
        $title = $isOverdue ? 'Overdue Check-in' : 'Pending Check-in';
        $message = $isOverdue ? 
            "$guestName - Overdue check-in to Room {$checkin['room_num']}" :
            "$guestName expected to check-in - Room {$checkin['room_num']}";
        
        createNotification(
            $pdo,
            'checkin',
            $title,
            $message,
            [
                'booking_id' => $checkin['id'],
                'customer_id' => $checkin['id_customer'],
                'room_number' => $checkin['room_num'],
                'guest_name' => $guestName,
                'scheduled_date' => $checkin['date_from'],
                'is_overdue' => $isOverdue
            ]
        );
        $results['pending_checkins']++;
        $results['total_created']++;
    }
    
    // 4. Check for PENDING CHECK-OUTS (bookings that need checkout - expand to recent dates)
    $pendingCheckoutsStmt = $pdo->prepare("
        SELECT 
            bd.id,
            bd.id_customer,
            bd.room_num,
            bd.room_type_name,
            bd.date_to,
            bd.check_out,
            CONCAT(c.firstname, ' ', c.lastname) as guest_name
        FROM qlo_htl_booking_detail bd
        LEFT JOIN qlo_customer c ON bd.id_customer = c.id_customer
        WHERE (
            DATE(bd.date_to) = CURDATE() 
            OR DATE(bd.date_to) BETWEEN DATE_SUB(CURDATE(), INTERVAL 3 DAY) AND CURDATE()
        )
        AND (bd.check_out = '0000-00-00 00:00:00' OR bd.check_out IS NULL)
        AND bd.id NOT IN (
            SELECT JSON_UNQUOTE(JSON_EXTRACT(metadata, '$.booking_id'))
            FROM notifications 
            WHERE type = 'checkout'
            AND JSON_UNQUOTE(JSON_EXTRACT(metadata, '$.booking_id')) IS NOT NULL
        )
        ORDER BY bd.date_to ASC
    ");
    $pendingCheckoutsStmt->execute();
    $pendingCheckouts = $pendingCheckoutsStmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($pendingCheckouts as $checkout) {
        $guestName = $checkout['guest_name'] ?: 'Guest';
        $isOverdue = strtotime($checkout['date_to']) < strtotime('today');
        $title = $isOverdue ? 'Overdue Check-out' : 'Pending Check-out';
        $message = $isOverdue ? 
            "$guestName - Overdue checkout from Room {$checkout['room_num']}" :
            "$guestName scheduled to check-out - Room {$checkout['room_num']}";
        
        createNotification(
            $pdo,
            'checkout',
            $title,
            $message,
            [
                'booking_id' => $checkout['id'],
                'customer_id' => $checkout['id_customer'],
                'room_number' => $checkout['room_num'],
                'guest_name' => $guestName,
                'scheduled_date' => $checkout['date_to'],
                'is_overdue' => $isOverdue
            ]
        );
        $results['pending_checkouts']++;
        $results['total_created']++;
    }
    
    echo json_encode([
        'success' => true,
        'message' => 'Real QloApps notifications synchronized',
        'data' => $results
    ]);
    
} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Database error: ' . $e->getMessage()
    ]);
}
?>