# Network Configuration

## 🎯 Single Source of Truth

This file (`network_config.dart`) is the **ONLY place** you need to change network settings for the entire app.

## 🔧 How to Use

### Change Your Computer's IP Address

```dart
static const String computerIp = '10.0.1.26'; // 👈 CHANGE THIS
```

**How to find your IP:**
- Windows: `ipconfig` → WiFi adapter → IPv4 Address
- Mac: `ifconfig` → en0 → inet
- Linux: `ip addr` → wlan0 → inet

### Switch Between WiFi and USB Tethering

```dart
static const bool useWiFi = true; // 👈 CHANGE THIS
```

- `true` = Use WiFi network (uses `computerIp`)
- `false` = Use USB tethering with ADB (uses `localhost`)

## 📡 What Gets Configured Automatically

When you change the settings above, ALL of these update automatically:

### Services
- ✅ **Escort Service** - Escort management API
- ✅ **Direct Customer Service** - Customer database API
- ✅ **QloApps Service** - QloApps WebService API
- ✅ **Hotel Management Service** - Check-in/Check-out API

### Providers
- ✅ **Guest Provider** - Guest list loading

### Utilities
- ✅ **API Config** - General API configuration

## 🚀 Quick Examples

### Example 1: Using WiFi at Home
```dart
static const String computerIp = '192.168.1.100';
static const bool useWiFi = true;
```
**Result:** All APIs use `http://192.168.1.100:xxxx`

### Example 2: Using WiFi at Office
```dart
static const String computerIp = '10.0.50.25';
static const bool useWiFi = true;
```
**Result:** All APIs use `http://10.0.50.25:xxxx`

### Example 3: Using USB Tethering
```dart
static const String computerIp = '10.0.1.26'; // Not used
static const bool useWiFi = false;
```
**Result:** All APIs use `http://localhost:xxxx` (requires ADB port forwarding)

## ⚡ Hot Reload Support

After changing the IP or mode:
1. Save the file
2. Press `r` in the Flutter terminal to hot reload
3. Changes apply immediately (no need to restart app!)

## 🔒 What NOT to Change

Don't modify these (they auto-configure based on your settings):
- ❌ `wampBaseUrl` - Automatically set
- ❌ `nodeBackendUrl` - Automatically set
- ❌ `hotelBackendUrl` - Automatically set
- ❌ `customersApiUrl` - Automatically set

## 💡 Tips

1. **Find Your IP Fast**: `ipconfig | findstr IPv4`
2. **Test Connection**: `curl http://YOUR_IP/1.IDM/customers-api.php`
3. **Same Network**: Phone and computer must be on the same WiFi
4. **Firewall**: Make sure Windows Firewall allows ports 80 and 3000

## 🆘 Troubleshooting

### Can't Connect?
1. Verify IP address: `ipconfig`
2. Check same WiFi network on both devices
3. Test from browser on phone: `http://YOUR_IP/1.IDM/`
4. Check firewall settings

### IP Changed?
1. Update `computerIp` in this file
2. Hot reload the app
3. Done!

### Want USB Again?
1. Set `useWiFi = false`
2. Run ADB commands:
   ```
   adb reverse tcp:8080 tcp:80
   adb reverse tcp:3000 tcp:3000
   ```
3. Hot reload the app
