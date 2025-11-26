# 🧪 Complete Test Guide: Passport Scan → Database

## ✅ Your System IS Working - Here's How to Verify It

Your passport scan to database integration is **already implemented and working**. Follow this guide to see it in action:

---

## 🔍 Test Method 1: Flutter App Console Logs

### Step 1: Run Flutter App in Debug Mode
```bash
cd hotel-staff-flutter
flutter run
```

### Step 2: Scan and Register a Guest
1. In your Flutter app, go to "Scan Document"
2. Scan a passport or ID card
3. Take photos when prompted
4. Fill in the guest registration form
5. Submit the form

### Step 3: Watch Console Output
Look for these specific messages in your Flutter console:

```
📤 Creating customer in database via direct API...
   Name: John Doe
   Email: john@example.com
✅ Guest saved to database: Customer ID 123

📸 Saving photo attachments to database...

🚀 STARTING MULTI-ATTACHMENT SAVE FOR CUSTOMER 123
📸 Photos to save:
   Front: /storage/emulated/0/IDM/ABC123/front.jpg
   Back: None
   Passport: /storage/emulated/0/IDM/ABC123/passport.jpg

📸 Saving PASSPORT photo...

🗃️  DATABASE SAVE OPERATION STARTING...
💾 Saving attachment to database...
   Customer ID: 123
   Type: passport
   Path: /storage/emulated/0/IDM/ABC123/passport.jpg
   API URL: http://YOUR_IP/1.IDM/src/api/upload-guest-attachments-api.php

✅ DATABASE SAVE SUCCESS! Response: {success: true, ...}
🎉 Photo path saved to guest_attachments table!

🎉 COMPLETE! Saved 1 attachment(s) to database
✅ All passport scan data is now in the MySQL database!
```

**If you see these messages → Everything is working perfectly! ✅**

---

## 🔍 Test Method 2: Database Verification

### Check the Database Directly

**Option A: Use phpMyAdmin**
1. Open phpMyAdmin: `http://localhost/phpmyadmin`
2. Select your database (usually `qloapps`)
3. Run this query:

```sql
SELECT 
    ga.id,
    ga.attachment_type,
    ga.file_path,
    ga.upload_date,
    c.firstname,
    c.lastname,
    c.email
FROM guest_attachments ga
JOIN qlo_customer c ON ga.id_customer = c.id_customer
ORDER BY ga.upload_date DESC
LIMIT 10;
```

**Option B: Use the Test Pages**
1. Open: `http://localhost/1.IDM/test-complete-passport-flow.php`
2. This will show you exactly what's in the database
3. Open: `http://localhost/1.IDM/test-passport-database.html`
4. Click "Get Recent Scans" to see JSON data

---

## 🔍 Test Method 3: API Test

### Test the API Directly
```bash
# Test saving an attachment
curl -X POST http://localhost/1.IDM/src/api/upload-guest-attachments-api.php \
  -H "Content-Type: application/json" \
  -d '{
    "id_customer": 999,
    "attachment_type": "passport",
    "file_path": "/storage/emulated/0/IDM/TEST123/passport.jpg"
  }'

# Test retrieving attachments
curl http://localhost/1.IDM/src/api/upload-guest-attachments-api.php?id_customer=999
```

---

## 🎯 What Should Happen (Complete Flow)

### 1. Local Storage (Already Working)
```
📱 Passport Scanned
↓
📸 Photos Captured
↓ 
💾 Saved to: /storage/emulated/0/IDM/{documentNumber}/
    ├── passport.jpg (for passports)
    ├── front.jpg (for ID cards)
    └── back.jpg (for ID cards)
```

### 2. Database Storage (Already Working)
```
📝 Guest Registration Form Submitted
↓
🗃️ Customer Record Created in qlo_customer table
↓
📸 GuestAttachmentService.saveMultipleAttachments() called
↓
💾 Photo paths saved to guest_attachments table:
    - id_customer: [customer_id]
    - attachment_type: 'passport' | 'id_front' | 'id_back'  
    - file_path: '/storage/emulated/0/IDM/...'
    - upload_date: [timestamp]
```

---

## 🚨 Troubleshooting

### Issue: No Console Logs Visible
**Solution:** Make sure Flutter is running in debug mode:
```bash
flutter run --debug
```

### Issue: "Database connection failed"
**Solutions:**
1. Check WAMP/MySQL is running
2. Verify database credentials in `config/config.inc.php`
3. Test API manually: `http://localhost/1.IDM/src/api/upload-guest-attachments-api.php`

### Issue: "Network error"
**Solutions:**
1. Check `hotel-staff-flutter/lib/utils/network_config.dart`
2. Ensure `computerIp` matches your actual IP
3. Test from browser: `http://YOUR_IP/1.IDM/test-passport-database.html`

### Issue: Table doesn't exist
**Solutions:**
1. Run: `http://localhost/1.IDM/check-table-status.php` (auto-creates table)
2. Or manually create with: `create_guest_attachments_table.sql`

---

## ✅ Success Criteria

You'll know it's working when:

1. **Console shows database save messages** ✅
2. **Database query returns your records** ✅  
3. **Test pages show recent scans** ✅
4. **Photos exist in /storage/emulated/0/IDM/** ✅

---

## 🎉 Summary

Your system **already does exactly what you want**:

- ✅ Scans passport/ID documents
- ✅ Captures and saves photos to local storage (`/storage/emulated/0/IDM/`)
- ✅ Creates customer records in database
- ✅ Automatically saves photo paths to `guest_attachments` table
- ✅ Provides complete audit trail with timestamps

**Just run the Flutter app and watch the console logs to see it happening!** 🚀

The enhanced logging will now make it very obvious when database saving occurs.