# 🚀 Quick Start Guide

Get your Hotel Staff Backend API up and running in 5 minutes!

## ✅ Prerequisites Checklist

Before you begin, make sure you have:

- [ ] **WAMP/MySQL running** (green icon in system tray)
- [ ] **Node.js installed** (v14 or higher)
- [ ] **npm installed** (comes with Node.js)

## 🎯 Quick Setup (3 Steps)

### Step 1: Install Node.js (if not installed)

Download and install from: https://nodejs.org/
- Choose LTS version
- Default settings are fine
- Restart PowerShell after installation

### Step 2: Run Setup Script

Open PowerShell in the `hotel-backend` folder:

```powershell
cd c:\wamp64\www\1.IDM\hotel-backend
.\setup.ps1
```

This will:
- ✅ Install all dependencies
- ✅ Create database and tables
- ✅ Add default admin user
- ✅ Add sample rooms

### Step 3: Start Server

```powershell
npm start
```

You should see:
```
✅ Server running on port 3000
✅ MySQL database connected successfully
```

## 🧪 Test It Works

Open a new PowerShell window and run:

```powershell
.\test-api.ps1
```

Or visit in browser: http://localhost:3000

## 🔐 Default Login Credentials

- **Username:** `admin`
- **Password:** `admin123`

⚠️ **Important:** Change this password in production!

## 📱 Connect to Flutter App

1. Open `lib/services/api_service.dart` (create if doesn't exist)
2. Set `baseUrl` based on your device:
   - **Emulator:** `http://10.0.2.2:3000/api`
   - **Real Device:** `http://YOUR_IP:3000/api`
3. Follow the [Flutter Integration Guide](FLUTTER_INTEGRATION.md)

## 🛠️ Common Commands

```powershell
# Start server
npm start

# Start with auto-reload (development)
npm run dev

# Reset database
npm run init-db

# Test API
.\test-api.ps1
```

## 🆘 Troubleshooting

### "Cannot connect to MySQL"
→ Make sure WAMP is running (green icon)

### "Port 3000 already in use"
→ Change `PORT=3001` in `.env` file

### "Module not found"
→ Run `npm install` again

### "ECONNREFUSED"
→ Check MySQL is running on port 3306

## 📚 Full Documentation

- [README.md](README.md) - Complete API documentation
- [FLUTTER_INTEGRATION.md](FLUTTER_INTEGRATION.md) - Flutter integration guide

## 🎉 You're Ready!

Your backend API is now running and ready to use with your Flutter app!

**API URL:** http://localhost:3000
**Health Check:** http://localhost:3000/api/health

---

**Need help?** Check the README.md or API documentation.
