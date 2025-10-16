import 'package:flutter/foundation.dart';
import 'api_service.dart';

class AuthService {
  final ApiService _apiService = ApiService();

  // Login
  Future<Map<String, dynamic>> login(String username, String password) async {
    try {
      debugPrint('🔄 Attempting login for user: $username');

      final response = await _apiService.post('/auth/login', {
        'username': username,
        'password': password,
      });

      if (response['success'] == true) {
        final data = response['data'] as Map<String, dynamic>;
        final token = data['token'] as String;
        final staff = data['staff'] as Map<String, dynamic>;

        // Set token for future API calls
        _apiService.setToken(token);

        debugPrint('✅ Login successful for user: ${staff['username']}');

        return {
          'token': token,
          'user': {
            'id': staff['id'],
            'username': staff['username'],
            'name': staff['name'],
            'role': staff['role'],
          }
        };
      } else {
        throw Exception('Login failed');
      }
    } catch (e) {
      debugPrint('❌ Login error: $e');
      throw Exception('Login failed: $e');
    }
  }

  // Register (create new staff)
  Future<Map<String, dynamic>> register({
    required String username,
    required String password,
    required String name,
    String role = 'staff',
  }) async {
    try {
      debugPrint('🔄 Attempting registration for user: $username');

      final response = await _apiService.post('/auth/register', {
        'username': username,
        'password': password,
        'name': name,
        'role': role,
      });

      if (response['success'] == true) {
        final data = response['data'] as Map<String, dynamic>;
        debugPrint('✅ Registration successful for user: ${data['username']}');
        return data;
      } else {
        throw Exception('Registration failed');
      }
    } catch (e) {
      debugPrint('❌ Registration error: $e');
      throw Exception('Registration failed: $e');
    }
  }

  // Logout
  void logout() {
    _apiService.clearToken();
    debugPrint('✅ User logged out');
  }
}
