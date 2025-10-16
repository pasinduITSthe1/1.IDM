const db = require('../config/database');

async function checkGuestDates() {
  try {
    console.log('\n📊 CHECKING GUEST TABLE DATES\n');
    console.log('='.repeat(80));

    const [rows] = await db.query(`
      SELECT 
        id, 
        first_name, 
        last_name, 
        status, 
        room_number, 
        check_in_date, 
        check_out_date,
        created_at
      FROM guests 
      ORDER BY created_at DESC 
      LIMIT 5
    `);

    rows.forEach((guest, index) => {
      console.log(`\n${index + 1}. ${guest.first_name} ${guest.last_name}`);
      console.log(`   Status: ${guest.status}`);
      console.log(`   Room: ${guest.room_number || 'N/A'}`);
      console.log(`   Check-in Date: ${guest.check_in_date || '❌ NOT SET'}`);
      console.log(`   Check-out Date: ${guest.check_out_date || '❌ NOT SET'}`);
      console.log(`   Created: ${guest.created_at}`);
    });

    console.log('\n' + '='.repeat(80));
    console.log('✅ Query completed\n');

    process.exit(0);
  } catch (error) {
    console.error('❌ Error:', error.message);
    process.exit(1);
  }
}

checkGuestDates();
