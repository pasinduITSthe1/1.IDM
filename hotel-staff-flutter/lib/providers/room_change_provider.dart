import 'package:flutter/foundation.dart';
import '../models/room_change.dart';
import '../models/room.dart';
import '../services/room_change_service.dart';

class RoomChangeProvider with ChangeNotifier {
  // Room changes list
  List<RoomChange> _roomChanges = [];
  List<RoomChange> get roomChanges => _roomChanges;

  // Available rooms for change
  List<Room> _availableRooms = [];
  List<Room> get availableRooms => _availableRooms;

  // Statistics
  RoomChangeStatistics? _statistics;
  RoomChangeStatistics? get statistics => _statistics;

  // Loading states
  bool _isLoading = false;
  bool get isLoading => _isLoading;

  bool _isLoadingAvailableRooms = false;
  bool get isLoadingAvailableRooms => _isLoadingAvailableRooms;

  // Error handling
  String? _error;
  String? get error => _error;

  // Filters
  String? _statusFilter;
  String? get statusFilter => _statusFilter;

  /// Load all room changes with optional status filter
  Future<void> loadRoomChanges({String? status}) async {
    _isLoading = true;
    _error = null;
    _statusFilter = status;
    notifyListeners();

    try {
      _roomChanges = await RoomChangeService.getAllRoomChanges(status: status);
      _error = null;
    } catch (e) {
      _error = e.toString();
      _roomChanges = [];
    } finally {
      _isLoading = false;
      notifyListeners();
    }
  }

  /// Load room change by ID
  Future<RoomChange?> loadRoomChangeById(int id) async {
    _isLoading = true;
    _error = null;
    notifyListeners();

    try {
      final roomChange = await RoomChangeService.getRoomChangeById(id);
      _error = null;
      _isLoading = false;
      notifyListeners();
      return roomChange;
    } catch (e) {
      _error = e.toString();
      _isLoading = false;
      notifyListeners();
      return null;
    }
  }

  /// Load room changes for a specific booking
  Future<List<RoomChange>> loadRoomChangesByBookingId(int bookingId) async {
    _isLoading = true;
    _error = null;
    notifyListeners();

    try {
      final changes =
          await RoomChangeService.getRoomChangesByBookingId(bookingId);
      _error = null;
      _isLoading = false;
      notifyListeners();
      return changes;
    } catch (e) {
      _error = e.toString();
      _isLoading = false;
      notifyListeners();
      return [];
    }
  }

  /// Load available rooms for room change
  Future<void> loadAvailableRoomsForChange({
    required String checkInDate,
    required String checkOutDate,
    required int currentRoomId,
  }) async {
    _isLoadingAvailableRooms = true;
    _error = null;
    notifyListeners();

    try {
      _availableRooms = await RoomChangeService.getAvailableRoomsForChange(
        checkInDate: checkInDate,
        checkOutDate: checkOutDate,
        currentRoomId: currentRoomId,
      );
      _error = null;
    } catch (e) {
      _error = e.toString();
      _availableRooms = [];
    } finally {
      _isLoadingAvailableRooms = false;
      notifyListeners();
    }
  }

  /// Create a new room change
  Future<Map<String, dynamic>> createRoomChange(
      RoomChangeRequest request) async {
    _isLoading = true;
    _error = null;
    notifyListeners();

    try {
      final result = await RoomChangeService.createRoomChange(request);
      _error = null;

      // Reload room changes after successful creation
      if (result['success'] == true) {
        await loadRoomChanges(status: _statusFilter);
      }

      _isLoading = false;
      notifyListeners();
      return result;
    } catch (e) {
      _error = e.toString();
      _isLoading = false;
      notifyListeners();
      return {
        'success': false,
        'message': e.toString(),
      };
    }
  }

  /// Update room change status
  Future<Map<String, dynamic>> updateRoomChangeStatus({
    required int id,
    required String status,
    String? notes,
  }) async {
    _isLoading = true;
    _error = null;
    notifyListeners();

    try {
      final result = await RoomChangeService.updateRoomChangeStatus(
        id: id,
        status: status,
        notes: notes,
      );
      _error = null;

      // Reload room changes after successful update
      if (result['success'] == true) {
        await loadRoomChanges(status: _statusFilter);
      }

      _isLoading = false;
      notifyListeners();
      return result;
    } catch (e) {
      _error = e.toString();
      _isLoading = false;
      notifyListeners();
      return {
        'success': false,
        'message': e.toString(),
      };
    }
  }

  /// Complete a room change
  Future<Map<String, dynamic>> completeRoomChange(int id,
      [String? notes]) async {
    return await updateRoomChangeStatus(
      id: id,
      status: 'completed',
      notes: notes,
    );
  }

  /// Cancel a room change
  Future<Map<String, dynamic>> cancelRoomChange(int id,
      [String? notes]) async {
    return await updateRoomChangeStatus(
      id: id,
      status: 'cancelled',
      notes: notes,
    );
  }

  /// Load statistics
  Future<void> loadStatistics({String? startDate, String? endDate}) async {
    try {
      _statistics = await RoomChangeService.getRoomChangeStatistics(
        startDate: startDate,
        endDate: endDate,
      );
      _error = null;
      notifyListeners();
    } catch (e) {
      _error = e.toString();
      _statistics = null;
      notifyListeners();
    }
  }

  /// Refresh all data
  Future<void> refresh() async {
    await loadRoomChanges(status: _statusFilter);
    await loadStatistics();
  }

  /// Clear error
  void clearError() {
    _error = null;
    notifyListeners();
  }

  /// Filter by status
  void filterByStatus(String? status) {
    loadRoomChanges(status: status);
  }

  /// Get filtered room changes
  List<RoomChange> get filteredRoomChanges {
    if (_statusFilter == null || _statusFilter!.isEmpty) {
      return _roomChanges;
    }
    return _roomChanges.where((rc) => rc.status == _statusFilter).toList();
  }

  /// Get counts by status
  int get pendingCount =>
      _roomChanges.where((rc) => rc.status == 'pending').length;
  int get completedCount =>
      _roomChanges.where((rc) => rc.status == 'completed').length;
  int get cancelledCount =>
      _roomChanges.where((rc) => rc.status == 'cancelled').length;

  /// Check if there are any room changes
  bool get hasRoomChanges => _roomChanges.isNotEmpty;

  /// Check if there are any available rooms
  bool get hasAvailableRooms => _availableRooms.isNotEmpty;
}
