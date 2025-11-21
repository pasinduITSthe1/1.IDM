import 'dart:convert';
import 'package:dio/dio.dart';
import 'package:flutter/foundation.dart';
import '../utils/network_config.dart';

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

  late final Dio _dio;

  QloAppsApiService._internal() {
    // Initialize Dio with custom configuration
    _dio = Dio(BaseOptions(
      baseUrl: baseUrl,
      connectTimeout: const Duration(seconds: 10),
      receiveTimeout: const Duration(seconds: 10),
      headers: _getHeaders(),
      validateStatus: (status) => status != null && status < 500,
    ));

    // Add interceptor for debugging
    _dio.interceptors.add(LogInterceptor(
      requestBody: true,
      responseBody: true,
      logPrint: (obj) => debugPrint(obj.toString()),
    ));
  }

  // ⚙️ CONFIGURATION - Update IP in network_config.dart
  static String get baseUrl => NetworkConfig.qloAppsBaseUrl;

  static const String apiKey =
      '2WUGS9C92CRCSJ1IJME9ST1DFCFDD3C4'; // ✅ API Key configured!

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

      debugPrint('📡 QloApps GET: $baseUrl/$endpoint');
      debugPrint('📋 Params: $queryParams');

      final response = await _dio.get(
        '/$endpoint',
        queryParameters: queryParams,
      );

      return _handleResponse(response);
    } catch (e) {
      debugPrint('❌ QloApps GET error: $e');
      if (e is DioException) {
        debugPrint('   Type: ${e.type}');
        debugPrint('   Message: ${e.message}');
      }
      throw Exception('Network error: $e');
    }
  }

  /// Generic POST request (with XML body)
  Future<Map<String, dynamic>> post(
    String resource,
    String xmlData,
  ) async {
    try {
      debugPrint('📡 QloApps POST: $baseUrl/$resource');
      debugPrint(
          '📤 XML Data: ${xmlData.substring(0, xmlData.length > 200 ? 200 : xmlData.length)}...');

      final response = await _dio.post(
        '/$resource',
        data: xmlData,
        queryParameters: {'output_format': 'JSON'},
        options: Options(
          headers: _getHeaders(isXml: true),
          contentType: 'application/xml',
        ),
      );

      return _handleResponse(response);
    } catch (e) {
      debugPrint('❌ QloApps POST error: $e');
      if (e is DioException) {
        debugPrint('   Type: ${e.type}');
        debugPrint('   Message: ${e.message}');
      }
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
      debugPrint('📡 QloApps PUT: $baseUrl/$resource/$resourceId');

      final response = await _dio.put(
        '/$resource/$resourceId',
        data: xmlData,
        queryParameters: {'output_format': 'JSON'},
        options: Options(
          headers: _getHeaders(isXml: true),
          contentType: 'application/xml',
        ),
      );

      return _handleResponse(response);
    } catch (e) {
      debugPrint('❌ QloApps PUT error: $e');
      if (e is DioException) {
        debugPrint('   Type: ${e.type}');
        debugPrint('   Message: ${e.message}');
      }
      throw Exception('Network error: $e');
    }
  }

  /// Generic DELETE request
  Future<Map<String, dynamic>> delete(
    String resource,
    String resourceId,
  ) async {
    try {
      debugPrint('📡 QloApps DELETE: $baseUrl/$resource/$resourceId');

      final response = await _dio.delete(
        '/$resource/$resourceId',
        queryParameters: {'output_format': 'JSON'},
      );

      return _handleResponse(response);
    } catch (e) {
      debugPrint('❌ QloApps DELETE error: $e');
      if (e is DioException) {
        debugPrint('   Type: ${e.type}');
        debugPrint('   Message: ${e.message}');
      }
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
    String? email,
    required String password,
    String? phone,
    String? dateOfBirth,
  }) async {
    // Generate a temporary email if not provided (required by QloApps)
    final customerEmail =
        email ?? 'guest${DateTime.now().millisecondsSinceEpoch}@temp.local';

    final xml = _buildCustomerXml(
      firstName: firstName,
      lastName: lastName,
      email: customerEmail,
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
      id: customerId, // ✅ Include ID for update
      firstName: updated['firstname'],
      lastName: updated['lastname'],
      email: updated['email'],
      password: updated['passwd'], // ✅ Include existing encrypted password
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
    int? id, // ✅ Required for updates
    required String firstName,
    required String lastName,
    required String email,
    String? password,
    String? phone,
    String? dateOfBirth,
  }) {
    // ✅ QloApps requires phone - use default if not provided
    final phoneNumber = phone ?? '0000000000';

    return '''<?xml version="1.0" encoding="UTF-8"?>
<prestashop xmlns:xlink="http://www.w3.org/1999/xlink">
  <customer>
    ${id != null ? '<id>$id</id>' : ''}
    <firstname><![CDATA[$firstName]]></firstname>
    <lastname><![CDATA[$lastName]]></lastname>
    <email><![CDATA[$email]]></email>
    ${password != null ? '<passwd><![CDATA[$password]]></passwd>' : ''}
    <phone><![CDATA[$phoneNumber]]></phone>
    ${dateOfBirth != null ? '<birthday>$dateOfBirth</birthday>' : ''}
    <id_default_group>3</id_default_group>
    <active>1</active>
  </customer>
</prestashop>''';
  }

  // ==================== RESPONSE HANDLER ====================

  /// Handle API response
  Map<String, dynamic> _handleResponse(Response response) {
    debugPrint('📥 Response status: ${response.statusCode}');

    if (response.statusCode != null &&
        response.statusCode! >= 200 &&
        response.statusCode! < 300) {
      try {
        // Dio already parses JSON automatically
        if (response.data is Map) {
          debugPrint('✅ Success');
          return response.data as Map<String, dynamic>;
        } else if (response.data is String) {
          final data = jsonDecode(response.data) as Map<String, dynamic>;
          debugPrint('✅ Success');
          return data;
        }
        return {'success': true, 'data': response.data};
      } catch (e) {
        debugPrint('⚠️ JSON decode error: $e');
        return {'success': true, 'raw': response.data.toString()};
      }
    } else {
      debugPrint('❌ Error: ${response.data}');

      // Try to parse error message
      try {
        final error =
            response.data is String ? jsonDecode(response.data) : response.data;
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
      final response = await _dio.get(
        '',
        queryParameters: {'output_format': 'JSON'},
      );
      return _handleResponse(response);
    } catch (e) {
      debugPrint('❌ Schema error: $e');
      return {};
    }
  }

  // ==================== HOTEL OPERATIONS (JSON API) ====================

  /// Record guest check-in to hotel backend
  Future<Map<String, dynamic>> checkInGuest({
    required int customerId,
    required int bookingId,
    required int roomId,
    required String roomNumber,
    required String checkInTime,
    required String checkInMethod,
    required String checkedInBy,
    required String notes,
  }) async {
    try {
      debugPrint('📤 Recording check-in to hotel backend...');
      debugPrint('   Customer ID: $customerId');
      debugPrint('   Room: $roomNumber');

      final response = await _dio.post(
        '/hotel/checkins',
        data: {
          'id_customer': customerId,
          'id_booking': bookingId,
          'id_room': roomId,
          'room_number': roomNumber,
          'check_in_time': checkInTime,
          'check_in_method': checkInMethod,
          'checked_in_by': checkedInBy,
          'notes': notes,
        },
        queryParameters: {'output_format': 'JSON'},
      );

      debugPrint('✅ Check-in recorded successfully');
      return _handleResponse(response);
    } catch (e) {
      debugPrint('❌ Check-in recording failed: $e');
      rethrow;
    }
  }

  /// Record guest checkout to hotel backend
  Future<Map<String, dynamic>> checkOutGuest({
    required int customerId,
    required String checkOutTime,
    required double totalAmount,
    required String paymentStatus,
    required String paymentMethod,
    required String notes,
  }) async {
    try {
      debugPrint('📤 Recording check-out to hotel backend...');
      debugPrint('   Customer ID: $customerId');
      debugPrint('   Total: \$$totalAmount');

      final response = await _dio.post(
        '/hotel/checkouts',
        data: {
          'id_customer': customerId,
          'check_out_time': checkOutTime,
          'total_amount': totalAmount,
          'payment_status': paymentStatus,
          'payment_method': paymentMethod,
          'notes': notes,
        },
        queryParameters: {'output_format': 'JSON'},
      );

      debugPrint('✅ Check-out recorded successfully');
      return _handleResponse(response);
    } catch (e) {
      debugPrint('❌ Check-out recording failed: $e');
      rethrow;
    }
  }

  /// Record payment
  Future<Map<String, dynamic>> recordPayment({
    required int customerId,
    required double amount,
    required String paymentMethod,
    required String notes,
  }) async {
    try {
      debugPrint('📤 Recording payment...');
      debugPrint('   Amount: \$$amount');

      final response = await _dio.post(
        '/hotel/payments',
        data: {
          'id_customer': customerId,
          'amount': amount,
          'payment_method': paymentMethod,
          'notes': notes,
        },
        queryParameters: {'output_format': 'JSON'},
      );

      debugPrint('✅ Payment recorded successfully');
      return _handleResponse(response);
    } catch (e) {
      debugPrint('❌ Payment recording failed: $e');
      rethrow;
    }
  }
}
