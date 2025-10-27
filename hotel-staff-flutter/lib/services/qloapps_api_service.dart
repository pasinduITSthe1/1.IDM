import 'dart:convert';
import 'package:http/http.dart' as http;
import 'package:flutter/foundation.dart';

/// QloApps WebService API Service
/// Direct integration with QloApps built-in API (no Node.js middleware)
///
/// Setup Instructions:
/// 1. Go to QloApps Admin: Advanced Parameters > Webservice
/// 2. Click "Add new" and generate an API key
/// 3. Set permissions for: customers, addresses, orders, products
/// 4. Replace API_KEY constant below with your generated key
class QloAppsApiService {
  // Singleton pattern
  static final QloAppsApiService _instance = QloAppsApiService._internal();
  factory QloAppsApiService() => _instance;
  QloAppsApiService._internal();

  // ⚙️ CONFIGURATION - Update these values
  static const String baseUrl = 'http://localhost/1.IDM/api';
  static const String apiKey =
      'YOUR_QLOAPPS_API_KEY_HERE'; // ⚠️ Replace with your key

  // Get authentication headers
  Map<String, String> _getHeaders({bool isXml = false}) {
    final encodedAuth = base64Encode(utf8.encode('$apiKey:'));
    return {
      'Authorization': 'Basic $encodedAuth',
      'Content-Type': isXml ? 'application/xml' : 'application/json',
    };
  }

  // ==================== GENERIC METHODS ====================

  /// Generic GET request
  Future<Map<String, dynamic>> get(
    String resource, {
    Map<String, String>? params,
    String? resourceId,
  }) async {
    try {
      final queryParams = {
        'output_format': 'JSON',
        ...?params,
      };

      final endpoint = resourceId != null ? '$resource/$resourceId' : resource;
      final uri = Uri.parse('$baseUrl/$endpoint').replace(
        queryParameters: queryParams,
      );

      debugPrint('📡 QloApps GET: $uri');

      final response = await http.get(uri, headers: _getHeaders());
      return _handleResponse(response);
    } catch (e) {
      debugPrint('❌ QloApps GET error: $e');
      throw Exception('Network error: $e');
    }
  }

  /// Generic POST request (with XML body)
  Future<Map<String, dynamic>> post(
    String resource,
    String xmlData,
  ) async {
    try {
      final uri = Uri.parse('$baseUrl/$resource').replace(
        queryParameters: {'output_format': 'JSON'},
      );

      debugPrint('📡 QloApps POST: $uri');
      debugPrint('📤 XML Data: ${xmlData.substring(0, 200)}...');

      final response = await http.post(
        uri,
        headers: _getHeaders(isXml: true),
        body: xmlData,
      );

      return _handleResponse(response);
    } catch (e) {
      debugPrint('❌ QloApps POST error: $e');
      throw Exception('Network error: $e');
    }
  }

  /// Generic PUT request (with XML body)
  Future<Map<String, dynamic>> put(
    String resource,
    String resourceId,
    String xmlData,
  ) async {
    try {
      final uri = Uri.parse('$baseUrl/$resource/$resourceId').replace(
        queryParameters: {'output_format': 'JSON'},
      );

      debugPrint('📡 QloApps PUT: $uri');

      final response = await http.put(
        uri,
        headers: _getHeaders(isXml: true),
        body: xmlData,
      );

      return _handleResponse(response);
    } catch (e) {
      debugPrint('❌ QloApps PUT error: $e');
      throw Exception('Network error: $e');
    }
  }

  /// Generic DELETE request
  Future<Map<String, dynamic>> delete(
    String resource,
    String resourceId,
  ) async {
    try {
      final uri = Uri.parse('$baseUrl/$resource/$resourceId').replace(
        queryParameters: {'output_format': 'JSON'},
      );

      debugPrint('📡 QloApps DELETE: $uri');

      final response = await http.delete(uri, headers: _getHeaders());
      return _handleResponse(response);
    } catch (e) {
      debugPrint('❌ QloApps DELETE error: $e');
      throw Exception('Network error: $e');
    }
  }

  // ==================== CUSTOMER (GUEST) METHODS ====================

  /// Get all customers (guests)
  Future<List<dynamic>> getCustomers({Map<String, String>? filters}) async {
    final response = await get('customers', params: filters);
    return response['customers'] ?? [];
  }

  /// Get customer by ID
  Future<Map<String, dynamic>> getCustomer(int customerId) async {
    final response = await get('customers', resourceId: customerId.toString());
    return response['customer'] ?? {};
  }

  /// Search customer by email
  Future<Map<String, dynamic>?> searchCustomerByEmail(String email) async {
    try {
      final customers = await getCustomers(
        filters: {
          'filter[email]': '[$email]',
          'display': 'full',
        },
      );
      return customers.isNotEmpty ? customers.first : null;
    } catch (e) {
      debugPrint('❌ Search customer error: $e');
      return null;
    }
  }

  /// Create new customer (guest)
  Future<Map<String, dynamic>> createCustomer({
    required String firstName,
    required String lastName,
    required String email,
    required String password,
    String? phone,
    String? dateOfBirth,
  }) async {
    final xml = _buildCustomerXml(
      firstName: firstName,
      lastName: lastName,
      email: email,
      password: password,
      phone: phone,
      dateOfBirth: dateOfBirth,
    );
    return await post('customers', xml);
  }

  /// Update existing customer
  Future<Map<String, dynamic>> updateCustomer(
    int customerId,
    Map<String, dynamic> updates,
  ) async {
    // First get existing customer
    final existing = await getCustomer(customerId);

    // Merge updates
    final updated = {...existing, ...updates};

    final xml = _buildCustomerXml(
      firstName: updated['firstname'],
      lastName: updated['lastname'],
      email: updated['email'],
      phone: updated['phone'],
    );

    return await put('customers', customerId.toString(), xml);
  }

  // ==================== ORDER (BOOKING) METHODS ====================

  /// Get all orders (bookings)
  Future<List<dynamic>> getOrders({Map<String, String>? filters}) async {
    final response = await get('orders', params: filters);
    return response['orders'] ?? [];
  }

  /// Get order by ID
  Future<Map<String, dynamic>> getOrder(int orderId) async {
    final response = await get('orders', resourceId: orderId.toString());
    return response['order'] ?? {};
  }

  /// Get recent orders (last 30 days)
  Future<List<dynamic>> getRecentOrders() async {
    final thirtyDaysAgo = DateTime.now().subtract(const Duration(days: 30));
    final dateFilter = thirtyDaysAgo.toIso8601String().split('T')[0];

    return await getOrders(
      filters: {
        'filter[date_add]': '>[$dateFilter]',
        'display': 'full',
        'sort': '[date_add_DESC]',
      },
    );
  }

  /// Get orders by customer ID
  Future<List<dynamic>> getOrdersByCustomer(int customerId) async {
    return await getOrders(
      filters: {
        'filter[id_customer]': '[$customerId]',
        'display': 'full',
      },
    );
  }

  // ==================== PRODUCT (ROOM) METHODS ====================

  /// Get all products (rooms)
  Future<List<dynamic>> getProducts({Map<String, String>? filters}) async {
    final response = await get('products', params: filters);
    return response['products'] ?? [];
  }

  /// Get product by ID
  Future<Map<String, dynamic>> getProduct(int productId) async {
    final response = await get('products', resourceId: productId.toString());
    return response['product'] ?? {};
  }

  /// Get active rooms only
  Future<List<dynamic>> getActiveRooms() async {
    return await getProducts(
      filters: {
        'filter[active]': '[1]',
        'display': 'full',
      },
    );
  }

  // ==================== ADDRESS METHODS ====================

  /// Get all addresses
  Future<List<dynamic>> getAddresses({Map<String, String>? filters}) async {
    final response = await get('addresses', params: filters);
    return response['addresses'] ?? [];
  }

  /// Get address by ID
  Future<Map<String, dynamic>> getAddress(int addressId) async {
    final response = await get('addresses', resourceId: addressId.toString());
    return response['address'] ?? {};
  }

  /// Get addresses by customer ID
  Future<List<dynamic>> getCustomerAddresses(int customerId) async {
    return await getAddresses(
      filters: {
        'filter[id_customer]': '[$customerId]',
        'display': 'full',
      },
    );
  }

  // ==================== HOTEL METHODS ====================

  /// Get all hotels
  Future<List<dynamic>> getHotels() async {
    final response = await get('hotels');
    return response['hotels'] ?? [];
  }

  /// Get hotel by ID
  Future<Map<String, dynamic>> getHotel(int hotelId) async {
    final response = await get('hotels', resourceId: hotelId.toString());
    return response['hotel'] ?? {};
  }

  // ==================== XML BUILDERS ====================

  /// Build XML for customer creation/update
  String _buildCustomerXml({
    required String firstName,
    required String lastName,
    required String email,
    String? password,
    String? phone,
    String? dateOfBirth,
  }) {
    return '''<?xml version="1.0" encoding="UTF-8"?>
<prestashop xmlns:xlink="http://www.w3.org/1999/xlink">
  <customer>
    <firstname><![CDATA[$firstName]]></firstname>
    <lastname><![CDATA[$lastName]]></lastname>
    <email><![CDATA[$email]]></email>
    ${password != null ? '<passwd><![CDATA[$password]]></passwd>' : ''}
    ${phone != null ? '<phone><![CDATA[$phone]]></phone>' : ''}
    ${dateOfBirth != null ? '<birthday>$dateOfBirth</birthday>' : ''}
    <id_default_group>3</id_default_group>
    <active>1</active>
  </customer>
</prestashop>''';
  }

  // ==================== RESPONSE HANDLER ====================

  /// Handle API response
  Map<String, dynamic> _handleResponse(http.Response response) {
    debugPrint('📥 Response status: ${response.statusCode}');

    if (response.statusCode >= 200 && response.statusCode < 300) {
      try {
        final data = jsonDecode(response.body) as Map<String, dynamic>;
        debugPrint('✅ Success');
        return data;
      } catch (e) {
        debugPrint('⚠️ JSON decode error: $e');
        return {'success': true, 'raw': response.body};
      }
    } else {
      debugPrint('❌ Error: ${response.body}');

      // Try to parse error message
      try {
        final error = jsonDecode(response.body);
        final message = error['errors']?[0]?['message'] ?? 'Unknown error';
        throw Exception('QloApps API Error: $message');
      } catch (e) {
        throw Exception('QloApps API Error: ${response.statusCode}');
      }
    }
  }

  // ==================== HEALTH CHECK ====================

  /// Test API connectivity
  Future<bool> testConnection() async {
    try {
      await get('customers', params: {'display': '[id]', 'limit': '1'});
      debugPrint('✅ QloApps API connection successful');
      return true;
    } catch (e) {
      debugPrint('❌ QloApps API connection failed: $e');
      return false;
    }
  }

  /// Get API schema (available resources)
  Future<Map<String, dynamic>> getApiSchema() async {
    try {
      final uri = Uri.parse(baseUrl).replace(
        queryParameters: {'output_format': 'JSON'},
      );

      final response = await http.get(uri, headers: _getHeaders());
      return _handleResponse(response);
    } catch (e) {
      debugPrint('❌ Schema error: $e');
      return {};
    }
  }
}
