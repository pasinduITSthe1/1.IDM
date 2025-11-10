# 🚀 Installation Guide - Setting Up on a New Device

This guide explains how to install and configure the Hotel Management System on a new computer or device.

---

## 📋 Prerequisites

Before starting, ensure you have:

### On Your Computer (Backend Server)
- ✅ Windows/Mac/Linux
- ✅ WAMP/XAMPP/MAMP (for Apache + MySQL + PHP)
- ✅ Node.js (v14 or higher)
- ✅ MySQL Database
- ✅ WiFi connection

### On Your Phone/Tablet (Flutter App)
- ✅ Android device (or iOS)
- ✅ Flutter app installed
- ✅ Same WiFi network as computer

---

## 🖥️ Part 1: Backend Setup (Computer)

### Step 1: Install WAMP/XAMPP
1. Download WAMP: https://www.wampserver.com/
2. Install to default location (e.g., `C:\wamp64\`)
3. Start all services (Apache + MySQL)

### Step 2: Set Up Database
1. Open phpMyAdmin: `http://localhost/phpmyadmin`
2. Create database: `1.idm_db`
3. Import SQL files (if provided)
4. Note your MySQL credentials:
   - **Host:** `localhost`
   - **User:** `root`
   - **Password:** (empty for WAMP default)
   - **Database:** `1.idm_db`

### Step 3: Install Project Files
1. Copy project folder to WAMP directory:
   ```
   C:\wamp64\www\1.IDM\
   ```

2. Your structure should look like:
   ```
   C:\wamp64\www\1.IDM\
   ├── hotel-backend/          (Node.js backend)
   ├── hotel-staff-flutter/    (Flutter app)
   ├── customers-api.php       (Customer API)
   ├── add-customer-api.php    (Add customer API)
   └── ... other PHP files
   ```

### Step 4: Set Up Node.js Backend
1. Open terminal/command prompt
2. Navigate to backend folder:
   ```bash
   cd C:\wamp64\www\1.IDM\hotel-backend
   ```

3. Install dependencies:
   ```bash
   npm install
   ```

4. Configure database (`.env` file):
   ```env
   # hotel-backend/.env
   PORT=3000
   DB_HOST=localhost
   DB_PORT=3306
   DB_USER=root
   DB_PASSWORD=
   DB_NAME=1.idm_db
   ```

5. Start the server:
   ```bash
   npm start
   ```
   
   You should see:
   ```
   ✅ Server running on port 3000
   ✅ MySQL database connected successfully
   ```

### Step 5: Configure Firewall
**Windows:**
```powershell
# Allow Apache (Port 80)
netsh advfirewall firewall add rule name="Apache WAMP - Port 80" dir=in action=allow protocol=TCP localport=80

# Allow Node.js (Port 3000)
netsh advfirewall firewall add rule name="Node.js Backend - Port 3000" dir=in action=allow protocol=TCP localport=3000
```

**Mac/Linux:**
Usually no configuration needed. If using UFW:
```bash
sudo ufw allow 80
sudo ufw allow 3000
```

### Step 6: Find Your Computer's IP Address

**Windows:**
```bash
ipconfig
```
Look for "WiFi" adapter → "IPv4 Address" (e.g., `192.168.1.100`)

**Mac:**
```bash
ifconfig | grep "inet "
```
Look for your WiFi interface (usually `en0`)

**Linux:**
```bash
ip addr show
```
Look for your WiFi interface (usually `wlan0`)

**Example Output:**
```
Wireless LAN adapter Wi-Fi:
   IPv4 Address. . . . . . . . . . . : 192.168.1.100  👈 THIS IS YOUR IP
   Subnet Mask . . . . . . . . . . . : 255.255.255.0
```

---

## 📱 Part 2: Flutter App Setup (Phone/Tablet)

### Step 1: Install Flutter App
If you have the source code:
```bash
cd C:\wamp64\www\1.IDM\hotel-staff-flutter
flutter pub get
flutter run
```

If you have an APK:
- Transfer APK to phone
- Install and allow from unknown sources

### Step 2: Configure Network Settings

**IMPORTANT:** This is the ONLY file you need to edit!

**File:** `hotel-staff-flutter/lib/utils/network_config.dart`

```dart
class NetworkConfig {
  // 👇 PUT YOUR COMPUTER'S IP HERE
  static const String computerIp = '192.168.1.100'; // Change to YOUR IP from Step 6
  
  // 👇 Set to true for WiFi, false for USB
  static const bool useWiFi = true;
}
```

**That's it!** All these URLs are built automatically:
- ✅ `wampBaseUrl` → `http://192.168.1.100/1.IDM`
- ✅ `nodeBackendUrl` → `http://192.168.1.100:3000/api`
- ✅ `hotelBackendUrl` → `http://192.168.1.100/1.IDM/hotel-backend/api`
- ✅ `customersApiUrl` → `http://192.168.1.100/1.IDM/customers-api.php`

### Step 3: Connect to Same WiFi
- Computer WiFi: `192.168.1.x`
- Phone WiFi: **MUST BE SAME NETWORK** → `192.168.1.x`

### Step 4: Test Connection
Open browser on phone and visit:
```
http://192.168.1.100/1.IDM/customers-api.php
```

You should see JSON data with customer information.

### Step 5: Run the App
```bash
flutter run
```

Or if using APK, just open the app!

---

## 🔧 Configuration for Different Scenarios

### Scenario 1: Home WiFi Setup
```dart
// Your home router assigns: 192.168.0.x
static const String computerIp = '192.168.0.50';
static const bool useWiFi = true;
```

### Scenario 2: Office WiFi Setup
```dart
// Your office router assigns: 10.0.x.x
static const String computerIp = '10.0.5.100';
static const bool useWiFi = true;
```

### Scenario 3: USB Tethering (No WiFi)
```dart
static const String computerIp = '10.0.1.26'; // Not used in USB mode
static const bool useWiFi = false; // 👈 Set to false
```

Then run:
```bash
adb reverse tcp:8080 tcp:80
adb reverse tcp:3000 tcp:3000
```

### Scenario 4: Using Mobile Hotspot
1. Enable hotspot on another device
2. Connect computer to hotspot
3. Get computer's IP: `ipconfig`
4. Connect phone to same hotspot
5. Update `computerIp` in `network_config.dart`

---

## ✅ Verification Checklist

### Backend (Computer)
- [ ] WAMP/Apache running (green icon in system tray)
- [ ] MySQL service running
- [ ] Node.js server running (`npm start`)
- [ ] Database created and configured
- [ ] Firewall allows ports 80 and 3000
- [ ] Can access `http://localhost/1.IDM/` in browser
- [ ] Can access `http://localhost:3000/api/health` in browser

### Network
- [ ] Computer and phone on same WiFi
- [ ] Computer IP address found (e.g., `192.168.1.100`)
- [ ] Can ping computer from phone (optional)
- [ ] Can access `http://COMPUTER_IP/1.IDM/` from phone browser

### Flutter App
- [ ] `network_config.dart` updated with correct IP
- [ ] `useWiFi` set to `true`
- [ ] App compiled without errors
- [ ] App can fetch customer list
- [ ] Can register new guests
- [ ] Can add escorts

---

## 🐛 Troubleshooting

### Issue: Can't connect from phone to computer

**Solution:**
1. Verify same WiFi network:
   ```bash
   # On computer
   ipconfig
   # Look for WiFi IP: 192.168.1.100
   
   # On phone: Settings → WiFi → Check IP: 192.168.1.x (same subnet)
   ```

2. Test from phone browser:
   ```
   http://192.168.1.100/1.IDM/customers-api.php
   ```

3. Check firewall:
   ```bash
   netsh advfirewall show allprofiles state
   ```

4. Temporarily disable firewall to test (then re-enable)

### Issue: Node.js server not starting

**Solution:**
1. Check if port 3000 is already in use:
   ```bash
   netstat -ano | findstr :3000
   ```

2. Kill the process or change port in `.env`:
   ```env
   PORT=3001
   ```

3. Update `network_config.dart` if you change port

### Issue: Database connection failed

**Solution:**
1. Verify MySQL is running
2. Check credentials in `hotel-backend/.env`
3. Test connection:
   ```bash
   mysql -u root -p
   ```

4. Make sure database exists:
   ```sql
   SHOW DATABASES;
   ```

### Issue: IP address changed

**Solution:**
1. Find new IP: `ipconfig`
2. Update ONE file: `network_config.dart`
   ```dart
   static const String computerIp = 'NEW_IP_HERE';
   ```
3. Hot reload Flutter app (press `r`)

---

## 🔐 Security Notes

### For Development
- ✅ Current setup is fine (local network only)
- ✅ No external access possible
- ✅ Safe for home/office use

### For Production
If deploying to real hotel:
1. **Use HTTPS** (not HTTP)
2. **Add authentication** (JWT tokens)
3. **Use strong passwords** (not empty MySQL password)
4. **Deploy on cloud server** (not WAMP on local computer)
5. **Use environment variables** (not hardcoded IPs)
6. **Enable firewall rules** (restrict to known IPs)
7. **Regular backups** (database and files)

---

## 📞 Need Help?

### Quick Command Reference

**Find IP:**
```bash
ipconfig                           # Windows
ifconfig                           # Mac/Linux
ip addr                           # Linux alternative
```

**Test Backend:**
```bash
curl http://YOUR_IP/1.IDM/customers-api.php
curl http://YOUR_IP:3000/api/health
```

**Check Services:**
```bash
netstat -ano | findstr :80        # Apache
netstat -ano | findstr :3000      # Node.js
```

**Flutter Commands:**
```bash
flutter clean                      # Clear cache
flutter pub get                    # Get dependencies
flutter run                        # Run app
flutter build apk                  # Build APK
```

---

## 📝 Summary: What You Need to Configure

### On New Computer Installation:

1. **Database credentials** (in `hotel-backend/.env`):
   ```env
   DB_HOST=localhost
   DB_USER=root
   DB_PASSWORD=your_password
   DB_NAME=1.idm_db
   ```

2. **Computer IP** (in Flutter app's `network_config.dart`):
   ```dart
   static const String computerIp = 'YOUR_IP_HERE';
   ```

That's **ALL**! Everything else is automatically configured! ✨

---

## 🎉 Success!

If you can:
- ✅ See customer list in app
- ✅ Register new guests
- ✅ Add escorts
- ✅ No connection errors

**Congratulations! Your system is fully configured!** 🎊
