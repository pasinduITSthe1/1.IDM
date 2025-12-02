import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:intl/intl.dart';
import '../../models/room_change.dart';
import '../../providers/room_change_provider.dart';
import '../../providers/guest_provider.dart';

class RoomChangeDetailsScreen extends StatelessWidget {
  final RoomChange roomChange;

  const RoomChangeDetailsScreen({
    super.key,
    required this.roomChange,
  });

  @override
  Widget build(BuildContext context) {
    final dateFormat = DateFormat('MMM dd, yyyy HH:mm');
    final dateOnlyFormat = DateFormat('MMM dd, yyyy');

    Color statusColor;
    switch (roomChange.status) {
      case 'pending':
        statusColor = Colors.orange;
        break;
      case 'completed':
        statusColor = Colors.green;
        break;
      case 'cancelled':
        statusColor = Colors.red;
        break;
      default:
        statusColor = Colors.grey;
    }

    return Scaffold(
      appBar: AppBar(
        title: const Text('Room Change Details'),
        actions: [
          if (roomChange.isPending)
            PopupMenuButton(
              itemBuilder: (context) => [
                const PopupMenuItem(
                  value: 'complete',
                  child: Row(
                    children: [
                      Icon(Icons.check_circle, color: Colors.green),
                      SizedBox(width: 8),
                      Text('Mark as Completed'),
                    ],
                  ),
                ),
                const PopupMenuItem(
                  value: 'cancel',
                  child: Row(
                    children: [
                      Icon(Icons.cancel, color: Colors.red),
                      SizedBox(width: 8),
                      Text('Cancel Room Change'),
                    ],
                  ),
                ),
              ],
              onSelected: (value) {
                if (value == 'complete') {
                  _showCompleteDialog(context);
                } else if (value == 'cancel') {
                  _showCancelDialog(context);
                }
              },
            ),
        ],
      ),
      body: SingleChildScrollView(
        padding: const EdgeInsets.all(16),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            // Status Badge
            Center(
              child: Container(
                padding: const EdgeInsets.symmetric(
                  horizontal: 24,
                  vertical: 12,
                ),
                decoration: BoxDecoration(
                  color: statusColor.withOpacity(0.2),
                  borderRadius: BorderRadius.circular(24),
                ),
                child: Row(
                  mainAxisSize: MainAxisSize.min,
                  children: [
                    Icon(
                      roomChange.isCompleted
                          ? Icons.check_circle
                          : roomChange.isCancelled
                              ? Icons.cancel
                              : Icons.pending,
                      color: statusColor,
                    ),
                    const SizedBox(width: 8),
                    Text(
                      roomChange.statusDisplayName,
                      style: TextStyle(
                        color: statusColor,
                        fontWeight: FontWeight.bold,
                        fontSize: 16,
                      ),
                    ),
                  ],
                ),
              ),
            ),
            const SizedBox(height: 24),

            // Guest Information
            _buildSectionCard(
              'Guest Information',
              Icons.person,
              [
                _buildInfoRow('Guest Name', roomChange.guestName),
                _buildInfoRow('Booking ID', '#${roomChange.bookingId}'),
                if (roomChange.idOrder != null)
                  _buildInfoRow('Order ID', '#${roomChange.idOrder}'),
              ],
            ),
            const SizedBox(height: 16),

            // Room Change Information
            _buildSectionCard(
              'Room Change',
              Icons.swap_horiz,
              [
                Row(
                  children: [
                    Expanded(
                      child: _buildRoomCard(
                        'Original Room',
                        roomChange.oldRoomNum,
                        Colors.red,
                      ),
                    ),
                    const Padding(
                      padding: EdgeInsets.symmetric(horizontal: 16),
                      child: Icon(Icons.arrow_forward, size: 32),
                    ),
                    Expanded(
                      child: _buildRoomCard(
                        'New Room',
                        roomChange.newRoomNum,
                        Colors.green,
                      ),
                    ),
                  ],
                ),
              ],
            ),
            const SizedBox(height: 16),

            // Stay Information
            _buildSectionCard(
              'Stay Information',
              Icons.calendar_today,
              [
                _buildInfoRow(
                  'Check-in Date',
                  dateOnlyFormat.format(roomChange.checkInDate),
                ),
                _buildInfoRow(
                  'Check-out Date',
                  dateOnlyFormat.format(roomChange.checkOutDate),
                ),
                if (roomChange.totalNights != null)
                  _buildInfoRow(
                    'Total Nights',
                    '${roomChange.totalNights} nights',
                  ),
              ],
            ),
            const SizedBox(height: 16),

            // Reason for Change
            _buildSectionCard(
              'Reason for Change',
              Icons.info_outline,
              [
                Container(
                  width: double.infinity,
                  padding: const EdgeInsets.all(12),
                  decoration: BoxDecoration(
                    color: Colors.grey[100],
                    borderRadius: BorderRadius.circular(8),
                  ),
                  child: Text(
                    roomChange.changeReason,
                    style: const TextStyle(fontSize: 14),
                  ),
                ),
              ],
            ),
            const SizedBox(height: 16),

            // Additional Notes (if any)
            if (roomChange.notes != null && roomChange.notes!.isNotEmpty)
              _buildSectionCard(
                'Additional Notes',
                Icons.note,
                [
                  Container(
                    width: double.infinity,
                    padding: const EdgeInsets.all(12),
                    decoration: BoxDecoration(
                      color: Colors.blue[50],
                      borderRadius: BorderRadius.circular(8),
                    ),
                    child: Text(
                      roomChange.notes!,
                      style: const TextStyle(fontSize: 14),
                    ),
                  ),
                ],
              ),
            if (roomChange.notes != null && roomChange.notes!.isNotEmpty)
              const SizedBox(height: 16),

            // Change Metadata
            _buildSectionCard(
              'Change Details',
              Icons.history,
              [
                _buildInfoRow(
                  'Changed By',
                  roomChange.changedBy,
                ),
                _buildInfoRow(
                  'Change Date',
                  dateFormat.format(roomChange.changeDate),
                ),
                _buildInfoRow(
                  'Created At',
                  dateFormat.format(roomChange.createdAt),
                ),
                if (roomChange.updatedAt != null)
                  _buildInfoRow(
                    'Last Updated',
                    dateFormat.format(roomChange.updatedAt!),
                  ),
              ],
            ),
          ],
        ),
      ),
    );
  }

  Widget _buildSectionCard(String title, IconData icon, List<Widget> children) {
    return Card(
      child: Padding(
        padding: const EdgeInsets.all(16),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Row(
              children: [
                Icon(icon, size: 20),
                const SizedBox(width: 8),
                Text(
                  title,
                  style: const TextStyle(
                    fontSize: 16,
                    fontWeight: FontWeight.bold,
                  ),
                ),
              ],
            ),
            const SizedBox(height: 12),
            ...children,
          ],
        ),
      ),
    );
  }

  Widget _buildInfoRow(String label, String value) {
    return Padding(
      padding: const EdgeInsets.only(bottom: 8),
      child: Row(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          SizedBox(
            width: 120,
            child: Text(
              label,
              style: TextStyle(
                fontSize: 13,
                color: Colors.grey[600],
              ),
            ),
          ),
          Expanded(
            child: Text(
              value,
              style: const TextStyle(
                fontSize: 14,
                fontWeight: FontWeight.w500,
              ),
            ),
          ),
        ],
      ),
    );
  }

  Widget _buildRoomCard(String label, String roomNum, Color color) {
    return Container(
      padding: const EdgeInsets.all(16),
      decoration: BoxDecoration(
        color: color.withOpacity(0.1),
        borderRadius: BorderRadius.circular(12),
        border: Border.all(color: color.withOpacity(0.3)),
      ),
      child: Column(
        children: [
          Text(
            label,
            style: TextStyle(
              fontSize: 12,
              color: Colors.grey[600],
            ),
          ),
          const SizedBox(height: 8),
          Icon(Icons.meeting_room, color: color, size: 32),
          const SizedBox(height: 4),
          Text(
            roomNum,
            style: TextStyle(
              fontSize: 20,
              fontWeight: FontWeight.bold,
              color: color,
            ),
          ),
        ],
      ),
    );
  }

  void _showCompleteDialog(BuildContext context) {
    final notesController = TextEditingController();

    showDialog(
      context: context,
      builder: (context) => AlertDialog(
        title: const Text('Complete Room Change'),
        content: Column(
          mainAxisSize: MainAxisSize.min,
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            const Text(
                'This will mark the room change as completed and update the guest\'s room assignment.'),
            const SizedBox(height: 16),
            TextField(
              controller: notesController,
              decoration: const InputDecoration(
                labelText: 'Completion Notes (Optional)',
                border: OutlineInputBorder(),
              ),
              maxLines: 3,
            ),
          ],
        ),
        actions: [
          TextButton(
            onPressed: () => Navigator.of(context).pop(),
            child: const Text('Cancel'),
          ),
          ElevatedButton(
            onPressed: () async {
              Navigator.of(context).pop();
              await _completeRoomChange(context, notesController.text);
            },
            child: const Text('Complete'),
          ),
        ],
      ),
    );
  }

  void _showCancelDialog(BuildContext context) {
    final notesController = TextEditingController();

    showDialog(
      context: context,
      builder: (context) => AlertDialog(
        title: const Text('Cancel Room Change'),
        content: Column(
          mainAxisSize: MainAxisSize.min,
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            const Text(
                'This will cancel the room change request. The guest will remain in the original room.'),
            const SizedBox(height: 16),
            TextField(
              controller: notesController,
              decoration: const InputDecoration(
                labelText: 'Cancellation Reason (Optional)',
                border: OutlineInputBorder(),
              ),
              maxLines: 3,
            ),
          ],
        ),
        actions: [
          TextButton(
            onPressed: () => Navigator.of(context).pop(),
            child: const Text('Back'),
          ),
          ElevatedButton(
            onPressed: () async {
              Navigator.of(context).pop();
              await _cancelRoomChange(context, notesController.text);
            },
            style: ElevatedButton.styleFrom(
              backgroundColor: Colors.red,
            ),
            child: const Text('Cancel Room Change'),
          ),
        ],
      ),
    );
  }

  Future<void> _completeRoomChange(BuildContext context, String notes) async {
    final roomChangeProvider =
        Provider.of<RoomChangeProvider>(context, listen: false);
    final guestProvider = Provider.of<GuestProvider>(context, listen: false);

    final success = await roomChangeProvider.completeRoomChange(
      roomChange.id,
      notes: notes.isNotEmpty ? notes : null,
    );

    if (context.mounted) {
      if (success) {
        // Refresh guest data to show updated room assignments
        await guestProvider.loadGuests();

        ScaffoldMessenger.of(context).showSnackBar(
          const SnackBar(
            content:
                Text('Room change completed successfully! Guest room updated.'),
            backgroundColor: Colors.green,
            duration: Duration(seconds: 3),
          ),
        );
        Navigator.of(context).pop(); // Go back to list
      } else {
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(
            content: Text(roomChangeProvider.errorMessage ??
                'Failed to complete room change'),
            backgroundColor: Colors.red,
          ),
        );
      }
    }
  }

  Future<void> _cancelRoomChange(BuildContext context, String notes) async {
    final provider = Provider.of<RoomChangeProvider>(context, listen: false);

    final success = await provider.cancelRoomChange(
      roomChange.id,
      notes: notes.isNotEmpty ? notes : null,
    );

    if (context.mounted) {
      if (success) {
        ScaffoldMessenger.of(context).showSnackBar(
          const SnackBar(
            content: Text('Room change cancelled'),
            backgroundColor: Colors.orange,
          ),
        );
        Navigator.of(context).pop(); // Go back to list
      } else {
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(
            content:
                Text(provider.errorMessage ?? 'Failed to cancel room change'),
            backgroundColor: Colors.red,
          ),
        );
      }
    }
  }
}
