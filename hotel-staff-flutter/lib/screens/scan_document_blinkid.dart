import 'package:flutter/material.dart';
import 'package:go_router/go_router.dart';
import 'package:blinkid_flutter/blinkid_flutter.dart';
import '../utils/app_theme.dart';

class ScanDocumentBlinkID extends StatefulWidget {
  const ScanDocumentBlinkID({super.key});

  @override
  State<ScanDocumentBlinkID> createState() => _ScanDocumentBlinkIDState();
}

class _ScanDocumentBlinkIDState extends State<ScanDocumentBlinkID> {
  bool _isProcessing = false;
  String? _errorMessage;

  @override
  void initState() {
    super.initState();
    // Start scanning immediately when screen opens
    WidgetsBinding.instance.addPostFrameCallback((_) {
      _startBlinkIDScanning();
    });
  }

  Future<void> _startBlinkIDScanning() async {
    setState(() {
      _isProcessing = true;
      _errorMessage = null;
    });

    try {
      debugPrint('🔍 Starting BlinkID scanner...');

      // Configure SDK settings with license key
      var blinkidSdkSettings = BlinkIdSdkSettings(
        'sRwCABVjb20uaXRzdGhlMS5ob3RlbF9zdGFmZl9hcHABbGV5SkRjbVZoZEdWa1QyNGlPakUzTWprME9EazROREF3TURBc0lrTnlaV0YwWldSR2IzSWlPaUprWldZd01URXlaUzA0TmpFeUxUUmlZall0WVRjd055MHdZalZrTmpBNU5UZzRaR1VpZlE9PQxkQ6rAFcXfuO+Q1Qs5h5C/v5cjL+wYOj8cwZQXhWKAHqVmTANvEGPYKHDHGvuCPZQc+X4pNZ3h4F7AzDZqcJIjWA==',
      );

      // Configure session settings for scanning
      var blinkidSessionSettings = BlinkIdSessionSettings();
      blinkidSessionSettings.scanningMode =
          ScanningMode.automatic; // Automatic document detection

      // Configure scanning settings for image quality
      var scanningSettings = BlinkIdScanningSettings();
      // Use default settings - BlinkID automatically returns all available data
      blinkidSessionSettings.scanningSettings = scanningSettings;

      // Optional: Customize UI (use null for default UI)
      BlinkIdUiSettings? blinkidUiSettings;

      // Start scanning
      var blinkidFlutter = BlinkidFlutter();
      var result = await blinkidFlutter.performScan(
        blinkidSdkSettings,
        blinkidSessionSettings,
        blinkidUiSettings,
      );

      debugPrint('📋 BlinkID scan completed');

      if (result == null) {
        debugPrint('⚠️ No results from BlinkID (scan cancelled or failed)');
        setState(() {
          _errorMessage = 'Scan cancelled. Please try again.';
          _isProcessing = false;
        });
        return;
      }

      // Process results
      Map<String, dynamic> extractedData = {};
      debugPrint('🔍 Processing BlinkIdScanningResult');
      extractedData = _extractBlinkIdCombinedData(result);

      debugPrint('📊 Extracted ${extractedData.length} fields');
      extractedData.forEach((key, value) {
        debugPrint('  $key: $value');
      });

      if (extractedData.isEmpty) {
        setState(() {
          _errorMessage =
              'Could not extract data from document. Please try again.';
          _isProcessing = false;
        });
        return;
      }

      // Navigate to registration with extracted data
      if (mounted) {
        debugPrint(
            '🚀 Navigating to registration with ${extractedData.length} fields');
        context.push('/register', extra: {'scannedData': extractedData});
      }
    } catch (e, stackTrace) {
      debugPrint('❌ BlinkID scanning error: $e');
      debugPrint('Stack trace: $stackTrace');

      if (mounted) {
        setState(() {
          _errorMessage = 'Scanning failed: $e';
          _isProcessing = false;
        });

        // Show error dialog
        showDialog(
          context: context,
          builder: (context) => AlertDialog(
            title: const Text('Scanning Error'),
            content: Text(
                'Failed to scan document: $e\n\nPlease ensure you have a valid BlinkID license key.'),
            actions: [
              TextButton(
                onPressed: () {
                  Navigator.pop(context);
                  if (mounted) {
                    context.pop();
                  }
                },
                child: const Text('OK'),
              ),
            ],
          ),
        );
      }
    }
  }

  Map<String, dynamic> _extractBlinkIdCombinedData(
      BlinkIdScanningResult result) {
    Map<String, dynamic> data = {};

    try {
      debugPrint('📄 Extracting data from BlinkIdScanningResult');

      // Personal information (directly from result)
      if (result.firstName?.value?.isNotEmpty ?? false) {
        data['firstName'] = result.firstName!.value;
        debugPrint('  ✓ firstName: ${data['firstName']}');
      }
      if (result.lastName?.value?.isNotEmpty ?? false) {
        data['lastName'] = result.lastName!.value;
        debugPrint('  ✓ lastName: ${data['lastName']}');
      }
      if (result.fullName?.value?.isNotEmpty ?? false) {
        data['fullName'] = result.fullName!.value;
        debugPrint('  ✓ fullName: ${data['fullName']}');
      }

      // Document information
      if (result.documentNumber?.value?.isNotEmpty ?? false) {
        data['documentNumber'] = result.documentNumber!.value;
        debugPrint('  ✓ documentNumber: ${data['documentNumber']}');
      }

      // Dates
      if (result.dateOfBirth?.date != null) {
        data['dateOfBirth'] = _formatDateResult(result.dateOfBirth!);
        debugPrint('  ✓ dateOfBirth: ${data['dateOfBirth']}');
      }
      if (result.dateOfExpiry?.date != null) {
        data['expiryDate'] = _formatDateResult(result.dateOfExpiry!);
        debugPrint('  ✓ expiryDate: ${data['expiryDate']}');
      }
      if (result.dateOfIssue?.date != null) {
        data['issueDate'] = _formatDateResult(result.dateOfIssue!);
        debugPrint('  ✓ issueDate: ${data['issueDate']}');
      }

      // Personal details
      if (result.sex?.value?.isNotEmpty ?? false) {
        data['gender'] = result.sex!.value;
        debugPrint('  ✓ gender: ${data['gender']}');
      }
      if (result.nationality?.value?.isNotEmpty ?? false) {
        data['nationality'] = result.nationality!.value;
        debugPrint('  ✓ nationality: ${data['nationality']}');
      }
      if (result.address?.value?.isNotEmpty ?? false) {
        data['address'] = result.address!.value;
        debugPrint('  ✓ address: ${data['address']}');
      }
      if (result.issuingAuthority?.value?.isNotEmpty ?? false) {
        data['issuingAuthority'] = result.issuingAuthority!.value;
        debugPrint('  ✓ issuingAuthority: ${data['issuingAuthority']}');
      }

      // Document classification
      if (result.documentClassInfo?.countryName?.isNotEmpty ?? false) {
        data['documentCountry'] = result.documentClassInfo!.countryName;
        debugPrint('  ✓ documentCountry: ${data['documentCountry']}');
      }
      if (result.documentClassInfo?.documentType != null) {
        data['documentType'] =
            result.documentClassInfo!.documentType.toString().split('.').last;
        debugPrint('  ✓ documentType: ${data['documentType']}');
      }

      debugPrint('📊 Total fields extracted: ${data.length}');
    } catch (e) {
      debugPrint('⚠️ Error extracting BlinkID data: $e');
    }

    return data;
  }

  String _formatDateResult(DateResult result) {
    if (result.date != null) {
      return '${result.date!.day.toString().padLeft(2, '0')}/${result.date!.month.toString().padLeft(2, '0')}/${result.date!.year}';
    }
    return result.originalString ?? '';
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Scan Document'),
        backgroundColor: AppTheme.primaryOrange,
        foregroundColor: Colors.white,
      ),
      body: Center(
        child: _isProcessing
            ? Column(
                mainAxisAlignment: MainAxisAlignment.center,
                children: [
                  const CircularProgressIndicator(
                    color: AppTheme.primaryOrange,
                  ),
                  const SizedBox(height: 24),
                  const Text(
                    'Initializing scanner...',
                    style: TextStyle(fontSize: 16),
                  ),
                ],
              )
            : _errorMessage != null
                ? Padding(
                    padding: const EdgeInsets.all(24.0),
                    child: Column(
                      mainAxisAlignment: MainAxisAlignment.center,
                      children: [
                        const Icon(
                          Icons.error_outline,
                          size: 64,
                          color: Colors.red,
                        ),
                        const SizedBox(height: 24),
                        Text(
                          _errorMessage!,
                          textAlign: TextAlign.center,
                          style: const TextStyle(fontSize: 16),
                        ),
                        const SizedBox(height: 24),
                        ElevatedButton.icon(
                          onPressed: () => _startBlinkIDScanning(),
                          icon: const Icon(Icons.refresh),
                          label: const Text('Try Again'),
                          style: ElevatedButton.styleFrom(
                            backgroundColor: AppTheme.primaryOrange,
                            foregroundColor: Colors.white,
                            padding: const EdgeInsets.symmetric(
                              horizontal: 32,
                              vertical: 16,
                            ),
                          ),
                        ),
                        const SizedBox(height: 16),
                        TextButton(
                          onPressed: () => context.pop(),
                          child: const Text('Cancel'),
                        ),
                      ],
                    ),
                  )
                : const SizedBox.shrink(),
      ),
    );
  }
}
