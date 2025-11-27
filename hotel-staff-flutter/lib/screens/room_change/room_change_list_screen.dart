import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:go_router/go_router.dart';
import 'package:intl/intl.dart';
import '../../providers/room_change_provider.dart';
import '../../models/room_change.dart';

class RoomChangeListScreen extends StatefulWidget {
  const RoomChangeListScreen({super.key});

  @override
  State<RoomChangeListScreen> createState() => _RoomChangeListScreenState();
}

class _RoomChangeListScreenState extends State<RoomChangeListScreen> {
  String? _selectedStatus;

  @override
  void initState() {
    super.initState();
    WidgetsBinding.instance.addPostFrameCallback((_) {
      _loadData();
    });
  }

  Future<void> _loadData() async {
    final provider = Provider.of<RoomChangeProvider>(context, listen: false);
    await Future.wait([
      provider.loadRoomChanges(status: _selectedStatus),
      provider.loadStatistics(),
    ]);
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Room Changes'),
        actions: [
          IconButton(
            icon: const Icon(Icons.refresh),
            onPressed: _loadData,
          ),
        ],
      ),
      body: Consumer<RoomChangeProvider>(
        builder: (context, provider, child) {
          if (provider.isLoading && provider.roomChanges.isEmpty) {
            return const Center(child: CircularProgressIndicator());
          }

          return RefreshIndicator(
            onRefresh: _loadData,
            child: Column(
              children: [
                // Statistics Cards
                if (provider.statistics != null)
                  _buildStatisticsSection(provider.statistics!),

                // Status Filter Chips
                _buildFilterChips(provider),

                // Room Changes List
                Expanded(
                  child: provider.roomChanges.isEmpty
                      ? _buildEmptyState()
                      : ListView.builder(
                          padding: const EdgeInsets.all(16),
                          itemCount: provider.roomChanges.length,
                          itemBuilder: (context, index) {
                            final roomChange = provider.roomChanges[index];
                            return _buildRoomChangeCard(roomChange);
                          },
                        ),
                ),
              ],
            ),
          );
        },
      ),
      floatingActionButton: FloatingActionButton.extended(
        onPressed: () {
          context.push('/room-change/create');
        },
        icon: const Icon(Icons.add),
        label: const Text('New Room Change'),
      ),
    );
  }

  Widget _buildStatisticsSection(RoomChangeStatistics stats) {
    return Container(
      padding: const EdgeInsets.all(16),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          const Text(
            'Statistics',
            style: TextStyle(fontSize: 18, fontWeight: FontWeight.bold),
          ),
          const SizedBox(height: 12),
          Row(
            children: [
              Expanded(
                child: _buildStatCard(
                  'Total',
                  stats.totalChanges.toString(),
                  Colors.blue,
                  Icons.swap_horiz,
                ),
              ),
              const SizedBox(width: 8),
              Expanded(
                child: _buildStatCard(
                  'Pending',
                  stats.pendingChanges.toString(),
                  Colors.orange,
                  Icons.pending,
                ),
              ),
              const SizedBox(width: 8),
              Expanded(
                child: _buildStatCard(
                  'Completed',
                  stats.completedChanges.toString(),
                  Colors.green,
                  Icons.check_circle,
                ),
              ),
            ],
          ),
          const SizedBox(height: 8),
          Row(
            children: [
              Expanded(
                child: _buildStatCard(
                  'Today',
                  stats.todayChanges.toString(),
                  Colors.purple,
                  Icons.today,
                ),
              ),
              const SizedBox(width: 8),
              Expanded(
                child: _buildStatCard(
                  'This Week',
                  stats.weekChanges.toString(),
                  Colors.teal,
                  Icons.date_range,
                ),
              ),
              const SizedBox(width: 8),
              Expanded(
                child: _buildStatCard(
                  'This Month',
                  stats.monthChanges.toString(),
                  Colors.indigo,
                  Icons.calendar_month,
                ),
              ),
            ],
          ),
        ],
      ),
    );
  }

  Widget _buildStatCard(
      String label, String value, Color color, IconData icon) {
    return Card(
      child: Padding(
        padding: const EdgeInsets.all(12),
        child: Column(
          children: [
            Icon(icon, color: color, size: 24),
            const SizedBox(height: 4),
            Text(
              value,
              style: TextStyle(
                fontSize: 20,
                fontWeight: FontWeight.bold,
                color: color,
              ),
            ),
            Text(
              label,
              style: TextStyle(fontSize: 12, color: Colors.grey[600]),
              textAlign: TextAlign.center,
            ),
          ],
        ),
      ),
    );
  }

  Widget _buildFilterChips(RoomChangeProvider provider) {
    return SingleChildScrollView(
      scrollDirection: Axis.horizontal,
      padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 8),
      child: Row(
        children: [
          FilterChip(
            label: const Text('All'),
            selected: _selectedStatus == null,
            onSelected: (selected) {
              setState(() {
                _selectedStatus = null;
              });
              provider.setStatusFilter(null);
            },
          ),
          const SizedBox(width: 8),
          FilterChip(
            label: const Text('Pending'),
            selected: _selectedStatus == 'pending',
            onSelected: (selected) {
              setState(() {
                _selectedStatus = selected ? 'pending' : null;
              });
              provider.setStatusFilter(_selectedStatus);
            },
          ),
          const SizedBox(width: 8),
          FilterChip(
            label: const Text('Completed'),
            selected: _selectedStatus == 'completed',
            onSelected: (selected) {
              setState(() {
                _selectedStatus = selected ? 'completed' : null;
              });
              provider.setStatusFilter(_selectedStatus);
            },
          ),
          const SizedBox(width: 8),
          FilterChip(
            label: const Text('Cancelled'),
            selected: _selectedStatus == 'cancelled',
            onSelected: (selected) {
              setState(() {
                _selectedStatus = selected ? 'cancelled' : null;
              });
              provider.setStatusFilter(_selectedStatus);
            },
          ),
        ],
      ),
    );
  }

  Widget _buildRoomChangeCard(RoomChange roomChange) {
    final dateFormat = DateFormat('MMM dd, yyyy HH:mm');

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

    return Card(
      margin: const EdgeInsets.only(bottom: 12),
      child: InkWell(
        onTap: () {
          context.push('/room-change/details', extra: roomChange);
        },
        child: Padding(
          padding: const EdgeInsets.all(16),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              // Header with status
              Row(
                mainAxisAlignment: MainAxisAlignment.spaceBetween,
                children: [
                  Expanded(
                    child: Text(
                      roomChange.guestName,
                      style: const TextStyle(
                        fontSize: 16,
                        fontWeight: FontWeight.bold,
                      ),
                    ),
                  ),
                  Container(
                    padding: const EdgeInsets.symmetric(
                      horizontal: 12,
                      vertical: 6,
                    ),
                    decoration: BoxDecoration(
                      color: statusColor.withOpacity(0.2),
                      borderRadius: BorderRadius.circular(12),
                    ),
                    child: Text(
                      roomChange.statusDisplayName,
                      style: TextStyle(
                        color: statusColor,
                        fontWeight: FontWeight.bold,
                        fontSize: 12,
                      ),
                    ),
                  ),
                ],
              ),
              const SizedBox(height: 12),

              // Room change info
              Row(
                children: [
                  Expanded(
                    child: _buildRoomInfo(
                      'From',
                      roomChange.oldRoomNum,
                      Icons.meeting_room,
                      Colors.red,
                    ),
                  ),
                  const Icon(Icons.arrow_forward, color: Colors.grey),
                  const SizedBox(width: 8),
                  Expanded(
                    child: _buildRoomInfo(
                      'To',
                      roomChange.newRoomNum,
                      Icons.meeting_room,
                      Colors.green,
                    ),
                  ),
                ],
              ),
              const SizedBox(height: 12),

              // Reason
              Container(
                padding: const EdgeInsets.all(12),
                decoration: BoxDecoration(
                  color: Colors.grey[100],
                  borderRadius: BorderRadius.circular(8),
                ),
                child: Row(
                  children: [
                    const Icon(Icons.info_outline,
                        size: 16, color: Colors.grey),
                    const SizedBox(width: 8),
                    Expanded(
                      child: Text(
                        roomChange.changeReason,
                        style: const TextStyle(fontSize: 13),
                      ),
                    ),
                  ],
                ),
              ),
              const SizedBox(height: 8),

              // Footer info
              Row(
                mainAxisAlignment: MainAxisAlignment.spaceBetween,
                children: [
                  Row(
                    children: [
                      const Icon(Icons.person, size: 14, color: Colors.grey),
                      const SizedBox(width: 4),
                      Text(
                        roomChange.changedBy,
                        style: TextStyle(fontSize: 12, color: Colors.grey[600]),
                      ),
                    ],
                  ),
                  Text(
                    dateFormat.format(roomChange.changeDate),
                    style: TextStyle(fontSize: 12, color: Colors.grey[600]),
                  ),
                ],
              ),
            ],
          ),
        ),
      ),
    );
  }

  Widget _buildRoomInfo(
      String label, String roomNum, IconData icon, Color color) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Text(
          label,
          style: TextStyle(fontSize: 11, color: Colors.grey[600]),
        ),
        const SizedBox(height: 4),
        Row(
          children: [
            Icon(icon, size: 16, color: color),
            const SizedBox(width: 4),
            Text(
              roomNum,
              style: TextStyle(
                fontSize: 16,
                fontWeight: FontWeight.bold,
                color: color,
              ),
            ),
          ],
        ),
      ],
    );
  }

  Widget _buildEmptyState() {
    return Center(
      child: Column(
        mainAxisAlignment: MainAxisAlignment.center,
        children: [
          Icon(Icons.swap_horiz, size: 64, color: Colors.grey[300]),
          const SizedBox(height: 16),
          Text(
            'No room changes found',
            style: TextStyle(fontSize: 16, color: Colors.grey[600]),
          ),
          const SizedBox(height: 8),
          Text(
            _selectedStatus != null
                ? 'Try changing the filter'
                : 'Create your first room change',
            style: TextStyle(fontSize: 14, color: Colors.grey[500]),
          ),
        ],
      ),
    );
  }
}
