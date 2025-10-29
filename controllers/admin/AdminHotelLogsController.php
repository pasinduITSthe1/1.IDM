<?php
/**
 * Hotel Audit Logging API Controller
 * Handles audit trail for all guest operations
 */

class AdminHotelLogsController extends ModuleAdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->bootstrap = true;
    }

    /**
     * POST /api/hotel/logs
     * Record audit log entry
     */
    public function postLogsAction()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        
        if (!$data || !isset($data['id_customer'], $data['action_type'])) {
            http_response_code(400);
            return $this->jsonResponse([
                'error' => 'Missing required fields: id_customer, action_type'
            ]);
        }

        try {
            $result = Db::getInstance()->insert('guest_logs', [
                'id_customer' => (int)$data['id_customer'],
                'action_type' => $data['action_type'],
                'action_description' => $data['action_description'] ?? '',
                'performed_by' => $data['performed_by'] ?? 'system',
                'performed_at' => $data['performed_at'] ?? date('Y-m-d H:i:s'),
                'ip_address' => Tools::getRemoteAddr(),
                'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? '',
                'created_at' => date('Y-m-d H:i:s')
            ]);

            if (!$result) {
                throw new Exception('Failed to record log');
            }

            return $this->jsonResponse([
                'success' => true,
                'log_id' => Db::getInstance()->Insert_ID()
            ]);

        } catch (Exception $e) {
            http_response_code(400);
            return $this->jsonResponse([
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * GET /api/hotel/customers/{id}/timeline
     * Get complete guest activity timeline
     */
    public function getGuestTimelineAction()
    {
        $customerId = (int)Tools::getValue('id_customer', 0);
        
        if (!$customerId) {
            http_response_code(400);
            return $this->jsonResponse(['error' => 'Customer ID required']);
        }

        try {
            // Get check-in entries
            $checkins = Db::getInstance()->executeS(
                'SELECT "checkin" as event_type, `id`, `check_in_time` as `event_time`, 
                        `room_number`, NULL as amount, `checked_in_by` as performed_by
                 FROM `' . _DB_PREFIX_ . 'guest_checkins` 
                 WHERE `id_customer` = ' . $customerId
            );

            // Get check-out entries
            $checkouts = Db::getInstance()->executeS(
                'SELECT "checkout" as event_type, `id`, `check_out_time` as `event_time`, 
                        NULL as room_number, `final_bill` as amount, `checked_out_by` as performed_by
                 FROM `' . _DB_PREFIX_ . 'guest_checkouts` 
                 WHERE `id_customer` = ' . $customerId
            );

            // Get payment entries
            $payments = Db::getInstance()->executeS(
                'SELECT "payment" as event_type, `id`, `payment_date` as `event_time`, 
                        `payment_method` as room_number, `amount`, "payment_system" as performed_by
                 FROM `' . _DB_PREFIX_ . 'guest_payments` 
                 WHERE `id_customer` = ' . $customerId
            );

            // Get service entries
            $services = Db::getInstance()->executeS(
                'SELECT "service" as event_type, `id`, `service_date` as `event_time`, 
                        `service_type` as room_number, `charge` as amount, "staff" as performed_by
                 FROM `' . _DB_PREFIX_ . 'guest_services` 
                 WHERE `id_customer` = ' . $customerId
            );

            // Get log entries
            $logs = Db::getInstance()->executeS(
                'SELECT "log" as event_type, `id`, `performed_at` as `event_time`, 
                        `action_type` as room_number, NULL as amount, `performed_by`
                 FROM `' . _DB_PREFIX_ . 'guest_logs` 
                 WHERE `id_customer` = ' . $customerId
            );

            // Merge and sort by date
            $timeline = array_merge(
                $checkins ?: [],
                $checkouts ?: [],
                $payments ?: [],
                $services ?: [],
                $logs ?: []
            );

            usort($timeline, function($a, $b) {
                return strtotime($b['event_time']) - strtotime($a['event_time']);
            });

            return $this->jsonResponse([
                'success' => true,
                'customer_id' => $customerId,
                'timeline' => $timeline,
                'total_events' => count($timeline)
            ]);

        } catch (Exception $e) {
            http_response_code(400);
            return $this->jsonResponse([
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * GET /api/hotel/guests/{id}/status
     * Get current guest status
     */
    public function getGuestStatusAction()
    {
        $customerId = (int)Tools::getValue('id', 0);
        
        if (!$customerId) {
            http_response_code(400);
            return $this->jsonResponse(['error' => 'Customer ID required']);
        }

        try {
            $customer = new Customer($customerId);
            
            // Get latest check-in
            $latestCheckin = Db::getInstance()->getRow(
                'SELECT * FROM `' . _DB_PREFIX_ . 'guest_checkins` 
                 WHERE `id_customer` = ' . $customerId . '
                 ORDER BY `check_in_time` DESC LIMIT 1'
            );

            // Get latest check-out
            $latestCheckout = Db::getInstance()->getRow(
                'SELECT * FROM `' . _DB_PREFIX_ . 'guest_checkouts` 
                 WHERE `id_customer` = ' . $customerId . '
                 ORDER BY `check_out_time` DESC LIMIT 1'
            );

            // Determine current status
            $status = 'not_checked_in';
            if ($latestCheckin && (!$latestCheckout || strtotime($latestCheckin['check_in_time']) > strtotime($latestCheckout['check_out_time']))) {
                $status = 'checked_in';
            } elseif ($latestCheckout) {
                $status = 'checked_out';
            }

            // Get current room if checked in
            $currentRoom = null;
            if ($status === 'checked_in' && $latestCheckin) {
                $currentRoom = Db::getInstance()->getRow(
                    'SELECT * FROM `' . _DB_PREFIX_ . 'qlo_htl_room` 
                     WHERE `id_room` = ' . (int)$latestCheckin['id_room']
                );
            }

            return $this->jsonResponse([
                'customer_id' => $customerId,
                'customer_name' => $customer->firstname . ' ' . $customer->lastname,
                'status' => $status,
                'latest_checkin' => $latestCheckin,
                'latest_checkout' => $latestCheckout,
                'current_room' => $currentRoom,
                'as_of' => date('Y-m-d H:i:s')
            ]);

        } catch (Exception $e) {
            http_response_code(400);
            return $this->jsonResponse([
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * GET /api/hotel/checkins/{id}/bill
     * Get bill for check-in
     */
    public function getCheckInBillAction()
    {
        $checkinId = (int)Tools::getValue('id', 0);
        
        if (!$checkinId) {
            http_response_code(400);
            return $this->jsonResponse(['error' => 'Check-in ID required']);
        }

        try {
            $checkin = Db::getInstance()->getRow(
                'SELECT * FROM `' . _DB_PREFIX_ . 'guest_checkins` WHERE `id` = ' . $checkinId
            );

            if (!$checkin) {
                http_response_code(404);
                return $this->jsonResponse(['error' => 'Check-in not found']);
            }

            $customerId = $checkin['id_customer'];
            $bookingId = $checkin['id_booking'];

            // Booking charges
            $booking = Db::getInstance()->getRow(
                'SELECT * FROM `' . _DB_PREFIX_ . 'qlo_htl_booking_detail` 
                 WHERE `id_booking` = ' . (int)$bookingId
            );
            $bookingAmount = $booking ? floatval($booking['total_price']) : 0;

            // Service charges
            $services = Db::getInstance()->executeS(
                'SELECT * FROM `' . _DB_PREFIX_ . 'guest_services` 
                 WHERE `id_customer` = ' . $customerId . ' 
                 AND `id_checkin` = ' . $checkinId
            );
            $servicesAmount = array_sum(array_map(function($s) { return floatval($s['charge']); }, $services ?: []));

            // Payments received
            $payments = Db::getInstance()->executeS(
                'SELECT * FROM `' . _DB_PREFIX_ . 'guest_payments` 
                 WHERE `id_customer` = ' . $customerId . ' 
                 AND `id_checkin` = ' . $checkinId
            );
            $paidAmount = array_sum(array_map(function($p) { return floatval($p['amount']); }, $payments ?: []));

            $totalAmount = $bookingAmount + $servicesAmount;
            $balanceDue = $totalAmount - $paidAmount;

            return $this->jsonResponse([
                'checkin_id' => $checkinId,
                'customer_id' => $customerId,
                'booking_charges' => $bookingAmount,
                'services' => $services ?: [],
                'services_total' => $servicesAmount,
                'total_charges' => $totalAmount,
                'payments' => $payments ?: [],
                'total_paid' => $paidAmount,
                'balance_due' => $balanceDue,
                'generated_at' => date('Y-m-d H:i:s')
            ]);

        } catch (Exception $e) {
            http_response_code(400);
            return $this->jsonResponse([
                'error' => $e->getMessage()
            ]);
        }
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
