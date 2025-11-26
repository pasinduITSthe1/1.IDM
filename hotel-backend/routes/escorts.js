  /**
 * Escort Management API Endpoints
 * Backend implementation example for Node.js/Express
 */

const express = require('express');
const router = express.Router();
const mysql = require('mysql2/promise');

// Database connection (adjust credentials as needed)
const pool = mysql.createPool({
  host: 'localhost',
  user: 'root',
  password: '',
  database: '1.idm_db', // Updated to correct database name
  waitForConnections: true,
  connectionLimit: 10,
});

/**
 * POST /api/escorts
 * Add a new escort for a guest
 */
router.post('/escorts', async (req, res) => {
  try {
    console.log('📥 Received escort data:', JSON.stringify(req.body, null, 2));
    
    const {
      id_customer,
      first_name,
      last_name,
      document_type,
      document_number,
      date_of_birth,
      nationality,
      sex,
      email,
      phone,
      address,
      issued_country,
      issued_date,
      expiry_date,
      relationship_to_guest,
    } = req.body;
    
    console.log('🔍 Extracted id_customer:', id_customer, '(type:', typeof id_customer, ')');

    // Validate required fields
    if (!id_customer || !first_name || !last_name) {
      return res.status(400).json({
        success: false,
        message: 'Missing required fields: id_customer, first_name, last_name',
      });
    }

    // Insert escort into database
    const [result] = await pool.query(
      `INSERT INTO guest_escorts (
        id_customer, first_name, last_name, document_type, document_number,
        date_of_birth, nationality, sex, email, phone, address,
        issued_country, issued_date, expiry_date, relationship_to_guest
      ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)`,
      [
        id_customer,
        first_name,
        last_name,
        document_type,
        document_number,
        date_of_birth,
        nationality,
        sex,
        email,
        phone,
        address,
        issued_country,
        issued_date,
        expiry_date,
        relationship_to_guest,
      ]
    );

    res.status(201).json({
      success: true,
      message: 'Escort added successfully',
      id: result.insertId,
    });
  } catch (error) {
    console.error('Error adding escort:', error);
    res.status(500).json({
      success: false,
      message: 'Failed to add escort',
      error: error.message,
    });
  }
});

/**
 * GET /api/escorts/guest/:guestId
 * Get all escorts for a specific guest
 */
router.get('/escorts/guest/:guestId', async (req, res) => {
  try {
    const { guestId } = req.params;

    const [escorts] = await pool.query(
      `SELECT * FROM guest_escorts 
       WHERE id_customer = ? 
       ORDER BY created_at DESC`,
      [guestId]
    );

    res.json(escorts);
  } catch (error) {
    console.error('Error fetching escorts:', error);
    res.status(500).json({
      success: false,
      message: 'Failed to fetch escorts',
      error: error.message,
    });
  }
});

/**
 * GET /api/escorts
 * Get all escorts (for admin purposes)
 */
router.get('/escorts', async (req, res) => {
  try {
    const [escorts] = await pool.query(
      `SELECT e.*, 
        CONCAT(c.firstname, ' ', c.lastname) as guest_name
       FROM guest_escorts e
       LEFT JOIN qlo_customer c ON e.id_customer = c.id_customer
       ORDER BY e.created_at DESC`
    );

    res.json(escorts);
  } catch (error) {
    console.error('Error fetching all escorts:', error);
    res.status(500).json({
      success: false,
      message: 'Failed to fetch escorts',
      error: error.message,
    });
  }
});

/**
 * PUT /api/escorts/:id
 * Update escort information
 */
router.put('/escorts/:id', async (req, res) => {
  try {
    const { id } = req.params;
    const {
      first_name,
      last_name,
      document_type,
      document_number,
      date_of_birth,
      nationality,
      sex,
      email,
      phone,
      address,
      issued_country,
      issued_date,
      expiry_date,
      relationship_to_guest,
    } = req.body;

    await pool.query(
      `UPDATE guest_escorts SET
        first_name = ?,
        last_name = ?,
        document_type = ?,
        document_number = ?,
        date_of_birth = ?,
        nationality = ?,
        sex = ?,
        email = ?,
        phone = ?,
        address = ?,
        issued_country = ?,
        issued_date = ?,
        expiry_date = ?,
        relationship_to_guest = ?,
        updated_at = CURRENT_TIMESTAMP
       WHERE id = ?`,
      [
        first_name,
        last_name,
        document_type,
        document_number,
        date_of_birth,
        nationality,
        sex,
        email,
        phone,
        address,
        issued_country,
        issued_date,
        expiry_date,
        relationship_to_guest,
        id,
      ]
    );

    res.json({
      success: true,
      message: 'Escort updated successfully',
    });
  } catch (error) {
    console.error('Error updating escort:', error);
    res.status(500).json({
      success: false,
      message: 'Failed to update escort',
      error: error.message,
    });
  }
});

/**
 * DELETE /api/escorts/:id
 * Delete an escort
 */
router.delete('/escorts/:id', async (req, res) => {
  try {
    const { id } = req.params;

    await pool.query('DELETE FROM guest_escorts WHERE id = ?', [id]);

    res.json({
      success: true,
      message: 'Escort deleted successfully',
    });
  } catch (error) {
    console.error('Error deleting escort:', error);
    res.status(500).json({
      success: false,
      message: 'Failed to delete escort',
      error: error.message,
    });
  }
});

/**
 * GET /api/escorts/:id
 * Get a specific escort by ID
 */
router.get('/escorts/:id', async (req, res) => {
  try {
    const { id } = req.params;

    const [escorts] = await pool.query(
      `SELECT e.*, 
        CONCAT(c.firstname, ' ', c.lastname) as guest_name
       FROM guest_escorts e
       LEFT JOIN qlo_customer c ON e.id_customer = c.id_customer
       WHERE e.id = ?`,
      [id]
    );

    if (escorts.length === 0) {
      return res.status(404).json({
        success: false,
        message: 'Escort not found',
      });
    }

    res.json(escorts[0]);
  } catch (error) {
    console.error('Error fetching escort:', error);
    res.status(500).json({
      success: false,
      message: 'Failed to fetch escort',
      error: error.message,
    });
  }
});

/**
 * GET /api/escorts/stats
 * Get escort statistics
 */
router.get('/escorts/stats', async (req, res) => {
  try {
    const [stats] = await pool.query(`
      SELECT 
        COUNT(*) as total_escorts,
        COUNT(DISTINCT id_customer) as guests_with_escorts,
        relationship_to_guest,
        COUNT(*) as count
      FROM guest_escorts
      GROUP BY relationship_to_guest
    `);

    res.json(stats);
  } catch (error) {
    console.error('Error fetching escort stats:', error);
    res.status(500).json({
      success: false,
      message: 'Failed to fetch statistics',
      error: error.message,
    });
  }
});

module.exports = router;
