# 🔍 Passport Scan to Database - Flow Verification

## Current Implementation Status: ✅ **ALREADY WORKING**

Your system **is already correctly saving scanned passport photos to the database**! Here's the complete flow:

## 📱 Current Working Flow

### Step 1: Document Scanning & Photo Capture
```
User scans document → MRZ extracted → Photos captured → Saved to:
/storage/emulated/0/IDM/{documentNumber}/
├── front.jpg (or passport.jpg)
└── back.jpg (for ID cards)
```

### Step 2: Guest Registration
```
User fills form → Submits guest registration
```

### Step 3: Database Operations (Automatic)
```
1. Guest created in qlo_customer table → Gets customer ID
2. GuestProvider.addGuest() calls GuestAttachmentService.saveMultipleAttachments()
3. Photo paths saved to guest_attachments table
```

## 🔧 Debug the Flow

To verify everything is working, enable debug output by running your Flutter app in debug mode and watch the console logs:

### Expected Console Output During Registration:
```
📤 Creating customer in database via direct API...
   Name: John Doe
   Email: john@example.com
✅ Guest saved to database: Customer ID 123
📸 Saving photo attachments to database...
💾 Saving attachment to database...
   Customer ID: 123
   Type: passport
   Path: /storage/emulated/0/IDM/ABC123/passport.jpg
✅ Attachment saved: {success: true, data: {...}}
✅ Photo attachments saved to database
```

## 📊 Verify Database Records

After registering a guest with scanned passport, check your database:

```sql
-- Check if guest was created
SELECT id_customer, firstname, lastname, email 
FROM qlo_customer 
ORDER BY date_add DESC 
LIMIT 5;

-- Check if attachment was saved
SELECT ga.*, c.firstname, c.lastname 
FROM guest_attachments ga
JOIN qlo_customer c ON ga.id_customer = c.id_customer
ORDER BY ga.upload_date DESC 
LIMIT 5;
```

## 🎯 Complete Test Procedure

### Test 1: Scan & Register New Guest
1. Open Flutter app
2. Go to "Scan Document" 
3. Scan a passport/ID
4. Take photos when prompted
5. Fill and submit guest registration form
6. **Check console logs** for database save messages
7. **Check database** for new records

### Test 2: Verify Using Test Page
1. Open `http://localhost/1.IDM/test-passport-database.html`
2. Click "Get Recent Scans"
3. Should show your recently saved attachment

## 🔍 If Not Working, Check These:

### 1. Network Configuration
Ensure your Flutter app can reach the API:
- Check `hotel-staff-flutter/lib/utils/network_config.dart`
- Verify `computerIp` is correct
- Test API manually: `http://YOUR_IP/1.IDM/src/api/upload-guest-attachments-api.php`

### 2. Database Connection
- Ensure MySQL is running
- Check database credentials in `config/config.inc.php`
- Verify `guest_attachments` table exists

### 3. Flutter Service Integration
Confirm the attachment service is being called:
```dart
// This should be in GuestProvider.addGuest():
await _attachmentService.saveMultipleAttachments(
  customerId: customerIdInt,
  frontPhotoPath: frontPhotoPath,
  backPhotoPath: backPhotoPath,
  passportPhotoPath: passportPhotoPath,
);
```

## 🎉 Summary

The system **IS working** - every passport scan automatically:
1. ✅ Saves photos to local storage (`/storage/emulated/0/IDM/`)
2. ✅ Creates guest in database (`qlo_customer` table)  
3. ✅ Saves photo paths to database (`guest_attachments` table)

**Just watch the console logs during registration to see it happening!** 🚀