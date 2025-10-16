import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:go_router/go_router.dart';
import 'package:uuid/uuid.dart';
import '../providers/guest_provider.dart';
import '../models/guest.dart';
import '../utils/app_theme.dart';

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

  @override
  void initState() {
    super.initState();
    _populateScannedData();
  }

  void _populateScannedData() {
    if (widget.scannedData != null) {
      debugPrint('📥 Received scanned data: ${widget.scannedData}');
      debugPrint('📊 Scanned fields: ${widget.scannedData!.keys.join(", ")}');

      final data = widget.scannedData!;

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
        } else if (docType == 'driver_license' || docType == 'license') {
          _selectedDocumentType = 'driver_license';
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

      debugPrint('✅ Auto-filled $populatedCount fields from scan');

      // Show a snackbar with the results
      if (populatedCount > 0) {
        WidgetsBinding.instance.addPostFrameCallback((_) {
          ScaffoldMessenger.of(context).showSnackBar(
            SnackBar(
              content: Text(
                  '✅ Auto-filled $populatedCount fields. Please verify and complete the form.'),
              backgroundColor: Colors.green,
              duration: const Duration(seconds: 4),
            ),
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
      final success = await guestProvider.addGuest(guest);

      setState(() => _isLoading = false);

      if (success && mounted) {
        ScaffoldMessenger.of(context).showSnackBar(
          const SnackBar(
            content: Text('✅ Guest registered successfully!'),
            backgroundColor: Colors.green,
          ),
        );
        context.go('/dashboard');
      } else if (mounted) {
        ScaffoldMessenger.of(context).showSnackBar(
          const SnackBar(
            content: Text('❌ Failed to register guest'),
            backgroundColor: Colors.red,
          ),
        );
      }
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Guest Registration'),
        leading: IconButton(
          icon: const Icon(Icons.arrow_back),
          onPressed: () => context.pop(),
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
                  padding: const EdgeInsets.all(12),
                  decoration: BoxDecoration(
                    color: AppTheme.primaryOrange.withOpacity(0.1),
                    borderRadius: BorderRadius.circular(8),
                    border: Border.all(
                        color: AppTheme.primaryOrange.withOpacity(0.3)),
                  ),
                  child: const Row(
                    children: [
                      Icon(Icons.check_circle,
                          color: AppTheme.primaryOrange, size: 20),
                      SizedBox(width: 8),
                      Expanded(
                        child: Text(
                          ' Form auto-filled from scanned document',
                          style: TextStyle(
                            fontSize: 13,
                            fontWeight: FontWeight.w500,
                          ),
                        ),
                      ),
                    ],
                  ),
                ),
                const SizedBox(height: 20),
              ],

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
                      label: 'License',
                      value: 'driver_license',
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
