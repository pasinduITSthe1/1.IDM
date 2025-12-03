import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:intl/intl.dart';
import '../../providers/room_change_provider.dart';
import '../../providers/auth_provider.dart';
import '../../providers/guest_provider.dart';
import '../../models/room_change.dart';

class CreateRoomChangeScreen extends StatefulWidget {
  const CreateRoomChangeScreen({super.key});

  @override
  State<CreateRoomChangeScreen> createState() => _CreateRoomChangeScreenState();
}

class _CreateRoomChangeScreenState extends State<CreateRoomChangeScreen> {
  final _formKey = GlobalKey<FormState>();
  final _scaffoldMessengerKey = GlobalKey<ScaffoldMessengerState>();

  OccupiedRoom? _selectedOccupiedRoom;
  AvailableRoom? _selectedNewRoom;

  final _reasonController = TextEditingController();
  final _notesController = TextEditingController();
  final _searchController = TextEditingController();

  bool _markAsCompleted = false;
  bool _isSubmitting = false;
  String _searchQuery = '';

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
    _searchController.dispose();
    super.dispose();
  }

  void _showMessage(String message, {bool isError = false}) {
    _scaffoldMessengerKey.currentState?.clearSnackBars();
    _scaffoldMessengerKey.currentState?.showSnackBar(
      SnackBar(
        content: Row(
          children: [
            Container(
              padding: const EdgeInsets.all(8),
              decoration: BoxDecoration(
                color: Colors.white.withOpacity(0.2),
                borderRadius: BorderRadius.circular(8),
              ),
              child: Icon(
                isError ? Icons.error_rounded : Icons.check_circle_rounded,
                color: Colors.white,
                size: 20,
              ),
            ),
            const SizedBox(width: 12),
            Expanded(
              child: Column(
                mainAxisSize: MainAxisSize.min,
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Text(
                    isError ? 'Error' : 'Success',
                    style: const TextStyle(
                      fontWeight: FontWeight.bold,
                      fontSize: 14,
                      color: Colors.white,
                    ),
                  ),
                  Text(
                    message,
                    style: const TextStyle(fontSize: 13, color: Colors.white),
                  ),
                ],
              ),
            ),
          ],
        ),
        backgroundColor:
            isError ? const Color(0xFFEF4444) : const Color(0xFF10B981),
        behavior: SnackBarBehavior.floating,
        shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(10)),
        margin: const EdgeInsets.all(16),
        duration: const Duration(seconds: 3),
      ),
    );
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
    final isDark = Theme.of(context).brightness == Brightness.dark;
    final dateFormat = DateFormat('MMM dd, yyyy');

    return ScaffoldMessenger(
      key: _scaffoldMessengerKey,
      child: Scaffold(
        backgroundColor: isDark ? const Color(0xFF121212) : Colors.grey.shade50,
        body: Consumer<RoomChangeProvider>(
          builder: (context, provider, child) {
            return Container(
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
                          const Color(0xFFFF6B35),
                          const Color(0xFFFF8C42),
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
                            onPressed: () => Navigator.of(context).pop(),
                            padding: EdgeInsets.zero,
                            constraints: const BoxConstraints(),
                          ),
                          const SizedBox(width: 12),
                          const Text(
                            'Create Room Change',
                            style: TextStyle(
                              fontSize: 20,
                              fontWeight: FontWeight.bold,
                              color: Colors.white,
                            ),
                          ),
                        ],
                      ),
                    ),

                    // Info Card
                    Padding(
                      padding: const EdgeInsets.symmetric(horizontal: 16.0),
                      child: Container(
                        padding: const EdgeInsets.all(14),
                        decoration: BoxDecoration(
                          color: Colors.white.withOpacity(0.2),
                          borderRadius: BorderRadius.circular(12),
                          border: Border.all(
                            color: Colors.white.withOpacity(0.3),
                            width: 1,
                          ),
                        ),
                        child: const Row(
                          children: [
                            Icon(Icons.info_outline,
                                color: Colors.white, size: 20),
                            SizedBox(width: 10),
                            Expanded(
                              child: Text(
                                'Select guest\'s current room and new room to move them to.',
                                style: TextStyle(
                                  fontSize: 13,
                                  color: Colors.white,
                                  fontWeight: FontWeight.w500,
                                ),
                              ),
                            ),
                          ],
                        ),
                      ),
                    ),
                    const SizedBox(height: 16),

                    // White Content Card
                    Expanded(
                      child: Container(
                        decoration: BoxDecoration(
                          color:
                              isDark ? const Color(0xFF1E1E1E) : Colors.white,
                          borderRadius: const BorderRadius.only(
                            topLeft: Radius.circular(24),
                            topRight: Radius.circular(24),
                          ),
                        ),
                        child: Form(
                          key: _formKey,
                          child: ListView(
                            padding: const EdgeInsets.symmetric(
                                horizontal: 16, vertical: 20),
                            children: [
                              // Search Bar
                              Container(
                                decoration: BoxDecoration(
                                  color: isDark
                                      ? const Color(0xFF2C2C2C)
                                      : Colors.grey[100],
                                  borderRadius: BorderRadius.circular(12),
                                  border: Border.all(
                                    color: isDark
                                        ? Colors.grey[700]!
                                        : Colors.grey[300]!,
                                  ),
                                ),
                                child: TextField(
                                  controller: _searchController,
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
                                    hintText: 'Search by guest name...',
                                    hintStyle: TextStyle(
                                      color: isDark
                                          ? Colors.grey[500]
                                          : Colors.grey[400],
                                      fontSize: 14,
                                    ),
                                    prefixIcon: Icon(
                                      Icons.search,
                                      color: isDark
                                          ? Colors.grey[400]
                                          : Colors.grey[600],
                                      size: 20,
                                    ),
                                    suffixIcon: _searchQuery.isNotEmpty
                                        ? IconButton(
                                            icon: Icon(
                                              Icons.clear,
                                              color: isDark
                                                  ? Colors.grey[400]
                                                  : Colors.grey[600],
                                              size: 20,
                                            ),
                                            onPressed: () {
                                              _searchController.clear();
                                              setState(() {
                                                _searchQuery = '';
                                              });
                                            },
                                          )
                                        : null,
                                    border: OutlineInputBorder(
                                      borderRadius: BorderRadius.circular(12),
                                      borderSide: BorderSide.none,
                                    ),
                                    contentPadding: const EdgeInsets.symmetric(
                                      horizontal: 16,
                                      vertical: 12,
                                    ),
                                  ),
                                ),
                              ),
                              const SizedBox(height: 20),

                              // Step 1: Select Current Room
                              _buildSectionHeader('Step 1: Select Current Room',
                                  Icons.room_preferences),
                              const SizedBox(height: 12),

                              if (provider.isLoadingOccupied)
                                _buildLoadingCard()
                              else if (provider.occupiedRooms.isEmpty)
                                _buildEmptyCard(
                                  'No occupied rooms found',
                                  'There are no guests currently checked in',
                                  Icons.hotel_outlined,
                                  _loadOccupiedRooms,
                                )
                              else
                                Builder(
                                  builder: (context) {
                                    // Filter rooms by search query
                                    final filteredRooms =
                                        provider.occupiedRooms.where((room) {
                                      if (_searchQuery.isEmpty) return true;
                                      return room.guestName
                                          .toLowerCase()
                                          .contains(_searchQuery.toLowerCase());
                                    }).toList();

                                    if (filteredRooms.isEmpty) {
                                      return _buildEmptyCard(
                                        'No matching guests',
                                        'No guests found matching "$_searchQuery"',
                                        Icons.person_search,
                                        () {
                                          _searchController.clear();
                                          setState(() {
                                            _searchQuery = '';
                                          });
                                        },
                                      );
                                    }

                                    return Container(
                                      decoration: BoxDecoration(
                                        color: isDark
                                            ? const Color(0xFF2C2C2C)
                                            : Colors.grey[50],
                                        borderRadius: BorderRadius.circular(12),
                                        border: Border.all(
                                          color: isDark
                                              ? Colors.grey[700]!
                                              : Colors.grey[300]!,
                                        ),
                                      ),
                                      child:
                                          DropdownButtonFormField<OccupiedRoom>(
                                        value: _selectedOccupiedRoom,
                                        decoration: InputDecoration(
                                          labelText: 'Current Room',
                                          labelStyle: TextStyle(
                                            color: isDark
                                                ? Colors.grey[400]
                                                : Colors.grey[700],
                                            fontSize: 14,
                                          ),
                                          border: OutlineInputBorder(
                                            borderRadius:
                                                BorderRadius.circular(12),
                                            borderSide: BorderSide.none,
                                          ),
                                          enabledBorder: OutlineInputBorder(
                                            borderRadius:
                                                BorderRadius.circular(12),
                                            borderSide: BorderSide.none,
                                          ),
                                          focusedBorder: OutlineInputBorder(
                                            borderRadius:
                                                BorderRadius.circular(12),
                                            borderSide: BorderSide(
                                              color: const Color(0xFFFF6B35),
                                              width: 2,
                                            ),
                                          ),
                                          prefixIcon: const Icon(
                                              Icons.meeting_room,
                                              color: Color(0xFFFF6B35),
                                              size: 20),
                                          filled: true,
                                          fillColor: isDark
                                              ? const Color(0xFF2C2C2C)
                                              : Colors.grey[50],
                                          contentPadding:
                                              const EdgeInsets.symmetric(
                                            horizontal: 16,
                                            vertical: 14,
                                          ),
                                        ),
                                        dropdownColor: isDark
                                            ? const Color(0xFF2C2C2C)
                                            : Colors.white,
                                        isDense: true,
                                        isExpanded: true,
                                        items: filteredRooms.map((room) {
                                          return DropdownMenuItem(
                                            value: room,
                                            child: Text(
                                              'Room ${room.roomNum} - ${room.guestName}',
                                              style: const TextStyle(
                                                fontWeight: FontWeight.w600,
                                                fontSize: 14,
                                              ),
                                              maxLines: 1,
                                              overflow: TextOverflow.ellipsis,
                                            ),
                                          );
                                        }).toList(),
                                        onChanged: (value) {
                                          setState(() {
                                            _selectedOccupiedRoom = value;
                                            _selectedNewRoom = null;
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
                                    );
                                  },
                                ),

                              if (_selectedOccupiedRoom != null) ...[
                                const SizedBox(height: 12),
                                Container(
                                  padding: const EdgeInsets.all(16),
                                  decoration: BoxDecoration(
                                    color: isDark
                                        ? const Color(0xFF2C2C2C)
                                        : Colors.blue[50],
                                    borderRadius: BorderRadius.circular(12),
                                    border: Border.all(
                                      color: isDark
                                          ? Colors.blue.withOpacity(0.3)
                                          : Colors.blue[200]!,
                                    ),
                                  ),
                                  child: Column(
                                    crossAxisAlignment:
                                        CrossAxisAlignment.start,
                                    children: [
                                      Row(
                                        children: [
                                          Icon(
                                            Icons.person,
                                            size: 20,
                                            color: isDark
                                                ? Colors.blue[300]
                                                : Colors.blue[700],
                                          ),
                                          const SizedBox(width: 8),
                                          Expanded(
                                            child: Text(
                                              _selectedOccupiedRoom!.guestName,
                                              style: TextStyle(
                                                fontWeight: FontWeight.bold,
                                                fontSize: 15,
                                                color: isDark
                                                    ? Colors.white
                                                    : Colors.blue[900],
                                              ),
                                              overflow: TextOverflow.ellipsis,
                                            ),
                                          ),
                                        ],
                                      ),
                                      const SizedBox(height: 8),
                                      Row(
                                        children: [
                                          Icon(
                                            Icons.category,
                                            size: 18,
                                            color: isDark
                                                ? Colors.grey[400]
                                                : Colors.grey[600],
                                          ),
                                          const SizedBox(width: 8),
                                          Expanded(
                                            child: Text(
                                              'Room Type: ${_selectedOccupiedRoom!.roomType ?? 'N/A'}',
                                              style: TextStyle(
                                                fontSize: 13,
                                                color: isDark
                                                    ? Colors.grey[400]
                                                    : Colors.grey[700],
                                              ),
                                              overflow: TextOverflow.ellipsis,
                                            ),
                                          ),
                                        ],
                                      ),
                                      const SizedBox(height: 4),
                                      Row(
                                        children: [
                                          Icon(
                                            Icons.calendar_today,
                                            size: 18,
                                            color: isDark
                                                ? Colors.grey[400]
                                                : Colors.grey[600],
                                          ),
                                          const SizedBox(width: 8),
                                          Flexible(
                                            child: Text(
                                              'Stay: ${dateFormat.format(_selectedOccupiedRoom!.dateFrom)} - ${dateFormat.format(_selectedOccupiedRoom!.dateTo)}',
                                              style: TextStyle(
                                                fontSize: 13,
                                                color: isDark
                                                    ? Colors.grey[400]
                                                    : Colors.grey[700],
                                              ),
                                              overflow: TextOverflow.ellipsis,
                                              maxLines: 2,
                                            ),
                                          ),
                                        ],
                                      ),
                                    ],
                                  ),
                                ),
                              ],

                              const SizedBox(height: 24),

                              // Step 2: Select New Room
                              _buildSectionHeader(
                                  'Step 2: Select New Room', Icons.hotel),
                              const SizedBox(height: 12),

                              if (_selectedOccupiedRoom == null)
                                _buildInfoCard(
                                  'Please select a current room first',
                                  Icons.arrow_upward,
                                  isDark,
                                )
                              else if (provider.isLoadingAvailable)
                                _buildLoadingCard()
                              else if (provider.availableRooms.isEmpty)
                                _buildEmptyCard(
                                  'No available rooms',
                                  'No rooms available for the selected dates',
                                  Icons.bed_outlined,
                                  _loadAvailableRooms,
                                )
                              else
                                Container(
                                  decoration: BoxDecoration(
                                    color: isDark
                                        ? const Color(0xFF1E1E1E)
                                        : Colors.white,
                                    borderRadius: BorderRadius.circular(12),
                                    boxShadow: [
                                      BoxShadow(
                                        color: Colors.black.withOpacity(0.05),
                                        blurRadius: 10,
                                        offset: const Offset(0, 2),
                                      ),
                                    ],
                                  ),
                                  child: DropdownButtonFormField<AvailableRoom>(
                                    value: _selectedNewRoom,
                                    decoration: InputDecoration(
                                      labelText: 'New Room',
                                      labelStyle: TextStyle(
                                        color: isDark
                                            ? Colors.grey[400]
                                            : Colors.grey[700],
                                      ),
                                      border: OutlineInputBorder(
                                        borderRadius: BorderRadius.circular(12),
                                        borderSide: BorderSide(
                                            color: Colors.grey[300]!),
                                      ),
                                      enabledBorder: OutlineInputBorder(
                                        borderRadius: BorderRadius.circular(12),
                                        borderSide: BorderSide(
                                            color: Colors.grey[300]!),
                                      ),
                                      focusedBorder: OutlineInputBorder(
                                        borderRadius: BorderRadius.circular(12),
                                        borderSide: const BorderSide(
                                            color: Colors.green, width: 2),
                                      ),
                                      prefixIcon: const Icon(Icons.hotel,
                                          color: Colors.green),
                                      filled: true,
                                      fillColor: isDark
                                          ? const Color(0xFF2C2C2C)
                                          : Colors.grey[50],
                                    ),
                                    dropdownColor: isDark
                                        ? const Color(0xFF2C2C2C)
                                        : Colors.white,
                                    isDense: true,
                                    isExpanded: true,
                                    items: provider.availableRooms.map((room) {
                                      return DropdownMenuItem(
                                        value: room,
                                        child: Text(
                                          'Room ${room.roomNum}',
                                          style: TextStyle(
                                            fontWeight: FontWeight.bold,
                                            fontSize: 14,
                                            color: isDark
                                                ? Colors.white
                                                : Colors.black87,
                                          ),
                                          maxLines: 1,
                                          overflow: TextOverflow.ellipsis,
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
                                ),

                              if (_selectedNewRoom != null) ...[
                                const SizedBox(height: 12),
                                Container(
                                  padding: const EdgeInsets.all(16),
                                  decoration: BoxDecoration(
                                    color: isDark
                                        ? const Color(0xFF2C2C2C)
                                        : Colors.green[50],
                                    borderRadius: BorderRadius.circular(12),
                                    border: Border.all(
                                      color: isDark
                                          ? Colors.green.withOpacity(0.3)
                                          : Colors.green[200]!,
                                    ),
                                  ),
                                  child: Column(
                                    crossAxisAlignment:
                                        CrossAxisAlignment.start,
                                    children: [
                                      Row(
                                        children: [
                                          Icon(
                                            Icons.check_circle,
                                            size: 20,
                                            color: isDark
                                                ? Colors.green[300]
                                                : Colors.green[700],
                                          ),
                                          const SizedBox(width: 8),
                                          Expanded(
                                            child: Text(
                                              'Selected Room: ${_selectedNewRoom!.roomNum}',
                                              style: TextStyle(
                                                fontWeight: FontWeight.bold,
                                                fontSize: 15,
                                                color: isDark
                                                    ? Colors.white
                                                    : Colors.green[900],
                                              ),
                                              overflow: TextOverflow.ellipsis,
                                            ),
                                          ),
                                        ],
                                      ),
                                      const SizedBox(height: 8),
                                      Row(
                                        children: [
                                          Icon(
                                            Icons.category,
                                            size: 18,
                                            color: isDark
                                                ? Colors.grey[400]
                                                : Colors.grey[600],
                                          ),
                                          const SizedBox(width: 8),
                                          Expanded(
                                            child: Text(
                                              'Type: ${_selectedNewRoom!.roomType ?? 'N/A'}',
                                              style: TextStyle(
                                                fontSize: 13,
                                                color: isDark
                                                    ? Colors.grey[400]
                                                    : Colors.grey[700],
                                              ),
                                              overflow: TextOverflow.ellipsis,
                                            ),
                                          ),
                                        ],
                                      ),
                                    ],
                                  ),
                                ),
                              ],

                              const SizedBox(height: 24),

                              // Step 3: Reason for Change
                              _buildSectionHeader(
                                  'Step 3: Provide Reason for Change',
                                  Icons.edit_note),
                              const SizedBox(height: 12),

                              Container(
                                decoration: BoxDecoration(
                                  color: isDark
                                      ? const Color(0xFF1E1E1E)
                                      : Colors.white,
                                  borderRadius: BorderRadius.circular(12),
                                  boxShadow: [
                                    BoxShadow(
                                      color: Colors.black.withOpacity(0.05),
                                      blurRadius: 10,
                                      offset: const Offset(0, 2),
                                    ),
                                  ],
                                ),
                                child: TextFormField(
                                  controller: _reasonController,
                                  decoration: InputDecoration(
                                    labelText: 'Reason for Room Change',
                                    labelStyle: TextStyle(
                                      color: isDark
                                          ? Colors.grey[400]
                                          : Colors.grey[700],
                                    ),
                                    border: OutlineInputBorder(
                                      borderRadius: BorderRadius.circular(12),
                                      borderSide:
                                          BorderSide(color: Colors.grey[300]!),
                                    ),
                                    enabledBorder: OutlineInputBorder(
                                      borderRadius: BorderRadius.circular(12),
                                      borderSide:
                                          BorderSide(color: Colors.grey[300]!),
                                    ),
                                    focusedBorder: OutlineInputBorder(
                                      borderRadius: BorderRadius.circular(12),
                                      borderSide: const BorderSide(
                                          color: Colors.orange, width: 2),
                                    ),
                                    prefixIcon: const Icon(Icons.edit_note,
                                        color: Colors.orange),
                                    hintText:
                                        'e.g., Air conditioning malfunction, Guest request',
                                    hintStyle: TextStyle(
                                      color: isDark
                                          ? Colors.grey[600]
                                          : Colors.grey[400],
                                    ),
                                    filled: true,
                                    fillColor: isDark
                                        ? const Color(0xFF2C2C2C)
                                        : Colors.grey[50],
                                  ),
                                  maxLines: 3,
                                  validator: (value) {
                                    if (value == null || value.trim().isEmpty) {
                                      return 'Please provide a reason for the room change';
                                    }
                                    return null;
                                  },
                                ),
                              ),
                              const SizedBox(height: 16),

                              // Additional Notes
                              Container(
                                decoration: BoxDecoration(
                                  color: isDark
                                      ? const Color(0xFF1E1E1E)
                                      : Colors.white,
                                  borderRadius: BorderRadius.circular(12),
                                  boxShadow: [
                                    BoxShadow(
                                      color: Colors.black.withOpacity(0.05),
                                      blurRadius: 10,
                                      offset: const Offset(0, 2),
                                    ),
                                  ],
                                ),
                                child: TextFormField(
                                  controller: _notesController,
                                  decoration: InputDecoration(
                                    labelText: 'Additional Notes (Optional)',
                                    labelStyle: TextStyle(
                                      color: isDark
                                          ? Colors.grey[400]
                                          : Colors.grey[700],
                                    ),
                                    border: OutlineInputBorder(
                                      borderRadius: BorderRadius.circular(12),
                                      borderSide:
                                          BorderSide(color: Colors.grey[300]!),
                                    ),
                                    enabledBorder: OutlineInputBorder(
                                      borderRadius: BorderRadius.circular(12),
                                      borderSide:
                                          BorderSide(color: Colors.grey[300]!),
                                    ),
                                    focusedBorder: OutlineInputBorder(
                                      borderRadius: BorderRadius.circular(12),
                                      borderSide: BorderSide(
                                          color: Colors.grey[600]!, width: 2),
                                    ),
                                    prefixIcon: Icon(Icons.note,
                                        color: Colors.grey[600]),
                                    hintText: 'Any additional information...',
                                    hintStyle: TextStyle(
                                      color: isDark
                                          ? Colors.grey[600]
                                          : Colors.grey[400],
                                    ),
                                    filled: true,
                                    fillColor: isDark
                                        ? const Color(0xFF2C2C2C)
                                        : Colors.grey[50],
                                  ),
                                  maxLines: 2,
                                ),
                              ),
                              const SizedBox(height: 16),

                              // Mark as Completed Checkbox
                              Container(
                                decoration: BoxDecoration(
                                  color: isDark
                                      ? const Color(0xFF1E1E1E)
                                      : Colors.white,
                                  borderRadius: BorderRadius.circular(12),
                                  border: Border.all(
                                    color: isDark
                                        ? Colors.grey[700]!
                                        : Colors.grey[300]!,
                                  ),
                                ),
                                child: CheckboxListTile(
                                  title: Text(
                                    'Mark as Completed',
                                    style: TextStyle(
                                      fontWeight: FontWeight.w600,
                                      color: isDark
                                          ? Colors.white
                                          : Colors.black87,
                                    ),
                                  ),
                                  subtitle: Text(
                                    'Check this if the guest has already moved to the new room',
                                    style: TextStyle(
                                      fontSize: 12,
                                      color: isDark
                                          ? Colors.grey[400]
                                          : Colors.grey[600],
                                    ),
                                  ),
                                  value: _markAsCompleted,
                                  onChanged: (value) {
                                    setState(() {
                                      _markAsCompleted = value ?? false;
                                    });
                                  },
                                  activeColor: Colors.green,
                                  shape: RoundedRectangleBorder(
                                    borderRadius: BorderRadius.circular(12),
                                  ),
                                ),
                              ),
                              const SizedBox(height: 24),

                              // Submit Button
                              Container(
                                width: double.infinity,
                                height: 56,
                                decoration: BoxDecoration(
                                  gradient: LinearGradient(
                                    colors: _isSubmitting
                                        ? [Colors.grey, Colors.grey[600]!]
                                        : [
                                            const Color(0xFFFF6B35),
                                            const Color(0xFFFF8C42)
                                          ],
                                  ),
                                  borderRadius: BorderRadius.circular(12),
                                  boxShadow: [
                                    BoxShadow(
                                      color: _isSubmitting
                                          ? Colors.grey.withOpacity(0.3)
                                          : const Color(0xFFFF6B35)
                                              .withOpacity(0.4),
                                      blurRadius: 10,
                                      offset: const Offset(0, 4),
                                    ),
                                  ],
                                ),
                                child: ElevatedButton(
                                  onPressed:
                                      _isSubmitting ? null : _submitRoomChange,
                                  style: ElevatedButton.styleFrom(
                                    backgroundColor: Colors.transparent,
                                    foregroundColor: Colors.white,
                                    shadowColor: Colors.transparent,
                                    shape: RoundedRectangleBorder(
                                      borderRadius: BorderRadius.circular(12),
                                    ),
                                  ),
                                  child: _isSubmitting
                                      ? const SizedBox(
                                          height: 24,
                                          width: 24,
                                          child: CircularProgressIndicator(
                                            strokeWidth: 3,
                                            valueColor:
                                                AlwaysStoppedAnimation<Color>(
                                                    Colors.white),
                                          ),
                                        )
                                      : const Row(
                                          mainAxisAlignment:
                                              MainAxisAlignment.center,
                                          children: [
                                            Icon(Icons.check_circle,
                                                size: 24, color: Colors.white),
                                            SizedBox(width: 12),
                                            Text(
                                              'Create Room Change',
                                              style: TextStyle(
                                                fontSize: 16,
                                                fontWeight: FontWeight.bold,
                                                letterSpacing: 0.5,
                                                color: Colors.white,
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
                    ),
                  ],
                ),
              ),
            );
          },
        ),
      ),
    );
  }

  Future<void> _submitRoomChange() async {
    if (!_formKey.currentState!.validate()) {
      return;
    }

    if (_selectedOccupiedRoom == null || _selectedNewRoom == null) {
      _showMessage('Please select both current and new rooms', isError: true);
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
        // If room change was marked as completed, refresh guest data
        if (_markAsCompleted) {
          final guestProvider =
              Provider.of<GuestProvider>(context, listen: false);
          await guestProvider.loadGuests();
        }

        _showMessage(
          _markAsCompleted
              ? 'Room change completed! Guest room updated.'
              : 'Room change request created successfully',
        );

        // Delay navigation to allow message to display
        await Future.delayed(const Duration(milliseconds: 800));
        if (mounted) {
          Navigator.of(context).pop(); // Go back to list
        }
      } else {
        _showMessage(
          provider.errorMessage ?? 'Failed to create room change',
          isError: true,
        );
      }
    }
  }

  // Helper Widget Methods
  Widget _buildSectionHeader(String title, IconData icon) {
    final isDark = Theme.of(context).brightness == Brightness.dark;
    return Row(
      mainAxisSize: MainAxisSize.max,
      crossAxisAlignment: CrossAxisAlignment.center,
      children: [
        Container(
          padding: const EdgeInsets.all(8),
          decoration: BoxDecoration(
            gradient: const LinearGradient(
              colors: [Color(0xFFFF6B35), Color(0xFFFF8C42)],
            ),
            borderRadius: BorderRadius.circular(8),
          ),
          child: Icon(icon, color: Colors.white, size: 20),
        ),
        const SizedBox(width: 12),
        Flexible(
          child: Text(
            title,
            style: TextStyle(
              fontSize: 16,
              fontWeight: FontWeight.bold,
              color: isDark ? Colors.white : Colors.black87,
            ),
            overflow: TextOverflow.ellipsis,
            maxLines: 2,
          ),
        ),
      ],
    );
  }

  Widget _buildInfoCard(String message, IconData icon, bool isDark) {
    return Container(
      padding: const EdgeInsets.all(16),
      decoration: BoxDecoration(
        color: isDark ? const Color(0xFF2C2C2C) : Colors.grey[100],
        borderRadius: BorderRadius.circular(12),
        border: Border.all(
          color: isDark ? Colors.grey[700]! : Colors.grey[300]!,
        ),
      ),
      child: Row(
        children: [
          Icon(icon, color: Colors.grey[600]),
          const SizedBox(width: 12),
          Expanded(
            child: Text(
              message,
              style: TextStyle(
                color: isDark ? Colors.grey[400] : Colors.grey[600],
              ),
            ),
          ),
        ],
      ),
    );
  }

  Widget _buildLoadingCard() {
    return const Center(
      child: Padding(
        padding: EdgeInsets.all(32.0),
        child: CircularProgressIndicator(),
      ),
    );
  }

  Widget _buildEmptyCard(
      String title, String message, IconData icon, VoidCallback onRetry) {
    final isDark = Theme.of(context).brightness == Brightness.dark;
    return Container(
      padding: const EdgeInsets.all(20),
      decoration: BoxDecoration(
        color: isDark ? const Color(0xFF1E1E1E) : Colors.white,
        borderRadius: BorderRadius.circular(12),
        border: Border.all(
          color: isDark ? Colors.grey[700]! : Colors.grey[300]!,
        ),
      ),
      child: Column(
        children: [
          Icon(icon, size: 48, color: Colors.grey[400]),
          const SizedBox(height: 12),
          Text(
            title,
            style: TextStyle(
              fontSize: 16,
              fontWeight: FontWeight.bold,
              color: isDark ? Colors.white : Colors.black87,
            ),
          ),
          const SizedBox(height: 4),
          Text(
            message,
            style: TextStyle(
              color: isDark ? Colors.grey[400] : Colors.grey[600],
            ),
            textAlign: TextAlign.center,
          ),
          const SizedBox(height: 16),
          TextButton.icon(
            onPressed: onRetry,
            icon: const Icon(Icons.refresh),
            label: const Text('Refresh'),
            style: TextButton.styleFrom(
              foregroundColor: const Color(0xFFFF6B35),
            ),
          ),
        ],
      ),
    );
  }
}
