# 🚀 Quick Start Guide - QloApps Integrated Flutter App

## ✅ Prerequisites Completed

- ✅ QloApps installed and running on WAMP
- ✅ API Key generated: `2WUGS9C92CRCSJ1IJME9ST1DFCFDD3C4`
- ✅ API permissions configured for all resources
- ✅ Flutter app configured with correct IP: `10.0.1.24`
- ✅ Database integration implemented
- ✅ No Node.js backend required

---

## 🎯 How to Run the App

### **Step 1: Start WAMP Server**

```powershell
# Make sure WAMP is running
# Open WAMP Control Panel
# Verify all services are green:
#   - Apache: Running
#   - MySQL: Running
```

**Verify QloApps is accessible:**
- Open browser: `http://localhost/1.IDM/`
- Should see QloApps homepage

---

### **Step 2: Run Flutter App**

```powershell
# Navigate to Flutter project
cd C:\wamp64\www\1.IDM\hotel-staff-flutter

# Get dependencies (first time only)
flutter pub get

# Run on connected device (CPH2211)
flutter run
```

**Important:** Device must be on same WiFi network as your computer!

---

### **Step 3: Login to App**

**Credentials:**
- Username: `admin`
- Password: `admin123`

**What happens:**
1. App connects to QloApps API at `http://10.0.1.24/1.IDM/api`
2. Authenticates using employees table
3. Loads customers from QloApps database
4. Ready to use!

---

## 📱 Using the App

### **1. View Guests**

- Go to "Guests" screen
- See all customers from QloApps database
- Pull down to refresh

**Data Source:** `qlo_customer` table

---

### **2. Add New Guest**

1. Click "+" button
2. Fill form:
   - First Name
   - Last Name
   - Email
   - Phone
   - Other details (optional)
3. Click "Save"

**Result:**
- ✅ Guest created in `qlo_customer` table
- ✅ Visible in QloApps admin immediately
- ✅ Visible in Flutter app immediately

---

### **3. Update Guest**

1. Tap on guest in list
2. Click "Edit"
3. Modify details
4. Click "Save"

**Result:**
- ✅ Guest updated in `qlo_customer` table
- ✅ Changes visible in QloApps admin
- ✅ Changes visible in Flutter app

---

### **4. Check-in Guest**

1. Select guest with status "pending"
2. Click "Check In"
3. Assign room number
4. Add notes (optional)
5. Confirm

**Result:**
- ✅ Status changed to "checked_in"
- ✅ Timestamp recorded in customer notes
- ✅ Room number assigned

---

### **5. Check-out Guest**

1. Select guest with status "checked_in"
2. Click "Check Out"
3. Confirm

**Result:**
- ✅ Status changed to "checked_out"
- ✅ Checkout timestamp recorded

---

### **6. Delete Guest**

1. Select guest
2. Click "Delete"
3. Confirm

**Result:**
- ✅ Customer deactivated (not deleted)
- ✅ `active = 0` in database
- ✅ Hidden from app list

---

## 🔍 Verify Data in Database

### **Using phpMyAdmin:**

1. Open: `http://localhost/phpmyadmin`
2. Select database: `qloapps_db`
3. Run queries:

```sql
-- View all customers
SELECT 
  id_customer,
  firstname,
  lastname,
  email,
  phone,
  active,
  date_add
FROM qlo_customer
ORDER BY date_add DESC;

-- View customers created today
SELECT * FROM qlo_customer
WHERE DATE(date_add) = CURDATE();

-- View customer by email
SELECT * FROM qlo_customer
WHERE email = 'testguest@hotel.com';
```

---

## 🛠️ Troubleshooting

### **Problem: "Cannot connect to server"**

**Solution:**
```powershell
# 1. Check WAMP is running
# 2. Verify IP address
ipconfig
# Look for IPv4 Address in your WiFi adapter
# Should be: 10.0.1.24

# 3. Test API in browser
# Open: http://10.0.1.24/1.IDM/api/customers?output_format=JSON

# 4. Check device WiFi
# Must be on same network as computer
```

---

### **Problem: "Authentication failed"**

**Solution:**
```
1. Check credentials: admin / admin123
2. Verify API key in QloApps admin:
   - Advanced Parameters > Webservice
   - Should see key: 2WUGS9C92CRCSJ1IJME9ST1DFCFDD3C4
3. Check employee exists:
   - QloApps Admin > Employees
   - Should have admin user
```

---

### **Problem: "Guest not appearing"**

**Solution:**
```sql
-- Check in database
USE qloapps_db;
SELECT * FROM qlo_customer 
WHERE active = 1 
ORDER BY date_add DESC 
LIMIT 10;

-- Check debug output in Flutter console
-- Should see:
📤 Creating customer in QloApps database...
✅ Guest saved to QloApps database: Customer ID 123
```

---

### **Problem: "Data not syncing"**

**Solution:**
1. Pull down to refresh guest list
2. Check internet connection
3. Verify WAMP server is running
4. Check Flutter console for errors

---

## 📊 Test Checklist

Run these tests to verify integration:

- [ ] **Login works** - Can authenticate with admin/admin123
- [ ] **Load guests** - Can see existing customers from QloApps
- [ ] **Create guest** - New guest appears in both systems
- [ ] **Update guest** - Changes reflect in both systems
- [ ] **Check-in** - Status updates correctly
- [ ] **Check-out** - Status updates correctly
- [ ] **Delete guest** - Customer deactivated in database
- [ ] **Refresh** - Pull to refresh loads latest data
- [ ] **Database verify** - Data visible in phpMyAdmin

---

## 🎯 Success Indicators

You'll know it's working when:

1. **Flutter Console Shows:**
```
📡 Loading guests from QloApps API...
✅ Loaded 5 guests from QloApps
📤 Creating customer in QloApps database...
✅ Guest saved to QloApps database: Customer ID 123
```

2. **phpMyAdmin Shows:**
- New records in `qlo_customer` table
- `date_add` timestamps match creation time
- Customer data matches Flutter input

3. **QloApps Admin Shows:**
- Customers visible in customer list
- Email addresses match
- Customer count increases when adding via Flutter

---

## 🔧 Debug Commands

### **In Flutter Console:**

```dart
// Test QloApps connection
await QloAppsApiService().testConnection();
// Should output: ✅ QloApps API connection successful

// Verify loaded data
await guestProvider.debugPrintQloAppsData();
// Should show: List of guests from database

// Force reload guests
await guestProvider.loadGuests();
// Should output: ✅ Loaded X guests from QloApps
```

---

## 📝 Quick Reference

### **Key Files:**
- **Guest Provider:** `lib/providers/guest_provider.dart`
- **API Service:** `lib/services/qloapps_api_service.dart`
- **Auth Provider:** `lib/providers/auth_provider.dart`

### **Key Configuration:**
- **API URL:** `http://10.0.1.24/1.IDM/api`
- **API Key:** `2WUGS9C92CRCSJ1IJME9ST1DFCFDD3C4`
- **Database:** `qloapps_db`
- **Main Table:** `qlo_customer`

### **API Resources Used:**
- `/api/customers` - Guest management
- `/api/employees` - Authentication
- `/api/orders` - Bookings (future)
- `/api/addresses` - Guest addresses (future)

---

## 🎉 You're All Set!

The app is now fully integrated with QloApps database. Every operation goes directly to the `qloapps_db` MySQL database, ensuring both systems always have the same data.

**No Node.js backend needed!**  
**No local storage conflicts!**  
**One database, real-time sync!**

---

**Last Updated:** October 28, 2025  
**Status:** ✅ Production Ready
