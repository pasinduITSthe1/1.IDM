import 'package:flutter/foundation.dart';
import 'package:shared_preferences/shared_preferences.dart';
import '../services/auth_service.dart';
import '../services/api_service.dart';

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
        try {
          // Login via API
          final result = await _authService.login(username, password);

          _isDemoMode = false;
          _isAuthenticated = true;
          _token = result['token'] as String;

          // Set token in ApiService for all future requests
          _apiService.setToken(_token!);

          final user = result['user'] as Map<String, dynamic>;
          _userId = user['id'] as String;
          _userName = user['name'] as String?;
          _userEmail =
              user['username'] as String; // Using username as email for now
          _userRole = user['role'] as String?;

          await _saveAuthState();
          notifyListeners();
          debugPrint('✅ Logged in successfully via API: $_userName');
          debugPrint('🔑 Token set in ApiService');
          return true;
        } catch (e) {
          debugPrint('❌ API login failed: $e');
          // Fallback to demo credentials
          if (username == 'staff@hotel.com' && password == 'staff123') {
            _isDemoMode = false;
            _isAuthenticated = true;
            _userName = 'Hotel Staff';
            _userEmail = username;
            _userId = 'fallback-id';
            _userRole = 'staff';

            await _saveAuthState();
            notifyListeners();
            debugPrint('⚠️ Logged in with fallback credentials');
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
