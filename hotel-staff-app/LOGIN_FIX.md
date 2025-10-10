# 🔧 Login Issue - Quick Fix Guide

## Problem
Cannot login to the mobile app - getting network errors.

## ✅ **IMMEDIATE FIX - Use Demo Mode**

Since the API connection isn't working yet, **use Demo Mode** to test the app:

### Steps:
1. **Open the app:** http://localhost:3001 (or http://localhost:3000)

2. **Toggle to Demo Mode:**
   - Click the switch that says "QloApps Mode" to switch to "Demo Mode (Offline)"

3. **Login with Demo Credentials:**
   ```
   Email: staff@hotel.com
   Password: demo123
   ```

4. **You're in!** The app will work with local data for testing.

---

## 🔍 **Why QloApps Mode Isn't Working Yet**

The mobile app needs to connect to the PHP backend API. Here's what needs to be checked:

### 1. **WAMP Server Status**
✅ Check: Is WAMP running? (green icon in system tray)

### 2. **API Endpoint Test**
Open this URL in your browser:
```
http://localhost/1.IDM/admin134miqa0b/ajax-mobile-api.php?controller=AdminDashboard&action=getStats
```

**Expected result:**
```json
{
  "success": true,
  "data": {
    "todayCheckIns": 0,
    "todayCheckOuts": 0,
    "activeGuests": 0,
    "pendingActions": 0
  }
}
```

**If you see an error:**
- Check WAMP is running
- Verify the path exists
- Check PHP error logs

### 3. **CORS Configuration**
The PHP file already has CORS headers, but you may need to enable them in Apache.

**Fix:** Add to `.htaccess` or `httpd.conf`:
```apache
Header set Access-Control-Allow-Origin "*"
Header set Access-Control-Allow-Methods "GET, POST, PUT, DELETE, OPTIONS"
Header set Access-Control-Allow-Headers "Content-Type, Authorization, X-Requested-With"
```

### 4. **Port Configuration**
The app is running on **port 3001** (not 3000).

**Access it at:**
- http://localhost:3001
- OR: http://192.168.251.166:3001 (from mobile)

---

## 🧪 **Test the API Connection**

I've created a test tool for you:

**Open in browser:**
```
http://localhost/1.IDM/api-test.html
```

This will test:
1. ✅ Basic connection
2. ✅ Dashboard stats
3. ✅ Login authentication
4. ✅ Customer list

---

## 🚀 **Quick Steps to Fix**

### Option 1: Use Demo Mode (FASTEST)
1. Open app: http://localhost:3001
2. Toggle "Demo Mode"
3. Login: `staff@hotel.com` / `demo123`
4. ✅ **Works immediately!**

### Option 2: Fix QloApps Connection
1. **Start WAMP** (if not running)

2. **Test API endpoint:**
   ```
   http://localhost/1.IDM/admin134miqa0b/ajax-mobile-api.php?controller=AdminDashboard&action=getStats
   ```

3. **If it doesn't work:**
   - Check `c:\wamp64\www\1.IDM\admin134miqa0b\ajax-mobile-api.php` exists
   - Check PHP error logs: `c:\wamp64\logs\php_error.log`
   - Restart WAMP

4. **Test with the test tool:**
   ```
   http://localhost/1.IDM/api-test.html
   ```

5. **Once API works, login with:**
   - Email: `pasindu.itsthe1@gmail.com`
   - Your QloApps admin password

---

## 📝 **Current Status**

### ✅ **Working:**
- Mobile app frontend running on port 3001
- Demo mode with offline data
- All UI features (scanning, forms, etc.)
- Login with demo credentials

### ⚠️ **Needs Setup:**
- QloApps API connection
- CORS configuration
- Database synchronization

---

## 🎯 **Next Steps**

### For Testing NOW:
1. **Use Demo Mode** - Works immediately!
2. Test all features (scanning, guest registration, check-in/out)
3. Verify UI and workflows

### For QloApps Integration:
1. Ensure WAMP is running
2. Test API endpoint in browser
3. Use the test tool to verify connectivity
4. Check PHP error logs for issues
5. Enable CORS if needed

---

## 🔗 **Helpful URLs**

### Mobile App
- Main app: http://localhost:3001
- Mobile access: http://192.168.251.166:3001

### API Testing
- API test tool: http://localhost/1.IDM/api-test.html
- Dashboard stats: http://localhost/1.IDM/admin134miqa0b/ajax-mobile-api.php?controller=AdminDashboard&action=getStats
- QloApps admin: http://localhost/1.IDM/admin134miqa0b/

### Logs
- PHP errors: `c:\wamp64\logs\php_error.log`
- Apache errors: `c:\wamp64\logs\apache_error.log`

---

## 💡 **TIP: Start with Demo Mode!**

The fastest way to test the app is Demo Mode:
1. Open http://localhost:3001
2. Switch to "Demo Mode (Offline)"
3. Login: `staff@hotel.com` / `demo123`
4. Test all features!

**You can set up QloApps integration later** - the app works fully in Demo Mode!

---

## 📞 **Still Having Issues?**

### Check Console Errors
1. Open browser DevTools (F12)
2. Look at Console tab for errors
3. Check Network tab for failed requests

### Verify Files Exist
```
c:\wamp64\www\1.IDM\admin134miqa0b\ajax-mobile-api.php
c:\wamp64\www\1.IDM\hotel-staff-app\.env.development
```

### Test WAMP
```
http://localhost/
```
Should show WAMP homepage.

---

**Status:** ✅ **APP IS WORKING IN DEMO MODE**

**Action:** Use Demo Mode to test the app now, fix QloApps connection later!
