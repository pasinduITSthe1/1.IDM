import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import '../providers/notification_provider.dart';
import '../models/notification_model.dart';

class NotificationsScreen extends StatefulWidget {
  const NotificationsScreen({super.key});

  @override
  State<NotificationsScreen> createState() => _NotificationsScreenState();
}

class _NotificationsScreenState extends State<NotificationsScreen> {
  @override
  void initState() {
    super.initState();
    WidgetsBinding.instance.addPostFrameCallback((_) {
      final provider = context.read<NotificationProvider>();
      provider.loadNotifications();
      provider.startAutoRefresh(); // Start auto-refresh
    });
  }

  @override
  void dispose() {
    context.read<NotificationProvider>().stopAutoRefresh();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Colors.white,
      body: SafeArea(
        child: Column(
          children: [
            // Simple Header
            Container(
              width: double.infinity,
              padding: const EdgeInsets.symmetric(horizontal: 20, vertical: 16),
              child: Row(
                children: [
                  Image.asset('assets/images/logo_1.png',
                      height: 40, width: 48, fit: BoxFit.contain),
                  const SizedBox(width: 12),
                  const Expanded(
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        Text('Hotel Staff',
                            style: TextStyle(
                                fontSize: 18,
                                fontWeight: FontWeight.w800,
                                color: Color(0xFF1A1A1A),
                                letterSpacing: -0.3)),
                        Text('Administrator',
                            style: TextStyle(
                                fontSize: 12,
                                color: Colors.grey,
                                fontWeight: FontWeight.w500)),
                      ],
                    ),
                  ),
                ],
              ),
            ),
            // Title with Refresh Button
            Container(
              width: double.infinity,
              padding: const EdgeInsets.symmetric(horizontal: 20, vertical: 12),
              child: Row(
                children: [
                  const Expanded(
                    child: Text('Notifications',
                        style: TextStyle(
                            fontSize: 24,
                            fontWeight: FontWeight.w700,
                            color: Color(0xFF1A1A1A))),
                  ),
                  IconButton(
                    onPressed: () {
                      context
                          .read<NotificationProvider>()
                          .loadNotifications(silent: false);
                    },
                    icon: const Icon(Icons.refresh, color: Color(0xFF007cba)),
                    tooltip: 'Refresh Notifications',
                  ),
                ],
              ),
            ),
            // Simple Notifications List
            Expanded(
              child: Consumer<NotificationProvider>(
                builder: (context, provider, child) {
                  if (provider.isLoading) {
                    return const Center(child: CircularProgressIndicator());
                  }

                  if (provider.error != null) {
                    return _buildErrorState(provider.error!, provider);
                  }

                  if (provider.notifications.isEmpty) {
                    return _buildEmptyState();
                  }

                  return RefreshIndicator(
                    onRefresh: () => provider.loadNotifications(silent: false),
                    child: ListView.builder(
                      key: const ValueKey(
                          'notifications_list'), // Prevent unnecessary rebuilds
                      padding: const EdgeInsets.symmetric(horizontal: 20),
                      itemCount: provider.notifications.length,
                      itemBuilder: (context, index) {
                        final notification = provider.notifications[index];
                        return AnimatedContainer(
                          key: ValueKey(notification.id),
                          duration: const Duration(milliseconds: 200),
                          curve: Curves.easeInOut,
                          child: _buildSimpleNotificationItem(notification),
                        );
                      },
                    ),
                  );
                },
              ),
            ),
          ],
        ),
      ),
    );
  }

  Widget _buildSimpleNotificationItem(NotificationModel notification) {
    Color iconColor;
    Color backgroundColor;
    IconData iconData;

    switch (notification.type.toLowerCase()) {
      case 'checkin':
        iconColor = const Color(0xFF00B894);
        backgroundColor = const Color(0xFF00B894).withValues(alpha: 0.1);
        iconData = Icons.login_rounded;
        break;
      case 'registration':
        iconColor = const Color(0xFF8E44AD);
        backgroundColor = const Color(0xFF8E44AD).withValues(alpha: 0.1);
        iconData = Icons.person_add_rounded;
        break;
      case 'checkout':
        iconColor = const Color(0xFF0984E3);
        backgroundColor = const Color(0xFF0984E3).withValues(alpha: 0.1);
        iconData = Icons.logout_rounded;
        break;
      case 'booking':
        iconColor = const Color(0xFF6C5CE7);
        backgroundColor = const Color(0xFF6C5CE7).withValues(alpha: 0.1);
        iconData = Icons.calendar_today_rounded;
        break;
      case 'housekeeping':
        iconColor = const Color(0xFF00CEC9);
        backgroundColor = const Color(0xFF00CEC9).withValues(alpha: 0.1);
        iconData = Icons.cleaning_services_rounded;
        break;
      case 'maintenance':
        iconColor = const Color(0xFFE84393);
        backgroundColor = const Color(0xFFE84393).withValues(alpha: 0.1);
        iconData = Icons.build_rounded;
        break;
      case 'service':
      default:
        iconColor = const Color(0xFFE17055);
        backgroundColor = const Color(0xFFE17055).withValues(alpha: 0.1);
        iconData = Icons.room_service_rounded;
        break;
    }

    return GestureDetector(
      onTap: () async {
        if (!notification.isRead) {
          await context
              .read<NotificationProvider>()
              .markAsRead(notification.id);
        }
      },
      child: Container(
        margin: const EdgeInsets.only(bottom: 6),
        decoration: BoxDecoration(
          color: notification.isRead ? Colors.grey.shade50 : Colors.white,
          borderRadius: BorderRadius.circular(10),
          border: Border.all(
            color: notification.isRead
                ? Colors.grey.shade200
                : const Color(0xFFFF6B35).withValues(alpha: 0.3),
            width: notification.isRead ? 1 : 1.5,
          ),
          boxShadow: [
            BoxShadow(
              color: Colors.black.withValues(alpha: 0.04),
              blurRadius: 6,
              offset: const Offset(0, 1),
            ),
          ],
        ),
        child: ListTile(
          contentPadding:
              const EdgeInsets.symmetric(horizontal: 10, vertical: 4),
          dense: true,
          leading: Container(
            width: 32,
            height: 32,
            decoration: BoxDecoration(
              color: backgroundColor,
              borderRadius: BorderRadius.circular(8),
            ),
            child: Icon(iconData, color: iconColor, size: 18),
          ),
          title: Row(
            children: [
              Expanded(
                child: Text(
                  notification.title,
                  style: TextStyle(
                    fontSize: 13,
                    fontWeight: FontWeight.w600,
                    color: notification.isRead
                        ? Colors.grey.shade600
                        : const Color(0xFF2D3436),
                  ),
                  maxLines: 1,
                  overflow: TextOverflow.ellipsis,
                ),
              ),
              if (!notification.isRead)
                Container(
                  width: 6,
                  height: 6,
                  decoration: const BoxDecoration(
                    color: Color(0xFFFF6B35),
                    shape: BoxShape.circle,
                  ),
                ),
            ],
          ),
          subtitle: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              const SizedBox(height: 1),
              Text(
                notification.message,
                style: TextStyle(
                  fontSize: 12,
                  color: notification.isRead
                      ? Colors.grey.shade500
                      : Colors.grey.shade600,
                  height: 1.2,
                ),
                maxLines: 2,
                overflow: TextOverflow.ellipsis,
              ),
              const SizedBox(height: 4),
              Row(
                children: [
                  Icon(
                    Icons.access_time_rounded,
                    size: 10,
                    color: Colors.grey.shade400,
                  ),
                  const SizedBox(width: 2),
                  Text(
                    notification.timeAgo,
                    style: TextStyle(
                      fontSize: 10,
                      color: Colors.grey.shade400,
                      fontWeight: FontWeight.w500,
                    ),
                  ),
                ],
              ),
            ],
          ),
        ),
      ),
    );
  }

  Widget _buildEmptyState() {
    return Center(
      child: Column(
        mainAxisAlignment: MainAxisAlignment.center,
        children: [
          Icon(Icons.notifications_none, size: 80, color: Colors.grey[300]),
          const SizedBox(height: 16),
          Text(
            'No notifications',
            style: TextStyle(fontSize: 18, color: Colors.grey[600]),
          ),
          const SizedBox(height: 8),
          Text(
            'You\'re all caught up!',
            style: TextStyle(fontSize: 14, color: Colors.grey[500]),
          ),
        ],
      ),
    );
  }

  Widget _buildErrorState(String error, NotificationProvider provider) {
    return Center(
      child: Column(
        mainAxisAlignment: MainAxisAlignment.center,
        children: [
          Icon(Icons.error_outline, size: 80, color: Colors.red[300]),
          const SizedBox(height: 16),
          Text(
            'Failed to load notifications',
            style: TextStyle(fontSize: 18, color: Colors.grey[600]),
          ),
          const SizedBox(height: 8),
          Text(
            error,
            style: TextStyle(fontSize: 14, color: Colors.grey[500]),
            textAlign: TextAlign.center,
          ),
          const SizedBox(height: 16),
          ElevatedButton.icon(
            onPressed: () => provider.loadNotifications(),
            icon: const Icon(Icons.refresh),
            label: const Text('Retry'),
          ),
        ],
      ),
    );
  }
}
