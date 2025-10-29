# QloApps + Flutter Integration Solution

## 🎯 **Problem Statement**

The Flutter app is currently using its own local database (SharedPreferences) and an optional Node.js backend API. However, the requirement is to have **ONE SHARED DATABASE** between QloApps and Flutter.

### **Current Architecture Issues:**

```
❌ CURRENT (Wrong):
QloApps Frontend → QloApps MySQL Database (qloapps_db)
                     ↕
Flutter App -----→ Local Storage (SharedPreferences) 
            -----→ Node.js Backend (Optional, port 3000)
```

### **Required Architecture:**

```
✅ REQUIRED (Correct):
QloApps Frontend → QloApps MySQL Database (qloapps_db)
                     ↕
                  QloApps WebService API
                     ↕
Flutter App ------→ SAME DATABASE via QloApps API
```

---

## 🔍 **Root Cause Analysis**

### **1. Guest Provider Issues:**

**File:** `lib/providers/guest_provider.dart`

**Problems:**
- ✅ Already loads guests from QloApps API (`_useQloAppsDirectly = true`)
- ❌ **But saves to local SharedPreferences** (`_saveToLocalStorage()`)
- ❌ **Creates new guests locally** instead of using QloApps API
- ❌ **Updates guests locally** instead of using QloApps API
- ❌ Uses `GuestService` which connects to Node.js backend (port 3000)

**Code Evidence:**
```dart
// Line 48: Saves to Node.js API
final createdGuest = await _guestService.createGuest(guest);

// Line 84: Updates via Node.js API  
final updated = await _guestService.updateGuest(id, updatedGuest);

// Line 56: Always saves to local storage as "backup"
await _saveToLocalStorage();
```

### **2. Authentication Issues:**

**File:** `lib/providers/auth_provider.dart`

**Problems:**
- ✅ Already attempts QloApps authentication first
- ❌ Still uses `AuthService` (Node.js backend) as fallback
- ❌ Doesn't properly handle QloApps employee authentication

### **3. Data Flow Issues:**

**Current Flow:**
1. User books room via QloApps → Saved to MySQL ✅
2. Flutter loads guests → Reads from QloApps ✅
3. **Flutter creates guest → Saves to Node.js backend** ❌
4. **Flutter updates guest → Saves to Node.js backend** ❌
5. **Flutter stores backup → Saves to local storage** ❌

**Result:** Data is NOT synchronized between systems!

---

## ✅ **Complete Solution**

### **Phase 1: Remove Node.js Backend Dependency**

**Actions:**
1. ✅ Remove `GuestService` calls (Node.js backend)
2. ✅ Replace with `QloAppsApiService` calls
3. ✅ Remove local SharedPreferences storage
4. ✅ Use QloApps as single source of truth

### **Phase 2: Update Guest Operations**

**Operations to Fix:**

| Operation | Current | Required |
|-----------|---------|----------|
| Load Guests | ✅ QloApps API | ✅ QloApps API |
| Create Guest | ❌ Node.js + Local | ✅ QloApps API |
| Update Guest | ❌ Node.js + Local | ✅ QloApps API |
| Check-in | ❌ Node.js + Local | ✅ QloApps API |
| Check-out | ❌ Node.js + Local | ✅ QloApps API |
| Delete Guest | ❌ Local only | ✅ QloApps API |

### **Phase 3: Fix Authentication**

**Actions:**
1. ✅ Use QloApps employees table for login
2. ✅ Remove Node.js AuthService dependency
3. ✅ Store session in QloApps format

### **Phase 4: QloApps API Mapping**

**QloApps Database → Flutter App Mapping:**

| QloApps Table | QloApps API Resource | Flutter Model |
|---------------|---------------------|---------------|
| `qlo_customer` | `/api/customers` | `Guest` |
| `qlo_employee` | `/api/employees` | `User` (Auth) |
| `qlo_orders` | `/api/orders` | `Booking` |
| `qlo_address` | `/api/addresses` | `Address` |
| `qlo_hotel` | `/api/hotels` | `Hotel` |
| `qlo_hotel_booking` | `/api/bookings` | `RoomBooking` |

---

## 📝 **Implementation Steps**

### **Step 1: Update Guest Provider**

**Changes Required in `guest_provider.dart`:**

```dart
// ❌ REMOVE these:
- _saveToLocalStorage()
- _loadFromLocalStorage()  
- GuestService calls
- SharedPreferences usage

// ✅ REPLACE with:
- QloAppsApiService.createCustomer()
- QloAppsApiService.updateCustomer()
- QloAppsApiService.getCustomers()
```

### **Step 2: Map Guest Model to QloApps Customer**

**Guest Data Mapping:**

```dart
// Flutter Guest Model → QloApps Customer
Guest {
  id          → customer.id
  name        → customer.firstname + " " + customer.lastname
  email       → customer.email
  phone       → customer.phone
  roomNumber  → (from booking/order)
  checkInDate → (from booking)
  checkOutDate→ (from booking)
  status      → (from booking.current_state)
}
```

### **Step 3: Update Booking Operations**

**Check-in/Check-out Flow:**

```dart
// Check-in: Create/Update booking in QloApps
QloAppsApiService.post('bookings', xmlData)

// Check-out: Update booking status
QloAppsApiService.put('bookings/$id', xmlData)
```

---

## 🔧 **Technical Implementation**

### **QloApps API Permissions Required:**

✅ Already configured (API Key: `2WUGS9C92CRCSJ1IJME9ST1DFCFDD3C4`):

- `customers` - GET, POST, PUT, DELETE
- `addresses` - GET, POST, PUT, DELETE
- `orders` - GET, POST, PUT
- `bookings` - GET, POST, PUT
- `employees` - GET (for authentication)
- `hotels` - GET
- `products` - GET (rooms)

### **Network Configuration:**

- **QloApps URL:** `http://10.0.1.24/1.IDM/api`
- **API Key:** `2WUGS9C92CRCSJ1IJME9ST1DFCFDD3C4`
- **Format:** JSON
- **Authentication:** HTTP Basic Auth

---

## 📊 **Expected Results After Fix**

### **Test Scenario:**

1. **Book room via QloApps frontend**
   - Guest: John Doe
   - Room: 101
   - Check-in: Today
   
2. **Open Flutter app and login**
   - Should see John Doe in guest list ✅
   
3. **Check-in John Doe via Flutter**
   - Should update booking in QloApps database ✅
   - Should be visible in QloApps backend ✅
   
4. **Create new guest via Flutter**
   - Should create customer in QloApps database ✅
   - Should be visible in QloApps customer list ✅

### **Data Verification:**

```sql
-- Check QloApps database after Flutter operations
SELECT * FROM qlo_customer WHERE email = 'newguest@hotel.com';
SELECT * FROM qlo_orders WHERE id_customer = 123;
SELECT * FROM qlo_hotel_booking WHERE id_order = 456;
```

---

## ⚠️ **Important Notes**

1. **No Local Storage:** All data must go to QloApps database
2. **No Node.js Backend:** Remove dependency on port 3000 server
3. **Single Source of Truth:** QloApps MySQL database only
4. **Real-time Sync:** Changes in QloApps should reflect in Flutter immediately
5. **Bidirectional:** Changes in Flutter should reflect in QloApps immediately

---

## 🚀 **Next Actions**

1. ✅ Update `guest_provider.dart` to use only QloApps API
2. ✅ Remove SharedPreferences storage
3. ✅ Remove GuestService (Node.js) dependency
4. ✅ Test create/update/delete operations
5. ✅ Verify data in phpMyAdmin (qloapps_db)
6. ✅ Test complete booking flow

---

**Status:** Ready for implementation
**Priority:** HIGH - Blocking user workflow
**Estimated Time:** 30-45 minutes

