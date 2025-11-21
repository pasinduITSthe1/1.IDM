import 'dart:io';
import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:go_router/go_router.dart';
import 'package:uuid/uuid.dart';
import '../providers/escort_provider.dart';
import '../models/escort.dart';
import '../services/escort_attachment_service.dart';
import '../utils/app_theme.dart';
import '../utils/enhanced_popups.dart';

class EscortRegistrationScreen extends StatefulWidget {
  final String guestId; // The main guest ID
  final String guestName; // Main guest name for display
  final Map<String, dynamic>? scannedData;

  const EscortRegistrationScreen({
    super.key,
    required this.guestId,
    required this.guestName,
    this.scannedData,
  });

  @override
  State<EscortRegistrationScreen> createState() =>
      _EscortRegistrationScreenState();
}

class _EscortRegistrationScreenState extends State<EscortRegistrationScreen> {
  final _formKey = GlobalKey<FormState>();
  final _firstNameController = TextEditingController();
  final _lastNameController = TextEditingController();
  final _documentNumberController = TextEditingController();
  final _dateOfBirthController = TextEditingController();
  final _nationalityController = TextEditingController();
  final _emailController = TextEditingController();
  final _phoneController = TextEditingController();
  final _addressController = TextEditingController();
  final _issuedCountryController = TextEditingController();
  final _issuedDateController = TextEditingController();
  final _expiryDateController = TextEditingController();

  String _selectedSex = 'M';
  String _selectedDocumentType = 'passport';
  String _selectedRelationship = 'companion';
  bool _isLoading = false;

  // Photo paths from scanned data
  String? _frontPhotoPath;
  String? _backPhotoPath;
  bool _isPassport = false;

  @override
  void initState() {
    super.initState();
    _populateScannedData();
  }

  void _populateScannedData() {
    if (widget.scannedData != null) {
      debugPrint('📥 Received scanned data for escort: ${widget.scannedData}');

      final data = widget.scannedData!;

      // Extract photo paths
      _frontPhotoPath = data['frontPhotoPath'];
      _backPhotoPath = data['backPhotoPath'];

      // Extract passport flag
      if (data['isPassport'] != null) {
        _isPassport = data['isPassport'].toString().toLowerCase() == 'true';
      }

      // Populate text fields
      _firstNameController.text = data['firstName'] ?? '';
      _lastNameController.text = data['lastName'] ?? '';
      _documentNumberController.text = data['documentNumber'] ?? '';
      _dateOfBirthController.text = data['dateOfBirth'] ?? '';
      _nationalityController.text = data['nationality'] ?? '';
      _issuedCountryController.text = data['issuedCountry'] ?? '';
      _issuedDateController.text = data['issuedDate'] ?? '';

      // Handle expiration date
      if (data.containsKey('expirationDate')) {
        _expiryDateController.text = data['expirationDate'] ?? '';
      } else if (data.containsKey('expiryDate')) {
        _expiryDateController.text = data['expiryDate'] ?? '';
      }

      // Handle sex
      if (data['sex'] != null) {
        final sex = data['sex'].toString().toUpperCase();
        if (sex == 'M' || sex == 'F') {
          _selectedSex = sex;
        }
      }

      // Handle document type
      if (data['documentType'] != null) {
        final docType = data['documentType'].toString().toLowerCase();
        if (docType == 'passport') {
          _selectedDocumentType = 'passport';
        } else if (docType == 'id card' ||
            docType == 'id_card' ||
            docType == 'idcard') {
          _selectedDocumentType = 'id_card';
        } else if (docType == 'visa') {
          _selectedDocumentType = 'visa';
        } else {
          _selectedDocumentType = docType;
        }
      }

      int populatedCount = [
        _firstNameController.text,
        _lastNameController.text,
        _documentNumberController.text,
        _dateOfBirthController.text,
        _nationalityController.text
      ].where((text) => text.isNotEmpty).length;

      if (populatedCount > 0) {
        WidgetsBinding.instance.addPostFrameCallback((_) {
          EnhancedPopups.showEnhancedSnackBar(
            context,
            message:
                'Auto-filled $populatedCount fields. Please verify and complete the form.',
            type: PopupType.success,
            duration: const Duration(seconds: 4),
          );
        });
      }
    }
  }

  @override
  void dispose() {
    _firstNameController.dispose();
    _lastNameController.dispose();
    _documentNumberController.dispose();
    _dateOfBirthController.dispose();
    _nationalityController.dispose();
    _emailController.dispose();
    _phoneController.dispose();
    _addressController.dispose();
    _issuedCountryController.dispose();
    _issuedDateController.dispose();
    _expiryDateController.dispose();
    super.dispose();
  }

  Future<void> _selectDate() async {
    final DateTime? picked = await showDatePicker(
      context: context,
      initialDate: DateTime(1990),
      firstDate: DateTime(1900),
      lastDate: DateTime.now(),
      builder: (context, child) {
        return Theme(
          data: Theme.of(context).copyWith(
            colorScheme: const ColorScheme.light(
              primary: AppTheme.primaryOrange,
            ),
          ),
          child: child!,
        );
      },
    );

    if (picked != null) {
      setState(() {
        _dateOfBirthController.text =
            '${picked.year}-${picked.month.toString().padLeft(2, '0')}-${picked.day.toString().padLeft(2, '0')}';
      });
    }
  }

  Future<void> _selectIssuedDate() async {
    final DateTime? picked = await showDatePicker(
      context: context,
      initialDate: DateTime.now(),
      firstDate: DateTime(1900),
      lastDate: DateTime.now(),
      builder: (context, child) {
        return Theme(
          data: Theme.of(context).copyWith(
            colorScheme: const ColorScheme.light(
              primary: AppTheme.primaryOrange,
            ),
          ),
          child: child!,
        );
      },
    );

    if (picked != null) {
      setState(() {
        _issuedDateController.text =
            '${picked.year}-${picked.month.toString().padLeft(2, '0')}-${picked.day.toString().padLeft(2, '0')}';
      });
    }
  }

  Future<void> _selectExpiryDate() async {
    final DateTime? picked = await showDatePicker(
      context: context,
      initialDate: DateTime.now().add(const Duration(days: 365)),
      firstDate: DateTime.now(),
      lastDate: DateTime.now().add(const Duration(days: 3650)),
      builder: (context, child) {
        return Theme(
          data: Theme.of(context).copyWith(
            colorScheme: const ColorScheme.light(
              primary: AppTheme.primaryOrange,
            ),
          ),
          child: child!,
        );
      },
    );

    if (picked != null) {
      setState(() {
        _expiryDateController.text =
            '${picked.year}-${picked.month.toString().padLeft(2, '0')}-${picked.day.toString().padLeft(2, '0')}';
      });
    }
  }

  Future<void> _scanDocument() async {
    // Navigate to MRZ scanner
    final result = await context.push('/scan');

    if (result != null && result is Map<String, dynamic> && mounted) {
      // The result from scanning flow includes scanned data
      // Repopulate the form with scanned data
      setState(() {
        if (result['firstName'] != null) {
          _firstNameController.text = result['firstName'];
        }
        if (result['lastName'] != null) {
          _lastNameController.text = result['lastName'];
        }
        if (result['documentNumber'] != null) {
          _documentNumberController.text = result['documentNumber'];
        }
        if (result['dateOfBirth'] != null) {
          _dateOfBirthController.text = result['dateOfBirth'];
        }
        if (result['nationality'] != null) {
          _nationalityController.text = result['nationality'];
        }
        if (result['issuedCountry'] != null) {
          _issuedCountryController.text = result['issuedCountry'];
        }
        if (result['issuedDate'] != null) {
          _issuedDateController.text = result['issuedDate'];
        }
        if (result['expiryDate'] != null || result['expirationDate'] != null) {
          _expiryDateController.text =
              result['expiryDate'] ?? result['expirationDate'] ?? '';
        }
        if (result['sex'] != null) {
          final sex = result['sex'].toString().toUpperCase();
          if (sex == 'M' || sex == 'F') {
            _selectedSex = sex;
          }
        }
        if (result['documentType'] != null) {
          final docType = result['documentType'].toString().toLowerCase();
          if (docType == 'passport') {
            _selectedDocumentType = 'passport';
          } else if (docType.contains('id')) {
            _selectedDocumentType = 'id_card';
          }
        }
        if (result['frontPhotoPath'] != null) {
          _frontPhotoPath = result['frontPhotoPath'];
        }
        if (result['backPhotoPath'] != null) {
          _backPhotoPath = result['backPhotoPath'];
        }
        if (result['isPassport'] != null) {
          _isPassport = result['isPassport'].toString().toLowerCase() == 'true';
        }
      });

      // Show success message
      EnhancedPopups.showEnhancedSnackBar(
        context,
        message:
            'Document scanned! Form auto-filled. Please review and complete.',
        type: PopupType.success,
        duration: const Duration(seconds: 3),
      );
    }
  }

  void _previewPhoto(String photoPath, String title) {
    showDialog(
      context: context,
      builder: (context) => Dialog(
        child: Column(
          mainAxisSize: MainAxisSize.min,
          children: [
            AppBar(
              title: Text(title),
              backgroundColor: AppTheme.primaryOrange,
              foregroundColor: Colors.white,
              leading: IconButton(
                icon: const Icon(Icons.close),
                onPressed: () => Navigator.pop(context),
              ),
            ),
            Expanded(
              child: InteractiveViewer(
                panEnabled: true,
                minScale: 0.5,
                maxScale: 4.0,
                child: Image.file(
                  File(photoPath),
                  fit: BoxFit.contain,
                ),
              ),
            ),
          ],
        ),
      ),
    );
  }

  Future<void> _handleSubmit() async {
    if (_formKey.currentState!.validate()) {
      setState(() => _isLoading = true);

      final escort = Escort(
        id: const Uuid().v4(),
        guestId: widget.guestId,
        firstName: _firstNameController.text,
        lastName: _lastNameController.text,
        documentNumber: _documentNumberController.text,
        dateOfBirth: _dateOfBirthController.text,
        nationality: _nationalityController.text,
        sex: _selectedSex,
        email: _emailController.text.isNotEmpty ? _emailController.text : null,
        phone: _phoneController.text.isNotEmpty ? _phoneController.text : null,
        address:
            _addressController.text.isNotEmpty ? _addressController.text : null,
        documentType: _selectedDocumentType,
        issuedCountry: _issuedCountryController.text.isNotEmpty
            ? _issuedCountryController.text
            : null,
        issuedDate: _issuedDateController.text.isNotEmpty
            ? _issuedDateController.text
            : null,
        expiryDate: _expiryDateController.text.isNotEmpty
            ? _expiryDateController.text
            : null,
        relationshipToGuest: _selectedRelationship,
      );

      final escortProvider =
          Provider.of<EscortProvider>(context, listen: false);
      final escortId = await escortProvider.addEscort(escort);

      // 📸 Save photo attachments to database if escort creation was successful
      if (escortId != null &&
          (_frontPhotoPath != null || _backPhotoPath != null)) {
        await _savePhotoAttachmentsToDatabase(escortId);
      }

      setState(() => _isLoading = false);

      if (escortId != null && mounted) {
        EnhancedPopups.showEnhancedSnackBar(
          context,
          message: 'Escort registered successfully!',
          type: PopupType.success,
        );
        context.pop(true); // Return true to indicate success
      } else if (mounted) {
        EnhancedPopups.showEnhancedSnackBar(
          context,
          message: 'Failed to register escort',
          type: PopupType.error,
        );
      }
    }
  }

  /// Save photo attachments to database
  Future<void> _savePhotoAttachmentsToDatabase(String escortId) async {
    try {
      debugPrint('📸 Saving escort photo attachments to database...');

      final attachmentService = EscortAttachmentService();

      // Convert escort ID to integer (needed for database)
      final escortIdInt = int.tryParse(escortId) ?? 0;

      if (escortIdInt > 0) {
        await attachmentService.saveMultipleAttachments(
          escortId: escortIdInt,
          frontPhotoPath: _frontPhotoPath,
          backPhotoPath: _backPhotoPath,
        );

        debugPrint('✅ Escort photo attachments saved to database');
      } else {
        debugPrint('❌ Invalid escort ID for attachment saving: $escortId');
      }
    } catch (e) {
      debugPrint('❌ Failed to save escort photo attachments: $e');
      // Don't throw error - escort is already created, attachments are optional
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Add Escort/Companion'),
        actions: [
          if (widget.scannedData == null) // Only show if not already scanned
            IconButton(
              icon: const Icon(Icons.qr_code_scanner),
              tooltip: 'Scan Document',
              onPressed: _scanDocument,
            ),
        ],
      ),
      body: Form(
        key: _formKey,
        child: SingleChildScrollView(
          padding: const EdgeInsets.all(16),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.stretch,
            children: [
              // Guest Info Banner
              Container(
                padding: const EdgeInsets.all(12),
                decoration: BoxDecoration(
                  color: AppTheme.primaryOrange.withOpacity(0.1),
                  borderRadius: BorderRadius.circular(8),
                  border: Border.all(
                      color: AppTheme.primaryOrange.withOpacity(0.3)),
                ),
                child: Row(
                  children: [
                    const Icon(Icons.person,
                        color: AppTheme.primaryOrange, size: 20),
                    const SizedBox(width: 8),
                    Expanded(
                      child: Text(
                        'Adding escort for: ${widget.guestName}',
                        style: const TextStyle(
                          fontSize: 14,
                          fontWeight: FontWeight.w600,
                        ),
                      ),
                    ),
                  ],
                ),
              ),
              const SizedBox(height: 16),

              // Scan Document Button (if no scanned data yet)
              if (widget.scannedData == null && _frontPhotoPath == null) ...[
                SizedBox(
                  width: double.infinity,
                  child: OutlinedButton.icon(
                    onPressed: _scanDocument,
                    icon: const Icon(Icons.qr_code_scanner, size: 28),
                    label: const Text(
                      'Scan Passport or ID Card',
                      style:
                          TextStyle(fontSize: 16, fontWeight: FontWeight.bold),
                    ),
                    style: OutlinedButton.styleFrom(
                      foregroundColor: AppTheme.primaryOrange,
                      side: const BorderSide(
                          color: AppTheme.primaryOrange, width: 2),
                      padding: const EdgeInsets.symmetric(vertical: 16),
                      shape: RoundedRectangleBorder(
                        borderRadius: BorderRadius.circular(12),
                      ),
                    ),
                  ),
                ),
                const SizedBox(height: 16),
                Row(
                  children: [
                    Expanded(child: Divider(color: Colors.grey.shade300)),
                    Padding(
                      padding: const EdgeInsets.symmetric(horizontal: 16),
                      child: Text(
                        'OR ENTER MANUALLY',
                        style: TextStyle(
                          color: Colors.grey.shade600,
                          fontSize: 12,
                          fontWeight: FontWeight.w600,
                        ),
                      ),
                    ),
                    Expanded(child: Divider(color: Colors.grey.shade300)),
                  ],
                ),
                const SizedBox(height: 16),
              ],

              // Scanned data indicator
              if (widget.scannedData != null) ...[
                Container(
                  padding: const EdgeInsets.all(12),
                  decoration: BoxDecoration(
                    color: Colors.green.withOpacity(0.1),
                    borderRadius: BorderRadius.circular(8),
                    border: Border.all(color: Colors.green.withOpacity(0.3)),
                  ),
                  child: const Row(
                    children: [
                      Icon(Icons.check_circle, color: Colors.green, size: 20),
                      SizedBox(width: 8),
                      Expanded(
                        child: Text(
                          'Form auto-filled from scanned document',
                          style: TextStyle(
                            fontSize: 13,
                            fontWeight: FontWeight.w500,
                          ),
                        ),
                      ),
                    ],
                  ),
                ),
                const SizedBox(height: 16),
              ],

              // Photo Preview Section
              if (_frontPhotoPath != null || _backPhotoPath != null) ...[
                Container(
                  padding: const EdgeInsets.all(16),
                  decoration: BoxDecoration(
                    color: Colors.grey.shade50,
                    borderRadius: BorderRadius.circular(12),
                    border: Border.all(color: Colors.grey.shade300),
                  ),
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      const Row(
                        children: [
                          Icon(Icons.photo_camera,
                              color: AppTheme.primaryOrange, size: 20),
                          SizedBox(width: 8),
                          Text(
                            'Captured Photos',
                            style: TextStyle(
                                fontSize: 16, fontWeight: FontWeight.bold),
                          ),
                        ],
                      ),
                      const SizedBox(height: 12),
                      Row(
                        children: [
                          if (_frontPhotoPath != null)
                            Expanded(
                              child: _PhotoCard(
                                photoPath: _frontPhotoPath!,
                                label: _isPassport
                                    ? 'Passport Photo'
                                    : 'Front Side',
                                onTap: () => _previewPhoto(
                                    _frontPhotoPath!,
                                    _isPassport
                                        ? 'Passport Photo'
                                        : 'Front Side'),
                              ),
                            ),
                          if (_frontPhotoPath != null && _backPhotoPath != null)
                            const SizedBox(width: 12),
                          if (_backPhotoPath != null && !_isPassport)
                            Expanded(
                              child: _PhotoCard(
                                photoPath: _backPhotoPath!,
                                label: 'Back Side',
                                onTap: () =>
                                    _previewPhoto(_backPhotoPath!, 'Back Side'),
                              ),
                            ),
                        ],
                      ),
                    ],
                  ),
                ),
                const SizedBox(height: 20),
              ],

              // Relationship to Guest
              const Text('Relationship to Guest *',
                  style: TextStyle(fontWeight: FontWeight.w600)),
              const SizedBox(height: 8),
              DropdownButtonFormField<String>(
                value: _selectedRelationship,
                decoration: const InputDecoration(
                  prefixIcon: Icon(Icons.people_outline),
                  border: OutlineInputBorder(),
                ),
                items: const [
                  DropdownMenuItem(
                      value: 'companion', child: Text('Companion')),
                  DropdownMenuItem(
                      value: 'family', child: Text('Family Member')),
                  DropdownMenuItem(value: 'friend', child: Text('Friend')),
                  DropdownMenuItem(
                      value: 'business_associate',
                      child: Text('Business Associate')),
                  DropdownMenuItem(value: 'other', child: Text('Other')),
                ],
                onChanged: (value) {
                  if (value != null) {
                    setState(() => _selectedRelationship = value);
                  }
                },
              ),
              const SizedBox(height: 20),

              // Document Type
              const Text('Document Type',
                  style: TextStyle(fontWeight: FontWeight.w600)),
              const SizedBox(height: 8),
              Row(
                children: [
                  Expanded(
                    child: _RadioOption(
                      label: 'Passport',
                      value: 'passport',
                      groupValue: _selectedDocumentType,
                      onChanged: (val) =>
                          setState(() => _selectedDocumentType = val!),
                    ),
                  ),
                  const SizedBox(width: 8),
                  Expanded(
                    child: _RadioOption(
                      label: 'ID Card',
                      value: 'id_card',
                      groupValue: _selectedDocumentType,
                      onChanged: (val) =>
                          setState(() => _selectedDocumentType = val!),
                    ),
                  ),
                  const SizedBox(width: 8),
                  Expanded(
                    child: _RadioOption(
                      label: 'Visa',
                      value: 'visa',
                      groupValue: _selectedDocumentType,
                      onChanged: (val) =>
                          setState(() => _selectedDocumentType = val!),
                    ),
                  ),
                ],
              ),
              const SizedBox(height: 20),

              // First Name
              TextFormField(
                controller: _firstNameController,
                decoration: const InputDecoration(
                  labelText: 'First Name *',
                  prefixIcon: Icon(Icons.person_outline),
                ),
                validator: (value) {
                  if (value == null || value.isEmpty) {
                    return 'Please enter first name';
                  }
                  return null;
                },
              ),
              const SizedBox(height: 16),

              // Last Name
              TextFormField(
                controller: _lastNameController,
                decoration: const InputDecoration(
                  labelText: 'Last Name *',
                  prefixIcon: Icon(Icons.person_outline),
                ),
                validator: (value) {
                  if (value == null || value.isEmpty) {
                    return 'Please enter last name';
                  }
                  return null;
                },
              ),
              const SizedBox(height: 16),

              // Document Number
              TextFormField(
                controller: _documentNumberController,
                decoration: const InputDecoration(
                  labelText: 'Document Number',
                  prefixIcon: Icon(Icons.badge_outlined),
                ),
              ),
              const SizedBox(height: 16),

              // Issued Country
              TextFormField(
                controller: _issuedCountryController,
                decoration: const InputDecoration(
                  labelText: 'Issued Country',
                  prefixIcon: Icon(Icons.public_outlined),
                ),
              ),
              const SizedBox(height: 16),

              // Issued Date
              TextFormField(
                controller: _issuedDateController,
                readOnly: true,
                onTap: _selectIssuedDate,
                decoration: const InputDecoration(
                  labelText: 'Issued Date',
                  prefixIcon: Icon(Icons.calendar_today_outlined),
                  suffixIcon: Icon(Icons.arrow_drop_down),
                ),
              ),
              const SizedBox(height: 16),

              // Expiry Date
              TextFormField(
                controller: _expiryDateController,
                readOnly: true,
                onTap: _selectExpiryDate,
                decoration: const InputDecoration(
                  labelText: 'Expiry Date',
                  prefixIcon: Icon(Icons.event_outlined),
                  suffixIcon: Icon(Icons.arrow_drop_down),
                ),
              ),
              const SizedBox(height: 16),

              // Date of Birth
              TextFormField(
                controller: _dateOfBirthController,
                readOnly: true,
                onTap: _selectDate,
                decoration: const InputDecoration(
                  labelText: 'Date of Birth',
                  prefixIcon: Icon(Icons.calendar_today_outlined),
                  suffixIcon: Icon(Icons.arrow_drop_down),
                ),
              ),
              const SizedBox(height: 16),

              // Sex
              const Text('Sex', style: TextStyle(fontWeight: FontWeight.w600)),
              const SizedBox(height: 8),
              Row(
                children: [
                  Expanded(
                    child: _RadioOption(
                      label: 'Male',
                      value: 'M',
                      groupValue: _selectedSex,
                      onChanged: (val) => setState(() => _selectedSex = val!),
                    ),
                  ),
                  const SizedBox(width: 12),
                  Expanded(
                    child: _RadioOption(
                      label: 'Female',
                      value: 'F',
                      groupValue: _selectedSex,
                      onChanged: (val) => setState(() => _selectedSex = val!),
                    ),
                  ),
                ],
              ),
              const SizedBox(height: 20),

              // Nationality
              TextFormField(
                controller: _nationalityController,
                decoration: const InputDecoration(
                  labelText: 'Nationality',
                  prefixIcon: Icon(Icons.flag_outlined),
                ),
              ),
              const SizedBox(height: 16),

              // Email
              TextFormField(
                controller: _emailController,
                keyboardType: TextInputType.emailAddress,
                decoration: const InputDecoration(
                  labelText: 'Email (optional)',
                  prefixIcon: Icon(Icons.email_outlined),
                ),
              ),
              const SizedBox(height: 16),

              // Phone
              TextFormField(
                controller: _phoneController,
                keyboardType: TextInputType.phone,
                decoration: const InputDecoration(
                  labelText: 'Phone (optional)',
                  prefixIcon: Icon(Icons.phone_outlined),
                ),
              ),
              const SizedBox(height: 16),

              // Address
              TextFormField(
                controller: _addressController,
                maxLines: 2,
                decoration: const InputDecoration(
                  labelText: 'Address (optional)',
                  prefixIcon: Icon(Icons.home_outlined),
                  alignLabelWithHint: true,
                ),
              ),
              const SizedBox(height: 24),

              // Submit Button
              SizedBox(
                height: 50,
                child: ElevatedButton(
                  onPressed: _isLoading ? null : _handleSubmit,
                  style: ElevatedButton.styleFrom(
                    backgroundColor: AppTheme.primaryOrange,
                    foregroundColor: Colors.white,
                  ),
                  child: _isLoading
                      ? const SizedBox(
                          height: 20,
                          width: 20,
                          child: CircularProgressIndicator(
                            strokeWidth: 2,
                            valueColor:
                                AlwaysStoppedAnimation<Color>(Colors.white),
                          ),
                        )
                      : const Text(
                          'Add Escort',
                          style: TextStyle(
                              fontSize: 16, fontWeight: FontWeight.w600),
                        ),
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }
}

class _RadioOption extends StatelessWidget {
  final String label;
  final String value;
  final String groupValue;
  final ValueChanged<String?> onChanged;

  const _RadioOption({
    required this.label,
    required this.value,
    required this.groupValue,
    required this.onChanged,
  });

  @override
  Widget build(BuildContext context) {
    final isSelected = value == groupValue;

    return GestureDetector(
      onTap: () => onChanged(value),
      child: Container(
        padding: const EdgeInsets.symmetric(vertical: 12),
        decoration: BoxDecoration(
          color: isSelected
              ? AppTheme.primaryOrange.withOpacity(0.1)
              : Colors.grey.shade100,
          borderRadius: BorderRadius.circular(8),
          border: Border.all(
            color: isSelected ? AppTheme.primaryOrange : Colors.grey.shade300,
            width: isSelected ? 2 : 1,
          ),
        ),
        child: Text(
          label,
          textAlign: TextAlign.center,
          style: TextStyle(
            color: isSelected ? AppTheme.primaryOrange : Colors.grey.shade700,
            fontWeight: isSelected ? FontWeight.w600 : FontWeight.normal,
            fontSize: 13,
          ),
        ),
      ),
    );
  }
}

class _PhotoCard extends StatelessWidget {
  final String photoPath;
  final String label;
  final VoidCallback onTap;

  const _PhotoCard({
    required this.photoPath,
    required this.label,
    required this.onTap,
  });

  @override
  Widget build(BuildContext context) {
    return GestureDetector(
      onTap: onTap,
      child: Column(
        children: [
          Container(
            height: 160,
            decoration: BoxDecoration(
              borderRadius: BorderRadius.circular(8),
              border: Border.all(color: Colors.grey.shade300, width: 2),
              boxShadow: [
                BoxShadow(
                  color: Colors.black.withOpacity(0.1),
                  blurRadius: 4,
                  offset: const Offset(0, 2),
                ),
              ],
            ),
            child: Stack(
              children: [
                ClipRRect(
                  borderRadius: BorderRadius.circular(6),
                  child: Image.file(
                    File(photoPath),
                    width: double.infinity,
                    height: double.infinity,
                    fit: BoxFit.cover,
                  ),
                ),
                Positioned(
                  top: 8,
                  right: 8,
                  child: Container(
                    padding: const EdgeInsets.all(6),
                    decoration: BoxDecoration(
                      color: Colors.black.withOpacity(0.6),
                      shape: BoxShape.circle,
                    ),
                    child: const Icon(
                      Icons.remove_red_eye,
                      color: Colors.white,
                      size: 18,
                    ),
                  ),
                ),
              ],
            ),
          ),
          const SizedBox(height: 6),
          Text(
            label,
            style: TextStyle(
              fontSize: 12,
              fontWeight: FontWeight.w600,
              color: Colors.grey.shade700,
            ),
          ),
        ],
      ),
    );
  }
}
