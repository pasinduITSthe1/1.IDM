# Flutter Integration Guide

This guide shows you how to connect your Flutter hotel staff app to the Node.js backend API.

## 📋 Overview

Your Flutter app will communicate with the backend API using HTTP requests instead of local storage (SharedPreferences).

## 🔧 Step 1: Add Dependencies

Add the `http` package to your Flutter app:

**pubspec.yaml:**
```yaml
dependencies:
  flutter:
    sdk: flutter
  http: ^1.1.0  # Add this line
  provider: ^6.1.1
  # ... your other dependencies
```

Then run:
```bash
flutter pub get
```

## 📁 Step 2: Create API Service

Create a new file: `lib/services/api_service.dart`

```dart
import 'dart:convert';
import 'package:http/http.dart' as http;
import '../models/guest.dart';

class ApiService {
  // Change this to your computer's IP address if testing on real device
  // For emulator, use: http://10.0.2.2:3000
  // For real device on same network, use: http://YOUR_IP:3000
  static const String baseUrl = 'http://localhost:3000/api';
  
  // Store token after login
  static String? _token;

  // Set token after login
  static void setToken(String token) {
    _token = token;
  }

  // Get token
  static String? getToken() {
    return _token;
  }

  // Clear token on logout
  static void clearToken() {
    _token = null;
  }

  // Get headers with authentication
  static Map<String, String> _getHeaders() {
    return {
      'Content-Type': 'application/json',
      if (_token != null) 'Authorization': 'Bearer $_token',
    };
  }

  // ==================== AUTH ====================

  static Future<Map<String, dynamic>> login(String username, String password) async {
    try {
      final response = await http.post(
        Uri.parse('$baseUrl/auth/login'),
        headers: {'Content-Type': 'application/json'},
        body: jsonEncode({
          'username': username,
          'password': password,
        }),
      );

      final data = jsonDecode(response.body);

      if (response.statusCode == 200 && data['success']) {
        _token = data['data']['token'];
        return {
          'success': true,
          'staff': data['data']['staff'],
        };
      } else {
        return {
          'success': false,
          'message': data['message'] ?? 'Login failed',
        };
      }
    } catch (e) {
      return {
        'success': false,
        'message': 'Network error: $e',
      };
    }
  }

  // ==================== GUESTS ====================

  static Future<List<Guest>> getGuests() async {
    try {
      final response = await http.get(
        Uri.parse('$baseUrl/guests'),
        headers: _getHeaders(),
      );

      if (response.statusCode == 200) {
        final data = jsonDecode(response.body);
        if (data['success']) {
          List<dynamic> guestsJson = data['data'];
          return guestsJson.map((json) => Guest.fromJson(json)).toList();
        }
      }
      return [];
    } catch (e) {
      print('Error fetching guests: $e');
      return [];
    }
  }

  static Future<Guest?> getGuest(String id) async {
    try {
      final response = await http.get(
        Uri.parse('$baseUrl/guests/$id'),
        headers: _getHeaders(),
      );

      if (response.statusCode == 200) {
        final data = jsonDecode(response.body);
        if (data['success']) {
          return Guest.fromJson(data['data']);
        }
      }
      return null;
    } catch (e) {
      print('Error fetching guest: $e');
      return null;
    }
  }

  static Future<bool> createGuest(Guest guest) async {
    try {
      final response = await http.post(
        Uri.parse('$baseUrl/guests'),
        headers: _getHeaders(),
        body: jsonEncode({
          'firstName': guest.firstName,
          'lastName': guest.lastName,
          'documentNumber': guest.documentNumber,
          'documentType': guest.documentType,
          'issuedCountry': guest.issuedCountry,
          'issuedDate': guest.issuedDate,
          'expiryDate': guest.expiryDate,
          'dateOfBirth': guest.dateOfBirth,
          'sex': guest.sex,
          'nationality': guest.nationality,
          'email': guest.email,
          'phone': guest.phone,
          'address': guest.address,
          'visitPurpose': guest.visitPurpose,
          'status': guest.status,
          'roomNumber': guest.roomNumber,
        }),
      );

      final data = jsonDecode(response.body);
      return response.statusCode == 201 && data['success'];
    } catch (e) {
      print('Error creating guest: $e');
      return false;
    }
  }

  static Future<bool> updateGuest(String id, Guest guest) async {
    try {
      final response = await http.put(
        Uri.parse('$baseUrl/guests/$id'),
        headers: _getHeaders(),
        body: jsonEncode({
          'firstName': guest.firstName,
          'lastName': guest.lastName,
          'documentNumber': guest.documentNumber,
          'documentType': guest.documentType,
          'issuedCountry': guest.issuedCountry,
          'issuedDate': guest.issuedDate,
          'expiryDate': guest.expiryDate,
          'dateOfBirth': guest.dateOfBirth,
          'sex': guest.sex,
          'nationality': guest.nationality,
          'email': guest.email,
          'phone': guest.phone,
          'address': guest.address,
          'visitPurpose': guest.visitPurpose,
          'status': guest.status,
          'roomNumber': guest.roomNumber,
        }),
      );

      final data = jsonDecode(response.body);
      return response.statusCode == 200 && data['success'];
    } catch (e) {
      print('Error updating guest: $e');
      return false;
    }
  }

  static Future<bool> deleteGuest(String id) async {
    try {
      final response = await http.delete(
        Uri.parse('$baseUrl/guests/$id'),
        headers: _getHeaders(),
      );

      final data = jsonDecode(response.body);
      return response.statusCode == 200 && data['success'];
    } catch (e) {
      print('Error deleting guest: $e');
      return false;
    }
  }

  static Future<bool> checkinGuest(String id, String roomNumber) async {
    try {
      final response = await http.post(
        Uri.parse('$baseUrl/guests/$id/checkin'),
        headers: _getHeaders(),
        body: jsonEncode({'roomNumber': roomNumber}),
      );

      final data = jsonDecode(response.body);
      return response.statusCode == 200 && data['success'];
    } catch (e) {
      print('Error checking in guest: $e');
      return false;
    }
  }

  static Future<bool> checkoutGuest(String id) async {
    try {
      final response = await http.post(
        Uri.parse('$baseUrl/guests/$id/checkout'),
        headers: _getHeaders(),
      );

      final data = jsonDecode(response.body);
      return response.statusCode == 200 && data['success'];
    } catch (e) {
      print('Error checking out guest: $e');
      return false;
    }
  }
}
```

## 🔄 Step 3: Update AuthProvider

Update your `lib/providers/auth_provider.dart`:

```dart
import 'package:flutter/material.dart';
import '../services/api_service.dart';

class AuthProvider with ChangeNotifier {
  bool _isAuthenticated = false;
  Map<String, dynamic>? _currentStaff;

  bool get isAuthenticated => _isAuthenticated;
  Map<String, dynamic>? get currentStaff => _currentStaff;

  Future<bool> login(String username, String password) async {
    try {
      final result = await ApiService.login(username, password);
      
      if (result['success']) {
        _isAuthenticated = true;
        _currentStaff = result['staff'];
        notifyListeners();
        return true;
      }
      return false;
    } catch (e) {
      print('Login error: $e');
      return false;
    }
  }

  void logout() {
    _isAuthenticated = false;
    _currentStaff = null;
    ApiService.clearToken();
    notifyListeners();
  }
}
```

## 🔄 Step 4: Update GuestProvider

Update your `lib/providers/guest_provider.dart`:

```dart
import 'package:flutter/material.dart';
import '../models/guest.dart';
import '../services/api_service.dart';

class GuestProvider with ChangeNotifier {
  List<Guest> _guests = [];
  bool _isLoading = false;

  List<Guest> get guests => _guests;
  bool get isLoading => _isLoading;

  // Get all guests
  Future<void> fetchGuests() async {
    _isLoading = true;
    notifyListeners();

    _guests = await ApiService.getGuests();

    _isLoading = false;
    notifyListeners();
  }

  // Add guest
  Future<bool> addGuest(Guest guest) async {
    final success = await ApiService.createGuest(guest);
    
    if (success) {
      await fetchGuests(); // Refresh list
    }
    
    return success;
  }

  // Update guest
  Future<bool> updateGuest(Guest guest) async {
    final success = await ApiService.updateGuest(guest.id, guest);
    
    if (success) {
      await fetchGuests(); // Refresh list
    }
    
    return success;
  }

  // Delete guest
  Future<bool> deleteGuest(String id) async {
    final success = await ApiService.deleteGuest(id);
    
    if (success) {
      await fetchGuests(); // Refresh list
    }
    
    return success;
  }

  // Check-in guest
  Future<bool> checkinGuest(String id, String roomNumber) async {
    final success = await ApiService.checkinGuest(id, roomNumber);
    
    if (success) {
      await fetchGuests(); // Refresh list
    }
    
    return success;
  }

  // Check-out guest
  Future<bool> checkoutGuest(String id) async {
    final success = await ApiService.checkoutGuest(id);
    
    if (success) {
      await fetchGuests(); // Refresh list
    }
    
    return success;
  }

  // Get guests by status
  List<Guest> getGuestsByStatus(String status) {
    return _guests.where((guest) => guest.status == status).toList();
  }
}
```

## 📱 Step 5: Update Guest Model (if needed)

Make sure your `Guest.fromJson` method handles the MySQL date format:

```dart
factory Guest.fromJson(Map<String, dynamic> json) {
  return Guest(
    id: json['id'] as String,
    firstName: json['first_name'] as String,
    lastName: json['last_name'] as String,
    documentNumber: json['document_number'] as String?,
    documentType: json['document_type'] as String?,
    issuedCountry: json['issued_country'] as String?,
    issuedDate: json['issued_date'] as String?,
    expiryDate: json['expiry_date'] as String?,
    dateOfBirth: json['date_of_birth'] as String?,
    sex: json['sex'] as String?,
    nationality: json['nationality'] as String?,
    email: json['email'] as String?,
    phone: json['phone'] as String?,
    address: json['address'] as String?,
    visitPurpose: json['visit_purpose'] as String?,
    status: json['status'] as String? ?? 'pending',
    roomNumber: json['room_number'] as String?,
    checkInDate: json['check_in_date'] != null
        ? DateTime.parse(json['check_in_date'] as String)
        : null,
    checkOutDate: json['check_out_date'] != null
        ? DateTime.parse(json['check_out_date'] as String)
        : null,
    createdAt: json['created_at'] != null
        ? DateTime.parse(json['created_at'] as String)
        : DateTime.now(),
  );
}
```

## 🌐 Step 6: Configure API URL for Different Environments

### For Android Emulator:
```dart
static const String baseUrl = 'http://10.0.2.2:3000/api';
```

### For iOS Simulator:
```dart
static const String baseUrl = 'http://localhost:3000/api';
```

### For Real Device (on same WiFi):
```dart
// Replace with your computer's IP address
static const String baseUrl = 'http://192.168.1.100:3000/api';
```

To find your IP address:
```powershell
ipconfig
```
Look for "IPv4 Address" under your active network adapter.

## 🚀 Step 7: Testing

1. **Start the backend:**
   ```bash
   cd hotel-backend
   npm start
   ```

2. **Run your Flutter app:**
   ```bash
   cd hotel-staff-flutter
   flutter run
   ```

3. **Login with:**
   - Username: `admin`
   - Password: `admin123`

## 🐛 Troubleshooting

### Connection Refused Error
- Make sure backend server is running
- Check the API URL (use correct IP for device)
- Check firewall settings

### Token Expired
- Re-login to get a fresh token
- Token is valid for 24 hours by default

### CORS Error (if deploying)
- Backend already has CORS enabled
- If still getting errors, check backend logs

## 📝 Important Notes

1. **Remove SharedPreferences code**: You no longer need to save guests locally
2. **Error Handling**: Add proper error messages in UI
3. **Loading States**: Show loading indicators during API calls
4. **Token Management**: Token is stored in memory, will be lost on app restart
5. **Production**: Deploy backend to a server (not localhost)

## 🎯 Next Steps

1. Test all CRUD operations
2. Add error handling and loading states
3. Implement token refresh mechanism
4. Add offline mode (optional)
5. Deploy backend to production server

---

**You're all set! Your Flutter app is now connected to MySQL via the Node.js backend!** 🎉
