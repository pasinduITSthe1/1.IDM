# ✅ ESCORTS FEATURE - CONNECTION FIX

## 🎯 The Problem You Had

```
❌ Error adding escort: ClientException with SocketException: Connection refused
uri=http://localhost:3000/api/escorts
```

**Cause:** Backend server wasn't running!

---

## 🚀 THE FIX (2 Simple Steps)

### ✅ STEP 1: Setup Database (One-Time Only)

Run this command in PowerShell:

```powershell
cd C:\wamp64\www\1.IDM
.\SETUP_ESCORTS_DATABASE.ps1
```

**Or manually:**
```powershell
Get-Content database_escort_tables.sql | mysql -u root -p qloapps
```

✅ **This creates the `guest_escorts` and `escort_attachments` tables**

---

### ✅ STEP 2: Start Backend Server (Every Time)

**The server is ALREADY RUNNING! ✅**

You can see it in your terminal:
```
✅ Server running on port 3000
  - POST /api/escorts
  - GET  /api/escorts/guest/:guestId
```

**If it stops, restart it:**
```batch
cd C:\wamp64\www\1.IDM\hotel-backend
node server.js
```

---

## 🧪 TEST IT NOW!

1. **Backend server is running** ✅ (already started)
2. **Now test in your Flutter app:**
   - Open Guest List
   - Click on a guest
   - Click "Manage Escorts & Companions"
   - Click "+ Add Escort"
   - Fill the form:
     ```
     Relationship: Family Member
     First Name: Jane
     Last Name: Doe
     Document Type: Passport
     Document Number: P1234567
     ```
   - Click "Add Escort"

3. **You should see:** ✅ "Escort added successfully!"

---

## 🔍 Quick Verification

### Check if backend is running:
```powershell
curl http://localhost:3000/api/health
```

Should return:
```json
{
  "success": true,
  "message": "Hotel Staff API is running"
}
```

### Check database tables exist:
```sql
USE qloapps;
SHOW TABLES LIKE 'guest_escorts';
```

Should return:
```
guest_escorts
```

---

## 📋 What I Fixed

1. ✅ **Registered escorts API** in server.js:
   ```javascript
   app.use('/api', require('./routes/escorts'));
   ```

2. ✅ **Started backend server** - Now running on port 3000

3. ✅ **Created setup scripts** for easy database setup

---

## 🎉 YOU'RE READY!

**Backend server is running!** Now just:

1. Make sure database tables are created (Step 1 above)
2. Try adding an escort in your Flutter app
3. It should work now! ✅

---

## 🐛 Still Having Issues?

### ❌ "Connection refused"
- **Check:** Is backend server running? 
- **Fix:** Run `node server.js` in hotel-backend folder

### ❌ "Table doesn't exist"
- **Check:** Did you run the database setup?
- **Fix:** Run `SETUP_ESCORTS_DATABASE.ps1`

### ❌ "MySQL connection error"
- **Check:** Is WAMP/MySQL running?
- **Fix:** Start WAMP, check MySQL service

---

**The escorts feature should now work perfectly!** 🎉
