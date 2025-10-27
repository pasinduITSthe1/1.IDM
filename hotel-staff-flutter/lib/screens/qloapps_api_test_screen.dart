import 'package:flutter/material.dart';
import '../services/qloapps_api_service.dart';

/// Test screen to verify QloApps API integration
/// This screen demonstrates how to use the QloApps WebService API
class QloAppsApiTestScreen extends StatefulWidget {
  const QloAppsApiTestScreen({super.key});

  @override
  State<QloAppsApiTestScreen> createState() => _QloAppsApiTestScreenState();
}

class _QloAppsApiTestScreenState extends State<QloAppsApiTestScreen> {
  final _api = QloAppsApiService();
  bool _isLoading = false;
  String _result = 'No test run yet';
  String _selectedTest = 'connection';

  final Map<String, String> _tests = {
    'connection': '🔌 Test Connection',
    'schema': '📋 Get API Schema',
    'customers': '👥 Get All Customers',
    'orders': '📦 Get All Orders',
    'products': '🛏️ Get All Products (Rooms)',
    'hotels': '🏨 Get All Hotels',
  };

  Future<void> _runTest(String test) async {
    setState(() {
      _isLoading = true;
      _result = 'Running test...';
    });

    try {
      dynamic result;

      switch (test) {
        case 'connection':
          final isConnected = await _api.testConnection();
          result = isConnected
              ? '✅ Connection successful!\nQloApps API is reachable.'
              : '❌ Connection failed!\nCheck API key and URL.';
          break;

        case 'schema':
          result = await _api.getApiSchema();
          break;

        case 'customers':
          result = await _api
              .getCustomers(filters: {'display': 'full', 'limit': '5'});
          break;

        case 'orders':
          result = await _api.getRecentOrders();
          break;

        case 'products':
          result = await _api.getActiveRooms();
          break;

        case 'hotels':
          result = await _api.getHotels();
          break;
      }

      setState(() {
        _isLoading = false;
        _result = _formatResult(result);
      });
    } catch (e) {
      setState(() {
        _isLoading = false;
        _result = '❌ Error:\n$e';
      });
    }
  }

  String _formatResult(dynamic result) {
    if (result is String) return result;
    if (result is List) {
      return '✅ Found ${result.length} items\n\n' +
          'Sample data:\n${result.take(2).map((e) => e.toString()).join('\n\n')}';
    }
    if (result is Map) {
      return '✅ Response received\n\n$result';
    }
    return result.toString();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('QloApps API Test'),
        backgroundColor: Colors.blue,
        foregroundColor: Colors.white,
      ),
      body: Column(
        children: [
          // Test selector
          Container(
            padding: const EdgeInsets.all(16),
            color: Colors.blue.shade50,
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                const Text(
                  'Select Test to Run:',
                  style: TextStyle(
                    fontSize: 16,
                    fontWeight: FontWeight.bold,
                  ),
                ),
                const SizedBox(height: 12),
                Wrap(
                  spacing: 8,
                  runSpacing: 8,
                  children: _tests.entries.map((entry) {
                    final isSelected = _selectedTest == entry.key;
                    return FilterChip(
                      label: Text(entry.value),
                      selected: isSelected,
                      onSelected: (selected) {
                        setState(() => _selectedTest = entry.key);
                      },
                      backgroundColor: Colors.white,
                      selectedColor: Colors.blue.shade200,
                    );
                  }).toList(),
                ),
                const SizedBox(height: 12),
                SizedBox(
                  width: double.infinity,
                  child: ElevatedButton.icon(
                    onPressed:
                        _isLoading ? null : () => _runTest(_selectedTest),
                    icon: _isLoading
                        ? const SizedBox(
                            width: 20,
                            height: 20,
                            child: CircularProgressIndicator(
                              strokeWidth: 2,
                              color: Colors.white,
                            ),
                          )
                        : const Icon(Icons.play_arrow),
                    label: Text(_isLoading ? 'Running...' : 'Run Test'),
                    style: ElevatedButton.styleFrom(
                      backgroundColor: Colors.blue,
                      foregroundColor: Colors.white,
                      padding: const EdgeInsets.symmetric(vertical: 16),
                    ),
                  ),
                ),
              ],
            ),
          ),

          // Result display
          Expanded(
            child: SingleChildScrollView(
              padding: const EdgeInsets.all(16),
              child: Container(
                width: double.infinity,
                padding: const EdgeInsets.all(16),
                decoration: BoxDecoration(
                  color: Colors.grey.shade100,
                  borderRadius: BorderRadius.circular(8),
                  border: Border.all(color: Colors.grey.shade300),
                ),
                child: SelectableText(
                  _result,
                  style: const TextStyle(
                    fontFamily: 'monospace',
                    fontSize: 12,
                  ),
                ),
              ),
            ),
          ),

          // Instructions
          Container(
            padding: const EdgeInsets.all(16),
            color: Colors.orange.shade50,
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Row(
                  children: [
                    Icon(Icons.info_outline, color: Colors.orange.shade700),
                    const SizedBox(width: 8),
                    Text(
                      'Setup Instructions',
                      style: TextStyle(
                        fontSize: 16,
                        fontWeight: FontWeight.bold,
                        color: Colors.orange.shade700,
                      ),
                    ),
                  ],
                ),
                const SizedBox(height: 8),
                Text(
                  '1. Go to QloApps Admin: Advanced Parameters > Webservice\n'
                  '2. Click "Add new" and generate an API key\n'
                  '3. Set permissions for: customers, orders, products, hotels\n'
                  '4. Update API_KEY in lib/services/qloapps_api_service.dart\n'
                  '5. Run "Connection Test" to verify setup',
                  style: TextStyle(
                    fontSize: 12,
                    color: Colors.orange.shade900,
                  ),
                ),
              ],
            ),
          ),
        ],
      ),
    );
  }
}
