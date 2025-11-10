import 'package:flutter/material.dart';
import 'package:go_router/go_router.dart';
import 'package:provider/provider.dart';
import '../providers/guest_provider.dart';
import '../models/guest.dart';
import '../utils/app_theme.dart';
import '../utils/enhanced_popups.dart';

class GuestListScreen extends StatefulWidget {
  const GuestListScreen({super.key});

  @override
  State<GuestListScreen> createState() => _GuestListScreenState();
}

class _GuestListScreenState extends State<GuestListScreen> {
  String _filterStatus = 'all'; // all, checked-in, checked-out, pending
  String _searchQuery = '';

  @override
  void initState() {
    super.initState();
    // Load guests from QloApps when screen opens
    WidgetsBinding.instance.addPostFrameCallback((_) {
      Provider.of<GuestProvider>(context, listen: false).loadGuests();
    });
  }

  @override
  Widget build(BuildContext context) {
    final guestProvider = Provider.of<GuestProvider>(context);
    final guests = guestProvider.guests;

    // Filter guests based on status and search
    final filteredGuests = guests.where((guest) {
      // Support both 'checked_in' and 'checked-in' formats
      bool matchesStatus = _filterStatus == 'all';
      if (!matchesStatus) {
        if (_filterStatus == 'checked-in') {
          matchesStatus =
              guest.status == 'checked-in' || guest.status == 'checked_in';
        } else if (_filterStatus == 'checked-out') {
          matchesStatus =
              guest.status == 'checked-out' || guest.status == 'checked_out';
        } else {
          matchesStatus = guest.status == _filterStatus;
        }
      }

      final matchesSearch = _searchQuery.isEmpty ||
          guest.fullName.toLowerCase().contains(_searchQuery.toLowerCase()) ||
          (guest.email?.toLowerCase().contains(_searchQuery.toLowerCase()) ??
              false) ||
          (guest.phone?.contains(_searchQuery) ?? false) ||
          (guest.roomNumber?.contains(_searchQuery) ?? false);
      return matchesStatus && matchesSearch;
    }).toList();

    return Scaffold(
      body: Container(
        decoration: const BoxDecoration(
          gradient: LinearGradient(
            begin: Alignment.topLeft,
            end: Alignment.bottomRight,
            colors: [
              AppTheme.primaryOrange,
              AppTheme.secondaryOrange,
            ],
          ),
        ),
        child: SafeArea(
          child: Column(
            children: [
              // Header
              Padding(
                padding: const EdgeInsets.all(16.0),
                child: Row(
                  children: [
                    IconButton(
                      icon: const Icon(Icons.arrow_back, color: Colors.white),
                      onPressed: () => context.pop(),
                    ),
                    const Text(
                      ' All Guests',
                      style: TextStyle(
                        fontSize: 24,
                        fontWeight: FontWeight.bold,
                        color: Colors.white,
                      ),
                    ),
                    const Spacer(),
                    Container(
                      padding: const EdgeInsets.symmetric(
                          horizontal: 12, vertical: 6),
                      decoration: BoxDecoration(
                        color: Colors.white.withOpacity(0.2),
                        borderRadius: BorderRadius.circular(20),
                      ),
                      child: Text(
                        '${filteredGuests.length} Guests',
                        style: const TextStyle(
                          color: Colors.white,
                          fontWeight: FontWeight.bold,
                        ),
                      ),
                    ),
                  ],
                ),
              ),

              // Search Bar
              Padding(
                padding: const EdgeInsets.symmetric(horizontal: 16.0),
                child: TextField(
                  onChanged: (value) {
                    setState(() {
                      _searchQuery = value;
                    });
                  },
                  style: const TextStyle(color: Colors.white),
                  decoration: InputDecoration(
                    hintText: 'Search by name, email, phone, or room...',
                    hintStyle: TextStyle(color: Colors.white.withOpacity(0.7)),
                    prefixIcon: const Icon(Icons.search, color: Colors.white),
                    filled: true,
                    fillColor: Colors.white.withOpacity(0.2),
                    border: OutlineInputBorder(
                      borderRadius: BorderRadius.circular(12),
                      borderSide: BorderSide.none,
                    ),
                  ),
                ),
              ),

              const SizedBox(height: 16),

              // Filter Chips
              SizedBox(
                height: 50,
                child: ListView(
                  scrollDirection: Axis.horizontal,
                  padding: const EdgeInsets.symmetric(horizontal: 16),
                  children: [
                    _buildFilterChip('All', 'all', guests.length),
                    const SizedBox(width: 8),
                    _buildFilterChip(
                      'Checked In',
                      'checked-in',
                      guests
                          .where((g) =>
                              g.status == 'checked-in' ||
                              g.status == 'checked_in')
                          .length,
                    ),
                    const SizedBox(width: 8),
                    _buildFilterChip(
                      'Checked Out',
                      'checked-out',
                      guests
                          .where((g) =>
                              g.status == 'checked-out' ||
                              g.status == 'checked_out')
                          .length,
                    ),
                    const SizedBox(width: 8),
                    _buildFilterChip(
                      'Pending',
                      'pending',
                      guests.where((g) => g.status == 'pending').length,
                    ),
                  ],
                ),
              ),

              const SizedBox(height: 16),

              // Guest List
              Expanded(
                child: Container(
                  decoration: const BoxDecoration(
                    color: Colors.white,
                    borderRadius: BorderRadius.only(
                      topLeft: Radius.circular(30),
                      topRight: Radius.circular(30),
                    ),
                  ),
                  child: filteredGuests.isEmpty
                      ? Center(
                          child: Column(
                            mainAxisAlignment: MainAxisAlignment.center,
                            children: [
                              Icon(
                                Icons.people_outline,
                                size: 80,
                                color: Colors.grey[300],
                              ),
                              const SizedBox(height: 16),
                              Text(
                                _searchQuery.isEmpty
                                    ? 'No guests found'
                                    : 'No matching guests',
                                style: TextStyle(
                                  fontSize: 18,
                                  color: Colors.grey[600],
                                ),
                              ),
                            ],
                          ),
                        )
                      : ListView.builder(
                          padding: const EdgeInsets.all(16),
                          itemCount: filteredGuests.length,
                          itemBuilder: (context, index) {
                            final guest = filteredGuests[index];
                            return _buildGuestCard(
                                context, guest, guestProvider);
                          },
                        ),
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }

  Widget _buildFilterChip(String label, String value, int count) {
    final isSelected = _filterStatus == value;
    return FilterChip(
      label: Text('$label ($count)'),
      selected: isSelected,
      onSelected: (selected) {
        setState(() {
          _filterStatus = value;
        });
      },
      // ignore: deprecated_member_use
      backgroundColor:
          isSelected ? Colors.white : Colors.white.withOpacity(0.85),
      selectedColor: Colors.white,
      labelStyle: TextStyle(
        color: isSelected
            ? AppTheme.primaryOrange
            : AppTheme.primaryOrange.withOpacity(0.9),
        fontWeight: FontWeight.bold,
        fontSize: 13,
      ),
      side: BorderSide(
        color:
            isSelected ? AppTheme.primaryOrange : Colors.white.withOpacity(0.8),
        width: 2,
      ),
      elevation: isSelected ? 4 : 2,
      shadowColor: Colors.black.withOpacity(0.3),
    );
  }

  Widget _buildGuestCard(
      BuildContext context, Guest guest, GuestProvider provider) {
    final statusColor = _getStatusColor(guest.status);
    final statusIcon = _getStatusIcon(guest.status);

    return Card(
      margin: const EdgeInsets.only(bottom: 12),
      elevation: 2,
      shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(12)),
      child: InkWell(
        onTap: () => _showGuestDetails(context, guest, provider),
        borderRadius: BorderRadius.circular(12),
        child: Padding(
          padding: const EdgeInsets.all(16),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              Row(
                children: [
                  CircleAvatar(
                    radius: 30,
                    backgroundColor: AppTheme.primaryOrange.withOpacity(0.1),
                    child: Text(
                      guest.fullName.isNotEmpty
                          ? guest.fullName[0].toUpperCase()
                          : '?',
                      style: const TextStyle(
                        fontSize: 24,
                        fontWeight: FontWeight.bold,
                        color: AppTheme.primaryOrange,
                      ),
                    ),
                  ),
                  const SizedBox(width: 16),
                  Expanded(
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        Text(
                          guest.fullName,
                          style: const TextStyle(
                            fontSize: 18,
                            fontWeight: FontWeight.bold,
                          ),
                        ),
                        const SizedBox(height: 4),
                        Row(
                          children: [
                            Icon(statusIcon, size: 16, color: statusColor),
                            const SizedBox(width: 4),
                            Text(
                              guest.status.toUpperCase(),
                              style: TextStyle(
                                color: statusColor,
                                fontWeight: FontWeight.bold,
                                fontSize: 12,
                              ),
                            ),
                          ],
                        ),
                      ],
                    ),
                  ),
                  if (guest.roomNumber != null)
                    Container(
                      padding: const EdgeInsets.symmetric(
                          horizontal: 12, vertical: 6),
                      decoration: BoxDecoration(
                        color: AppTheme.primaryOrange,
                        borderRadius: BorderRadius.circular(20),
                      ),
                      child: Text(
                        'Room ${guest.roomNumber}',
                        style: const TextStyle(
                          color: Colors.white,
                          fontWeight: FontWeight.bold,
                          fontSize: 12,
                        ),
                      ),
                    ),
                ],
              ),
              const Divider(height: 24),
              Row(
                children: [
                  Expanded(
                    child:
                        _buildInfoItem(Icons.email, guest.email ?? 'No email'),
                  ),
                  Expanded(
                    child:
                        _buildInfoItem(Icons.phone, guest.phone ?? 'No phone'),
                  ),
                ],
              ),
              if (guest.checkInDate != null || guest.checkOutDate != null) ...[
                const SizedBox(height: 8),
                Row(
                  children: [
                    if (guest.checkInDate != null)
                      Expanded(
                        child: _buildInfoItem(
                          Icons.login,
                          'In: ${_formatDate(guest.checkInDate!)}',
                        ),
                      ),
                    if (guest.checkOutDate != null)
                      Expanded(
                        child: _buildInfoItem(
                          Icons.logout,
                          'Out: ${_formatDate(guest.checkOutDate!)}',
                        ),
                      ),
                  ],
                ),
              ],
            ],
          ),
        ),
      ),
    );
  }

  Widget _buildInfoItem(IconData icon, String text) {
    return Row(
      children: [
        Icon(icon, size: 16, color: Colors.grey[600]),
        const SizedBox(width: 4),
        Expanded(
          child: Text(
            text,
            style: TextStyle(
              fontSize: 12,
              color: Colors.grey[600],
            ),
            overflow: TextOverflow.ellipsis,
          ),
        ),
      ],
    );
  }

  Color _getStatusColor(String status) {
    switch (status) {
      case 'checked-in':
        return Colors.green;
      case 'checked-out':
        return Colors.blue;
      case 'pending':
        return Colors.orange;
      default:
        return Colors.grey;
    }
  }

  IconData _getStatusIcon(String status) {
    switch (status) {
      case 'checked-in':
        return Icons.check_circle;
      case 'checked-out':
        return Icons.exit_to_app;
      case 'pending':
        return Icons.schedule;
      default:
        return Icons.help;
    }
  }

  String _formatDate(DateTime date) {
    return '${date.day}/${date.month}/${date.year}';
  }

  void _showGuestDetails(
      BuildContext context, Guest guest, GuestProvider provider) {
    showModalBottomSheet(
      context: context,
      isScrollControlled: true,
      backgroundColor: Colors.transparent,
      builder: (context) => _buildGuestDetailsSheet(context, guest, provider),
    );
  }

  Widget _buildGuestDetailsSheet(
      BuildContext context, Guest guest, GuestProvider provider) {
    final roomController = TextEditingController(text: guest.roomNumber ?? '');

    return Container(
      height: MediaQuery.of(context).size.height * 0.75,
      decoration: const BoxDecoration(
        color: Colors.white,
        borderRadius: BorderRadius.only(
          topLeft: Radius.circular(30),
          topRight: Radius.circular(30),
        ),
      ),
      child: Column(
        children: [
          // Handle bar with Edit button
          SizedBox(
            height: 50,
            child: Stack(
              children: [
                Center(
                  child: Container(
                    margin: const EdgeInsets.only(top: 12),
                    width: 40,
                    height: 4,
                    decoration: BoxDecoration(
                      color: Colors.grey[300],
                      borderRadius: BorderRadius.circular(2),
                    ),
                  ),
                ),
                Positioned(
                  top: 4,
                  right: 8,
                  child: IconButton(
                    icon: const Icon(Icons.edit,
                        color: AppTheme.primaryOrange, size: 24),
                    onPressed: () {
                      Navigator.pop(context);
                      _showEditGuestDialog(context, guest, provider);
                    },
                    tooltip: 'Edit Guest',
                  ),
                ),
              ],
            ),
          ),

          Expanded(
            child: SingleChildScrollView(
              padding: const EdgeInsets.all(24),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  // Avatar and name
                  Center(
                    child: Column(
                      children: [
                        CircleAvatar(
                          radius: 50,
                          backgroundColor:
                              AppTheme.primaryOrange.withOpacity(0.1),
                          child: Text(
                            guest.fullName.isNotEmpty
                                ? guest.fullName[0].toUpperCase()
                                : '?',
                            style: const TextStyle(
                              fontSize: 40,
                              fontWeight: FontWeight.bold,
                              color: AppTheme.primaryOrange,
                            ),
                          ),
                        ),
                        const SizedBox(height: 16),
                        Text(
                          guest.fullName,
                          style: const TextStyle(
                            fontSize: 24,
                            fontWeight: FontWeight.bold,
                          ),
                        ),
                        const SizedBox(height: 8),
                        Container(
                          padding: const EdgeInsets.symmetric(
                              horizontal: 16, vertical: 8),
                          decoration: BoxDecoration(
                            color:
                                _getStatusColor(guest.status).withOpacity(0.1),
                            borderRadius: BorderRadius.circular(20),
                            border: Border.all(
                                color: _getStatusColor(guest.status)),
                          ),
                          child: Row(
                            mainAxisSize: MainAxisSize.min,
                            children: [
                              Icon(_getStatusIcon(guest.status),
                                  size: 16,
                                  color: _getStatusColor(guest.status)),
                              const SizedBox(width: 4),
                              Text(
                                guest.status.toUpperCase(),
                                style: TextStyle(
                                  color: _getStatusColor(guest.status),
                                  fontWeight: FontWeight.bold,
                                ),
                              ),
                            ],
                          ),
                        ),
                      ],
                    ),
                  ),

                  const SizedBox(height: 32),

                  // Contact Information
                  _buildDetailSection('Contact Information', [
                    _buildDetailRow(
                        Icons.email, 'Email', guest.email ?? 'Not provided'),
                    _buildDetailRow(
                        Icons.phone, 'Phone', guest.phone ?? 'Not provided'),
                    _buildDetailRow(Icons.location_city, 'Address',
                        guest.address ?? 'Not provided'),
                  ]),

                  const SizedBox(height: 24),

                  // Document Information
                  _buildDetailSection('Document Information', [
                    _buildDetailRow(Icons.badge, 'Document Type',
                        guest.documentType ?? 'Not provided'),
                    _buildDetailRow(Icons.numbers, 'Document Number',
                        guest.documentNumber ?? 'Not provided'),
                    if (guest.nationality != null)
                      _buildDetailRow(
                          Icons.flag, 'Nationality', guest.nationality!),
                    if (guest.dateOfBirth != null)
                      _buildDetailRow(
                          Icons.cake, 'Date of Birth', guest.dateOfBirth!),
                  ]),

                  const SizedBox(height: 24),

                  // Stay Information
                  if (guest.roomNumber != null ||
                      guest.checkInDate != null ||
                      guest.checkOutDate != null)
                    _buildDetailSection('Stay Information', [
                      if (guest.roomNumber != null)
                        _buildDetailRow(
                            Icons.hotel, 'Room Number', guest.roomNumber!),
                      if (guest.checkInDate != null)
                        _buildDetailRow(Icons.login, 'Check-in Date',
                            _formatDate(guest.checkInDate!)),
                      if (guest.checkOutDate != null)
                        _buildDetailRow(Icons.logout, 'Check-out Date',
                            _formatDate(guest.checkOutDate!)),
                    ]),

                  const SizedBox(height: 32),

                  // Manage Escorts Button
                  SizedBox(
                    width: double.infinity,
                    child: OutlinedButton.icon(
                      onPressed: () {
                        Navigator.pop(context);
                        context.push('/guest/${guest.id}/escorts',
                            extra: guest);
                      },
                      icon: const Icon(Icons.people_outline),
                      label: const Text('Manage Escorts & Companions'),
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

                  const SizedBox(height: 12),

                  // Action Buttons
                  if (guest.status == 'pending')
                    SizedBox(
                      width: double.infinity,
                      child: ElevatedButton.icon(
                        onPressed: () {
                          _checkInGuest(
                              context, guest, provider, roomController);
                        },
                        icon: const Icon(Icons.login),
                        label: const Text('Check In'),
                        style: ElevatedButton.styleFrom(
                          backgroundColor: Colors.green,
                          foregroundColor: Colors.white,
                          padding: const EdgeInsets.symmetric(vertical: 16),
                          shape: RoundedRectangleBorder(
                            borderRadius: BorderRadius.circular(12),
                          ),
                        ),
                      ),
                    ),
                  if (guest.status == 'checked-in')
                    SizedBox(
                      width: double.infinity,
                      child: ElevatedButton.icon(
                        onPressed: () {
                          _checkOutGuest(context, guest, provider);
                        },
                        icon: const Icon(Icons.logout),
                        label: const Text('Check Out'),
                        style: ElevatedButton.styleFrom(
                          backgroundColor: Colors.blue,
                          foregroundColor: Colors.white,
                          padding: const EdgeInsets.symmetric(vertical: 16),
                          shape: RoundedRectangleBorder(
                            borderRadius: BorderRadius.circular(12),
                          ),
                        ),
                      ),
                    ),
                ],
              ),
            ),
          ),
        ],
      ),
    );
  }

  Widget _buildDetailSection(String title, List<Widget> children) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Text(
          title,
          style: const TextStyle(
            fontSize: 16,
            fontWeight: FontWeight.bold,
            color: AppTheme.primaryOrange,
          ),
        ),
        const SizedBox(height: 12),
        ...children,
      ],
    );
  }

  Widget _buildDetailRow(IconData icon, String label, String value) {
    return Padding(
      padding: const EdgeInsets.only(bottom: 12),
      child: Row(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Icon(icon, size: 20, color: Colors.grey[600]),
          const SizedBox(width: 12),
          Expanded(
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text(
                  label,
                  style: TextStyle(
                    fontSize: 12,
                    color: Colors.grey[600],
                  ),
                ),
                const SizedBox(height: 2),
                Text(
                  value,
                  style: const TextStyle(
                    fontSize: 16,
                    fontWeight: FontWeight.w500,
                  ),
                ),
              ],
            ),
          ),
        ],
      ),
    );
  }

  void _checkInGuest(BuildContext context, Guest guest, GuestProvider provider,
      TextEditingController roomController) {
    showDialog(
      context: context,
      builder: (context) => AlertDialog(
        title: const Text('Check In Guest'),
        content: Column(
          mainAxisSize: MainAxisSize.min,
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Text('Check in ${guest.fullName}?'),
            const SizedBox(height: 16),
            TextField(
              controller: roomController,
              decoration: const InputDecoration(
                labelText: 'Room Number',
                border: OutlineInputBorder(),
              ),
            ),
          ],
        ),
        actions: [
          TextButton(
            onPressed: () => Navigator.pop(context),
            child: const Text('Cancel'),
          ),
          ElevatedButton(
            onPressed: () {
              if (roomController.text.isNotEmpty) {
                provider.checkInGuest(guest.id,
                    roomNumber: roomController.text);
                Navigator.pop(context);
                Navigator.pop(context);
                EnhancedPopups.showEnhancedSnackBar(
                  context,
                  message: '${guest.fullName} checked in to Room ${roomController.text}!',
                  type: PopupType.success,
                );
              }
            },
            style: ElevatedButton.styleFrom(
              backgroundColor: Colors.green,
              foregroundColor: Colors.white,
            ),
            child: const Text('Check In'),
          ),
        ],
      ),
    );
  }

  void _checkOutGuest(
      BuildContext context, Guest guest, GuestProvider provider) {
    showDialog(
      context: context,
      builder: (context) => AlertDialog(
        title: const Text('Check Out Guest'),
        content:
            Text('Check out ${guest.fullName} from Room ${guest.roomNumber}?'),
        actions: [
          TextButton(
            onPressed: () => Navigator.pop(context),
            child: const Text('Cancel'),
          ),
          ElevatedButton(
            onPressed: () {
              provider.checkOutGuest(guest.id);
              Navigator.pop(context);
              Navigator.pop(context);
              EnhancedPopups.showEnhancedSnackBar(
                context,
                message: '${guest.fullName} checked out successfully!',
                type: PopupType.success,
              );
            },
            style: ElevatedButton.styleFrom(
              backgroundColor: Colors.blue,
              foregroundColor: Colors.white,
            ),
            child: const Text('Check Out'),
          ),
        ],
      ),
    );
  }

  void _showEditGuestDialog(
      BuildContext context, Guest guest, GuestProvider provider) {
    final firstNameController = TextEditingController(text: guest.firstName);
    final lastNameController = TextEditingController(text: guest.lastName);
    final emailController = TextEditingController(text: guest.email);
    final phoneController = TextEditingController(text: guest.phone);
    final formKey = GlobalKey<FormState>();

    showDialog(
      context: context,
      builder: (context) => AlertDialog(
        title: const Row(
          children: [
            Icon(Icons.edit, color: AppTheme.primaryOrange),
            SizedBox(width: 8),
            Text('Edit Guest Information'),
          ],
        ),
        content: SingleChildScrollView(
          child: Form(
            key: formKey,
            child: Column(
              mainAxisSize: MainAxisSize.min,
              children: [
                TextFormField(
                  controller: firstNameController,
                  decoration: const InputDecoration(
                    labelText: 'First Name',
                    border: OutlineInputBorder(),
                    prefixIcon: Icon(Icons.person),
                  ),
                  validator: (value) {
                    if (value == null || value.isEmpty) {
                      return 'First name is required';
                    }
                    return null;
                  },
                ),
                const SizedBox(height: 16),
                TextFormField(
                  controller: lastNameController,
                  decoration: const InputDecoration(
                    labelText: 'Last Name',
                    border: OutlineInputBorder(),
                    prefixIcon: Icon(Icons.person_outline),
                  ),
                  validator: (value) {
                    if (value == null || value.isEmpty) {
                      return 'Last name is required';
                    }
                    return null;
                  },
                ),
                const SizedBox(height: 16),
                TextFormField(
                  controller: emailController,
                  decoration: const InputDecoration(
                    labelText: 'Email',
                    border: OutlineInputBorder(),
                    prefixIcon: Icon(Icons.email),
                  ),
                  keyboardType: TextInputType.emailAddress,
                  validator: (value) {
                    if (value == null || value.isEmpty) {
                      return 'Email is required';
                    }
                    if (!value.contains('@')) {
                      return 'Please enter a valid email';
                    }
                    return null;
                  },
                ),
                const SizedBox(height: 16),
                TextFormField(
                  controller: phoneController,
                  decoration: const InputDecoration(
                    labelText: 'Phone',
                    border: OutlineInputBorder(),
                    prefixIcon: Icon(Icons.phone),
                  ),
                  keyboardType: TextInputType.phone,
                  validator: (value) {
                    if (value == null || value.isEmpty) {
                      return 'Phone is required';
                    }
                    return null;
                  },
                ),
              ],
            ),
          ),
        ),
        actions: [
          TextButton(
            onPressed: () {
              Navigator.pop(context);
            },
            child: const Text('Cancel'),
          ),
          ElevatedButton(
            onPressed: () async {
              if (formKey.currentState!.validate()) {
                // Create updated guest object
                final updatedGuest = Guest(
                  id: guest.id,
                  firstName: firstNameController.text,
                  lastName: lastNameController.text,
                  email: emailController.text,
                  phone: phoneController.text,
                  address: guest.address,
                  documentType: guest.documentType,
                  documentNumber: guest.documentNumber,
                  nationality: guest.nationality,
                  dateOfBirth: guest.dateOfBirth,
                  roomNumber: guest.roomNumber,
                  status: guest.status,
                  checkInDate: guest.checkInDate,
                  checkOutDate: guest.checkOutDate,
                );

                // Close the edit dialog first
                Navigator.of(context).pop();

                // Show loading dialog and keep reference to close it
                showDialog(
                  context: context,
                  barrierDismissible: false,
                  builder: (BuildContext loadingContext) {
                    // Update guest in the background
                    provider
                        .updateGuest(guest.id, updatedGuest)
                        .then((success) {
                      // Close loading dialog using its own context
                      Navigator.of(loadingContext).pop();

                      // Show result message
                      if (success) {
                        EnhancedPopups.showEnhancedSnackBar(
                          context,
                          message: '${updatedGuest.fullName} updated successfully!',
                          type: PopupType.success,
                          duration: const Duration(seconds: 2),
                        );
                      } else {
                        EnhancedPopups.showEnhancedSnackBar(
                          context,
                          message: 'Failed to update guest information',
                          type: PopupType.error,
                          duration: const Duration(seconds: 3),
                        );
                      }
                    });

                    return const AlertDialog(
                      content: Row(
                        children: [
                          CircularProgressIndicator(),
                          SizedBox(width: 20),
                          Expanded(
                            child: Text('Updating guest information...'),
                          ),
                        ],
                      ),
                    );
                  },
                );
              }
            },
            style: ElevatedButton.styleFrom(
              backgroundColor: AppTheme.primaryOrange,
              foregroundColor: Colors.white,
            ),
            child: const Text('Save Changes'),
          ),
        ],
      ),
    );
  }
}
