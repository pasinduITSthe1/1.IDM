import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import '../../models/room.dart';
import '../../providers/room_provider.dart';

class RoomDetailsScreen extends StatelessWidget {
  final Room room;

  const RoomDetailsScreen({Key? key, required this.room}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Room ${room.roomNum}'),
        actions: [
          // Quick Status Change Menu
          PopupMenuButton<int>(
            icon: const Icon(Icons.more_vert),
            onSelected: (statusCode) => _updateStatus(context, statusCode),
            itemBuilder: (context) => [
              const PopupMenuItem(
                value: 1,
                child: ListTile(
                  leading: Icon(Icons.check_circle, color: Colors.green),
                  title: Text('Mark as Available'),
                  contentPadding: EdgeInsets.zero,
                ),
              ),
              const PopupMenuItem(
                value: 3,
                child: ListTile(
                  leading: Icon(Icons.cleaning_services, color: Colors.blue),
                  title: Text('Mark as Cleaning'),
                  contentPadding: EdgeInsets.zero,
                ),
              ),
              const PopupMenuItem(
                value: 4,
                child: ListTile(
                  leading: Icon(Icons.build, color: Colors.red),
                  title: Text('Mark as Maintenance'),
                  contentPadding: EdgeInsets.zero,
                ),
              ),
            ],
          ),
        ],
      ),
      body: SingleChildScrollView(
        padding: const EdgeInsets.all(16),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            // Status Card
            _buildStatusCard(context),
            const SizedBox(height: 16),

            // Room Information
            _buildSectionCard(
              context,
              'Room Information',
              Icons.info_outline,
              [
                _buildInfoRow('Room Number', room.roomNum),
                _buildInfoRow('Room Type', room.roomTypeName),
                if (room.floor != null) _buildInfoRow('Floor', room.floor!),
                if (room.description != null && room.description!.isNotEmpty)
                  _buildInfoRow('Description', room.description!),
                _buildInfoRow('Hotel', room.hotelName),
                if (room.hotelPhone != null)
                  _buildInfoRow('Hotel Phone', room.hotelPhone!),
              ],
            ),

            // Features (if any)
            if (room.features.isNotEmpty) ...[
              const SizedBox(height: 16),
              _buildFeaturesCard(context),
            ],

            // Guest Information (if occupied)
            if (room.isOccupiedStatus && room.guestName != null) ...[
              const SizedBox(height: 16),
              _buildGuestInfoCard(context),
            ],

            // Status Change Actions
            const SizedBox(height: 24),
            _buildActionButtons(context),
          ],
        ),
      ),
    );
  }

  Widget _buildStatusCard(BuildContext context) {
    final statusColor = _getStatusColor(room.currentStatus);

    return Card(
      elevation: 2,
      shape: RoundedRectangleBorder(
        borderRadius: BorderRadius.circular(12),
        side: BorderSide(color: statusColor, width: 2),
      ),
      child: Padding(
        padding: const EdgeInsets.all(14),
        child: Row(
          children: [
            Container(
              padding: const EdgeInsets.all(8),
              decoration: BoxDecoration(
                color: statusColor.withValues(alpha: 0.2),
                shape: BoxShape.circle,
              ),
              child: Icon(
                _getStatusIcon(room.currentStatus),
                color: statusColor,
                size: 24,
              ),
            ),
            const SizedBox(width: 12),
            Expanded(
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Text(
                    'Current Status',
                    style: Theme.of(context).textTheme.bodySmall?.copyWith(
                          color: Colors.grey,
                          fontSize: 12,
                        ),
                  ),
                  const SizedBox(height: 2),
                  Text(
                    room.statusDisplayName,
                    style: Theme.of(context).textTheme.titleLarge?.copyWith(
                          fontWeight: FontWeight.bold,
                          color: statusColor,
                          fontSize: 20,
                        ),
                  ),
                ],
              ),
            ),
          ],
        ),
      ),
    );
  }

  Widget _buildSectionCard(
    BuildContext context,
    String title,
    IconData icon,
    List<Widget> children,
  ) {
    return Card(
      elevation: 2,
      child: Padding(
        padding: const EdgeInsets.all(16),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Row(
              children: [
                Icon(icon, color: Theme.of(context).primaryColor),
                const SizedBox(width: 8),
                Text(
                  title,
                  style: Theme.of(context).textTheme.titleLarge?.copyWith(
                        fontWeight: FontWeight.bold,
                      ),
                ),
              ],
            ),
            const Divider(height: 24),
            ...children,
          ],
        ),
      ),
    );
  }

  Widget _buildInfoRow(String label, String value) {
    return Padding(
      padding: const EdgeInsets.symmetric(vertical: 8),
      child: Row(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          SizedBox(
            width: 120,
            child: Text(
              label,
              style: const TextStyle(
                fontWeight: FontWeight.w600,
                color: Colors.grey,
              ),
            ),
          ),
          Expanded(
            child: Text(
              value,
              style: const TextStyle(fontSize: 16),
            ),
          ),
        ],
      ),
    );
  }

  Widget _buildFeaturesCard(BuildContext context) {
    return Card(
      elevation: 2,
      child: Padding(
        padding: const EdgeInsets.all(16),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Row(
              children: [
                Icon(Icons.star, color: Theme.of(context).primaryColor),
                const SizedBox(width: 8),
                Text(
                  'Features',
                  style: Theme.of(context).textTheme.titleLarge?.copyWith(
                        fontWeight: FontWeight.bold,
                      ),
                ),
              ],
            ),
            const Divider(height: 24),
            Wrap(
              spacing: 8,
              runSpacing: 8,
              children: room.features.map((feature) {
                return Chip(
                  label: Text(feature),
                  avatar: const Icon(Icons.check, size: 16),
                );
              }).toList(),
            ),
          ],
        ),
      ),
    );
  }

  Widget _buildGuestInfoCard(BuildContext context) {
    return Card(
      elevation: 2,
      color: Colors.orange.shade50,
      child: Padding(
        padding: const EdgeInsets.all(16),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Row(
              children: [
                const Icon(Icons.person, color: Colors.orange),
                const SizedBox(width: 8),
                Text(
                  'Current Guest',
                  style: Theme.of(context).textTheme.titleLarge?.copyWith(
                        fontWeight: FontWeight.bold,
                      ),
                ),
              ],
            ),
            const Divider(height: 24),
            _buildInfoRow('Guest Name', room.guestName!),
            if (room.checkInDate != null)
              _buildInfoRow('Check-in', _formatDateTime(room.checkInDate!)),
            if (room.checkOutDate != null)
              _buildInfoRow('Check-out', _formatDateTime(room.checkOutDate!)),
            if (room.bookingId != null)
              _buildInfoRow('Booking ID', '#${room.bookingId}'),
          ],
        ),
      ),
    );
  }

  Widget _buildActionButtons(BuildContext context) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.stretch,
      children: [
        Text(
          'Change Room Status',
          style: Theme.of(context).textTheme.titleMedium?.copyWith(
                fontWeight: FontWeight.bold,
              ),
        ),
        const SizedBox(height: 12),
        if (!room.isAvailable)
          ElevatedButton.icon(
            onPressed: () => _updateStatus(context, 1),
            icon: const Icon(Icons.check_circle),
            label: const Text('Mark as Available'),
            style: ElevatedButton.styleFrom(
              backgroundColor: Colors.green,
              foregroundColor: Colors.white,
              padding: const EdgeInsets.all(16),
            ),
          ),
        const SizedBox(height: 8),
        if (!room.isCleaning)
          ElevatedButton.icon(
            onPressed: () => _updateStatus(context, 3),
            icon: const Icon(Icons.cleaning_services),
            label: const Text('Mark as Cleaning'),
            style: ElevatedButton.styleFrom(
              backgroundColor: Colors.blue,
              foregroundColor: Colors.white,
              padding: const EdgeInsets.all(16),
            ),
          ),
        const SizedBox(height: 8),
        if (!room.isInMaintenance)
          ElevatedButton.icon(
            onPressed: () => _updateStatus(context, 4),
            icon: const Icon(Icons.build),
            label: const Text('Mark as Maintenance'),
            style: ElevatedButton.styleFrom(
              backgroundColor: Colors.red,
              foregroundColor: Colors.white,
              padding: const EdgeInsets.all(16),
            ),
          ),
      ],
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

    final success = await provider.updateRoomStatus(room.id, statusCode);

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
