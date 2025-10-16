const express = require('express');
const router = express.Router();
const RoomController = require('../controllers/roomController');
const authMiddleware = require('../middleware/auth');

// All room routes are protected
router.use(authMiddleware);

// Room CRUD
router.get('/', RoomController.getAllRooms);
router.get('/available', RoomController.getAvailableRooms);
router.get('/:id', RoomController.getRoom);
router.post('/', RoomController.createRoom);
router.put('/:id', RoomController.updateRoom);
router.delete('/:id', RoomController.deleteRoom);

module.exports = router;
