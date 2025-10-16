# 🔧 Troubleshooting Guide

## Common Issues & Solutions

### 1. "Cannot connect to backend" ❌

**Problem:** App shows network error or timeout

**Solutions:**

✅ **Check backend is running:**
```powershell
curl http://localhost:3000/api/health
```
Should return: `{"success":true,"message":"Hotel Staff API is running"}`

✅ **Start backend if not running:**
```powershell
cd c:\wamp64\www\1.IDM\hotel-backend
npm start
```

✅ **Check WAMP server:**
- Open WAMP
- Ensure icon is GREEN (all services running)
- If ORANGE or RED, start MySQL service

---

### 2. "Wrong API URL" ❌

**Problem:** Using physical device and can't connect

**Solutions:**

✅ **Find your computer's IP:**
```powershell
ipconfig
```
Look for: `IPv4 Address . . . . . : 192.168.X.X`

✅ **Update API config:**
Edit: `hotel-staff-flutter/lib/utils/api_config.dart`
```dart
// Line 20: Change to your IP
static const String baseUrl = 'http://192.168.1.100:3000/api';
```

✅ **Ensure same WiFi:**
- Computer and phone must be on SAME WiFi network
- Not mobile data, not different WiFi

✅ **Check firewall:**
```powershell
# Temporarily disable to test
netsh advfirewall set allprofiles state off

# Re-enable after testing
netsh advfirewall set allprofiles state on
```

---

### 3. "Database error" ❌

**Problem:** Backend logs show database errors

**Solutions:**

✅ **Test database connection:**
```powershell
cd c:\wamp64\www\1.IDM\hotel-backend
node test-db-insert.js
```

✅ **Check MySQL is running:**
- Open WAMP
- Click WAMP icon → MySQL → Service → Start/Restart

✅ **Verify database exists:**
```sql
SHOW DATABASES;
USE hotel_staff_db;
SHOW TABLES;
```

✅ **Reinitialize database:**
```powershell
cd c:\wamp64\www\1.IDM\hotel-backend
node scripts/initDatabase.js
```

---

### 4. "Login failed" ❌

**Problem:** Cannot login to app

**Solutions:**

✅ **Try default credentials:**
- Username: `admin`
- Password: `admin123`

✅ **Check backend logs:**
Look for authentication errors in Node.js console

✅ **Verify staff table:**
```sql
USE hotel_staff_db;
SELECT * FROM staff;
```
Should show at least one admin user

✅ **Recreate admin user:**
```powershell
cd c:\wamp64\www\1.IDM\hotel-backend
node scripts/createDemoAccounts.js
```

---

### 5. "Flutter build errors" ❌

**Problem:** App won't compile

**Solutions:**

✅ **Clean and rebuild:**
```powershell
cd c:\wamp64\www\1.IDM\hotel-staff-flutter
flutter clean
flutter pub get
flutter run
```

✅ **Check Dart SDK:**
```powershell
flutter doctor
```

✅ **Check for errors:**
```powershell
flutter analyze
```

---

### 6. "Data not saving" ❌

**Problem:** Guest data disappears after adding

**Solutions:**

✅ **Check console logs:**
Look for:
- `✅ Guest saved to database via API` = Good
- `❌ Error adding guest` = Problem

✅ **Verify API mode:**
Edit: `hotel-staff-flutter/lib/providers/guest_provider.dart`
```dart
// Line 12: Should be true
bool _useApi = true;
```

✅ **Test API directly:**
```powershell
# Test creating a guest
curl -X POST http://localhost:3000/api/guests `
  -H "Content-Type: application/json" `
  -d '{"firstName":"Test","lastName":"User"}'
```

✅ **Check database:**
```sql
USE hotel_staff_db;
SELECT COUNT(*) FROM guests;
```

---

### 7. "Port already in use" ❌

**Problem:** Backend won't start - port 3000 busy

**Solutions:**

✅ **Find what's using port 3000:**
```powershell
netstat -ano | findstr :3000
```

✅ **Kill the process:**
```powershell
# Replace PID with the number from above
taskkill /PID <PID> /F
```

✅ **Change backend port:**
Edit: `hotel-backend/.env`
```
PORT=3001
```
Then update Flutter config to match

---

### 8. "Emulator networking issues" ❌

**Problem:** Android emulator can't reach localhost

**Solutions:**

✅ **Use special IP for emulator:**
```dart
// In api_config.dart
static const String baseUrl = 'http://10.0.2.2:3000/api';
```
Note: `10.0.2.2` is special alias for host machine in emulator

✅ **Test from emulator browser:**
Open Chrome in emulator → `http://10.0.2.2:3000/api/health`

✅ **Try iOS Simulator alternative:**
```dart
// For iOS Simulator only
static const String baseUrl = 'http://localhost:3000/api';
```

---

## Quick Diagnostics

### Run This Checklist:

```powershell
# 1. Check backend
curl http://localhost:3000/api/health

# 2. Check database
cd c:\wamp64\www\1.IDM\hotel-backend
node test-db-insert.js

# 3. Check Flutter
cd c:\wamp64\www\1.IDM\hotel-staff-flutter
flutter analyze

# 4. Check MySQL
# Open phpMyAdmin → Check hotel_staff_db exists
```

### Expected Results:

| Test | Success Message |
|------|----------------|
| Backend Health | `{"success":true}` |
| Database Insert | `✅ Insert successful!` |
| Flutter Analyze | `No issues found!` |
| MySQL Check | Tables: staff, guests, rooms |

---

## Getting More Help

### Enable Debug Logging:

**Flutter console:**
Already enabled - watch for messages with:
- ✅ (success)
- ❌ (error)
- ⚠️ (warning)
- 🔄 (processing)

**Backend console:**
Shows all API requests and database queries

### Check Log Files:

**Backend logs:**
Terminal where you ran `npm start`

**Flutter logs:**
Terminal where you ran `flutter run`

**MySQL logs:**
WAMP → MySQL → Log files

---

## Still Not Working?

### Collect This Information:

1. **Error message** (exact text)
2. **Console output** (Flutter and backend)
3. **Configuration**:
   - API URL in `api_config.dart`
   - Backend `.env` file
4. **Environment**:
   - Device type (emulator/physical)
   - Flutter version: `flutter --version`
   - Node version: `node --version`

### Contact Support With:

```
Subject: Hotel App Database Issue

Device: [Android Emulator / Physical Device / iOS]
Error: [Copy exact error message]
Console: [Copy relevant console output]
Config: [Share api_config.dart baseUrl]

What I tried:
- [List troubleshooting steps you followed]
```

---

**Quick Reference:**

| Issue | First Try |
|-------|-----------|
| Connection | Check backend running |
| Login | Use `admin` / `admin123` |
| Network | Verify IP address |
| Database | Run `test-db-insert.js` |
| Build | `flutter clean && flutter pub get` |

---

**Last Updated:** October 14, 2025
