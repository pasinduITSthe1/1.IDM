# Hotel App Architecture - Database Connection

## System Architecture

```
┌─────────────────────────────────────────────────────────────┐
│                    FLUTTER MOBILE APP                        │
│                                                              │
│  ┌────────────────┐         ┌──────────────────┐           │
│  │                │         │                   │           │
│  │  Login Screen  │────────▶│  Auth Provider    │           │
│  │                │         │  - JWT Token      │           │
│  └────────────────┘         │  - User Info      │           │
│                             └──────────┬─────────┘           │
│                                        │                     │
│  ┌────────────────┐         ┌─────────▼─────────┐           │
│  │   Guest List   │────────▶│  Guest Provider   │           │
│  │   Dashboard    │         │  - Add Guest      │           │
│  │   Check-in/out │         │  - Update Guest   │           │
│  └────────────────┘         │  - Check-in/out   │           │
│                             └──────────┬─────────┘           │
│                                        │                     │
│                             ┌──────────▼─────────┐           │
│                             │                    │           │
│                             │  API Services      │           │
│                             │  - api_service.dart│           │
│                             │  - guest_service   │           │
│                             │  - auth_service    │           │
│                             └──────────┬─────────┘           │
│                                        │                     │
│                             ┌──────────▼─────────┐           │
│                             │ Local Storage      │           │
│                             │ (SharedPreferences)│           │
│                             │ Backup & Offline   │           │
│                             └────────────────────┘           │
└─────────────────────────────────┬───────────────────────────┘
                                  │
                                  │ HTTP/JSON
                                  │ REST API
                                  │
┌─────────────────────────────────▼───────────────────────────┐
│                    NODE.JS BACKEND API                       │
│                    http://localhost:3000                     │
│                                                              │
│  ┌────────────────────────────────────────────────────┐    │
│  │            API ENDPOINTS                            │    │
│  │                                                     │    │
│  │  POST   /api/auth/login      - Login              │    │
│  │  POST   /api/auth/register   - Register           │    │
│  │  GET    /api/guests          - List guests        │    │
│  │  POST   /api/guests          - Create guest       │    │
│  │  PUT    /api/guests/:id      - Update guest       │    │
│  │  DELETE /api/guests/:id      - Delete guest       │    │
│  │  PUT    /api/guests/:id/checkin  - Check-in       │    │
│  │  PUT    /api/guests/:id/checkout - Check-out      │    │
│  │  GET    /api/rooms           - List rooms         │    │
│  └────────────────────────────────────────────────────┘    │
│                                                              │
│  ┌────────────────────────────────────────────────────┐    │
│  │            MIDDLEWARE                               │    │
│  │  - JWT Authentication                               │    │
│  │  - Request Validation                               │    │
│  │  - Error Handling                                   │    │
│  └────────────────────────────────────────────────────┘    │
└─────────────────────────────────┬───────────────────────────┘
                                  │
                                  │ MySQL Driver
                                  │ mysql2 npm package
                                  │
┌─────────────────────────────────▼───────────────────────────┐
│                    MYSQL DATABASE                            │
│                    hotel_staff_db                            │
│                                                              │
│  ┌────────────────┐  ┌────────────────┐  ┌──────────────┐  │
│  │  staff         │  │  guests        │  │  rooms       │  │
│  │                │  │                │  │              │  │
│  │  - id          │  │  - id          │  │  - id        │  │
│  │  - username    │  │  - first_name  │  │  - room_no   │  │
│  │  - password    │  │  - last_name   │  │  - type      │  │
│  │  - name        │  │  - document    │  │  - price     │  │
│  │  - role        │  │  - nationality │  │  - status    │  │
│  │  - created_at  │  │  - email       │  │              │  │
│  │                │  │  - phone       │  │              │  │
│  │                │  │  - status      │  │              │  │
│  │                │  │  - room_number │  │              │  │
│  │                │  │  - check_in    │  │              │  │
│  │                │  │  - check_out   │  │              │  │
│  │                │  │  - created_at  │  │              │  │
│  └────────────────┘  └────────────────┘  └──────────────┘  │
└──────────────────────────────────────────────────────────────┘
```

## Data Flow

### Adding a Guest

```
1. User fills form ─┐
                    │
2. Submit button ───┤
                    │
3. Guest Provider ──┼──▶ guest_service.createGuest()
                    │
4. API Service ─────┼──▶ POST /api/guests
                    │
5. Backend API ─────┼──▶ INSERT INTO guests
                    │
6. MySQL saves ─────┤
                    │
7. Returns guest ◀──┤
                    │
8. Updates UI ──────┘
```

### Loading Guests

```
1. App starts ─────┐
                   │
2. loadGuests() ───┼──▶ guest_service.fetchGuests()
                   │
3. API Service ────┼──▶ GET /api/guests
                   │
4. Backend API ────┼──▶ SELECT * FROM guests
                   │
5. MySQL returns ──┤
                   │
6. Parse JSON ◀────┤
                   │
7. Update state ───┤
                   │
8. Show in UI ─────┘
```

## Network Configuration

### Android Emulator
```
Flutter App (Emulator)
   │
   │ 10.0.2.2:3000
   │ (Maps to host machine's localhost)
   ▼
Backend (Host Machine)
   │
   │ localhost:3306
   ▼
MySQL (Host Machine)
```

### Physical Device
```
Flutter App (Phone)
   │
   │ 192.168.1.100:3000
   │ (Your computer's IP on WiFi)
   ▼
Backend (Computer)
   │
   │ localhost:3306
   ▼
MySQL (Computer)
```

## Authentication Flow

```
┌────────┐        ┌─────────┐        ┌──────────┐
│        │        │         │        │          │
│  User  │───────▶│  Login  │───────▶│   Auth   │
│        │ input  │  Screen │ submit │ Provider │
└────────┘        └─────────┘        └────┬─────┘
                                          │
                                          │ login()
                                          ▼
                                   ┌──────────────┐
                                   │ Auth Service │
                                   └──────┬───────┘
                                          │
                                          │ POST /api/auth/login
                                          ▼
                                   ┌──────────────┐
                                   │ Backend API  │
                                   └──────┬───────┘
                                          │
                                          │ SELECT * FROM staff
                                          ▼
                                   ┌──────────────┐
                                   │   MySQL DB   │
                                   └──────┬───────┘
                                          │
                                          │ Return user + token
                                          ▼
                                   ┌──────────────┐
                                   │  Save Token  │
                                   │  Set as      │
                                   │  Authenticated│
                                   └──────┬───────┘
                                          │
                                          │ Navigate
                                          ▼
                                   ┌──────────────┐
                                   │  Dashboard   │
                                   └──────────────┘
```

## Error Handling & Fallback

```
┌──────────────┐
│ Try API Call │
└──────┬───────┘
       │
       ├─────▶ Success ──┐
       │                 │
       │                 ▼
       │           ┌──────────────┐
       │           │ Update State │
       │           │ Save to Local│
       │           └──────────────┘
       │
       └─────▶ Fail ──┐
                      │
                      ▼
               ┌──────────────┐
               │  Show Error  │
               │  Use Local   │
               │  Storage     │
               └──────────────┘
```

## Key Components

### Frontend (Flutter)
- **Providers**: State management
- **Services**: API communication
- **Models**: Data structures
- **Screens**: UI components

### Backend (Node.js)
- **Routes**: API endpoints
- **Controllers**: Business logic
- **Middleware**: Authentication
- **Database**: MySQL connection

### Database (MySQL)
- **Tables**: Data storage
- **Indexes**: Fast queries
- **Relationships**: Data integrity

---

**Version:** 1.0
**Date:** October 14, 2025
**Status:** ✅ Fully Integrated
