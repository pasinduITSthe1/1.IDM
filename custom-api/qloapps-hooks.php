<?php
// QloApps Integration Hooks - Fixed Version
// Include this in QloApps customer registration process

function notifyCustomerRegistration($customerId, $firstName, $lastName) {
    try {
        $host = 'localhost';
        $dbname = '1.idm_db';
        $username = 'root';
        $password = '';
        
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        include_once $_SERVER['DOCUMENT_ROOT'] . '/1.IDM/custom-api/create-notification.php';
        
        $guestName = trim($firstName . ' ' . $lastName);
        
        // Create registration notification
        createGuestRegistrationNotification($pdo, $guestName, $customerId);
        
        return true;
    } catch (Exception $e) {
        error_log("Customer registration notification error: " . $e->getMessage());
        return false;
    }
}

// QloApps Booking Hook
function notifyBookingCreated($bookingId, $customerId, $roomNumber, $roomType, $amount) {
    try {
        $host = 'localhost';
        $dbname = '1.idm_db';
        $username = 'root';
        $password = '';
        
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        include_once $_SERVER['DOCUMENT_ROOT'] . '/1.IDM/custom-api/create-notification.php';
        
        // Get customer name
        $stmt = $pdo->prepare("SELECT CONCAT(firstname, ' ', lastname) as name FROM qlo_customer WHERE id_customer = ?");
        $stmt->execute([$customerId]);
        $customer = $stmt->fetch(PDO::FETCH_ASSOC);
        $guestName = $customer['name'] ?? 'Guest';
        
        // Create booking notification
        createNotification(
            $pdo,
            'booking',
            'New Booking',
            "$guestName booked $roomType ($roomNumber) - $" . number_format($amount, 2),
            [
                'booking_id' => $bookingId,
                'customer_id' => $customerId,
                'room_number' => $roomNumber,
                'guest_name' => $guestName,
                'room_type' => $roomType,
                'amount' => $amount
            ]
        );
        
        return true;
    } catch (Exception $e) {
        error_log("Booking notification error: " . $e->getMessage());
        return false;
    }
}

// QloApps Check-in Hook
function notifyCheckIn($bookingId, $customerId, $roomNumber) {
    try {
        $host = 'localhost';
        $dbname = '1.idm_db';
        $username = 'root';
        $password = '';
        
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        include_once $_SERVER['DOCUMENT_ROOT'] . '/1.IDM/custom-api/create-notification.php';
        
        // Get customer name
        $stmt = $pdo->prepare("SELECT CONCAT(firstname, ' ', lastname) as name FROM qlo_customer WHERE id_customer = ?");
        $stmt->execute([$customerId]);
        $customer = $stmt->fetch(PDO::FETCH_ASSOC);
        $guestName = $customer['name'] ?? 'Guest';
        
        // Create check-in notification
        createCheckInNotification($pdo, $guestName, $roomNumber, $customerId);
        
        return true;
    } catch (Exception $e) {
        error_log("Check-in notification error: " . $e->getMessage());
        return false;
    }
}

// QloApps Check-out Hook
function notifyCheckOut($bookingId, $customerId, $roomNumber) {
    try {
        $host = 'localhost';
        $dbname = '1.idm_db';
        $username = 'root';
        $password = '';
        
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        include_once $_SERVER['DOCUMENT_ROOT'] . '/1.IDM/custom-api/create-notification.php';
        
        // Get customer name
        $stmt = $pdo->prepare("SELECT CONCAT(firstname, ' ', lastname) as name FROM qlo_customer WHERE id_customer = ?");
        $stmt->execute([$customerId]);
        $customer = $stmt->fetch(PDO::FETCH_ASSOC);
        $guestName = $customer['name'] ?? 'Guest';
        
        // Create check-out notification
        createCheckOutNotification($pdo, $guestName, $roomNumber, $customerId);
        
        return true;
    } catch (Exception $e) {
        error_log("Check-out notification error: " . $e->getMessage());
        return false;
    }
}
?>