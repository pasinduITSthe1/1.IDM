import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import '../../models/room_change.dart';
import '../../providers/room_change_provider.dart';

class RoomChangeDetailsScreen extends StatefulWidget {
  final RoomChange roomChange;

  const RoomChangeDetailsScreen({
    Key? key,
    required this.roomChange,
  }) : super(key: key);

  @override
  State<RoomChangeDetailsScreen> createState() =>
      _RoomChangeDetailsScreenState();
}

class _RoomChangeDetailsScreenState extends State<RoomChangeDetailsScreen> {
  final _notesController = TextEditingController();
  bool _isProcessing = false;

  @override
  void dispose() {
    _notesController.dispose();
    super.dispose();
  }

  Color _getStatusColor(String status) {
    switch (status) {
      case 'pending':
        return Colors.orange;
      case 'completed':
        return Colors.green;
      case 'cancelled':
        return Colors.red;
      default:
        return Colors.grey;
    }
  }

  Future<void> _updateStatus(String status, String action) async {
    final confirmed = await showDialog<bool>(
      context: context,
      builder: (context) => AlertDialog(
        title: Text('$action Room Change'),
        content: Column(
          mainAxisSize: MainAxisSize.min,
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Text('Are you sure you want to $action this room change?'),
            const SizedBox(height: 16),
            TextField(
              controller: _notesController,
              decoration: const InputDecoration(
                labelText: 'Notes (optional)',
                border: OutlineInputBorder(),
              ),
              maxLines: 3,
            ),
          ],
        ),
        actions: [
          TextButton(
            onPressed: () => Navigator.pop(context, false),
            child: const Text('Cancel'),
          ),
          ElevatedButton(
            onPressed: () => Navigator.pop(context, true),
            child: Text(action),
          ),
        ],
      ),
    );

    if (confirmed == true) {
      setState(() => _isProcessing = true);

      final provider = context.read<RoomChangeProvider>();
      final result = await provider.updateRoomChangeStatus(
        id: widget.roomChange.id,
        status: status,
        notes: _notesController.text.isNotEmpty ? _notesController.text : null,
      );

      setState(() => _isProcessing = false);

      if (mounted) {
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(
            content: Text(result['message'] ?? 'Status updated'),
            backgroundColor:
                result['success'] == true ? Colors.green : Colors.red,
          ),
        );

        if (result['success'] == true) {
          Navigator.pop(context);
        }
      }
    }
  }

  @override
  Widget build(BuildContext context) {
    final statusColor = _getStatusColor(widget.roomChange.status);

    return Scaffold(
      appBar: AppBar(
        title: const Text('Room Change Details'),
        backgroundColor: Colors.blue,
      ),
      body: SingleChildScrollView(
        padding: const EdgeInsets.all(16),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            // Status Card
            Card(
              elevation: 4,
              color: statusColor.withOpacity(0.1),
              child: Padding(
                padding: const EdgeInsets.all(16),
                child: Row(
                  children: [
                    Icon(
                      widget.roomChange.isPending
                          ? Icons.pending_actions
                          : widget.roomChange.isCompleted
                              ? Icons.check_circle
                              : Icons.cancel,
                      size: 48,
                      color: statusColor,
                    ),
                    const SizedBox(width: 16),
                    Expanded(
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          Text(
                            'Status',
                            style: TextStyle(
                              fontSize: 12,
                              color: Colors.grey[700],
                            ),
                          ),
                          Text(
                            widget.roomChange.statusDisplayName,
                            style: TextStyle(
                              fontSize: 24,
                              fontWeight: FontWeight.bold,
                              color: statusColor,
                            ),
                          ),
                        ],
                      ),
                    ),
                  ],
                ),
              ),
            ),

            const SizedBox(height: 24),

            // Guest Information
            _SectionTitle(title: 'Guest Information'),
            _InfoCard(
              children: [
                _InfoRow(
                  icon: Icons.person,
                  label: 'Guest Name',
                  value: widget.roomChange.guestName,
                ),
                _InfoRow(
                  icon: Icons.bookmark,
                  label: 'Booking ID',
                  value: '#${widget.roomChange.bookingId}',
                ),
                _InfoRow(
                  icon: Icons.calendar_today,
                  label: 'Check-in',
                  value: widget.roomChange.checkInDate,
                ),
                _InfoRow(
                  icon: Icons.event,
                  label: 'Check-out',
                  value: widget.roomChange.checkOutDate,
                ),
              ],
            ),

            const SizedBox(height: 24),

            // Room Change Details
            _SectionTitle(title: 'Room Change Details'),
            _InfoCard(
              children: [
                // Old Room
                Container(
                  padding: const EdgeInsets.all(12),
                  decoration: BoxDecoration(
                    color: Colors.red.withOpacity(0.05),
                    borderRadius: BorderRadius.circular(8),
                    border: Border.all(color: Colors.red.withOpacity(0.3)),
                  ),
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      Row(
                        children: [
                          Icon(Icons.meeting_room, color: Colors.red, size: 20),
                          const SizedBox(width: 8),
                          Text(
                            'FROM (Old Room)',
                            style: TextStyle(
                              fontWeight: FontWeight.bold,
                              color: Colors.red,
                            ),
                          ),
                        ],
                      ),
                      const Divider(height: 16),
                      _InfoRow(
                        label: 'Room Number',
                        value: widget.roomChange.oldRoomNum,
                      ),
                      if (widget.roomChange.oldRoomType != null)
                        _InfoRow(
                          label: 'Room Type',
                          value: widget.roomChange.oldRoomType!,
                        ),
                      if (widget.roomChange.oldRoomFloor != null)
                        _InfoRow(
                          label: 'Floor',
                          value: widget.roomChange.oldRoomFloor!,
                        ),
                      if (widget.roomChange.oldHotelName != null)
                        _InfoRow(
                          label: 'Hotel',
                          value: widget.roomChange.oldHotelName!,
                        ),
                    ],
                  ),
                ),

                const SizedBox(height: 16),

                // Arrow
                Center(
                  child: Icon(
                    Icons.arrow_downward,
                    size: 32,
                    color: Colors.blue,
                  ),
                ),

                const SizedBox(height: 16),

                // New Room
                Container(
                  padding: const EdgeInsets.all(12),
                  decoration: BoxDecoration(
                    color: Colors.green.withOpacity(0.05),
                    borderRadius: BorderRadius.circular(8),
                    border: Border.all(color: Colors.green.withOpacity(0.3)),
                  ),
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      Row(
                        children: [
                          Icon(Icons.meeting_room,
                              color: Colors.green, size: 20),
                          const SizedBox(width: 8),
                          Text(
                            'TO (New Room)',
                            style: TextStyle(
                              fontWeight: FontWeight.bold,
                              color: Colors.green,
                            ),
                          ),
                        ],
                      ),
                      const Divider(height: 16),
                      _InfoRow(
                        label: 'Room Number',
                        value: widget.roomChange.newRoomNum,
                      ),
                      if (widget.roomChange.newRoomType != null)
                        _InfoRow(
                          label: 'Room Type',
                          value: widget.roomChange.newRoomType!,
                        ),
                      if (widget.roomChange.newRoomFloor != null)
                        _InfoRow(
                          label: 'Floor',
                          value: widget.roomChange.newRoomFloor!,
                        ),
                      if (widget.roomChange.newHotelName != null)
                        _InfoRow(
                          label: 'Hotel',
                          value: widget.roomChange.newHotelName!,
                        ),
                    ],
                  ),
                ),
              ],
            ),

            const SizedBox(height: 24),

            // Change Information
            _SectionTitle(title: 'Change Information'),
            _InfoCard(
              children: [
                _InfoRow(
                  icon: Icons.event_note,
                  label: 'Reason',
                  value: widget.roomChange.changeReason,
                ),
                _InfoRow(
                  icon: Icons.person_outline,
                  label: 'Changed By',
                  value: widget.roomChange.changedBy,
                ),
                _InfoRow(
                  icon: Icons.access_time,
                  label: 'Change Date',
                  value: widget.roomChange.changeDate,
                ),
                if (widget.roomChange.notes != null &&
                    widget.roomChange.notes!.isNotEmpty)
                  _InfoRow(
                    icon: Icons.notes,
                    label: 'Notes',
                    value: widget.roomChange.notes!,
                  ),
              ],
            ),

            const SizedBox(height: 24),

            // Action Buttons
            if (widget.roomChange.isPending) ...[
              _SectionTitle(title: 'Actions'),
              const SizedBox(height: 8),
              Row(
                children: [
                  Expanded(
                    child: ElevatedButton.icon(
                      onPressed: _isProcessing
                          ? null
                          : () => _updateStatus('completed', 'Complete'),
                      icon: const Icon(Icons.check_circle),
                      label: const Text('Complete'),
                      style: ElevatedButton.styleFrom(
                        backgroundColor: Colors.green,
                        padding: const EdgeInsets.symmetric(vertical: 16),
                      ),
                    ),
                  ),
                  const SizedBox(width: 12),
                  Expanded(
                    child: ElevatedButton.icon(
                      onPressed: _isProcessing
                          ? null
                          : () => _updateStatus('cancelled', 'Cancel'),
                      icon: const Icon(Icons.cancel),
                      label: const Text('Cancel'),
                      style: ElevatedButton.styleFrom(
                        backgroundColor: Colors.red,
                        padding: const EdgeInsets.symmetric(vertical: 16),
                      ),
                    ),
                  ),
                ],
              ),
            ],

            const SizedBox(height: 24),
          ],
        ),
      ),
    );
  }
}

class _SectionTitle extends StatelessWidget {
  final String title;

  const _SectionTitle({required this.title});

  @override
  Widget build(BuildContext context) {
    return Padding(
      padding: const EdgeInsets.only(bottom: 8),
      child: Text(
        title,
        style: const TextStyle(
          fontSize: 18,
          fontWeight: FontWeight.bold,
          color: Colors.blue,
        ),
      ),
    );
  }
}

class _InfoCard extends StatelessWidget {
  final List<Widget> children;

  const _InfoCard({required this.children});

  @override
  Widget build(BuildContext context) {
    return Card(
      elevation: 2,
      child: Padding(
        padding: const EdgeInsets.all(16),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: children,
        ),
      ),
    );
  }
}

class _InfoRow extends StatelessWidget {
  final IconData? icon;
  final String label;
  final String value;

  const _InfoRow({
    this.icon,
    required this.label,
    required this.value,
  });

  @override
  Widget build(BuildContext context) {
    return Padding(
      padding: const EdgeInsets.symmetric(vertical: 6),
      child: Row(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          if (icon != null) ...[
            Icon(icon, size: 20, color: Colors.grey[600]),
            const SizedBox(width: 12),
          ],
          Expanded(
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text(
                  label,
                  style: TextStyle(
                    fontSize: 12,
                    color: Colors.grey[600],
                    fontWeight: FontWeight.w500,
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
}
