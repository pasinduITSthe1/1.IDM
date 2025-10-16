const db = require('../config/database');

async function createTables() {
  try {
    console.log('🔄 Creating check_ins table...\n');
    
    await db.query(`
      CREATE TABLE IF NOT EXISTS check_ins (
        id VARCHAR(36) PRIMARY KEY,
        guest_id VARCHAR(36) NOT NULL,
        room_number VARCHAR(20) NOT NULL,
        check_in_date DATETIME DEFAULT CURRENT_TIMESTAMP,
        expected_checkout_date DATE,
        checked_out BOOLEAN DEFAULT FALSE,
        notes TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (guest_id) REFERENCES guests(id) ON DELETE CASCADE,
        INDEX idx_guest_id (guest_id),
        INDEX idx_room_number (room_number),
        INDEX idx_check_in_date (check_in_date)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    `);
    console.log('✅ check_ins table created\n');

    console.log('🔄 Creating check_outs table...\n');
    await db.query(`
      CREATE TABLE IF NOT EXISTS check_outs (
        id VARCHAR(36) PRIMARY KEY,
        check_in_id VARCHAR(36) NOT NULL,
        guest_id VARCHAR(36) NOT NULL,
        room_number VARCHAR(20) NOT NULL,
        check_out_date DATETIME DEFAULT CURRENT_TIMESTAMP,
        total_amount DECIMAL(10, 2),
        payment_status ENUM('pending', 'paid', 'refunded') DEFAULT 'pending',
        payment_method VARCHAR(50),
        notes TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (check_in_id) REFERENCES check_ins(id) ON DELETE CASCADE,
        FOREIGN KEY (guest_id) REFERENCES guests(id) ON DELETE CASCADE,
        INDEX idx_guest_id (guest_id),
        INDEX idx_check_in_id (check_in_id),
        INDEX idx_check_out_date (check_out_date)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    `);
    console.log('✅ check_outs table created\n');

    // Verify
    const [tables] = await db.query("SHOW TABLES");
    console.log('📋 Current tables in database:');
    tables.forEach(row => {
      const tableName = Object.values(row)[0];
      console.log(`  - ${tableName}`);
    });

    console.log('\n✅ Database migration completed successfully!');
    process.exit(0);
  } catch (error) {
    console.error('❌ Migration failed:', error.message);
    process.exit(1);
  }
}

createTables();
