import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import '../../providers/room_provider.dart';
import '../../models/room.dart';
import 'room_details_screen.dart';

class RoomDashboardScreen extends StatefulWidget {
  const RoomDashboardScreen({Key? key}) : super(key: key);

  @override
  State<RoomDashboardScreen> createState() => _RoomDashboardScreenState();
}

class _RoomDashboardScreenState extends State<RoomDashboardScreen> {
  final TextEditingController _searchController = TextEditingController();
  String _searchQuery = '';

  @override
  void initState() {
    super.initState();
    WidgetsBinding.instance.addPostFrameCallback((_) {
      context.read<RoomProvider>().loadAll();
    });
  }

  @override
  void dispose() {
    _searchController.dispose();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    final isDark = Theme.of(context).brightness == Brightness.dark;

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
                    const Color(0xFFFF7043),
                    const Color(0xFFFF8A65),
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
                      onPressed: () => Navigator.pop(context),
                      padding: EdgeInsets.zero,
                      constraints: const BoxConstraints(),
                    ),
                    const SizedBox(width: 12),
                    const Text(
                      'Room Management',
                      style: TextStyle(
                        fontSize: 20,
                        fontWeight: FontWeight.bold,
                        color: Colors.white,
                      ),
                    ),
                    const Spacer(),
                    IconButton(
                      icon: const Icon(Icons.refresh,
                          color: Colors.white, size: 24),
                      onPressed: () {
                        context.read<RoomProvider>().refresh();
                      },
                      padding: EdgeInsets.zero,
                      constraints: const BoxConstraints(),
                    ),
                  ],
                ),
              ),

              // Main Content
              Expanded(
                child: Consumer<RoomProvider>(
                  builder: (context, provider, child) {
                    if (provider.isLoading && provider.rooms.isEmpty) {
                      return Center(
                        child: CircularProgressIndicator(
                          color: Colors.white,
                        ),
                      );
                    }

                    if (provider.error != null) {
                      return Center(
                        child: Column(
                          mainAxisAlignment: MainAxisAlignment.center,
                          children: [
                            Icon(Icons.error_outline,
                                size: 64, color: Colors.white70),
                            const SizedBox(height: 16),
                            Text(
                              'Failed to load rooms',
                              style: TextStyle(
                                fontSize: 18,
                                fontWeight: FontWeight.w600,
                                color: Colors.white,
                              ),
                            ),
                            const SizedBox(height: 8),
                            Padding(
                              padding:
                                  const EdgeInsets.symmetric(horizontal: 32),
                              child: Text(
                                provider.error!,
                                textAlign: TextAlign.center,
                                style: TextStyle(color: Colors.white70),
                              ),
                            ),
                            const SizedBox(height: 16),
                            ElevatedButton.icon(
                              onPressed: () => provider.refresh(),
                              icon: const Icon(Icons.refresh),
                              label: const Text('Retry'),
                              style: ElevatedButton.styleFrom(
                                backgroundColor: Colors.white,
                                foregroundColor: const Color(0xFFFF7043),
                                padding: const EdgeInsets.symmetric(
                                  horizontal: 24,
                                  vertical: 12,
                                ),
                              ),
                            ),
                          ],
                        ),
                      );
                    }

                    return Column(
                      children: [
                        // Search Bar (inside gradient area)
                        Padding(
                          padding: const EdgeInsets.symmetric(horizontal: 16.0),
                          child: Container(
                            decoration: BoxDecoration(
                              color: isDark
                                  ? const Color(0xFF2C2C2C)
                                  : Colors.white,
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
                              controller: _searchController,
                              onChanged: (value) {
                                setState(() {
                                  _searchQuery = value.toLowerCase();
                                });
                              },
                              style: TextStyle(
                                color: isDark
                                    ? const Color(0xFFE1E1E1)
                                    : const Color(0xFF1F2937),
                                fontSize: 14,
                              ),
                              decoration: InputDecoration(
                                hintText: 'Search by room number or type...',
                                hintStyle: TextStyle(
                                  color: isDark
                                      ? const Color(0xFF707070)
                                      : Colors.grey[400],
                                  fontSize: 13,
                                ),
                                prefixIcon: Icon(Icons.search,
                                    color: isDark
                                        ? const Color(0xFF707070)
                                        : Colors.grey[400],
                                    size: 20),
                                filled: true,
                                fillColor: isDark
                                    ? const Color(0xFF2C2C2C)
                                    : Colors.white,
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

                        // Content Area with rounded top corners
                        Expanded(
                          child: Container(
                            decoration: BoxDecoration(
                              color: isDark
                                  ? const Color(0xFF121212)
                                  : Colors.grey[50],
                              borderRadius: const BorderRadius.only(
                                topLeft: Radius.circular(24),
                                topRight: Radius.circular(24),
                              ),
                            ),
                            child: RefreshIndicator(
                              onRefresh: () => provider.refresh(),
                              child: CustomScrollView(
                                slivers: [
                                  // Filter Chips
                                  SliverToBoxAdapter(
                                    child:
                                        _buildFilterSection(provider, isDark),
                                  ),

                                  // Room List
                                  SliverToBoxAdapter(
                                    child: Builder(
                                      builder: (context) {
                                        // Filter rooms based on search query
                                        final filteredRooms = _searchQuery
                                                .isEmpty
                                            ? provider.rooms
                                            : provider.rooms.where((room) {
                                                final roomNum =
                                                    room.roomNum.toLowerCase();
                                                final roomType = room
                                                    .roomTypeName
                                                    .toLowerCase();
                                                return roomNum.contains(
                                                        _searchQuery) ||
                                                    roomType
                                                        .contains(_searchQuery);
                                              }).toList();

                                        if (filteredRooms.isEmpty) {
                                          return SizedBox(
                                            height: MediaQuery.of(context)
                                                    .size
                                                    .height *
                                                0.4,
                                            child: Center(
                                              child: Column(
                                                mainAxisAlignment:
                                                    MainAxisAlignment.center,
                                                children: [
                                                  Icon(
                                                    Icons.search_off,
                                                    size: 64,
                                                    color: isDark
                                                        ? const Color(
                                                            0xFF404040)
                                                        : Colors.grey[400],
                                                  ),
                                                  const SizedBox(height: 16),
                                                  Text(
                                                    _searchQuery.isEmpty
                                                        ? 'No rooms found'
                                                        : 'No rooms match "$_searchQuery"',
                                                    style: TextStyle(
                                                      fontSize: 16,
                                                      color: isDark
                                                          ? const Color(
                                                              0xFFB0B0B0)
                                                          : Colors.grey[600],
                                                    ),
                                                  ),
                                                ],
                                              ),
                                            ),
                                          );
                                        }

                                        return ListView.builder(
                                          shrinkWrap: true,
                                          physics:
                                              const NeverScrollableScrollPhysics(),
                                          padding: const EdgeInsets.all(16),
                                          itemCount: filteredRooms.length,
                                          itemBuilder: (context, index) {
                                            return Padding(
                                              padding: const EdgeInsets.only(
                                                  bottom: 10),
                                              child: _buildRoomCard(context,
                                                  filteredRooms[index], isDark),
                                            );
                                          },
                                        );
                                      },
                                    ),
                                  ),
                                ],
                              ),
                            ),
                          ),
                        ),
                      ],
                    );
                  },
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }

  Widget _buildStatisticsSection(RoomProvider provider, bool isDark) {
    final stats = provider.statistics!;

    return Container(
      padding: const EdgeInsets.all(16),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Text(
            'Overview',
            style: TextStyle(
              fontSize: 20,
              fontWeight: FontWeight.bold,
              color: isDark ? const Color(0xFFE1E1E1) : Colors.black87,
            ),
          ),
          const SizedBox(height: 12),
          Row(
            children: [
              Expanded(
                child: _buildStatCard(
                  'Total Rooms',
                  stats.totalRooms.toString(),
                  Icons.meeting_room_rounded,
                  Colors.blue,
                  isDark,
                ),
              ),
              const SizedBox(width: 8),
              Expanded(
                child: _buildStatCard(
                  'Occupancy',
                  '${stats.occupancyRate.toStringAsFixed(0)}%',
                  Icons.pie_chart_rounded,
                  Colors.purple,
                  isDark,
                ),
              ),
            ],
          ),
          const SizedBox(height: 8),
          Row(
            children: [
              Expanded(
                child: _buildStatCard(
                  'Available',
                  stats.availableRooms.toString(),
                  Icons.check_circle_rounded,
                  Colors.green,
                  isDark,
                ),
              ),
              const SizedBox(width: 8),
              Expanded(
                child: _buildStatCard(
                  'Occupied',
                  stats.occupiedRooms.toString(),
                  Icons.person_rounded,
                  Colors.orange,
                  isDark,
                ),
              ),
            ],
          ),
        ],
      ),
    );
  }

  Widget _buildStatCard(
      String label, String value, IconData icon, Color color, bool isDark) {
    return Container(
      padding: const EdgeInsets.all(16),
      decoration: BoxDecoration(
        color: isDark ? const Color(0xFF1E1E1E) : Colors.white,
        borderRadius: BorderRadius.circular(12),
        border: isDark
            ? Border.all(color: const Color(0xFF404040), width: 1)
            : null,
        boxShadow: isDark
            ? null
            : [
                BoxShadow(
                  color: Colors.black.withValues(alpha: 0.05),
                  blurRadius: 10,
                  offset: const Offset(0, 2),
                ),
              ],
      ),
      child: Column(
        children: [
          Icon(icon, color: color, size: 32),
          const SizedBox(height: 8),
          Text(
            value,
            style: TextStyle(
              fontSize: 22,
              fontWeight: FontWeight.bold,
              color: color,
            ),
          ),
          Text(
            label,
            style: TextStyle(
              fontSize: 11,
              color: Colors.grey[600],
            ),
            textAlign: TextAlign.center,
          ),
        ],
      ),
    );
  }

  Widget _buildFilterSection(RoomProvider provider, bool isDark) {
    final counts = provider.statusCounts;

    return Container(
      padding: const EdgeInsets.symmetric(vertical: 12),
      child: SingleChildScrollView(
        scrollDirection: Axis.horizontal,
        padding: const EdgeInsets.symmetric(horizontal: 16),
        child: Row(
          children: [
            _buildFilterChip(
              'All',
              counts['all'] ?? 0,
              provider.selectedFilter == 'all',
              () => provider.setFilter('all'),
              Colors.grey,
              isDark,
            ),
            _buildFilterChip(
              'Available',
              counts['available'] ?? 0,
              provider.selectedFilter == 'available',
              () => provider.setFilter('available'),
              Colors.green,
              isDark,
            ),
            _buildFilterChip(
              'Occupied',
              counts['occupied'] ?? 0,
              provider.selectedFilter == 'occupied',
              () => provider.setFilter('occupied'),
              Colors.orange,
              isDark,
            ),
            _buildFilterChip(
              'Cleaning',
              counts['cleaning'] ?? 0,
              provider.selectedFilter == 'cleaning',
              () => provider.setFilter('cleaning'),
              Colors.blue,
              isDark,
            ),
            _buildFilterChip(
              'Maintenance',
              counts['maintenance'] ?? 0,
              provider.selectedFilter == 'maintenance',
              () => provider.setFilter('maintenance'),
              Colors.red,
              isDark,
            ),
          ],
        ),
      ),
    );
  }

  Widget _buildFilterChip(
    String label,
    int count,
    bool selected,
    VoidCallback onTap,
    Color color,
    bool isDark,
  ) {
    return Padding(
      padding: const EdgeInsets.only(right: 8),
      child: FilterChip(
        label: Text(
          '$label ($count)',
          style: TextStyle(
            color: selected ? Colors.white : color,
            fontWeight: selected ? FontWeight.w600 : FontWeight.normal,
          ),
        ),
        selected: selected,
        onSelected: (_) => onTap(),
        backgroundColor: isDark
            ? color.withValues(alpha: 0.2)
            : color.withValues(alpha: 0.1),
        selectedColor: color,
        showCheckmark: false,
      ),
    );
  }

  Widget _buildRoomCard(BuildContext context, Room room, bool isDark) {
    final statusColor = _getStatusColor(room.currentStatus);
    final statusIcon = _getStatusIcon(room.currentStatus);

    return Card(
      elevation: isDark ? 0 : 2,
      color: isDark ? const Color(0xFF1E1E1E) : Colors.white,
      shape: RoundedRectangleBorder(
        borderRadius: BorderRadius.circular(10),
        side: isDark
            ? const BorderSide(color: Color(0xFF404040), width: 1)
            : BorderSide.none,
      ),
      child: InkWell(
        onTap: () {
          Navigator.push(
            context,
            MaterialPageRoute(
              builder: (context) => RoomDetailsScreen(room: room),
            ),
          );
        },
        borderRadius: BorderRadius.circular(10),
        child: Padding(
          padding: const EdgeInsets.all(12),
          child: Row(
            children: [
              // Room Icon
              Container(
                padding: const EdgeInsets.all(10),
                decoration: BoxDecoration(
                  color: statusColor.withValues(alpha: 0.15),
                  borderRadius: BorderRadius.circular(8),
                ),
                child: Icon(
                  Icons.hotel,
                  color: statusColor,
                  size: 24,
                ),
              ),
              const SizedBox(width: 12),
              // Room Info
              Expanded(
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  mainAxisSize: MainAxisSize.min,
                  children: [
                    Text(
                      room.roomNum,
                      style: TextStyle(
                        fontSize: 15,
                        fontWeight: FontWeight.bold,
                        color: isDark ? const Color(0xFFE1E1E1) : Colors.black,
                      ),
                    ),
                    const SizedBox(height: 4),
                    Text(
                      room.roomTypeName,
                      style: TextStyle(
                        fontSize: 12,
                        color:
                            isDark ? const Color(0xFFB0B0B0) : Colors.grey[600],
                      ),
                      maxLines: 1,
                      overflow: TextOverflow.ellipsis,
                    ),
                    const SizedBox(height: 4),
                    if (room.isOccupiedStatus && room.guestName != null)
                      Text(
                        'Guest: ${room.guestName}',
                        style: TextStyle(
                          fontSize: 11,
                          color: Colors.orange[700],
                        ),
                        maxLines: 1,
                        overflow: TextOverflow.ellipsis,
                      )
                    else
                      Text(
                        'Ready to Book',
                        style: TextStyle(
                          fontSize: 11,
                          color: isDark
                              ? const Color(0xFF808080)
                              : Colors.grey[500],
                        ),
                      ),
                  ],
                ),
              ),
              const SizedBox(width: 8),
              // Status Badge
              Container(
                padding: const EdgeInsets.symmetric(
                  horizontal: 8,
                  vertical: 5,
                ),
                decoration: BoxDecoration(
                  color: statusColor.withValues(alpha: 0.15),
                  borderRadius: BorderRadius.circular(6),
                  border: Border.all(color: statusColor, width: 1),
                ),
                child: Row(
                  mainAxisSize: MainAxisSize.min,
                  children: [
                    Icon(
                      statusIcon,
                      color: statusColor,
                      size: 11,
                    ),
                    const SizedBox(width: 3),
                    Text(
                      room.statusDisplayName,
                      style: TextStyle(
                        color: statusColor,
                        fontSize: 10,
                        fontWeight: FontWeight.w600,
                      ),
                    ),
                  ],
                ),
              ),
            ],
          ),
        ),
      ),
    );
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
        return Icons.meeting_room;
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
}
