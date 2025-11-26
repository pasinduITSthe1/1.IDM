import 'dart:async';
import 'package:flutter/foundation.dart';
import '../models/notification_model.dart';
import '../services/notification_service.dart';

class NotificationProvider with ChangeNotifier {
  final NotificationService _notificationService = NotificationService();
  Timer? _autoRefreshTimer;

  List<NotificationModel> _notifications = [];
  bool _isLoading = false;
  String? _error;

  List<NotificationModel> get notifications => _notifications;
  bool get isLoading => _isLoading;
  String? get error => _error;

  int get unreadCount => _notifications.where((n) => !n.isRead).length;

  // Auto-refresh every 10 seconds for immediate updates
  void startAutoRefresh() {
    _autoRefreshTimer?.cancel();
    _autoRefreshTimer = Timer.periodic(const Duration(seconds: 10), (timer) {
      loadNotifications(silent: true); // Silent refresh to prevent flickering
    });
  }

  void stopAutoRefresh() {
    _autoRefreshTimer?.cancel();
    _autoRefreshTimer = null;
  }

  @override
  void dispose() {
    stopAutoRefresh();
    super.dispose();
  }

  Future<void> loadNotifications({bool silent = false}) async {
    // Only show loading state for manual refresh, not auto-refresh
    if (!silent) {
      _isLoading = true;
      _error = null;
      notifyListeners();
    }

    try {
      print('🔔 NotificationProvider: Loading notifications...');
      final newNotifications = await _notificationService.getNotifications();

      print(
          '🔔 NotificationProvider: Loaded ${newNotifications.length} notifications');

      // Log notification types
      final typeCount = <String, int>{};
      for (final notif in newNotifications) {
        typeCount[notif.type] = (typeCount[notif.type] ?? 0) + 1;
      }
      print('🔔 NotificationProvider: Types - $typeCount');

      // Only update if notifications actually changed to prevent unnecessary rebuilds
      if (!_notificationsEqual(_notifications, newNotifications)) {
        _notifications = newNotifications;
        notifyListeners();
      }
      _error = null;
    } catch (e) {
      print('🔔 NotificationProvider ERROR: $e');
      _error = e.toString();
      if (!silent) {
        _notifications = [];
      }
      notifyListeners();
    } finally {
      if (!silent) {
        _isLoading = false;
        notifyListeners();
      }
    }
  }

  Future<void> markAsRead(String notificationId) async {
    try {
      await _notificationService.markAsRead(notificationId);

      final index = _notifications.indexWhere((n) => n.id == notificationId);
      if (index != -1) {
        _notifications[index] = _notifications[index].copyWith(isRead: true);
        notifyListeners();
      }
    } catch (e) {
      _error = e.toString();
      notifyListeners();
    }
  }

  Future<void> markAllAsRead() async {
    try {
      await _notificationService.markAllAsRead();

      _notifications =
          _notifications.map((n) => n.copyWith(isRead: true)).toList();
      notifyListeners();
    } catch (e) {
      _error = e.toString();
      notifyListeners();
    }
  }

  Future<void> deleteNotification(String notificationId) async {
    try {
      await _notificationService.deleteNotification(notificationId);

      _notifications.removeWhere((n) => n.id == notificationId);
      notifyListeners();
    } catch (e) {
      _error = e.toString();
      notifyListeners();
    }
  }

  // Helper method to check if notification lists are equal
  bool _notificationsEqual(
      List<NotificationModel> list1, List<NotificationModel> list2) {
    if (list1.length != list2.length) return false;

    for (int i = 0; i < list1.length; i++) {
      if (list1[i].id != list2[i].id ||
          list1[i].isRead != list2[i].isRead ||
          list1[i].timestamp != list2[i].timestamp) {
        return false;
      }
    }
    return true;
  }
}
