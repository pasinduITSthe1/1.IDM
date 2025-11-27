import 'package:flutter/material.dart';
import 'package:go_router/go_router.dart';
import 'package:provider/provider.dart';
import '../providers/guest_provider.dart';
import '../providers/room_provider.dart';
import '../models/guest.dart';
import '../utils/app_theme.dart';
import '../utils/enhanced_popups.dart';

class CheckOutScreen extends StatefulWidget {
  const CheckOutScreen({super.key});

  @override
  State<CheckOutScreen> createState() => _CheckOutScreenState();
}

class _CheckOutScreenState extends State<CheckOutScreen> {
  String _searchQuery = '';

  @override
  Widget build(BuildContext context) {
    final guestProvider = Provider.of<GuestProvider>(context);
    final isDark = Theme.of(context).brightness == Brightness.dark;
    final checkedInGuests = guestProvider.guests
        .where((g) => g.status == 'checked-in' || g.status == 'checked_in')
        .where((g) =>
            _searchQuery.isEmpty ||
            g.fullName.toLowerCase().contains(_searchQuery.toLowerCase()) ||
            (g.email?.toLowerCase().contains(_searchQuery.toLowerCase()) ??
                false) ||
            (g.phone?.contains(_searchQuery) ?? false) ||
            (g.roomNumber?.contains(_searchQuery) ?? false))
        .toList();

    return Scaffold(
      backgroundColor: isDark ? const Color(0xFF121212) : Colors.grey.shade50,
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
                      'Check-Out',
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
                        '${checkedInGuests.length}',
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
                      hintText: 'Search by name, room, email...',
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

              // Checked-In Guests List
              Expanded(
                child: Container(
                  decoration: BoxDecoration(
                    color: isDark ? const Color(0xFF121212) : Colors.grey[50],
                    borderRadius: const BorderRadius.only(
                      topLeft: Radius.circular(24),
                      topRight: Radius.circular(24),
                    ),
                  ),
                  child: checkedInGuests.isEmpty
                      ? Center(
                          child: Column(
                            mainAxisAlignment: MainAxisAlignment.center,
                            children: [
                              Icon(
                                Icons.hotel_outlined,
                                size: 80,
                                color: isDark
                                    ? const Color(0xFF404040)
                                    : Colors.grey[300],
                              ),
                              const SizedBox(height: 16),
                              Text(
                                _searchQuery.isEmpty
                                    ? 'No guests in hotel'
                                    : 'No matching guests',
                                style: TextStyle(
                                  fontSize: 18,
                                  color: isDark
                                      ? const Color(0xFFB0B0B0)
                                      : Colors.grey[600],
                                ),
                              ),
                              if (_searchQuery.isEmpty) ...[
                                const SizedBox(height: 8),
                                Text(
                                  'No active check-ins found',
                                  style: TextStyle(
                                    fontSize: 14,
                                    color: isDark
                                        ? const Color(0xFF808080)
                                        : Colors.grey[500],
                                  ),
                                ),
                              ],
                            ],
                          ),
                        )
                      : ListView.builder(
                          padding: const EdgeInsets.all(16),
                          itemCount: checkedInGuests.length,
                          itemBuilder: (context, index) {
                            final guest = checkedInGuests[index];
                            return _buildGuestCard(
                                context, guest, guestProvider, isDark);
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

  Widget _buildGuestCard(
      BuildContext context, Guest guest, GuestProvider provider, bool isDark) {
    final daysSinceCheckIn = guest.checkInDate != null
        ? DateTime.now().difference(guest.checkInDate!).inDays
        : 0;

    final hasEmail = guest.email != null && guest.email!.isNotEmpty;
    final hasPhone = guest.phone != null && guest.phone!.isNotEmpty;

    return Container(
      margin: const EdgeInsets.only(bottom: 10),
      decoration: BoxDecoration(
        color: isDark ? const Color(0xFF1E1E1E) : Colors.white,
        borderRadius: BorderRadius.circular(16),
        border: Border.all(
            color: isDark ? const Color(0xFF404040) : Colors.grey[200]!,
            width: 1),
      ),
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
                  backgroundColor: const Color(0xFF10B981),
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
                            decoration: const BoxDecoration(
                              color: Color(0xFF10B981),
                              shape: BoxShape.circle,
                            ),
                          ),
                          const SizedBox(width: 6),
                          Text(
                            'CHECKED IN',
                            style: TextStyle(
                              fontSize: 10,
                              fontWeight: FontWeight.w600,
                              color: isDark
                                  ? const Color(0xFFB0B0B0)
                                  : Colors.grey[600],
                              letterSpacing: 0.3,
                            ),
                          ),
                          if (daysSinceCheckIn > 0) ...[
                            Text(
                              ' • $daysSinceCheckIn day${daysSinceCheckIn > 1 ? 's' : ''}',
                              style: TextStyle(
                                fontSize: 10,
                                color: isDark
                                    ? const Color(0xFF909090)
                                    : Colors.grey[500],
                              ),
                            ),
                          ],
                        ],
                      ),
                    ],
                  ),
                ),
                // Room Badge
                if (guest.roomNumber != null)
                  Container(
                    padding:
                        const EdgeInsets.symmetric(horizontal: 10, vertical: 6),
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
            if (hasEmail || hasPhone || guest.checkInDate != null) ...[
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
                                  ? const Color(0xFFB0B0B0)
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
                                  ? const Color(0xFFB0B0B0)
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
                    if ((hasEmail || hasPhone) && guest.checkInDate != null)
                      const SizedBox(height: 8),
                    if (guest.checkInDate != null)
                      Row(
                        children: [
                          Icon(Icons.access_time_outlined,
                              size: 16,
                              color: isDark
                                  ? const Color(0xFFB0B0B0)
                                  : Colors.grey[600]),
                          const SizedBox(width: 8),
                          Expanded(
                            child: Text(
                              'Checked in: ${_formatDate(guest.checkInDate!)}',
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

            // Check Out Button
            const SizedBox(height: 12),
            SizedBox(
              width: double.infinity,
              height: 44,
              child: ElevatedButton(
                onPressed: () => _checkOutGuest(context, guest, provider),
                style: ElevatedButton.styleFrom(
                  backgroundColor: const Color(0xFF2563EB),
                  foregroundColor: Colors.white,
                  elevation: 0,
                  shadowColor: Colors.transparent,
                  padding: EdgeInsets.zero,
                  shape: RoundedRectangleBorder(
                    borderRadius: BorderRadius.circular(10),
                  ),
                ),
                child: const Row(
                  mainAxisAlignment: MainAxisAlignment.center,
                  children: [
                    Icon(Icons.logout_rounded, size: 18),
                    SizedBox(width: 8),
                    Text(
                      'Check Out',
                      style: TextStyle(
                        fontSize: 14,
                        fontWeight: FontWeight.w600,
                      ),
                    ),
                  ],
                ),
              ),
            ),
          ],
        ),
      ),
    );
  }

  String _formatDate(DateTime date) {
    return '${date.day}/${date.month}/${date.year} ${date.hour}:${date.minute.toString().padLeft(2, '0')}';
  }

  Future<void> _checkOutGuest(
      BuildContext context, Guest guest, GuestProvider provider) async {
    String detailsMessage =
        'Check out ${guest.fullName} from Room ${guest.roomNumber}?';

    if (guest.checkInDate != null) {
      final nights = DateTime.now().difference(guest.checkInDate!).inDays;
      detailsMessage += '\n\nStay Duration: $nights night(s)';
    }

    final bool? confirmed = await EnhancedPopups.showEnhancedConfirmDialog(
      context,
      title: 'Confirm Check-Out',
      message: detailsMessage,
      confirmText: 'Check Out',
      type: PopupType.info,
    );

    if (confirmed == true) {
      await provider.checkOutGuest(guest.id);

      // Reload room provider to update room status immediately
      final roomProvider = Provider.of<RoomProvider>(context, listen: false);
      await roomProvider.loadAll();

      if (context.mounted) {
        EnhancedPopups.showEnhancedSnackBar(
          context,
          message:
              '${guest.fullName} checked out from Room ${guest.roomNumber}!',
          type: PopupType.success,
        );
      }
    }
  }
}
