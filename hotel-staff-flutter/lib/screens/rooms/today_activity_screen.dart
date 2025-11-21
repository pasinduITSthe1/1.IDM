import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import '../../providers/room_provider.dart';
import '../../models/room.dart';

class TodayActivityScreen extends StatefulWidget {
  const TodayActivityScreen({Key? key}) : super(key: key);

  @override
  State<TodayActivityScreen> createState() => _TodayActivityScreenState();
}

class _TodayActivityScreenState extends State<TodayActivityScreen>
    with SingleTickerProviderStateMixin {
  late TabController _tabController;

  @override
  void initState() {
    super.initState();
    _tabController = TabController(length: 2, vsync: this);

    // Load today's activities
    WidgetsBinding.instance.addPostFrameCallback((_) {
      final provider = context.read<RoomProvider>();
      provider.loadTodayCheckIns();
      provider.loadTodayCheckOuts();
    });
  }

  @override
  void dispose() {
    _tabController.dispose();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Today\'s Activity'),
        bottom: TabBar(
          controller: _tabController,
          tabs: const [
            Tab(
              icon: Icon(Icons.arrow_downward),
              text: 'Check-ins',
            ),
            Tab(
              icon: Icon(Icons.arrow_upward),
              text: 'Check-outs',
            ),
          ],
        ),
        actions: [
          IconButton(
            icon: const Icon(Icons.refresh),
            onPressed: () {
              final provider = context.read<RoomProvider>();
              provider.loadTodayCheckIns();
              provider.loadTodayCheckOuts();
            },
          ),
        ],
      ),
      body: Consumer<RoomProvider>(
        builder: (context, provider, child) {
          return TabBarView(
            controller: _tabController,
            children: [
              // Check-ins Tab
              _buildActivityList(
                context,
                provider.todayCheckIns,
                'check-in',
                Icons.arrow_downward,
                Colors.green,
              ),

              // Check-outs Tab
              _buildActivityList(
                context,
                provider.todayCheckOuts,
                'check-out',
                Icons.arrow_upward,
                Colors.orange,
              ),
            ],
          );
        },
      ),
    );
  }

  Widget _buildActivityList(
    BuildContext context,
    List<TodayCheckInOut> activities,
    String type,
    IconData icon,
    Color color,
  ) {
    if (activities.isEmpty) {
      return Center(
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            Icon(
              icon,
              size: 64,
              color: Colors.grey.shade300,
            ),
            const SizedBox(height: 16),
            Text(
              'No ${type}s scheduled for today',
              style: TextStyle(
                fontSize: 16,
                color: Colors.grey.shade600,
              ),
            ),
          ],
        ),
      );
    }

    return RefreshIndicator(
      onRefresh: () async {
        final provider = context.read<RoomProvider>();
        if (type == 'check-in') {
          await provider.loadTodayCheckIns();
        } else {
          await provider.loadTodayCheckOuts();
        }
      },
      child: ListView.builder(
        padding: const EdgeInsets.all(16),
        itemCount: activities.length,
        itemBuilder: (context, index) {
          final activity = activities[index];
          return _buildActivityCard(context, activity, type, icon, color);
        },
      ),
    );
  }

  Widget _buildActivityCard(
    BuildContext context,
    TodayCheckInOut activity,
    String type,
    IconData icon,
    Color color,
  ) {
    return Card(
      elevation: 2,
      margin: const EdgeInsets.only(bottom: 12),
      shape: RoundedRectangleBorder(
        borderRadius: BorderRadius.circular(12),
        side: BorderSide(color: color.withValues(alpha: 0.3), width: 1),
      ),
      child: Padding(
        padding: const EdgeInsets.all(16),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            // Header Row
            Row(
              children: [
                Container(
                  padding: const EdgeInsets.all(8),
                  decoration: BoxDecoration(
                    color: color.withValues(alpha: 0.1),
                    borderRadius: BorderRadius.circular(8),
                  ),
                  child: Icon(icon, color: color, size: 24),
                ),
                const SizedBox(width: 12),
                Expanded(
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      Text(
                        'Room ${activity.roomNum}',
                        style: const TextStyle(
                          fontSize: 20,
                          fontWeight: FontWeight.bold,
                        ),
                      ),
                      Text(
                        activity.hotelName,
                        style: TextStyle(
                          fontSize: 12,
                          color: Colors.grey.shade600,
                        ),
                      ),
                    ],
                  ),
                ),
                Container(
                  padding: const EdgeInsets.symmetric(
                    horizontal: 12,
                    vertical: 6,
                  ),
                  decoration: BoxDecoration(
                    color: color,
                    borderRadius: BorderRadius.circular(16),
                  ),
                  child: Text(
                    type.toUpperCase(),
                    style: const TextStyle(
                      color: Colors.white,
                      fontSize: 11,
                      fontWeight: FontWeight.bold,
                    ),
                  ),
                ),
              ],
            ),

            const Divider(height: 24),

            // Guest Information
            _buildInfoRow(
              Icons.person,
              'Guest',
              activity.guestName,
            ),
            const SizedBox(height: 8),
            _buildInfoRow(
              Icons.email,
              'Email',
              activity.email,
            ),
            const SizedBox(height: 8),
            _buildInfoRow(
              Icons.people,
              'Guests',
              '${activity.adults} Adult(s)${activity.children > 0 ? ', ${activity.children} Child(ren)' : ''}',
            ),

            const SizedBox(height: 12),

            // Dates Row
            Row(
              children: [
                Expanded(
                  child: _buildDateChip(
                    'Check-in',
                    activity.checkInDate,
                    Icons.login,
                    Colors.green,
                  ),
                ),
                const SizedBox(width: 8),
                Expanded(
                  child: _buildDateChip(
                    'Check-out',
                    activity.checkOutDate,
                    Icons.logout,
                    Colors.orange,
                  ),
                ),
              ],
            ),

            // Booking ID
            const SizedBox(height: 12),
            Container(
              padding: const EdgeInsets.all(8),
              decoration: BoxDecoration(
                color: Colors.grey.shade100,
                borderRadius: BorderRadius.circular(8),
              ),
              child: Row(
                mainAxisSize: MainAxisSize.min,
                children: [
                  Icon(
                    Icons.confirmation_number,
                    size: 16,
                    color: Colors.grey.shade700,
                  ),
                  const SizedBox(width: 4),
                  Text(
                    'Booking #${activity.id}',
                    style: TextStyle(
                      fontSize: 12,
                      color: Colors.grey.shade700,
                      fontWeight: FontWeight.w600,
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

  Widget _buildInfoRow(IconData icon, String label, String value) {
    return Row(
      children: [
        Icon(icon, size: 18, color: Colors.grey.shade600),
        const SizedBox(width: 8),
        Text(
          '$label: ',
          style: TextStyle(
            fontSize: 14,
            color: Colors.grey.shade600,
            fontWeight: FontWeight.w500,
          ),
        ),
        Expanded(
          child: Text(
            value,
            style: const TextStyle(
              fontSize: 14,
              fontWeight: FontWeight.w600,
            ),
            overflow: TextOverflow.ellipsis,
          ),
        ),
      ],
    );
  }

  Widget _buildDateChip(
    String label,
    String date,
    IconData icon,
    Color color,
  ) {
    return Container(
      padding: const EdgeInsets.all(8),
      decoration: BoxDecoration(
        color: color.withValues(alpha: 0.1),
        borderRadius: BorderRadius.circular(8),
        border: Border.all(color: color.withValues(alpha: 0.3)),
      ),
      child: Column(
        children: [
          Row(
            mainAxisSize: MainAxisSize.min,
            children: [
              Icon(icon, size: 14, color: color),
              const SizedBox(width: 4),
              Text(
                label,
                style: TextStyle(
                  fontSize: 11,
                  color: color,
                  fontWeight: FontWeight.bold,
                ),
              ),
            ],
          ),
          const SizedBox(height: 4),
          Text(
            _formatDate(date),
            style: const TextStyle(
              fontSize: 13,
              fontWeight: FontWeight.w600,
            ),
          ),
        ],
      ),
    );
  }

  String _formatDate(String dateString) {
    try {
      final date = DateTime.parse(dateString);
      final now = DateTime.now();
      final today = DateTime(now.year, now.month, now.day);
      final dateOnly = DateTime(date.year, date.month, date.day);

      if (dateOnly == today) {
        return 'Today';
      }

      final months = [
        'Jan',
        'Feb',
        'Mar',
        'Apr',
        'May',
        'Jun',
        'Jul',
        'Aug',
        'Sep',
        'Oct',
        'Nov',
        'Dec'
      ];

      return '${months[date.month - 1]} ${date.day}, ${date.year}';
    } catch (e) {
      return dateString;
    }
  }
}
