# 🚀 Escorts Feature - Quick Start Checklist

## ✅ Pre-Installation Checklist

- [ ] MySQL database is running
- [ ] Backend server (Node.js) is set up
- [ ] Flutter development environment is ready
- [ ] Project is opened in VS Code/IDE

## 📋 Installation Steps

### Step 1: Database Setup (2 minutes)
```bash
# Open MySQL command line or phpMyAdmin
# Execute the SQL file
```

**MySQL Command Line:**
```sql
mysql -u root -p qloapps < database_escort_tables.sql
```

**Or in MySQL CLI:**
```sql
USE qloapps;
SOURCE /path/to/database_escort_tables.sql;
```

**Verify:**
```sql
SHOW TABLES LIKE 'guest_escorts';
DESCRIBE guest_escorts;
```

✅ **Expected Result:** Two new tables created:
- `guest_escorts`
- `escort_attachments`

---

### Step 2: Backend Integration (3 minutes)

1. **Copy the API routes file:**
   - File: `hotel-backend/routes/escorts.js` is already created

2. **Register the routes in your main server file:**

**In `hotel-backend/server.js` or `hotel-backend/app.js`:**
```javascript
// Add this import at the top
const escortsRouter = require('./routes/escorts');

// Add this middleware
app.use('/api', escortsRouter);
```

3. **Install dependencies (if not already installed):**
```bash
cd hotel-backend
npm install express mysql2
```

4. **Update database credentials in `escorts.js` if needed:**
```javascript
const pool = mysql.createPool({
  host: 'localhost',
  user: 'root',          // ← Your MySQL username
  password: '',          // ← Your MySQL password
  database: 'qloapps',   // ← Your database name
  // ...
});
```

5. **Start your backend server:**
```bash
npm start
# or
node server.js
```

✅ **Expected Result:** Server running with no errors

---

### Step 3: Flutter App Setup (2 minutes)

1. **All files are already created** in your Flutter project:
   - ✅ Models
   - ✅ Services
   - ✅ Providers
   - ✅ Screens
   - ✅ Routes

2. **Update backend URL (if different from localhost:3000):**

**In `lib/services/escort_service.dart`:**
```dart
static const String baseUrl = 'http://localhost:3000/api';
// Change to your backend URL if different
```

3. **Get dependencies:**
```bash
cd hotel-staff-flutter
flutter pub get
```

4. **Run the app:**
```bash
flutter run
```

✅ **Expected Result:** App builds and runs successfully

---

## 🧪 Testing the Feature (5 minutes)

### Test 1: View Escorts Screen
- [ ] Open the app
- [ ] Go to Guest List
- [ ] Click on any guest
- [ ] Click "Manage Escorts & Companions"
- [ ] ✅ Escorts screen opens showing the guest info

### Test 2: Add Escort Manually
- [ ] On Escorts screen, click "+ Add Escort" button
- [ ] Fill in the form:
  - First Name: "Jane"
  - Last Name: "Doe"
  - Relationship: "Family"
  - (Optional: fill other fields)
- [ ] Click "Add Escort"
- [ ] ✅ Success message appears
- [ ] ✅ Escort appears in the list

### Test 3: Add Escort with Scanning
- [ ] On Escorts screen, click the scan icon (QR code)
- [ ] Scan a passport or ID card
- [ ] Capture photos
- [ ] ✅ Registration form auto-fills
- [ ] Review and submit
- [ ] ✅ Escort is added

### Test 4: Delete Escort
- [ ] Click the delete icon on an escort card
- [ ] Confirm deletion
- [ ] ✅ Escort is removed from list

### Test 5: Backend Verification
```sql
-- Check if data was saved
SELECT * FROM guest_escorts;
```
- [ ] ✅ Escorts appear in database

---

## 🔍 Troubleshooting

### Issue: "Failed to add escort"
**Possible Causes:**
1. Backend server not running
2. Wrong backend URL in `escort_service.dart`
3. Database connection issue

**Solutions:**
```bash
# Check backend is running
curl http://localhost:3000/api/escorts

# Check database connection
mysql -u root -p -e "USE qloapps; SELECT * FROM guest_escorts;"

# Update backend URL in escort_service.dart
```

### Issue: Escorts screen is blank
**Possible Causes:**
1. No escorts added yet
2. API endpoint not responding

**Solutions:**
- Add an escort first
- Check browser console for errors
- Verify backend URL

### Issue: Database errors
**Possible Causes:**
1. Tables not created
2. Foreign key constraint issues

**Solutions:**
```sql
-- Verify tables exist
SHOW TABLES LIKE 'guest_escorts';

-- Check foreign key
SHOW CREATE TABLE guest_escorts;

-- Re-run SQL script if needed
SOURCE database_escort_tables.sql;
```

### Issue: Navigation errors
**Possible Causes:**
1. Routes not registered properly

**Solutions:**
- Check `app_routes.dart` has both escort routes
- Verify EscortProvider is in main.dart
- Hot restart the app (not just hot reload)

---

## 📝 Quick Reference

### Backend Endpoints
```
POST   /api/escorts                 - Add escort
GET    /api/escorts/guest/:guestId  - Get escorts for guest
GET    /api/escorts/:id             - Get specific escort
PUT    /api/escorts/:id             - Update escort
DELETE /api/escorts/:id             - Delete escort
GET    /api/escorts/stats           - Get statistics
```

### Important Files
```
Flutter App:
├── lib/models/escort.dart
├── lib/providers/escort_provider.dart
├── lib/services/escort_service.dart
├── lib/screens/escort_registration_screen.dart
├── lib/screens/guest_escorts_screen.dart
└── lib/utils/app_routes.dart (updated)

Backend:
└── hotel-backend/routes/escorts.js

Database:
└── database_escort_tables.sql
```

### Database Tables
- `guest_escorts` - Main escorts data
- `escort_attachments` - Photos and documents

---

## ✨ Feature Highlights

✅ **Seamless Integration** - Works exactly like guest registration  
✅ **Document Scanning** - Uses existing MRZ scanner  
✅ **Beautiful UI** - Matches your app's theme  
✅ **Complete CRUD** - Create, Read, Update, Delete  
✅ **Relationship Types** - Companion, Family, Friend, Business, Other  
✅ **Production Ready** - Error handling, validation, security  

---

## 🎉 Success Indicators

You'll know it's working when:
- ✅ "Manage Escorts & Companions" button appears in guest details
- ✅ Escorts screen opens without errors
- ✅ You can add escorts manually
- ✅ You can add escorts by scanning documents
- ✅ Escorts appear in the list immediately
- ✅ You can delete escorts
- ✅ Data persists in the database

---

## 📚 Additional Resources

- 📖 Full Documentation: `ESCORTS_FEATURE_DOCUMENTATION.md`
- 📊 Visual Guide: `ESCORTS_FEATURE_VISUAL_GUIDE.md`
- 📝 Implementation Summary: `ESCORTS_FEATURE_SUMMARY.md`

---

## 💬 Need Help?

If you encounter issues:
1. Check the troubleshooting section above
2. Review the logs in terminal/console
3. Verify all files are in correct locations
4. Ensure database and backend are running
5. Try hot restart (not hot reload)

---

## ⏱️ Total Setup Time

| Task | Time |
|------|------|
| Database Setup | 2 min |
| Backend Integration | 3 min |
| Flutter Setup | 2 min |
| Testing | 5 min |
| **Total** | **~12 minutes** |

---

## 🎯 Next Steps After Setup

1. ✅ Test the feature thoroughly
2. 🎨 Customize colors/theme if needed
3. 📝 Train staff on how to use it
4. 🚀 Deploy to production
5. 📊 Monitor usage and gather feedback

---

**That's it! You're ready to manage escorts in your hotel management system! 🎊**
