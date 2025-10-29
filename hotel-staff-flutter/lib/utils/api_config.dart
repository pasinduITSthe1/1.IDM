// API Configuration
//
// Update the [baseUrl] to match your backend server location:
//
// For Android Emulator:
//   - Use: 'http://10.0.2.2:3000/api'
//
// For Physical Device (same WiFi network):
//   - Find your computer's IP address:
//     - Windows: Run `ipconfig` in Command Prompt, look for IPv4 Address
//     - Mac/Linux: Run `ifconfig` or `ip addr`, look for inet address
//   - Use: 'http://YOUR_IP_ADDRESS:3000/api'
//   - Example: 'http://192.168.1.100:3000/api'
//
// For Production:
//   - Use your actual server URL
//   - Example: 'https://api.yourhotel.com/api'

class ApiConfig {
  // Change this based on your setup
  static const String baseUrl =
      'http://192.168.217.41:3000/api'; // USB Tethering connection
  // static const String baseUrl = 'http://10.0.2.2:3000/api'; // Android Emulator
  // static const String baseUrl = 'http://localhost:3000/api'; // iOS Simulator

  static const Duration connectionTimeout = Duration(seconds: 30);
  static const Duration receiveTimeout = Duration(seconds: 30);

  // API Endpoints
  static const String authLogin = '/auth/login';
  static const String authRegister = '/auth/register';
  static const String guests = '/guests';
  static const String rooms = '/rooms';
  static const String health = '/health';
}
