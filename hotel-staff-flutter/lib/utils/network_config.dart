/// Network Configuration
///
/// Update the IP address here to change it for the entire app.
/// This is the single source of truth for all API endpoints.

class NetworkConfig {
  // ============================================
  // 🔧 CHANGE YOUR IP ADDRESS HERE
  // ============================================

  /// Your computer's IP address on the local network
  ///
  /// To find your IP address:
  /// - Windows: Run `ipconfig` in Command Prompt, look for WiFi adapter IPv4 Address
  /// - Mac: Run `ifconfig` or check System Preferences > Network
  /// - Linux: Run `ip addr` or `ifconfig`
  // static const String computerIp = '192.168.0.141'; // 👈 CHANGE THIS ONLY
  static const String computerIp = '10.0.1.26'; //👈 CHANGE THIS ONLY

  // ============================================
  // Connection Type
  // ============================================

  /// Choose your connection type
  /// - true: Use WiFi network (using computerIp)
  /// - false: Use USB tethering with ADB port forwarding (localhost)
  static const bool useWiFi = true; // 👈 Set to false for USB tethering

  // ============================================
  // AUTO-CONFIGURED ENDPOINTS (Don't change)
  // ============================================

  /// Apache/WAMP server base URL (Port 80)
  static String get wampBaseUrl {
    if (useWiFi) {
      return 'http://$computerIp/1.IDM';
    } else {
      // USB tethering with ADB port forwarding (adb reverse tcp:8080 tcp:80)
      return 'http://localhost:8080/1.IDM';
    }
  }

  /// Node.js backend server base URL (Port 3000)
  static String get nodeBackendUrl {
    if (useWiFi) {
      return 'http://$computerIp:3000/api';
    } else {
      // USB tethering with ADB port forwarding (adb reverse tcp:3000 tcp:3000)
      return 'http://localhost:3000/api';
    }
  }

  /// Hotel backend API base URL
  static String get hotelBackendUrl {
    if (useWiFi) {
      return 'http://$computerIp/1.IDM/hotel-backend/api';
    } else {
      return 'http://localhost:8080/1.IDM/hotel-backend/api';
    }
  }

  // ============================================
  // Timeouts
  // ============================================

  static const Duration connectionTimeout = Duration(seconds: 30);
  static const Duration receiveTimeout = Duration(seconds: 30);

  // ============================================
  // Specific Endpoints
  // ============================================

  /// Customer API endpoint
  static String get customersApiUrl => '$wampBaseUrl/src/api/customers-api.php';

  /// Add customer API endpoint
  static String get addCustomerApiUrl =>
      '$wampBaseUrl/src/api/add-customer-api.php';

  /// Guest attachments API endpoint (Standalone API that bypasses PrestaShop redirects)
  static String get guestAttachmentsApiUrl {
    if (useWiFi) {
      return 'http://$computerIp/guest-api/upload-attachments-standalone.php';
    } else {
      return 'http://localhost:8080/guest-api/upload-attachments-standalone.php';
    }
  }

  /// Escort attachments API endpoint
  static String get escortAttachmentsApiUrl {
    if (useWiFi) {
      return 'http://$computerIp/guest-api/upload-escort-attachments.php';
    } else {
      return 'http://localhost:8080/guest-api/upload-escort-attachments.php';
    }
  }

  /// QloApps base URL
  static String get qloAppsBaseUrl => wampBaseUrl;

  /// Escorts API base URL
  static String get escortsApiUrl => nodeBackendUrl;

  /// Rooms API endpoint (custom API that bypasses PrestaShop webservice auth)
  static String get roomsApiUrl => '$wampBaseUrl/custom-api/rooms.php';

  /// Notifications API base URL
  static String get notificationsApiUrl => '$wampBaseUrl/custom-api';
}
