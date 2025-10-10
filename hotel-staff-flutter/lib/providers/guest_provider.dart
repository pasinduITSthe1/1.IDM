import 'package:flutter/foundation.dart';
import '../models/guest.dart';

class GuestProvider with ChangeNotifier {
  final List<Guest> _guests = [];
  bool _isLoading = false;

  List<Guest> get guests => _guests;
  bool get isLoading => _isLoading;

  // Get guest statistics
  Map<String, int> get statistics {
    int checkedIn = _guests.where((g) => g.status == 'checked-in').length;
    int checkedOut = _guests.where((g) => g.status == 'checked-out').length;
    int pending = _guests.where((g) => g.status == 'pending').length;

    return {
      'total': _guests.length,
      'checkedIn': checkedIn,
      'checkedOut': checkedOut,
      'pending': pending,
    };
  }

  // Add new guest
  Future<bool> addGuest(Guest guest) async {
    try {
      _isLoading = true;
      notifyListeners();

      // TODO: Implement API call to QloApps
      _guests.add(guest);

      _isLoading = false;
      notifyListeners();
      return true;
    } catch (e) {
      debugPrint('Error adding guest: $e');
      _isLoading = false;
      notifyListeners();
      return false;
    }
  }

  // Update guest
  Future<bool> updateGuest(String id, Guest updatedGuest) async {
    try {
      _isLoading = true;
      notifyListeners();

      final index = _guests.indexWhere((g) => g.id == id);
      if (index != -1) {
        _guests[index] = updatedGuest;
      }

      _isLoading = false;
      notifyListeners();
      return true;
    } catch (e) {
      debugPrint('Error updating guest: $e');
      _isLoading = false;
      notifyListeners();
      return false;
    }
  }

  // Check-in guest
  Future<bool> checkInGuest(String id, {String? roomNumber}) async {
    try {
      final index = _guests.indexWhere((g) => g.id == id);
      if (index != -1) {
        _guests[index] = _guests[index].copyWith(
          status: 'checked-in',
          checkInDate: DateTime.now(),
          roomNumber: roomNumber ?? _guests[index].roomNumber,
        );
        notifyListeners();
        return true;
      }
      return false;
    } catch (e) {
      debugPrint('Error checking in guest: $e');
      return false;
    }
  }

  // Check-out guest
  Future<bool> checkOutGuest(String id) async {
    try {
      final index = _guests.indexWhere((g) => g.id == id);
      if (index != -1) {
        _guests[index] = _guests[index].copyWith(
          status: 'checked-out',
          checkOutDate: DateTime.now(),
        );
        notifyListeners();
        return true;
      }
      return false;
    } catch (e) {
      debugPrint('Error checking out guest: $e');
      return false;
    }
  }

  // Load guests (from API or local storage)
  Future<void> loadGuests() async {
    try {
      _isLoading = true;
      notifyListeners();

      // TODO: Implement API call to fetch guests
      // For now, using demo data

      _isLoading = false;
      notifyListeners();
    } catch (e) {
      debugPrint('Error loading guests: $e');
      _isLoading = false;
      notifyListeners();
    }
  }
}
