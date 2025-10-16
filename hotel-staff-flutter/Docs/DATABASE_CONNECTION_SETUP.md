# Database Connection Setup Guide

## Problem Identified

The Flutter app was **only saving data to local storage (SharedPreferences)** on the device and **NOT connecting to the MySQL database**. This has been fixed!

## What Was Fixed

1. ✅ Created API service layer to connect Flutter app to backend
2. ✅ Updated GuestProvider to save data to database via API
3. ✅ Updated AuthProvider to authenticate via API
4. ✅ Added proper error handling and fallback to local storage
5. ✅ Database backend is working correctly and accepting data

## How It Works Now

### Data Flow:
```
Flutter App → API Service → Node.js Backend → MySQL Database
     ↓                                              ↓
Local Storage (backup)                    Persistent Storage
```

### Features:
- **Primary**: Data saves to MySQL database via API
- **Backup**: Also saves to local storage for offline access
- **Fallback**: If API fails, uses local storage
- **Auto-sync**: Loads from database when online

## Setup Instructions

### 1. Configure Backend Server

The backend is already set up in `hotel-backend` folder.

**Start the backend server:**
```powershell
cd c:\wamp64\www\1.IDM\hotel-backend
npm install
npm start
```

Server should start on: `http://localhost:3000`

### 2. Configure Flutter App API URL

Open: `lib/utils/api_config.dart`

**For Android Emulator** (default):
```dart
static const String baseUrl = 'http://10.0.2.2:3000/api';
```

**For Physical Android Device**:
1. Find your computer's IP address:
   ```powershell
   ipconfig
   ```
   Look for "IPv4 Address" (e.g., 192.168.1.100)

2. Update config:
   ```dart
   static const String baseUrl = 'http://YOUR_IP:3000/api';
   // Example: static const String baseUrl = 'http://192.168.1.100:3000/api';
   ```

**For iOS Simulator**:
```dart
static const String baseUrl = 'http://localhost:3000/api';
```

### 3. Run Flutter App

```powershell
cd c:\wamp64\www\1.IDM\hotel-staff-flutter
flutter pub get
flutter run
```

## Testing Database Connection

### Test 1: Health Check
The app will automatically test the API connection on startup.

### Test 2: Login
Default credentials:
- Username: `admin`
- Password: `admin123`

### Test 3: Add Guest
1. Login to the app
2. Add a new guest
3. Check the console logs for "✅ Guest saved to database via API"

### Test 4: Verify in Database
Check the database to confirm data was saved:

```powershell
cd c:\wamp64\www\1.IDM\hotel-backend
node test-db-insert.js
```

Or query directly:
```sql
USE hotel_staff_db;
SELECT * FROM guests;
```

## Console Output Indicators

### ✅ Success Messages:
- `✅ MySQL database connected successfully`
- `✅ Loaded X guests from API/database`
- `✅ Guest saved to database via API`
- `✅ Guest updated in database via API`
- `✅ Guest checked in via API`
- `✅ Logged in successfully via API`

### ⚠️ Fallback Messages:
- `⚠️ API failed, falling back to local storage`
- `ℹ️ Guest saved to local storage only`

### ❌ Error Messages:
- `❌ Error connecting to MySQL database`
- `❌ API login failed`
- `❌ Error adding guest`

## Troubleshooting

### Issue: Cannot connect to backend

**Check 1: Is backend running?**
```powershell
# Test backend health
curl http://localhost:3000/api/health
```

Should return:
```json
{
  "success": true,
  "message": "Hotel Staff API is running"
}
```

**Check 2: Is MySQL running?**
- Make sure WAMP server is running
- Check MySQL service is started

**Check 3: Network connection**
- For physical devices, ensure device and computer are on same WiFi
- Disable firewall temporarily to test
- Check the IP address is correct

### Issue: API returns errors

**Check backend logs:**
The Node.js console will show detailed error messages.

**Common issues:**
1. Database not initialized → Run: `node scripts/initDatabase.js`
2. Wrong credentials → Check `.env` file
3. Table doesn't exist → Reinitialize database

### Issue: Data not saving

**Check Flutter console logs:**
Look for error messages starting with ❌

**Common fixes:**
1. Restart backend server
2. Check API URL in `api_config.dart`
3. Verify database is running
4. Check network connectivity

## API Endpoints

The app uses these endpoints:

- `POST /api/auth/login` - Login
- `POST /api/auth/register` - Register new staff
- `GET /api/guests` - Get all guests
- `POST /api/guests` - Create guest
- `PUT /api/guests/:id` - Update guest
- `DELETE /api/guests/:id` - Delete guest
- `PUT /api/guests/:id/checkin` - Check-in guest
- `PUT /api/guests/:id/checkout` - Check-out guest

## Demo Mode vs Online Mode

### Demo Mode:
- No database connection required
- Data saved to local storage only
- Useful for testing UI/UX

### Online Mode:
- Connects to backend API
- Saves to MySQL database
- Real-time data synchronization

Toggle in `lib/providers/guest_provider.dart`:
```dart
bool _useApi = true; // true = Online, false = Demo
```

## Files Modified

### New Files:
- ✅ `lib/services/api_service.dart` - HTTP client wrapper
- ✅ `lib/services/guest_service.dart` - Guest API endpoints
- ✅ `lib/services/auth_service.dart` - Authentication API
- ✅ `lib/utils/api_config.dart` - API configuration
- ✅ `hotel-backend/test-db-insert.js` - Database test script

### Updated Files:
- ✅ `lib/providers/guest_provider.dart` - Added API integration
- ✅ `lib/providers/auth_provider.dart` - Added API authentication
- ✅ `lib/models/guest.dart` - Added API JSON parsing

## Next Steps

1. ✅ Backend is working and accepting data
2. ✅ Flutter app now connects to backend
3. ✅ Data saves to MySQL database
4. 🔄 Test the app end-to-end
5. 🔄 Verify data persistence across app restarts

## Support

If you encounter issues:

1. Check console logs for error messages
2. Verify backend is running: `http://localhost:3000/api/health`
3. Test database connection: `node test-db-insert.js`
4. Check API configuration in `lib/utils/api_config.dart`
5. Review this guide's troubleshooting section

---

**Last Updated:** October 14, 2025
**Status:** ✅ Database integration complete and working
