import 'dart:convert';
import 'package:http/http.dart' as http;
import 'package:flutter/foundation.dart';
import '../utils/api_config.dart';

class ApiService {
  // Singleton pattern
  static final ApiService _instance = ApiService._internal();
  factory ApiService() => _instance;
  ApiService._internal();

  static String get baseUrl => ApiConfig.baseUrl;

  String? _token;

  // Set authentication token
  void setToken(String token) {
    _token = token;
    debugPrint('✅ API token set: ${token.substring(0, 20)}...');
  }

  // Clear authentication token
  void clearToken() {
    _token = null;
    debugPrint('🗑️ API token cleared');
  }

  // Get current token (for debugging)
  String? get token => _token;

  // Get headers with authentication
  Map<String, String> _getHeaders() {
    final headers = {
      'Content-Type': 'application/json',
    };
    if (_token != null) {
      headers['Authorization'] = 'Bearer $_token';
      debugPrint('🔑 Using token: ${_token!.substring(0, 20)}...');
    } else {
      debugPrint('⚠️ No token available for request');
    }
    return headers;
  }

  // Generic GET request
  Future<Map<String, dynamic>> get(String endpoint) async {
    try {
      debugPrint('📡 GET: $baseUrl$endpoint');
      final response = await http.get(
        Uri.parse('$baseUrl$endpoint'),
        headers: _getHeaders(),
      );

      debugPrint('📥 Response status: ${response.statusCode}');
      return _handleResponse(response);
    } catch (e) {
      debugPrint('❌ GET error: $e');
      throw Exception('Network error: $e');
    }
  }

  // Generic POST request
  Future<Map<String, dynamic>> post(
    String endpoint,
    Map<String, dynamic> data,
  ) async {
    try {
      debugPrint('📡 POST: $baseUrl$endpoint');
      debugPrint('📤 Data: ${jsonEncode(data)}');

      final response = await http.post(
        Uri.parse('$baseUrl$endpoint'),
        headers: _getHeaders(),
        body: jsonEncode(data),
      );

      debugPrint('📥 Response status: ${response.statusCode}');
      return _handleResponse(response);
    } catch (e) {
      debugPrint('❌ POST error: $e');
      throw Exception('Network error: $e');
    }
  }

  // Generic PUT request
  Future<Map<String, dynamic>> put(
    String endpoint,
    Map<String, dynamic> data,
  ) async {
    try {
      debugPrint('📡 PUT: $baseUrl$endpoint');
      debugPrint('📤 Data: ${jsonEncode(data)}');

      final response = await http.put(
        Uri.parse('$baseUrl$endpoint'),
        headers: _getHeaders(),
        body: jsonEncode(data),
      );

      debugPrint('📥 Response status: ${response.statusCode}');
      return _handleResponse(response);
    } catch (e) {
      debugPrint('❌ PUT error: $e');
      throw Exception('Network error: $e');
    }
  }

  // Generic DELETE request
  Future<Map<String, dynamic>> delete(String endpoint) async {
    try {
      debugPrint('📡 DELETE: $baseUrl$endpoint');

      final response = await http.delete(
        Uri.parse('$baseUrl$endpoint'),
        headers: _getHeaders(),
      );

      debugPrint('📥 Response status: ${response.statusCode}');
      return _handleResponse(response);
    } catch (e) {
      debugPrint('❌ DELETE error: $e');
      throw Exception('Network error: $e');
    }
  }

  // Handle API response
  Map<String, dynamic> _handleResponse(http.Response response) {
    final responseData = jsonDecode(response.body) as Map<String, dynamic>;

    if (response.statusCode >= 200 && response.statusCode < 300) {
      debugPrint('✅ Success: ${responseData['message'] ?? 'OK'}');
      return responseData;
    } else {
      final message = responseData['message'] ?? 'Unknown error';
      debugPrint('❌ Error: $message');
      throw Exception(message);
    }
  }

  // Health check
  Future<bool> checkHealth() async {
    try {
      final response = await get('/health');
      return response['success'] == true;
    } catch (e) {
      debugPrint('❌ Health check failed: $e');
      return false;
    }
  }
}
