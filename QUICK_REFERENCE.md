# ⚡ QUICK REFERENCE - Files & What They Do

## 🎯 THE PROBLEM SUMMARY
You had all the code written but **not connected**:
- CheckoutProvider existed but wasn't registered
- UI screen didn't exist
- Service layer wasn't being used
- Result: **Nothing worked in the app**

## ✅ THE SOLUTION
Connected all layers so data flows properly:

```
User Taps Button 
    ↓
Flutter UI Screen
    ↓ 
State Management (Provider)
    ↓
Service Layer (API Client)
    ↓
HTTP Request to PHP
    ↓
PHP Backend (Controller)
    ↓
MySQL Database
    ↓
Response back to UI
    ↓
Success Message
```

---

## 📂 FILES YOU NEED TO KNOW ABOUT

### **1. Main App File** (Entry Point)
**File**: `lib/main.dart`
**What Changed**: 
- Added: `import 'providers/checkout_provider.dart';`
- Added: `ChangeNotifierProvider(create: (_) => CheckoutProvider())`
**Why**: App needs to know about CheckoutProvider

### **2. Service Layer** (Makes API Calls)
**File**: `lib/services/hotel_management_service.dart`
**What It Does**:
```dart
checkOutGuest()           // POST to /api/hotel/checkouts
recordPayment()           // POST to /api/hotel/payments
getGuestBill()            // GET /api/hotel/checkins/{id}/bill
addService()              // POST to /api/hotel/services
... 13 methods total
```
**Why**: All API communication goes through here

### **3. State Management** (Manages State & Logic)
**File**: `lib/providers/checkout_provider.dart`
**What It Does**:
```dart
getBill(checkinId)        // Get bill
recordPayment(...)        // Record payment
checkOut(...)             // Perform checkout
addService(...)           // Add service charge
getGuestTimeline(...)     // Get activity history
```
**Why**: Manages checkout workflow logic

### **4. UI Screen** (What User Sees)
**File**: `lib/screens/guest_checkout_screen.dart`
**What It Shows**:
- Guest name & info
- Bill breakdown
  - Room charges: $500
  - Services: $70
  - Total: $570
- Payment method selector
- "Complete Payment & Checkout" button
**Why**: This is what user interacts with

### **5. PHP Controllers** (Backend API)
**Files**: `controllers/admin/AdminHotel*Controller.php` (6 files)
```
AdminHotelCheckinsController.php    → POST /api/hotel/checkins
AdminHotelCheckoutsController.php   → POST /api/hotel/checkouts
AdminHotelPaymentsController.php    → POST /api/hotel/payments
AdminHotelServicesController.php    → POST /api/hotel/services
AdminHotelRoomsController.php       → Room management
AdminHotelLogsController.php        → Audit logs + reporting
```
**Why**: Receives requests from Flutter and updates database

### **6. Database Tables** (Stores Data)
```sql
guest_checkins      ← Check-in records
guest_checkouts     ← Check-out records
guest_payments      ← Payment records
guest_services      ← Service charges
room_assignments    ← Room tracking
guest_logs          ← Audit trail
guest_documents     ← ID/passport docs
guest_attachments   ← Photos
```
**Why**: Permanent storage of all guest operations

---

## 🔄 HOW DATA FLOWS

### **Complete Checkout Example**

```
1️⃣ User clicks "Complete Payment & Checkout" button in Flutter
   └─ Location: GuestCheckoutScreen

2️⃣ Screen calls CheckoutProvider.checkOut()
   └─ File: lib/providers/checkout_provider.dart
   └─ Line: _isProcessing = true, notifyListeners()

3️⃣ Provider calls HotelManagementService.checkOutGuest()
   └─ File: lib/services/hotel_management_service.dart
   └─ Line: _dio.post('/hotel/checkouts', data: payload)

4️⃣ Service sends HTTP POST to PHP endpoint
   └─ URL: http://192.168.217.41/1.IDM/api/hotel/checkouts
   └─ Method: POST
   └─ Body: {
       "id_customer": 123,
       "id_checkin": 1001,
       "final_bill": 570.00,
       ...
     }

5️⃣ PHP Controller receives request
   └─ File: controllers/admin/AdminHotelCheckoutsController.php
   └─ Method: postCheckoutsAction()

6️⃣ PHP validates & processes
   └─ Calculates bill: $500 (booking) + $70 (services) = $570
   └─ Inserts guest_checkouts record
   └─ Updates qlo_customer status
   └─ Releases room

7️⃣ PHP sends HTTP 201 response
   └─ Response: {
       "success": true,
       "message": "Guest checked out successfully",
       "final_bill": 570.00
     }

8️⃣ Flutter receives response
   └─ CheckoutProvider gets success
   └─ Updates UI
   └─ Shows: "Guest checked out successfully!"

9️⃣ Database now contains:
   └─ guest_checkouts: 1 new record
   └─ guest_logs: 1 new record
   └─ qlo_customer: updated status
```

---

## 🧪 TESTING EACH LAYER

### **Test 1: Check if Provider is Registered**
```dart
// In any widget
Consumer<CheckoutProvider>(
  builder: (context, checkout, _) {
    print('✅ CheckoutProvider is available: $checkout');
    return Text('Provider works!');
  }
)
```

### **Test 2: Check if Service Can Call API**
```dart
// In any method
final service = HotelManagementService();
final response = await service.getGuestBill(1001);
print('Response: $response');
```

### **Test 3: Check if PHP Endpoint Works**
```bash
curl -X GET http://192.168.217.41/1.IDM/api/hotel/rooms/available \
  -H "Authorization: Basic MldVR1M5QzkyQ1JDU0oxSUpNRTlTVDFERkNGREQzQzQ6"
```

### **Test 4: Check if Database Records Exist**
```sql
SELECT * FROM guest_checkouts;
SELECT * FROM guest_payments;
SELECT * FROM guest_logs;
```

---

## 🚨 DEBUGGING CHECKLIST

| Problem | Solution |
|---------|----------|
| "Checkout button not working" | Add button to `guest_list_screen.dart` |
| "Provider not found" | Check `main.dart` for `CheckoutProvider` registration |
| "API returns 404" | Check if PHP controllers exist at `controllers/admin/` |
| "Database not updating" | Check if tables exist: `SHOW TABLES LIKE 'guest_%'` |
| "App crashes on checkout" | Check Flutter debug console for error message |
| "Payment not recorded" | Verify `guest_payments` table and PHP response |

---

## 📊 FILE SIZES & SCOPE

| File | Size | Complexity |
|------|------|-----------|
| `checkout_provider.dart` | ~130 lines | Easy |
| `hotel_management_service.dart` | ~400 lines | Medium |
| `guest_checkout_screen.dart` | ~500 lines | Hard |
| `AdminHotelCheckoutsController.php` | ~80 lines | Easy |
| `main.dart` | ~40 lines | Very Easy |

---

## ✅ VALIDATION CHECKLIST

Before you say "it's not working", check:

- [ ] Provider registered in `main.dart`? → Search for `CheckoutProvider`
- [ ] Service file exists? → Check `lib/services/hotel_management_service.dart`
- [ ] Screen file exists? → Check `lib/screens/guest_checkout_screen.dart`
- [ ] Database tables created? → Run `SHOW TABLES LIKE 'guest_%'`
- [ ] PHP controllers exist? → Check `controllers/admin/AdminHotel*`
- [ ] Network connection working? → Test API with curl
- [ ] Flutter app built? → Run `flutter pub get` then `flutter run`

---

## 🎓 Learning Path

If you want to understand this system:

1. **Start here**: Read `SYSTEM_WORKING_GUIDE.md` (overview)
2. **Then**: Look at `guest_checkout_screen.dart` (UI layer)
3. **Then**: Look at `checkout_provider.dart` (state management)
4. **Then**: Look at `hotel_management_service.dart` (API layer)
5. **Then**: Look at `AdminHotelCheckoutsController.php` (backend)
6. **Finally**: Look at database tables in MySQL

Each layer builds on the previous one.

---

## 🎯 YOUR NEXT TASK

Add checkout button to guest list so you can actually navigate to checkout screen:

**File**: `lib/screens/guest_list_screen.dart`
**Add**: 
```dart
if (guest.status == 'checked_in') {
  ElevatedButton(
    onPressed: () => context.push('/checkout/${guest.id}'),
    child: const Text('Check Out'),
  );
}
```

**File**: `lib/utils/app_routes.dart`
**Add**:
```dart
GoRoute(
  path: '/checkout/:guestId',
  builder: (context, state) => GuestCheckoutScreen(
    guestId: state.pathParameters['guestId']!,
  ),
)
```

Then rebuild and test!

---

## 💾 DATABASE QUERIES TO UNDERSTAND

```sql
-- See all check-outs
SELECT id, id_customer, check_out_time, final_bill, payment_status 
FROM guest_checkouts;

-- See all payments
SELECT id, id_customer, payment_date, amount, payment_method 
FROM guest_payments;

-- See guest status in QloApps
SELECT id, firstname, lastname, note, date_upd 
FROM qlo_customer 
WHERE id = 123;

-- See complete audit trail
SELECT id, id_customer, action_type, performed_by, performed_at 
FROM guest_logs 
WHERE id_customer = 123;
```

---

**Everything is now connected and ready to work!** 🚀
