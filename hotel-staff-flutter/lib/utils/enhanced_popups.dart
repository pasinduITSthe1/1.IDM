import 'package:flutter/material.dart';
import 'package:flutter/services.dart';

enum PopupType { success, error, warning, info }

class EnhancedPopups {
  static void showEnhancedSnackBar(
    BuildContext context, {
    required String message,
    PopupType type = PopupType.info,
    Duration duration = const Duration(seconds: 4),
    String? actionLabel,
    VoidCallback? onAction,
  }) {
    final colorScheme = _getColorScheme(type);
    final icon = _getIcon(type);
    final title = _getTitle(type);

    ScaffoldMessenger.of(context).clearSnackBars();
    ScaffoldMessenger.of(context).showSnackBar(
      SnackBar(
        content: Row(
          children: [
            Container(
              padding: const EdgeInsets.all(8),
              decoration: BoxDecoration(
                color: Colors.white.withOpacity(0.2),
                borderRadius: BorderRadius.circular(8),
              ),
              child: Icon(
                icon,
                color: Colors.white,
                size: 24,
              ),
            ),
            const SizedBox(width: 12),
            Expanded(
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                mainAxisSize: MainAxisSize.min,
                children: [
                  Text(
                    title,
                    style: const TextStyle(
                      fontSize: 14,
                      fontWeight: FontWeight.bold,
                      color: Colors.white,
                    ),
                  ),
                  const SizedBox(height: 2),
                  Text(
                    message,
                    style: const TextStyle(
                      fontSize: 13,
                      color: Colors.white,
                    ),
                  ),
                ],
              ),
            ),
            if (actionLabel != null)
              TextButton(
                onPressed: onAction,
                child: Text(
                  actionLabel,
                  style: const TextStyle(
                    color: Colors.white,
                    fontWeight: FontWeight.bold,
                  ),
                ),
              ),
          ],
        ),
        backgroundColor: colorScheme.primary,
        duration: duration,
        behavior: SnackBarBehavior.floating,
        shape: RoundedRectangleBorder(
          borderRadius: BorderRadius.circular(12),
        ),
        margin: const EdgeInsets.all(16),
        padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 12),
        elevation: 6,
      ),
    );

    // Add haptic feedback based on type
    switch (type) {
      case PopupType.success:
        HapticFeedback.lightImpact();
        break;
      case PopupType.error:
        HapticFeedback.heavyImpact();
        break;
      case PopupType.warning:
        HapticFeedback.mediumImpact();
        break;
      case PopupType.info:
        HapticFeedback.selectionClick();
        break;
    }
  }

  static Future<bool?> showEnhancedConfirmDialog(
    BuildContext context, {
    required String title,
    required String message,
    String confirmText = 'Confirm',
    String cancelText = 'Cancel',
    PopupType type = PopupType.warning,
    bool isDestructive = false,
  }) async {
    return showDialog<bool>(
      context: context,
      barrierDismissible: false,
      builder: (BuildContext context) {
        return AlertDialog(
          shape: RoundedRectangleBorder(
            borderRadius: BorderRadius.circular(16),
          ),
          title: Row(
            children: [
              Container(
                padding: const EdgeInsets.all(8),
                decoration: BoxDecoration(
                  color: _getColorScheme(type).primary.withOpacity(0.1),
                  shape: BoxShape.circle,
                ),
                child: Icon(
                  _getIcon(type),
                  color: _getColorScheme(type).primary,
                  size: 24,
                ),
              ),
              const SizedBox(width: 12),
              Expanded(
                child: Text(
                  title,
                  style: const TextStyle(
                    fontSize: 18,
                    fontWeight: FontWeight.bold,
                  ),
                ),
              ),
            ],
          ),
          content: Text(
            message,
            style: const TextStyle(fontSize: 16),
          ),
          actions: [
            TextButton(
              onPressed: () => Navigator.of(context).pop(false),
              child: Text(
                cancelText,
                style: TextStyle(
                  color: Colors.grey[600],
                  fontWeight: FontWeight.w500,
                ),
              ),
            ),
            ElevatedButton(
              onPressed: () => Navigator.of(context).pop(true),
              style: ElevatedButton.styleFrom(
                backgroundColor:
                    isDestructive ? Colors.red : _getColorScheme(type).primary,
                foregroundColor: Colors.white,
                shape: RoundedRectangleBorder(
                  borderRadius: BorderRadius.circular(8),
                ),
                padding: const EdgeInsets.symmetric(
                  horizontal: 24,
                  vertical: 12,
                ),
              ),
              child: Text(
                confirmText,
                style: const TextStyle(fontWeight: FontWeight.w600),
              ),
            ),
          ],
        );
      },
    );
  }

  static Future<void> showEnhancedInfoDialog(
    BuildContext context, {
    required String title,
    required String message,
    String buttonText = 'OK',
    PopupType type = PopupType.info,
  }) async {
    return showDialog<void>(
      context: context,
      builder: (BuildContext context) {
        return AlertDialog(
          shape: RoundedRectangleBorder(
            borderRadius: BorderRadius.circular(16),
          ),
          title: Row(
            children: [
              Container(
                padding: const EdgeInsets.all(8),
                decoration: BoxDecoration(
                  color: _getColorScheme(type).primary.withOpacity(0.1),
                  shape: BoxShape.circle,
                ),
                child: Icon(
                  _getIcon(type),
                  color: _getColorScheme(type).primary,
                  size: 24,
                ),
              ),
              const SizedBox(width: 12),
              Expanded(
                child: Text(
                  title,
                  style: const TextStyle(
                    fontSize: 18,
                    fontWeight: FontWeight.bold,
                  ),
                ),
              ),
            ],
          ),
          content: Text(
            message,
            style: const TextStyle(fontSize: 16),
          ),
          actions: [
            ElevatedButton(
              onPressed: () => Navigator.of(context).pop(),
              style: ElevatedButton.styleFrom(
                backgroundColor: _getColorScheme(type).primary,
                foregroundColor: Colors.white,
                shape: RoundedRectangleBorder(
                  borderRadius: BorderRadius.circular(8),
                ),
                padding: const EdgeInsets.symmetric(
                  horizontal: 24,
                  vertical: 12,
                ),
              ),
              child: Text(
                buttonText,
                style: const TextStyle(fontWeight: FontWeight.w600),
              ),
            ),
          ],
        );
      },
    );
  }

  static _ColorScheme _getColorScheme(PopupType type) {
    switch (type) {
      case PopupType.success:
        return _ColorScheme(
          primary: const Color(0xFF10B981), // Modern green
          background: const Color(0xFFE8F5E8),
        );
      case PopupType.error:
        return _ColorScheme(
          primary: const Color(0xFFEF4444), // Modern red
          background: const Color(0xFFFFEBEE),
        );
      case PopupType.warning:
        return _ColorScheme(
          primary: const Color(0xFFF59E0B), // Modern amber
          background: const Color(0xFFFFF3E0),
        );
      case PopupType.info:
        return _ColorScheme(
          primary: const Color(0xFF3B82F6), // Modern blue
          background: const Color(0xFFE3F2FD),
        );
    }
  }

  static IconData _getIcon(PopupType type) {
    switch (type) {
      case PopupType.success:
        return Icons.check_circle_rounded;
      case PopupType.error:
        return Icons.error_rounded;
      case PopupType.warning:
        return Icons.warning_rounded;
      case PopupType.info:
        return Icons.info_rounded;
    }
  }

  static String _getTitle(PopupType type) {
    switch (type) {
      case PopupType.success:
        return 'Success';
      case PopupType.error:
        return 'Error';
      case PopupType.warning:
        return 'Warning';
      case PopupType.info:
        return 'Information';
    }
  }
}

class _ColorScheme {
  final Color primary;
  final Color background;

  _ColorScheme({required this.primary, required this.background});
}
