import 'dart:convert';
import 'package:http/http.dart' as http;
import '../models/notification_model.dart';
import '../utils/network_config.dart';

class NotificationService {
  final String baseUrl = NetworkConfig.notificationsApiUrl;

  Future<List<NotificationModel>> getNotifications() async {
    try {
      final url = '$baseUrl/get-notifications.php';
      print('🔔 NotificationService: Fetching from $url');

      final response = await http.get(
        Uri.parse(url),
        headers: {'Content-Type': 'application/json'},
      );

      print('🔔 NotificationService: Response status ${response.statusCode}');
      print('🔔 NotificationService: Response body ${response.body}');

      if (response.statusCode == 200) {
        final data = json.decode(response.body);
        if (data['success'] == true) {
          final List<dynamic> notificationsJson = data['notifications'] ?? [];
          print(
              '🔔 NotificationService: Found ${notificationsJson.length} notifications');
          return notificationsJson
              .map((json) => NotificationModel.fromJson(json))
              .toList();
        } else {
          throw Exception(data['message'] ?? 'Failed to load notifications');
        }
      } else {
        throw Exception('Server error: ${response.statusCode}');
      }
    } catch (e) {
      print('🔔 NotificationService ERROR: $e');
      throw Exception('Failed to load notifications: $e');
    }
  }

  Future<void> markAsRead(String notificationId) async {
    try {
      final response = await http.post(
        Uri.parse('$baseUrl/mark-notification-read.php'),
        headers: {'Content-Type': 'application/json'},
        body: json.encode({'notification_id': notificationId}),
      );

      if (response.statusCode == 200) {
        final data = json.decode(response.body);
        if (data['success'] != true) {
          throw Exception(data['message'] ?? 'Failed to mark as read');
        }
      } else {
        throw Exception('Server error: ${response.statusCode}');
      }
    } catch (e) {
      throw Exception('Failed to mark notification as read: $e');
    }
  }

  Future<void> markAllAsRead() async {
    try {
      final response = await http.post(
        Uri.parse('$baseUrl/mark-all-notifications-read.php'),
        headers: {'Content-Type': 'application/json'},
      );

      if (response.statusCode == 200) {
        final data = json.decode(response.body);
        if (data['success'] != true) {
          throw Exception(data['message'] ?? 'Failed to mark all as read');
        }
      } else {
        throw Exception('Server error: ${response.statusCode}');
      }
    } catch (e) {
      throw Exception('Failed to mark all notifications as read: $e');
    }
  }

  Future<void> deleteNotification(String notificationId) async {
    try {
      final response = await http.post(
        Uri.parse('$baseUrl/delete-notification.php'),
        headers: {'Content-Type': 'application/json'},
        body: json.encode({'notification_id': notificationId}),
      );

      if (response.statusCode == 200) {
        final data = json.decode(response.body);
        if (data['success'] != true) {
          throw Exception(data['message'] ?? 'Failed to delete notification');
        }
      } else {
        throw Exception('Server error: ${response.statusCode}');
      }
    } catch (e) {
      throw Exception('Failed to delete notification: $e');
    }
  }
}
