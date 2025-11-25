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
    final isDark = Theme.of(context).brightness == Brightness.dark;
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
        decoration: BoxDecoration(
          gradient: LinearGradient(
            begin: Alignment.topLeft,
            end: Alignment.bottomRight,
            colors: isDark
                ? [
                    const Color(0xFF1E1E1E),
                    const Color(0xFF2C2C2C),
                  ]
                : [
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
                padding: const EdgeInsets.fromLTRB(16, 16, 16, 14),
                child: Row(
                  children: [
                    IconButton(
                      icon: const Icon(Icons.arrow_back,
                          color: Colors.white, size: 24),
                      onPressed: () => context.pop(),
                      padding: EdgeInsets.zero,
                      constraints: const BoxConstraints(),
                    ),
                    const SizedBox(width: 12),
                    const Text(
                      'All Guests',
                      style: TextStyle(
                        fontSize: 20,
                        fontWeight: FontWeight.bold,
                        color: Colors.white,
                      ),
                    ),
                    const Spacer(),
                    Container(
                      padding: const EdgeInsets.symmetric(
                          horizontal: 10, vertical: 5),
                      decoration: BoxDecoration(
                        color: Colors.white.withOpacity(0.25),
                        borderRadius: BorderRadius.circular(12),
                      ),
                      child: Text(
                        '${filteredGuests.length} Guests',
                        style: const TextStyle(
                          color: Colors.white,
                          fontWeight: FontWeight.bold,
                          fontSize: 12,
                        ),
                      ),
                    ),
                  ],
                ),
              ),

              // Search Bar
              Padding(
                padding: const EdgeInsets.symmetric(horizontal: 16.0),
                child: Container(
                  decoration: BoxDecoration(
                    color: isDark ? const Color(0xFF2C2C2C) : Colors.white,
                    borderRadius: BorderRadius.circular(16),
                    boxShadow: [
                      BoxShadow(
                        color: Colors.black.withOpacity(0.1),
                        blurRadius: 8,
                        offset: const Offset(0, 2),
                      ),
                    ],
                  ),
                  child: TextField(
                    onChanged: (value) {
                      setState(() {
                        _searchQuery = value;
                      });
                    },
                    style: TextStyle(
                      color: isDark
                          ? const Color(0xFFE1E1E1)
                          : const Color(0xFF1F2937),
                      fontSize: 14,
                    ),
                    decoration: InputDecoration(
                      hintText: 'Search by name, email, phone, ...',
                      hintStyle: TextStyle(
                        color:
                            isDark ? const Color(0xFF707070) : Colors.grey[400],
                        fontSize: 13,
                      ),
                      prefixIcon: Icon(Icons.search,
                          color: isDark
                              ? const Color(0xFF707070)
                              : Colors.grey[400],
                          size: 20),
                      filled: true,
                      fillColor:
                          isDark ? const Color(0xFF2C2C2C) : Colors.white,
                      border: OutlineInputBorder(
                        borderRadius: BorderRadius.circular(16),
                        borderSide: BorderSide.none,
                      ),
                      contentPadding: const EdgeInsets.symmetric(
                          horizontal: 16, vertical: 14),
                    ),
                  ),
                ),
              ),

              const SizedBox(height: 14),

              // Guest List
              Expanded(
                child: Container(
                  decoration: BoxDecoration(
                    color: isDark ? const Color(0xFF121212) : Colors.grey[50],
                    borderRadius: const BorderRadius.only(
                      topLeft: Radius.circular(24),
                      topRight: Radius.circular(24),
                    ),
                  ),
                  child: Column(
                    children: [
                      // Filter Chips (moved inside the container)
                      Container(
                        height: 56,
                        padding: const EdgeInsets.symmetric(vertical: 8),
                        child: ListView(
                          scrollDirection: Axis.horizontal,
                          padding: const EdgeInsets.symmetric(horizontal: 16),
                          children: [
                            _buildFilterChip(
                                'All', 'all', guests.length, isDark),
                            const SizedBox(width: 8),
                            _buildFilterChip(
                              'Checked In',
                              'checked-in',
                              guests
                                  .where((g) =>
                                      g.status == 'checked-in' ||
                                      g.status == 'checked_in')
                                  .length,
                              isDark,
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
                              isDark,
                            ),
                            const SizedBox(width: 8),
                            _buildFilterChip(
                              'Pending',
                              'pending',
                              guests.where((g) => g.status == 'pending').length,
                              isDark,
                            ),
                          ],
                        ),
                      ),

                      // Guest List
                      Expanded(
                        child: filteredGuests.isEmpty
                            ? Center(
                                child: Column(
                                  mainAxisAlignment: MainAxisAlignment.center,
                                  children: [
                                    Icon(
                                      Icons.people_outline,
                                      size: 80,
                                      color: isDark
                                          ? const Color(0xFF404040)
                                          : Colors.grey[300],
                                    ),
                                    const SizedBox(height: 16),
                                    Text(
                                      _searchQuery.isEmpty
                                          ? 'No guests found'
                                          : 'No matching guests',
                                      style: TextStyle(
                                        fontSize: 18,
                                        color: isDark
                                            ? const Color(0xFFB0B0B0)
                                            : Colors.grey[600],
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
                                      context, guest, guestProvider, isDark);
                                },
                              ),
                      ),
                    ],
                  ),
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }

  Widget _buildFilterChip(String label, String value, int count, bool isDark) {
    final isSelected = _filterStatus == value;
    return GestureDetector(
      onTap: () {
        setState(() {
          _filterStatus = value;
        });
      },
      child: Container(
        padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 8),
        decoration: BoxDecoration(
          color: isSelected
              ? AppTheme.primaryOrange
              : (isDark ? const Color(0xFF2C2C2C) : Colors.grey[200]),
          borderRadius: BorderRadius.circular(12),
          border: Border.all(
            color: isSelected
                ? AppTheme.primaryOrange
                : (isDark ? const Color(0xFF404040) : Colors.grey[300]!),
            width: isSelected ? 2 : 1,
          ),
        ),
        child: Row(
          mainAxisSize: MainAxisSize.min,
          children: [
            if (isSelected)
              Container(
                margin: const EdgeInsets.only(right: 6),
                padding: const EdgeInsets.all(2),
                decoration: BoxDecoration(
                  color: Colors.white,
                  shape: BoxShape.circle,
                ),
                child:
                    Icon(Icons.check, color: AppTheme.primaryOrange, size: 10),
              ),
            Text(
              label,
              style: TextStyle(
                color: isSelected
                    ? Colors.white
                    : (isDark ? const Color(0xFFE1E1E1) : Colors.black87),
                fontWeight: FontWeight.bold,
                fontSize: 12,
              ),
            ),
            const SizedBox(width: 6),
            Container(
              padding: const EdgeInsets.symmetric(horizontal: 6, vertical: 2),
              decoration: BoxDecoration(
                color: isSelected
                    ? Colors.white.withOpacity(0.25)
                    : (isDark ? const Color(0xFF404040) : Colors.grey[300]),
                borderRadius: BorderRadius.circular(8),
              ),
              child: Text(
                count.toString(),
                style: TextStyle(
                  color: isSelected
                      ? Colors.white
                      : (isDark ? const Color(0xFFB0B0B0) : Colors.grey[700]),
                  fontWeight: FontWeight.bold,
                  fontSize: 11,
                ),
              ),
            ),
          ],
        ),
      ),
    );
  }

  Widget _buildGuestCard(
      BuildContext context, Guest guest, GuestProvider provider, bool isDark) {
    final statusColor = _getStatusColor(guest.status);
    final hasEmail = guest.email != null && guest.email!.isNotEmpty;
    final hasPhone = guest.phone != null && guest.phone!.isNotEmpty;

    return Container(
      margin: const EdgeInsets.only(bottom: 10),
      decoration: BoxDecoration(
        color: isDark ? const Color(0xFF1E1E1E) : Colors.white,
        borderRadius: BorderRadius.circular(16),
        border: Border.all(
          color: isDark ? const Color(0xFF404040) : Colors.grey[200]!,
          width: 1,
        ),
      ),
      child: InkWell(
        onTap: () => _showGuestDetails(context, guest, provider),
        borderRadius: BorderRadius.circular(16),
        child: Padding(
          padding: const EdgeInsets.all(14),
          child: Column(
            children: [
              // Header Section
              Row(
                children: [
                  // Avatar with Initial
                  CircleAvatar(
                    radius: 22,
                    backgroundColor: statusColor,
                    child: Text(
                      guest.fullName.isNotEmpty
                          ? guest.fullName[0].toUpperCase()
                          : '?',
                      style: const TextStyle(
                        fontSize: 18,
                        fontWeight: FontWeight.bold,
                        color: Colors.white,
                      ),
                    ),
                  ),
                  const SizedBox(width: 12),
                  // Name and Status
                  Expanded(
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        Text(
                          guest.fullName,
                          style: TextStyle(
                            fontSize: 15,
                            fontWeight: FontWeight.bold,
                            color: isDark
                                ? const Color(0xFFE1E1E1)
                                : const Color(0xFF1F2937),
                          ),
                        ),
                        const SizedBox(height: 4),
                        Row(
                          children: [
                            Container(
                              width: 5,
                              height: 5,
                              decoration: BoxDecoration(
                                color: statusColor,
                                shape: BoxShape.circle,
                              ),
                            ),
                            const SizedBox(width: 6),
                            Text(
                              guest.status.toUpperCase(),
                              style: TextStyle(
                                fontSize: 10,
                                fontWeight: FontWeight.w600,
                                color: isDark
                                    ? const Color(0xFF808080)
                                    : Colors.grey[600],
                                letterSpacing: 0.3,
                              ),
                            ),
                          ],
                        ),
                      ],
                    ),
                  ),
                  // Room Badge
                  if (guest.roomNumber != null)
                    Container(
                      padding: const EdgeInsets.symmetric(
                          horizontal: 10, vertical: 6),
                      decoration: BoxDecoration(
                        color: AppTheme.primaryOrange,
                        borderRadius: BorderRadius.circular(10),
                      ),
                      child: Text(
                        'Room ${guest.roomNumber}',
                        style: const TextStyle(
                          color: Colors.white,
                          fontSize: 12,
                          fontWeight: FontWeight.bold,
                        ),
                      ),
                    ),
                ],
              ),

              // Contact Info Section - only show if data exists
              if (hasEmail ||
                  hasPhone ||
                  guest.checkInDate != null ||
                  guest.checkOutDate != null) ...[
                const SizedBox(height: 12),
                Container(
                  padding: const EdgeInsets.all(10),
                  decoration: BoxDecoration(
                    color: isDark ? const Color(0xFF2C2C2C) : Colors.grey[50],
                    borderRadius: BorderRadius.circular(10),
                  ),
                  child: Column(
                    children: [
                      if (hasEmail)
                        Row(
                          children: [
                            Icon(Icons.email_outlined,
                                size: 16,
                                color: isDark
                                    ? const Color(0xFF808080)
                                    : Colors.grey[600]),
                            const SizedBox(width: 8),
                            Expanded(
                              child: Text(
                                guest.email!,
                                style: TextStyle(
                                  fontSize: 12,
                                  color: isDark
                                      ? const Color(0xFFB0B0B0)
                                      : Colors.grey[700],
                                ),
                                overflow: TextOverflow.ellipsis,
                              ),
                            ),
                          ],
                        ),
                      if (hasEmail && hasPhone) const SizedBox(height: 8),
                      if (hasPhone)
                        Row(
                          children: [
                            Icon(Icons.phone_outlined,
                                size: 16,
                                color: isDark
                                    ? const Color(0xFF808080)
                                    : Colors.grey[600]),
                            const SizedBox(width: 8),
                            Text(
                              guest.phone!,
                              style: TextStyle(
                                fontSize: 12,
                                color: isDark
                                    ? const Color(0xFFB0B0B0)
                                    : Colors.grey[700],
                              ),
                            ),
                          ],
                        ),
                      if ((hasEmail || hasPhone) &&
                          (guest.checkInDate != null ||
                              guest.checkOutDate != null))
                        const SizedBox(height: 8),
                      if (guest.checkInDate != null)
                        Row(
                          children: [
                            Icon(Icons.login_rounded,
                                size: 16,
                                color: isDark
                                    ? const Color(0xFF808080)
                                    : Colors.grey[600]),
                            const SizedBox(width: 8),
                            Expanded(
                              child: Text(
                                'In: ${_formatDate(guest.checkInDate!)}',
                                style: TextStyle(
                                  fontSize: 12,
                                  color: isDark
                                      ? const Color(0xFFB0B0B0)
                                      : Colors.grey[700],
                                ),
                              ),
                            ),
                          ],
                        ),
                      if (guest.checkInDate != null &&
                          guest.checkOutDate != null)
                        const SizedBox(height: 8),
                      if (guest.checkOutDate != null)
                        Row(
                          children: [
                            Icon(Icons.logout_rounded,
                                size: 16,
                                color: isDark
                                    ? const Color(0xFF808080)
                                    : Colors.grey[600]),
                            const SizedBox(width: 8),
                            Expanded(
                              child: Text(
                                'Out: ${_formatDate(guest.checkOutDate!)}',
                                style: TextStyle(
                                  fontSize: 12,
                                  color: isDark
                                      ? const Color(0xFFB0B0B0)
                                      : Colors.grey[700],
                                ),
                              ),
                            ),
                          ],
                        ),
                    ],
                  ),
                ),
              ],
            ],
          ),
        ),
      ),
    );
  }

  Color _getStatusColor(String status) {
    // Normalize status to handle both hyphen and underscore formats
    final normalizedStatus = status.toLowerCase().replaceAll('_', '-');

    switch (normalizedStatus) {
      case 'checked-in':
        return Colors.green;
      case 'checked-out':
        return Colors.red;
      case 'pending':
        return Colors.yellow[700]!;
      default:
        return Colors.grey;
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
    final statusColor = _getStatusColor(guest.status);
    final hasEmail = guest.email != null && guest.email!.isNotEmpty;
    final hasPhone = guest.phone != null && guest.phone!.isNotEmpty;
    final hasAddress = guest.address != null && guest.address!.isNotEmpty;
    final isDark = Theme.of(context).brightness == Brightness.dark;

    return Container(
      height: MediaQuery.of(context).size.height * 0.8,
      decoration: BoxDecoration(
        color: isDark ? const Color(0xFF1E1E1E) : Colors.white,
        borderRadius: const BorderRadius.only(
          topLeft: Radius.circular(24),
          topRight: Radius.circular(24),
        ),
      ),
      child: Column(
        children: [
          // Handle bar with Edit button
          Container(
            padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 12),
            decoration: BoxDecoration(
              color: isDark ? const Color(0xFF121212) : Colors.grey[50],
              borderRadius: const BorderRadius.only(
                topLeft: Radius.circular(24),
                topRight: Radius.circular(24),
              ),
            ),
            child: Row(
              children: [
                Container(
                  width: 36,
                  height: 4,
                  decoration: BoxDecoration(
                    color: isDark ? const Color(0xFF404040) : Colors.grey[300],
                    borderRadius: BorderRadius.circular(2),
                  ),
                ),
                const Spacer(),
                IconButton(
                  icon: const Icon(Icons.edit_outlined,
                      color: AppTheme.primaryOrange, size: 20),
                  onPressed: () {
                    Navigator.pop(context);
                    _showEditGuestDialog(context, guest, provider);
                  },
                  tooltip: 'Edit Guest',
                  padding: EdgeInsets.zero,
                  constraints: const BoxConstraints(),
                ),
              ],
            ),
          ),

          Expanded(
            child: SingleChildScrollView(
              padding: const EdgeInsets.all(20),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  // Avatar and name
                  Center(
                    child: Column(
                      children: [
                        CircleAvatar(
                          radius: 40,
                          backgroundColor: statusColor,
                          child: Text(
                            guest.fullName.isNotEmpty
                                ? guest.fullName[0].toUpperCase()
                                : '?',
                            style: const TextStyle(
                              fontSize: 32,
                              fontWeight: FontWeight.bold,
                              color: Colors.white,
                            ),
                          ),
                        ),
                        const SizedBox(height: 14),
                        Text(
                          guest.fullName,
                          style: TextStyle(
                            fontSize: 20,
                            fontWeight: FontWeight.bold,
                            color: isDark
                                ? const Color(0xFFE1E1E1)
                                : const Color(0xFF1F2937),
                          ),
                          textAlign: TextAlign.center,
                        ),
                        const SizedBox(height: 8),
                        Row(
                          mainAxisSize: MainAxisSize.min,
                          children: [
                            Container(
                              width: 6,
                              height: 6,
                              decoration: BoxDecoration(
                                color: statusColor,
                                shape: BoxShape.circle,
                              ),
                            ),
                            const SizedBox(width: 6),
                            Text(
                              guest.status.toUpperCase(),
                              style: TextStyle(
                                fontSize: 11,
                                fontWeight: FontWeight.w600,
                                color: isDark
                                    ? const Color(0xFF808080)
                                    : Colors.grey[600],
                                letterSpacing: 0.5,
                              ),
                            ),
                          ],
                        ),
                      ],
                    ),
                  ),

                  const SizedBox(height: 20),

                  // Manage Companions Button - Moved to top for better access
                  SizedBox(
                    width: double.infinity,
                    height: 48,
                    child: OutlinedButton.icon(
                      onPressed: () {
                        Navigator.pop(context);
                        context.push('/guest/${guest.id}/escorts',
                            extra: guest);
                      },
                      icon: const Icon(Icons.people_outline, size: 20),
                      label: const Text('Manage Companions',
                          style: TextStyle(
                              fontSize: 15, fontWeight: FontWeight.w600)),
                      style: OutlinedButton.styleFrom(
                        foregroundColor: AppTheme.primaryOrange,
                        side: const BorderSide(
                            color: AppTheme.primaryOrange, width: 1.5),
                        shape: RoundedRectangleBorder(
                          borderRadius: BorderRadius.circular(12),
                        ),
                      ),
                    ),
                  ),

                  const SizedBox(height: 24),

                  // Contact Information
                  if (hasEmail || hasPhone || hasAddress) ...[
                    _buildSectionTitle('Contact Information', isDark),
                    const SizedBox(height: 10),
                    Container(
                      padding: const EdgeInsets.all(14),
                      decoration: BoxDecoration(
                        color:
                            isDark ? const Color(0xFF2C2C2C) : Colors.grey[50],
                        borderRadius: BorderRadius.circular(12),
                      ),
                      child: Column(
                        children: [
                          if (hasEmail)
                            _buildInfoRow(Icons.email_outlined, 'Email',
                                guest.email!, isDark),
                          if (hasEmail && hasPhone) const SizedBox(height: 12),
                          if (hasPhone)
                            _buildInfoRow(Icons.phone_outlined, 'Phone',
                                guest.phone!, isDark),
                          if ((hasEmail || hasPhone) && hasAddress)
                            const SizedBox(height: 12),
                          if (hasAddress)
                            _buildInfoRow(Icons.location_on_outlined, 'Address',
                                guest.address!, isDark),
                        ],
                      ),
                    ),
                    const SizedBox(height: 18),
                  ],

                  // Document Information
                  if (guest.documentType != null ||
                      guest.documentNumber != null ||
                      guest.nationality != null ||
                      guest.dateOfBirth != null) ...[
                    _buildSectionTitle('Document Information', isDark),
                    const SizedBox(height: 10),
                    Container(
                      padding: const EdgeInsets.all(14),
                      decoration: BoxDecoration(
                        color:
                            isDark ? const Color(0xFF2C2C2C) : Colors.grey[50],
                        borderRadius: BorderRadius.circular(12),
                      ),
                      child: Column(
                        children: [
                          if (guest.documentType != null)
                            _buildInfoRow(Icons.badge_outlined, 'Document Type',
                                guest.documentType!, isDark),
                          if (guest.documentType != null &&
                              guest.documentNumber != null)
                            const SizedBox(height: 12),
                          if (guest.documentNumber != null)
                            _buildInfoRow(
                                Icons.numbers_outlined,
                                'Document Number',
                                guest.documentNumber!,
                                isDark),
                          if ((guest.documentType != null ||
                                  guest.documentNumber != null) &&
                              guest.nationality != null)
                            const SizedBox(height: 12),
                          if (guest.nationality != null)
                            _buildInfoRow(Icons.flag_outlined, 'Nationality',
                                guest.nationality!, isDark),
                          if ((guest.documentType != null ||
                                  guest.documentNumber != null ||
                                  guest.nationality != null) &&
                              guest.dateOfBirth != null)
                            const SizedBox(height: 12),
                          if (guest.dateOfBirth != null)
                            _buildInfoRow(Icons.cake_outlined, 'Date of Birth',
                                guest.dateOfBirth!, isDark),
                        ],
                      ),
                    ),
                    const SizedBox(height: 18),
                  ],

                  // Stay Information
                  if (guest.roomNumber != null ||
                      guest.checkInDate != null ||
                      guest.checkOutDate != null) ...[
                    _buildSectionTitle('Stay Information', isDark),
                    const SizedBox(height: 10),
                    Container(
                      padding: const EdgeInsets.all(14),
                      decoration: BoxDecoration(
                        color:
                            isDark ? const Color(0xFF2C2C2C) : Colors.grey[50],
                        borderRadius: BorderRadius.circular(12),
                      ),
                      child: Column(
                        children: [
                          if (guest.roomNumber != null)
                            _buildInfoRow(Icons.hotel_outlined, 'Room Number',
                                guest.roomNumber!, isDark),
                          if (guest.roomNumber != null &&
                              guest.checkInDate != null)
                            const SizedBox(height: 12),
                          if (guest.checkInDate != null)
                            _buildInfoRow(Icons.login_rounded, 'Check-in Date',
                                _formatDate(guest.checkInDate!), isDark),
                          if ((guest.roomNumber != null ||
                                  guest.checkInDate != null) &&
                              guest.checkOutDate != null)
                            const SizedBox(height: 12),
                          if (guest.checkOutDate != null)
                            _buildInfoRow(
                                Icons.logout_rounded,
                                'Check-out Date',
                                _formatDate(guest.checkOutDate!),
                                isDark),
                        ],
                      ),
                    ),
                    const SizedBox(height: 18),
                  ],

                  // Action Buttons
                  if (guest.status == 'pending')
                    SizedBox(
                      width: double.infinity,
                      height: 44,
                      child: ElevatedButton.icon(
                        onPressed: () {
                          _checkInGuest(
                              context, guest, provider, roomController);
                        },
                        icon: const Icon(Icons.login_rounded, size: 18),
                        label: const Text('Check In'),
                        style: ElevatedButton.styleFrom(
                          backgroundColor: const Color(0xFF10B981),
                          foregroundColor: Colors.white,
                          elevation: 0,
                          shape: RoundedRectangleBorder(
                            borderRadius: BorderRadius.circular(10),
                          ),
                        ),
                      ),
                    ),
                  if (guest.status == 'checked-in')
                    SizedBox(
                      width: double.infinity,
                      height: 44,
                      child: ElevatedButton.icon(
                        onPressed: () {
                          _checkOutGuest(context, guest, provider);
                        },
                        icon: const Icon(Icons.logout_rounded, size: 18),
                        label: const Text('Check Out'),
                        style: ElevatedButton.styleFrom(
                          backgroundColor: const Color(0xFF2563EB),
                          foregroundColor: Colors.white,
                          elevation: 0,
                          shape: RoundedRectangleBorder(
                            borderRadius: BorderRadius.circular(10),
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

  Widget _buildSectionTitle(String title, bool isDark) {
    return Text(
      title,
      style: const TextStyle(
        fontSize: 13,
        fontWeight: FontWeight.bold,
        color: AppTheme.primaryOrange,
        letterSpacing: 0.3,
      ),
    );
  }

  Widget _buildInfoRow(IconData icon, String label, String value, bool isDark) {
    return Row(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Icon(icon,
            size: 16,
            color: isDark ? const Color(0xFF808080) : Colors.grey[600]),
        const SizedBox(width: 10),
        Expanded(
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              Text(
                label,
                style: TextStyle(
                  fontSize: 11,
                  color: isDark ? const Color(0xFF808080) : Colors.grey[600],
                  fontWeight: FontWeight.w500,
                ),
              ),
              const SizedBox(height: 2),
              Text(
                value,
                style: TextStyle(
                  fontSize: 13,
                  fontWeight: FontWeight.w600,
                  color: isDark
                      ? const Color(0xFFE1E1E1)
                      : const Color(0xFF1F2937),
                ),
              ),
            ],
          ),
        ),
      ],
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
                  message:
                      '${guest.fullName} checked in to Room ${roomController.text}!',
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
                          message:
                              '${updatedGuest.fullName} updated successfully!',
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
