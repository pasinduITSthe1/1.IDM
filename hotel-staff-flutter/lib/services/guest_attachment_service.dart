import 'package:dio/dio.dart';
import 'package:flutter/foundation.dart';
import '../utils/network_config.dart';

class GuestAttachmentService {
  final Dio _dio;

  GuestAttachmentService()
      : _dio = Dio(BaseOptions(
          connectTimeout: const Duration(seconds: 30),
          receiveTimeout: const Duration(seconds: 30),
        ));

  Future<Map<String, dynamic>> saveAttachment({
    required int customerId,
    required String attachmentType,
    required String filePath,
  }) async {
    try {
      final response = await _dio.post(
        NetworkConfig.guestAttachmentsApiUrl,
        data: {
          'id_customer': customerId,
          'attachment_type': attachmentType,
          'file_path': filePath,
        },
        options: Options(
          headers: {'Content-Type': 'application/json'},
        ),
      );
      return response.data as Map<String, dynamic>;
    } catch (e) {
      debugPrint('Failed to save attachment: $e');
      rethrow;
    }
  }

  Future<List<Map<String, dynamic>>> getAttachments(int customerId) async {
    try {
      final response = await _dio.get(
        NetworkConfig.guestAttachmentsApiUrl,
        queryParameters: {'id_customer': customerId},
      );
      if (response.data['success'] == true) {
        final attachments = response.data['data'] as List;
        return attachments.cast<Map<String, dynamic>>();
      }
      return [];
    } catch (e) {
      debugPrint('Failed to fetch attachments: $e');
      return [];
    }
  }

  Future<bool> saveMultipleAttachments({
    required int customerId,
    String? frontPhotoPath,
    String? backPhotoPath,
    String? passportPhotoPath,
  }) async {
    try {
      int savedCount = 0;

      if (frontPhotoPath != null && frontPhotoPath.isNotEmpty) {
        await saveAttachment(
          customerId: customerId,
          attachmentType: 'id_front',
          filePath: frontPhotoPath,
        );
        savedCount++;
      }

      if (backPhotoPath != null && backPhotoPath.isNotEmpty) {
        await saveAttachment(
          customerId: customerId,
          attachmentType: 'id_back',
          filePath: backPhotoPath,
        );
        savedCount++;
      }

      if (passportPhotoPath != null && passportPhotoPath.isNotEmpty) {
        await saveAttachment(
          customerId: customerId,
          attachmentType: 'passport',
          filePath: passportPhotoPath,
        );
        savedCount++;
      }

      return savedCount > 0;
    } catch (e) {
      debugPrint('Failed to save multiple attachments: $e');
      return false;
    }
  }
}
