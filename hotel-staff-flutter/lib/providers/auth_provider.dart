import 'package:flutter/foundation.dart';
import 'package:shared_preferences/shared_preferences.dart';

class AuthProvider with ChangeNotifier {
  bool _isAuthenticated = false;
  bool _isDemoMode = false;
  String? _userName;
  String? _userEmail;

  bool get isAuthenticated => _isAuthenticated;
  bool get isDemoMode => _isDemoMode;
  String? get userName => _userName;
  String? get userEmail => _userEmail;

  // Login with credentials
  Future<bool> login(String email, String password,
      {bool demoMode = false}) async {
    try {
      if (demoMode) {
        // Demo mode login
        _isDemoMode = true;
        _isAuthenticated = true;
        _userName = 'Demo User';
        _userEmail = 'demo@hotel.com';

        await _saveAuthState();
        notifyListeners();
        return true;
      } else {
        // Online mode login (API integration)
        // TODO: Implement QloApps API authentication
        if (email == 'staff@hotel.com' && password == 'staff123') {
          _isDemoMode = false;
          _isAuthenticated = true;
          _userName = 'Hotel Staff';
          _userEmail = email;

          await _saveAuthState();
          notifyListeners();
          return true;
        }
        return false;
      }
    } catch (e) {
      debugPrint('Login error: $e');
      return false;
    }
  }

  // Logout
  Future<void> logout() async {
    _isAuthenticated = false;
    _isDemoMode = false;
    _userName = null;
    _userEmail = null;

    final prefs = await SharedPreferences.getInstance();
    await prefs.clear();

    notifyListeners();
  }

  // Save auth state to local storage
  Future<void> _saveAuthState() async {
    final prefs = await SharedPreferences.getInstance();
    await prefs.setBool('isAuthenticated', _isAuthenticated);
    await prefs.setBool('isDemoMode', _isDemoMode);
    await prefs.setString('userName', _userName ?? '');
    await prefs.setString('userEmail', _userEmail ?? '');
  }

  // Load auth state from local storage
  Future<void> loadAuthState() async {
    final prefs = await SharedPreferences.getInstance();
    _isAuthenticated = prefs.getBool('isAuthenticated') ?? false;
    _isDemoMode = prefs.getBool('isDemoMode') ?? false;
    _userName = prefs.getString('userName');
    _userEmail = prefs.getString('userEmail');
    notifyListeners();
  }
}
