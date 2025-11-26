const mysql = require('mysql2');
require('dotenv').config({ path: __dirname + '/../.env' });

// Create connection pool with fallback values for WAMP default setup
const pool = mysql.createPool({
  host: process.env.DB_HOST || 'localhost',
  port: process.env.DB_PORT || 3306,
  user: process.env.DB_USER || 'root',
  password: process.env.DB_PASSWORD || '',
  database: process.env.DB_NAME || '1.idm_db',
  waitForConnections: true,
  connectionLimit: 10,
  queueLimit: 0
});

// Get promise-based pool
const promisePool = pool.promise();

// Test connection
pool.getConnection((err, connection) => {
  if (err) {
    console.error('❌ Error connecting to MySQL database:', err.message);
    return;
  }
  console.log('✅ MySQL database connected successfully');
  connection.release();
});

module.exports = promisePool;
