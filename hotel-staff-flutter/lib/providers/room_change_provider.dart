import 'package:flutter/foundation.dart';
import '../models/room_change.dart';
import '../services/room_change_service.dart';

class RoomChangeProvider with ChangeNotifier {
  final RoomChangeService _service = RoomChangeService();

  List<RoomChange> _roomChanges = [];
  List<OccupiedRoom> _occupiedRooms = [];
  List<AvailableRoom> _availableRooms = [];
  RoomChangeStatistics? _statistics;

  bool _isLoading = false;
  bool _isLoadingOccupied = false;
  bool _isLoadingAvailable = false;
  String? _errorMessage;

  // Filters
  String? _statusFilter;

  // Getters
  List<RoomChange> get roomChanges => _roomChanges;
  List<OccupiedRoom> get occupiedRooms => _occupiedRooms;
  List<AvailableRoom> get availableRooms => _availableRooms;
  RoomChangeStatistics? get statistics => _statistics;
  bool get isLoading => _isLoading;
  bool get isLoadingOccupied => _isLoadingOccupied;
  bool get isLoadingAvailable => _isLoadingAvailable;
  String? get errorMessage => _errorMessage;
  String? get statusFilter => _statusFilter;

  // Filtered lists
  List<RoomChange> get pendingChanges =>
      _roomChanges.where((change) => change.isPending).toList();

  List<RoomChange> get completedChanges =>
      _roomChanges.where((change) => change.isCompleted).toList();

  List<RoomChange> get cancelledChanges =>
      _roomChanges.where((change) => change.isCancelled).toList();

  // Counts
  int get totalChangesCount => _roomChanges.length;
  int get pendingCount => pendingChanges.length;
  int get completedCount => completedChanges.length;
  int get cancelledCount => cancelledChanges.length;

  /// Load all room changes
  Future<void> loadRoomChanges({String? status}) async {
    _isLoading = true;
    _errorMessage = null;
    _statusFilter = status;
    notifyListeners();

    try {
      _roomChanges = await _service.getAllRoomChanges(status: status);
      _errorMessage = null;
    } catch (e) {
      _errorMessage = e.toString();
      _roomChanges = [];
    } finally {
      _isLoading = false;
      notifyListeners();
    }
  }

  /// Load occupied rooms (for source room selection)
  Future<void> loadOccupiedRooms() async {
    _isLoadingOccupied = true;
    _errorMessage = null;
    notifyListeners();

    try {
      _occupiedRooms = await _service.getOccupiedRooms();
      _errorMessage = null;
    } catch (e) {
      _errorMessage = e.toString();
      _occupiedRooms = [];
    } finally {
      _isLoadingOccupied = false;
      notifyListeners();
    }
  }

  /// Load available rooms for a date range
  Future<void> loadAvailableRooms({
    required DateTime checkIn,
    required DateTime checkOut,
    int? hotelId,
  }) async {
    _isLoadingAvailable = true;
    _errorMessage = null;
    notifyListeners();

    try {
      _availableRooms = await _service.getAvailableRooms(
        checkIn: checkIn,
        checkOut: checkOut,
        hotelId: hotelId,
      );
      _errorMessage = null;
    } catch (e) {
      _errorMessage = e.toString();
      _availableRooms = [];
    } finally {
      _isLoadingAvailable = false;
      notifyListeners();
    }
  }

  /// Load statistics
  Future<void> loadStatistics() async {
    try {
      _statistics = await _service.getStatistics();
      notifyListeners();
    } catch (e) {
      _errorMessage = e.toString();
    }
  }

  /// Get recent room changes
  Future<List<RoomChange>> getRecentChanges({int limit = 10}) async {
    try {
      return await _service.getRecentChanges(limit: limit);
    } catch (e) {
      _errorMessage = e.toString();
      return [];
    }
  }

  /// Create a new room change
  Future<bool> createRoomChange(RoomChangeRequest request) async {
    _isLoading = true;
    _errorMessage = null;
    notifyListeners();

    try {
      final result = await _service.createRoomChange(request);

      if (result['success'] == true) {
        // Reload the list after successful creation
        await loadRoomChanges(status: _statusFilter);
        _errorMessage = null;
        return true;
      } else {
        _errorMessage = result['error'] ?? 'Failed to create room change';
        return false;
      }
    } catch (e) {
      _errorMessage = e.toString();
      return false;
    } finally {
      _isLoading = false;
      notifyListeners();
    }
  }

  /// Update room change status
  Future<bool> updateRoomChangeStatus({
    required int id,
    required String status,
    String? notes,
  }) async {
    _isLoading = true;
    _errorMessage = null;
    notifyListeners();

    try {
      final success = await _service.updateRoomChangeStatus(
        id: id,
        status: status,
        notes: notes,
      );

      if (success) {
        // Reload the list after successful update
        await loadRoomChanges(status: _statusFilter);
        _errorMessage = null;
      } else {
        _errorMessage = 'Failed to update room change status';
      }

      return success;
    } catch (e) {
      _errorMessage = e.toString();
      return false;
    } finally {
      _isLoading = false;
      notifyListeners();
    }
  }

  /// Complete a room change
  Future<bool> completeRoomChange(int id, {String? notes}) async {
    return await updateRoomChangeStatus(
      id: id,
      status: 'completed',
      notes: notes,
    );
  }

  /// Cancel a room change
  Future<bool> cancelRoomChange(int id, {String? notes}) async {
    return await updateRoomChangeStatus(
      id: id,
      status: 'cancelled',
      notes: notes,
    );
  }

  /// Clear error message
  void clearError() {
    _errorMessage = null;
    notifyListeners();
  }

  /// Set status filter
  void setStatusFilter(String? status) {
    _statusFilter = status;
    loadRoomChanges(status: status);
  }

  /// Clear all data
  void clearAll() {
    _roomChanges = [];
    _occupiedRooms = [];
    _availableRooms = [];
    _statistics = null;
    _errorMessage = null;
    _statusFilter = null;
    notifyListeners();
  }
}
