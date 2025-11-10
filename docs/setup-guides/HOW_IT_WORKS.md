# 🔧 How Automatic Configuration Works

## Simple Explanation

You only configure **2 things**:
```dart
static const String computerIp = '192.168.1.100';  // 1️⃣ Your computer's IP
static const bool useWiFi = true;                   // 2️⃣ WiFi or USB mode
```

Then the code **automatically builds** all URLs:

```
┌─────────────────────────────────────────────────────────┐
│  YOU CONFIGURE (network_config.dart)                    │
│                                                          │
│  computerIp = '192.168.1.100'                           │
│  useWiFi = true                                         │
└─────────────────────────────────────────────────────────┘
                          ↓
                          ↓ (Dart getters automatically build URLs)
                          ↓
┌─────────────────────────────────────────────────────────┐
│  AUTOMATICALLY GENERATED                                 │
│                                                          │
│  wampBaseUrl       = http://192.168.1.100/1.IDM        │
│  nodeBackendUrl    = http://192.168.1.100:3000/api     │
│  hotelBackendUrl   = http://192.168.1.100/1.IDM/hotel-backend/api │
│  customersApiUrl   = http://192.168.1.100/1.IDM/customers-api.php │
│  addCustomerApiUrl = http://192.168.1.100/1.IDM/add-customer-api.php │
└─────────────────────────────────────────────────────────┘
```

## Code Example

Here's how it works in the code:

```dart
// network_config.dart

class NetworkConfig {
  // 👤 YOU set these
  static const String computerIp = '192.168.1.100';
  static const bool useWiFi = true;
  
  // 🤖 CODE automatically builds these using Dart getters
  static String get wampBaseUrl {
    if (useWiFi) {
      return 'http://$computerIp/1.IDM';  // 👈 Uses YOUR computerIp
    } else {
      return 'http://localhost:8080/1.IDM';  // 👈 USB mode
    }
  }
  
  static String get customersApiUrl => '$wampBaseUrl/customers-api.php';
  // This becomes: http://192.168.1.100/1.IDM/customers-api.php
}
```

## For Different Computers

### Computer A (Home - IP: 192.168.0.50)
```dart
static const String computerIp = '192.168.0.50';  // Only change this
static const bool useWiFi = true;
```
**Result:** All URLs use `192.168.0.50`

### Computer B (Office - IP: 10.0.5.100)
```dart
static const String computerIp = '10.0.5.100';  // Only change this
static const bool useWiFi = true;
```
**Result:** All URLs use `10.0.5.100`

### Computer C (Using USB Tethering)
```dart
static const String computerIp = '192.168.1.100';  // Not used
static const bool useWiFi = false;  // 👈 Just change this
```
**Result:** All URLs use `localhost:8080` or `localhost:3000`

## Installation on New Device

```
┌────────────────────────────────────────────┐
│ Step 1: Set up backend (computer)         │
│  • Install WAMP                            │
│  • Install Node.js                         │
│  • Copy project files                      │
│  • Start services                          │
└────────────────────────────────────────────┘
                  ↓
┌────────────────────────────────────────────┐
│ Step 2: Find your computer's IP           │
│  • Run: ipconfig (Windows)                 │
│  • Note WiFi IPv4 Address                  │
│  • Example: 192.168.1.100                  │
└────────────────────────────────────────────┘
                  ↓
┌────────────────────────────────────────────┐
│ Step 3: Configure Flutter app             │
│  • Edit: network_config.dart               │
│  • Change: computerIp = 'YOUR_IP'          │
│  • Keep: useWiFi = true                    │
└────────────────────────────────────────────┘
                  ↓
┌────────────────────────────────────────────┐
│ ✅ DONE! All URLs configured automatically │
│                                             │
│  No need to edit:                          │
│  • escort_service.dart                     │
│  • direct_customer_service.dart            │
│  • qloapps_api_service.dart                │
│  • hotel_management_service.dart           │
│  • guest_provider.dart                     │
│  • api_config.dart                         │
│                                             │
│  They all read from network_config.dart!   │
└────────────────────────────────────────────┘
```

## The Magic: Dart Getters

**Without Getters (old way - BAD):**
```dart
// ❌ You had to update 6+ files
static const String url1 = 'http://192.168.1.100/1.IDM';
static const String url2 = 'http://192.168.1.100:3000/api';
static const String url3 = 'http://192.168.1.100/1.IDM/hotel-backend/api';
// ... and more
```

**With Getters (new way - GOOD):**
```dart
// ✅ Update once, all URLs change automatically
static const String computerIp = '192.168.1.100';

static String get url1 => 'http://$computerIp/1.IDM';
static String get url2 => 'http://$computerIp:3000/api';
static String get url3 => 'http://$computerIp/1.IDM/hotel-backend/api';
// All use the same computerIp variable!
```

## Key Benefits

1. **Single Source of Truth** ✅
   - Change IP in ONE place
   - All services update automatically

2. **Easy Mode Switching** ✅
   - WiFi ↔ USB with one boolean
   - No need to comment/uncomment code

3. **Error Prevention** ✅
   - Can't forget to update a file
   - Type-safe (Dart compiler checks)

4. **Easy Installation** ✅
   - New computer? Just update 2 values
   - No hunting through code

## What You Actually Configure

### Backend (Computer)
```env
# hotel-backend/.env
DB_HOST=localhost        # Usually localhost
DB_USER=root            # Usually root for WAMP
DB_PASSWORD=            # Empty for WAMP default
DB_NAME=1.idm_db       # Your database name
```

### Frontend (Flutter App)
```dart
// lib/utils/network_config.dart
static const String computerIp = 'YOUR_IP';  // From ipconfig
static const bool useWiFi = true;            // true or false
```

**That's it!** 🎉 Everything else is automatic!
