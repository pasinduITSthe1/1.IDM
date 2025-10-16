const mysql = require('mysql2');
const bcrypt = require('bcryptjs');
const { v4: uuidv4 } = require('uuid');
require('dotenv').config();

// Database configuration
const dbConfig = {
  host: process.env.DB_HOST,
  port: process.env.DB_PORT,
  user: process.env.DB_USER,
  password: process.env.DB_PASSWORD
};

// SQL to create database
const createDatabase = `CREATE DATABASE IF NOT EXISTS ${process.env.DB_NAME}`;

// SQL to create tables
const createStaffTable = `
CREATE TABLE IF NOT EXISTS staff (
  id VARCHAR(36) PRIMARY KEY,
  username VARCHAR(50) UNIQUE NOT NULL,
  password_hash VARCHAR(255) NOT NULL,
  name VARCHAR(100),
  role VARCHAR(20) DEFAULT 'staff',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_username (username)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
`;

const createGuestsTable = `
CREATE TABLE IF NOT EXISTS guests (
  id VARCHAR(36) PRIMARY KEY,
  first_name VARCHAR(50) NOT NULL,
  last_name VARCHAR(50) NOT NULL,
  document_number VARCHAR(50),
  document_type VARCHAR(20),
  issued_country VARCHAR(50),
  issued_date DATE,
  expiry_date DATE,
  date_of_birth DATE,
  sex CHAR(1),
  nationality VARCHAR(50),
  email VARCHAR(100),
  phone VARCHAR(20),
  address TEXT,
  visit_purpose VARCHAR(100),
  status VARCHAR(20) DEFAULT 'pending',
  room_number VARCHAR(10),
  check_in_date DATETIME,
  check_out_date DATETIME,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX idx_status (status),
  INDEX idx_room_number (room_number),
  INDEX idx_document_number (document_number)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
`;

const createRoomsTable = `
CREATE TABLE IF NOT EXISTS rooms (
  id VARCHAR(36) PRIMARY KEY,
  room_number VARCHAR(10) UNIQUE NOT NULL,
  room_type VARCHAR(50),
  price DECIMAL(10, 2),
  status VARCHAR(20) DEFAULT 'available',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_room_number (room_number),
  INDEX idx_status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
`;

async function initializeDatabase() {
  let connection;

  try {
    console.log('🔄 Starting database initialization...\n');

    // Connect without database selection
    connection = mysql.createConnection(dbConfig);

    // Promisify connection
    const promiseConnection = connection.promise();

    // Create database
    console.log(`📦 Creating database: ${process.env.DB_NAME}`);
    await promiseConnection.query(createDatabase);
    console.log('✅ Database created or already exists\n');

    // Select database
    await promiseConnection.query(`USE ${process.env.DB_NAME}`);

    // Create tables
    console.log('📋 Creating tables...');
    
    console.log('  - Creating staff table...');
    await promiseConnection.query(createStaffTable);
    console.log('    ✅ Staff table ready');

    console.log('  - Creating guests table...');
    await promiseConnection.query(createGuestsTable);
    console.log('    ✅ Guests table ready');

    console.log('  - Creating rooms table...');
    await promiseConnection.query(createRoomsTable);
    console.log('    ✅ Rooms table ready\n');

    // Check if default staff exists
    const [staffRows] = await promiseConnection.query(
      'SELECT id FROM staff WHERE username = ?',
      ['admin']
    );

    if (staffRows.length === 0) {
      console.log('👤 Creating default admin user...');
      
      // Hash password
      const salt = await bcrypt.genSalt(10);
      const passwordHash = await bcrypt.hash('admin123', salt);
      const staffId = uuidv4();

      await promiseConnection.query(
        'INSERT INTO staff (id, username, password_hash, name, role) VALUES (?, ?, ?, ?, ?)',
        [staffId, 'admin', passwordHash, 'Administrator', 'admin']
      );

      console.log('✅ Default admin created');
      console.log('   Username: admin');
      console.log('   Password: admin123');
      console.log('   ⚠️  Please change this password in production!\n');
    } else {
      console.log('ℹ️  Default admin user already exists\n');
    }

    // Insert sample rooms
    const [roomRows] = await promiseConnection.query('SELECT COUNT(*) as count FROM rooms');
    
    if (roomRows[0].count === 0) {
      console.log('🛏️  Creating sample rooms...');
      
      const sampleRooms = [
        ['101', 'Single', 50.00],
        ['102', 'Single', 50.00],
        ['201', 'Double', 75.00],
        ['202', 'Double', 75.00],
        ['301', 'Suite', 120.00],
        ['302', 'Suite', 120.00]
      ];

      for (const [roomNumber, roomType, price] of sampleRooms) {
        await promiseConnection.query(
          'INSERT INTO rooms (id, room_number, room_type, price, status) VALUES (?, ?, ?, ?, ?)',
          [uuidv4(), roomNumber, roomType, price, 'available']
        );
      }

      console.log(`✅ Created ${sampleRooms.length} sample rooms\n`);
    } else {
      console.log(`ℹ️  Found ${roomRows[0].count} existing rooms\n`);
    }

    console.log('╔════════════════════════════════════════════════════════╗');
    console.log('║                                                        ║');
    console.log('║          ✅ Database initialized successfully!         ║');
    console.log('║                                                        ║');
    console.log('╚════════════════════════════════════════════════════════╝');
    console.log('');
    console.log('Next steps:');
    console.log('  1. Run: npm install');
    console.log('  2. Run: npm start');
    console.log('  3. Test API: http://localhost:3000/api/health');
    console.log('');

  } catch (error) {
    console.error('❌ Error initializing database:', error.message);
    process.exit(1);
  } finally {
    if (connection) {
      connection.end();
    }
  }
}

// Run initialization
initializeDatabase();
