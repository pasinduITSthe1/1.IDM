const db = require('../config/database');

async function fixOldGuestDates() {
  try {
    console.log('\n🔧 FIXING OLD GUEST DATES\n');
    console.log('='.repeat(80));

    // Find guests with status 'checked-in' but no check_in_date
    const [checkedInGuests] = await db.query(`
      SELECT g.id, g.first_name, g.last_name, g.room_number, ci.check_in_date
      FROM guests g
      LEFT JOIN check_ins ci ON g.id = ci.guest_id AND ci.checked_out = FALSE
      WHERE g.status = 'checked-in' AND g.check_in_date IS NULL
    `);

    console.log(`\nFound ${checkedInGuests.length} checked-in guests with missing check-in dates\n`);

    for (const guest of checkedInGuests) {
      const checkInDate = guest.check_in_date || new Date();
      await db.query(
        'UPDATE guests SET check_in_date = ? WHERE id = ?',
        [checkInDate, guest.id]
      );
      console.log(`✅ Fixed: ${guest.first_name} ${guest.last_name} - Set check-in date to ${checkInDate}`);
    }

    // Find guests with status 'checked-out' but no check_out_date
    const [checkedOutGuests] = await db.query(`
      SELECT g.id, g.first_name, g.last_name, co.check_out_date
      FROM guests g
      LEFT JOIN check_outs co ON g.id = co.guest_id
      WHERE g.status = 'checked-out' AND g.check_out_date IS NULL
      ORDER BY co.check_out_date DESC
    `);

    console.log(`\nFound ${checkedOutGuests.length} checked-out guests with missing check-out dates\n`);

    for (const guest of checkedOutGuests) {
      const checkOutDate = guest.check_out_date || new Date();
      await db.query(
        'UPDATE guests SET check_out_date = ? WHERE id = ?',
        [checkOutDate, guest.id]
      );
      console.log(`✅ Fixed: ${guest.first_name} ${guest.last_name} - Set check-out date to ${checkOutDate}`);
    }

    console.log('\n' + '='.repeat(80));
    console.log('✅ All old guest dates fixed!\n');

    // Show updated data
    console.log('📊 Updated Guest Data:\n');
    const [allGuests] = await db.query(`
      SELECT first_name, last_name, status, check_in_date, check_out_date
      FROM guests
      ORDER BY created_at DESC
      LIMIT 5
    `);

    allGuests.forEach((g, i) => {
      console.log(`${i + 1}. ${g.first_name} ${g.last_name} (${g.status})`);
      console.log(`   Check-in: ${g.check_in_date || 'N/A'}`);
      console.log(`   Check-out: ${g.check_out_date || 'N/A'}`);
    });

    console.log('');
    process.exit(0);
  } catch (error) {
    console.error('❌ Error:', error.message);
    process.exit(1);
  }
}

fixOldGuestDates();
