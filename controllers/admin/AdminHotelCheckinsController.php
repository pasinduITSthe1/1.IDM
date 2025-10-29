<?php
/**
 * Hotel Check-in Management API Controller
 * Handles guest check-in operations and room assignments
 */

class AdminHotelCheckinsController extends ModuleAdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->bootstrap = true;
    }

    /**
     * POST /api/hotel/checkins
     * Record guest check-in
     */
    public function postCheckinsAction()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        
        if (!$data || !isset($data['id_customer'], $data['id_booking'], $data['id_room'])) {
            http_response_code(400);
            return $this->jsonResponse([
                'error' => 'Missing required fields: id_customer, id_booking, id_room'
            ]);
        }

        try {
            // Create check-in record
            $checkIn = new ObjectModel();
            $checkIn->id_customer = (int)$data['id_customer'];
            $checkIn->id_booking = (int)$data['id_booking'];
            $checkIn->id_room = (int)$data['id_room'];
            $checkIn->room_number = $data['room_number'] ?? '';
            $checkIn->check_in_time = $data['check_in_time'] ?? date('Y-m-d H:i:s');
            $checkIn->check_in_method = $data['check_in_method'] ?? 'app';
            $checkIn->checked_in_by = $data['checked_in_by'] ?? 'app_user';
            $checkIn->notes = $data['notes'] ?? '';

            // Insert into guest_checkins table
            $result = Db::getInstance()->insert('guest_checkins', [
                'id_customer' => $checkIn->id_customer,
                'id_booking' => $checkIn->id_booking,
                'id_room' => $checkIn->id_room,
                'room_number' => $checkIn->room_number,
                'check_in_time' => $checkIn->check_in_time,
                'check_in_method' => $checkIn->check_in_method,
                'checked_in_by' => $checkIn->checked_in_by,
                'notes' => $checkIn->notes,
                'status' => 'checked_in',
                'created_at' => date('Y-m-d H:i:s')
            ]);

            if (!$result) {
                throw new Exception('Failed to insert check-in record');
            }

            // Update customer note field to track check-in
            $customer = new Customer($checkIn->id_customer);
            $customer->note = sprintf(
                "Checked in on %s - Room: %s",
                $checkIn->check_in_time,
                $checkIn->room_number
            );
            $customer->save();

            // Update booking status to checked_in
            $this->updateBookingStatus($checkIn->id_booking, 'checked_in');

            http_response_code(201);
            return $this->jsonResponse([
                'success' => true,
                'message' => 'Guest checked in successfully',
                'checkin_id' => Db::getInstance()->Insert_ID(),
                'room_number' => $checkIn->room_number
            ]);

        } catch (Exception $e) {
            http_response_code(400);
            return $this->jsonResponse([
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * GET /api/hotel/checkins/{id}
     * Get check-in details
     */
    public function getCheckinsAction()
    {
        $id = (int)Tools::getValue('id', 0);
        
        if (!$id) {
            http_response_code(400);
            return $this->jsonResponse(['error' => 'Check-in ID required']);
        }

        $checkin = Db::getInstance()->getRow(
            'SELECT * FROM `' . _DB_PREFIX_ . 'guest_checkins` WHERE `id` = ' . $id
        );

        if (!$checkin) {
            http_response_code(404);
            return $this->jsonResponse(['error' => 'Check-in not found']);
        }

        return $this->jsonResponse($checkin);
    }

    /**
     * Helper: Update booking status
     */
    private function updateBookingStatus($bookingId, $status)
    {
        Db::getInstance()->update('qlo_htl_booking_detail', 
            ['status' => $status],
            'id_booking = ' . (int)$bookingId
        );
    }

    /**
     * JSON Response helper
     */
    private function jsonResponse($data)
    {
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
}
?>
