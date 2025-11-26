<?php
/**
 * Hotel Payments Management API Controller
 * Handles guest payment processing and recording
 */

class AdminHotelPaymentsController extends ModuleAdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->bootstrap = true;
    }

    /**
     * POST /api/hotel/payments
     * Record guest payment
     */
    public function postPaymentsAction()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        
        if (!$data || !isset($data['id_customer'], $data['amount'])) {
            http_response_code(400);
            return $this->jsonResponse([
                'error' => 'Missing required fields: id_customer, amount'
            ]);
        }

        try {
            $amount = floatval($data['amount']);
            if ($amount <= 0) {
                throw new Exception('Amount must be greater than 0');
            }

            $result = Db::getInstance()->insert('guest_payments', [
                'id_customer' => (int)$data['id_customer'],
                'id_checkin' => isset($data['id_checkin']) ? (int)$data['id_checkin'] : 0,
                'payment_date' => $data['payment_date'] ?? date('Y-m-d H:i:s'),
                'amount' => $amount,
                'payment_method' => $data['payment_method'] ?? 'cash',
                'payment_status' => $data['payment_status'] ?? 'completed',
                'reference_number' => $data['reference_number'] ?? '',
                'notes' => $data['notes'] ?? '',
                'created_at' => date('Y-m-d H:i:s')
            ]);

            if (!$result) {
                throw new Exception('Failed to record payment');
            }

            http_response_code(201);
            return $this->jsonResponse([
                'success' => true,
                'message' => 'Payment recorded successfully',
                'payment_id' => Db::getInstance()->Insert_ID(),
                'amount' => $amount
            ]);

        } catch (Exception $e) {
            http_response_code(400);
            return $this->jsonResponse([
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * GET /api/hotel/payments/{id}
     * Get payment details
     */
    public function getPaymentsAction()
    {
        $id = (int)Tools::getValue('id', 0);
        
        if (!$id) {
            http_response_code(400);
            return $this->jsonResponse(['error' => 'Payment ID required']);
        }

        $payment = Db::getInstance()->getRow(
            'SELECT * FROM `' . _DB_PREFIX_ . 'guest_payments` WHERE `id` = ' . $id
        );

        if (!$payment) {
            http_response_code(404);
            return $this->jsonResponse(['error' => 'Payment not found']);
        }

        return $this->jsonResponse($payment);
    }

    /**
     * GET /api/hotel/customers/{id}/payments
     * Get all payments for a customer
     */
    public function getCustomerPaymentsAction()
    {
        $customerId = (int)Tools::getValue('id_customer', 0);
        
        if (!$customerId) {
            http_response_code(400);
            return $this->jsonResponse(['error' => 'Customer ID required']);
        }

        $payments = Db::getInstance()->executeS(
            'SELECT * FROM `' . _DB_PREFIX_ . 'guest_payments` 
             WHERE `id_customer` = ' . $customerId . '
             ORDER BY `payment_date` DESC'
        );

        $total = Db::getInstance()->getValue(
            'SELECT SUM(`amount`) FROM `' . _DB_PREFIX_ . 'guest_payments` 
             WHERE `id_customer` = ' . $customerId
        );

        return $this->jsonResponse([
            'payments' => $payments ?: [],
            'total_paid' => floatval($total ?: 0)
        ]);
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
