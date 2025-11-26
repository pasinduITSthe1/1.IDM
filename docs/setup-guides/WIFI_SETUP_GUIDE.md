# WiFi Network Setup Guide

## 🎯 Centralized Configuration

Your Flutter app now uses **ONE FILE** for all network configuration!

### 📝 Change IP in ONE Place

**File:** `lib/utils/network_config.dart`

```dart
class NetworkConfig {
  // 👇 CHANGE THIS ONLY
  static const String computerIp = '10.0.1.26';
  
  // 👇 Set to false for USB tethering
  static const bool useWiFi = true;
}
```

That's it! All services automatically use this configuration.

### Network Details
- **Computer WiFi IP**: `10.0.1.26` (configured in network_config.dart)
- **WiFi Network**: Your home/office WiFi
- **Apache/WAMP Port**: `80` (for customer API)
- **Node.js Backend Port**: `3000` (for escort management)

### What Uses This Config?
All services automatically read from `NetworkConfig`:

1. ✅ `escort_service.dart` - Escort management
2. ✅ `direct_customer_service.dart` - Customer API
3. ✅ `qloapps_api_service.dart` - QloApps API
4. ✅ `hotel_management_service.dart` - Hotel operations
5. ✅ `guest_provider.dart` - Guest data
6. ✅ `api_config.dart` - General API config

### Server Status
- ✅ Apache/WAMP server running on port 80
- ✅ Node.js backend running on port 3000
- ✅ MySQL database connected
- ✅ Firewall configured to allow connections

## Testing

### From Your Computer
Both servers are accessible from your computer:
```bash
# Test Apache/WAMP (Customer API)
curl http://10.0.1.26/1.IDM/customers-api.php

# Test Node.js Backend (Escort API)
curl http://10.0.1.26:3000/api/health
```

### From Your Phone
1. **Connect your phone to the SAME WiFi network** as your computer
2. Make sure your phone WiFi is the same network showing in Windows (`10.0.1.x`)
3. Run the Flutter app: `flutter run`

## Important Notes

### If Your Computer's IP Changes
If you restart your router or computer, the IP address might change. To update:

1. Check your new IP: `ipconfig` (look for WiFi adapter IPv4 Address)
2. **Update ONLY ONE FILE**: `lib/utils/network_config.dart`
   ```dart
   static const String computerIp = 'YOUR_NEW_IP'; // 👈 Change here only
   ```
3. Hot reload or restart the Flutter app (the change will apply everywhere automatically)

### Switching Back to USB Tethering
If you want to use USB tethering again:

1. **Edit ONE FILE**: `lib/utils/network_config.dart`
   ```dart
   static const bool useWiFi = false; // 👈 Change to false
   ```
2. Set up ADB port forwarding:
   ```bash
   adb reverse tcp:8080 tcp:80
   adb reverse tcp:3000 tcp:3000
   ```
3. Hot reload or restart the Flutter app (automatically switches to localhost)

### Firewall Issues
If your phone can't connect:
- Check Windows Firewall settings
- Make sure ports 80 and 3000 are allowed
- Check if any antivirus is blocking connections

## Quick Reference

### Current Configuration (WiFi)
```dart
// Node.js Backend (Port 3000)
http://10.0.1.26:3000/api

// Apache/WAMP (Port 80)
http://10.0.1.26/1.IDM
```

### USB Tethering Configuration (Alternative)
```dart
// Node.js Backend (with ADB forwarding)
http://localhost:3000/api

// Apache/WAMP (with ADB forwarding)
http://localhost:8080/1.IDM
```

## Troubleshooting

### Phone Can't Connect
1. Verify both devices on same WiFi:
   - Computer: Run `ipconfig` → WiFi shows `10.0.1.26`
   - Phone: Check WiFi settings → IP should be `10.0.1.x`

2. Test from phone browser:
   - Open browser on phone
   - Go to: `http://10.0.1.26/1.IDM/customers-api.php`
   - Should see JSON customer data

3. Check firewall:
   ```bash
   netsh advfirewall firewall show rule name="Apache WAMP - Port 80"
   ```

4. Restart servers if needed:
   - Apache/WAMP: Use WAMP Manager
   - Node.js: Restart the Node.js terminal window

### Connection Timeout
- Increase timeout in `lib/utils/api_config.dart`:
  ```dart
  static const Duration connectionTimeout = Duration(seconds: 60);
  ```

### Need Help?
Check the logs in the Flutter app for detailed error messages when making API calls.
