import 'dart:convert';
import 'package:http/http.dart' as http;
import '../utils/network_config.dart';

class DirectCustomerService {
  // Using centralized network configuration
  static String get _baseUrl => NetworkConfig.wampBaseUrl;

  /// Create a new customer directly in the database
  Future<Map<String, dynamic>> createCustomer({
    required String firstName,
    required String lastName,
    String? email,
    String? phone,
    String? dateOfBirth,
    String? address1,
    String? address2,
    String? city,
    String? postcode,
    String? company,
  }) async {
    try {
      final url = Uri.parse('$_baseUrl/src/api/add-customer-api.php');

      final Map<String, dynamic> customerData = {
        'firstName': firstName,
        'lastName': lastName,
        if (email != null) 'email': email,
        if (phone != null) 'phone': phone,
        if (dateOfBirth != null) 'dateOfBirth': dateOfBirth,
        if (address1 != null) 'address1': address1,
        if (address2 != null) 'address2': address2,
        if (city != null) 'city': city,
        if (postcode != null) 'postcode': postcode,
        if (company != null) 'company': company,
      };

      print('📡 Direct API POST: $url');
      print('📤 Request Data: ${json.encode(customerData)}');

      final response = await http.post(
        url,
        headers: {
          'Content-Type': 'application/json',
        },
        body: json.encode(customerData),
      );

      print('📥 Response status: ${response.statusCode}');
      print('📥 Response body: ${response.body}');

      if (response.statusCode == 200) {
        final responseData = json.decode(response.body);

        if (responseData['success'] == true) {
          return {
            'success': true,
            'customer': responseData['customer'],
            'message': responseData['message'],
          };
        } else {
          throw Exception('API Error: ${responseData['message']}');
        }
      } else {
        throw Exception('HTTP Error: ${response.statusCode}');
      }
    } catch (e) {
      print('❌ Direct Customer API error: $e');
      throw Exception('Network error: $e');
    }
  }

  /// Get customer by ID
  Future<Map<String, dynamic>?> getCustomer(int customerId) async {
    try {
      final url =
          Uri.parse('$_baseUrl/src/api/customers-api.php?id=$customerId');

      final response = await http.get(url);

      if (response.statusCode == 200) {
        final List<dynamic> customers = json.decode(response.body);
        if (customers.isNotEmpty) {
          return customers.first;
        }
      }
      return null;
    } catch (e) {
      print('❌ Error fetching customer: $e');
      return null;
    }
  }
}
