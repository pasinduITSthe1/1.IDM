const db = require('./config/database');
const { v4: uuidv4 } = require('uuid');

async function testInsert() {
  try {
    console.log('Testing database insert...\n');
    
    const guestId = uuidv4();
    const testGuest = {
      id: guestId,
      first_name: 'Test',
      last_name: 'User',
      document_number: 'TEST123',
      document_type: 'Passport',
      issued_country: 'USA',
      nationality: 'American',
      email: 'test@example.com',
      phone: '123-456-7890',
      status: 'pending'
    };

    console.log('Inserting test guest...');
    const [insertResult] = await db.query(
      `INSERT INTO guests (
        id, first_name, last_name, document_number, document_type,
        issued_country, nationality, email, phone, status
      ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)`,
      [
        testGuest.id,
        testGuest.first_name,
        testGuest.last_name,
        testGuest.document_number,
        testGuest.document_type,
        testGuest.issued_country,
        testGuest.nationality,
        testGuest.email,
        testGuest.phone,
        testGuest.status
      ]
    );

    console.log('✅ Insert successful!');
    console.log('Insert result:', insertResult);
    
    // Verify the insert
    console.log('\nVerifying insert...');
    const [rows] = await db.query('SELECT * FROM guests WHERE id = ?', [guestId]);
    
    if (rows.length > 0) {
      console.log('✅ Guest found in database:');
      console.log(rows[0]);
    } else {
      console.log('❌ Guest not found after insert!');
    }

    // Count total guests
    const [countResult] = await db.query('SELECT COUNT(*) as count FROM guests');
    console.log(`\nTotal guests in database: ${countResult[0].count}`);

    // Clean up test data
    console.log('\nCleaning up test data...');
    await db.query('DELETE FROM guests WHERE id = ?', [guestId]);
    console.log('✅ Test data cleaned up');

  } catch (error) {
    console.error('❌ Error during test:', error);
  } finally {
    process.exit(0);
  }
}

testInsert();
