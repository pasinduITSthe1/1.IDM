import 'dart:convert';
import 'package:http/http.dart' as http;
import '../models/room.dart';
import '../utils/network_config.dart';

class RoomService {
  String get baseUrl => NetworkConfig.roomsApiUrl;

  // Get all rooms
  Future<List<Room>> getAllRooms() async {
    try {
      final response = await http.get(Uri.parse(baseUrl));

      if (response.statusCode == 200) {
        final data = json.decode(response.body);
        if (data['success'] == true) {
          final List<dynamic> roomsJson = data['data'];
          return roomsJson.map((json) => Room.fromJson(json)).toList();
        }
      }
      throw Exception('Failed to load rooms');
    } catch (e) {
      throw Exception('Error fetching rooms: $e');
    }
  }

  // Get room statistics
  Future<RoomStatistics> getRoomStatistics() async {
    try {
      final response = await http.get(
        Uri.parse('$baseUrl?action=statistics'),
      );

      if (response.statusCode == 200) {
        final data = json.decode(response.body);
        if (data['success'] == true) {
          return RoomStatistics.fromJson(data['data']);
        }
      }
      throw Exception('Failed to load statistics');
    } catch (e) {
      throw Exception('Error fetching statistics: $e');
    }
  }

  // Get today's check-ins
  Future<List<TodayCheckInOut>> getTodayCheckIns() async {
    try {
      final response = await http.get(
        Uri.parse('$baseUrl?action=today-checkins'),
      );

      if (response.statusCode == 200) {
        final data = json.decode(response.body);
        if (data['success'] == true) {
          final List<dynamic> checkInsJson = data['data'];
          return checkInsJson
              .map((json) => TodayCheckInOut.fromJson(json))
              .toList();
        }
      }
      throw Exception('Failed to load check-ins');
    } catch (e) {
      throw Exception('Error fetching check-ins: $e');
    }
  }

  // Get today's check-outs
  Future<List<TodayCheckInOut>> getTodayCheckOuts() async {
    try {
      final response = await http.get(
        Uri.parse('$baseUrl?action=today-checkouts'),
      );

      if (response.statusCode == 200) {
        final data = json.decode(response.body);
        if (data['success'] == true) {
          final List<dynamic> checkOutsJson = data['data'];
          return checkOutsJson
              .map((json) => TodayCheckInOut.fromJson(json))
              .toList();
        }
      }
      throw Exception('Failed to load check-outs');
    } catch (e) {
      throw Exception('Error fetching check-outs: $e');
    }
  }

  // Get room by ID
  Future<Room?> getRoomById(int roomId) async {
    try {
      final response = await http.get(
        Uri.parse('$baseUrl?action=get-room&id=$roomId'),
      );

      if (response.statusCode == 200) {
        final data = json.decode(response.body);
        if (data['success'] == true && data['data'] != null) {
          return Room.fromJson(data['data']);
        }
      }
      return null;
    } catch (e) {
      throw Exception('Error fetching room: $e');
    }
  }

  // Update room status
  // Status codes: 1=Available, 2=Occupied, 3=Cleaning, 4=Maintenance, 5=Reserved
  Future<bool> updateRoomStatus(int roomId, int status) async {
    try {
      final response = await http.post(
        Uri.parse(baseUrl),
        headers: {'Content-Type': 'application/json'},
        body: json.encode({
          'action': 'update-status',
          'room_id': roomId,
          'status': status,
        }),
      );

      if (response.statusCode == 200) {
        final data = json.decode(response.body);
        return data['success'] == true;
      }
      return false;
    } catch (e) {
      throw Exception('Error updating room status: $e');
    }
  }

  // Mark room as cleaning
  Future<bool> markAsCleaning(int roomId) async {
    return await updateRoomStatus(roomId, 3);
  }

  // Mark room as available
  Future<bool> markAsAvailable(int roomId) async {
    return await updateRoomStatus(roomId, 1);
  }

  // Mark room as maintenance
  Future<bool> markAsMaintenance(int roomId) async {
    return await updateRoomStatus(roomId, 4);
  }

  // Reset all rooms to available (for testing/admin)
  Future<bool> resetAllRoomsToAvailable() async {
    try {
      final response = await http.get(
        Uri.parse('$baseUrl?action=reset-all-available'),
      );

      if (response.statusCode == 200) {
        final data = json.decode(response.body);
        return data['success'] == true;
      }
      return false;
    } catch (e) {
      throw Exception('Error resetting rooms: $e');
    }
  }
}
