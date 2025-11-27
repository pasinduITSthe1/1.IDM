import 'dart:convert';
import 'package:http/http.dart' as http;
import '../models/room_change.dart';
import '../utils/network_config.dart';

class RoomChangeService {
  String get baseUrl => '${NetworkConfig.wampBaseUrl}/api/room-change.php';

  /// Get all room changes with optional status filter
  Future<List<RoomChange>> getAllRoomChanges({
    String? status,
    int limit = 100,
    int offset = 0,
  }) async {
    try {
      var uri = Uri.parse(baseUrl);
      final queryParams = <String, String>{
        'action': 'list',
        'limit': limit.toString(),
        'offset': offset.toString(),
      };

      if (status != null && status.isNotEmpty) {
        queryParams['status'] = status;
      }

      uri = uri.replace(queryParameters: queryParams);

      final response = await http.get(uri).timeout(
            NetworkConfig.connectionTimeout,
          );

      if (response.statusCode == 200) {
        final data = json.decode(response.body);
        if (data['success'] == true) {
          final List<dynamic> changesJson = data['data'];
          return changesJson.map((json) => RoomChange.fromJson(json)).toList();
        }
      }
      throw Exception('Failed to load room changes');
    } catch (e) {
      throw Exception('Error fetching room changes: $e');
    }
  }

  /// Get room change by ID
  Future<RoomChange?> getRoomChangeById(int id) async {
    try {
      final response = await http
          .get(
            Uri.parse('$baseUrl?action=get&id=$id'),
          )
          .timeout(NetworkConfig.connectionTimeout);

      if (response.statusCode == 200) {
        final data = json.decode(response.body);
        if (data['success'] == true && data['data'] != null) {
          return RoomChange.fromJson(data['data']);
        }
      }
      return null;
    } catch (e) {
      throw Exception('Error fetching room change: $e');
    }
  }

  /// Get available rooms for a specific date range
  Future<List<AvailableRoom>> getAvailableRooms({
    required DateTime checkIn,
    required DateTime checkOut,
    int? hotelId,
  }) async {
    try {
      final queryParams = <String, String>{
        'action': 'available-rooms',
        'check_in': checkIn.toIso8601String().split('T')[0],
        'check_out': checkOut.toIso8601String().split('T')[0],
      };

      if (hotelId != null) {
        queryParams['hotel_id'] = hotelId.toString();
      }

      final uri = Uri.parse(baseUrl).replace(queryParameters: queryParams);
      final response = await http.get(uri).timeout(
            NetworkConfig.connectionTimeout,
          );

      if (response.statusCode == 200) {
        final data = json.decode(response.body);
        if (data['success'] == true) {
          final List<dynamic> roomsJson = data['data'];
          return roomsJson.map((json) => AvailableRoom.fromJson(json)).toList();
        }
      }
      throw Exception('Failed to load available rooms');
    } catch (e) {
      throw Exception('Error fetching available rooms: $e');
    }
  }

  /// Get currently occupied rooms
  Future<List<OccupiedRoom>> getOccupiedRooms() async {
    try {
      final response = await http
          .get(
            Uri.parse('$baseUrl?action=occupied-rooms'),
          )
          .timeout(NetworkConfig.connectionTimeout);

      if (response.statusCode == 200) {
        final data = json.decode(response.body);
        if (data['success'] == true) {
          final List<dynamic> roomsJson = data['data'];
          return roomsJson.map((json) => OccupiedRoom.fromJson(json)).toList();
        }
      }
      throw Exception('Failed to load occupied rooms');
    } catch (e) {
      throw Exception('Error fetching occupied rooms: $e');
    }
  }

  /// Get room change statistics
  Future<RoomChangeStatistics> getStatistics() async {
    try {
      final response = await http
          .get(
            Uri.parse('$baseUrl?action=statistics'),
          )
          .timeout(NetworkConfig.connectionTimeout);

      if (response.statusCode == 200) {
        final data = json.decode(response.body);
        if (data['success'] == true) {
          return RoomChangeStatistics.fromJson(data['data']);
        }
      }
      throw Exception('Failed to load statistics');
    } catch (e) {
      throw Exception('Error fetching statistics: $e');
    }
  }

  /// Get recent room changes
  Future<List<RoomChange>> getRecentChanges({int limit = 10}) async {
    try {
      final response = await http
          .get(
            Uri.parse('$baseUrl?action=recent&limit=$limit'),
          )
          .timeout(NetworkConfig.connectionTimeout);

      if (response.statusCode == 200) {
        final data = json.decode(response.body);
        if (data['success'] == true) {
          final List<dynamic> changesJson = data['data'];
          return changesJson.map((json) => RoomChange.fromJson(json)).toList();
        }
      }
      throw Exception('Failed to load recent changes');
    } catch (e) {
      throw Exception('Error fetching recent changes: $e');
    }
  }

  /// Create a new room change request
  Future<Map<String, dynamic>> createRoomChange(
    RoomChangeRequest request,
  ) async {
    try {
      final response = await http
          .post(
            Uri.parse(baseUrl),
            headers: {'Content-Type': 'application/json'},
            body: json.encode(request.toJson()),
          )
          .timeout(NetworkConfig.connectionTimeout);

      if (response.statusCode == 200) {
        final data = json.decode(response.body);
        return data;
      }
      throw Exception('Failed to create room change');
    } catch (e) {
      throw Exception('Error creating room change: $e');
    }
  }

  /// Update room change status
  Future<bool> updateRoomChangeStatus({
    required int id,
    required String status,
    String? notes,
  }) async {
    try {
      final response = await http
          .post(
            Uri.parse(baseUrl),
            headers: {'Content-Type': 'application/json'},
            body: json.encode({
              'action': 'update-status',
              'id': id,
              'status': status,
              'notes': notes,
            }),
          )
          .timeout(NetworkConfig.connectionTimeout);

      if (response.statusCode == 200) {
        final data = json.decode(response.body);
        return data['success'] == true;
      }
      return false;
    } catch (e) {
      throw Exception('Error updating room change status: $e');
    }
  }

  /// Helper: Mark room change as completed
  Future<bool> completeRoomChange(int id, {String? notes}) async {
    return await updateRoomChangeStatus(
      id: id,
      status: 'completed',
      notes: notes,
    );
  }

  /// Helper: Cancel room change
  Future<bool> cancelRoomChange(int id, {String? notes}) async {
    return await updateRoomChangeStatus(
      id: id,
      status: 'cancelled',
      notes: notes,
    );
  }
}
