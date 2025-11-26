import 'package:dio/dio.dart';
import 'package:flutter/foundation.dart';
import '../utils/network_config.dart';

class EscortAttachmentService {
  final Dio _dio;

  EscortAttachmentService()
      : _dio = Dio(BaseOptions(
          connectTimeout: const Duration(seconds: 30),
          receiveTimeout: const Duration(seconds: 30),
        ));

  Future<Map<String, dynamic>> saveAttachment({
    required int escortId,
    required String attachmentType,
    required String filePath,
  }) async {
    try {
      final response = await _dio.post(
        NetworkConfig.escortAttachmentsApiUrl,
        data: {
          'id_escort': escortId,
          'attachment_type': attachmentType,
          'file_path': filePath,
        },
      );

      if (response.statusCode == 200) {
        return response.data;
      } else {
        throw Exception('HTTP ${response.statusCode}: ${response.data}');
      }
    } catch (e) {
      debugPrint('Failed to save escort attachment: $e');
      rethrow;
    }
  }

  Future<List<Map<String, dynamic>>> getAttachments(int escortId) async {
    try {
      final response = await _dio.get(
        NetworkConfig.escortAttachmentsApiUrl,
        queryParameters: {'id_escort': escortId},
      );

      if (response.data['success'] == true) {
        final attachments = response.data['data'] as List;
        return attachments.cast<Map<String, dynamic>>();
      }
      return [];
    } catch (e) {
      debugPrint('Failed to fetch escort attachments: $e');
      return [];
    }
  }

  Future<void> saveMultipleAttachments({
    required int escortId,
    String? frontPhotoPath,
    String? backPhotoPath,
    String? profilePhotoPath,
  }) async {
    try {
      if (frontPhotoPath != null && frontPhotoPath.isNotEmpty) {
        await saveAttachment(
          escortId: escortId,
          attachmentType: 'document_front',
          filePath: frontPhotoPath,
        );
      }

      if (backPhotoPath != null && backPhotoPath.isNotEmpty) {
        await saveAttachment(
          escortId: escortId,
          attachmentType: 'document_back',
          filePath: backPhotoPath,
        );
      }

      if (profilePhotoPath != null && profilePhotoPath.isNotEmpty) {
        await saveAttachment(
          escortId: escortId,
          attachmentType: 'profile_photo',
          filePath: profilePhotoPath,
        );
      }
    } catch (e) {
      debugPrint('Failed to save multiple escort attachments: $e');
      rethrow;
    }
  }
}
