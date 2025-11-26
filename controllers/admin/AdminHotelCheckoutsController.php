<?php
/**
 * Hotel Check-out Management API Controller
 * Handles guest check-out operations and final billing
 */

class AdminHotelCheckoutsController extends ModuleAdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->bootstrap = true;
    }

    /**
     * POST /api/hotel/checkouts
     * Record guest check-out with final bill
     */
    public function postCheckoutsAction()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        
        if (!$data || !isset($data['id_customer'], $data['id_checkin'], $data['id_room'])) {
            http_response_code(400);
            return $this->jsonResponse([
                'error' => 'Missing required fields: id_customer, id_checkin, id_room'
            ]);
        }

        try {
            $checkOutTime = $data['check_out_time'] ?? date('Y-m-d H:i:s');
            $finalBill = floatval($data['final_bill'] ?? 0);
            $paymentStatus = $data['payment_status'] ?? 'pending';

            // Calculate bill if not provided
            if ($finalBill === 0) {
                $finalBill = $this->calculateGuestBill((int)$data['id_checkin']);
            }

            // Insert check-out record
            $result = Db::getInstance()->insert('guest_checkouts', [
                'id_customer' => (int)$data['id_customer'],
                'id_checkin' => (int)$data['id_checkin'],
                'id_room' => (int)$data['id_room'],
                'check_out_time' => $checkOutTime,
                'check_out_method' => $data['check_out_method'] ?? 'app',
                'checked_out_by' => $data['checked_out_by'] ?? 'app_user',
                'final_bill' => $finalBill,
                'payment_status' => $paymentStatus,
                'notes' => $data['notes'] ?? '',
                'status' => 'checked_out',
                'created_at' => date('Y-m-d H:i:s')
            ]);

            if (!$result) {
                throw new Exception('Failed to insert check-out record');
            }

            // Update customer note field
            $customer = new Customer((int)$data['id_customer']);
            $customer->note = sprintf(
                "Checked out on %s - Final Bill: %s",
                $checkOutTime,
                Currency::getSymbolByCode(Context::getContext()->currency->iso_code) . number_format($finalBill, 2)
            );
            $customer->save();

            // Release room
            $this->releaseRoom((int)$data['id_room']);

            // Update check-in status
            Db::getInstance()->update('guest_checkins',
                ['status' => 'checked_out'],
                'id = ' . (int)$data['id_checkin']
            );

            http_response_code(201);
            return $this->jsonResponse([
                'success' => true,
                'message' => 'Guest checked out successfully',
                'checkout_id' => Db::getInstance()->Insert_ID(),
                'final_bill' => $finalBill,
                'payment_status' => $paymentStatus
            ]);

        } catch (Exception $e) {
            http_response_code(400);
            return $this->jsonResponse([
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Calculate total bill for guest stay
     */
    private function calculateGuestBill($checkinId)
    {
        $checkin = Db::getInstance()->getRow(
            'SELECT * FROM `' . _DB_PREFIX_ . 'guest_checkins` WHERE `id` = ' . (int)$checkinId
        );

        if (!$checkin) {
            return 0;
        }

        $customerId = $checkin['id_customer'];
        $bookingId = $checkin['id_booking'];

        // Get booking charges
        $booking = Db::getInstance()->getRow(
            'SELECT * FROM `' . _DB_PREFIX_ . 'qlo_htl_booking_detail` WHERE `id_booking` = ' . (int)$bookingId
        );
        $bookingTotal = $booking ? floatval($booking['total_price']) : 0;

        // Get service charges
        $services = Db::getInstance()->executeS(
            'SELECT SUM(`charge`) as total FROM `' . _DB_PREFIX_ . 'guest_services` 
             WHERE `id_customer` = ' . (int)$customerId . ' 
             AND `id_checkin` = ' . (int)$checkinId
        );
        $servicesTotal = $services ? floatval($services[0]['total']) : 0;

        // Get any additional payments recorded
        $payments = Db::getInstance()->executeS(
            'SELECT SUM(`amount`) as total FROM `' . _DB_PREFIX_ . 'guest_payments` 
             WHERE `id_customer` = ' . (int)$customerId . ' 
             AND `id_checkin` = ' . (int)$checkinId . '
             AND `payment_status` = "completed"'
        );
        $paidTotal = $payments ? floatval($payments[0]['total']) : 0;

        return $bookingTotal + $servicesTotal - $paidTotal;
    }

    /**
     * Release room assignment
     */
    private function releaseRoom($roomId)
    {
        $assignment = Db::getInstance()->getRow(
            'SELECT * FROM `' . _DB_PREFIX_ . 'room_assignments` 
             WHERE `id_room` = ' . (int)$roomId . ' 
             AND `status` = "assigned"
             ORDER BY `id` DESC LIMIT 1'
        );

        if ($assignment) {
            Db::getInstance()->update('room_assignments',
                [
                    'status' => 'released',
                    'release_date' => date('Y-m-d H:i:s')
                ],
                'id = ' . (int)$assignment['id']
            );
        }

        // Update room status
        Db::getInstance()->update('qlo_htl_room',
            ['status' => 'available'],
            'id_room = ' . (int)$roomId
        );
    }

    /**
     * GET /api/hotel/checkouts/{id}
     * Get check-out details
     */
    public function getCheckoutsAction()
    {
        $id = (int)Tools::getValue('id', 0);
        
        if (!$id) {
            http_response_code(400);
            return $this->jsonResponse(['error' => 'Check-out ID required']);
        }

        $checkout = Db::getInstance()->getRow(
            'SELECT * FROM `' . _DB_PREFIX_ . 'guest_checkouts` WHERE `id` = ' . $id
        );

        if (!$checkout) {
            http_response_code(404);
            return $this->jsonResponse(['error' => 'Check-out not found']);
        }

        return $this->jsonResponse($checkout);
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
