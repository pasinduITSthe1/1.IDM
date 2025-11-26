import 'package:flutter/foundation.dart';
import 'package:http/http.dart' as http;
import 'dart:convert';
import '../models/escort.dart';
import '../utils/network_config.dart';

class EscortService {
  // Using centralized network configuration
  static String get baseUrl => NetworkConfig.escortsApiUrl;

  // Add escort to the database
  Future<Map<String, dynamic>> addEscort(Escort escort) async {
    try {
      debugPrint('📤 Adding escort to database...');
      debugPrint('   Name: ${escort.fullName}');
      debugPrint('   Guest ID: ${escort.guestId}');

      final response = await http.post(
        Uri.parse('$baseUrl/escorts'),
        headers: {'Content-Type': 'application/json'},
        body: jsonEncode(escort.toApiJson()),
      );

      if (response.statusCode == 200 || response.statusCode == 201) {
        final data = jsonDecode(response.body);
        debugPrint('✅ Escort added successfully');
        return data;
      } else {
        debugPrint('❌ Failed to add escort: ${response.statusCode}');
        throw Exception('Failed to add escort: ${response.body}');
      }
    } catch (e) {
      debugPrint('❌ Error adding escort: $e');
      rethrow;
    }
  }

  // Get escorts for a specific guest
  Future<List<Escort>> getEscortsForGuest(String guestId) async {
    try {
      debugPrint('📡 Fetching escorts for guest: $guestId');

      final response = await http.get(
        Uri.parse('$baseUrl/escorts/guest/$guestId'),
        headers: {'Content-Type': 'application/json'},
      );

      if (response.statusCode == 200) {
        final List<dynamic> data = jsonDecode(response.body);
        final escorts = data.map((json) => Escort.fromApiJson(json)).toList();
        debugPrint('✅ Loaded ${escorts.length} escorts for guest $guestId');
        return escorts;
      } else {
        debugPrint('⚠️ Failed to load escorts: ${response.statusCode}');
        return [];
      }
    } catch (e) {
      debugPrint('❌ Error fetching escorts: $e');
      return [];
    }
  }

  // Update escort information
  Future<bool> updateEscort(
      String escortId, Map<String, dynamic> updates) async {
    try {
      debugPrint('📤 Updating escort: $escortId');

      final response = await http.put(
        Uri.parse('$baseUrl/escorts/$escortId'),
        headers: {'Content-Type': 'application/json'},
        body: jsonEncode(updates),
      );

      if (response.statusCode == 200) {
        debugPrint('✅ Escort updated successfully');
        return true;
      } else {
        debugPrint('❌ Failed to update escort: ${response.statusCode}');
        return false;
      }
    } catch (e) {
      debugPrint('❌ Error updating escort: $e');
      return false;
    }
  }

  // Delete escort
  Future<bool> deleteEscort(String escortId) async {
    try {
      debugPrint('📤 Deleting escort: $escortId');

      final response = await http.delete(
        Uri.parse('$baseUrl/escorts/$escortId'),
        headers: {'Content-Type': 'application/json'},
      );

      if (response.statusCode == 200) {
        debugPrint('✅ Escort deleted successfully');
        return true;
      } else {
        debugPrint('❌ Failed to delete escort: ${response.statusCode}');
        return false;
      }
    } catch (e) {
      debugPrint('❌ Error deleting escort: $e');
      return false;
    }
  }

  // Get all escorts (for admin purposes)
  Future<List<Escort>> getAllEscorts() async {
    try {
      debugPrint('📡 Fetching all escorts...');

      final response = await http.get(
        Uri.parse('$baseUrl/escorts'),
        headers: {'Content-Type': 'application/json'},
      );

      if (response.statusCode == 200) {
        final List<dynamic> data = jsonDecode(response.body);
        final escorts = data.map((json) => Escort.fromApiJson(json)).toList();
        debugPrint('✅ Loaded ${escorts.length} escorts');
        return escorts;
      } else {
        debugPrint('⚠️ Failed to load escorts: ${response.statusCode}');
        return [];
      }
    } catch (e) {
      debugPrint('❌ Error fetching escorts: $e');
      return [];
    }
  }
}
