const db = require('../config/database');
const fs = require('fs');
const path = require('path');

async function runMigration() {
  try {
    console.log('🔄 Running database migration: add_checkin_checkout_tables.sql\n');

    // Read the SQL file
    const sqlFile = path.join(__dirname, 'add_checkin_checkout_tables.sql');
    const sqlContent = fs.readFileSync(sqlFile, 'utf8');

    // Split by semicolons and execute each statement
    const statements = sqlContent
      .split(';')
      .map(s => s.trim())
      .filter(s => s.length > 0 && !s.startsWith('--'));

    for (let i = 0; i < statements.length; i++) {
      const statement = statements[i];
      if (statement) {
        try {
          await db.query(statement);
          console.log(`✅ Executed statement ${i + 1}/${statements.length}`);
        } catch (err) {
          // Ignore "table already exists" and "table/view doesn't exist" errors
          const ignoreCodes = ['ER_TABLE_EXISTS_ERROR', 'ER_NO_SUCH_TABLE', 'ER_BAD_TABLE_ERROR'];
          if (ignoreCodes.includes(err.code)) {
            console.log(`ℹ️  Statement ${i + 1}: Already exists or doesn't exist, skipping...`);
          } else {
            console.error(`❌ Statement ${i + 1} failed:`, err.message);
            throw err;
          }
        }
      }
    }

    console.log('\n✅ Migration completed successfully!');
    console.log('\nNew tables created:');
    console.log('  - check_ins: Records all guest check-ins with room assignments');
    console.log('  - check_outs: Records all guest check-outs with billing information');
    console.log('\nNew views created:');
    console.log('  - active_check_ins: View of currently checked-in guests');
    console.log('  - completed_stays: View of all completed stays with billing');

    // Verify tables were created
    const [tables] = await db.query("SHOW TABLES LIKE 'check_%'");
    console.log(`\n✅ Verified ${tables.length} new tables exist`);

    process.exit(0);
  } catch (error) {
    console.error('❌ Migration failed:', error.message);
    console.error(error.stack);
    process.exit(1);
  }
}

runMigration();
