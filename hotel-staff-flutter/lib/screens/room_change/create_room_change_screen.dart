import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import '../../models/room.dart';
import '../../models/room_change.dart';
import '../../providers/room_change_provider.dart';
import '../../providers/room_provider.dart';

class CreateRoomChangeScreen extends StatefulWidget {
  final Room? initialRoom;
  final int? bookingId;

  const CreateRoomChangeScreen({
    Key? key,
    this.initialRoom,
    this.bookingId,
  }) : super(key: key);

  @override
  State<CreateRoomChangeScreen> createState() =>
      _CreateRoomChangeScreenState();
}

class _CreateRoomChangeScreenState extends State<CreateRoomChangeScreen> {
  final _formKey = GlobalKey<FormState>();
  final _guestNameController = TextEditingController();
  final _changeReasonController = TextEditingController();
  final _changedByController = TextEditingController();
  final _notesController = TextEditingController();

  Room? _selectedOldRoom;
  Room? _selectedNewRoom;
  DateTime? _checkInDate;
  DateTime? _checkOutDate;

  bool _isLoadingRooms = false;
  bool _isSubmitting = false;

  @override
  void initState() {
    super.initState();
    if (widget.initialRoom != null) {
      _selectedOldRoom = widget.initialRoom;
      _guestNameController.text = widget.initialRoom!.guestName ?? '';
      if (widget.initialRoom!.checkInDate != null) {
        _checkInDate = DateTime.parse(widget.initialRoom!.checkInDate!);
      }
      if (widget.initialRoom!.checkOutDate != null) {
        _checkOutDate = DateTime.parse(widget.initialRoom!.checkOutDate!);
      }
    }
    _loadRooms();
  }

  @override
  void dispose() {
    _guestNameController.dispose();
    _changeReasonController.dispose();
    _changedByController.dispose();
    _notesController.dispose();
    super.dispose();
  }

  Future<void> _loadRooms() async {
    final roomProvider = context.read<RoomProvider>();
    await roomProvider.loadRooms();
  }

  Future<void> _loadAvailableRooms() async {
    if (_selectedOldRoom == null ||
        _checkInDate == null ||
        _checkOutDate == null) {
      return;
    }

    setState(() => _isLoadingRooms = true);

    final provider = context.read<RoomChangeProvider>();
    await provider.loadAvailableRoomsForChange(
      checkInDate: _checkInDate!.toIso8601String().split('T')[0],
      checkOutDate: _checkOutDate!.toIso8601String().split('T')[0],
      currentRoomId: _selectedOldRoom!.id,
    );

    setState(() => _isLoadingRooms = false);
  }

  Future<void> _selectDate(BuildContext context, bool isCheckIn) async {
    final DateTime? picked = await showDatePicker(
      context: context,
      initialDate: isCheckIn
          ? (_checkInDate ?? DateTime.now())
          : (_checkOutDate ?? DateTime.now().add(const Duration(days: 1))),
      firstDate: DateTime.now().subtract(const Duration(days: 365)),
      lastDate: DateTime.now().add(const Duration(days: 365)),
    );

    if (picked != null) {
      setState(() {
        if (isCheckIn) {
          _checkInDate = picked;
          // Ensure checkout is after checkin
          if (_checkOutDate != null && _checkOutDate!.isBefore(_checkInDate!)) {
            _checkOutDate = _checkInDate!.add(const Duration(days: 1));
          }
        } else {
          _checkOutDate = picked;
        }
      });
      // Reload available rooms when dates change
      _loadAvailableRooms();
    }
  }

  Future<void> _submitRoomChange() async {
    if (!_formKey.currentState!.validate()) {
      return;
    }

    if (_selectedOldRoom == null) {
      ScaffoldMessenger.of(context).showSnackBar(
        const SnackBar(
          content: Text('Please select the current room'),
          backgroundColor: Colors.red,
        ),
      );
      return;
    }

    if (_selectedNewRoom == null) {
      ScaffoldMessenger.of(context).showSnackBar(
        const SnackBar(
          content: Text('Please select a new room'),
          backgroundColor: Colors.red,
        ),
      );
      return;
    }

    if (_checkInDate == null || _checkOutDate == null) {
      ScaffoldMessenger.of(context).showSnackBar(
        const SnackBar(
          content: Text('Please select check-in and check-out dates'),
          backgroundColor: Colors.red,
        ),
      );
      return;
    }

    setState(() => _isSubmitting = true);

    final request = RoomChangeRequest(
      bookingId: widget.bookingId ?? _selectedOldRoom!.bookingId ?? 0,
      guestName: _guestNameController.text,
      oldRoomId: _selectedOldRoom!.id,
      oldRoomNum: _selectedOldRoom!.roomNum,
      newRoomId: _selectedNewRoom!.id,
      newRoomNum: _selectedNewRoom!.roomNum,
      changeReason: _changeReasonController.text,
      changedBy: _changedByController.text,
      checkInDate: _checkInDate!.toIso8601String().split('T')[0],
      checkOutDate: _checkOutDate!.toIso8601String().split('T')[0],
      notes: _notesController.text.isNotEmpty ? _notesController.text : null,
    );

    final provider = context.read<RoomChangeProvider>();
    final result = await provider.createRoomChange(request);

    setState(() => _isSubmitting = false);

    if (mounted) {
      ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(
          content: Text(result['message'] ?? 'Room change created'),
          backgroundColor:
              result['success'] == true ? Colors.green : Colors.red,
        ),
      );

      if (result['success'] == true) {
        Navigator.pop(context);
      }
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Create Room Change'),
        backgroundColor: Colors.blue,
      ),
      body: Form(
        key: _formKey,
        child: SingleChildScrollView(
          padding: const EdgeInsets.all(16),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              // Guest Information
              const Text(
                'Guest Information',
                style: TextStyle(
                  fontSize: 18,
                  fontWeight: FontWeight.bold,
                  color: Colors.blue,
                ),
              ),
              const SizedBox(height: 12),
              TextFormField(
                controller: _guestNameController,
                decoration: const InputDecoration(
                  labelText: 'Guest Name *',
                  border: OutlineInputBorder(),
                  prefixIcon: Icon(Icons.person),
                ),
                validator: (value) {
                  if (value == null || value.isEmpty) {
                    return 'Please enter guest name';
                  }
                  return null;
                },
              ),
              const SizedBox(height: 16),

              // Check-in/Check-out Dates
              Row(
                children: [
                  Expanded(
                    child: InkWell(
                      onTap: () => _selectDate(context, true),
                      child: InputDecorator(
                        decoration: const InputDecoration(
                          labelText: 'Check-in Date *',
                          border: OutlineInputBorder(),
                          prefixIcon: Icon(Icons.calendar_today),
                        ),
                        child: Text(
                          _checkInDate != null
                              ? '${_checkInDate!.year}-${_checkInDate!.month.toString().padLeft(2, '0')}-${_checkInDate!.day.toString().padLeft(2, '0')}'
                              : 'Select date',
                          style: TextStyle(
                            color: _checkInDate != null
                                ? Colors.black
                                : Colors.grey,
                          ),
                        ),
                      ),
                    ),
                  ),
                  const SizedBox(width: 12),
                  Expanded(
                    child: InkWell(
                      onTap: () => _selectDate(context, false),
                      child: InputDecorator(
                        decoration: const InputDecoration(
                          labelText: 'Check-out Date *',
                          border: OutlineInputBorder(),
                          prefixIcon: Icon(Icons.event),
                        ),
                        child: Text(
                          _checkOutDate != null
                              ? '${_checkOutDate!.year}-${_checkOutDate!.month.toString().padLeft(2, '0')}-${_checkOutDate!.day.toString().padLeft(2, '0')}'
                              : 'Select date',
                          style: TextStyle(
                            color: _checkOutDate != null
                                ? Colors.black
                                : Colors.grey,
                          ),
                        ),
                      ),
                    ),
                  ),
                ],
              ),

              const SizedBox(height: 24),

              // Current Room
              const Text(
                'Current Room',
                style: TextStyle(
                  fontSize: 18,
                  fontWeight: FontWeight.bold,
                  color: Colors.blue,
                ),
              ),
              const SizedBox(height: 12),
              Consumer<RoomProvider>(
                builder: (context, roomProvider, child) {
                  final occupiedRooms = roomProvider.rooms
                      .where((r) => r.isOccupiedStatus)
                      .toList();

                  return DropdownButtonFormField<Room>(
                    value: _selectedOldRoom,
                    decoration: const InputDecoration(
                      labelText: 'Select Current Room *',
                      border: OutlineInputBorder(),
                      prefixIcon: Icon(Icons.meeting_room),
                    ),
                    items: occupiedRooms.map((room) {
                      return DropdownMenuItem<Room>(
                        value: room,
                        child: Text(
                          '${room.roomNum} - ${room.guestName ?? "Guest"} (${room.roomTypeName})',
                        ),
                      );
                    }).toList(),
                    onChanged: (Room? value) {
                      setState(() {
                        _selectedOldRoom = value;
                        if (value != null) {
                          _guestNameController.text = value.guestName ?? '';
                          if (value.checkInDate != null) {
                            _checkInDate = DateTime.parse(value.checkInDate!);
                          }
                          if (value.checkOutDate != null) {
                            _checkOutDate = DateTime.parse(value.checkOutDate!);
                          }
                        }
                      });
                      _loadAvailableRooms();
                    },
                    validator: (value) {
                      if (value == null) {
                        return 'Please select current room';
                      }
                      return null;
                    },
                  );
                },
              ),

              const SizedBox(height: 24),

              // New Room
              const Text(
                'New Room',
                style: TextStyle(
                  fontSize: 18,
                  fontWeight: FontWeight.bold,
                  color: Colors.blue,
                ),
              ),
              const SizedBox(height: 12),
              Consumer<RoomChangeProvider>(
                builder: (context, provider, child) {
                  if (_isLoadingRooms) {
                    return const Center(child: CircularProgressIndicator());
                  }

                  if (!provider.hasAvailableRooms) {
                    return Container(
                      padding: const EdgeInsets.all(16),
                      decoration: BoxDecoration(
                        color: Colors.orange.withOpacity(0.1),
                        border: Border.all(color: Colors.orange),
                        borderRadius: BorderRadius.circular(8),
                      ),
                      child: Row(
                        children: [
                          const Icon(Icons.info, color: Colors.orange),
                          const SizedBox(width: 12),
                          Expanded(
                            child: Text(
                              _selectedOldRoom == null
                                  ? 'Select current room and dates first'
                                  : 'No available rooms for selected dates',
                              style: const TextStyle(color: Colors.orange),
                            ),
                          ),
                        ],
                      ),
                    );
                  }

                  return DropdownButtonFormField<Room>(
                    value: _selectedNewRoom,
                    decoration: const InputDecoration(
                      labelText: 'Select New Room *',
                      border: OutlineInputBorder(),
                      prefixIcon: Icon(Icons.meeting_room),
                    ),
                    items: provider.availableRooms.map((room) {
                      return DropdownMenuItem<Room>(
                        value: room,
                        child: Text(
                          '${room.roomNum} - ${room.roomTypeName} (Floor: ${room.floor ?? "N/A"})',
                        ),
                      );
                    }).toList(),
                    onChanged: (Room? value) {
                      setState(() => _selectedNewRoom = value);
                    },
                    validator: (value) {
                      if (value == null) {
                        return 'Please select new room';
                      }
                      return null;
                    },
                  );
                },
              ),

              const SizedBox(height: 24),

              // Change Information
              const Text(
                'Change Information',
                style: TextStyle(
                  fontSize: 18,
                  fontWeight: FontWeight.bold,
                  color: Colors.blue,
                ),
              ),
              const SizedBox(height: 12),
              TextFormField(
                controller: _changeReasonController,
                decoration: const InputDecoration(
                  labelText: 'Reason for Change *',
                  border: OutlineInputBorder(),
                  prefixIcon: Icon(Icons.event_note),
                ),
                maxLines: 3,
                validator: (value) {
                  if (value == null || value.isEmpty) {
                    return 'Please enter reason for room change';
                  }
                  return null;
                },
              ),
              const SizedBox(height: 16),
              TextFormField(
                controller: _changedByController,
                decoration: const InputDecoration(
                  labelText: 'Staff Name *',
                  border: OutlineInputBorder(),
                  prefixIcon: Icon(Icons.person_outline),
                ),
                validator: (value) {
                  if (value == null || value.isEmpty) {
                    return 'Please enter your name';
                  }
                  return null;
                },
              ),
              const SizedBox(height: 16),
              TextFormField(
                controller: _notesController,
                decoration: const InputDecoration(
                  labelText: 'Additional Notes (Optional)',
                  border: OutlineInputBorder(),
                  prefixIcon: Icon(Icons.notes),
                ),
                maxLines: 3,
              ),

              const SizedBox(height: 32),

              // Submit Button
              SizedBox(
                width: double.infinity,
                height: 50,
                child: ElevatedButton(
                  onPressed: _isSubmitting ? null : _submitRoomChange,
                  style: ElevatedButton.styleFrom(
                    backgroundColor: Colors.blue,
                  ),
                  child: _isSubmitting
                      ? const CircularProgressIndicator(color: Colors.white)
                      : const Text(
                          'Create Room Change',
                          style: TextStyle(fontSize: 16),
                        ),
                ),
              ),

              const SizedBox(height: 16),
            ],
          ),
        ),
      ),
    );
  }
}
