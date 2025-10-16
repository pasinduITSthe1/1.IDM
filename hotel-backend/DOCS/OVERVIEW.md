# 🏨 Hotel Staff Management Backend API
## Complete Node.js + Express + MySQL Backend

---

## 📦 What's Included

Your complete backend includes:

### ✅ Core Features
- **Authentication System** - JWT-based login/logout
- **Guest Management** - Full CRUD operations
- **Room Management** - Room tracking and availability
- **Check-in/Check-out** - Guest status management
- **Security** - Password hashing, protected routes
- **CORS** - Enabled for Flutter integration

### 📁 Project Structure
```
hotel-backend/
├── config/
│   └── database.js           # MySQL configuration
├── controllers/
│   ├── authController.js     # Login/register logic
│   ├── guestController.js    # Guest operations
│   └── roomController.js     # Room operations
├── middleware/
│   └── auth.js               # JWT authentication
├── routes/
│   ├── auth.js               # Auth endpoints
│   ├── guests.js             # Guest endpoints
│   └── rooms.js              # Room endpoints
├── scripts/
│   └── initDatabase.js       # Database setup
├── .env                      # Configuration
├── server.js                 # Main server
├── package.json              # Dependencies
├── setup.ps1                 # Setup script
├── test-api.ps1              # API tests
├── README.md                 # Full documentation
├── QUICKSTART.md             # Quick start guide
└── FLUTTER_INTEGRATION.md    # Flutter guide
```

---

## 🚀 Getting Started

### Option 1: Quick Setup (Recommended)
```powershell
cd hotel-backend
.\setup.ps1
npm start
```

### Option 2: Manual Setup
```powershell
# Install dependencies
npm install

# Configure .env file (update MySQL password if needed)

# Initialize database
npm run init-db

# Start server
npm start
```

---

## 🔌 API Endpoints

### Authentication
```http
POST   /api/auth/login      # Login
POST   /api/auth/register   # Create staff
GET    /api/auth/me         # Get current user
```

### Guests (Protected)
```http
GET    /api/guests              # Get all guests
GET    /api/guests/:id          # Get single guest
POST   /api/guests              # Create guest
PUT    /api/guests/:id          # Update guest
DELETE /api/guests/:id          # Delete guest
POST   /api/guests/:id/checkin  # Check-in
POST   /api/guests/:id/checkout # Check-out
GET    /api/guests/status/:status # Get by status
```

### Rooms (Protected)
```http
GET    /api/rooms              # Get all rooms
GET    /api/rooms/available    # Get available rooms
GET    /api/rooms/:id          # Get single room
POST   /api/rooms              # Create room
PUT    /api/rooms/:id          # Update room
DELETE /api/rooms/:id          # Delete room
```

---

## 🗄️ Database Schema

### Tables Created
1. **staff** - Staff accounts
2. **guests** - Guest records with all new fields
3. **rooms** - Room inventory

### Default Data
- Admin user: `admin` / `admin123`
- 6 sample rooms (101, 102, 201, 202, 301, 302)

---

## 🔐 Security

✅ **JWT Authentication** - Token-based auth
✅ **Password Hashing** - bcrypt encryption
✅ **Protected Routes** - Middleware verification
✅ **CORS Enabled** - Cross-origin support

---

## 🧪 Testing

### Using PowerShell
```powershell
.\test-api.ps1
```

### Using Browser
```
http://localhost:3000
http://localhost:3000/api/health
```

### Using Postman
Import endpoints from README.md

---

## 📱 Flutter Integration

### Quick Integration Steps:

1. **Add http package** to `pubspec.yaml`:
   ```yaml
   dependencies:
     http: ^1.1.0
   ```

2. **Create API Service** - Use code from `FLUTTER_INTEGRATION.md`

3. **Update Providers** - Replace SharedPreferences with API calls

4. **Configure URL**:
   - Emulator: `http://10.0.2.2:3000/api`
   - Real Device: `http://YOUR_IP:3000/api`

5. **Test** - Login with admin/admin123

**Full guide:** See [FLUTTER_INTEGRATION.md](FLUTTER_INTEGRATION.md)

---

## 📊 Response Format

All API responses follow this structure:

```json
{
  "success": true,
  "message": "Operation successful",
  "data": { ... },
  "count": 10
}
```

Error responses:
```json
{
  "success": false,
  "message": "Error description"
}
```

---

## 🛠️ Development Commands

```powershell
npm start          # Start server
npm run dev        # Start with auto-reload
npm run init-db    # Reset database
```

---

## 📝 Configuration (.env)

```env
PORT=3000
DB_HOST=localhost
DB_PORT=3306
DB_USER=root
DB_PASSWORD=         # Your MySQL password
DB_NAME=hotel_staff_db
JWT_SECRET=change-this-secret
JWT_EXPIRES_IN=24h
```

---

## 🐛 Common Issues

### MySQL Connection Error
**Problem:** Cannot connect to database
**Solution:** Make sure WAMP is running

### Port Already in Use
**Problem:** Port 3000 is busy
**Solution:** Change PORT in .env

### Token Invalid
**Problem:** Authentication failed
**Solution:** Login again to get fresh token

### Module Not Found
**Problem:** Dependencies missing
**Solution:** Run `npm install`

---

## 📚 Documentation Files

1. **QUICKSTART.md** - Get started in 5 minutes
2. **README.md** - Complete API documentation
3. **FLUTTER_INTEGRATION.md** - Flutter integration guide
4. **This file** - Overview and summary

---

## 🎯 Next Steps

### Backend Deployment (Optional)
- Deploy to Heroku/Railway/Render
- Set up production MySQL database
- Configure environment variables
- Update Flutter app URL

### Enhancements (Optional)
- Add email notifications
- Implement booking system
- Add payment integration
- Create admin dashboard

---

## 🔄 Workflow

1. **Start Backend**
   ```powershell
   cd hotel-backend
   npm start
   ```

2. **Start Flutter App**
   ```powershell
   cd hotel-staff-flutter
   flutter run
   ```

3. **Login** with `admin` / `admin123`

4. **Test** all features

---

## 📞 Support

If you encounter issues:

1. Check WAMP/MySQL is running
2. Verify .env configuration
3. Check server console logs
4. Test with `test-api.ps1`
5. Review documentation

---

## ✨ Features Implemented

### Authentication
✅ Login with JWT tokens
✅ Password hashing with bcrypt
✅ Token-based authorization
✅ Staff registration

### Guest Management
✅ Create guests with all fields
✅ Document Type
✅ Issued Country
✅ Issued Date
✅ Expiry Date
✅ Visit Purpose
✅ Update guest information
✅ Delete guests
✅ Search and filter

### Operations
✅ Check-in with room assignment
✅ Check-out processing
✅ Status tracking
✅ Room availability

### Security
✅ Protected routes
✅ JWT middleware
✅ CORS enabled
✅ Input validation

---

## 🎉 Congratulations!

You now have a complete, production-ready backend API for your hotel staff management system!

**API is running at:** http://localhost:3000

**Test it:** http://localhost:3000/api/health

**Integrate with Flutter:** See FLUTTER_INTEGRATION.md

---

**Built with ❤️ using Node.js, Express, and MySQL**

**Version:** 1.0.0
**Last Updated:** October 2025
