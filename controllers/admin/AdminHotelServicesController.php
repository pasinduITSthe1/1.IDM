<?php
/**
 * Hotel Services Management API Controller
 * Handles guest service charges (room service, laundry, spa, etc.)
 */

class AdminHotelServicesController extends ModuleAdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->bootstrap = true;
    }

    /**
     * Supported service types
     */
    private static $serviceTypes = [
        'room_service' => 'Room Service',
        'laundry' => 'Laundry',
        'spa' => 'Spa',
        'gym' => 'Gym',
        'parking' => 'Parking',
        'breakfast' => 'Breakfast',
        'dinner' => 'Dinner',
        'transport' => 'Transport',
        'tour' => 'Tour',
        'other' => 'Other'
    ];

    /**
     * POST /api/hotel/services
     * Add service charge to guest bill
     */
    public function postServicesAction()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        
        if (!$data || !isset($data['id_customer'], $data['service_type'], $data['charge'])) {
            http_response_code(400);
            return $this->jsonResponse([
                'error' => 'Missing required fields: id_customer, service_type, charge'
            ]);
        }

        try {
            $serviceType = $data['service_type'];
            if (!isset(self::$serviceTypes[$serviceType])) {
                throw new Exception('Invalid service type: ' . $serviceType);
            }

            $charge = floatval($data['charge']);
            if ($charge <= 0) {
                throw new Exception('Charge must be greater than 0');
            }

            $result = Db::getInstance()->insert('guest_services', [
                'id_customer' => (int)$data['id_customer'],
                'id_checkin' => isset($data['id_checkin']) ? (int)$data['id_checkin'] : 0,
                'service_type' => $serviceType,
                'service_date' => $data['service_date'] ?? date('Y-m-d H:i:s'),
                'charge' => $charge,
                'status' => $data['status'] ?? 'pending',
                'notes' => $data['notes'] ?? '',
                'created_at' => date('Y-m-d H:i:s')
            ]);

            if (!$result) {
                throw new Exception('Failed to record service');
            }

            http_response_code(201);
            return $this->jsonResponse([
                'success' => true,
                'message' => 'Service recorded successfully',
                'service_id' => Db::getInstance()->Insert_ID(),
                'service_type' => self::$serviceTypes[$serviceType],
                'charge' => $charge
            ]);

        } catch (Exception $e) {
            http_response_code(400);
            return $this->jsonResponse([
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * GET /api/hotel/services/{id}
     * Get service details
     */
    public function getServicesAction()
    {
        $id = (int)Tools::getValue('id', 0);
        
        if (!$id) {
            http_response_code(400);
            return $this->jsonResponse(['error' => 'Service ID required']);
        }

        $service = Db::getInstance()->getRow(
            'SELECT * FROM `' . _DB_PREFIX_ . 'guest_services` WHERE `id` = ' . $id
        );

        if (!$service) {
            http_response_code(404);
            return $this->jsonResponse(['error' => 'Service not found']);
        }

        return $this->jsonResponse($service);
    }

    /**
     * GET /api/hotel/customers/{id}/services
     * Get all services for a customer
     */
    public function getCustomerServicesAction()
    {
        $customerId = (int)Tools::getValue('id_customer', 0);
        
        if (!$customerId) {
            http_response_code(400);
            return $this->jsonResponse(['error' => 'Customer ID required']);
        }

        $services = Db::getInstance()->executeS(
            'SELECT * FROM `' . _DB_PREFIX_ . 'guest_services` 
             WHERE `id_customer` = ' . $customerId . '
             ORDER BY `service_date` DESC'
        );

        $total = Db::getInstance()->getValue(
            'SELECT SUM(`charge`) FROM `' . _DB_PREFIX_ . 'guest_services` 
             WHERE `id_customer` = ' . $customerId
        );

        return $this->jsonResponse([
            'services' => $services ?: [],
            'total_charges' => floatval($total ?: 0)
        ]);
    }

    /**
     * GET /api/hotel/service-types
     * Get available service types
     */
    public function getServiceTypesAction()
    {
        return $this->jsonResponse([
            'service_types' => self::$serviceTypes
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
