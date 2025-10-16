const db = require('../config/database');
const { v4: uuidv4 } = require('uuid');

class RoomController {
  // Get all rooms
  static async getAllRooms(req, res) {
    try {
      const [rows] = await db.query(
        'SELECT * FROM rooms ORDER BY room_number ASC'
      );

      res.json({
        success: true,
        data: rows,
        count: rows.length
      });
    } catch (error) {
      console.error('Get rooms error:', error);
      res.status(500).json({
        success: false,
        message: 'Server error while fetching rooms'
      });
    }
  }

  // Get single room
  static async getRoom(req, res) {
    try {
      const { id } = req.params;

      const [rows] = await db.query(
        'SELECT * FROM rooms WHERE id = ?',
        [id]
      );

      if (rows.length === 0) {
        return res.status(404).json({
          success: false,
          message: 'Room not found'
        });
      }

      res.json({
        success: true,
        data: rows[0]
      });
    } catch (error) {
      console.error('Get room error:', error);
      res.status(500).json({
        success: false,
        message: 'Server error while fetching room'
      });
    }
  }

  // Create new room
  static async createRoom(req, res) {
    try {
      const { roomNumber, roomType, price, status } = req.body;

      if (!roomNumber) {
        return res.status(400).json({
          success: false,
          message: 'Room number is required'
        });
      }

      // Check if room number exists
      const [existing] = await db.query(
        'SELECT id FROM rooms WHERE room_number = ?',
        [roomNumber]
      );

      if (existing.length > 0) {
        return res.status(400).json({
          success: false,
          message: 'Room number already exists'
        });
      }

      const roomId = uuidv4();

      await db.query(
        'INSERT INTO rooms (id, room_number, room_type, price, status) VALUES (?, ?, ?, ?, ?)',
        [roomId, roomNumber, roomType, price, status || 'available']
      );

      const [rows] = await db.query(
        'SELECT * FROM rooms WHERE id = ?',
        [roomId]
      );

      res.status(201).json({
        success: true,
        message: 'Room created successfully',
        data: rows[0]
      });
    } catch (error) {
      console.error('Create room error:', error);
      res.status(500).json({
        success: false,
        message: 'Server error while creating room'
      });
    }
  }

  // Update room
  static async updateRoom(req, res) {
    try {
      const { id } = req.params;
      const { roomNumber, roomType, price, status } = req.body;

      const [existing] = await db.query(
        'SELECT id FROM rooms WHERE id = ?',
        [id]
      );

      if (existing.length === 0) {
        return res.status(404).json({
          success: false,
          message: 'Room not found'
        });
      }

      await db.query(
        'UPDATE rooms SET room_number = ?, room_type = ?, price = ?, status = ? WHERE id = ?',
        [roomNumber, roomType, price, status, id]
      );

      const [rows] = await db.query(
        'SELECT * FROM rooms WHERE id = ?',
        [id]
      );

      res.json({
        success: true,
        message: 'Room updated successfully',
        data: rows[0]
      });
    } catch (error) {
      console.error('Update room error:', error);
      res.status(500).json({
        success: false,
        message: 'Server error while updating room'
      });
    }
  }

  // Delete room
  static async deleteRoom(req, res) {
    try {
      const { id } = req.params;

      const [result] = await db.query(
        'DELETE FROM rooms WHERE id = ?',
        [id]
      );

      if (result.affectedRows === 0) {
        return res.status(404).json({
          success: false,
          message: 'Room not found'
        });
      }

      res.json({
        success: true,
        message: 'Room deleted successfully'
      });
    } catch (error) {
      console.error('Delete room error:', error);
      res.status(500).json({
        success: false,
        message: 'Server error while deleting room'
      });
    }
  }

  // Get available rooms
  static async getAvailableRooms(req, res) {
    try {
      const [rows] = await db.query(
        "SELECT * FROM rooms WHERE status = 'available' ORDER BY room_number ASC"
      );

      res.json({
        success: true,
        data: rows,
        count: rows.length
      });
    } catch (error) {
      console.error('Get available rooms error:', error);
      res.status(500).json({
        success: false,
        message: 'Server error while fetching available rooms'
      });
    }
  }
}

module.exports = RoomController;
