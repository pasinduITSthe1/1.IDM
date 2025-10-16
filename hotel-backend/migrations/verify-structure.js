const db = require('../config/database');

async function verify() {
  try {
    console.log('\n📊 DATABASE STRUCTURE VERIFICATION\n');
    console.log('=' .repeat(50));
    
    // Show all tables
    const [tables] = await db.query('SHOW TABLES');
    console.log('\n✅ Tables in database:');
    tables.forEach(row => {
      const tableName = Object.values(row)[0];
      console.log(`   - ${tableName}`);
    });

    // Describe check_ins table
    const [checkInsDesc] = await db.query('DESCRIBE check_ins');
    console.log('\n📋 check_ins table structure:');
    checkInsDesc.forEach(row => {
      console.log(`   - ${row.Field.padEnd(25)} ${row.Type}`);
    });

    // Describe check_outs table
    const [checkOutsDesc] = await db.query('DESCRIBE check_outs');
    console.log('\n📋 check_outs table structure:');
    checkOutsDesc.forEach(row => {
      console.log(`   - ${row.Field.padEnd(25)} ${row.Type}`);
    });

    // Count records
    const [checkInsCount] = await db.query('SELECT COUNT(*) as count FROM check_ins');
    const [checkOutsCount] = await db.query('SELECT COUNT(*) as count FROM check_outs');
    const [guestsCount] = await db.query('SELECT COUNT(*) as count FROM guests');

    console.log('\n📈 Record counts:');
    console.log(`   - Guests: ${guestsCount[0].count}`);
    console.log(`   - Check-ins: ${checkInsCount[0].count}`);
    console.log(`   - Check-outs: ${checkOutsCount[0].count}`);

    console.log('\n' + '='.repeat(50));
    console.log('✅ Database structure verified successfully!\n');

    process.exit(0);
  } catch (error) {
    console.error('❌ Verification failed:', error.message);
    process.exit(1);
  }
}

verify();
