import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import '../../models/room.dart';
import '../../providers/room_provider.dart';

class RoomDetailsScreen extends StatefulWidget {
  final Room room;

  const RoomDetailsScreen({Key? key, required this.room}) : super(key: key);

  @override
  State<RoomDetailsScreen> createState() => _RoomDetailsScreenState();
}

class _RoomDetailsScreenState extends State<RoomDetailsScreen> {
  bool _isDescriptionExpanded = false;

  @override
  Widget build(BuildContext context) {
    final isDark = Theme.of(context).brightness == Brightness.dark;
    final statusColor = _getStatusColor(widget.room.currentStatus);

    return Scaffold(
      backgroundColor: isDark ? const Color(0xFF121212) : Colors.grey[50],
      appBar: AppBar(
        elevation: 0,
        backgroundColor: isDark ? const Color(0xFF1E1E1E) : Colors.white,
        leading: IconButton(
          icon: Icon(Icons.arrow_back,
              color: isDark ? Colors.white : Colors.black87),
          onPressed: () => Navigator.pop(context),
        ),
        title: Text(
          'Room ${widget.room.roomNum}',
          style: TextStyle(
            color: isDark ? Colors.white : Colors.black87,
            fontWeight: FontWeight.w600,
          ),
        ),
        actions: [
          PopupMenuButton<int>(
            icon: Icon(Icons.more_vert,
                color: isDark ? Colors.white : Colors.black87),
            onSelected: (statusCode) => _updateStatus(context, statusCode),
            itemBuilder: (context) => [
              const PopupMenuItem(
                value: 1,
                child: ListTile(
                  leading:
                      Icon(Icons.check_circle, color: Colors.green, size: 20),
                  title:
                      Text('Mark as Available', style: TextStyle(fontSize: 14)),
                  contentPadding: EdgeInsets.zero,
                  dense: true,
                ),
              ),
              const PopupMenuItem(
                value: 3,
                child: ListTile(
                  leading: Icon(Icons.cleaning_services,
                      color: Colors.blue, size: 20),
                  title:
                      Text('Mark as Cleaning', style: TextStyle(fontSize: 14)),
                  contentPadding: EdgeInsets.zero,
                  dense: true,
                ),
              ),
              const PopupMenuItem(
                value: 4,
                child: ListTile(
                  leading: Icon(Icons.build, color: Colors.red, size: 20),
                  title: Text('Mark as Maintenance',
                      style: TextStyle(fontSize: 14)),
                  contentPadding: EdgeInsets.zero,
                  dense: true,
                ),
              ),
            ],
          ),
        ],
      ),
      body: SingleChildScrollView(
        child: Column(
          children: [
            // Status Card with gradient background
            Container(
              width: double.infinity,
              margin: const EdgeInsets.all(16),
              padding: const EdgeInsets.all(16),
              decoration: BoxDecoration(
                gradient: LinearGradient(
                  colors: [statusColor, statusColor.withOpacity(0.7)],
                  begin: Alignment.topLeft,
                  end: Alignment.bottomRight,
                ),
                borderRadius: BorderRadius.circular(12),
                boxShadow: [
                  BoxShadow(
                    color: statusColor.withOpacity(0.3),
                    blurRadius: 8,
                    offset: const Offset(0, 3),
                  ),
                ],
              ),
              child: Row(
                children: [
                  Container(
                    padding: const EdgeInsets.all(8),
                    decoration: BoxDecoration(
                      color: Colors.white.withOpacity(0.3),
                      shape: BoxShape.circle,
                    ),
                    child: Icon(
                      _getStatusIcon(widget.room.currentStatus),
                      color: Colors.white,
                      size: 20,
                    ),
                  ),
                  const SizedBox(width: 12),
                  Expanded(
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        Text(
                          'Current Status',
                          style: TextStyle(
                            color: Colors.white.withOpacity(0.9),
                            fontSize: 11,
                            fontWeight: FontWeight.w500,
                          ),
                        ),
                        const SizedBox(height: 2),
                        Text(
                          widget.room.statusDisplayName,
                          style: const TextStyle(
                            color: Colors.white,
                            fontSize: 18,
                            fontWeight: FontWeight.bold,
                          ),
                        ),
                      ],
                    ),
                  ),
                ],
              ),
            ),

            // Quick Actions (moved to top)
            _buildQuickActions(context, isDark),

            // Room Information Section
            _buildModernInfoSection(context, isDark),

            // Guest Information (if occupied)
            if (widget.room.isOccupiedStatus && widget.room.guestName != null)
              _buildGuestSection(context, isDark),

            const SizedBox(height: 20),
          ],
        ),
      ),
    );
  }

  Widget _buildModernInfoSection(BuildContext context, bool isDark) {
    return Container(
      margin: const EdgeInsets.symmetric(horizontal: 16),
      padding: const EdgeInsets.all(20),
      decoration: BoxDecoration(
        color: isDark ? const Color(0xFF1E1E1E) : Colors.white,
        borderRadius: BorderRadius.circular(16),
        border: isDark ? Border.all(color: const Color(0xFF404040)) : null,
      ),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Row(
            children: [
              Container(
                padding: const EdgeInsets.all(8),
                decoration: BoxDecoration(
                  color: Colors.orange.withOpacity(0.1),
                  borderRadius: BorderRadius.circular(8),
                ),
                child: const Icon(Icons.info_outline,
                    color: Colors.orange, size: 20),
              ),
              const SizedBox(width: 12),
              Text(
                'Room Information',
                style: TextStyle(
                  fontSize: 18,
                  fontWeight: FontWeight.bold,
                  color: isDark ? Colors.white : Colors.black87,
                ),
              ),
            ],
          ),
          const SizedBox(height: 20),
          _buildModernInfoRow(
              'Room Number', widget.room.roomNum, Icons.meeting_room, isDark),
          const SizedBox(height: 16),
          _buildModernInfoRow(
              'Room Type', widget.room.roomTypeName, Icons.bed, isDark),
          if (widget.room.floor != null) ...[
            const SizedBox(height: 16),
            _buildModernInfoRow(
                'Floor', widget.room.floor!, Icons.stairs, isDark),
          ],
          if (widget.room.description != null &&
              widget.room.description!.isNotEmpty) ...[
            const SizedBox(height: 16),
            _buildDescriptionSection(widget.room.description!, isDark),
          ],
          const SizedBox(height: 16),
          _buildModernInfoRow(
              'Hotel', widget.room.hotelName, Icons.apartment, isDark),
          if (widget.room.hotelPhone != null) ...[
            const SizedBox(height: 16),
            _buildModernInfoRow(
                'Hotel Phone', widget.room.hotelPhone!, Icons.phone, isDark),
          ],
        ],
      ),
    );
  }

  Widget _buildModernInfoRow(
      String label, String value, IconData icon, bool isDark) {
    return Row(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Icon(icon,
            size: 18,
            color: isDark ? const Color(0xFF808080) : Colors.grey[600]),
        const SizedBox(width: 12),
        Expanded(
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              Text(
                label,
                style: TextStyle(
                  fontSize: 12,
                  color: isDark ? const Color(0xFF808080) : Colors.grey[600],
                  fontWeight: FontWeight.w500,
                ),
              ),
              const SizedBox(height: 4),
              Text(
                value,
                style: TextStyle(
                  fontSize: 15,
                  color: isDark ? const Color(0xFFE1E1E1) : Colors.black87,
                  fontWeight: FontWeight.w500,
                ),
              ),
            ],
          ),
        ),
      ],
    );
  }

  Widget _buildDescriptionSection(String description, bool isDark) {
    const int maxLines = 3;
    final bool isLongDescription = description.length > 150;

    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Row(
          children: [
            Icon(Icons.description,
                size: 18,
                color: isDark ? const Color(0xFF808080) : Colors.grey[600]),
            const SizedBox(width: 12),
            Text(
              'Description',
              style: TextStyle(
                fontSize: 12,
                color: isDark ? const Color(0xFF808080) : Colors.grey[600],
                fontWeight: FontWeight.w500,
              ),
            ),
          ],
        ),
        const SizedBox(height: 8),
        Padding(
          padding: const EdgeInsets.only(left: 30),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              Text(
                description,
                maxLines: _isDescriptionExpanded
                    ? null
                    : (isLongDescription ? maxLines : null),
                overflow: _isDescriptionExpanded
                    ? null
                    : (isLongDescription ? TextOverflow.ellipsis : null),
                style: TextStyle(
                  fontSize: 14,
                  color: isDark ? const Color(0xFFB0B0B0) : Colors.grey[700],
                  height: 1.5,
                ),
              ),
              if (isLongDescription) ...[
                const SizedBox(height: 6),
                GestureDetector(
                  onTap: () {
                    setState(() {
                      _isDescriptionExpanded = !_isDescriptionExpanded;
                    });
                  },
                  child: Text(
                    _isDescriptionExpanded ? 'Show less' : 'See more',
                    style: TextStyle(
                      fontSize: 13,
                      color: Colors.orange,
                      fontWeight: FontWeight.w600,
                    ),
                  ),
                ),
              ],
            ],
          ),
        ),
      ],
    );
  }

  Widget _buildGuestSection(BuildContext context, bool isDark) {
    return Container(
      margin: const EdgeInsets.fromLTRB(16, 16, 16, 0),
      padding: const EdgeInsets.all(20),
      decoration: BoxDecoration(
        gradient: LinearGradient(
          colors: isDark
              ? [const Color(0xFF2C2C2C), const Color(0xFF1E1E1E)]
              : [Colors.orange[50]!, Colors.orange[100]!],
          begin: Alignment.topLeft,
          end: Alignment.bottomRight,
        ),
        borderRadius: BorderRadius.circular(16),
        border:
            isDark ? Border.all(color: Colors.orange.withOpacity(0.3)) : null,
      ),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Row(
            children: [
              Container(
                padding: const EdgeInsets.all(8),
                decoration: BoxDecoration(
                  color: Colors.orange.withOpacity(0.2),
                  borderRadius: BorderRadius.circular(8),
                ),
                child: const Icon(Icons.person, color: Colors.orange, size: 20),
              ),
              const SizedBox(width: 12),
              Text(
                'Current Guest',
                style: TextStyle(
                  fontSize: 18,
                  fontWeight: FontWeight.bold,
                  color: isDark ? Colors.white : Colors.black87,
                ),
              ),
            ],
          ),
          const SizedBox(height: 20),
          _buildGuestInfoRow('Guest Name', widget.room.guestName!,
              Icons.person_outline, isDark),
          if (widget.room.checkInDate != null) ...[
            const SizedBox(height: 12),
            _buildGuestInfoRow('Check-in',
                _formatDateTime(widget.room.checkInDate!), Icons.login, isDark),
          ],
          if (widget.room.checkOutDate != null) ...[
            const SizedBox(height: 12),
            _buildGuestInfoRow(
                'Check-out',
                _formatDateTime(widget.room.checkOutDate!),
                Icons.logout,
                isDark),
          ],
          if (widget.room.bookingId != null) ...[
            const SizedBox(height: 12),
            _buildGuestInfoRow('Booking ID', '#${widget.room.bookingId}',
                Icons.confirmation_number, isDark),
          ],
        ],
      ),
    );
  }

  Widget _buildGuestInfoRow(
      String label, String value, IconData icon, bool isDark) {
    return Row(
      children: [
        Icon(icon, size: 16, color: Colors.orange),
        const SizedBox(width: 10),
        Text(
          '$label: ',
          style: TextStyle(
            fontSize: 13,
            color: isDark ? const Color(0xFF808080) : Colors.grey[700],
            fontWeight: FontWeight.w500,
          ),
        ),
        Expanded(
          child: Text(
            value,
            style: TextStyle(
              fontSize: 14,
              color: isDark ? const Color(0xFFE1E1E1) : Colors.black87,
              fontWeight: FontWeight.w600,
            ),
          ),
        ),
      ],
    );
  }

  Widget _buildQuickActions(BuildContext context, bool isDark) {
    return Container(
      margin: const EdgeInsets.fromLTRB(16, 0, 16, 16),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Text(
            'Quick Actions',
            style: TextStyle(
              fontSize: 14,
              fontWeight: FontWeight.bold,
              color: isDark ? Colors.white : Colors.black87,
            ),
          ),
          const SizedBox(height: 10),
          if (!widget.room.isAvailable)
            _buildActionButton(
              context,
              'Mark as Available',
              Icons.check_circle,
              Colors.green,
              () => _updateStatus(context, 1),
              isDark,
            ),
          const SizedBox(height: 8),
          if (!widget.room.isCleaning)
            _buildActionButton(
              context,
              'Mark as Cleaning',
              Icons.cleaning_services,
              Colors.blue,
              () => _updateStatus(context, 3),
              isDark,
            ),
          const SizedBox(height: 8),
          if (!widget.room.isInMaintenance)
            _buildActionButton(
              context,
              'Mark as Maintenance',
              Icons.build,
              Colors.red,
              () => _updateStatus(context, 4),
              isDark,
            ),
        ],
      ),
    );
  }

  Widget _buildActionButton(
    BuildContext context,
    String label,
    IconData icon,
    Color color,
    VoidCallback onPressed,
    bool isDark,
  ) {
    return InkWell(
      onTap: onPressed,
      borderRadius: BorderRadius.circular(10),
      child: Container(
        padding: const EdgeInsets.symmetric(horizontal: 14, vertical: 12),
        decoration: BoxDecoration(
          color: isDark ? const Color(0xFF1E1E1E) : Colors.white,
          borderRadius: BorderRadius.circular(10),
          border: Border.all(
            color: isDark ? const Color(0xFF404040) : Colors.grey[300]!,
          ),
        ),
        child: Row(
          children: [
            Container(
              padding: const EdgeInsets.all(6),
              decoration: BoxDecoration(
                color: color.withOpacity(0.1),
                borderRadius: BorderRadius.circular(6),
              ),
              child: Icon(icon, color: color, size: 18),
            ),
            const SizedBox(width: 12),
            Expanded(
              child: Text(
                label,
                style: TextStyle(
                  fontSize: 14,
                  fontWeight: FontWeight.w600,
                  color: isDark ? Colors.white : Colors.black87,
                ),
              ),
            ),
            Icon(
              Icons.arrow_forward_ios,
              size: 14,
              color: isDark ? const Color(0xFF808080) : Colors.grey[400],
            ),
          ],
        ),
      ),
    );
  }

  Future<void> _updateStatus(BuildContext context, int statusCode) async {
    final provider = context.read<RoomProvider>();

    // Show loading dialog
    showDialog(
      context: context,
      barrierDismissible: false,
      builder: (context) => const Center(
        child: CircularProgressIndicator(),
      ),
    );

    final success = await provider.updateRoomStatus(widget.room.id, statusCode);

    // Close loading dialog
    if (context.mounted) {
      Navigator.pop(context);
    }

    if (success) {
      if (context.mounted) {
        ScaffoldMessenger.of(context).showSnackBar(
          const SnackBar(
            content: Text('Room status updated successfully'),
            backgroundColor: Colors.green,
          ),
        );
        // Go back to refresh the previous screen
        Navigator.pop(context);
      }
    } else {
      if (context.mounted) {
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(
            content: Text(provider.error ?? 'Failed to update room status'),
            backgroundColor: Colors.red,
          ),
        );
      }
    }
  }

  Color _getStatusColor(String status) {
    switch (status) {
      case 'available':
        return Colors.green;
      case 'occupied':
        return Colors.orange;
      case 'cleaning':
        return Colors.blue;
      case 'maintenance':
        return Colors.red;
      default:
        return Colors.grey;
    }
  }

  IconData _getStatusIcon(String status) {
    switch (status) {
      case 'available':
        return Icons.check_circle;
      case 'occupied':
        return Icons.person;
      case 'cleaning':
        return Icons.cleaning_services;
      case 'maintenance':
        return Icons.build;
      default:
        return Icons.help_outline;
    }
  }

  String _formatDateTime(String dateString) {
    try {
      final date = DateTime.parse(dateString);
      return '${date.month}/${date.day}/${date.year}';
    } catch (e) {
      return dateString;
    }
  }
}
