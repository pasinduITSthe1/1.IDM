import 'package:flutter/foundation.dart';
import '../models/guest.dart';
import '../services/guest_service.dart';
import '../services/qloapps_api_service.dart';
import '../services/hotel_management_service.dart';

class GuestProvider with ChangeNotifier {
  final List<Guest> _guests = [];
  bool _isLoading = false;
  final GuestService _guestService = GuestService(); // Legacy fallback only
  final QloAppsApiService _qloAppsService = QloAppsApiService();
  final HotelManagementService _hotelService = HotelManagementService(); // ✅ Hotel operations
  bool _useApi = true; // Always true - QloApps is the single source of truth
  bool _useQloAppsDirectly =
      true; // Always true - direct QloApps database access

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
    // Count by status - support both hyphen and underscore formats
    int checkedIn = _guests.where((g) => g.status == 'checked_in' || g.status == 'checked-in').length;
    int checkedOut = _guests.where((g) => g.status == 'checked_out' || g.status == 'checked-out').length;
    int pending = _guests.where((g) => g.status == 'pending').length;

    return {
      'total': _guests.length,
      'checkedIn': checkedIn,
      'checkedOut': checkedOut,
      'pending': pending,
    };
  }

  // Add new guest - DIRECTLY TO QLOAPPS DATABASE
  Future<bool> addGuest(Guest guest) async {
    try {
      _isLoading = true;
      notifyListeners();

      // ✅ Save directly to QloApps database via API
      debugPrint('📤 Creating customer in QloApps database...');
      debugPrint('   Name: ${guest.firstName} ${guest.lastName}');
      debugPrint('   Email: ${guest.email}');

      final response = await _qloAppsService.createCustomer(
        firstName: guest.firstName,
        lastName: guest.lastName,
        email: guest.email ??
            'guest${DateTime.now().millisecondsSinceEpoch}@hotel.com',
        password: 'guest123', // Default password
        phone: guest.phone,
        dateOfBirth: guest.dateOfBirth,
      );

      // Extract customer ID from response
      final customerId = response['customer']?['id']?.toString() ?? guest.id;

      // Create Guest object with QloApps ID
      final createdGuest = guest.copyWith(id: customerId);
      _guests.add(createdGuest);

      debugPrint('✅ Guest saved to QloApps database: Customer ID $customerId');

      _isLoading = false;
      notifyListeners();
      return true;
    } catch (e) {
      debugPrint('❌ Error adding guest to QloApps: $e');
      _isLoading = false;
      notifyListeners();
      return false;
    }
  }

  // Update guest - DIRECTLY IN QLOAPPS DATABASE
  Future<bool> updateGuest(String id, Guest updatedGuest) async {
    try {
      _isLoading = true;
      notifyListeners();

      final index = _guests.indexWhere((g) => g.id == id);
      if (index != -1) {
        // ✅ Update directly in QloApps database
        debugPrint('📤 Updating customer in QloApps database...');
        debugPrint('   Customer ID: $id');
        debugPrint(
            '   Name: ${updatedGuest.firstName} ${updatedGuest.lastName}');

        await _qloAppsService.updateCustomer(
          int.parse(id),
          {
            'firstname': updatedGuest.firstName,
            'lastname': updatedGuest.lastName,
            'email': updatedGuest.email,
            'phone': updatedGuest.phone,
          },
        );

        _guests[index] = updatedGuest;
        debugPrint('✅ Guest updated in QloApps database: Customer ID $id');
      }

      _isLoading = false;
      notifyListeners();
      return true;
    } catch (e) {
      debugPrint('❌ Error updating guest in QloApps: $e');
      _isLoading = false;
      notifyListeners();
      return false;
    }
  }

  // Check-in guest - SAVE TO HOTEL BACKEND DATABASE
  Future<bool> checkInGuest(String id,
      {String? roomNumber, String? expectedCheckoutDate, String? notes}) async {
    try {
      final index = _guests.indexWhere((g) => g.id == id);
      if (index != -1) {
        // ✅ Update status in local list immediately for UI responsiveness
        _guests[index] = _guests[index].copyWith(
          status: 'checked_in',
          checkInDate: DateTime.now(),
          roomNumber: roomNumber ?? _guests[index].roomNumber,
        );
        notifyListeners();

        debugPrint('📤 Checking in guest in HOTEL BACKEND database...');
        debugPrint('   Customer ID: $id');
        debugPrint('   Room: $roomNumber');

        // ✅ IMPORTANT: Save check-in to hotel backend database using HotelManagementService
        try {
          final response = await _hotelService.checkInGuest(
            customerId: int.parse(id),
            bookingId: 1, // Default booking ID (improve this later)
            roomId: int.tryParse(roomNumber ?? '0') ?? 0,
            roomNumber: roomNumber ?? '',
            checkedInBy: 'app_user',
            notes: notes ?? '',
          );
          debugPrint('✅ Guest checked in - Saved to hotel backend database');
          debugPrint('   Response: ${response.toString()}');
        } catch (e) {
          debugPrint('⚠️ Could not save to hotel backend: $e');
          // Continue anyway - guest is checked in locally
        }

        return true;
      }
      return false;
    } catch (e) {
      debugPrint('❌ Error checking in guest: $e');
      return false;
    }
  }

  // Check-out guest - SAVE TO HOTEL BACKEND DATABASE
  Future<bool> checkOutGuest(String id,
      {double? totalAmount,
      String? paymentStatus,
      String? paymentMethod,
      String? notes}) async {
    try {
      final index = _guests.indexWhere((g) => g.id == id);
      if (index != -1) {
        // ✅ Update status in local list immediately for UI responsiveness
        _guests[index] = _guests[index].copyWith(
          status: 'checked_out',
          checkOutDate: DateTime.now(),
        );
        notifyListeners();

        debugPrint('📤 Checking out guest in HOTEL BACKEND database...');
        debugPrint('   Customer ID: $id');
        debugPrint('   Total Amount: \$${totalAmount ?? 0}');

        // ✅ IMPORTANT: Save check-out to hotel backend database using HotelManagementService
        try {
          // First get the guest's current check-in record to get checkin_id
          final guestStatus = await _hotelService.getGuestStatus(int.parse(id));
          int checkinId = 1; // Default fallback
          int roomId = 0;
          
          if (guestStatus.containsKey('checkin_id')) {
            checkinId = int.tryParse(guestStatus['checkin_id']?.toString() ?? '1') ?? 1;
          }
          if (guestStatus.containsKey('id_room')) {
            roomId = int.tryParse(guestStatus['id_room']?.toString() ?? '0') ?? 0;
          }
          
          final response = await _hotelService.checkOutGuest(
            customerId: int.parse(id),
            checkinId: checkinId,
            roomId: roomId,
            finalBill: totalAmount ?? 0.0,
            paymentStatus: paymentStatus ?? 'pending',
            checkedOutBy: 'app_user',
            notes: notes ?? '',
          );
          debugPrint('✅ Guest checked out - Saved to hotel backend database');
          debugPrint('   Response: ${response.toString()}');
        } catch (e) {
          debugPrint('⚠️ Could not save to hotel backend: $e');
          // Continue anyway - guest is checked out locally
        }

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
          if (_useQloAppsDirectly) {
            // Load directly from QloApps API
            debugPrint('📡 Loading guests from QloApps API...');
            final customersList = await _qloAppsService.getCustomers(
              filters: {'display': 'full'}, // ✅ Request full customer data
            );

            if (customersList.isNotEmpty) {
              _guests.clear();

              for (var customerData in customersList) {
                try {
                  // Extract customer data
                  final customer = customerData['customer'] ?? customerData;
                  final customerId = customer['id']?.toString() ?? '';

                  // ✅ NEW: Get actual guest status from hotel backend database
                  String status = 'pending'; // Default status
                  String? roomNumber;
                  DateTime? checkInDate;
                  DateTime? checkOutDate;

                  try {
                    // Get guest status from hotel backend
                    final guestStatus = await _hotelService.getGuestStatus(int.parse(customerId));
                    if (guestStatus.containsKey('status')) {
                      status = guestStatus['status'] ?? 'pending';
                      roomNumber = guestStatus['room_number']?.toString();
                      if (guestStatus['check_in_time'] != null) {
                        checkInDate = DateTime.parse(guestStatus['check_in_time']);
                      }
                      if (guestStatus['check_out_time'] != null) {
                        checkOutDate = DateTime.parse(guestStatus['check_out_time']);
                      }
                    }
                  } catch (e) {
                    debugPrint('⚠️ Could not get guest status from hotel backend: $e');
                    // Fall back to QloApps notes parsing
                    final note = customer['note']?.toString() ?? '';
                    if (note.contains('Checked in on')) {
                      status = 'checked_in';
                      final checkInMatch = RegExp(r'Checked in on ([\d\-T:\.]+)').firstMatch(note);
                      if (checkInMatch != null) {
                        try {
                          checkInDate = DateTime.parse(checkInMatch.group(1)!);
                        } catch (e) {
                          checkInDate = DateTime.now();
                        }
                      }
                      final roomMatch = RegExp(r'Room: (\w+)').firstMatch(note);
                      if (roomMatch != null) {
                        roomNumber = roomMatch.group(1);
                      }
                    } else if (note.contains('Checked out on')) {
                      status = 'checked_out';
                      final checkOutMatch = RegExp(r'Checked out on ([\d\-T:\.]+)').firstMatch(note);
                      if (checkOutMatch != null) {
                        try {
                          checkOutDate = DateTime.parse(checkOutMatch.group(1)!);
                        } catch (e) {
                          checkOutDate = DateTime.now();
                        }
                      }
                    }
                  }

                  // Create Guest object from QloApps customer data
                  final guest = Guest(
                    id: customer['id']?.toString() ?? '',
                    firstName: customer['firstname']?.toString() ?? '',
                    lastName: customer['lastname']?.toString() ?? '',
                    email: customer['email']?.toString(),
                    phone: customer['phone']?.toString() ??
                        customer['phone_mobile']?.toString(),
                    documentType:
                        'passport', // Default, update if stored in notes
                    documentNumber: customer['id_number']?.toString() ?? '',
                    nationality: customer['country']?.toString() ?? '',
                    dateOfBirth: customer['birthday']?.toString(),
                    status: status,
                    checkInDate: checkInDate ?? DateTime.now(),
                    checkOutDate: checkOutDate,
                    roomNumber: roomNumber,
                  );

                  _guests.add(guest);
                } catch (e) {
                  debugPrint('⚠️ Error parsing customer: $e');
                }
              }

              debugPrint('✅ Loaded ${_guests.length} guests from QloApps');
            } else {
              debugPrint('⚠️ No customers found in QloApps');
            }
          } else {
            // Try to load from Node.js backend API (fallback)
            final apiGuests = await _guestService.fetchGuests();
            _guests.clear();
            _guests.addAll(apiGuests);
            debugPrint('✅ Loaded ${_guests.length} guests from backend API');
          }
        } catch (e) {
          debugPrint('⚠️ API failed: $e');
          debugPrint(
              '❌ Cannot load guests - QloApps API is the only data source');
        }
      } else {
        debugPrint('⚠️ API usage is disabled');
      }

      _isLoading = false;
      notifyListeners();
    } catch (e) {
      debugPrint('❌ Error loading guests: $e');
      _isLoading = false;
      notifyListeners();
    }
  }

  // Delete guest - FROM QLOAPPS DATABASE
  Future<bool> deleteGuest(String id) async {
    try {
      _isLoading = true;
      notifyListeners();

      debugPrint('📤 Deleting customer from QloApps database...');
      debugPrint('   Customer ID: $id');

      // Delete from QloApps database
      // Note: QloApps API typically doesn't allow hard delete of customers
      // Instead, we deactivate them
      try {
        await _qloAppsService.updateCustomer(
          int.parse(id),
          {
            'active': '0', // Deactivate customer
            'note':
                'Deleted from Flutter app on ${DateTime.now().toIso8601String()}',
          },
        );
        debugPrint('✅ Customer deactivated in QloApps database');
      } catch (e) {
        debugPrint('⚠️ Could not deactivate customer in QloApps: $e');
      }

      // Remove from local list
      _guests.removeWhere((g) => g.id == id);

      _isLoading = false;
      notifyListeners();
      return true;
    } catch (e) {
      debugPrint('❌ Error deleting guest: $e');
      _isLoading = false;
      notifyListeners();
      return false;
    }
  }

  // ⚠️ LOCAL STORAGE METHODS REMOVED
  // All data is now managed directly in QloApps database
  // No local backup/cache is maintained

  // Debug: Verify QloApps connection and data
  Future<void> debugPrintQloAppsData() async {
    try {
      debugPrint('🔍 ===== QLOAPPS CONNECTION VERIFICATION =====');

      final isConnected = await _qloAppsService.testConnection();
      debugPrint(
          '📡 Connection Status: ${isConnected ? "✅ Connected" : "❌ Disconnected"}');

      if (isConnected && _guests.isNotEmpty) {
        debugPrint('👥 Number of guests loaded: ${_guests.length}');
        debugPrint('');
        debugPrint('📋 Guest List (from QloApps database):');
        for (var i = 0; i < _guests.length && i < 5; i++) {
          final guest = _guests[i];
          debugPrint('  ${i + 1}. ${guest.fullName}');
          debugPrint('     Customer ID: ${guest.id}');
          debugPrint('     Status: ${guest.status}');
          debugPrint('     Email: ${guest.email ?? "N/A"}');
          debugPrint('');
        }
        if (_guests.length > 5) {
          debugPrint('  ... and ${_guests.length - 5} more guests');
        }
        debugPrint('✅ Data is loaded from QloApps database!');
      } else {
        debugPrint('⚠️ No guests loaded or connection failed');
      }
      debugPrint('🔍 ===== END VERIFICATION =====');
    } catch (e) {
      debugPrint('❌ Error verifying QloApps data: $e');
    }
  }
}
