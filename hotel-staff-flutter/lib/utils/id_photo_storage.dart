import 'dart:io';
import 'package:path_provider/path_provider.dart';
import 'package:permission_handler/permission_handler.dart';

/// Helper class for managing ID photo storage
/// Saves photos to: /storage/emulated/0/IDM/{guestId}/
class IDPhotoStorage {
  static const String _baseFolder = 'IDM';

  /// Request storage permissions
  static Future<bool> requestPermissions() async {
    if (Platform.isAndroid) {
      final status = await Permission.storage.request();
      if (status.isDenied) {
        // Try manageExternalStorage for Android 11+
        final manageStatus = await Permission.manageExternalStorage.request();
        return manageStatus.isGranted;
      }
      return status.isGranted;
    }
    return true; // iOS handles permissions differently
  }

  /// Get the IDM base directory
  static Future<Directory> getIDMDirectory() async {
    Directory baseDir;

    if (Platform.isAndroid) {
      // Use external storage for Android
      final externalDir = await getExternalStorageDirectory();
      if (externalDir != null) {
        // Navigate to /storage/emulated/0/IDM
        final path = externalDir.path.split('/Android')[0];
        baseDir = Directory('$path/$_baseFolder');
      } else {
        throw Exception('External storage not available');
      }
    } else {
      // Use documents directory for iOS
      final docDir = await getApplicationDocumentsDirectory();
      baseDir = Directory('${docDir.path}/$_baseFolder');
    }

    // Create directory if it doesn't exist
    if (!await baseDir.exists()) {
      await baseDir.create(recursive: true);
    }

    return baseDir;
  }

  /// Get guest-specific directory
  static Future<Directory> getGuestDirectory(String guestId) async {
    final idmDir = await getIDMDirectory();
    final guestDir = Directory('${idmDir.path}/$guestId');

    if (!await guestDir.exists()) {
      await guestDir.create(recursive: true);
    }

    return guestDir;
  }

  /// Save front photo
  static Future<String> saveFrontPhoto(String guestId, String imagePath) async {
    final guestDir = await getGuestDirectory(guestId);
    final file = File(imagePath);
    final newPath = '${guestDir.path}/front.jpg';

    await file.copy(newPath);
    return newPath;
  }

  /// Save back photo
  static Future<String> saveBackPhoto(String guestId, String imagePath) async {
    final guestDir = await getGuestDirectory(guestId);
    final file = File(imagePath);
    final newPath = '${guestDir.path}/back.jpg';

    await file.copy(newPath);
    return newPath;
  }

  /// Get front photo path
  static Future<String?> getFrontPhotoPath(String guestId) async {
    final guestDir = await getGuestDirectory(guestId);
    final file = File('${guestDir.path}/front.jpg');
    return await file.exists() ? file.path : null;
  }

  /// Get back photo path
  static Future<String?> getBackPhotoPath(String guestId) async {
    final guestDir = await getGuestDirectory(guestId);
    final file = File('${guestDir.path}/back.jpg');
    return await file.exists() ? file.path : null;
  }

  /// Delete guest photos
  static Future<void> deleteGuestPhotos(String guestId) async {
    try {
      final guestDir = await getGuestDirectory(guestId);
      if (await guestDir.exists()) {
        await guestDir.delete(recursive: true);
      }
    } catch (e) {
      print('Error deleting photos: $e');
    }
  }

  /// Get storage info
  static Future<Map<String, dynamic>> getStorageInfo() async {
    try {
      final idmDir = await getIDMDirectory();
      final entities = await idmDir.list().toList();
      final guestFolders = entities.whereType<Directory>().toList();

      return {
        'path': idmDir.path,
        'exists': await idmDir.exists(),
        'guestCount': guestFolders.length,
        'guests': guestFolders.map((d) => d.path.split('/').last).toList(),
      };
    } catch (e) {
      return {'error': e.toString()};
    }
  }
}
