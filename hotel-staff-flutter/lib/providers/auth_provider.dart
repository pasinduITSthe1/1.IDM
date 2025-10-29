import 'package:flutter/foundation.dart';
import 'package:shared_preferences/shared_preferences.dart';
import '../services/auth_service.dart';
import '../services/api_service.dart';
import '../services/qloapps_api_service.dart';
import 'package:crypto/crypto.dart';
import 'dart:convert';

class AuthProvider with ChangeNotifier {
  bool _isAuthenticated = false;
  bool _isDemoMode = false;
  String? _userName;
  String? _userEmail;
  String? _userId;
  String? _userRole;
  String? _token;
  final AuthService _authService = AuthService();
  final ApiService _apiService = ApiService();
  final QloAppsApiService _qloAppsService = QloAppsApiService();
  bool _useQloAppsAuth = true; // Use QloApps for authentication

  bool get isAuthenticated => _isAuthenticated;
  bool get isDemoMode => _isDemoMode;
  String? get userName => _userName;
  String? get userEmail => _userEmail;
  String? get userId => _userId;
  String? get userRole => _userRole;
  String? get token => _token;

  // Login with credentials
  Future<bool> login(String username, String password,
      {bool demoMode = false}) async {
    try {
      if (demoMode) {
        // Demo mode login
        _isDemoMode = true;
        _isAuthenticated = true;
        _userName = 'Demo User';
        _userEmail = 'demo@hotel.com';
        _userId = 'demo-id';
        _userRole = 'demo';

        await _saveAuthState();
        notifyListeners();
        debugPrint('✅ Logged in (Demo Mode)');
        return true;
      } else {
        // Try QloApps authentication first
        if (_useQloAppsAuth) {
          try {
            debugPrint('🔐 Attempting QloApps authentication...');

            // Get employees from QloApps
            final response = await _qloAppsService.get('employees', params: {
              'display': 'full',
              'filter[active]': '1',
            });

            final employees = response['employees'] as dynamic;
            if (employees != null) {
              final employeeList = employees is List ? employees : [employees];

              // Search for matching employee
              for (var empData in employeeList) {
                final employee = empData['employee'] ?? empData;
                final empEmail =
                    employee['email']?.toString().toLowerCase() ?? '';
                final empFirstName = employee['firstname']?.toString() ?? '';
                final empLastName = employee['lastname']?.toString() ?? '';
                final empId = employee['id']?.toString() ?? '';

                // Check if username matches email or firstname
                if (empEmail == username.toLowerCase() ||
                    empFirstName.toLowerCase() == username.toLowerCase() ||
                    username.toLowerCase() == 'admin') {
                  // For now, accept any password for testing
                  // In production, you should verify against QloApps password hash
                  if (password == 'admin123' || password == 'admin') {
                    _isDemoMode = false;
                    _isAuthenticated = true;
                    _userName = '$empFirstName $empLastName'.trim();
                    _userEmail = empEmail;
                    _userId = empId;
                    _userRole = 'employee';
                    _token =
                        'qloapps-$empId-${DateTime.now().millisecondsSinceEpoch}';

                    await _saveAuthState();
                    notifyListeners();
                    debugPrint('✅ Logged in via QloApps: $_userName');
                    return true;
                  }
                }
              }

              debugPrint('❌ Invalid credentials for QloApps');
            }
          } catch (e) {
            debugPrint('⚠️ QloApps auth failed: $e');
          }
        }

        // Fallback to Node.js backend
        try {
          debugPrint('🔐 Attempting Node.js backend authentication...');
          final result = await _authService.login(username, password);

          _isDemoMode = false;
          _isAuthenticated = true;
          _token = result['token'] as String;

          // Set token in ApiService for all future requests
          _apiService.setToken(_token!);

          final user = result['user'] as Map<String, dynamic>;
          _userId = user['id'] as String;
          _userName = user['name'] as String?;
          _userEmail = user['username'] as String;
          _userRole = user['role'] as String?;

          await _saveAuthState();
          notifyListeners();
          debugPrint('✅ Logged in via Node.js API: $_userName');
          return true;
        } catch (e) {
          debugPrint('❌ Node.js auth failed: $e');

          // Final fallback to demo credentials
          if (username.toLowerCase() == 'admin' && password == 'admin123') {
            _isDemoMode = false;
            _isAuthenticated = true;
            _userName = 'Administrator';
            _userEmail = 'admin@hotel.com';
            _userId = 'admin-1';
            _userRole = 'admin';
            _token = 'fallback-admin-token';

            await _saveAuthState();
            notifyListeners();
            debugPrint('⚠️ Logged in with fallback admin credentials');
            return true;
          }

          return false;
        }
      }
    } catch (e) {
      debugPrint('❌ Login error: $e');
      return false;
    }
  }

  // Logout
  Future<void> logout() async {
    _authService.logout();

    _isAuthenticated = false;
    _isDemoMode = false;
    _userName = null;
    _userEmail = null;
    _userId = null;
    _userRole = null;
    _token = null;

    // Clear token from ApiService
    _apiService.clearToken();

    final prefs = await SharedPreferences.getInstance();
    await prefs.clear();

    notifyListeners();
    debugPrint('✅ Logged out successfully');
  }

  // Save auth state to local storage
  Future<void> _saveAuthState() async {
    final prefs = await SharedPreferences.getInstance();
    await prefs.setBool('isAuthenticated', _isAuthenticated);
    await prefs.setBool('isDemoMode', _isDemoMode);
    await prefs.setString('userName', _userName ?? '');
    await prefs.setString('userEmail', _userEmail ?? '');
    await prefs.setString('userId', _userId ?? '');
    await prefs.setString('userRole', _userRole ?? '');
    await prefs.setString('token', _token ?? '');
  }

  // Load auth state from local storage
  Future<void> loadAuthState() async {
    final prefs = await SharedPreferences.getInstance();
    _isAuthenticated = prefs.getBool('isAuthenticated') ?? false;
    _isDemoMode = prefs.getBool('isDemoMode') ?? false;
    _userName = prefs.getString('userName');
    _userEmail = prefs.getString('userEmail');
    _userId = prefs.getString('userId');
    _userRole = prefs.getString('userRole');
    _token = prefs.getString('token');

    // Restore token in ApiService if available
    if (_token != null && _token!.isNotEmpty) {
      _apiService.setToken(_token!);
      debugPrint('🔑 Token restored in ApiService from storage');
    }

    notifyListeners();
  }
}
