import 'package:flutter/material.dart';
import 'package:go_router/go_router.dart';
import 'package:provider/provider.dart';
import '../providers/guest_provider.dart';
import '../providers/room_provider.dart';
import '../models/guest.dart';
import '../models/room.dart';
import '../utils/app_theme.dart';
import '../utils/enhanced_popups.dart';

class CheckInScreen extends StatefulWidget {
  const CheckInScreen({super.key});

  @override
  State<CheckInScreen> createState() => _CheckInScreenState();
}

class _CheckInScreenState extends State<CheckInScreen> {
  String _searchQuery = '';
  final Map<String, TextEditingController> _roomControllers = {};

  @override
  void dispose() {
    for (var controller in _roomControllers.values) {
      controller.dispose();
    }
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    final isDark = Theme.of(context).brightness == Brightness.dark;
    final guestProvider = Provider.of<GuestProvider>(context);
    final pendingGuests = guestProvider.guests
        .where((g) => g.status == 'pending')
        .where((g) =>
            _searchQuery.isEmpty ||
            g.fullName.toLowerCase().contains(_searchQuery.toLowerCase()) ||
            (g.email?.toLowerCase().contains(_searchQuery.toLowerCase()) ??
                false) ||
            (g.phone?.contains(_searchQuery) ?? false))
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
                      'Check-In',
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
                        '${pendingGuests.length}',
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
                      color: isDark ? const Color(0xFFE1E1E1) : const Color(0xFF1F2937),
                      fontSize: 14,
                    ),
                    decoration: InputDecoration(
                      hintText: 'Search guests...',
                      hintStyle: TextStyle(
                        color: isDark ? const Color(0xFF707070) : Colors.grey[400],
                        fontSize: 13,
                      ),
                      prefixIcon:
                          Icon(Icons.search, color: isDark ? const Color(0xFF707070) : Colors.grey[400], size: 20),
                      filled: true,
                      fillColor: isDark ? const Color(0xFF2C2C2C) : Colors.white,
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

              // Pending Guests List
              Expanded(
                child: Container(
                  decoration: BoxDecoration(
                    color: isDark ? const Color(0xFF121212) : Colors.grey[50],
                    borderRadius: const BorderRadius.only(
                      topLeft: Radius.circular(24),
                      topRight: Radius.circular(24),
                    ),
                  ),
                  child: pendingGuests.isEmpty
                      ? Center(
                          child: Column(
                            mainAxisAlignment: MainAxisAlignment.center,
                            children: [
                              Icon(
                                Icons.check_circle_outline,
                                size: 80,
                                color: isDark ? const Color(0xFF404040) : Colors.grey[300],
                              ),
                              const SizedBox(height: 16),
                              Text(
                                _searchQuery.isEmpty
                                    ? 'No pending check-ins'
                                    : 'No matching guests',
                                style: TextStyle(
                                  fontSize: 18,
                                  color: isDark ? const Color(0xFFB0B0B0) : Colors.grey[600],
                                ),
                              ),
                              if (_searchQuery.isEmpty) ...[
                                const SizedBox(height: 8),
                                Text(
                                  'All guests have been checked in!',
                                  style: TextStyle(
                                    fontSize: 14,
                                    color: isDark ? const Color(0xFF808080) : Colors.grey[500],
                                  ),
                                ),
                              ],
                            ],
                          ),
                        )
                      : ListView.builder(
                          padding: const EdgeInsets.all(16),
                          itemCount: pendingGuests.length,
                          itemBuilder: (context, index) {
                            final guest = pendingGuests[index];
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
    _roomControllers.putIfAbsent(
      guest.id,
      () => TextEditingController(text: guest.roomNumber ?? ''),
    );

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
                  backgroundColor: AppTheme.primaryOrange,
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
                          color: isDark ? const Color(0xFFE1E1E1) : const Color(0xFF1F2937),
                        ),
                      ),
                      const SizedBox(height: 4),
                      Row(
                        children: [
                          Container(
                            width: 5,
                            height: 5,
                            decoration: const BoxDecoration(
                              color: Colors.orange,
                              shape: BoxShape.circle,
                            ),
                          ),
                          const SizedBox(width: 6),
                          Text(
                            'PENDING',
                            style: TextStyle(
                              fontSize: 10,
                              fontWeight: FontWeight.w600,
                              color: isDark ? const Color(0xFFB0B0B0) : Colors.grey[600],
                              letterSpacing: 0.3,
                            ),
                          ),
                        ],
                      ),
                    ],
                  ),
                ),
              ],
            ),

            // Contact Info Section - only show if data exists
            if (hasEmail || hasPhone) ...[
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
                              size: 16, color: isDark ? const Color(0xFFB0B0B0) : Colors.grey[600]),
                          const SizedBox(width: 8),
                          Expanded(
                            child: Text(
                              guest.email!,
                              style: TextStyle(
                                fontSize: 12,
                                color: isDark ? const Color(0xFFB0B0B0) : Colors.grey[700],
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
                              size: 16, color: isDark ? const Color(0xFFB0B0B0) : Colors.grey[600]),
                          const SizedBox(width: 8),
                          Text(
                            guest.phone!,
                            style: TextStyle(
                              fontSize: 12,
                              color: isDark ? const Color(0xFFB0B0B0) : Colors.grey[700],
                            ),
                          ),
                        ],
                      ),
                  ],
                ),
              ),
            ],

            // Room Selection
            const SizedBox(height: 12),
            InkWell(
              onTap: () => _showRoomSelectionDialog(context, guest),
              child: Container(
                padding: const EdgeInsets.all(12),
                decoration: BoxDecoration(
                  border: Border.all(color: isDark ? const Color(0xFF404040) : Colors.grey[300]!),
                  borderRadius: BorderRadius.circular(10),
                  color: isDark ? const Color(0xFF2C2C2C) : Colors.grey[50],
                ),
                child: Row(
                  children: [
                    Icon(Icons.hotel_outlined,
                        color: isDark ? const Color(0xFFB0B0B0) : Colors.grey[600], size: 20),
                    const SizedBox(width: 12),
                    Expanded(
                      child: Text(
                        _roomControllers[guest.id]?.text.isEmpty ?? true
                            ? 'Select available room'
                            : 'Room ${_roomControllers[guest.id]?.text}',
                        style: TextStyle(
                          fontSize: 14,
                          fontWeight: FontWeight.w500,
                          color:
                              _roomControllers[guest.id]?.text.isEmpty ?? true
                                  ? (isDark ? const Color(0xFF909090) : Colors.grey[600])
                                  : (isDark ? const Color(0xFFE1E1E1) : Colors.black87),
                        ),
                      ),
                    ),
                    Icon(Icons.arrow_drop_down, color: isDark ? const Color(0xFFB0B0B0) : Colors.grey[600]),
                  ],
                ),
              ),
            ),

            // Check In Button
            const SizedBox(height: 12),
            SizedBox(
              width: double.infinity,
              height: 44,
              child: ElevatedButton(
                onPressed: () => _checkInGuest(context, guest, provider),
                style: ElevatedButton.styleFrom(
                  backgroundColor: const Color(0xFF10B981),
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
                    Icon(Icons.login_rounded, size: 18),
                    SizedBox(width: 8),
                    Text(
                      'Check In',
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

  Future<void> _showRoomSelectionDialog(
      BuildContext context, Guest guest) async {
    final roomProvider = Provider.of<RoomProvider>(context, listen: false);
    final guestProvider = Provider.of<GuestProvider>(context, listen: false);

    // Load rooms if not already loaded
    if (roomProvider.rooms.isEmpty) {
      await roomProvider.loadAll();
    }

    // Get all room numbers currently occupied by checked-in guests (excluding current guest)
    final occupiedRoomNumbers = guestProvider.guests
        .where((g) =>
            g.id != guest.id && // Exclude current guest
            (g.status == 'checked-in' || g.status == 'checked_in') &&
            g.roomNumber != null &&
            g.roomNumber!.isNotEmpty)
        .map((g) => g.roomNumber!)
        .toSet();

    // Filter only available rooms that are not already assigned to other guests
    final availableRooms = roomProvider.rooms
        .where((room) =>
            room.currentStatus == 'available' &&
            !occupiedRoomNumbers.contains(room.roomNum))
        .toList();

    if (!context.mounted) return;

    if (availableRooms.isEmpty) {
      EnhancedPopups.showEnhancedSnackBar(
        context,
        message: 'No available rooms found',
        type: PopupType.error,
      );
      return;
    }

    final selectedRoom = await showDialog<Room>(
      context: context,
      builder: (BuildContext context) {
        return _RoomSelectionDialog(availableRooms: availableRooms);
      },
    );

    if (selectedRoom != null) {
      // Initialize controller if it doesn't exist
      _roomControllers[guest.id] ??= TextEditingController();
      _roomControllers[guest.id]!.text = selectedRoom.roomNum;
      setState(() {});
    }
  }

  Future<void> _checkInGuest(
      BuildContext context, Guest guest, GuestProvider provider) async {
    final roomNumber = _roomControllers[guest.id]?.text ?? '';

    if (roomNumber.isEmpty) {
      EnhancedPopups.showEnhancedSnackBar(
        context,
        message: 'Please select a room',
        type: PopupType.error,
      );
      return;
    }

    // Check if room is already assigned to another checked-in guest
    final guestsInRoom = provider.guests
        .where(
          (g) =>
              g.id != guest.id &&
              (g.status == 'checked-in' || g.status == 'checked_in') &&
              g.roomNumber == roomNumber,
        )
        .toList();

    if (guestsInRoom.isNotEmpty) {
      if (context.mounted) {
        EnhancedPopups.showEnhancedSnackBar(
          context,
          message:
              'Room $roomNumber is already occupied by ${guestsInRoom.first.fullName}',
          type: PopupType.error,
        );
      }
      return;
    }

    final bool? confirmed = await EnhancedPopups.showEnhancedConfirmDialog(
      context,
      title: 'Confirm Check-In',
      message: 'Check in ${guest.fullName} to Room $roomNumber?',
      confirmText: 'Check In',
      type: PopupType.info,
    );

    if (confirmed == true) {
      await provider.checkInGuest(guest.id, roomNumber: roomNumber);
      if (context.mounted) {
        EnhancedPopups.showEnhancedSnackBar(
          context,
          message: '${guest.fullName} checked in to Room $roomNumber!',
          type: PopupType.success,
        );
      }
    }
  }
}

class _RoomSelectionDialog extends StatefulWidget {
  final List<Room> availableRooms;

  const _RoomSelectionDialog({required this.availableRooms});

  @override
  State<_RoomSelectionDialog> createState() => _RoomSelectionDialogState();
}

class _RoomSelectionDialogState extends State<_RoomSelectionDialog> {
  final TextEditingController _searchController = TextEditingController();
  String _searchQuery = '';

  @override
  void dispose() {
    _searchController.dispose();
    super.dispose();
  }

  List<Room> get _filteredRooms {
    if (_searchQuery.isEmpty) {
      return widget.availableRooms;
    }
    return widget.availableRooms.where((room) {
      final roomNum = room.roomNum.toLowerCase();
      final roomType = room.roomTypeName.toLowerCase();
      final query = _searchQuery.toLowerCase();
      return roomNum.contains(query) || roomType.contains(query);
    }).toList();
  }

  @override
  Widget build(BuildContext context) {
    return Dialog(
      backgroundColor: Colors.transparent,
      insetPadding: const EdgeInsets.symmetric(horizontal: 16, vertical: 24),
      child: Container(
        constraints: const BoxConstraints(maxHeight: 550, maxWidth: 400),
        decoration: BoxDecoration(
          color: Colors.white,
          borderRadius: BorderRadius.circular(24),
          boxShadow: [
            BoxShadow(
              color: Colors.black.withOpacity(0.15),
              blurRadius: 20,
              offset: const Offset(0, 10),
            ),
          ],
        ),
        child: Column(
          mainAxisSize: MainAxisSize.min,
          children: [
            // Header with Close Button
            Padding(
              padding: const EdgeInsets.fromLTRB(24, 20, 16, 16),
              child: Row(
                children: [
                  Container(
                    padding: const EdgeInsets.all(10),
                    decoration: BoxDecoration(
                      gradient: const LinearGradient(
                        colors: [Color(0xFF1E88E5), Color(0xFF1565C0)],
                        begin: Alignment.topLeft,
                        end: Alignment.bottomRight,
                      ),
                      borderRadius: BorderRadius.circular(12),
                      boxShadow: [
                        BoxShadow(
                          color: const Color(0xFF1E88E5).withOpacity(0.3),
                          blurRadius: 8,
                          offset: const Offset(0, 4),
                        ),
                      ],
                    ),
                    child: const Icon(Icons.meeting_room_rounded,
                        color: Colors.white, size: 24),
                  ),
                  const SizedBox(width: 12),
                  const Expanded(
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        Text(
                          'Select Room',
                          style: TextStyle(
                            fontSize: 20,
                            fontWeight: FontWeight.bold,
                            color: Color(0xFF1A1A1A),
                          ),
                        ),
                        Text(
                          'Choose an available room',
                          style: TextStyle(
                            fontSize: 13,
                            color: Color(0xFF757575),
                          ),
                        ),
                      ],
                    ),
                  ),
                  IconButton(
                    icon: Icon(Icons.close_rounded,
                        color: Colors.grey[600], size: 24),
                    onPressed: () => Navigator.of(context).pop(),
                    padding: EdgeInsets.zero,
                    constraints: const BoxConstraints(),
                  ),
                ],
              ),
            ),

            // Search Bar
            Padding(
              padding: const EdgeInsets.symmetric(horizontal: 20),
              child: Container(
                decoration: BoxDecoration(
                  color: Colors.grey[100],
                  borderRadius: BorderRadius.circular(14),
                  border: Border.all(color: Colors.grey[200]!),
                ),
                child: TextField(
                  controller: _searchController,
                  onChanged: (value) => setState(() => _searchQuery = value),
                  style: const TextStyle(fontSize: 15),
                  decoration: InputDecoration(
                    hintText: 'Search room number or type...',
                    hintStyle: TextStyle(color: Colors.grey[500], fontSize: 14),
                    prefixIcon: Icon(Icons.search_rounded,
                        color: Colors.grey[600], size: 22),
                    suffixIcon: _searchQuery.isNotEmpty
                        ? IconButton(
                            icon: Icon(Icons.cancel_rounded,
                                color: Colors.grey[600], size: 20),
                            onPressed: () {
                              _searchController.clear();
                              setState(() => _searchQuery = '');
                            },
                          )
                        : null,
                    border: InputBorder.none,
                    contentPadding: const EdgeInsets.symmetric(
                        horizontal: 16, vertical: 14),
                  ),
                ),
              ),
            ),

            const SizedBox(height: 16),

            // Room Count Badge
            if (_filteredRooms.isNotEmpty)
              Padding(
                padding: const EdgeInsets.symmetric(horizontal: 20),
                child: Container(
                  padding:
                      const EdgeInsets.symmetric(horizontal: 12, vertical: 8),
                  decoration: BoxDecoration(
                    color: const Color(0xFFE3F2FD),
                    borderRadius: BorderRadius.circular(10),
                  ),
                  child: Row(
                    mainAxisSize: MainAxisSize.min,
                    children: [
                      const Icon(Icons.check_circle_rounded,
                          color: Color(0xFF1976D2), size: 16),
                      const SizedBox(width: 6),
                      Text(
                        '${_filteredRooms.length} ${_filteredRooms.length == 1 ? 'room' : 'rooms'} available',
                        style: const TextStyle(
                          fontSize: 13,
                          color: Color(0xFF1565C0),
                          fontWeight: FontWeight.w600,
                        ),
                      ),
                    ],
                  ),
                ),
              ),

            const SizedBox(height: 12),

            // Room List
            Flexible(
              child: _filteredRooms.isEmpty
                  ? Center(
                      child: Padding(
                        padding: const EdgeInsets.all(32),
                        child: Column(
                          mainAxisSize: MainAxisSize.min,
                          children: [
                            Container(
                              padding: const EdgeInsets.all(20),
                              decoration: BoxDecoration(
                                color: Colors.grey[100],
                                shape: BoxShape.circle,
                              ),
                              child: Icon(Icons.search_off_rounded,
                                  size: 48, color: Colors.grey[400]),
                            ),
                            const SizedBox(height: 16),
                            Text(
                              'No rooms found',
                              style: TextStyle(
                                fontSize: 16,
                                color: Colors.grey[700],
                                fontWeight: FontWeight.w600,
                              ),
                            ),
                            const SizedBox(height: 6),
                            Text(
                              'Try adjusting your search',
                              style: TextStyle(
                                  fontSize: 13, color: Colors.grey[500]),
                            ),
                          ],
                        ),
                      ),
                    )
                  : ListView.builder(
                      shrinkWrap: true,
                      padding: const EdgeInsets.fromLTRB(16, 0, 16, 16),
                      itemCount: _filteredRooms.length,
                      itemBuilder: (context, index) {
                        final room = _filteredRooms[index];
                        return Padding(
                          padding: const EdgeInsets.only(bottom: 10),
                          child: Material(
                            color: Colors.transparent,
                            child: InkWell(
                              onTap: () => Navigator.of(context).pop(room),
                              borderRadius: BorderRadius.circular(16),
                              child: Ink(
                                decoration: BoxDecoration(
                                  gradient: LinearGradient(
                                    colors: [Colors.white, Colors.grey[50]!],
                                    begin: Alignment.topLeft,
                                    end: Alignment.bottomRight,
                                  ),
                                  borderRadius: BorderRadius.circular(16),
                                  border: Border.all(color: Colors.grey[300]!),
                                  boxShadow: [
                                    BoxShadow(
                                      color: Colors.black.withOpacity(0.04),
                                      blurRadius: 8,
                                      offset: const Offset(0, 2),
                                    ),
                                  ],
                                ),
                                child: Padding(
                                  padding: const EdgeInsets.all(14),
                                  child: Row(
                                    children: [
                                      // Room Number Badge
                                      Container(
                                        width: 56,
                                        height: 56,
                                        decoration: BoxDecoration(
                                          gradient: const LinearGradient(
                                            colors: [
                                              Color(0xFF4CAF50),
                                              Color(0xFF388E3C)
                                            ],
                                            begin: Alignment.topLeft,
                                            end: Alignment.bottomRight,
                                          ),
                                          borderRadius:
                                              BorderRadius.circular(14),
                                          boxShadow: [
                                            BoxShadow(
                                              color: const Color(0xFF4CAF50)
                                                  .withOpacity(0.3),
                                              blurRadius: 8,
                                              offset: const Offset(0, 4),
                                            ),
                                          ],
                                        ),
                                        child: Column(
                                          mainAxisAlignment:
                                              MainAxisAlignment.center,
                                          children: [
                                            const Icon(
                                                Icons.door_front_door_rounded,
                                                color: Colors.white,
                                                size: 22),
                                            const SizedBox(height: 2),
                                            Text(
                                              room.roomNum,
                                              style: const TextStyle(
                                                color: Colors.white,
                                                fontSize: 11,
                                                fontWeight: FontWeight.bold,
                                              ),
                                            ),
                                          ],
                                        ),
                                      ),
                                      const SizedBox(width: 14),
                                      // Room Details
                                      Expanded(
                                        child: Column(
                                          crossAxisAlignment:
                                              CrossAxisAlignment.start,
                                          children: [
                                            Text(
                                              room.roomTypeName,
                                              style: const TextStyle(
                                                fontSize: 15,
                                                fontWeight: FontWeight.bold,
                                                color: Color(0xFF1A1A1A),
                                              ),
                                            ),
                                            const SizedBox(height: 4),
                                            Row(
                                              children: [
                                                Icon(Icons.check_circle,
                                                    color: Colors.green[600],
                                                    size: 14),
                                                const SizedBox(width: 4),
                                                Text(
                                                  'Available Now',
                                                  style: TextStyle(
                                                    fontSize: 12,
                                                    color: Colors.green[700],
                                                    fontWeight: FontWeight.w600,
                                                  ),
                                                ),
                                              ],
                                            ),
                                          ],
                                        ),
                                      ),
                                      // Arrow
                                      Icon(Icons.arrow_forward_ios_rounded,
                                          size: 18, color: Colors.grey[400]),
                                    ],
                                  ),
                                ),
                              ),
                            ),
                          ),
                        );
                      },
                    ),
            ),
          ],
        ),
      ),
    );
  }
}
