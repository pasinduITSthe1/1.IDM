import 'dart:io';
import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:go_router/go_router.dart';
import 'package:uuid/uuid.dart';
import '../providers/guest_provider.dart';
import '../models/guest.dart';
import '../utils/app_theme.dart';
import '../utils/enhanced_popups.dart';

class GuestRegistrationScreen extends StatefulWidget {
  final Map<String, dynamic>? scannedData;

  const GuestRegistrationScreen({super.key, this.scannedData});

  @override
  State<GuestRegistrationScreen> createState() =>
      _GuestRegistrationScreenState();
}

class _GuestRegistrationScreenState extends State<GuestRegistrationScreen> {
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
  final _visitPurposeController = TextEditingController();

  String _selectedSex = 'M';
  String _selectedDocumentType = 'passport';
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
      _visitPurposeController.text = data['visitPurpose'] ?? '';

      // Handle expiration date with multiple possible keys
      if (data.containsKey('expirationDate')) {
        _expiryDateController.text = data['expirationDate'] ?? '';
      } else if (data.containsKey('expiryDate')) {
        _expiryDateController.text = data['expiryDate'] ?? '';
      }

      // Handle sex with validation
      if (data['sex'] != null) {
        final sex = data['sex'].toString().toUpperCase();
        if (sex == 'M' || sex == 'F') {
          _selectedSex = sex;
        }
      }

      // Handle document type with mapping
      if (data['documentType'] != null) {
        final docType = data['documentType'].toString().toLowerCase();
        // Map common document type names
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

      // Log populated fields
      int populatedCount = 0;
      if (_firstNameController.text.isNotEmpty) populatedCount++;
      if (_lastNameController.text.isNotEmpty) populatedCount++;
      if (_documentNumberController.text.isNotEmpty) populatedCount++;
      if (_dateOfBirthController.text.isNotEmpty) populatedCount++;
      if (_nationalityController.text.isNotEmpty) populatedCount++;

      // Show a snackbar with the results
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
    _visitPurposeController.dispose();
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

  // Handle retaking photos
  void _retakePhotos() {
    if (widget.scannedData == null) {
      EnhancedPopups.showEnhancedSnackBar(
        context,
        message: 'No scan data available. Please scan document again.',
        type: PopupType.error,
      );
      return;
    }

    // Navigate back to photo capture screen with MRZ data
    // Convert to Map<String, String> as expected by IDPhotoCaptureScreen
    final mrzData = <String, String>{};

    widget.scannedData!.forEach((key, value) {
      // Skip photo paths and convert all values to strings
      if (key != 'frontPhotoPath' && key != 'backPhotoPath') {
        mrzData[key] = value?.toString() ?? '';
      }
    });

    // Ensure we have the essential data
    if (mrzData.isEmpty || mrzData['documentNumber'] == null) {
      EnhancedPopups.showEnhancedSnackBar(
        context,
        message: 'Invalid scan data. Please scan document again.',
        type: PopupType.error,
      );
      return;
    }

    context.go('/capture-id-photos', extra: mrzData);
  }

  // Preview photo dialog
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

      final guest = Guest(
        id: const Uuid().v4(),
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
        visitPurpose: _visitPurposeController.text.isNotEmpty
            ? _visitPurposeController.text
            : null,
        status: 'pending',
      );

      final guestProvider = Provider.of<GuestProvider>(context, listen: false);

      // ✅ Pass photo paths to save them to database
      final success = await guestProvider.addGuest(
        guest,
        frontPhotoPath: _frontPhotoPath,
        backPhotoPath: _backPhotoPath,
        passportPhotoPath: _isPassport ? _frontPhotoPath : null,
      );

      setState(() => _isLoading = false);

      if (success && mounted) {
        EnhancedPopups.showEnhancedSnackBar(
          context,
          message: 'Guest registered successfully!',
          type: PopupType.success,
        );
        context.go('/dashboard');
      } else if (mounted) {
        EnhancedPopups.showEnhancedSnackBar(
          context,
          message: 'Failed to register guest',
          type: PopupType.error,
        );
      }
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Colors.grey[50],
      appBar: AppBar(
        title: const Text('Guest Registration'),
        centerTitle: false,
        elevation: 0,
        backgroundColor: Colors.white,
        leading: IconButton(
          icon: const Icon(Icons.arrow_back),
          onPressed: () {
            // Navigate back to dashboard
            if (context.canPop()) {
              context.pop();
            } else {
              context.go('/dashboard');
            }
          },
        ),
      ),
      body: Form(
        key: _formKey,
        child: SingleChildScrollView(
          padding: const EdgeInsets.all(16),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.stretch,
            children: [
              // Scanned data indicator
              if (widget.scannedData != null) ...[
                Container(
                  padding:
                      const EdgeInsets.symmetric(horizontal: 14, vertical: 12),
                  decoration: BoxDecoration(
                    color: Colors.green[50],
                    borderRadius: BorderRadius.circular(12),
                    border: Border.all(color: Colors.green[200]!, width: 1),
                  ),
                  child: Row(
                    children: [
                      Container(
                        padding: const EdgeInsets.all(6),
                        decoration: BoxDecoration(
                          color: Colors.green,
                          borderRadius: BorderRadius.circular(6),
                        ),
                        child: const Icon(Icons.check,
                            color: Colors.white, size: 14),
                      ),
                      const SizedBox(width: 10),
                      const Expanded(
                        child: Text(
                          'Form auto-filled from scanned document',
                          style: TextStyle(
                            fontSize: 12,
                            fontWeight: FontWeight.w600,
                            color: Color(0xFF1F2937),
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
                  padding: const EdgeInsets.all(14),
                  decoration: BoxDecoration(
                    color: Colors.white,
                    borderRadius: BorderRadius.circular(16),
                    border: Border.all(color: Colors.grey[200]!, width: 1),
                  ),
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      Row(
                        children: [
                          Container(
                            padding: const EdgeInsets.all(8),
                            decoration: BoxDecoration(
                              color: AppTheme.primaryOrange.withOpacity(0.1),
                              borderRadius: BorderRadius.circular(8),
                            ),
                            child: const Icon(
                              Icons.photo_camera,
                              color: AppTheme.primaryOrange,
                              size: 16,
                            ),
                          ),
                          const SizedBox(width: 10),
                          const Text(
                            'Captured Photos',
                            style: TextStyle(
                              fontSize: 14,
                              fontWeight: FontWeight.bold,
                              color: Color(0xFF1F2937),
                            ),
                          ),
                          const Spacer(),
                          TextButton.icon(
                            onPressed: _retakePhotos,
                            icon: const Icon(Icons.refresh, size: 16),
                            label: const Text('Retake',
                                style: TextStyle(fontSize: 12)),
                            style: TextButton.styleFrom(
                              foregroundColor: AppTheme.primaryOrange,
                              padding: const EdgeInsets.symmetric(
                                  horizontal: 10, vertical: 6),
                            ),
                          ),
                        ],
                      ),
                      const SizedBox(height: 12),

                      // Photos Row
                      Row(
                        children: [
                          // Front Photo
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

                          // Spacing between photos
                          if (_frontPhotoPath != null && _backPhotoPath != null)
                            const SizedBox(width: 12),

                          // Back Photo (only for ID cards)
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

                      const SizedBox(height: 10),
                      Container(
                        padding: const EdgeInsets.symmetric(
                            horizontal: 10, vertical: 8),
                        decoration: BoxDecoration(
                          color: Colors.green[50],
                          borderRadius: BorderRadius.circular(8),
                        ),
                        child: Row(
                          children: [
                            Icon(
                              Icons.check_circle,
                              color: Colors.green[700],
                              size: 14,
                            ),
                            const SizedBox(width: 6),
                            Text(
                              _isPassport
                                  ? 'Passport photo captured'
                                  : '${_backPhotoPath != null ? 'Both sides' : 'Front side'} captured',
                              style: TextStyle(
                                fontSize: 11,
                                color: Colors.green[700],
                                fontWeight: FontWeight.w600,
                              ),
                            ),
                          ],
                        ),
                      ),
                    ],
                  ),
                ),
                const SizedBox(height: 16),
              ],

              // Document Type Section
              Container(
                padding: const EdgeInsets.all(14),
                decoration: BoxDecoration(
                  color: Colors.white,
                  borderRadius: BorderRadius.circular(16),
                  border: Border.all(color: Colors.grey[200]!, width: 1),
                ),
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    const Text(
                      'Document Type',
                      style: TextStyle(
                        fontSize: 13,
                        fontWeight: FontWeight.bold,
                        color: Color(0xFF1F2937),
                      ),
                    ),
                    const SizedBox(height: 10),
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
                            label: 'No MRZ ID',
                            value: 'visa',
                            groupValue: _selectedDocumentType,
                            onChanged: (val) =>
                                setState(() => _selectedDocumentType = val!),
                          ),
                        ),
                      ],
                    ),
                  ],
                ),
              ),
              const SizedBox(height: 12),

              // Personal Information Section
              Container(
                padding: const EdgeInsets.all(14),
                decoration: BoxDecoration(
                  color: Colors.white,
                  borderRadius: BorderRadius.circular(16),
                  border: Border.all(color: Colors.grey[200]!, width: 1),
                ),
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    const Text(
                      'Personal Information',
                      style: TextStyle(
                        fontSize: 13,
                        fontWeight: FontWeight.bold,
                        color: AppTheme.primaryOrange,
                      ),
                    ),
                    const SizedBox(height: 14),

                    // First Name
                    TextFormField(
                      controller: _firstNameController,
                      decoration: InputDecoration(
                        labelText: 'First Name *',
                        prefixIcon: const Icon(Icons.person_outline, size: 20),
                        filled: true,
                        fillColor: Colors.grey[50],
                        border: OutlineInputBorder(
                          borderRadius: BorderRadius.circular(10),
                          borderSide: BorderSide(color: Colors.grey[300]!),
                        ),
                        enabledBorder: OutlineInputBorder(
                          borderRadius: BorderRadius.circular(10),
                          borderSide: BorderSide(color: Colors.grey[300]!),
                        ),
                        focusedBorder: OutlineInputBorder(
                          borderRadius: BorderRadius.circular(10),
                          borderSide: const BorderSide(
                              color: AppTheme.primaryOrange, width: 1.5),
                        ),
                        contentPadding: const EdgeInsets.symmetric(
                            horizontal: 16, vertical: 14),
                        labelStyle: const TextStyle(fontSize: 13),
                      ),
                      validator: (value) {
                        if (value == null || value.isEmpty) {
                          return 'Please enter first name';
                        }
                        return null;
                      },
                    ),
                    const SizedBox(height: 12),

                    // Last Name
                    TextFormField(
                      controller: _lastNameController,
                      decoration: InputDecoration(
                        labelText: 'Last Name *',
                        prefixIcon: const Icon(Icons.person_outline, size: 20),
                        filled: true,
                        fillColor: Colors.grey[50],
                        border: OutlineInputBorder(
                          borderRadius: BorderRadius.circular(10),
                          borderSide: BorderSide(color: Colors.grey[300]!),
                        ),
                        enabledBorder: OutlineInputBorder(
                          borderRadius: BorderRadius.circular(10),
                          borderSide: BorderSide(color: Colors.grey[300]!),
                        ),
                        focusedBorder: OutlineInputBorder(
                          borderRadius: BorderRadius.circular(10),
                          borderSide: const BorderSide(
                              color: AppTheme.primaryOrange, width: 1.5),
                        ),
                        contentPadding: const EdgeInsets.symmetric(
                            horizontal: 16, vertical: 14),
                        labelStyle: const TextStyle(fontSize: 13),
                      ),
                      validator: (value) {
                        if (value == null || value.isEmpty) {
                          return 'Please enter last name';
                        }
                        return null;
                      },
                    ),
                    const SizedBox(height: 12),

                    // Document Number
                    TextFormField(
                      controller: _documentNumberController,
                      decoration: InputDecoration(
                        labelText: 'Document Number',
                        prefixIcon: const Icon(Icons.badge_outlined, size: 20),
                        filled: true,
                        fillColor: Colors.grey[50],
                        border: OutlineInputBorder(
                          borderRadius: BorderRadius.circular(10),
                          borderSide: BorderSide(color: Colors.grey[300]!),
                        ),
                        enabledBorder: OutlineInputBorder(
                          borderRadius: BorderRadius.circular(10),
                          borderSide: BorderSide(color: Colors.grey[300]!),
                        ),
                        focusedBorder: OutlineInputBorder(
                          borderRadius: BorderRadius.circular(10),
                          borderSide: const BorderSide(
                              color: AppTheme.primaryOrange, width: 1.5),
                        ),
                        contentPadding: const EdgeInsets.symmetric(
                            horizontal: 16, vertical: 14),
                        labelStyle: const TextStyle(fontSize: 13),
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
                    const Text('Sex',
                        style: TextStyle(fontWeight: FontWeight.w600)),
                    const SizedBox(height: 8),
                    Row(
                      children: [
                        Expanded(
                          child: _RadioOption(
                            label: 'Male',
                            value: 'M',
                            groupValue: _selectedSex,
                            onChanged: (val) =>
                                setState(() => _selectedSex = val!),
                          ),
                        ),
                        const SizedBox(width: 12),
                        Expanded(
                          child: _RadioOption(
                            label: 'Female',
                            value: 'F',
                            groupValue: _selectedSex,
                            onChanged: (val) =>
                                setState(() => _selectedSex = val!),
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
                        labelText: 'Home Address (optional)',
                        prefixIcon: Icon(Icons.home_outlined),
                        alignLabelWithHint: true,
                      ),
                    ),
                    const SizedBox(height: 16),

                    // Visit Purpose
                    TextFormField(
                      controller: _visitPurposeController,
                      decoration: const InputDecoration(
                        labelText: 'Visit Purpose',
                        prefixIcon: Icon(Icons.business_center_outlined),
                        hintText: 'e.g., Tourism, Business, Family Visit',
                      ),
                    ),
                  ],
                ),
              ),
              const SizedBox(height: 20),

              // Submit Button
              SizedBox(
                height: 48,
                child: ElevatedButton(
                  onPressed: _isLoading ? null : _handleSubmit,
                  style: ElevatedButton.styleFrom(
                    backgroundColor: AppTheme.primaryOrange,
                    foregroundColor: Colors.white,
                    elevation: 0,
                    shape: RoundedRectangleBorder(
                      borderRadius: BorderRadius.circular(12),
                    ),
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
                          'Register Guest',
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
        padding: const EdgeInsets.symmetric(vertical: 10),
        decoration: BoxDecoration(
          color: isSelected ? AppTheme.primaryOrange : Colors.white,
          borderRadius: BorderRadius.circular(10),
          border: Border.all(
            color: isSelected ? AppTheme.primaryOrange : Colors.grey[300]!,
            width: 1.5,
          ),
        ),
        child: Text(
          label,
          textAlign: TextAlign.center,
          style: TextStyle(
            color: isSelected ? Colors.white : const Color(0xFF1F2937),
            fontWeight: FontWeight.w600,
            fontSize: 12,
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
                // Photo
                ClipRRect(
                  borderRadius: BorderRadius.circular(6),
                  child: Image.file(
                    File(photoPath),
                    width: double.infinity,
                    height: double.infinity,
                    fit: BoxFit.cover,
                  ),
                ),

                // Edit overlay button
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
