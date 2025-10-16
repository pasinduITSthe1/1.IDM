# ✅ SEPARATE CHECK-IN/CHECK-OUT TABLES IMPLEMENTATION

## 🎉 Database Migration Complete!

The hotel management system now uses **separate tables** for check-ins and check-outs instead of just updating the guest status. This provides better history tracking and reporting capabilities.

## 📊 New Database Structure

### Table: `check_ins`
Records all guest check-ins with room assignments.

**Columns:**
- `id` (VARCHAR 36) - Primary key (UUID)
- `guest_id` (VARCHAR 36) - Foreign key to guests table
- `room_number` (VARCHAR 20) - Room assigned to guest
- `check_in_date` (DATETIME) - When guest checked in
- `expected_checkout_date` (DATE) - Expected checkout date
- `checked_out` (BOOLEAN) - Whether this check-in has been completed
- `notes` (TEXT) - Additional notes
- `created_at` (TIMESTAMP) - Record creation time
- `updated_at` (TIMESTAMP) - Record update time

### Table: `check_outs`
Records all guest check-outs with billing information.

**Columns:**
- `id` (VARCHAR 36) - Primary key (UUID)
- `check_in_id` (VARCHAR 36) - Foreign key to check_ins table
- `guest_id` (VARCHAR 36) - Foreign key to guests table  
- `room_number` (VARCHAR 20) - Room number
- `check_out_date` (DATETIME) - When guest checked out
- `total_amount` (DECIMAL 10,2) - Total bill amount
- `payment_status` (ENUM) - pending, paid, refunded
- `payment_method` (VARCHAR 50) - How payment was made
- `notes` (TEXT) - Additional notes
- `created_at` (TIMESTAMP) - Record creation time
- `updated_at` (TIMESTAMP) - Record update time

### Table: `guests` (Updated)
The guests table still exists but now focuses on guest information:
- `status` field now shows: pending, checked-in, checked-out, cancelled
- Historical check-in/check-out data is in separate tables

## 🔧 API Endpoints

### Guest Management (Existing)
- `GET /api/guests` - Get all guests
- `GET /api/guests/:id` - Get single guest
- `POST /api/guests` - Create new guest
- `PUT /api/guests/:id` - Update guest
- `DELETE /api/guests/:id` - Delete guest
- `GET /api/guests/status/:status` - Get guests by status

### Check-In Operations (Updated)
- `PUT /api/guests/:id/checkin` - Check in a guest

**Request Body:**
```json
{
  "roomNumber": "101",
  "expectedCheckoutDate": "2025-10-20",
  "notes": "Guest requested early breakfast"
}
```

**Response:**
```json
{
  "success": true,
  "message": "Guest checked in successfully",
  "data": {
    "id": "check-in-uuid",
    "guest_id": "guest-uuid",
    "room_number": "101",
    "check_in_date": "2025-10-15T10:30:00",
    "expected_checkout_date": "2025-10-20",
    "checked_out": false,
    "first_name": "John",
    "last_name": "Doe",
    "email": "john@example.com",
    "phone": "+1234567890"
  }
}
```

### Check-Out Operations (Updated)
- `PUT /api/guests/:id/checkout` - Check out a guest

**Request Body:**
```json
{
  "totalAmount": 500.00,
  "paymentStatus": "paid",
  "paymentMethod": "credit_card",
  "notes": "Guest was satisfied with stay"
}
```

**Response:**
```json
{
  "success": true,
  "message": "Guest checked out successfully",
  "data": {
    "id": "checkout-uuid",
    "check_in_id": "checkin-uuid",
    "guest_id": "guest-uuid",
    "room_number": "101",
    "check_in_date": "2025-10-15T10:30:00",
    "check_out_date": "2025-10-20T11:00:00",
    "days_stayed": 5,
    "total_amount": 500.00,
    "payment_status": "paid",
    "payment_method": "credit_card",
    "first_name": "John",
    "last_name": "Doe"
  }
}
```

### New History Endpoints
- `GET /api/guests/checkins/all` - Get all check-ins (active + completed)
- `GET /api/guests/checkins/active` - Get only active check-ins
- `GET /api/guests/checkouts/all` - Get all check-outs
- `GET /api/guests/:id/history` - Get complete history for a specific guest

## 🔄 How It Works

### 1. Guest Registration
```
POST /api/guests
→ Creates guest record with status="pending"
→ Guest ID: abc-123
```

### 2. Check-In Process
```
PUT /api/guests/abc-123/checkin
→ Creates record in check_ins table
→ Updates guest status to "checked-in"
→ Assigns room number
→ Records check-in date/time
```

### 3. Check-Out Process
```
PUT /api/guests/abc-123/checkout
→ Creates record in check_outs table
→ Marks check-in record as checked_out=TRUE
→ Updates guest status to "checked-out"
→ Clears room number
→ Records billing information
```

## 📈 Benefits

### Better History Tracking
- ✅ Complete history of all check-ins and check-outs
- ✅ Track multiple stays for the same guest
- ✅ Calculate total days stayed per visit
- ✅ Keep billing records for each stay

### Improved Reporting
- ✅ Get currently checked-in guests
- ✅ View completed stays with billing
- ✅ Track payment status
- ✅ Analyze occupancy patterns

### Data Integrity
- ✅ Foreign key constraints prevent orphaned records
- ✅ Can't check out without checking in
- ✅ Can't check in if already checked in
- ✅ Guest record preserved even after checkout

## 🧪 Testing the New System

### 1. Register a Guest
```bash
curl -X POST http://10.0.1.24:3000/api/guests \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Content-Type: application/json" \
  -d '{
    "firstName": "John",
    "lastName": "Doe",
    "status": "pending"
  }'
```

### 2. Check In the Guest
```bash
curl -X PUT http://10.0.1.24:3000/api/guests/GUEST_ID/checkin \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Content-Type: application/json" \
  -d '{
    "roomNumber": "101",
    "expectedCheckoutDate": "2025-10-20",
    "notes": "VIP guest"
  }'
```

### 3. Check Out the Guest
```bash
curl -X PUT http://10.0.1.24:3000/api/guests/GUEST_ID/checkout \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Content-Type: application/json" \
  -d '{
    "totalAmount": 500.00,
    "paymentStatus": "paid",
    "paymentMethod": "credit_card"
  }'
```

### 4. View Guest History
```bash
curl http://10.0.1.24:3000/api/guests/GUEST_ID/history \
  -H "Authorization: Bearer YOUR_TOKEN"
```

### 5. View Active Check-Ins
```bash
curl http://10.0.1.24:3000/api/guests/checkins/active \
  -H "Authorization: Bearer YOUR_TOKEN"
```

## 📱 Flutter App Updates Needed

The Flutter app needs to be updated to work with the new structure:

### 1. Check-In Model
Create `lib/models/check_in.dart`:
```dart
class CheckIn {
  final String id;
  final String guestId;
  final String roomNumber;
  final DateTime checkInDate;
  final DateTime? expectedCheckoutDate;
  final bool checkedOut;
  final String? notes;
  
  // ... constructor and fromJson method
}
```

### 2. Check-Out Model
Create `lib/models/check_out.dart`:
```dart
class CheckOut {
  final String id;
  final String checkInId;
  final String guestId;
  final String roomNumber;
  final DateTime checkOutDate;
  final double? totalAmount;
  final String paymentStatus;
  final String? paymentMethod;
  final String? notes;
  
  // ... constructor and fromJson method
}
```

### 3. Update Guest Service
Update `lib/services/guest_service.dart` to include:
- `checkInGuest(guestId, roomNumber, expectedCheckoutDate, notes)`
- `checkOutGuest(guestId, totalAmount, paymentStatus, paymentMethod, notes)`
- `getActiveCheckIns()`
- `getAllCheckOuts()`
- `getGuestHistory(guestId)`

### 4. Update UI
- Check-in screen should collect room number, expected checkout date, notes
- Check-out screen should collect billing info (amount, payment method, status)
- Add history view to show all past stays for a guest

## 🔍 Database Queries for Verification

### Check Tables Exist
```sql
SHOW TABLES LIKE 'check_%';
```

### View All Check-Ins
```sql
SELECT ci.*, g.first_name, g.last_name 
FROM check_ins ci 
JOIN guests g ON ci.guest_id = g.id;
```

### View Active Check-Ins
```sql
SELECT * FROM check_ins WHERE checked_out = FALSE;
```

### View All Check-Outs with Details
```sql
SELECT 
  co.*,
  g.first_name,
  g.last_name,
  ci.check_in_date,
  DATEDIFF(co.check_out_date, ci.check_in_date) AS days_stayed
FROM check_outs co
JOIN check_ins ci ON co.check_in_id = ci.id
JOIN guests g ON co.guest_id = g.id;
```

## ✅ Migration Status

- ✅ check_ins table created
- ✅ check_outs table created
- ✅ Foreign key constraints added
- ✅ Indexes created for performance
- ✅ Guest controller updated with new check-in logic
- ✅ Guest controller updated with new check-out logic
- ✅ New API endpoints added for history tracking
- ✅ Backend server restarted with new code

## 🎯 Next Steps

1. **Test the Backend API** - Use curl or Postman to test check-in/checkout
2. **Update Flutter Models** - Create CheckIn and CheckOut models
3. **Update Flutter Services** - Add methods for new endpoints
4. **Update Flutter UI** - Add billing info collection on checkout
5. **Test End-to-End** - Register → Check-in → Check-out → View History

---

**The database structure is now production-ready with proper history tracking!**
