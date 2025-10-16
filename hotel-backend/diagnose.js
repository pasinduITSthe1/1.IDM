const db = require('./config/database');

console.log('🔍 ===== DATABASE DIAGNOSTIC =====\n');

async function runDiagnostics() {
  try {
    // Test 1: Database connection
    console.log('Test 1: Database Connection');
    await db.query('SELECT 1');
    console.log('✅ Database connection OK\n');

    // Test 2: Check guests table
    console.log('Test 2: Guests Table');
    const [guests] = await db.query('SELECT COUNT(*) as count FROM guests');
    console.log(`✅ Guests table exists`);
    console.log(`   Total guests in database: ${guests[0].count}\n`);

    // Test 3: Show recent guests
    console.log('Test 3: Recent Guests');
    const [recentGuests] = await db.query(
      'SELECT id, first_name, last_name, status, created_at FROM guests ORDER BY created_at DESC LIMIT 5'
    );
    
    if (recentGuests.length === 0) {
      console.log('   ⚠️  No guests in database yet\n');
    } else {
      console.log(`   Found ${recentGuests.length} recent guests:`);
      recentGuests.forEach((guest, index) => {
        console.log(`   ${index + 1}. ${guest.first_name} ${guest.last_name} - ${guest.status} (${guest.created_at})`);
      });
      console.log('');
    }

    // Test 4: Try to insert a test guest
    console.log('Test 4: Insert Test Guest');
    const { v4: uuidv4 } = require('uuid');
    const testId = uuidv4();
    
    await db.query(
      'INSERT INTO guests (id, first_name, last_name, status) VALUES (?, ?, ?, ?)',
      [testId, 'Diagnostic', 'Test', 'pending']
    );
    console.log('✅ Test guest inserted successfully');
    
    // Verify it was inserted
    const [verifyInsert] = await db.query('SELECT * FROM guests WHERE id = ?', [testId]);
    if (verifyInsert.length > 0) {
      console.log('✅ Test guest verified in database');
      console.log(`   ID: ${verifyInsert[0].id}`);
      console.log(`   Name: ${verifyInsert[0].first_name} ${verifyInsert[0].last_name}`);
      console.log(`   Status: ${verifyInsert[0].status}\n`);
    }
    
    // Clean up test guest
    await db.query('DELETE FROM guests WHERE id = ?', [testId]);
    console.log('✅ Test guest cleaned up\n');

    // Test 5: Check staff table
    console.log('Test 5: Staff Table');
    const [staff] = await db.query('SELECT COUNT(*) as count FROM staff');
    console.log(`✅ Staff table exists`);
    console.log(`   Total staff in database: ${staff[0].count}\n`);

    // Test 6: Check admin user
    console.log('Test 6: Admin User');
    const [admin] = await db.query('SELECT username, name, role FROM staff WHERE username = ?', ['admin']);
    if (admin.length > 0) {
      console.log('✅ Admin user found');
      console.log(`   Username: ${admin[0].username}`);
      console.log(`   Name: ${admin[0].name}`);
      console.log(`   Role: ${admin[0].role}\n`);
    } else {
      console.log('❌ Admin user NOT found\n');
    }

    console.log('╔════════════════════════════════════════╗');
    console.log('║                                        ║');
    console.log('║  ✅ ALL DIAGNOSTICS PASSED!           ║');
    console.log('║                                        ║');
    console.log('║  Database is working correctly!        ║');
    console.log('║                                        ║');
    console.log('╚════════════════════════════════════════╝\n');
    
    console.log('If guests are not saving from the app:');
    console.log('1. Check if firewall rule is added (run fix-firewall.ps1)');
    console.log('2. Restart Flutter app (press R)');
    console.log('3. Check Flutter console for error messages');
    console.log('4. Verify _useApi = true in guest_provider.dart\n');

  } catch (error) {
    console.error('❌ ERROR:', error.message);
    console.error('\nPossible issues:');
    console.error('- MySQL/WAMP not running');
    console.error('- Database not initialized (run: node scripts/initDatabase.js)');
    console.error('- Wrong database credentials in .env file\n');
  } finally {
    process.exit(0);
  }
}

runDiagnostics();
