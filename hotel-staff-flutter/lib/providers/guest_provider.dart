import 'dart:convert';
import 'package:flutter/foundation.dart';
import 'package:shared_preferences/shared_preferences.dart';
import '../models/guest.dart';
import '../services/guest_service.dart';

class GuestProvider with ChangeNotifier {
  final List<Guest> _guests = [];
  bool _isLoading = false;
  static const String _storageKey = 'guests_data';
  final GuestService _guestService = GuestService();
  bool _useApi = true; // Set to true to use API, false for local storage only

  List<Guest> get guests => _guests;
  bool get isLoading => _isLoading;
  bool get useApi => _useApi;

  // Toggle API usage
  void toggleApiUsage(bool value) {
    _useApi = value;
    notifyListeners();
  }

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

      if (_useApi) {
        // Save to API and database
        final createdGuest = await _guestService.createGuest(guest);
        _guests.add(createdGuest);
        debugPrint('✅ Guest saved to database via API');
      } else {
        // Save to local storage only
        _guests.add(guest);
        debugPrint('ℹ️ Guest saved to local storage only');
      }

      // Also save to local storage as backup
      await _saveToLocalStorage();

      _isLoading = false;
      notifyListeners();
      return true;
    } catch (e) {
      debugPrint('❌ Error adding guest: $e');
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
        if (_useApi) {
          // Update via API and database
          final updated = await _guestService.updateGuest(id, updatedGuest);
          _guests[index] = updated;
          debugPrint('✅ Guest updated in database via API');
        } else {
          // Update local storage only
          _guests[index] = updatedGuest;
          debugPrint('ℹ️ Guest updated in local storage only');
        }
      }

      // Save to local storage as backup
      await _saveToLocalStorage();

      _isLoading = false;
      notifyListeners();
      return true;
    } catch (e) {
      debugPrint('❌ Error updating guest: $e');
      _isLoading = false;
      notifyListeners();
      return false;
    }
  }

  // Check-in guest
  Future<bool> checkInGuest(String id,
      {String? roomNumber, String? expectedCheckoutDate, String? notes}) async {
    try {
      final index = _guests.indexWhere((g) => g.id == id);
      if (index != -1) {
        if (_useApi && roomNumber != null) {
          // Check-in via API
          final checkedInGuest = await _guestService.checkInGuest(
            id,
            roomNumber,
            expectedCheckoutDate: expectedCheckoutDate,
            notes: notes,
          );
          _guests[index] = checkedInGuest;
          debugPrint('✅ Guest checked in via API');
        } else {
          // Update locally
          _guests[index] = _guests[index].copyWith(
            status: 'checked-in',
            checkInDate: DateTime.now(),
            roomNumber: roomNumber ?? _guests[index].roomNumber,
          );
          debugPrint('ℹ️ Guest checked in locally');
        }

        // Save to local storage
        await _saveToLocalStorage();

        notifyListeners();
        return true;
      }
      return false;
    } catch (e) {
      debugPrint('❌ Error checking in guest: $e');
      return false;
    }
  }

  // Check-out guest
  Future<bool> checkOutGuest(String id,
      {double? totalAmount,
      String? paymentStatus,
      String? paymentMethod,
      String? notes}) async {
    try {
      final index = _guests.indexWhere((g) => g.id == id);
      if (index != -1) {
        if (_useApi) {
          // Check-out via API
          final checkedOutGuest = await _guestService.checkOutGuest(
            id,
            totalAmount: totalAmount,
            paymentStatus: paymentStatus,
            paymentMethod: paymentMethod,
            notes: notes,
          );
          _guests[index] = checkedOutGuest;
          debugPrint('✅ Guest checked out via API');
        } else {
          // Update locally
          _guests[index] = _guests[index].copyWith(
            status: 'checked-out',
            checkOutDate: DateTime.now(),
          );
          debugPrint('ℹ️ Guest checked out locally');
        }

        // Save to local storage
        await _saveToLocalStorage();

        notifyListeners();
        return true;
      }
      return false;
    } catch (e) {
      debugPrint('❌ Error checking out guest: $e');
      return false;
    }
  }

  // Load guests (from API or local storage)
  Future<void> loadGuests() async {
    try {
      _isLoading = true;
      notifyListeners();

      if (_useApi) {
        try {
          // Try to load from API
          final apiGuests = await _guestService.fetchGuests();
          _guests.clear();
          _guests.addAll(apiGuests);
          debugPrint('✅ Loaded ${_guests.length} guests from API/database');

          // Save to local storage as backup
          await _saveToLocalStorage();
        } catch (e) {
          debugPrint('⚠️ API failed, falling back to local storage: $e');
          // Fall back to local storage
          await _loadFromLocalStorage();
        }
      } else {
        // Load from local storage only
        await _loadFromLocalStorage();
      }

      _isLoading = false;
      notifyListeners();
    } catch (e) {
      debugPrint('❌ Error loading guests: $e');
      _isLoading = false;
      notifyListeners();
    }
  }

  // Save guests to local storage
  Future<void> _saveToLocalStorage() async {
    try {
      final prefs = await SharedPreferences.getInstance();
      final guestsJson = _guests.map((guest) => guest.toJson()).toList();
      final jsonString = jsonEncode(guestsJson);
      await prefs.setString(_storageKey, jsonString);
      debugPrint('✅ Saved ${_guests.length} guests to local storage');
      debugPrint('📊 Data size: ${jsonString.length} characters');
    } catch (e) {
      debugPrint('❌ Error saving guests to local storage: $e');
    }
  }

  // Load guests from local storage
  Future<void> _loadFromLocalStorage() async {
    try {
      final prefs = await SharedPreferences.getInstance();
      final jsonString = prefs.getString(_storageKey);

      if (jsonString != null) {
        final List<dynamic> guestsJson = jsonDecode(jsonString);
        _guests.clear();
        _guests.addAll(guestsJson
            .map((json) => Guest.fromJson(json as Map<String, dynamic>)));
        debugPrint('✅ Loaded ${_guests.length} guests from local storage');
        debugPrint('📊 Data size: ${jsonString.length} characters');
        // Log first guest as sample
        if (_guests.isNotEmpty) {
          debugPrint(
              '📝 Sample: ${_guests.first.fullName} - Status: ${_guests.first.status}');
        }
      } else {
        debugPrint(
            'ℹ️ No guests found in local storage (first run or data cleared)');
      }
    } catch (e) {
      debugPrint('❌ Error loading guests from local storage: $e');
    }
  }

  // Debug method: Print all saved data (for testing/verification)
  Future<void> debugPrintStoredData() async {
    try {
      final prefs = await SharedPreferences.getInstance();
      final jsonString = prefs.getString(_storageKey);

      debugPrint('🔍 ===== DATABASE VERIFICATION =====');
      if (jsonString != null) {
        debugPrint('📦 Raw data exists: YES');
        debugPrint('📊 Data size: ${jsonString.length} characters');
        debugPrint('👥 Number of guests in storage: ${_guests.length}');
        debugPrint('');
        debugPrint('📋 Guest List:');
        for (var i = 0; i < _guests.length; i++) {
          final guest = _guests[i];
          debugPrint('  ${i + 1}. ${guest.fullName}');
          debugPrint('     Status: ${guest.status}');
          debugPrint('     Room: ${guest.roomNumber ?? "Not assigned"}');
          debugPrint(
              '     Check-in: ${guest.checkInDate?.toString() ?? "Not checked in"}');
          debugPrint('     Email: ${guest.email ?? "N/A"}');
          debugPrint('');
        }
        debugPrint('✅ Data is being saved to database!');
      } else {
        debugPrint('📦 Raw data exists: NO');
        debugPrint(
            '⚠️ No data found in database - either first run or data was cleared');
      }
      debugPrint('🔍 ===== END VERIFICATION =====');
    } catch (e) {
      debugPrint('❌ Error reading stored data: $e');
    }
  }
}
