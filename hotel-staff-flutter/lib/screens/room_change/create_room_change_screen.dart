import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:intl/intl.dart';
import '../../providers/room_change_provider.dart';
import '../../providers/auth_provider.dart';
import '../../models/room_change.dart';

class CreateRoomChangeScreen extends StatefulWidget {
  const CreateRoomChangeScreen({super.key});

  @override
  State<CreateRoomChangeScreen> createState() => _CreateRoomChangeScreenState();
}

class _CreateRoomChangeScreenState extends State<CreateRoomChangeScreen> {
  final _formKey = GlobalKey<FormState>();

  OccupiedRoom? _selectedOccupiedRoom;
  AvailableRoom? _selectedNewRoom;

  final _reasonController = TextEditingController();
  final _notesController = TextEditingController();

  bool _markAsCompleted = false;
  bool _isSubmitting = false;

  @override
  void initState() {
    super.initState();
    WidgetsBinding.instance.addPostFrameCallback((_) {
      _loadOccupiedRooms();
    });
  }

  @override
  void dispose() {
    _reasonController.dispose();
    _notesController.dispose();
    super.dispose();
  }

  Future<void> _loadOccupiedRooms() async {
    final provider = Provider.of<RoomChangeProvider>(context, listen: false);
    await provider.loadOccupiedRooms();
  }

  Future<void> _loadAvailableRooms() async {
    if (_selectedOccupiedRoom == null) return;

    final provider = Provider.of<RoomChangeProvider>(context, listen: false);
    await provider.loadAvailableRooms(
      checkIn: _selectedOccupiedRoom!.dateFrom,
      checkOut: _selectedOccupiedRoom!.dateTo,
      hotelId: _selectedOccupiedRoom!.idHotel,
    );
  }

  @override
  Widget build(BuildContext context) {
    final dateFormat = DateFormat('MMM dd, yyyy');

    return Scaffold(
      appBar: AppBar(
        title: const Text('Create Room Change'),
      ),
      body: Consumer<RoomChangeProvider>(
        builder: (context, provider, child) {
          return Form(
            key: _formKey,
            child: ListView(
              padding: const EdgeInsets.all(16),
              children: [
                // Instructions
                Card(
                  color: Colors.blue[50],
                  child: const Padding(
                    padding: EdgeInsets.all(16),
                    child: Row(
                      children: [
                        Icon(Icons.info_outline, color: Colors.blue),
                        SizedBox(width: 12),
                        Expanded(
                          child: Text(
                            'Select the guest\'s current room and the new room to move them to.',
                            style: TextStyle(fontSize: 13),
                          ),
                        ),
                      ],
                    ),
                  ),
                ),
                const SizedBox(height: 24),

                // Step 1: Select Current Room
                const Text(
                  'Step 1: Select Current Room',
                  style: TextStyle(fontSize: 18, fontWeight: FontWeight.bold),
                ),
                const SizedBox(height: 12),

                if (provider.isLoadingOccupied)
                  const Center(child: CircularProgressIndicator())
                else if (provider.occupiedRooms.isEmpty)
                  Card(
                    child: Padding(
                      padding: const EdgeInsets.all(16),
                      child: Column(
                        children: [
                          const Text('No occupied rooms found'),
                          const SizedBox(height: 8),
                          TextButton.icon(
                            onPressed: _loadOccupiedRooms,
                            icon: const Icon(Icons.refresh),
                            label: const Text('Refresh'),
                          ),
                        ],
                      ),
                    ),
                  )
                else
                  DropdownButtonFormField<OccupiedRoom>(
                    value: _selectedOccupiedRoom,
                    decoration: const InputDecoration(
                      labelText: 'Current Room',
                      border: OutlineInputBorder(),
                      prefixIcon: Icon(Icons.meeting_room),
                    ),
                    items: provider.occupiedRooms.map((room) {
                      return DropdownMenuItem(
                        value: room,
                        child: Column(
                          crossAxisAlignment: CrossAxisAlignment.start,
                          mainAxisSize: MainAxisSize.min,
                          children: [
                            Text(
                              'Room ${room.roomNum} - ${room.guestName}',
                              style:
                                  const TextStyle(fontWeight: FontWeight.bold),
                            ),
                            Text(
                              '${dateFormat.format(room.dateFrom)} to ${dateFormat.format(room.dateTo)}',
                              style: TextStyle(
                                  fontSize: 12, color: Colors.grey[600]),
                            ),
                          ],
                        ),
                      );
                    }).toList(),
                    onChanged: (value) {
                      setState(() {
                        _selectedOccupiedRoom = value;
                        _selectedNewRoom = null; // Reset new room selection
                      });
                      if (value != null) {
                        _loadAvailableRooms();
                      }
                    },
                    validator: (value) {
                      if (value == null) {
                        return 'Please select the current room';
                      }
                      return null;
                    },
                  ),

                if (_selectedOccupiedRoom != null) ...[
                  const SizedBox(height: 8),
                  Card(
                    color: Colors.grey[100],
                    child: Padding(
                      padding: const EdgeInsets.all(12),
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          Text(
                            'Guest: ${_selectedOccupiedRoom!.guestName}',
                            style: const TextStyle(fontWeight: FontWeight.bold),
                          ),
                          const SizedBox(height: 4),
                          Text(
                            'Room Type: ${_selectedOccupiedRoom!.roomType ?? 'N/A'}',
                            style: const TextStyle(fontSize: 13),
                          ),
                          Text(
                            'Stay: ${dateFormat.format(_selectedOccupiedRoom!.dateFrom)} - ${dateFormat.format(_selectedOccupiedRoom!.dateTo)}',
                            style: const TextStyle(fontSize: 13),
                          ),
                        ],
                      ),
                    ),
                  ),
                ],

                const SizedBox(height: 24),

                // Step 2: Select New Room
                const Text(
                  'Step 2: Select New Room',
                  style: TextStyle(fontSize: 18, fontWeight: FontWeight.bold),
                ),
                const SizedBox(height: 12),

                if (_selectedOccupiedRoom == null)
                  Card(
                    child: Padding(
                      padding: const EdgeInsets.all(16),
                      child: Text(
                        'Please select a current room first',
                        style: TextStyle(color: Colors.grey[600]),
                      ),
                    ),
                  )
                else if (provider.isLoadingAvailable)
                  const Center(child: CircularProgressIndicator())
                else if (provider.availableRooms.isEmpty)
                  Card(
                    child: Padding(
                      padding: const EdgeInsets.all(16),
                      child: Column(
                        children: [
                          const Text(
                              'No available rooms found for this date range'),
                          const SizedBox(height: 8),
                          TextButton.icon(
                            onPressed: _loadAvailableRooms,
                            icon: const Icon(Icons.refresh),
                            label: const Text('Refresh'),
                          ),
                        ],
                      ),
                    ),
                  )
                else
                  DropdownButtonFormField<AvailableRoom>(
                    value: _selectedNewRoom,
                    decoration: const InputDecoration(
                      labelText: 'New Room',
                      border: OutlineInputBorder(),
                      prefixIcon: Icon(Icons.meeting_room),
                    ),
                    items: provider.availableRooms.map((room) {
                      return DropdownMenuItem(
                        value: room,
                        child: Column(
                          crossAxisAlignment: CrossAxisAlignment.start,
                          mainAxisSize: MainAxisSize.min,
                          children: [
                            Text(
                              'Room ${room.roomNum}',
                              style:
                                  const TextStyle(fontWeight: FontWeight.bold),
                            ),
                            Text(
                              room.roomType ?? 'Standard Room',
                              style: TextStyle(
                                  fontSize: 12, color: Colors.grey[600]),
                            ),
                          ],
                        ),
                      );
                    }).toList(),
                    onChanged: (value) {
                      setState(() {
                        _selectedNewRoom = value;
                      });
                    },
                    validator: (value) {
                      if (value == null) {
                        return 'Please select the new room';
                      }
                      return null;
                    },
                  ),

                const SizedBox(height: 24),

                // Step 3: Reason for Change
                const Text(
                  'Step 3: Reason for Change',
                  style: TextStyle(fontSize: 18, fontWeight: FontWeight.bold),
                ),
                const SizedBox(height: 12),

                TextFormField(
                  controller: _reasonController,
                  decoration: const InputDecoration(
                    labelText: 'Reason for Room Change *',
                    hintText:
                        'e.g., Air conditioning malfunction, Guest request, etc.',
                    border: OutlineInputBorder(),
                    prefixIcon: Icon(Icons.description),
                  ),
                  maxLines: 3,
                  validator: (value) {
                    if (value == null || value.trim().isEmpty) {
                      return 'Please provide a reason for the room change';
                    }
                    return null;
                  },
                ),
                const SizedBox(height: 16),

                // Additional Notes
                TextFormField(
                  controller: _notesController,
                  decoration: const InputDecoration(
                    labelText: 'Additional Notes (Optional)',
                    hintText: 'Any additional information...',
                    border: OutlineInputBorder(),
                    prefixIcon: Icon(Icons.note),
                  ),
                  maxLines: 2,
                ),
                const SizedBox(height: 16),

                // Mark as Completed Checkbox
                CheckboxListTile(
                  title: const Text('Mark as Completed'),
                  subtitle: const Text(
                    'Check this if the guest has already moved to the new room',
                    style: TextStyle(fontSize: 12),
                  ),
                  value: _markAsCompleted,
                  onChanged: (value) {
                    setState(() {
                      _markAsCompleted = value ?? false;
                    });
                  },
                ),
                const SizedBox(height: 24),

                // Submit Button
                ElevatedButton(
                  onPressed: _isSubmitting ? null : _submitRoomChange,
                  style: ElevatedButton.styleFrom(
                    padding: const EdgeInsets.all(16),
                  ),
                  child: _isSubmitting
                      ? const SizedBox(
                          height: 20,
                          width: 20,
                          child: CircularProgressIndicator(strokeWidth: 2),
                        )
                      : const Text(
                          'Create Room Change',
                          style: TextStyle(fontSize: 16),
                        ),
                ),
              ],
            ),
          );
        },
      ),
    );
  }

  Future<void> _submitRoomChange() async {
    if (!_formKey.currentState!.validate()) {
      return;
    }

    if (_selectedOccupiedRoom == null || _selectedNewRoom == null) {
      ScaffoldMessenger.of(context).showSnackBar(
        const SnackBar(
          content: Text('Please select both current and new rooms'),
          backgroundColor: Colors.red,
        ),
      );
      return;
    }

    setState(() {
      _isSubmitting = true;
    });

    final provider = Provider.of<RoomChangeProvider>(context, listen: false);
    final authProvider = Provider.of<AuthProvider>(context, listen: false);

    // Get staff name from auth provider or use default
    final staffName = authProvider.userName ?? 'Staff Member';

    final request = RoomChangeRequest(
      bookingId: _selectedOccupiedRoom!.bookingId,
      oldRoomId: _selectedOccupiedRoom!.idRoom,
      newRoomId: _selectedNewRoom!.id,
      guestName: _selectedOccupiedRoom!.guestName,
      changeReason: _reasonController.text.trim(),
      changedBy: staffName,
      status: _markAsCompleted ? 'completed' : 'pending',
      notes: _notesController.text.trim().isNotEmpty
          ? _notesController.text.trim()
          : null,
    );

    final success = await provider.createRoomChange(request);

    setState(() {
      _isSubmitting = false;
    });

    if (mounted) {
      if (success) {
        ScaffoldMessenger.of(context).showSnackBar(
          const SnackBar(
            content: Text('Room change created successfully'),
            backgroundColor: Colors.green,
          ),
        );
        Navigator.of(context).pop(); // Go back to list
      } else {
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(
            content:
                Text(provider.errorMessage ?? 'Failed to create room change'),
            backgroundColor: Colors.red,
          ),
        );
      }
    }
  }
}
