import 'package:dio/dio.dart';
import 'package:flutter/foundation.dart';

/// Extended QloApps API Service for integrated hotel management
/// Handles check-in, check-out, payments, services, and audit logs
class HotelManagementService {
  final Dio _dio;
  static const String _baseUrl =
      'http://localhost:8080/1.IDM/hotel-backend/api';

  HotelManagementService({Dio? dio})
      : _dio = dio ??
            Dio(BaseOptions(
              baseUrl: _baseUrl,
              connectTimeout: const Duration(seconds: 10),
              receiveTimeout: const Duration(seconds: 10),
              headers: {
                'Content-Type': 'application/json',
              },
            )) {
    // Add logging interceptor
    _dio.interceptors.add(LogInterceptor(
      requestBody: true,
      responseBody: true,
      logPrint: (obj) => debugPrint('🔍 HotelMgmt: $obj'),
    ));
  }

  // ==================== CHECK-IN MANAGEMENT ====================

  /// Record guest check-in
  /// Saves to guest_checkins table and updates QloApps order
  Future<Map<String, dynamic>> checkInGuest({
    required int customerId,
    required int bookingId,
    required int roomId,
    required String roomNumber,
    required String checkedInBy,
    String? notes,
  }) async {
    try {
      debugPrint(
          '📥 Recording check-in for customer: $customerId, room: $roomNumber');

      final payload = {
        'id_customer': customerId,
        'id_booking': bookingId,
        'id_room': roomId,
        'room_number': roomNumber,
        'check_in_time': DateTime.now().toIso8601String(),
        'check_in_method': 'app',
        'checked_in_by': checkedInBy,
        'notes': notes ?? '',
      };

      final response = await _dio.post(
        '/checkin.php',
        data: payload,
      );

      debugPrint('✅ Check-in recorded: ${response.data}');
      return response.data as Map<String, dynamic>;
    } catch (e) {
      debugPrint('❌ Check-in error: $e');
      rethrow;
    }
  }

  // ==================== CHECK-OUT MANAGEMENT ====================

  /// Record guest check-out
  /// Generates bill, processes payment, updates room status
  Future<Map<String, dynamic>> checkOutGuest({
    required int customerId,
    required int checkinId,
    required int roomId,
    required double finalBill,
    required String paymentStatus,
    required String checkedOutBy,
    String? notes,
  }) async {
    try {
      debugPrint('📤 Recording check-out for customer: $customerId');

      final payload = {
        'id_customer': customerId,
        'id_checkin': checkinId,
        'id_room': roomId,
        'check_out_time': DateTime.now().toIso8601String(),
        'check_out_method': 'app',
        'checked_out_by': checkedOutBy,
        'final_bill': finalBill,
        'payment_status': paymentStatus,
        'notes': notes ?? '',
      };

      final response = await _dio.post(
        '/checkout.php',
        data: payload,
      );

      debugPrint('✅ Check-out recorded: ${response.data}');
      return response.data as Map<String, dynamic>;
    } catch (e) {
      debugPrint('❌ Check-out error: $e');
      rethrow;
    }
  }

  // ==================== ROOM MANAGEMENT ====================

  /// Assign room to guest
  Future<Map<String, dynamic>> assignRoom({
    required int customerId,
    required int roomId,
    required String roomNumber,
    required int bookingId,
  }) async {
    try {
      debugPrint('🏠 Assigning room $roomNumber to customer $customerId');

      final payload = {
        'id_customer': customerId,
        'id_room': roomId,
        'id_booking': bookingId,
        'assignment_date': DateTime.now().toIso8601String(),
        'status': 'assigned',
      };

      final response = await _dio.post(
        '/hotel/room-assignments',
        data: payload,
      );

      debugPrint('✅ Room assigned: ${response.data}');
      return response.data as Map<String, dynamic>;
    } catch (e) {
      debugPrint('❌ Room assignment error: $e');
      rethrow;
    }
  }

  /// Release/unassign room from guest
  Future<Map<String, dynamic>> releaseRoom({
    required int assignmentId,
  }) async {
    try {
      debugPrint('🔓 Releasing room assignment: $assignmentId');

      final response = await _dio.put(
        '/hotel/room-assignments/$assignmentId',
        data: {
          'release_date': DateTime.now().toIso8601String(),
          'status': 'released',
        },
      );

      debugPrint('✅ Room released: ${response.data}');
      return response.data as Map<String, dynamic>;
    } catch (e) {
      debugPrint('❌ Room release error: $e');
      rethrow;
    }
  }

  // ==================== PAYMENT MANAGEMENT ====================

  /// Record guest payment
  Future<Map<String, dynamic>> recordPayment({
    required int customerId,
    required int checkinId,
    required double amount,
    required String paymentMethod,
    required String paymentStatus,
    String? referenceNumber,
    String? notes,
  }) async {
    try {
      debugPrint(
          '💳 Recording payment: \$${amount.toStringAsFixed(2)} for customer $customerId');

      final payload = {
        'id_customer': customerId,
        'id_checkin': checkinId,
        'payment_date': DateTime.now().toIso8601String(),
        'amount': amount,
        'payment_method': paymentMethod,
        'payment_status': paymentStatus,
        'reference_number': referenceNumber ?? '',
        'notes': notes ?? '',
      };

      final response = await _dio.post(
        '/hotel/payments',
        data: payload,
      );

      debugPrint('✅ Payment recorded: ${response.data}');
      return response.data as Map<String, dynamic>;
    } catch (e) {
      debugPrint('❌ Payment error: $e');
      rethrow;
    }
  }

  // ==================== SERVICE MANAGEMENT ====================

  /// Add service charge to guest bill
  Future<Map<String, dynamic>> addService({
    required int customerId,
    required int checkinId,
    required String serviceType,
    required double charge,
    String? notes,
  }) async {
    try {
      debugPrint('🛎️  Adding service: $serviceType for customer $customerId');

      final payload = {
        'id_customer': customerId,
        'id_checkin': checkinId,
        'service_type': serviceType,
        'service_date': DateTime.now().toIso8601String(),
        'charge': charge,
        'status': 'pending',
        'notes': notes ?? '',
      };

      final response = await _dio.post(
        '/hotel/services',
        data: payload,
      );

      debugPrint('✅ Service added: ${response.data}');
      return response.data as Map<String, dynamic>;
    } catch (e) {
      debugPrint('❌ Service error: $e');
      rethrow;
    }
  }

  // ==================== AUDIT LOGGING ====================

  /// Log guest action
  Future<Map<String, dynamic>> logAction({
    required int customerId,
    required String actionType,
    required String actionDescription,
    required String performedBy,
  }) async {
    try {
      debugPrint('📝 Logging action: $actionType for customer $customerId');

      final payload = {
        'id_customer': customerId,
        'action_type': actionType,
        'action_description': actionDescription,
        'performed_by': performedBy,
        'performed_at': DateTime.now().toIso8601String(),
      };

      final response = await _dio.post(
        '/hotel/logs',
        data: payload,
      );

      return response.data as Map<String, dynamic>;
    } catch (e) {
      debugPrint('❌ Logging error: $e');
      // Don't rethrow - logging failures shouldn't break main flow
      return {};
    }
  }

  // ==================== DOCUMENT MANAGEMENT ====================

  /// Record guest document
  Future<Map<String, dynamic>> addDocument({
    required int customerId,
    required String documentType,
    required String documentNumber,
    required String countryIssued,
    String? expiryDate,
    String? attachmentPath,
  }) async {
    try {
      debugPrint(
          '📄 Recording document: $documentType for customer $customerId');

      final payload = {
        'id_customer': customerId,
        'document_type': documentType,
        'document_number': documentNumber,
        'country_issued': countryIssued,
        'expiry_date': expiryDate,
        'attachment_path': attachmentPath,
      };

      final response = await _dio.post(
        '/hotel/documents',
        data: payload,
      );

      debugPrint('✅ Document recorded: ${response.data}');
      return response.data as Map<String, dynamic>;
    } catch (e) {
      debugPrint('❌ Document error: $e');
      rethrow;
    }
  }

  /// Add guest attachment (photo)
  Future<Map<String, dynamic>> addAttachment({
    required int customerId,
    required String attachmentType,
    required String filePath,
  }) async {
    try {
      debugPrint(
          '🖼️  Adding attachment: $attachmentType for customer $customerId');

      final payload = {
        'id_customer': customerId,
        'attachment_type': attachmentType,
        'file_path': filePath,
      };

      final response = await _dio.post(
        '/hotel/attachments',
        data: payload,
      );

      debugPrint('✅ Attachment recorded: ${response.data}');
      return response.data as Map<String, dynamic>;
    } catch (e) {
      debugPrint('❌ Attachment error: $e');
      rethrow;
    }
  }

  // ==================== REPORTING ====================

  /// Get complete guest timeline (all activities)
  Future<List<dynamic>> getGuestTimeline(int customerId) async {
    try {
      debugPrint('📊 Fetching timeline for customer: $customerId');

      final response = await _dio.get(
        '/hotel/guests/$customerId/timeline',
      );

      final timeline = response.data['timeline'] as List;
      debugPrint('✅ Timeline fetched: ${timeline.length} events');
      return timeline;
    } catch (e) {
      debugPrint('❌ Timeline error: $e');
      return [];
    }
  }

  /// Get guest current status
  Future<Map<String, dynamic>> getGuestStatus(int customerId) async {
    try {
      debugPrint('🔍 Fetching status for customer: $customerId');

      final response = await _dio.get(
        '/guest-status.php?customer_id=$customerId',
      );

      return response.data as Map<String, dynamic>;
    } catch (e) {
      debugPrint('❌ Status error: $e');
      return {};
    }
  }

  /// Get all guests with their status
  Future<List<Map<String, dynamic>>> getAllGuestsWithStatus() async {
    try {
      debugPrint('📊 Fetching all guests with status...');

      final response = await _dio.get('/guest-status.php');

      if (response.data['success'] == true) {
        final guests = response.data['guests'] as List;
        debugPrint('✅ Found ${guests.length} guests');
        return guests.map((g) => g as Map<String, dynamic>).toList();
      }
      return [];
    } catch (e) {
      debugPrint('❌ Get all guests error: $e');
      return [];
    }
  }

  /// Get dashboard statistics
  Future<Map<String, dynamic>> getDashboardStats() async {
    try {
      debugPrint('📊 Fetching dashboard stats...');

      final response = await _dio.get('/dashboard-stats.php');

      if (response.data['success'] == true) {
        debugPrint('✅ Dashboard stats loaded');
        return response.data['stats'] as Map<String, dynamic>;
      }
      return {};
    } catch (e) {
      debugPrint('❌ Dashboard stats error: $e');
      return {};
    }
  }

  /// Get guest bill summary
  Future<Map<String, dynamic>> getGuestBill(int checkinId) async {
    try {
      debugPrint('💰 Fetching bill for check-in: $checkinId');

      final response = await _dio.get(
        '/hotel/checkins/$checkinId/bill',
      );

      return response.data as Map<String, dynamic>;
    } catch (e) {
      debugPrint('❌ Bill error: $e');
      return {};
    }
  }
}
