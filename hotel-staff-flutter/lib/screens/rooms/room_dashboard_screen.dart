import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import '../../providers/room_provider.dart';
import '../../models/room.dart';
import 'room_details_screen.dart';
import 'today_activity_screen.dart';

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
    return Scaffold(
      backgroundColor: Colors.grey[100],
      appBar: AppBar(
        elevation: 0,
        backgroundColor: Colors.white,
        foregroundColor: Colors.black87,
        title: const Text(
          'Room Management',
          style: TextStyle(fontWeight: FontWeight.w600),
        ),
        actions: [
          IconButton(
            icon: Container(
              padding: const EdgeInsets.all(8),
              decoration: BoxDecoration(
                color: Colors.blue[50],
                borderRadius: BorderRadius.circular(8),
              ),
              child: const Icon(Icons.calendar_today, size: 20),
            ),
            onPressed: () {
              Navigator.push(
                context,
                MaterialPageRoute(
                  builder: (context) => const TodayActivityScreen(),
                ),
              );
            },
            tooltip: 'Today\'s Activity',
          ),
          IconButton(
            icon: const Icon(Icons.refresh),
            onPressed: () {
              context.read<RoomProvider>().refresh();
            },
            tooltip: 'Refresh',
          ),
          const SizedBox(width: 8),
        ],
      ),
      body: Consumer<RoomProvider>(
        builder: (context, provider, child) {
          if (provider.isLoading && provider.rooms.isEmpty) {
            return const Center(child: CircularProgressIndicator());
          }

          if (provider.error != null) {
            return Center(
              child: Column(
                mainAxisAlignment: MainAxisAlignment.center,
                children: [
                  Icon(Icons.error_outline, size: 64, color: Colors.red[300]),
                  const SizedBox(height: 16),
                  const Text(
                    'Failed to load rooms',
                    style: TextStyle(fontSize: 18, fontWeight: FontWeight.w600),
                  ),
                  const SizedBox(height: 8),
                  Padding(
                    padding: const EdgeInsets.symmetric(horizontal: 32),
                    child: Text(
                      provider.error!,
                      textAlign: TextAlign.center,
                      style: TextStyle(color: Colors.grey[600]),
                    ),
                  ),
                  const SizedBox(height: 16),
                  ElevatedButton.icon(
                    onPressed: () => provider.refresh(),
                    icon: const Icon(Icons.refresh),
                    label: const Text('Retry'),
                    style: ElevatedButton.styleFrom(
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

          return RefreshIndicator(
            onRefresh: () => provider.refresh(),
            child: CustomScrollView(
              slivers: [
                // Statistics Cards
                if (provider.statistics != null)
                  SliverToBoxAdapter(
                    child: _buildStatisticsSection(provider),
                  ),

                // Search Bar
                SliverToBoxAdapter(
                  child: Padding(
                    padding: const EdgeInsets.fromLTRB(16, 16, 16, 8),
                    child: TextField(
                      controller: _searchController,
                      onChanged: (value) {
                        setState(() {
                          _searchQuery = value.toLowerCase();
                        });
                      },
                      decoration: InputDecoration(
                        hintText: 'Search by room number or type...',
                        hintStyle:
                            TextStyle(color: Colors.grey[400], fontSize: 14),
                        prefixIcon: Icon(Icons.search,
                            color: Colors.grey[600], size: 20),
                        suffixIcon: _searchQuery.isNotEmpty
                            ? IconButton(
                                icon: Icon(Icons.clear,
                                    color: Colors.grey[600], size: 20),
                                onPressed: () {
                                  _searchController.clear();
                                  setState(() {
                                    _searchQuery = '';
                                  });
                                },
                              )
                            : null,
                        filled: true,
                        fillColor: Colors.white,
                        contentPadding: const EdgeInsets.symmetric(
                            horizontal: 16, vertical: 12),
                        border: OutlineInputBorder(
                          borderRadius: BorderRadius.circular(10),
                          borderSide:
                              BorderSide(color: Colors.grey[300]!, width: 1),
                        ),
                        enabledBorder: OutlineInputBorder(
                          borderRadius: BorderRadius.circular(10),
                          borderSide:
                              BorderSide(color: Colors.grey[300]!, width: 1),
                        ),
                        focusedBorder: OutlineInputBorder(
                          borderRadius: BorderRadius.circular(10),
                          borderSide:
                              const BorderSide(color: Colors.blue, width: 1.5),
                        ),
                      ),
                    ),
                  ),
                ),

                // Filter Chips
                SliverToBoxAdapter(
                  child: _buildFilterSection(provider),
                ),

                // Room List
                SliverToBoxAdapter(
                  child: Builder(
                    builder: (context) {
                      // Filter rooms based on search query
                      final filteredRooms = _searchQuery.isEmpty
                          ? provider.rooms
                          : provider.rooms.where((room) {
                              final roomNum = room.roomNum.toLowerCase();
                              final roomType = room.roomTypeName.toLowerCase();
                              return roomNum.contains(_searchQuery) ||
                                  roomType.contains(_searchQuery);
                            }).toList();

                      if (filteredRooms.isEmpty) {
                        return SizedBox(
                          height: MediaQuery.of(context).size.height * 0.4,
                          child: Center(
                            child: Column(
                              mainAxisAlignment: MainAxisAlignment.center,
                              children: [
                                Icon(
                                  Icons.search_off,
                                  size: 64,
                                  color: Colors.grey[400],
                                ),
                                const SizedBox(height: 16),
                                Text(
                                  _searchQuery.isEmpty
                                      ? 'No rooms found'
                                      : 'No rooms match "$_searchQuery"',
                                  style: TextStyle(
                                    fontSize: 16,
                                    color: Colors.grey[600],
                                  ),
                                ),
                              ],
                            ),
                          ),
                        );
                      }

                      return ListView.builder(
                        shrinkWrap: true,
                        physics: const NeverScrollableScrollPhysics(),
                        padding: const EdgeInsets.all(16),
                        itemCount: filteredRooms.length,
                        itemBuilder: (context, index) {
                          return Padding(
                            padding: const EdgeInsets.only(bottom: 10),
                            child:
                                _buildRoomCard(context, filteredRooms[index]),
                          );
                        },
                      );
                    },
                  ),
                ),
              ],
            ),
          );
        },
      ),
    );
  }

  Widget _buildStatisticsSection(RoomProvider provider) {
    final stats = provider.statistics!;

    return Container(
      padding: const EdgeInsets.all(16),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          const Text(
            'Overview',
            style: TextStyle(
              fontSize: 20,
              fontWeight: FontWeight.bold,
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
                ),
              ),
              const SizedBox(width: 8),
              Expanded(
                child: _buildStatCard(
                  'Occupancy',
                  '${stats.occupancyRate.toStringAsFixed(0)}%',
                  Icons.pie_chart_rounded,
                  Colors.purple,
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
                ),
              ),
              const SizedBox(width: 8),
              Expanded(
                child: _buildStatCard(
                  'Occupied',
                  stats.occupiedRooms.toString(),
                  Icons.person_rounded,
                  Colors.orange,
                ),
              ),
            ],
          ),
        ],
      ),
    );
  }

  Widget _buildStatCard(
      String label, String value, IconData icon, Color color) {
    return Container(
      padding: const EdgeInsets.all(16),
      decoration: BoxDecoration(
        color: Colors.white,
        borderRadius: BorderRadius.circular(12),
        boxShadow: [
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

  Widget _buildFilterSection(RoomProvider provider) {
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
            ),
            _buildFilterChip(
              'Available',
              counts['available'] ?? 0,
              provider.selectedFilter == 'available',
              () => provider.setFilter('available'),
              Colors.green,
            ),
            _buildFilterChip(
              'Occupied',
              counts['occupied'] ?? 0,
              provider.selectedFilter == 'occupied',
              () => provider.setFilter('occupied'),
              Colors.orange,
            ),
            _buildFilterChip(
              'Cleaning',
              counts['cleaning'] ?? 0,
              provider.selectedFilter == 'cleaning',
              () => provider.setFilter('cleaning'),
              Colors.blue,
            ),
            _buildFilterChip(
              'Maintenance',
              counts['maintenance'] ?? 0,
              provider.selectedFilter == 'maintenance',
              () => provider.setFilter('maintenance'),
              Colors.red,
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
        backgroundColor: color.withValues(alpha: 0.1),
        selectedColor: color,
        showCheckmark: false,
      ),
    );
  }

  Widget _buildRoomCard(BuildContext context, Room room) {
    final statusColor = _getStatusColor(room.currentStatus);
    final statusIcon = _getStatusIcon(room.currentStatus);

    return Card(
      elevation: 2,
      shape: RoundedRectangleBorder(
        borderRadius: BorderRadius.circular(10),
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
                      style: const TextStyle(
                        fontSize: 15,
                        fontWeight: FontWeight.bold,
                      ),
                    ),
                    const SizedBox(height: 4),
                    Text(
                      room.roomTypeName,
                      style: TextStyle(
                        fontSize: 12,
                        color: Colors.grey[600],
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
                          color: Colors.grey[500],
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
