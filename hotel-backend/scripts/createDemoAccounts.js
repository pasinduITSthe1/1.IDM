const mysql = require('mysql2');
const bcrypt = require('bcryptjs');
const { v4: uuidv4 } = require('uuid');
require('dotenv').config();

// Database configuration
const dbConfig = {
  host: process.env.DB_HOST,
  port: process.env.DB_PORT,
  user: process.env.DB_USER,
  password: process.env.DB_PASSWORD,
  database: process.env.DB_NAME
};

// Demo accounts to create
const demoAccounts = [
  {
    username: 'demo',
    password: 'demo123',
    name: 'Demo User',
    role: 'staff'
  },
  {
    username: 'receptionist',
    password: 'reception123',
    name: 'Front Desk Receptionist',
    role: 'staff'
  },
  {
    username: 'manager',
    password: 'manager123',
    name: 'Hotel Manager',
    role: 'admin'
  },
  {
    username: 'staff1',
    password: 'staff123',
    name: 'Staff Member 1',
    role: 'staff'
  }
];

async function createDemoAccounts() {
  let connection;

  try {
    console.log('🔄 Creating demo accounts for mobile app testing...\n');

    connection = mysql.createConnection(dbConfig);
    const promiseConnection = connection.promise();

    for (const account of demoAccounts) {
      try {
        // Check if account already exists
        const [existing] = await promiseConnection.query(
          'SELECT id FROM staff WHERE username = ?',
          [account.username]
        );

        if (existing.length > 0) {
          console.log(`⚠️  Account '${account.username}' already exists - skipping`);
          continue;
        }

        // Hash password
        const salt = await bcrypt.genSalt(10);
        const passwordHash = await bcrypt.hash(account.password, salt);
        const staffId = uuidv4();

        // Insert account
        await promiseConnection.query(
          'INSERT INTO staff (id, username, password_hash, name, role) VALUES (?, ?, ?, ?, ?)',
          [staffId, account.username, passwordHash, account.name, account.role]
        );

        console.log(`✅ Created account: ${account.username}`);
        console.log(`   Password: ${account.password}`);
        console.log(`   Name: ${account.name}`);
        console.log(`   Role: ${account.role}\n`);

      } catch (error) {
        console.error(`❌ Error creating account '${account.username}':`, error.message);
      }
    }

    // Display summary
    console.log('╔════════════════════════════════════════════════════════╗');
    console.log('║                                                        ║');
    console.log('║          ✅ Demo Accounts Created Successfully!        ║');
    console.log('║                                                        ║');
    console.log('╚════════════════════════════════════════════════════════╝');
    console.log('');
    console.log('Available Accounts for Mobile App:');
    console.log('');
    console.log('1. Admin Account (Default):');
    console.log('   Username: admin');
    console.log('   Password: admin123');
    console.log('   Role: admin');
    console.log('');
    console.log('2. Demo Account:');
    console.log('   Username: demo');
    console.log('   Password: demo123');
    console.log('   Role: staff');
    console.log('');
    console.log('3. Receptionist Account:');
    console.log('   Username: receptionist');
    console.log('   Password: reception123');
    console.log('   Role: staff');
    console.log('');
    console.log('4. Manager Account:');
    console.log('   Username: manager');
    console.log('   Password: manager123');
    console.log('   Role: admin');
    console.log('');
    console.log('5. Staff Account:');
    console.log('   Username: staff1');
    console.log('   Password: staff123');
    console.log('   Role: staff');
    console.log('');
    console.log('═══════════════════════════════════════════════════════');
    console.log('');
    console.log('API Login Endpoint: http://localhost:3000/api/auth/login');
    console.log('');
    console.log('⚠️  IMPORTANT: Change all passwords in production!');
    console.log('');

  } catch (error) {
    console.error('❌ Error:', error.message);
    process.exit(1);
  } finally {
    if (connection) {
      connection.end();
    }
  }
}

// Run the script
createDemoAccounts();
