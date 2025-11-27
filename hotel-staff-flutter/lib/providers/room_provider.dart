import 'package:flutter/foundation.dart';
import '../models/room.dart';
import '../services/room_service.dart';

/// Provider for managing room state and operations
class RoomProvider with ChangeNotifier {
  final RoomService _roomService = RoomService();

  // State variables
  List<Room> _rooms = [];
  RoomStatistics? _statistics;
  List<TodayCheckInOut> _todayCheckIns = [];
  List<TodayCheckInOut> _todayCheckOuts = [];

  bool _isLoading = false;
  String? _error;

  // Filter state
  String _selectedFilter =
      'all'; // all, available, occupied, cleaning, maintenance
  String _selectedRoomType = 'all';

  // Getters
  List<Room> get rooms => _filteredRooms;
  List<Room> get allRooms => _rooms;
  RoomStatistics? get statistics => _statistics;
  List<TodayCheckInOut> get todayCheckIns => _todayCheckIns;
  List<TodayCheckInOut> get todayCheckOuts => _todayCheckOuts;

  bool get isLoading => _isLoading;
  String? get error => _error;
  String get selectedFilter => _selectedFilter;
  String get selectedRoomType => _selectedRoomType;

  /// Get filtered rooms based on current filters
  List<Room> get _filteredRooms {
    var filtered = _rooms;

    // Filter by status
    if (_selectedFilter != 'all') {
      filtered = filtered.where((room) {
        switch (_selectedFilter) {
          case 'available':
            return room.isAvailable;
          case 'occupied':
            return room.isOccupiedStatus;
          case 'cleaning':
            return room.isCleaning;
          case 'maintenance':
            return room.isInMaintenance;
          default:
            return true;
        }
      }).toList();
    }

    // Filter by room type
    if (_selectedRoomType != 'all') {
      filtered = filtered
          .where((room) => room.roomTypeName == _selectedRoomType)
          .toList();
    }

    return filtered;
  }

  /// Get unique room types for filtering
  List<String> get roomTypes {
    final types = _rooms.map((r) => r.roomTypeName).toSet().toList();
    types.sort();
    return types;
  }

  /// Get counts for each status
  Map<String, int> get statusCounts {
    return {
      'all': _rooms.length,
      'available': _rooms.where((r) => r.isAvailable).length,
      'occupied': _rooms.where((r) => r.isOccupiedStatus).length,
      'cleaning': _rooms.where((r) => r.isCleaning).length,
      'maintenance': _rooms.where((r) => r.isInMaintenance).length,
    };
  }

  // Actions

  /// Load all data (rooms, statistics, today's activities)
  Future<void> loadAll() async {
    await Future.wait([
      loadRooms(),
      loadStatistics(),
      loadTodayCheckIns(),
      loadTodayCheckOuts(),
    ]);
  }

  /// Fetch all rooms
  Future<void> loadRooms() async {
    _setLoading(true);
    _clearError();

    try {
      _rooms = await _roomService.getAllRooms();
      notifyListeners();
    } catch (e) {
      _setError('Failed to load rooms: ${e.toString()}');
    } finally {
      _setLoading(false);
    }
  }

  /// Fetch room statistics
  Future<void> loadStatistics() async {
    try {
      _statistics = await _roomService.getRoomStatistics();
      notifyListeners();
    } catch (e) {
      debugPrint('Failed to load statistics: ${e.toString()}');
    }
  }

  /// Fetch today's check-ins
  Future<void> loadTodayCheckIns() async {
    try {
      _todayCheckIns = await _roomService.getTodayCheckIns();
      notifyListeners();
    } catch (e) {
      debugPrint('Failed to load today\'s check-ins: ${e.toString()}');
    }
  }

  /// Fetch today's check-outs
  Future<void> loadTodayCheckOuts() async {
    try {
      _todayCheckOuts = await _roomService.getTodayCheckOuts();
      notifyListeners();
    } catch (e) {
      debugPrint('Failed to load today\'s check-outs: ${e.toString()}');
    }
  }

  /// Update room status
  Future<bool> updateRoomStatus(int roomId, int statusCode) async {
    _clearError();

    try {
      final success = await _roomService.updateRoomStatus(roomId, statusCode);

      if (success) {
        // Update local state
        final index = _rooms.indexWhere((r) => r.id == roomId);
        if (index != -1) {
          _rooms[index] = _rooms[index].copyWith(roomStatus: statusCode);
          notifyListeners();
        }

        // Refresh statistics
        loadStatistics();
      }

      return success;
    } catch (e) {
      _setError('Failed to update room status: ${e.toString()}');
      return false;
    }
  }

  /// Mark room as available
  Future<bool> markAsAvailable(int roomId) {
    return _roomService.markAsAvailable(roomId);
  }

  /// Mark room as cleaning
  Future<bool> markAsCleaning(int roomId) {
    return _roomService.markAsCleaning(roomId);
  }

  /// Mark room as under maintenance
  Future<bool> markAsMaintenance(int roomId) {
    return _roomService.markAsMaintenance(roomId);
  }

  /// Set status filter
  void setFilter(String filter) {
    if (_selectedFilter != filter) {
      _selectedFilter = filter;
      notifyListeners();
    }
  }

  /// Set room type filter
  void setRoomTypeFilter(String type) {
    if (_selectedRoomType != type) {
      _selectedRoomType = type;
      notifyListeners();
    }
  }

  /// Clear all filters
  void clearFilters() {
    _selectedFilter = 'all';
    _selectedRoomType = 'all';
    notifyListeners();
  }

  /// Refresh all data
  Future<void> refresh() async {
    await loadAll();
  }

  // Private helper methods

  void _setLoading(bool value) {
    _isLoading = value;
    notifyListeners();
  }

  void _setError(String message) {
    _error = message;
    notifyListeners();
  }

  void _clearError() {
    _error = null;
  }

  /// Find room by ID
  Room? getRoomById(int roomId) {
    try {
      return _rooms.firstWhere((r) => r.id == roomId);
    } catch (e) {
      return null;
    }
  }

  /// Get rooms by status
  List<Room> getRoomsByStatus(int statusCode) {
    return _rooms.where((r) => r.roomStatus == statusCode).toList();
  }

  /// Get available rooms
  List<Room> get availableRooms {
    return _rooms.where((r) => r.isAvailable).toList();
  }

  /// Get occupied rooms
  List<Room> get occupiedRooms {
    return _rooms.where((r) => r.isOccupiedStatus).toList();
  }

  /// Reset all rooms to available status (for testing/admin)
  Future<bool> resetAllRoomsToAvailable() async {
    try {
      _setLoading(true);
      final success = await _roomService.resetAllRoomsToAvailable();

      if (success) {
        // Reload all data after reset
        await loadAll();
      }

      _setLoading(false);
      return success;
    } catch (e) {
      _setLoading(false);
      _setError('Failed to reset rooms: $e');
      return false;
    }
  }

  /// Get rooms in cleaning status
  List<Room> get cleaningRooms {
    return _rooms.where((r) => r.isCleaning).toList();
  }

  /// Get rooms under maintenance
  List<Room> get maintenanceRooms {
    return _rooms.where((r) => r.isInMaintenance).toList();
  }
}
