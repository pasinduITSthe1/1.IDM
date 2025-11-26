import 'dart:convert';
import 'package:http/http.dart' as http;
import '../models/room_change.dart';
import '../models/room.dart';
import '../utils/network_config.dart';

class RoomChangeService {
  static String get _baseUrl => '${NetworkConfig.wampBaseUrl}/api/room-change.php';

  /// Get all room changes with optional filters
  static Future<List<RoomChange>> getAllRoomChanges({
    String? status,
    int limit = 100,
    int offset = 0,
  }) async {
    try {
      final Map<String, String> params = {
        'action': 'get-all',
        'limit': limit.toString(),
        'offset': offset.toString(),
      };

      if (status != null && status.isNotEmpty) {
        params['status'] = status;
      }

      final uri = Uri.parse(_baseUrl).replace(queryParameters: params);
      final response = await http.get(
        uri,
        headers: {'Content-Type': 'application/json'},
      ).timeout(NetworkConfig.connectionTimeout);

      if (response.statusCode == 200) {
        final Map<String, dynamic> jsonResponse = json.decode(response.body);

        if (jsonResponse['success'] == true) {
          final List<dynamic> data = jsonResponse['data'] ?? [];
          return data.map((json) => RoomChange.fromJson(json)).toList();
        } else {
          throw Exception(
              jsonResponse['message'] ?? 'Failed to fetch room changes');
        }
      } else {
        throw Exception(
            'Server error: ${response.statusCode} - ${response.body}');
      }
    } catch (e) {
      throw Exception('Failed to get room changes: $e');
    }
  }

  /// Get room change by ID
  static Future<RoomChange?> getRoomChangeById(int id) async {
    try {
      final uri = Uri.parse(_baseUrl).replace(queryParameters: {
        'action': 'get-by-id',
        'id': id.toString(),
      });

      final response = await http.get(
        uri,
        headers: {'Content-Type': 'application/json'},
      ).timeout(NetworkConfig.connectionTimeout);

      if (response.statusCode == 200) {
        final Map<String, dynamic> jsonResponse = json.decode(response.body);

        if (jsonResponse['success'] == true && jsonResponse['data'] != null) {
          return RoomChange.fromJson(jsonResponse['data']);
        }
        return null;
      } else {
        throw Exception(
            'Server error: ${response.statusCode} - ${response.body}');
      }
    } catch (e) {
      throw Exception('Failed to get room change: $e');
    }
  }

  /// Get room changes for a specific booking
  static Future<List<RoomChange>> getRoomChangesByBookingId(
      int bookingId) async {
    try {
      final uri = Uri.parse(_baseUrl).replace(queryParameters: {
        'action': 'get-by-booking',
        'booking_id': bookingId.toString(),
      });

      final response = await http.get(
        uri,
        headers: {'Content-Type': 'application/json'},
      ).timeout(NetworkConfig.connectionTimeout);

      if (response.statusCode == 200) {
        final Map<String, dynamic> jsonResponse = json.decode(response.body);

        if (jsonResponse['success'] == true) {
          final List<dynamic> data = jsonResponse['data'] ?? [];
          return data.map((json) => RoomChange.fromJson(json)).toList();
        } else {
          throw Exception(
              jsonResponse['message'] ?? 'Failed to fetch room changes');
        }
      } else {
        throw Exception(
            'Server error: ${response.statusCode} - ${response.body}');
      }
    } catch (e) {
      throw Exception('Failed to get room changes by booking: $e');
    }
  }

  /// Get available rooms for room change
  static Future<List<Room>> getAvailableRoomsForChange({
    required String checkInDate,
    required String checkOutDate,
    required int currentRoomId,
  }) async {
    try {
      final uri = Uri.parse(_baseUrl).replace(queryParameters: {
        'action': 'available-rooms',
        'check_in_date': checkInDate,
        'check_out_date': checkOutDate,
        'current_room_id': currentRoomId.toString(),
      });

      final response = await http.get(
        uri,
        headers: {'Content-Type': 'application/json'},
      ).timeout(NetworkConfig.connectionTimeout);

      if (response.statusCode == 200) {
        final Map<String, dynamic> jsonResponse = json.decode(response.body);

        if (jsonResponse['success'] == true) {
          final List<dynamic> data = jsonResponse['data'] ?? [];
          // Convert to simplified Room objects
          return data.map((json) {
            return Room(
              id: int.parse(json['id'].toString()),
              idProduct: int.parse(json['id_product'].toString()),
              idHotel: int.parse(json['id_hotel'].toString()),
              roomNum: json['room_num'].toString(),
              roomStatus: int.parse(json['room_status'].toString()),
              floor: json['floor']?.toString(),
              hotelName: json['hotel_name'].toString(),
              roomTypeId: int.parse(json['id_product'].toString()),
              roomTypeName: json['room_type_name'].toString(),
              description: json['description']?.toString(),
              isOccupied: 0,
              currentStatus: 'available',
              statusColor: '#28a745',
            );
          }).toList();
        } else {
          throw Exception(jsonResponse['message'] ??
              'Failed to fetch available rooms');
        }
      } else {
        throw Exception(
            'Server error: ${response.statusCode} - ${response.body}');
      }
    } catch (e) {
      throw Exception('Failed to get available rooms: $e');
    }
  }

  /// Create a new room change
  static Future<Map<String, dynamic>> createRoomChange(
      RoomChangeRequest request) async {
    try {
      final response = await http.post(
        Uri.parse(_baseUrl),
        headers: {'Content-Type': 'application/json'},
        body: json.encode(request.toJson()),
      ).timeout(NetworkConfig.connectionTimeout);

      if (response.statusCode == 200) {
        final Map<String, dynamic> jsonResponse = json.decode(response.body);
        return jsonResponse;
      } else {
        throw Exception(
            'Server error: ${response.statusCode} - ${response.body}');
      }
    } catch (e) {
      throw Exception('Failed to create room change: $e');
    }
  }

  /// Update room change status
  static Future<Map<String, dynamic>> updateRoomChangeStatus({
    required int id,
    required String status,
    String? notes,
  }) async {
    try {
      final Map<String, dynamic> body = {
        'action': 'update-status',
        'id': id,
        'status': status,
      };

      if (notes != null && notes.isNotEmpty) {
        body['notes'] = notes;
      }

      final response = await http.post(
        Uri.parse(_baseUrl),
        headers: {'Content-Type': 'application/json'},
        body: json.encode(body),
      ).timeout(NetworkConfig.connectionTimeout);

      if (response.statusCode == 200) {
        final Map<String, dynamic> jsonResponse = json.decode(response.body);
        return jsonResponse;
      } else {
        throw Exception(
            'Server error: ${response.statusCode} - ${response.body}');
      }
    } catch (e) {
      throw Exception('Failed to update room change status: $e');
    }
  }

  /// Get room change statistics
  static Future<RoomChangeStatistics> getRoomChangeStatistics({
    String? startDate,
    String? endDate,
  }) async {
    try {
      final Map<String, String> params = {'action': 'statistics'};

      if (startDate != null && startDate.isNotEmpty) {
        params['start_date'] = startDate;
      }

      if (endDate != null && endDate.isNotEmpty) {
        params['end_date'] = endDate;
      }

      final uri = Uri.parse(_baseUrl).replace(queryParameters: params);
      final response = await http.get(
        uri,
        headers: {'Content-Type': 'application/json'},
      ).timeout(NetworkConfig.connectionTimeout);

      if (response.statusCode == 200) {
        final Map<String, dynamic> jsonResponse = json.decode(response.body);

        if (jsonResponse['success'] == true && jsonResponse['data'] != null) {
          return RoomChangeStatistics.fromJson(jsonResponse['data']);
        } else {
          throw Exception(
              jsonResponse['message'] ?? 'Failed to fetch statistics');
        }
      } else {
        throw Exception(
            'Server error: ${response.statusCode} - ${response.body}');
      }
    } catch (e) {
      throw Exception('Failed to get room change statistics: $e');
    }
  }

  // Helper methods for common operations

  /// Complete a room change
  static Future<Map<String, dynamic>> completeRoomChange(
      int id, String? notes) async {
    return await updateRoomChangeStatus(
      id: id,
      status: 'completed',
      notes: notes,
    );
  }

  /// Cancel a room change
  static Future<Map<String, dynamic>> cancelRoomChange(
      int id, String? notes) async {
    return await updateRoomChangeStatus(
      id: id,
      status: 'cancelled',
      notes: notes,
    );
  }

  /// Get pending room changes
  static Future<List<RoomChange>> getPendingRoomChanges() async {
    return await getAllRoomChanges(status: 'pending');
  }

  /// Get completed room changes
  static Future<List<RoomChange>> getCompletedRoomChanges() async {
    return await getAllRoomChanges(status: 'completed');
  }
}
