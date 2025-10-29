import 'package:flutter/foundation.dart';
import '../services/hotel_management_service.dart';

class CheckoutProvider with ChangeNotifier {
  final HotelManagementService _hotelService = HotelManagementService();
  
  bool _isProcessing = false;
  String? _errorMessage;
  Map<String, dynamic>? _currentBill;

  bool get isProcessing => _isProcessing;
  String? get errorMessage => _errorMessage;
  Map<String, dynamic>? get currentBill => _currentBill;

  /// Get bill for check-in
  Future<Map<String, dynamic>> getBill(int checkinId) async {
    try {
      _isProcessing = true;
      _errorMessage = null;
      notifyListeners();

      _currentBill = await _hotelService.getGuestBill(checkinId);
      
      debugPrint('✅ Bill retrieved: ${_currentBill?['balance_due']}');
      
      _isProcessing = false;
      notifyListeners();
      
      return _currentBill ?? {};
    } catch (e) {
      _errorMessage = 'Failed to retrieve bill: $e';
      debugPrint('❌ Bill error: $e');
      _isProcessing = false;
      notifyListeners();
      return {};
    }
  }

  /// Record payment
  Future<bool> recordPayment({
    required int customerId,
    required int checkinId,
    required double amount,
    required String paymentMethod,
  }) async {
    try {
      _isProcessing = true;
      _errorMessage = null;
      notifyListeners();

      await _hotelService.recordPayment(
        customerId: customerId,
        checkinId: checkinId,
        amount: amount,
        paymentMethod: paymentMethod,
        paymentStatus: 'completed',
      );

      debugPrint('✅ Payment recorded: \$${amount.toStringAsFixed(2)}');
      
      // Refresh bill
      await getBill(checkinId);
      
      _isProcessing = false;
      notifyListeners();
      
      return true;
    } catch (e) {
      _errorMessage = 'Failed to record payment: $e';
      debugPrint('❌ Payment error: $e');
      _isProcessing = false;
      notifyListeners();
      return false;
    }
  }

  /// Finalize check-out
  Future<bool> checkOut({
    required int customerId,
    required int checkinId,
    required int roomId,
    required double finalBill,
    required String paymentStatus,
  }) async {
    try {
      _isProcessing = true;
      _errorMessage = null;
      notifyListeners();

      await _hotelService.checkOutGuest(
        customerId: customerId,
        checkinId: checkinId,
        roomId: roomId,
        finalBill: finalBill,
        paymentStatus: paymentStatus,
        checkedOutBy: 'app_staff',
      );

      debugPrint('✅ Check-out completed');
      
      _isProcessing = false;
      notifyListeners();
      
      return true;
    } catch (e) {
      _errorMessage = 'Failed to check out guest: $e';
      debugPrint('❌ Check-out error: $e');
      _isProcessing = false;
      notifyListeners();
      return false;
    }
  }

  /// Add service charge
  Future<bool> addService({
    required int customerId,
    required int checkinId,
    required String serviceType,
    required double charge,
    String? notes,
  }) async {
    try {
      _isProcessing = true;
      _errorMessage = null;
      notifyListeners();

      await _hotelService.addService(
        customerId: customerId,
        checkinId: checkinId,
        serviceType: serviceType,
        charge: charge,
        notes: notes,
      );

      debugPrint('✅ Service added: $serviceType - \$${charge.toStringAsFixed(2)}');
      
      // Refresh bill
      final checkinData = await _hotelService.getGuestBill(checkinId);
      _currentBill = checkinData;
      
      _isProcessing = false;
      notifyListeners();
      
      return true;
    } catch (e) {
      _errorMessage = 'Failed to add service: $e';
      debugPrint('❌ Service error: $e');
      _isProcessing = false;
      notifyListeners();
      return false;
    }
  }

  /// Get guest status
  Future<Map<String, dynamic>> getGuestStatus(int customerId) async {
    try {
      final status = await _hotelService.getGuestStatus(customerId);
      debugPrint('✅ Guest status: ${status['status']}');
      return status;
    } catch (e) {
      debugPrint('❌ Status error: $e');
      return {};
    }
  }

  /// Get guest timeline (all activities)
  Future<List<dynamic>> getGuestTimeline(int customerId) async {
    try {
      final timeline = await _hotelService.getGuestTimeline(customerId);
      debugPrint('✅ Timeline loaded: ${timeline.length} events');
      return timeline;
    } catch (e) {
      debugPrint('❌ Timeline error: $e');
      return [];
    }
  }

  /// Clear error message
  void clearError() {
    _errorMessage = null;
    notifyListeners();
  }
}
