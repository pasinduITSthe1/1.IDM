import 'package:flutter/foundation.dart';
import '../models/guest.dart';
import 'api_service.dart';

class GuestService {
  final ApiService _apiService = ApiService();

  // Fetch all guests from API
  Future<List<Guest>> fetchGuests() async {
    try {
      debugPrint('🔄 Fetching guests from API...');
      final response = await _apiService.get('/guests');

      if (response['success'] == true) {
        final List<dynamic> guestsData = response['data'] as List<dynamic>;
        final guests = guestsData
            .map((json) => Guest.fromApiJson(json as Map<String, dynamic>))
            .toList();

        debugPrint('✅ Fetched ${guests.length} guests from API');
        return guests;
      } else {
        throw Exception('Failed to fetch guests');
      }
    } catch (e) {
      debugPrint('❌ Error fetching guests: $e');
      throw Exception('Failed to fetch guests: $e');
    }
  }

  // Create new guest
  Future<Guest> createGuest(Guest guest) async {
    try {
      debugPrint('🔄 Creating guest: ${guest.fullName}');

      final data = {
        'firstName': guest.firstName,
        'lastName': guest.lastName,
        'documentNumber': guest.documentNumber,
        'documentType': guest.documentType,
        'issuedCountry': guest.issuedCountry,
        'issuedDate': guest.issuedDate,
        'expiryDate': guest.expiryDate,
        'dateOfBirth': guest.dateOfBirth,
        'sex': guest.sex,
        'nationality': guest.nationality,
        'email': guest.email,
        'phone': guest.phone,
        'address': guest.address,
        'visitPurpose': guest.visitPurpose,
        'status': guest.status,
        'roomNumber': guest.roomNumber,
      };

      final response = await _apiService.post('/guests', data);

      if (response['success'] == true) {
        final createdGuest =
            Guest.fromApiJson(response['data'] as Map<String, dynamic>);
        debugPrint('✅ Guest created successfully: ${createdGuest.id}');
        return createdGuest;
      } else {
        throw Exception('Failed to create guest');
      }
    } catch (e) {
      debugPrint('❌ Error creating guest: $e');
      throw Exception('Failed to create guest: $e');
    }
  }

  // Update guest
  Future<Guest> updateGuest(String id, Guest guest) async {
    try {
      debugPrint('🔄 Updating guest: $id');

      final data = {
        'firstName': guest.firstName,
        'lastName': guest.lastName,
        'documentNumber': guest.documentNumber,
        'documentType': guest.documentType,
        'issuedCountry': guest.issuedCountry,
        'issuedDate': guest.issuedDate,
        'expiryDate': guest.expiryDate,
        'dateOfBirth': guest.dateOfBirth,
        'sex': guest.sex,
        'nationality': guest.nationality,
        'email': guest.email,
        'phone': guest.phone,
        'address': guest.address,
        'visitPurpose': guest.visitPurpose,
        'status': guest.status,
        'roomNumber': guest.roomNumber,
      };

      final response = await _apiService.put('/guests/$id', data);

      if (response['success'] == true) {
        final updatedGuest =
            Guest.fromApiJson(response['data'] as Map<String, dynamic>);
        debugPrint('✅ Guest updated successfully');
        return updatedGuest;
      } else {
        throw Exception('Failed to update guest');
      }
    } catch (e) {
      debugPrint('❌ Error updating guest: $e');
      throw Exception('Failed to update guest: $e');
    }
  }

  // Delete guest
  Future<void> deleteGuest(String id) async {
    try {
      debugPrint('🔄 Deleting guest: $id');

      final response = await _apiService.delete('/guests/$id');

      if (response['success'] == true) {
        debugPrint('✅ Guest deleted successfully');
      } else {
        throw Exception('Failed to delete guest');
      }
    } catch (e) {
      debugPrint('❌ Error deleting guest: $e');
      throw Exception('Failed to delete guest: $e');
    }
  }

  // Check-in guest
  Future<Guest> checkInGuest(String id, String roomNumber,
      {String? expectedCheckoutDate, String? notes}) async {
    try {
      debugPrint('🔄 Checking in guest: $id to room $roomNumber');

      final requestData = {
        'roomNumber': roomNumber,
        if (expectedCheckoutDate != null)
          'expectedCheckoutDate': expectedCheckoutDate,
        if (notes != null) 'notes': notes,
      };

      final response = await _apiService.put(
        '/guests/$id/checkin',
        requestData,
      );

      if (response['success'] == true) {
        debugPrint('✅ Guest checked in successfully');
        debugPrint('📦 Response data: ${response['data']}');

        // Backend now returns check-in record, we need to fetch updated guest
        final guestResponse = await _apiService.get('/guests/$id');
        if (guestResponse['success'] == true) {
          final guest =
              Guest.fromApiJson(guestResponse['data'] as Map<String, dynamic>);
          return guest;
        } else {
          throw Exception('Failed to fetch updated guest data');
        }
      } else {
        throw Exception('Failed to check in guest');
      }
    } catch (e) {
      debugPrint('❌ Error checking in guest: $e');
      throw Exception('Failed to check in guest: $e');
    }
  }

  // Check-out guest
  Future<Guest> checkOutGuest(String id,
      {double? totalAmount,
      String? paymentStatus,
      String? paymentMethod,
      String? notes}) async {
    try {
      debugPrint('🔄 Checking out guest: $id');

      final requestData = {
        if (totalAmount != null) 'totalAmount': totalAmount,
        if (paymentStatus != null) 'paymentStatus': paymentStatus,
        if (paymentMethod != null) 'paymentMethod': paymentMethod,
        if (notes != null) 'notes': notes,
      };

      final response =
          await _apiService.put('/guests/$id/checkout', requestData);

      if (response['success'] == true) {
        debugPrint('✅ Guest checked out successfully');
        debugPrint('📦 Response data: ${response['data']}');

        // Backend now returns checkout record, we need to fetch updated guest
        final guestResponse = await _apiService.get('/guests/$id');
        if (guestResponse['success'] == true) {
          final guest =
              Guest.fromApiJson(guestResponse['data'] as Map<String, dynamic>);
          return guest;
        } else {
          throw Exception('Failed to fetch updated guest data');
        }
      } else {
        throw Exception('Failed to check out guest');
      }
    } catch (e) {
      debugPrint('❌ Error checking out guest: $e');
      throw Exception('Failed to check out guest: $e');
    }
  }
}
