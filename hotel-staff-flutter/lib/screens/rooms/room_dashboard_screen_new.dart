// import 'package:flutter/material.dart';
// import 'package:provider/provider.dart';
// import '../../providers/room_provider.dart';
// import '../../models/room.dart';
// import 'room_details_screen.dart';
// import 'today_activity_screen.dart';

// class RoomDashboardScreen extends StatefulWidget {
//   const RoomDashboardScreen({Key? key}) : super(key: key);

//   @override
//   State<RoomDashboardScreen> createState() => _RoomDashboardScreenState();
// }

// class _RoomDashboardScreenState extends State<RoomDashboardScreen> {
//   @override
//   void initState() {
//     super.initState();
//     WidgetsBinding.instance.addPostFrameCallback((_) {
//       context.read<RoomProvider>().loadAll();
//     });
//   }

//   @override
//   Widget build(BuildContext context) {
//     return Scaffold(
//       backgroundColor: Colors.grey[100],
//       appBar: AppBar(
//         elevation: 0,
//         backgroundColor: Colors.white,
//         foregroundColor: Colors.black87,
//         title: const Text(
//           'Room Management',
//           style: TextStyle(fontWeight: FontWeight.w600),
//         ),
//         actions: [
//           IconButton(
//             icon: Container(
//               padding: const EdgeInsets.all(8),
//               decoration: BoxDecoration(
//                 color: Colors.blue[50],
//                 borderRadius: BorderRadius.circular(8),
//               ),
//               child: const Icon(Icons.calendar_today, size: 20),
//             ),
//             onPressed: () {
//               Navigator.push(
//                 context,
//                 MaterialPageRoute(
//                   builder: (context) => const TodayActivityScreen(),
//                 ),
//               );
//             },
//             tooltip: 'Today\'s Activity',
//           ),
//           IconButton(
//             icon: const Icon(Icons.refresh),
//             onPressed: () {
//               context.read<RoomProvider>().refresh();
//             },
//             tooltip: 'Refresh',
//           ),
//           const SizedBox(width: 8),
//         ],
//       ),
//       body: Consumer<RoomProvider>(
//         builder: (context, provider, child) {
//           if (provider.isLoading && provider.rooms.isEmpty) {
//             return const Center(child: CircularProgressIndicator());
//           }

//           if (provider.error != null) {
//             return Center(
//               child: Column(
//                 mainAxisAlignment: MainAxisAlignment.center,
//                 children: [
//                   Icon(Icons.error_outline, size: 64, color: Colors.red[300]),
//                   const SizedBox(height: 16),
//                   const Text(
//                     'Failed to load rooms',
//                     style: TextStyle(fontSize: 18, fontWeight: FontWeight.w600),
//                   ),
//                   const SizedBox(height: 8),
//                   Padding(
//                     padding: const EdgeInsets.symmetric(horizontal: 32),
//                     child: Text(
//                       provider.error!,
//                       textAlign: TextAlign.center,
//                       style: TextStyle(color: Colors.grey[600]),
//                     ),
//                   ),
//                   const SizedBox(height: 16),
//                   ElevatedButton.icon(
//                     onPressed: () => provider.refresh(),
//                     icon: const Icon(Icons.refresh),
//                     label: const Text('Retry'),
//                     style: ElevatedButton.styleFrom(
//                       padding: const EdgeInsets.symmetric(
//                         horizontal: 24,
//                         vertical: 12,
//                       ),
//                     ),
//                   ),
//                 ],
//               ),
//             );
//           }

//           return RefreshIndicator(
//             onRefresh: () => provider.refresh(),
//             child: CustomScrollView(
//               slivers: [
//                 // Statistics Cards
//                 if (provider.statistics != null)
//                   SliverToBoxAdapter(
//                     child: _buildStatisticsSection(provider),
//                   ),

//                 // Filter Chips
//                 SliverToBoxAdapter(
//                   child: _buildFilterSection(provider),
//                 ),

//                 // Room Grid
//                 provider.rooms.isEmpty
//                     ? SliverFillRemaining(
//                         child: Center(
//                           child: Column(
//                             mainAxisAlignment: MainAxisAlignment.center,
//                             children: [
//                               Icon(
//                                 Icons.meeting_room_outlined,
//                                 size: 64,
//                                 color: Colors.grey[400],
//                               ),
//                               const SizedBox(height: 16),
//                               Text(
//                                 'No rooms found',
//                                 style: TextStyle(
//                                   fontSize: 16,
//                                   color: Colors.grey[600],
//                                 ),
//                               ),
//                             ],
//                           ),
//                         ),
//                       )
//                     : SliverPadding(
//                         padding: const EdgeInsets.all(16),
//                         sliver: SliverGrid(
//                           gridDelegate:
//                               const SliverGridDelegateWithFixedCrossAxisCount(
//                             crossAxisCount: 2,
//                             childAspectRatio: 0.72,
//                             crossAxisSpacing: 12,
//                             mainAxisSpacing: 12,
//                           ),
//                           delegate: SliverChildBuilderDelegate(
//                             (context, index) {
//                               return _buildRoomCard(
//                                   context, provider.rooms[index]);
//                             },
//                             childCount: provider.rooms.length,
//                           ),
//                         ),
//                       ),
//               ],
//             ),
//           );
//         },
//       ),
//     );
//   }

//   Widget _buildStatisticsSection(RoomProvider provider) {
//     final stats = provider.statistics!;

//     return Container(
//       padding: const EdgeInsets.all(16),
//       child: Column(
//         crossAxisAlignment: CrossAxisAlignment.start,
//         children: [
//           const Text(
//             'Overview',
//             style: TextStyle(
//               fontSize: 20,
//               fontWeight: FontWeight.bold,
//             ),
//           ),
//           const SizedBox(height: 12),
//           Row(
//             children: [
//               Expanded(
//                 child: _buildStatCard(
//                   'Total Rooms',
//                   stats.totalRooms.toString(),
//                   Icons.meeting_room_rounded,
//                   Colors.blue,
//                 ),
//               ),
//               const SizedBox(width: 8),
//               Expanded(
//                 child: _buildStatCard(
//                   'Occupancy',
//                   '${stats.occupancyRate.toStringAsFixed(0)}%',
//                   Icons.pie_chart_rounded,
//                   Colors.purple,
//                 ),
//               ),
//             ],
//           ),
//           const SizedBox(height: 8),
//           Row(
//             children: [
//               Expanded(
//                 child: _buildStatCard(
//                   'Available',
//                   stats.availableRooms.toString(),
//                   Icons.check_circle_rounded,
//                   Colors.green,
//                 ),
//               ),
//               const SizedBox(width: 8),
//               Expanded(
//                 child: _buildStatCard(
//                   'Occupied',
//                   stats.occupiedRooms.toString(),
//                   Icons.person_rounded,
//                   Colors.orange,
//                 ),
//               ),
//             ],
//           ),
//         ],
//       ),
//     );
//   }

//   Widget _buildStatCard(
//       String label, String value, IconData icon, Color color) {
//     return Container(
//       padding: const EdgeInsets.all(16),
//       decoration: BoxDecoration(
//         color: Colors.white,
//         borderRadius: BorderRadius.circular(12),
//         boxShadow: [
//           BoxShadow(
//             color: Colors.black.withValues(alpha: 0.05),
//             blurRadius: 10,
//             offset: const Offset(0, 2),
//           ),
//         ],
//       ),
//       child: Column(
//         children: [
//           Icon(icon, color: color, size: 32),
//           const SizedBox(height: 8),
//           Text(
//             value,
//             style: TextStyle(
//               fontSize: 22,
//               fontWeight: FontWeight.bold,
//               color: color,
//             ),
//           ),
//           Text(
//             label,
//             style: TextStyle(
//               fontSize: 11,
//               color: Colors.grey[600],
//             ),
//             textAlign: TextAlign.center,
//           ),
//         ],
//       ),
//     );
//   }

//   Widget _buildFilterSection(RoomProvider provider) {
//     final counts = provider.statusCounts;

//     return Container(
//       padding: const EdgeInsets.symmetric(vertical: 12),
//       child: SingleChildScrollView(
//         scrollDirection: Axis.horizontal,
//         padding: const EdgeInsets.symmetric(horizontal: 16),
//         child: Row(
//           children: [
//             _buildFilterChip(
//               'All',
//               counts['all'] ?? 0,
//               provider.selectedFilter == 'all',
//               () => provider.setFilter('all'),
//               Colors.grey,
//             ),
//             _buildFilterChip(
//               'Available',
//               counts['available'] ?? 0,
//               provider.selectedFilter == 'available',
//               () => provider.setFilter('available'),
//               Colors.green,
//             ),
//             _buildFilterChip(
//               'Occupied',
//               counts['occupied'] ?? 0,
//               provider.selectedFilter == 'occupied',
//               () => provider.setFilter('occupied'),
//               Colors.orange,
//             ),
//             _buildFilterChip(
//               'Cleaning',
//               counts['cleaning'] ?? 0,
//               provider.selectedFilter == 'cleaning',
//               () => provider.setFilter('cleaning'),
//               Colors.blue,
//             ),
//             _buildFilterChip(
//               'Maintenance',
//               counts['maintenance'] ?? 0,
//               provider.selectedFilter == 'maintenance',
//               () => provider.setFilter('maintenance'),
//               Colors.red,
//             ),
//           ],
//         ),
//       ),
//     );
//   }

//   Widget _buildFilterChip(
//     String label,
//     int count,
//     bool selected,
//     VoidCallback onTap,
//     Color color,
//   ) {
//     return Padding(
//       padding: const EdgeInsets.only(right: 8),
//       child: FilterChip(
//         label: Text(
//           '$label ($count)',
//           style: TextStyle(
//             color: selected ? Colors.white : color,
//             fontWeight: selected ? FontWeight.w600 : FontWeight.normal,
//           ),
//         ),
//         selected: selected,
//         onSelected: (_) => onTap(),
//         backgroundColor: color.withValues(alpha: 0.1),
//         selectedColor: color,
//         showCheckmark: false,
//       ),
//     );
//   }

//   Widget _buildRoomCard(BuildContext context, Room room) {
//     final statusColor = _getStatusColor(room.currentStatus);
//     final statusIcon = _getStatusIcon(room.currentStatus);

//     return Material(
//       color: Colors.white,
//       borderRadius: BorderRadius.circular(16),
//       elevation: 2,
//       shadowColor: statusColor.withValues(alpha: 0.2),
//       child: InkWell(
//         onTap: () {
//           Navigator.push(
//             context,
//             MaterialPageRoute(
//               builder: (context) => RoomDetailsScreen(room: room),
//             ),
//           );
//         },
//         borderRadius: BorderRadius.circular(16),
//         child: Container(
//           decoration: BoxDecoration(
//             borderRadius: BorderRadius.circular(16),
//             border: Border.all(
//               color: statusColor.withValues(alpha: 0.3),
//               width: 2,
//             ),
//           ),
//           child: Column(
//             crossAxisAlignment: CrossAxisAlignment.start,
//             children: [
//               // Header
//               Container(
//                 padding: const EdgeInsets.all(12),
//                 decoration: BoxDecoration(
//                   color: statusColor.withValues(alpha: 0.1),
//                   borderRadius: const BorderRadius.only(
//                     topLeft: Radius.circular(14),
//                     topRight: Radius.circular(14),
//                   ),
//                 ),
//                 child: Row(
//                   children: [
//                     Container(
//                       padding: const EdgeInsets.all(8),
//                       decoration: BoxDecoration(
//                         color: statusColor.withValues(alpha: 0.2),
//                         borderRadius: BorderRadius.circular(8),
//                       ),
//                       child: Icon(
//                         Icons.meeting_room_rounded,
//                         color: statusColor,
//                         size: 24,
//                       ),
//                     ),
//                     const SizedBox(width: 10),
//                     Expanded(
//                       child: Column(
//                         crossAxisAlignment: CrossAxisAlignment.start,
//                         children: [
//                           Text(
//                             room.roomNum,
//                             style: const TextStyle(
//                               fontSize: 18,
//                               fontWeight: FontWeight.bold,
//                             ),
//                           ),
//                         ],
//                       ),
//                     ),
//                     Container(
//                       padding: const EdgeInsets.symmetric(
//                         horizontal: 8,
//                         vertical: 4,
//                       ),
//                       decoration: BoxDecoration(
//                         color: statusColor,
//                         borderRadius: BorderRadius.circular(12),
//                       ),
//                       child: Row(
//                         mainAxisSize: MainAxisSize.min,
//                         children: [
//                           Icon(
//                             statusIcon,
//                             color: Colors.white,
//                             size: 10,
//                           ),
//                           const SizedBox(width: 3),
//                           Text(
//                             room.statusDisplayName,
//                             style: const TextStyle(
//                               color: Colors.white,
//                               fontSize: 9,
//                               fontWeight: FontWeight.w600,
//                             ),
//                           ),
//                         ],
//                       ),
//                     ),
//                   ],
//                 ),
//               ),

//               // Body
//               Expanded(
//                 child: Padding(
//                   padding: const EdgeInsets.all(12),
//                   child: Column(
//                     crossAxisAlignment: CrossAxisAlignment.start,
//                     children: [
//                       Text(
//                         room.roomTypeName,
//                         style: TextStyle(
//                           fontSize: 13,
//                           fontWeight: FontWeight.w600,
//                           color: Colors.grey[700],
//                         ),
//                         maxLines: 2,
//                         overflow: TextOverflow.ellipsis,
//                       ),
//                       const SizedBox(height: 6),

//                       if (room.floor != null)
//                         Row(
//                           children: [
//                             Icon(
//                               Icons.layers_outlined,
//                               size: 14,
//                               color: Colors.grey[500],
//                             ),
//                             const SizedBox(width: 4),
//                             Text(
//                               'Floor ${room.floor}',
//                               style: TextStyle(
//                                 fontSize: 12,
//                                 color: Colors.grey[600],
//                               ),
//                             ),
//                           ],
//                         ),

//                       const Spacer(),

//                       // Guest Info or Status
//                       if (room.isOccupiedStatus && room.guestName != null) ...[
//                         Divider(color: Colors.grey[300]),
//                         Container(
//                           padding: const EdgeInsets.all(8),
//                           decoration: BoxDecoration(
//                             color: Colors.orange[50],
//                             borderRadius: BorderRadius.circular(8),
//                           ),
//                           child: Column(
//                             crossAxisAlignment: CrossAxisAlignment.start,
//                             mainAxisSize: MainAxisSize.min,
//                             children: [
//                               Row(
//                                 children: [
//                                   Icon(
//                                     Icons.person_rounded,
//                                     size: 12,
//                                     color: Colors.orange[700],
//                                   ),
//                                   const SizedBox(width: 4),
//                                   Expanded(
//                                     child: Text(
//                                       room.guestName!,
//                                       style: TextStyle(
//                                         fontSize: 10,
//                                         fontWeight: FontWeight.w600,
//                                         color: Colors.orange[900],
//                                       ),
//                                       maxLines: 1,
//                                       overflow: TextOverflow.ellipsis,
//                                     ),
//                                   ),
//                                 ],
//                               ),
//                               if (room.checkOutDate != null) ...[
//                                 const SizedBox(height: 4),
//                                 Row(
//                                   children: [
//                                     Icon(
//                                       Icons.event_outlined,
//                                       size: 10,
//                                       color: Colors.orange[700],
//                                     ),
//                                     const SizedBox(width: 4),
//                                     Text(
//                                       'Out: ${_formatDate(room.checkOutDate!)}',
//                                       style: TextStyle(
//                                         fontSize: 9,
//                                         color: Colors.orange[700],
//                                       ),
//                                     ),
//                                   ],
//                                 ),
//                               ],
//                             ],
//                           ),
//                         ),
//                       ] else ...[
//                         Container(
//                           width: double.infinity,
//                           padding: const EdgeInsets.symmetric(vertical: 8),
//                           decoration: BoxDecoration(
//                             color: statusColor.withValues(alpha: 0.08),
//                             borderRadius: BorderRadius.circular(8),
//                           ),
//                           child: Row(
//                             mainAxisAlignment: MainAxisAlignment.center,
//                             children: [
//                               Icon(
//                                 statusIcon,
//                                 size: 12,
//                                 color: statusColor,
//                               ),
//                               const SizedBox(width: 6),
//                               Text(
//                                 room.currentStatus == 'available'
//                                     ? 'Ready'
//                                     : room.statusDisplayName,
//                                 style: TextStyle(
//                                   fontSize: 11,
//                                   fontWeight: FontWeight.w600,
//                                   color: statusColor,
//                                 ),
//                               ),
//                             ],
//                           ),
//                         ),
//                       ],
//                     ],
//                   ),
//                 ),
//               ),
//             ],
//           ),
//         ),
//       ),
//     );
//   }

//   IconData _getStatusIcon(String status) {
//     switch (status) {
//       case 'available':
//         return Icons.check_circle;
//       case 'occupied':
//         return Icons.person;
//       case 'cleaning':
//         return Icons.cleaning_services;
//       case 'maintenance':
//         return Icons.build;
//       default:
//         return Icons.meeting_room;
//     }
//   }

//   Color _getStatusColor(String status) {
//     switch (status) {
//       case 'available':
//         return Colors.green;
//       case 'occupied':
//         return Colors.orange;
//       case 'cleaning':
//         return Colors.blue;
//       case 'maintenance':
//         return Colors.red;
//       default:
//         return Colors.grey;
//     }
//   }

//   String _formatDate(String dateString) {
//     try {
//       final date = DateTime.parse(dateString);
//       return '${date.month}/${date.day}';
//     } catch (e) {
//       return dateString;
//     }
//   }
// }
