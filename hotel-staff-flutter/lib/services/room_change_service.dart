import 'dart:convert';
import 'package:http/http.dart' as http;
import '../models/room_change.dart';
import '../models/room.dart';
import '../utils/network_config.dart';

class RoomChangeService {
  // Use the same working API path as RoomService
  String get baseUrl => NetworkConfig.roomsApiUrl;
  String get roomChangeApiUrl => NetworkConfig.roomChangeApiUrl;

  /// Get currently occupied rooms with guest details using rooms.php API
  Future<List<OccupiedRoom>> getOccupiedRooms() async {
    try {
      print('🏨 RoomChangeService: Fetching from $baseUrl');
      final response = await http.get(
        Uri.parse(baseUrl),
        headers: {'Content-Type': 'application/json'},
      );

      print('🏨 RoomChangeService: Response status ${response.statusCode}');
      print(
          '🏨 RoomChangeService: Response body length: ${response.body.length}');

      if (response.statusCode == 200) {
        final data = json.decode(response.body);

        print('🏨 RoomChangeService: Parsed data success: ${data['success']}');
        print('🏨 RoomChangeService: Data keys: ${data.keys.toList()}');

        if (data['success'] == true && data['data'] is List) {
          List<OccupiedRoom> occupiedRooms = [];

          print(
              '🏨 RoomChangeService: Total rooms in data: ${(data['data'] as List).length}');

          // Filter rooms that have guests (check both isOccupied flag AND current_status)
          List<Room> rooms = (data['data'] as List)
              .map((json) => Room.fromJson(json))
              .where((room) {
            // Room is occupied if:
            // 1. isOccupied flag is 1
            // 2. OR current_status is 'occupied'
            // AND there's a guest name
            final isOccupied = (room.isOccupied == 1 ||
                    room.currentStatus.toLowerCase() == 'occupied') &&
                room.guestName != null &&
                room.guestName!.trim().isNotEmpty;
            print(
                '🏨 Room ${room.roomNum}: occupied=${room.isOccupied}, status=${room.currentStatus}, guest=${room.guestName}, isOccupied=$isOccupied');
            return isOccupied;
          }).toList();

          print(
              '🏨 RoomChangeService: Filtered occupied rooms: ${rooms.length}');

          // Convert Room objects to OccupiedRoom objects
          for (Room room in rooms) {
            occupiedRooms.add(OccupiedRoom(
              bookingId: room.bookingId ?? 0,
              idRoom: room.id,
              idHotel: room.idHotel,
              // Use current date as placeholders since we don't have exact booking dates from rooms API
              dateFrom: DateTime.now().subtract(Duration(days: 1)),
              dateTo: DateTime.now().add(Duration(days: 2)),
              adults: 2, // Default values
              children: 0,
              roomNum: room.roomNum,
              floor: room.floor,
              roomType: room.roomTypeName,
              hotelName: room.hotelName,
              idCustomer: 0, // Customer ID not available from rooms API
              guestName: room.guestName!,
              guestEmail: '',
            ));
          }

          print(
              '🏨 RoomChangeService: Final occupied rooms count: ${occupiedRooms.length}');
          return occupiedRooms;
        } else {
          print('🏨 RoomChangeService: No data or invalid format');
        }
      }
      throw Exception('Failed to load occupied rooms');
    } catch (e) {
      print('🏨 RoomChangeService: Error - $e');
      throw Exception('Error fetching occupied rooms: $e');
    }
  }

  /// Get available rooms using rooms.php API
  Future<List<AvailableRoom>> getAvailableRooms({
    required DateTime checkIn,
    required DateTime checkOut,
    int? hotelId,
  }) async {
    try {
      final response = await http.get(
        Uri.parse(baseUrl),
        headers: {'Content-Type': 'application/json'},
      );

      if (response.statusCode == 200) {
        final data = json.decode(response.body);

        if (data['success'] == true && data['data'] is List) {
          List<AvailableRoom> availableRooms = [];

          // Filter available rooms
          List<Room> rooms = (data['data'] as List)
              .map((json) => Room.fromJson(json))
              .where((room) => room.currentStatus.toLowerCase() == 'available')
              .toList();

          // Convert Room objects to AvailableRoom objects
          for (Room room in rooms) {
            availableRooms.add(AvailableRoom(
              id: room.id,
              idProduct: room.idProduct,
              idHotel: room.idHotel,
              roomNum: room.roomNum,
              floor: room.floor,
              roomType: room.roomTypeName,
              hotelName: room.hotelName,
              roomStatus: 1, // Available status
            ));
          }

          return availableRooms;
        }
      }
      throw Exception('Failed to load available rooms');
    } catch (e) {
      throw Exception('Error fetching available rooms: $e');
    }
  }

  /// Get all room changes
  Future<List<RoomChange>> getAllRoomChanges({
    String? status,
    int limit = 100,
    int offset = 0,
  }) async {
    try {
      String url = roomChangeApiUrl;
      Map<String, String> queryParams = {
        'limit': limit.toString(),
        'offset': offset.toString(),
      };
      if (status != null && status.isNotEmpty) {
        queryParams['status'] = status;
      }

      final uri = Uri.parse(url).replace(queryParameters: queryParams);
      final response = await http.get(uri);

      if (response.statusCode == 200) {
        final data = json.decode(response.body);
        if (data['success'] == true && data['data'] is List) {
          return (data['data'] as List)
              .map((json) => RoomChange.fromJson(json))
              .toList();
        }
      }
      return [];
    } catch (e) {
      print('Error fetching room changes: $e');
      return [];
    }
  }

  /// Create a new room change request
  Future<bool> createRoomChangeRequest({
    required int bookingId,
    required int oldRoomId,
    required int newRoomId,
    required String guestName,
    required String changeReason,
    required String changedBy,
    String? notes,
  }) async {
    try {
      final response = await http.post(
        Uri.parse(roomChangeApiUrl),
        headers: {'Content-Type': 'application/json'},
        body: json.encode({
          'booking_id': bookingId,
          'old_room_id': oldRoomId,
          'new_room_id': newRoomId,
          'guest_name': guestName,
          'change_reason': changeReason,
          'changed_by': changedBy,
          'notes': notes,
        }),
      );

      if (response.statusCode == 200) {
        final data = json.decode(response.body);
        return data['success'] == true;
      }
      return false;
    } catch (e) {
      print('Error creating room change request: $e');
      return false;
    }
  }

  /// Get room change statistics
  Future<RoomChangeStatistics> getStatistics() async {
    try {
      final response = await http.get(
        Uri.parse('$roomChangeApiUrl?action=statistics'),
      );

      if (response.statusCode == 200) {
        final data = json.decode(response.body);
        if (data['success'] == true && data['data'] != null) {
          return RoomChangeStatistics.fromJson(data['data']);
        }
      }
      // Return empty statistics on error
      return RoomChangeStatistics(
        totalChanges: 0,
        pendingChanges: 0,
        completedChanges: 0,
        cancelledChanges: 0,
        todayChanges: 0,
        weekChanges: 0,
        monthChanges: 0,
      );
    } catch (e) {
      print('Error fetching statistics: $e');
      return RoomChangeStatistics(
        totalChanges: 0,
        pendingChanges: 0,
        completedChanges: 0,
        cancelledChanges: 0,
        todayChanges: 0,
        weekChanges: 0,
        monthChanges: 0,
      );
    }
  }

  /// Get recent room changes
  Future<List<RoomChange>> getRecentChanges({int limit = 10}) async {
    try {
      final response = await http.get(
        Uri.parse('$roomChangeApiUrl?action=recent&limit=$limit'),
      );

      if (response.statusCode == 200) {
        final data = json.decode(response.body);
        if (data['success'] == true && data['data'] is List) {
          return (data['data'] as List)
              .map((json) => RoomChange.fromJson(json))
              .toList();
        }
      }
      return [];
    } catch (e) {
      print('Error fetching recent changes: $e');
      return [];
    }
  }

  /// Create a new room change
  Future<Map<String, dynamic>> createRoomChange(
      RoomChangeRequest request) async {
    try {
      print('🏨 Creating room change: ${request.toJson()}');

      final response = await http.post(
        Uri.parse(roomChangeApiUrl),
        headers: {'Content-Type': 'application/json'},
        body: json.encode(request.toJson()),
      );

      print('🏨 Response status: ${response.statusCode}');
      print('🏨 Response body: ${response.body}');

      if (response.statusCode == 200) {
        final data = json.decode(response.body);
        return data;
      } else {
        return {
          'success': false,
          'error': 'Server returned status ${response.statusCode}'
        };
      }
    } catch (e) {
      print('🏨 Error creating room change: $e');
      return {'success': false, 'error': e.toString()};
    }
  }

  /// Update room change status
  Future<bool> updateRoomChangeStatus({
    required int id,
    required String status,
    String? notes,
  }) async {
    try {
      final response = await http.put(
        Uri.parse('$roomChangeApiUrl/$id'),
        headers: {'Content-Type': 'application/json'},
        body: json.encode({
          'status': status,
          'notes': notes,
        }),
      );

      if (response.statusCode == 200) {
        final data = json.decode(response.body);
        return data['success'] == true;
      }
      return false;
    } catch (e) {
      print('Error updating room change status: $e');
      return false;
    }
  }

  /// Delete room change (placeholder for now)
  Future<bool> deleteRoomChange(int id) async {
    // Placeholder - simulate network delay
    await Future.delayed(Duration(milliseconds: 500));

    // Return success
    return true;
  }
}
