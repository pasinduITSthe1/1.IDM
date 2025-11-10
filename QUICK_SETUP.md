# 📋 Quick Setup Checklist - New Device Installation

## ⚡ TL;DR - What You Need to Configure

### On Backend Computer
1. **Database credentials** → `hotel-backend/.env`
2. **Find your IP** → `ipconfig` (Windows) or `ifconfig` (Mac/Linux)

### On Flutter App
1. **Update IP** → `lib/utils/network_config.dart`
   ```dart
   static const String computerIp = 'YOUR_IP_HERE';
   ```

**That's ALL!** Everything else is automatic! ✨

---

## 🚀 5-Minute Setup

### Backend Setup (Computer)
```bash
# 1. Start WAMP/Apache + MySQL
[Click WAMP icon → Start All Services]

# 2. Install Node.js dependencies
cd C:\wamp64\www\1.IDM\hotel-backend
npm install

# 3. Start Node.js server
npm start

# 4. Find your IP
ipconfig
# Note: WiFi adapter → IPv4 Address (e.g., 192.168.1.100)
```

### Frontend Setup (Flutter App)
```dart
// 1. Edit: lib/utils/network_config.dart
static const String computerIp = '192.168.1.100'; // 👈 Your IP from Step 4
static const bool useWiFi = true;

// 2. Run app
flutter run
```

---

## ✅ What Gets Configured Automatically

When you set `computerIp = '192.168.1.100'`, these are automatically created:

| Service | URL | Auto-Generated |
|---------|-----|----------------|
| Customer API | `http://192.168.1.100/1.IDM/customers-api.php` | ✅ Yes |
| Add Customer | `http://192.168.1.100/1.IDM/add-customer-api.php` | ✅ Yes |
| Escorts API | `http://192.168.1.100:3000/api` | ✅ Yes |
| Hotel Backend | `http://192.168.1.100/1.IDM/hotel-backend/api` | ✅ Yes |
| QloApps API | `http://192.168.1.100/1.IDM/api` | ✅ Yes |

---

## 🔄 Switching Between Computers

### Home Computer (192.168.0.50)
```dart
static const String computerIp = '192.168.0.50';
```

### Office Computer (10.0.5.100)
```dart
static const String computerIp = '10.0.5.100';
```

### Laptop (172.20.10.5)
```dart
static const String computerIp = '172.20.10.5';
```

**Hot reload** and it works! No restart needed.

---

## 🔍 How to Find Your IP

### Windows
```bash
ipconfig
```
Look for: **Wireless LAN adapter Wi-Fi** → **IPv4 Address**

### Mac
```bash
ifconfig | grep "inet "
```
Look for: **en0** interface

### Linux
```bash
ip addr show
```
Look for: **wlan0** interface

---

## 🧪 Quick Test

### Test Backend
```bash
# From computer browser
http://localhost/1.IDM/customers-api.php        ✅ Should work
http://localhost:3000/api/health                ✅ Should work

# From phone browser (use your computer's IP)
http://192.168.1.100/1.IDM/customers-api.php    ✅ Should work
http://192.168.1.100:3000/api/health            ✅ Should work
```

### Test Flutter App
1. Open app
2. Try to load guest list
3. Try to register a new guest

If all work → ✅ **Setup complete!**

---

## 📂 Files You Need to Edit

### For Backend Configuration
```
hotel-backend/.env
├── DB_HOST=localhost          # Usually don't change
├── DB_USER=root               # Usually don't change
├── DB_PASSWORD=               # Set if you have MySQL password
└── DB_NAME=1.idm_db          # Usually don't change
```

### For Network Configuration
```
hotel-staff-flutter/lib/utils/network_config.dart
├── computerIp = 'YOUR_IP'     # ⚠️ CHANGE THIS
└── useWiFi = true             # true for WiFi, false for USB
```

---

## ⚠️ Common Mistakes

### ❌ WRONG: Editing multiple files
```dart
// Don't edit these files!
escort_service.dart           ❌ No need to edit
direct_customer_service.dart  ❌ No need to edit
qloapps_api_service.dart     ❌ No need to edit
```

### ✅ RIGHT: Edit only network_config.dart
```dart
// Edit only this file!
network_config.dart           ✅ Edit this only
```

---

## 🛠️ Troubleshooting

| Problem | Solution |
|---------|----------|
| Can't connect | Verify same WiFi network |
| IP changed | Update `computerIp` in network_config.dart |
| Port already in use | Check if another service is using port 80 or 3000 |
| Firewall blocks | Allow ports 80 and 3000 in Windows Firewall |
| Database error | Check `.env` credentials |

---

## 📞 Need More Help?

- 📖 Full guide: `INSTALLATION_GUIDE.md`
- 🔧 How it works: `HOW_IT_WORKS.md`
- 📡 Network setup: `WIFI_SETUP_GUIDE.md`
- 🧰 Network config: `lib/utils/NETWORK_CONFIG_README.md`

---

## 💡 Pro Tips

1. **Bookmark your IP**: Save it somewhere so you don't have to look it up every time
2. **Use WiFi name**: If moving between networks, note which IP goes with which WiFi
3. **USB fallback**: If WiFi fails, set `useWiFi = false` and use USB tethering
4. **Hot reload**: After changing IP, press `r` in Flutter terminal (no need to restart)
5. **Keep server running**: Leave Node.js terminal window open while using the app

---

## 🎯 Summary

**You configure 2 things:**
1. Backend database credentials (rarely changes)
2. Computer IP address (changes if network changes)

**System configures automatically:**
- All API endpoints ✅
- All service URLs ✅
- All backend connections ✅

**Result:** Works on any computer, any network! 🎉
