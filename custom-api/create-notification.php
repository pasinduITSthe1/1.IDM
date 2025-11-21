<?php
// Helper function to create notifications
function createNotification($pdo, $type, $title, $message, $metadata = null) {
    try {
        $stmt = $pdo->prepare("
            INSERT INTO notifications (type, title, message, timestamp, is_read, metadata)
            VALUES (:type, :title, :message, NOW(), 0, :metadata)
        ");
        
        $stmt->execute([
            'type' => $type,
            'title' => $title,
            'message' => $message,
            'metadata' => $metadata ? json_encode($metadata) : null
        ]);
        
        return $stmt->rowCount() > 0;
    } catch (Exception $e) {
        error_log("Failed to create notification: " . $e->getMessage());
        return false;
    }
}

// Function to create guest registration notification
function createGuestRegistrationNotification($pdo, $guestName, $customerId) {
    return createNotification(
        $pdo,
        'registration',
        'New Guest Registration',
        "$guestName has been registered as a new guest",
        ['customer_id' => $customerId, 'guest_name' => $guestName]
    );
}

// Function to create check-in notification
function createCheckInNotification($pdo, $guestName, $roomNumber, $customerId) {
    return createNotification(
        $pdo,
        'checkin',
        'New Check-In',
        "$guestName checked in to Room $roomNumber",
        ['customer_id' => $customerId, 'guest_name' => $guestName, 'room' => $roomNumber]
    );
}

// Function to create check-out notification
function createCheckOutNotification($pdo, $guestName, $roomNumber, $customerId) {
    return createNotification(
        $pdo,
        'checkout',
        'Guest Check-Out',
        "$guestName checked out from Room $roomNumber",
        ['customer_id' => $customerId, 'guest_name' => $guestName, 'room' => $roomNumber]
    );
}

// Function to create service request notification
function createServiceRequestNotification($pdo, $roomNumber, $serviceType) {
    return createNotification(
        $pdo,
        'service',
        'Room Service Request',
        "Room $roomNumber requested $serviceType",
        ['room' => $roomNumber, 'service_type' => $serviceType]
    );
}
?>