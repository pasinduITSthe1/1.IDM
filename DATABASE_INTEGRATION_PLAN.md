# Hotel Management System - Database Integration Plan

## Overview
Unified database integrating **QloApps Booking System** + **Flutter Staff App** for complete hotel operations management.

## Architecture

```
┌─────────────────────────────────────────────────────────────────┐
│                      MySQL Database: 1.IDM_db                   │
│                                                                  │
│  ┌──────────────────────┐         ┌──────────────────────┐     │
│  │  GUEST MANAGEMENT    │         │  ROOM MANAGEMENT     │     │
│  ├──────────────────────┤         ├──────────────────────┤     │
│  │ qlo_customer         │         │ qlo_htl_room_info    │     │
│  │ qlo_customer_*       │         │ qlo_htl_room_type    │     │
│  │ guest_attachments    │         │ qlo_htl_room_status  │     │
│  │ guest_document_*     │         │ qlo_htl_room_*       │     │
│  └──────────────────────┘         └──────────────────────┘     │
│           │                                 │                   │
│           │                                 │                   │
│  ┌──────────────────────┐         ┌──────────────────────┐     │
│  │  BOOKING MANAGEMENT  │         │  CHECK-IN/OUT        │     │
│  ├──────────────────────┤         ├──────────────────────┤     │
│  │ qlo_htl_booking_*    │         │ qlo_htl_access       │     │
│  │ qlo_orders           │         │ guest_checkins       │     │
│  │ qlo_order_detail     │         │ guest_checkouts      │     │
│  │ qlo_order_history    │         │ room_assignments     │     │
│  └──────────────────────┘         └──────────────────────┘     │
│           │                                 │                   │
│           └─────────────────┬───────────────┘                   │
│                             │                                   │
│                    ┌────────────────┐                           │
│                    │  TRANSACTIONS  │                           │
│                    ├────────────────┤                           │
│                    │ guest_payments │                           │
│                    │ guest_services │                           │
│                    │ guest_charges  │                           │
│                    │ guest_logs     │                           │
│                    └────────────────┘                           │
└─────────────────────────────────────────────────────────────────┘
         ▲                                          ▲
         │                                          │
    ┌────┴──────┐                            ┌──────┴────┐
    │  QloApps  │                            │  Flutter  │
    │  (Web UI) │◄─── API / Sync ────────►   │  Staff App│
    └───────────┘     Shared Database        └───────────┘
         Booking                              Check-in/Out
         Management                           Guest Mgmt
```

## Database Tables Structure

### 1. CORE GUEST DATA
**Primary:** `qlo_customer`
```
id_customer (PK)
firstname, lastname
email, phone
birthday, nationality
active, deleted
date_add, date_upd
```

### 2. GUEST DOCUMENTS & ATTACHMENTS (New Tables)
```sql
CREATE TABLE guest_documents (
  id INT PRIMARY KEY AUTO_INCREMENT,
  id_customer INT NOT NULL,
  document_type VARCHAR(50),  -- passport, id_card, visa
  document_number VARCHAR(100),
  expiry_date DATE,
  country_issued VARCHAR(100),
  attachment_path VARCHAR(255),
  created_at DATETIME,
  FOREIGN KEY (id_customer) REFERENCES qlo_customer(id_customer)
);

CREATE TABLE guest_attachments (
  id INT PRIMARY KEY AUTO_INCREMENT,
  id_customer INT NOT NULL,
  attachment_type VARCHAR(50),  -- photo, id_front, id_back
  file_path VARCHAR(255),
  upload_date DATETIME,
  FOREIGN KEY (id_customer) REFERENCES qlo_customer(id_customer)
);
```

### 3. CHECK-IN & CHECK-OUT MANAGEMENT (New Tables)
```sql
CREATE TABLE guest_checkins (
  id INT PRIMARY KEY AUTO_INCREMENT,
  id_customer INT NOT NULL,
  id_booking INT,
  id_room INT,
  room_number VARCHAR(10),
  check_in_time DATETIME,
  check_in_method VARCHAR(50),  -- scan, manual, app
  checked_in_by VARCHAR(100),  -- staff name
  notes TEXT,
  created_at DATETIME,
  FOREIGN KEY (id_customer) REFERENCES qlo_customer(id_customer)
);

CREATE TABLE guest_checkouts (
  id INT PRIMARY KEY AUTO_INCREMENT,
  id_customer INT NOT NULL,
  id_checkin INT,
  id_room INT,
  check_out_time DATETIME,
  check_out_method VARCHAR(50),
  checked_out_by VARCHAR(100),
  final_bill DECIMAL(20,6),
  payment_status VARCHAR(50),  -- pending, paid, partial
  notes TEXT,
  created_at DATETIME,
  FOREIGN KEY (id_customer) REFERENCES qlo_customer(id_customer),
  FOREIGN KEY (id_checkin) REFERENCES guest_checkins(id)
);
```

### 4. ROOM ASSIGNMENTS
```sql
CREATE TABLE room_assignments (
  id INT PRIMARY KEY AUTO_INCREMENT,
  id_customer INT NOT NULL,
  id_room INT,
  id_booking INT,
  assignment_date DATETIME,
  release_date DATETIME,
  status VARCHAR(50),  -- assigned, occupied, vacated, released
  FOREIGN KEY (id_customer) REFERENCES qlo_customer(id_customer)
);
```

### 5. GUEST TRANSACTIONS (Payments, Services, Charges)
```sql
CREATE TABLE guest_payments (
  id INT PRIMARY KEY AUTO_INCREMENT,
  id_customer INT NOT NULL,
  id_order INT,
  id_checkin INT,
  payment_date DATETIME,
  amount DECIMAL(20,6),
  payment_method VARCHAR(50),  -- card, cash, bank_transfer
  payment_status VARCHAR(50),  -- pending, completed, failed, refunded
  reference_number VARCHAR(100),
  notes TEXT,
  FOREIGN KEY (id_customer) REFERENCES qlo_customer(id_customer)
);

CREATE TABLE guest_services (
  id INT PRIMARY KEY AUTO_INCREMENT,
  id_customer INT NOT NULL,
  id_checkin INT,
  service_type VARCHAR(50),  -- room_service, laundry, spa, etc
  service_date DATETIME,
  charge DECIMAL(20,6),
  status VARCHAR(50),  -- pending, completed, cancelled
  notes TEXT,
  FOREIGN KEY (id_customer) REFERENCES qlo_customer(id_customer)
);
```

### 6. AUDIT LOG
```sql
CREATE TABLE guest_logs (
  id INT PRIMARY KEY AUTO_INCREMENT,
  id_customer INT NOT NULL,
  action_type VARCHAR(50),  -- checkin, checkout, payment, service, document
  action_description TEXT,
  performed_by VARCHAR(100),
  performed_at DATETIME,
  FOREIGN KEY (id_customer) REFERENCES qlo_customer(id_customer)
);
```

## Data Flow

### Scenario 1: Guest Books Online → Arrives → Check-in
```
1. Guest books room on QloApps website
   → Creates order in qlo_orders
   → Booking detail in qlo_htl_booking_detail
   → Order linked to qlo_customer

2. Guest arrives at hotel, staff uses Flutter app
   → Scan ID/Passport → Extract data
   → Register guest in qlo_customer (if new)
   → Verify booking in qlo_htl_booking_detail
   → Record check-in in guest_checkins
   → Assign room in room_assignments
   → Log action in guest_logs
   → Update qlo_order_history

3. During stay
   → Add services to guest_services
   → Record payments in guest_payments
   → Update room status in qlo_htl_room_status
   → Log all activities

4. Guest checks out
   → Generate final bill
   → Record check-out in guest_checkouts
   → Process final payment
   → Release room in room_assignments
   → Update booking status
   → Generate checkout receipt
   → Log checkout in guest_logs
```

### Scenario 2: Walk-in Guest → Check-in
```
1. Staff creates guest manually in Flutter app
   → Register in qlo_customer via QloApps API
   → Create temporary booking
   → Proceed with check-in
   → (same as above from step 2 onward)
```

## API Endpoints to Implement

### QloApps REST API (Already Available)
- `GET /api/customers` - List guests
- `GET /api/customers/{id}` - Get guest details
- `POST /api/customers` - Create guest
- `PUT /api/customers/{id}` - Update guest
- `GET /api/orders` - List bookings
- `GET /api/orders/{id}` - Get booking details

### New Flutter App API Endpoints
```
POST   /api/guests/checkin        - Record check-in
POST   /api/guests/checkout       - Record checkout
POST   /api/guests/documents      - Upload documents
POST   /api/guests/attachments    - Upload photos
POST   /api/guests/payments       - Record payment
POST   /api/guests/services       - Add service charge
GET    /api/guests/{id}/timeline  - Full guest activity log
GET    /api/rooms/available       - Get available rooms
PUT    /api/rooms/{id}/assign     - Assign room to guest
```

## Features to Implement

### 1. Guest Check-in System
- ✅ Scan ID/Passport (BlinkID)
- ✅ Capture photos (front, back)
- ✅ Verify with QloApps booking
- ✅ Assign room
- ✅ Record check-in timestamp
- ✅ Save to guest_checkins table

### 2. Guest Check-out System
- Generate final bill
- Calculate charges (room + services)
- Record payment
- Process refunds
- Release room
- Generate checkout document

### 3. Room Management
- View room status (available, occupied, maintenance)
- Assign rooms during check-in
- Release rooms during check-out
- Track room changes

### 4. Payment Management
- Record payments
- Support multiple payment methods
- Track payment status
- Process partial payments
- Handle refunds

### 5. Service Management
- Add service charges (room service, laundry, etc.)
- Track service requests
- Update charges

### 6. Audit Trail
- Log all actions
- Track who did what and when
- Generate reports

## Implementation Priority

### Phase 1 (CRITICAL - Done)
- ✅ Guest registration from QloApps
- ✅ Check-in status persistence
- ✅ Database structure planning

### Phase 2 (HIGH - Next)
- Create guest_checkins, guest_checkouts tables
- Implement check-out functionality
- Room assignment logic
- Payment recording

### Phase 3 (MEDIUM)
- Service charge management
- Audit logging
- Reports and analytics

### Phase 4 (LOW)
- Advanced features
- Integrations
- Optimization
