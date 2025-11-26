<?php
/**
 * Hotel Room Management API Controller
 * Handles room assignment, release, and availability
 */

class AdminHotelRoomsController extends ModuleAdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->bootstrap = true;
    }

    /**
     * GET /api/hotel/rooms/available
     * Get list of available rooms
     */
    public function getAvailableRoomsAction()
    {
        try {
            $rooms = Db::getInstance()->executeS(
                'SELECT r.*, rt.`name` as room_type_name, rt.`price` 
                 FROM `' . _DB_PREFIX_ . 'qlo_htl_room` r
                 LEFT JOIN `' . _DB_PREFIX_ . 'qlo_htl_room_type` rt ON r.`id_room_type` = rt.`id`
                 WHERE r.`status` = "available"
                 ORDER BY r.`room_number` ASC'
            );

            return $this->jsonResponse([
                'success' => true,
                'rooms' => $rooms ?: [],
                'total' => count($rooms ?: [])
            ]);

        } catch (Exception $e) {
            http_response_code(400);
            return $this->jsonResponse([
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * POST /api/hotel/room-assignments
     * Assign room to guest
     */
    public function postRoomAssignmentsAction()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        
        if (!$data || !isset($data['id_customer'], $data['id_room'])) {
            http_response_code(400);
            return $this->jsonResponse([
                'error' => 'Missing required fields: id_customer, id_room'
            ]);
        }

        try {
            $customerId = (int)$data['id_customer'];
            $roomId = (int)$data['id_room'];
            $bookingId = isset($data['id_booking']) ? (int)$data['id_booking'] : 0;

            // Check if room is available
            $room = Db::getInstance()->getRow(
                'SELECT * FROM `' . _DB_PREFIX_ . 'qlo_htl_room` WHERE `id_room` = ' . $roomId
            );

            if (!$room) {
                throw new Exception('Room not found');
            }

            if ($room['status'] !== 'available') {
                throw new Exception('Room is not available');
            }

            // Create assignment
            $result = Db::getInstance()->insert('room_assignments', [
                'id_customer' => $customerId,
                'id_room' => $roomId,
                'id_booking' => $bookingId,
                'assignment_date' => $data['assignment_date'] ?? date('Y-m-d H:i:s'),
                'status' => 'assigned',
                'created_at' => date('Y-m-d H:i:s')
            ]);

            if (!$result) {
                throw new Exception('Failed to assign room');
            }

            // Update room status
            Db::getInstance()->update('qlo_htl_room',
                ['status' => 'occupied'],
                'id_room = ' . $roomId
            );

            http_response_code(201);
            return $this->jsonResponse([
                'success' => true,
                'message' => 'Room assigned successfully',
                'assignment_id' => Db::getInstance()->Insert_ID(),
                'room_number' => $room['room_number']
            ]);

        } catch (Exception $e) {
            http_response_code(400);
            return $this->jsonResponse([
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * PUT /api/hotel/room-assignments/{id}
     * Release/unassign room
     */
    public function putRoomAssignmentsAction()
    {
        $id = (int)Tools::getValue('id', 0);
        $data = json_decode(file_get_contents('php://input'), true);

        if (!$id) {
            http_response_code(400);
            return $this->jsonResponse(['error' => 'Assignment ID required']);
        }

        try {
            $assignment = Db::getInstance()->getRow(
                'SELECT * FROM `' . _DB_PREFIX_ . 'room_assignments` WHERE `id` = ' . $id
            );

            if (!$assignment) {
                http_response_code(404);
                return $this->jsonResponse(['error' => 'Assignment not found']);
            }

            // Update assignment status
            Db::getInstance()->update('room_assignments',
                [
                    'status' => 'released',
                    'release_date' => $data['release_date'] ?? date('Y-m-d H:i:s')
                ],
                'id = ' . $id
            );

            // Update room status
            Db::getInstance()->update('qlo_htl_room',
                ['status' => 'available'],
                'id_room = ' . (int)$assignment['id_room']
            );

            return $this->jsonResponse([
                'success' => true,
                'message' => 'Room released successfully',
                'assignment_id' => $id
            ]);

        } catch (Exception $e) {
            http_response_code(400);
            return $this->jsonResponse([
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * GET /api/hotel/rooms/{id}/status
     * Get room status
     */
    public function getRoomStatusAction()
    {
        $roomId = (int)Tools::getValue('id', 0);
        
        if (!$roomId) {
            http_response_code(400);
            return $this->jsonResponse(['error' => 'Room ID required']);
        }

        try {
            $room = Db::getInstance()->getRow(
                'SELECT * FROM `' . _DB_PREFIX_ . 'qlo_htl_room` WHERE `id_room` = ' . $roomId
            );

            if (!$room) {
                http_response_code(404);
                return $this->jsonResponse(['error' => 'Room not found']);
            }

            // Get current assignment if occupied
            $assignment = null;
            if ($room['status'] === 'occupied') {
                $assignment = Db::getInstance()->getRow(
                    'SELECT * FROM `' . _DB_PREFIX_ . 'room_assignments` 
                     WHERE `id_room` = ' . $roomId . ' 
                     AND `status` = "assigned"
                     ORDER BY `assignment_date` DESC LIMIT 1'
                );
            }

            return $this->jsonResponse([
                'room' => $room,
                'current_assignment' => $assignment
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
