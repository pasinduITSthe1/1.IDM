const db = require('../config/database');
const bcrypt = require('bcryptjs');
const jwt = require('jsonwebtoken');

class AuthController {
  // Login
  static async login(req, res) {
    try {
      const { username, password } = req.body;

      if (!username || !password) {
        return res.status(400).json({
          success: false,
          message: 'Please provide username and password'
        });
      }

      // Find staff by username
      const [rows] = await db.query(
        'SELECT * FROM staff WHERE username = ?',
        [username]
      );

      if (rows.length === 0) {
        return res.status(401).json({
          success: false,
          message: 'Invalid credentials'
        });
      }

      const staff = rows[0];

      // Compare password
      const isMatch = await bcrypt.compare(password, staff.password_hash);

      if (!isMatch) {
        return res.status(401).json({
          success: false,
          message: 'Invalid credentials'
        });
      }

      // Generate JWT token
      const token = jwt.sign(
        {
          id: staff.id,
          username: staff.username,
          role: staff.role
        },
        process.env.JWT_SECRET,
        { expiresIn: process.env.JWT_EXPIRES_IN }
      );

      res.json({
        success: true,
        message: 'Login successful',
        data: {
          token,
          staff: {
            id: staff.id,
            username: staff.username,
            name: staff.name,
            role: staff.role
          }
        }
      });
    } catch (error) {
      console.error('Login error:', error);
      res.status(500).json({
        success: false,
        message: 'Server error during login'
      });
    }
  }

  // Register (optional - for creating new staff)
  static async register(req, res) {
    try {
      const { username, password, name, role } = req.body;

      if (!username || !password || !name) {
        return res.status(400).json({
          success: false,
          message: 'Please provide all required fields'
        });
      }

      // Check if username exists
      const [existing] = await db.query(
        'SELECT id FROM staff WHERE username = ?',
        [username]
      );

      if (existing.length > 0) {
        return res.status(400).json({
          success: false,
          message: 'Username already exists'
        });
      }

      // Hash password
      const salt = await bcrypt.genSalt(10);
      const passwordHash = await bcrypt.hash(password, salt);

      // Generate UUID
      const { v4: uuidv4 } = require('uuid');
      const staffId = uuidv4();

      // Insert new staff
      await db.query(
        'INSERT INTO staff (id, username, password_hash, name, role) VALUES (?, ?, ?, ?, ?)',
        [staffId, username, passwordHash, name, role || 'staff']
      );

      res.status(201).json({
        success: true,
        message: 'Staff registered successfully',
        data: {
          id: staffId,
          username,
          name,
          role: role || 'staff'
        }
      });
    } catch (error) {
      console.error('Register error:', error);
      res.status(500).json({
        success: false,
        message: 'Server error during registration'
      });
    }
  }

  // Get current user info
  static async getMe(req, res) {
    try {
      const [rows] = await db.query(
        'SELECT id, username, name, role, created_at FROM staff WHERE id = ?',
        [req.user.id]
      );

      if (rows.length === 0) {
        return res.status(404).json({
          success: false,
          message: 'Staff not found'
        });
      }

      res.json({
        success: true,
        data: rows[0]
      });
    } catch (error) {
      console.error('Get me error:', error);
      res.status(500).json({
        success: false,
        message: 'Server error'
      });
    }
  }
}

module.exports = AuthController;
