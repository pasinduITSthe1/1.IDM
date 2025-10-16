# Hotel Staff Management Backend API

A RESTful API built with Node.js, Express, and MySQL for managing hotel staff, guests, and rooms.

## 🚀 Features

- **Authentication**: JWT-based authentication for staff
- **Guest Management**: CRUD operations for guest records
- **Room Management**: CRUD operations for hotel rooms
- **Check-in/Check-out**: Guest check-in and check-out functionality
- **Secure**: Password hashing with bcrypt
- **CORS Enabled**: Ready for Flutter mobile app integration

## 📋 Prerequisites

Before you begin, ensure you have installed:
- **Node.js** (v14 or higher) - [Download here](https://nodejs.org/)
- **MySQL** (v5.7 or higher) - Already installed via WAMP
- **npm** (comes with Node.js)

## 🛠️ Installation

### Step 1: Install Node.js Dependencies

Open PowerShell in the `hotel-backend` folder and run:

```bash
npm install
```

### Step 2: Configure Environment Variables

Edit the `.env` file and update your MySQL credentials:

```env
DB_HOST=localhost
DB_PORT=3306
DB_USER=root
DB_PASSWORD=your_mysql_password
DB_NAME=hotel_staff_db
```

### Step 3: Make Sure MySQL is Running

1. Open WAMP
2. Make sure all services are green (running)
3. MySQL should be accessible on port 3306

### Step 4: Initialize Database

Run the database initialization script:

```bash
npm run init-db
```

This will:
- Create the database `hotel_staff_db`
- Create tables: `staff`, `guests`, `rooms`
- Create default admin user (username: `admin`, password: `admin123`)
- Add sample rooms

## 🏃 Running the Server

### Development Mode (with auto-restart):
```bash
npm run dev
```

### Production Mode:
```bash
npm start
```

The server will start on `http://localhost:3000`

## 📡 API Endpoints

### Authentication

#### Login
```http
POST /api/auth/login
Content-Type: application/json

{
  "username": "admin",
  "password": "admin123"
}
```

**Response:**
```json
{
  "success": true,
  "message": "Login successful",
  "data": {
    "token": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
    "staff": {
      "id": "uuid",
      "username": "admin",
      "name": "Administrator",
      "role": "admin"
    }
  }
}
```

#### Register New Staff
```http
POST /api/auth/register
Content-Type: application/json

{
  "username": "john_doe",
  "password": "password123",
  "name": "John Doe",
  "role": "staff"
}
```

#### Get Current User
```http
GET /api/auth/me
Authorization: Bearer YOUR_JWT_TOKEN
```

---

### Guests

**All guest endpoints require authentication. Include the JWT token in the Authorization header:**
```
Authorization: Bearer YOUR_JWT_TOKEN
```

#### Get All Guests
```http
GET /api/guests
```

#### Get Single Guest
```http
GET /api/guests/:id
```

#### Create Guest
```http
POST /api/guests
Content-Type: application/json

{
  "firstName": "John",
  "lastName": "Smith",
  "documentNumber": "AB123456",
  "documentType": "passport",
  "issuedCountry": "USA",
  "issuedDate": "2020-01-15",
  "expiryDate": "2030-01-15",
  "dateOfBirth": "1990-05-20",
  "sex": "M",
  "nationality": "American",
  "email": "john@example.com",
  "phone": "+1234567890",
  "address": "123 Main St, New York",
  "visitPurpose": "Tourism",
  "status": "pending"
}
```

#### Update Guest
```http
PUT /api/guests/:id
Content-Type: application/json

{
  "firstName": "John",
  "lastName": "Smith",
  // ... other fields
}
```

#### Delete Guest
```http
DELETE /api/guests/:id
```

#### Check-in Guest
```http
POST /api/guests/:id/checkin
Content-Type: application/json

{
  "roomNumber": "101"
}
```

#### Check-out Guest
```http
POST /api/guests/:id/checkout
```

#### Get Guests by Status
```http
GET /api/guests/status/:status
```
Status values: `pending`, `checked_in`, `checked_out`

---

### Rooms

**All room endpoints require authentication.**

#### Get All Rooms
```http
GET /api/rooms
```

#### Get Available Rooms
```http
GET /api/rooms/available
```

#### Get Single Room
```http
GET /api/rooms/:id
```

#### Create Room
```http
POST /api/rooms
Content-Type: application/json

{
  "roomNumber": "103",
  "roomType": "Single",
  "price": 55.00,
  "status": "available"
}
```

#### Update Room
```http
PUT /api/rooms/:id
Content-Type: application/json

{
  "roomNumber": "103",
  "roomType": "Deluxe Single",
  "price": 65.00,
  "status": "available"
}
```

#### Delete Room
```http
DELETE /api/rooms/:id
```

---

## 🧪 Testing the API

### Using PowerShell (curl):

```powershell
# Health check
curl http://localhost:3000/api/health

# Login
curl -X POST http://localhost:3000/api/auth/login `
  -H "Content-Type: application/json" `
  -d '{"username":"admin","password":"admin123"}'

# Get guests (with token)
curl http://localhost:3000/api/guests `
  -H "Authorization: Bearer YOUR_TOKEN_HERE"
```

### Using Postman:

1. Download [Postman](https://www.postman.com/downloads/)
2. Import the endpoints
3. Test each endpoint

### Using Browser:

Visit `http://localhost:3000` to see the API welcome message.

## 📁 Project Structure

```
hotel-backend/
├── config/
│   └── database.js          # MySQL connection configuration
├── controllers/
│   ├── authController.js    # Authentication logic
│   ├── guestController.js   # Guest management logic
│   └── roomController.js    # Room management logic
├── middleware/
│   └── auth.js              # JWT authentication middleware
├── routes/
│   ├── auth.js              # Auth routes
│   ├── guests.js            # Guest routes
│   └── rooms.js             # Room routes
├── scripts/
│   └── initDatabase.js      # Database initialization script
├── .env                     # Environment variables
├── .gitignore              # Git ignore file
├── package.json            # Node.js dependencies
├── server.js               # Main server file
└── README.md               # This file
```

## 🔐 Security Notes

- **Default Admin**: Username: `admin`, Password: `admin123`
- ⚠️ **IMPORTANT**: Change the default admin password immediately!
- Change `JWT_SECRET` in `.env` to a strong random string
- In production, use environment variables, not `.env` file

## 🔧 Troubleshooting

### MySQL Connection Error
```
Error: connect ECONNREFUSED 127.0.0.1:3306
```
**Solution**: Make sure WAMP/MySQL is running

### Port Already in Use
```
Error: listen EADDRINUSE: address already in use :::3000
```
**Solution**: Change `PORT` in `.env` to another port (e.g., 3001)

### JWT Token Invalid
```
Error: Invalid token
```
**Solution**: Login again to get a fresh token

## 📝 Database Schema

### Staff Table
- `id` (VARCHAR) - Primary key
- `username` (VARCHAR) - Unique username
- `password_hash` (VARCHAR) - Hashed password
- `name` (VARCHAR) - Full name
- `role` (VARCHAR) - User role
- `created_at` (TIMESTAMP) - Creation timestamp

### Guests Table
- `id` (VARCHAR) - Primary key
- `first_name`, `last_name` - Guest name
- `document_number`, `document_type` - ID document
- `issued_country`, `issued_date`, `expiry_date` - Document details
- `date_of_birth`, `sex`, `nationality` - Personal info
- `email`, `phone`, `address` - Contact info
- `visit_purpose` - Purpose of visit
- `status` - pending/checked_in/checked_out
- `room_number` - Assigned room
- `check_in_date`, `check_out_date` - Check-in/out times
- `created_at`, `updated_at` - Timestamps

### Rooms Table
- `id` (VARCHAR) - Primary key
- `room_number` (VARCHAR) - Unique room number
- `room_type` (VARCHAR) - Room type
- `price` (DECIMAL) - Room price
- `status` (VARCHAR) - available/occupied/maintenance
- `created_at` (TIMESTAMP) - Creation timestamp

## 🎯 Next Steps

Now that your backend is ready:
1. Test all endpoints using Postman or curl
2. Integrate with your Flutter app
3. Update Flutter providers to use HTTP requests
4. Deploy to a server (optional)

## 📞 Support

If you encounter any issues:
1. Check that MySQL is running in WAMP
2. Verify `.env` configuration
3. Check server logs for error messages
4. Ensure all npm packages are installed

---

**Built with ❤️ using Node.js, Express, and MySQL**
