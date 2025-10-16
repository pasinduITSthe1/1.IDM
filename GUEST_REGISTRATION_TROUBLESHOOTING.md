# 🔧 GUEST REGISTRATION TO DATABASE - TROUBLESHOOTING

## Current Status Check

Based on the logs, I can see:
- ✅ Backend server is running
- ✅ You logged in successfully
- ✅ Guests list was loaded (GET /api/guests)
- ✅ Guest creation was attempted (POST /api/guests)

But you say guests aren't being registered. Let's diagnose and fix this!

---

## 🔍 Diagnostic Steps

### Step 1: Check if Firewall is Still Blocking

The most common issue is that the **firewall rule wasn't added yet**.

**Quick test:**
```powershell
curl http://10.0.1.24:3000/api/health
```

**If you see error** → Firewall is blocking. Run the firewall fix script!

**If you see success** → Firewall is open, move to Step 2

---

### Step 2: Check Backend Console for Errors

Look at the terminal where Node.js is running.

**What to look for:**
- Any red error messages
- Database errors
- Failed to create guest
- 400/500 error codes

---

### Step 3: Check Flutter Console

In your Flutter console, when you try to add a guest, look for:

**✅ Good signs:**
```
✅ Guest saved to database via API
```

**❌ Problem signs:**
```
❌ Error adding guest
❌ Network error
❌ Connection timeout
```

---

## 🚀 SOLUTIONS

### Solution 1: Add Firewall Rule (If Not Done Already)

**This is THE most common issue!**

1. Open File Explorer
2. Go to: `c:\wamp64\www\1.IDM\hotel-backend\`
3. Right-click: `fix-firewall.ps1`
4. Click: "Run with PowerShell"
5. Click "Yes" when prompted

**Then restart your app** (press `R` in Flutter terminal)

---

### Solution 2: Verify Database Connection

Run this test script:

1. Open PowerShell
2. Navigate to backend folder:
   ```powershell
   cd c:\wamp64\www\1.IDM\hotel-backend
   ```

3. Run test:
   ```powershell
   node test-db-insert.js
   ```

**Expected output:**
```
✅ Insert successful!
✅ Guest found in database
Total guests in database: X
```

**If you see errors** → Database connection problem

---

### Solution 3: Check if API is Using Network or Local Mode

The Flutter app has a toggle for API mode.

**Check this file:**
`hotel-staff-flutter/lib/providers/guest_provider.dart`

Look for this line (around line 12):
```dart
bool _useApi = true;
```

**It should be `true`** for database saving!

If it's `false`, change it to `true` and hot restart.

---

### Solution 4: Enable More Detailed Logging

Let's add console logging to see what's happening:

**In your Flutter app**, when you add a guest, watch the console for:
```
🔄 Creating guest: [Name]
📡 POST: http://10.0.1.24:3000/api/guests
📤 Data: {...}
```

Then look for either:
```
✅ Success: Guest created successfully
```
OR
```
❌ Error: [error message]
```

---

## 🧪 Manual Test - Add Guest via API

Let's test if the backend can save guests directly:

**Open PowerShell and run:**

```powershell
$headers = @{
    "Content-Type" = "application/json"
}

$body = @{
    firstName = "Manual"
    lastName = "Test"
    documentNumber = "TEST123"
    nationality = "Test Country"
    status = "pending"
} | ConvertTo-Json

Invoke-RestMethod -Uri "http://localhost:3000/api/guests" -Method Post -Headers $headers -Body $body
```

**If this works** → Backend is fine, issue is in Flutter app
**If this fails** → Backend has an issue

---

## 📋 Quick Checklist

Run through this checklist:

- [ ] Backend server is running (check terminal)
- [ ] MySQL/WAMP is running (check system tray)
- [ ] Firewall rule is added (run fix-firewall.ps1)
- [ ] Flutter app is in "Online" mode (not "Demo")
- [ ] API config points to correct IP (10.0.1.24)
- [ ] `_useApi = true` in guest_provider.dart
- [ ] Phone and computer on same WiFi network

---

## 🔄 Complete Reset Process

If nothing works, try this complete reset:

### 1. Stop Everything
```powershell
# Kill Node.js
taskkill /F /IM node.exe

# Stop Flutter app
# Press 'q' in Flutter terminal
```

### 2. Add Firewall Rule
```powershell
# Run as Administrator
netsh advfirewall firewall add rule name="Hotel Backend API" dir=in action=allow protocol=TCP localport=3000
```

### 3. Restart Backend
```powershell
cd c:\wamp64\www\1.IDM\hotel-backend
node server.js
```

### 4. Restart Flutter
```powershell
cd c:\wamp64\www\1.IDM\hotel-staff-flutter
flutter run
```

### 5. Test
- Login: admin / admin123
- Add a guest
- Watch both consoles for messages

---

## 🎯 Expected Behavior

**When working correctly, you'll see:**

**Flutter Console:**
```
🔄 Creating guest: John Doe
📡 POST: http://10.0.1.24:3000/api/guests
📤 Data: {"firstName":"John","lastName":"Doe"...}
📥 Response status: 201
✅ Success: Guest created successfully
✅ Guest saved to database via API
```

**Backend Console:**
```
2025-10-14T10:XX:XX.XXXZ - POST /api/guests
```

**In the app:**
- Guest appears in the list immediately
- Status shows as "Pending" or whatever you set
- Can see the guest details

---

## 🆘 Still Not Working?

### Collect This Info:

1. **Flutter Console Output** (when adding guest)
2. **Backend Console Output** (any errors)
3. **Firewall Test Result:**
   ```powershell
   curl http://10.0.1.24:3000/api/health
   ```
4. **Database Test Result:**
   ```powershell
   node test-db-insert.js
   ```

Send me these outputs and I can diagnose the exact issue!

---

## 💡 Most Likely Issue

**99% of the time, it's the FIREWALL!**

If you haven't run the firewall fix script yet, **DO IT NOW**:

1. Go to: `c:\wamp64\www\1.IDM\hotel-backend\`
2. Right-click: `fix-firewall.ps1`
3. "Run with PowerShell"
4. Click "Yes"
5. Press `R` in Flutter
6. Try adding a guest

**It will work!** 🎉

---

**Quick Summary:**
1. Add firewall rule ← **MOST IMPORTANT**
2. Restart Flutter app (press R)
3. Try adding guest
4. Check console logs for errors
5. If still failing, run manual tests above
