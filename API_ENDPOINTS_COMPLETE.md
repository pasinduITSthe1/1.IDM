# 🏨 Unified Hotel Management System - API Endpoints Documentation

## System Architecture

**Complete Integration**: QloApps (online bookings) + Flutter App (on-site operations) = Single `1.IDM_db` database

```
┌──────────────────────────────────────────────────────────────────┐
│                     UNIFIED HOTEL MANAGEMENT                      │
├──────────────────────────────────────────────────────────────────┤
│                                                                   │
│  QloApps (Web) ◄──────── MySQL Database (1.IDM_db) ────────► Flutter App  │
│  • Online Bookings      • qlo_customer                 • Check-in/out      │
│  • Reservations         • qlo_orders                   • Room Assignment   │
│  • Payment Processing   • qlo_htl_booking_detail       • Service Charges   │
│  • Reports              • guest_checkins (NEW)         • Payment Tracking  │
│                         • guest_checkouts (NEW)        • Audit Logs        │
│                         • guest_payments (NEW)                            │
│                         • guest_services (NEW)                            │
│                                                                   │
└──────────────────────────────────────────────────────────────────┘
```

---

## API Base URL
```
http://192.168.217.41/1.IDM/api
```

## Authentication
```
Authorization: Basic MldVR1M5QzkyQ1JDU0oxSUpNRTlTVDFERkNGREQzQzQ6
Content-Type: application/json
```

---

## 📥 CHECK-IN ENDPOINTS

### POST /api/hotel/checkins
Record guest check-in with room assignment

**Request**:
```json
{
  "id_customer": 123,
  "id_booking": 456,
  "id_room": 789,
  "room_number": "101",
  "check_in_time": "2024-01-15T14:30:00.000Z",
  "check_in_method": "app",
  "checked_in_by": "staff_name",
  "notes": "Early arrival, VIP guest"
}
```

**Response** (201 Created):
```json
{
  "success": true,
  "message": "Guest checked in successfully",
  "checkin_id": 1001,
  "room_number": "101"
}
```

**Database Updates**:
- ✅ Insert to `guest_checkins`
- ✅ Update `qlo_customer.note` field
- ✅ Update booking status to `checked_in`

---

### GET /api/hotel/checkins/{id}
Retrieve check-in details

**Response** (200 OK):
```json
{
  "id": 1001,
  "id_customer": 123,
  "id_booking": 456,
  "id_room": 789,
  "room_number": "101",
  "check_in_time": "2024-01-15T14:30:00.000Z",
  "check_in_method": "app",
  "checked_in_by": "staff_name",
  "notes": "Early arrival, VIP guest",
  "status": "checked_in",
  "created_at": "2024-01-15T14:30:00.000Z"
}
```

---

## 📤 CHECK-OUT ENDPOINTS

### POST /api/hotel/checkouts
Record guest check-out with final bill calculation

**Request**:
```json
{
  "id_customer": 123,
  "id_checkin": 1001,
  "id_room": 789,
  "check_out_time": "2024-01-20T11:00:00.000Z",
  "check_out_method": "app",
  "checked_out_by": "staff_name",
  "final_bill": 550.00,
  "payment_status": "paid",
  "notes": "Guest satisfied, will return"
}
```

**Response** (201 Created):
```json
{
  "success": true,
  "message": "Guest checked out successfully",
  "checkout_id": 2001,
  "final_bill": 550.00,
  "payment_status": "paid"
}
```

**Bill Calculation** (automatic if final_bill = 0):
```
Total Bill = Booking Charges + Service Charges - Paid Payments
```

**Database Updates**:
- ✅ Insert to `guest_checkouts`
- ✅ Update `qlo_customer.note` field
- ✅ Update `guest_checkins.status` to `checked_out`
- ✅ Release room from `room_assignments`
- ✅ Update room status to `available`

---

### GET /api/hotel/checkouts/{id}
Retrieve check-out details

**Response** (200 OK):
```json
{
  "id": 2001,
  "id_customer": 123,
  "id_checkin": 1001,
  "id_room": 789,
  "check_out_time": "2024-01-20T11:00:00.000Z",
  "checked_out_by": "staff_name",
  "final_bill": 550.00,
  "payment_status": "paid",
  "notes": "Guest satisfied",
  "status": "checked_out",
  "created_at": "2024-01-20T11:00:00.000Z"
}
```

---

## 🏠 ROOM MANAGEMENT ENDPOINTS

### GET /api/hotel/rooms/available
Get list of all available rooms

**Response** (200 OK):
```json
{
  "success": true,
  "rooms": [
    {
      "id_room": 789,
      "room_number": "101",
      "id_room_type": 5,
      "room_type_name": "Deluxe Double",
      "price": 100.00,
      "status": "available"
    },
    {
      "id_room": 790,
      "room_number": "102",
      "id_room_type": 5,
      "room_type_name": "Deluxe Double",
      "price": 100.00,
      "status": "available"
    }
  ],
  "total": 2
}
```

---

### POST /api/hotel/room-assignments
Assign room to guest

**Request**:
```json
{
  "id_customer": 123,
  "id_room": 789,
  "id_booking": 456,
  "assignment_date": "2024-01-15T14:30:00.000Z"
}
```

**Response** (201 Created):
```json
{
  "success": true,
  "message": "Room assigned successfully",
  "assignment_id": 3001,
  "room_number": "101"
}
```

**Database Updates**:
- ✅ Insert to `room_assignments`
- ✅ Update `qlo_htl_room.status` to `occupied`

---

### PUT /api/hotel/room-assignments/{id}
Release/unassign room from guest

**Request**:
```json
{
  "release_date": "2024-01-20T11:00:00.000Z"
}
```

**Response** (200 OK):
```json
{
  "success": true,
  "message": "Room released successfully",
  "assignment_id": 3001
}
```

**Database Updates**:
- ✅ Update `room_assignments.status` to `released`
- ✅ Update `qlo_htl_room.status` to `available`

---

### GET /api/hotel/rooms/{id}/status
Get room current status

**Response** (200 OK):
```json
{
  "room": {
    "id_room": 789,
    "room_number": "101",
    "status": "occupied"
  },
  "current_assignment": {
    "id": 3001,
    "id_customer": 123,
    "id_room": 789,
    "assignment_date": "2024-01-15T14:30:00.000Z",
    "status": "assigned"
  }
}
```

---

## 💳 PAYMENT ENDPOINTS

### POST /api/hotel/payments
Record guest payment

**Request**:
```json
{
  "id_customer": 123,
  "id_checkin": 1001,
  "payment_date": "2024-01-20T10:00:00.000Z",
  "amount": 550.00,
  "payment_method": "card",
  "payment_status": "completed",
  "reference_number": "CC-123456789",
  "notes": "Visa Card ending in 1234"
}
```

**Response** (201 Created):
```json
{
  "success": true,
  "message": "Payment recorded successfully",
  "payment_id": 4001,
  "amount": 550.00
}
```

**Supported Payment Methods**:
- `cash` - Cash payment
- `card` - Credit/Debit card
- `check` - Check payment
- `transfer` - Bank transfer
- `online` - Online payment

**Database Updates**:
- ✅ Insert to `guest_payments`

---

### GET /api/hotel/payments/{id}
Retrieve payment details

**Response** (200 OK):
```json
{
  "id": 4001,
  "id_customer": 123,
  "id_checkin": 1001,
  "payment_date": "2024-01-20T10:00:00.000Z",
  "amount": 550.00,
  "payment_method": "card",
  "payment_status": "completed",
  "reference_number": "CC-123456789",
  "notes": "Visa Card ending in 1234",
  "created_at": "2024-01-20T10:00:00.000Z"
}
```

---

### GET /api/hotel/customers/{id}/payments
Get all payments for a customer

**Response** (200 OK):
```json
{
  "payments": [
    {
      "id": 4001,
      "payment_date": "2024-01-20T10:00:00.000Z",
      "amount": 550.00,
      "payment_method": "card",
      "payment_status": "completed"
    }
  ],
  "total_paid": 550.00
}
```

---

## 🛎️ SERVICE CHARGE ENDPOINTS

### POST /api/hotel/services
Add service charge to guest bill

**Request**:
```json
{
  "id_customer": 123,
  "id_checkin": 1001,
  "service_type": "room_service",
  "service_date": "2024-01-18T19:30:00.000Z",
  "charge": 45.00,
  "status": "pending",
  "notes": "Dinner in room"
}
```

**Response** (201 Created):
```json
{
  "success": true,
  "message": "Service recorded successfully",
  "service_id": 5001,
  "service_type": "Room Service",
  "charge": 45.00
}
```

**Supported Service Types**:
- `room_service` - Room Service
- `laundry` - Laundry
- `spa` - Spa Services
- `gym` - Gym Facilities
- `parking` - Parking
- `breakfast` - Breakfast
- `dinner` - Dinner
- `transport` - Transport/Shuttle
- `tour` - Tour Package
- `other` - Other Services

**Database Updates**:
- ✅ Insert to `guest_services`

---

### GET /api/hotel/services/{id}
Retrieve service details

**Response** (200 OK):
```json
{
  "id": 5001,
  "id_customer": 123,
  "id_checkin": 1001,
  "service_type": "room_service",
  "service_date": "2024-01-18T19:30:00.000Z",
  "charge": 45.00,
  "status": "pending",
  "notes": "Dinner in room",
  "created_at": "2024-01-18T19:30:00.000Z"
}
```

---

### GET /api/hotel/customers/{id}/services
Get all services for a customer

**Response** (200 OK):
```json
{
  "services": [
    {
      "id": 5001,
      "service_type": "room_service",
      "service_date": "2024-01-18T19:30:00.000Z",
      "charge": 45.00
    },
    {
      "id": 5002,
      "service_type": "laundry",
      "service_date": "2024-01-19T10:00:00.000Z",
      "charge": 25.00
    }
  ],
  "total_charges": 70.00
}
```

---

### GET /api/hotel/service-types
Get available service types

**Response** (200 OK):
```json
{
  "service_types": {
    "room_service": "Room Service",
    "laundry": "Laundry",
    "spa": "Spa",
    "gym": "Gym",
    "parking": "Parking",
    "breakfast": "Breakfast",
    "dinner": "Dinner",
    "transport": "Transport",
    "tour": "Tour",
    "other": "Other"
  }
}
```

---

## 📝 AUDIT LOG ENDPOINTS

### POST /api/hotel/logs
Record audit log entry

**Request**:
```json
{
  "id_customer": 123,
  "action_type": "check_in",
  "action_description": "Guest checked in to room 101",
  "performed_by": "john_doe"
}
```

**Response** (200 OK):
```json
{
  "success": true,
  "log_id": 6001
}
```

**Action Types**:
- `check_in` - Guest check-in
- `check_out` - Guest check-out
- `payment` - Payment received
- `service_added` - Service charge added
- `room_assigned` - Room assignment
- `room_released` - Room release
- `guest_updated` - Guest information updated
- `note_added` - Note added
- `document_uploaded` - Document uploaded

**Database Updates**:
- ✅ Insert to `guest_logs` with IP address and user agent

---

## 📊 REPORTING ENDPOINTS

### GET /api/hotel/guests/{id}/timeline
Get complete guest activity timeline

**Response** (200 OK):
```json
{
  "success": true,
  "customer_id": 123,
  "timeline": [
    {
      "event_type": "checkout",
      "id": 2001,
      "event_time": "2024-01-20T11:00:00.000Z",
      "amount": 550.00,
      "performed_by": "staff_name"
    },
    {
      "event_type": "payment",
      "id": 4001,
      "event_time": "2024-01-20T10:00:00.000Z",
      "amount": 550.00,
      "performed_by": "payment_system"
    },
    {
      "event_type": "service",
      "id": 5002,
      "event_time": "2024-01-19T10:00:00.000Z",
      "room_number": "laundry",
      "amount": 25.00,
      "performed_by": "staff"
    },
    {
      "event_type": "checkin",
      "id": 1001,
      "event_time": "2024-01-15T14:30:00.000Z",
      "room_number": "101",
      "performed_by": "staff_name"
    }
  ],
  "total_events": 4
}
```

---

### GET /api/hotel/guests/{id}/status
Get current guest status

**Response** (200 OK):
```json
{
  "customer_id": 123,
  "customer_name": "John Smith",
  "status": "checked_in",
  "latest_checkin": {
    "id": 1001,
    "check_in_time": "2024-01-15T14:30:00.000Z",
    "room_number": "101",
    "status": "checked_in"
  },
  "latest_checkout": null,
  "current_room": {
    "id_room": 789,
    "room_number": "101",
    "status": "occupied"
  },
  "as_of": "2024-01-15T14:35:00.000Z"
}
```

**Possible Status Values**:
- `not_checked_in` - Guest never checked in
- `checked_in` - Guest currently checked in
- `checked_out` - Guest has checked out

---

### GET /api/hotel/checkins/{id}/bill
Get bill for check-in

**Response** (200 OK):
```json
{
  "checkin_id": 1001,
  "customer_id": 123,
  "booking_charges": 500.00,
  "services": [
    {
      "id": 5001,
      "service_type": "room_service",
      "service_date": "2024-01-18T19:30:00.000Z",
      "charge": 45.00
    },
    {
      "id": 5002,
      "service_type": "laundry",
      "service_date": "2024-01-19T10:00:00.000Z",
      "charge": 25.00
    }
  ],
  "services_total": 70.00,
  "total_charges": 570.00,
  "payments": [
    {
      "id": 4001,
      "payment_date": "2024-01-20T10:00:00.000Z",
      "amount": 550.00,
      "payment_method": "card"
    }
  ],
  "total_paid": 550.00,
  "balance_due": 20.00,
  "generated_at": "2024-01-20T11:00:00.000Z"
}
```

---

## 📋 DOCUMENTS & ATTACHMENTS

### POST /api/hotel/documents
Record guest document (ID, passport, etc.)

**Request**:
```json
{
  "id_customer": 123,
  "document_type": "passport",
  "document_number": "AB123456",
  "country_issued": "USA",
  "expiry_date": "2030-12-31"
}
```

**Response** (201 Created):
```json
{
  "success": true,
  "message": "Document recorded successfully",
  "document_id": 7001
}
```

---

### POST /api/hotel/attachments
Upload guest attachment (photo)

**Request**:
```json
{
  "id_customer": 123,
  "attachment_type": "guest_photo",
  "file_path": "/uploads/guests/123/photo.jpg"
}
```

**Response** (201 Created):
```json
{
  "success": true,
  "message": "Attachment recorded successfully",
  "attachment_id": 8001
}
```

---

## 🔄 Data Flow Examples

### Example 1: Complete Guest Journey

```
1. Online Booking (QloApps)
   POST /api/customers
   → Creates qlo_customer, qlo_orders, qlo_htl_booking_detail

2. Guest Arrives (Flutter App)
   POST /api/hotel/checkins
   → Creates guest_checkins, assigns room_assignments
   → Updates qlo_customer.note

3. Guest Uses Services (Flutter App)
   POST /api/hotel/services (x3)
   → Room service: $45
   → Laundry: $25
   → Spa: $60
   → Total services: $130

4. Guest Checks Out (Flutter App)
   GET /api/hotel/checkins/1001/bill
   → Booking: $500 + Services: $130 = $630

5. Guest Pays (Flutter App)
   POST /api/hotel/payments
   → Amount: $630, Method: card
   
6. Finalize Check-out (Flutter App)
   POST /api/hotel/checkouts
   → final_bill: $630, payment_status: paid
   → guest_checkouts created
   → Room released to available
```

### Example 2: Status Tracking Across Systems

```
QloApps Database                Flutter App
────────────────────           ──────────────
qlo_customer (John Doe)         Guest Provider
├─ id: 123                      ├─ ID: 123
├─ email: john@example.com      ├─ Name: John Doe
├─ note: "Checked in on         ├─ Status: checked_in
│   2024-01-15T14:30:00 -       ├─ Room: 101
│   Room: 101"                  └─ CheckInDate: 2024-01-15
└─ date_upd: 2024-01-15

↓ (Status persists via regex parsing)

guest_checkins table
├─ id: 1001
├─ id_customer: 123
├─ room_number: 101
├─ check_in_time: 2024-01-15T14:30:00
└─ status: checked_in
```

---

## ⚠️ Error Responses

### 400 Bad Request
```json
{
  "error": "Missing required fields: id_customer, id_booking, id_room"
}
```

### 404 Not Found
```json
{
  "error": "Check-in not found"
}
```

### 500 Server Error
```json
{
  "error": "Failed to insert check-in record"
}
```

---

## 📌 Implementation Notes

1. **All timestamps** must be ISO 8601 format: `YYYY-MM-DDTHH:MM:SS.sssZ`

2. **Single Database**: All operations save to `1.IDM_db` visible in both QloApps and Flutter

3. **Status Persistence**: Check-in/out status parsed from `qlo_customer.note` field via regex:
   - Pattern: `"Checked in on {timestamp} - Room: {roomNumber}"`
   - Extracted on guest list reload

4. **Bill Calculation**: Automatic when `final_bill = 0`
   - Formula: `Booking Charges + Service Charges - Paid Payments`

5. **Room Management**: Rooms transition between states:
   - `available` → (assignment) → `occupied` → (release) → `available`

6. **Audit Trail**: All operations logged to `guest_logs` with IP and user agent

---

## 🚀 Next Steps

1. ✅ Create API endpoints (DONE)
2. ✅ Create Flutter service layer (DONE)
3. ✅ Create state management providers (DONE)
4. ⏳ Create UI screens for check-out workflow
5. ⏳ Create UI screens for payment processing
6. ⏳ Create UI screens for service charges
7. ⏳ Create reporting/timeline screens
8. ⏳ Test end-to-end guest lifecycle
9. ⏳ Deploy to production
