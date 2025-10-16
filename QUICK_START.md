# Quick Start - Database Connection

## TL;DR - What Was Wrong

**The Flutter app was only saving to local storage, NOT to the database.**

## The Fix

I've added API integration so the app now saves to MySQL database.

## Quick Setup (3 Steps)

### 1. Backend is Already Running ✅
```
http://localhost:3000 - Server running
MySQL database - Connected and working
```

### 2. Configure Flutter App

**For Android Emulator** (default - no change needed):
Already set to: `http://10.0.2.2:3000/api`

**For Physical Device** (need to update):
1. Find your computer's IP:
   ```powershell
   ipconfig
   ```
   Look for "IPv4 Address" (e.g., 192.168.1.100)

2. Edit: `lib/utils/api_config.dart`
   ```dart
   static const String baseUrl = 'http://192.168.1.100:3000/api';
   ```
   (Replace with your actual IP)

### 3. Run App
```powershell
cd c:\wamp64\www\1.IDM\hotel-staff-flutter
flutter run
```

## Test It Works

### 1. Login
- Username: `admin`
- Password: `admin123`

### 2. Add a Guest
Watch the console for:
```
✅ Guest saved to database via API
```

### 3. Verify in Database
```powershell
cd c:\wamp64\www\1.IDM\hotel-backend
node test-db-insert.js
```

Should show: `Total guests in database: X`

## Console Messages

### ✅ Working:
- `✅ MySQL database connected successfully`
- `✅ Guest saved to database via API`
- `✅ Loaded X guests from API/database`

### ❌ Problems:
- `❌ Error connecting to MySQL database` → Check WAMP/MySQL
- `❌ API login failed` → Check backend is running
- `❌ Network error` → Check API URL configuration

## Files You Might Need to Edit

### Only if using physical device:
- `lib/utils/api_config.dart` - Update IP address

### Everything else is configured and ready!

## Default Login Credentials

| Type | Username/Email | Password |
|------|---------------|----------|
| Admin | admin | admin123 |
| Fallback | staff@hotel.com | staff123 |

## What Changed

### Before:
```
Flutter App → Local Storage ONLY
```

### After:
```
Flutter App → API → Backend → MySQL Database
      ↓
Local Storage (backup)
```

## Need Help?

See detailed guide: `Docs/DATABASE_CONNECTION_SETUP.md`

---

**Status:** ✅ Ready to use
**Backend:** ✅ Running on port 3000
**Database:** ✅ Connected and tested
**Flutter:** ✅ Compiled successfully
