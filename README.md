# 🏨 Hotel Management System

A comprehensive hotel management solution with Flutter mobile app and Node.js backend.

## 📁 Project Structure

```
1.IDM/
├── 📱 hotel-staff-flutter/     # Flutter mobile app
├── 🚀 hotel-backend/           # Node.js escort API server
├── 📚 docs/                   # All documentation & setup guides
├── 🔧 src/                    # Organized PHP source code
├── 🎨 assets/                 # Static files (CSS, JS, Images)
└── 🗂️ [QloApps core folders]   # Hotel booking system
```

## 🚀 Quick Start

1. **Setup Backend**: See `docs/setup-guides/INSTALLATION_GUIDE.md`
2. **Configure Network**: Edit `hotel-staff-flutter/lib/utils/network_config.dart`
3. **Run Flutter App**: `cd hotel-staff-flutter && flutter run`

## 📖 Documentation

All setup guides are in `docs/setup-guides/`:
- 📖 **Complete Installation** → `INSTALLATION_GUIDE.md`
- ⚡ **Quick Setup** → `QUICK_SETUP.md`
- 🔧 **How It Works** → `HOW_IT_WORKS.md`
- 📡 **Network Setup** → `WIFI_SETUP_GUIDE.md`
- 🧰 **Network Config** → `NETWORK_CONFIG_README.md`

## 🎯 Key Features

- ✅ **Flutter Mobile App** - Staff interface for hotel operations
- ✅ **Node.js Backend** - Escort management API
- ✅ **QloApps Integration** - Complete hotel booking system
- ✅ **Centralized Config** - Single point network configuration
- ✅ **Clean Architecture** - Organized, maintainable codebase

## 🔧 API Endpoints

| Service | Endpoint | Purpose |
|---------|----------|---------|
| Customers | `/src/api/customers-api.php` | Get customer list |
| Add Customer | `/src/api/add-customer-api.php` | Create new customer |
| Escorts | `hotel-backend:3000/api` | Escort management |
| File Upload | `/src/api/upload-*-api.php` | File uploads |

---
*Clean, organized, and ready for development! 🎉*