const db = require('../config/database');
const { v4: uuidv4 } = require('uuid');

class GuestController {
  // Get all guests
  static async getAllGuests(req, res) {
    try {
      const [rows] = await db.query(
        'SELECT id_customer as id, firstname as first_name, lastname as last_name, email, phone, date_add as created_at, active FROM qlo_customer WHERE deleted = 0 ORDER BY date_add DESC'
      );

      res.json({
        success: true,
        data: rows,
        count: rows.length
      });
    } catch (error) {
      console.error('Get guests error:', error);
      res.status(500).json({
        success: false,
        message: 'Server error while fetching guests'
      });
    }
  }

  // Get single guest
  static async getGuest(req, res) {
    try {
      const { id } = req.params;

      const [rows] = await db.query(
        'SELECT id_customer as id, firstname as first_name, lastname as last_name, email, phone, date_add as created_at, active FROM qlo_customer WHERE id_customer = ? AND deleted = 0',
        [id]
      );

      if (rows.length === 0) {
        return res.status(404).json({
          success: false,
          message: 'Guest not found'
        });
      }

      res.json({
        success: true,
        data: rows[0]
      });
    } catch (error) {
      console.error('Get guest error:', error);
      res.status(500).json({
        success: false,
        message: 'Server error while fetching guest'
      });
    }
  }

  // Create new guest
  static async createGuest(req, res) {
    try {
      console.log('📥 Received guest creation request');
      console.log('📋 Request body:', JSON.stringify(req.body, null, 2));
      
      const {
        firstName,
        lastName,
        documentNumber,
        documentType,
        issuedCountry,
        issuedDate,
        expiryDate,
        dateOfBirth,
        sex,
        nationality,
        email,
        phone,
        address,
        visitPurpose,
        status,
        roomNumber
      } = req.body;

      if (!firstName || !lastName) {
        console.log('❌ Validation failed: Missing required fields');
        return res.status(400).json({
          success: false,
          message: 'First name and last name are required'
        });
      }

      const guestId = uuidv4();
      console.log(`✅ Generated guest ID: ${guestId}`);

      await db.query(
        `INSERT INTO guests (
          id, first_name, last_name, document_number, document_type,
          issued_country, issued_date, expiry_date, date_of_birth,
          sex, nationality, email, phone, address, visit_purpose,
          status, room_number
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)`,
        [
          guestId, firstName, lastName, documentNumber, documentType,
          issuedCountry, issuedDate, expiryDate, dateOfBirth,
          sex, nationality, email, phone, address, visitPurpose,
          status || 'pending', roomNumber
        ]
      );
      console.log('✅ Guest inserted into database');

      // Fetch the created guest
      const [rows] = await db.query(
        'SELECT * FROM guests WHERE id = ?',
        [guestId]
      );
      console.log('✅ Fetched created guest from database');

      console.log('📤 Sending success response');
      res.status(201).json({
        success: true,
        message: 'Guest created successfully',
        data: rows[0]
      });
    } catch (error) {
      console.error('❌ Create guest error:', error.message);
      console.error('Stack trace:', error.stack);
      res.status(500).json({
        success: false,
        message: 'Server error while creating guest',
        error: error.message
      });
    }
  }

  // Update guest
  static async updateGuest(req, res) {
    try {
      const { id } = req.params;
      const {
        firstName,
        lastName,
        documentNumber,
        documentType,
        issuedCountry,
        issuedDate,
        expiryDate,
        dateOfBirth,
        sex,
        nationality,
        email,
        phone,
        address,
        visitPurpose,
        status,
        roomNumber
      } = req.body;

      // Check if guest exists
      const [existing] = await db.query(
        'SELECT id FROM guests WHERE id = ?',
        [id]
      );

      if (existing.length === 0) {
        return res.status(404).json({
          success: false,
          message: 'Guest not found'
        });
      }

      await db.query(
        `UPDATE guests SET
          first_name = ?, last_name = ?, document_number = ?,
          document_type = ?, issued_country = ?, issued_date = ?,
          expiry_date = ?, date_of_birth = ?, sex = ?,
          nationality = ?, email = ?, phone = ?, address = ?,
          visit_purpose = ?, status = ?, room_number = ?
        WHERE id = ?`,
        [
          firstName, lastName, documentNumber, documentType,
          issuedCountry, issuedDate, expiryDate, dateOfBirth,
          sex, nationality, email, phone, address, visitPurpose,
          status, roomNumber, id
        ]
      );

      // Fetch updated guest
      const [rows] = await db.query(
        'SELECT * FROM guests WHERE id = ?',
        [id]
      );

      res.json({
        success: true,
        message: 'Guest updated successfully',
        data: rows[0]
      });
    } catch (error) {
      console.error('Update guest error:', error);
      res.status(500).json({
        success: false,
        message: 'Server error while updating guest'
      });
    }
  }

  // Delete guest
  static async deleteGuest(req, res) {
    try {
      const { id } = req.params;

      const [result] = await db.query(
        'DELETE FROM guests WHERE id = ?',
        [id]
      );

      if (result.affectedRows === 0) {
        return res.status(404).json({
          success: false,
          message: 'Guest not found'
        });
      }

      res.json({
        success: true,
        message: 'Guest deleted successfully'
      });
    } catch (error) {
      console.error('Delete guest error:', error);
      res.status(500).json({
        success: false,
        message: 'Server error while deleting guest'
      });
    }
  }

  // Check-in guest
  static async checkinGuest(req, res) {
    try {
      console.log('📥 Check-in request for guest:', req.params.id);
      const { id } = req.params;
      const { roomNumber, expectedCheckoutDate, notes } = req.body;

      if (!roomNumber) {
        return res.status(400).json({
          success: false,
          message: 'Room number is required for check-in'
        });
      }

      // Check if guest exists
      const [guestRows] = await db.query(
        'SELECT * FROM guests WHERE id = ?',
        [id]
      );

      if (guestRows.length === 0) {
        return res.status(404).json({
          success: false,
          message: 'Guest not found'
        });
      }

      // Check if guest is already checked in
      const [existingCheckIn] = await db.query(
        'SELECT * FROM check_ins WHERE guest_id = ? AND checked_out = FALSE',
        [id]
      );

      if (existingCheckIn.length > 0) {
        return res.status(400).json({
          success: false,
          message: 'Guest is already checked in'
        });
      }

      // Create check-in record
      const checkInId = uuidv4();
      await db.query(
        `INSERT INTO check_ins (
          id, guest_id, room_number, expected_checkout_date, notes
        ) VALUES (?, ?, ?, ?, ?)`,
        [checkInId, id, roomNumber, expectedCheckoutDate, notes]
      );

      // Update guest status AND check_in_date
      await db.query(
        `UPDATE guests SET
          status = 'checked-in',
          room_number = ?,
          check_in_date = NOW()
        WHERE id = ?`,
        [roomNumber, id]
      );

      // Fetch the complete check-in record
      const [checkInRows] = await db.query(
        `SELECT 
          ci.*,
          g.first_name,
          g.last_name,
          g.email,
          g.phone
        FROM check_ins ci
        JOIN guests g ON ci.guest_id = g.id
        WHERE ci.id = ?`,
        [checkInId]
      );

      console.log('✅ Guest checked in successfully');

      res.json({
        success: true,
        message: 'Guest checked in successfully',
        data: checkInRows[0]
      });
    } catch (error) {
      console.error('❌ Check-in error:', error);
      res.status(500).json({
        success: false,
        message: 'Server error during check-in',
        error: error.message
      });
    }
  }

  // Check-out guest
  static async checkoutGuest(req, res) {
    try {
      console.log('📥 Check-out request for guest:', req.params.id);
      const { id } = req.params;
      const { totalAmount, paymentStatus, paymentMethod, notes } = req.body;

      // Check if guest exists
      const [guestRows] = await db.query(
        'SELECT * FROM guests WHERE id = ?',
        [id]
      );

      if (guestRows.length === 0) {
        return res.status(404).json({
          success: false,
          message: 'Guest not found'
        });
      }

      // Find active check-in record
      const [checkInRows] = await db.query(
        'SELECT * FROM check_ins WHERE guest_id = ? AND checked_out = FALSE',
        [id]
      );

      if (checkInRows.length === 0) {
        return res.status(400).json({
          success: false,
          message: 'Guest is not currently checked in'
        });
      }

      const checkIn = checkInRows[0];

      // Create check-out record
      const checkOutId = uuidv4();
      await db.query(
        `INSERT INTO check_outs (
          id, check_in_id, guest_id, room_number, 
          total_amount, payment_status, payment_method, notes
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)`,
        [
          checkOutId, 
          checkIn.id, 
          id, 
          checkIn.room_number,
          totalAmount || 0,
          paymentStatus || 'pending',
          paymentMethod,
          notes
        ]
      );

      // Mark check-in as completed
      await db.query(
        'UPDATE check_ins SET checked_out = TRUE WHERE id = ?',
        [checkIn.id]
      );

      // Update guest status AND check_out_date
      await db.query(
        `UPDATE guests SET
          status = 'checked-out',
          room_number = NULL,
          check_out_date = NOW()
        WHERE id = ?`,
        [id]
      );

      // Fetch the complete check-out record
      const [checkOutRows] = await db.query(
        `SELECT 
          co.*,
          ci.check_in_date,
          ci.expected_checkout_date,
          g.first_name,
          g.last_name,
          g.email,
          g.phone,
          DATEDIFF(co.check_out_date, ci.check_in_date) AS days_stayed
        FROM check_outs co
        JOIN check_ins ci ON co.check_in_id = ci.id
        JOIN guests g ON co.guest_id = g.id
        WHERE co.id = ?`,
        [checkOutId]
      );

      console.log('✅ Guest checked out successfully');

      res.json({
        success: true,
        message: 'Guest checked out successfully',
        data: checkOutRows[0]
      });
    } catch (error) {
      console.error('❌ Check-out error:', error);
      res.status(500).json({
        success: false,
        message: 'Server error during check-out',
        error: error.message
      });
    }
  }

  // Get guests by status
  static async getGuestsByStatus(req, res) {
    try {
      const { status} = req.params;

      const [rows] = await db.query(
        'SELECT * FROM guests WHERE status = ? ORDER BY created_at DESC',
        [status]
      );

      res.json({
        success: true,
        data: rows,
        count: rows.length
      });
    } catch (error) {
      console.error('Get guests by status error:', error);
      res.status(500).json({
        success: false,
        message: 'Server error while fetching guests'
      });
    }
  }

  // Get all check-ins (active and completed)
  static async getAllCheckIns(req, res) {
    try {
      const [rows] = await db.query(
        `SELECT 
          ci.*,
          g.first_name,
          g.last_name,
          g.email,
          g.phone,
          DATEDIFF(NOW(), ci.check_in_date) AS days_since_checkin
        FROM check_ins ci
        JOIN guests g ON ci.guest_id = g.id
        ORDER BY ci.check_in_date DESC`
      );

      res.json({
        success: true,
        data: rows,
        count: rows.length
      });
    } catch (error) {
      console.error('Get check-ins error:', error);
      res.status(500).json({
        success: false,
        message: 'Server error while fetching check-ins'
      });
    }
  }

  // Get active check-ins only
  static async getActiveCheckIns(req, res) {
    try {
      const [rows] = await db.query(
        `SELECT 
          ci.*,
          g.first_name,
          g.last_name,
          g.email,
          g.phone,
          DATEDIFF(NOW(), ci.check_in_date) AS days_stayed
        FROM check_ins ci
        JOIN guests g ON ci.guest_id = g.id
        WHERE ci.checked_out = FALSE
        ORDER BY ci.check_in_date DESC`
      );

      res.json({
        success: true,
        data: rows,
        count: rows.length
      });
    } catch (error) {
      console.error('Get active check-ins error:', error);
      res.status(500).json({
        success: false,
        message: 'Server error while fetching active check-ins'
      });
    }
  }

  // Get all check-outs
  static async getAllCheckOuts(req, res) {
    try {
      const [rows] = await db.query(
        `SELECT 
          co.*,
          ci.check_in_date,
          ci.expected_checkout_date,
          g.first_name,
          g.last_name,
          g.email,
          g.phone,
          DATEDIFF(co.check_out_date, ci.check_in_date) AS days_stayed
        FROM check_outs co
        JOIN check_ins ci ON co.check_in_id = ci.id
        JOIN guests g ON co.guest_id = g.id
        ORDER BY co.check_out_date DESC`
      );

      res.json({
        success: true,
        data: rows,
        count: rows.length
      });
    } catch (error) {
      console.error('Get check-outs error:', error);
      res.status(500).json({
        success: false,
        message: 'Server error while fetching check-outs'
      });
    }
  }

  // Get guest history (all check-ins and check-outs for a specific guest)
  static async getGuestHistory(req, res) {
    try {
      const { id } = req.params;

      const [checkIns] = await db.query(
        `SELECT 
          ci.*,
          'check-in' AS record_type
        FROM check_ins ci
        WHERE ci.guest_id = ?
        ORDER BY ci.check_in_date DESC`,
        [id]
      );

      const [checkOuts] = await db.query(
        `SELECT 
          co.*,
          ci.check_in_date,
          'check-out' AS record_type,
          DATEDIFF(co.check_out_date, ci.check_in_date) AS days_stayed
        FROM check_outs co
        JOIN check_ins ci ON co.check_in_id = ci.id
        WHERE co.guest_id = ?
        ORDER BY co.check_out_date DESC`,
        [id]
      );

      res.json({
        success: true,
        data: {
          checkIns,
          checkOuts,
          totalCheckIns: checkIns.length,
          totalCheckOuts: checkOuts.length
        }
      });
    } catch (error) {
      console.error('Get guest history error:', error);
      res.status(500).json({
        success: false,
        message: 'Server error while fetching guest history'
      });
    }
  }
}

module.exports = GuestController;
