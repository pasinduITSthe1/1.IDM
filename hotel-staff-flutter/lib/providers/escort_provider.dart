import 'package:flutter/foundation.dart';
import '../models/escort.dart';
import '../services/escort_service.dart';

class EscortProvider with ChangeNotifier {
  final Map<String, List<Escort>> _escortsByGuest =
      {}; // Map of guestId to escorts list
  bool _isLoading = false;
  final EscortService _escortService = EscortService();

  bool get isLoading => _isLoading;

  // Get escorts for a specific guest
  List<Escort> getEscortsForGuest(String guestId) {
    return _escortsByGuest[guestId] ?? [];
  }

  // Get total count of escorts for a guest
  int getEscortCountForGuest(String guestId) {
    return _escortsByGuest[guestId]?.length ?? 0;
  }

  // Add new escort
  Future<bool> addEscort(Escort escort) async {
    try {
      _isLoading = true;
      notifyListeners();

      debugPrint('📤 Adding escort to database...');
      debugPrint('   Name: ${escort.firstName} ${escort.lastName}');
      debugPrint('   Guest ID: ${escort.guestId}');

      final response = await _escortService.addEscort(escort);

      // Extract escort ID from response
      final escortId = response['id']?.toString() ?? escort.id;

      // Create Escort object with database ID
      final createdEscort = escort.copyWith(id: escortId);

      // Add to local list
      if (_escortsByGuest[escort.guestId] == null) {
        _escortsByGuest[escort.guestId] = [];
      }
      _escortsByGuest[escort.guestId]!.add(createdEscort);

      debugPrint('✅ Escort saved to database: ID $escortId');

      _isLoading = false;
      notifyListeners();
      return true;
    } catch (e) {
      debugPrint('❌ Error adding escort: $e');
      _isLoading = false;
      notifyListeners();
      return false;
    }
  }

  // Load escorts for a specific guest
  Future<void> loadEscortsForGuest(String guestId) async {
    try {
      _isLoading = true;
      notifyListeners();

      debugPrint('📡 Loading escorts for guest: $guestId');

      final escorts = await _escortService.getEscortsForGuest(guestId);
      _escortsByGuest[guestId] = escorts;

      debugPrint('✅ Loaded ${escorts.length} escorts for guest $guestId');

      _isLoading = false;
      notifyListeners();
    } catch (e) {
      debugPrint('❌ Error loading escorts: $e');
      _isLoading = false;
      notifyListeners();
    }
  }

  // Update escort
  Future<bool> updateEscort(String escortId, Escort updatedEscort) async {
    try {
      _isLoading = true;
      notifyListeners();

      debugPrint('📤 Updating escort in database...');
      debugPrint('   Escort ID: $escortId');

      await _escortService.updateEscort(
        escortId,
        updatedEscort.toApiJson(),
      );

      // Update in local list
      final guestId = updatedEscort.guestId;
      if (_escortsByGuest[guestId] != null) {
        final index =
            _escortsByGuest[guestId]!.indexWhere((e) => e.id == escortId);
        if (index != -1) {
          _escortsByGuest[guestId]![index] = updatedEscort;
        }
      }

      debugPrint('✅ Escort updated in database');

      _isLoading = false;
      notifyListeners();
      return true;
    } catch (e) {
      debugPrint('❌ Error updating escort: $e');
      _isLoading = false;
      notifyListeners();
      return false;
    }
  }

  // Delete escort
  Future<bool> deleteEscort(String escortId, String guestId) async {
    try {
      _isLoading = true;
      notifyListeners();

      debugPrint('📤 Deleting escort from database...');
      debugPrint('   Escort ID: $escortId');

      await _escortService.deleteEscort(escortId);

      // Remove from local list
      if (_escortsByGuest[guestId] != null) {
        _escortsByGuest[guestId]!.removeWhere((e) => e.id == escortId);
      }

      debugPrint('✅ Escort deleted from database');

      _isLoading = false;
      notifyListeners();
      return true;
    } catch (e) {
      debugPrint('❌ Error deleting escort: $e');
      _isLoading = false;
      notifyListeners();
      return false;
    }
  }

  // Clear escorts for a specific guest (useful for logout or cleanup)
  void clearEscortsForGuest(String guestId) {
    _escortsByGuest.remove(guestId);
    notifyListeners();
  }

  // Clear all escorts
  void clearAll() {
    _escortsByGuest.clear();
    notifyListeners();
  }

  // Get statistics for all escorts
  Map<String, int> get statistics {
    int totalEscorts = 0;
    _escortsByGuest.forEach((guestId, escorts) {
      totalEscorts += escorts.length;
    });

    return {
      'total': totalEscorts,
      'guestsWithEscorts': _escortsByGuest.length,
    };
  }
}
