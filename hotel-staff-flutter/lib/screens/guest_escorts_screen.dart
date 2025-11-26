import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:go_router/go_router.dart';
import '../providers/escort_provider.dart';
import '../models/escort.dart';
import '../models/guest.dart';
import '../utils/app_theme.dart';

class GuestEscortsScreen extends StatefulWidget {
  final Guest guest;

  const GuestEscortsScreen({super.key, required this.guest});

  @override
  State<GuestEscortsScreen> createState() => _GuestEscortsScreenState();
}

class _GuestEscortsScreenState extends State<GuestEscortsScreen> {
  @override
  void initState() {
    super.initState();
    // Load escorts for this guest
    WidgetsBinding.instance.addPostFrameCallback((_) {
      Provider.of<EscortProvider>(context, listen: false)
          .loadEscortsForGuest(widget.guest.id);
    });
  }

  void _showDeleteConfirmation(Escort escort) {
    showDialog(
      context: context,
      builder: (context) => AlertDialog(
        title: const Text('Delete Companion'),
        content: Text(
            'Are you sure you want to remove ${escort.fullName} from the companions list?'),
        actions: [
          TextButton(
            onPressed: () => Navigator.pop(context),
            child: const Text('Cancel'),
          ),
          ElevatedButton(
            onPressed: () async {
              Navigator.pop(context);
              final escortProvider =
                  Provider.of<EscortProvider>(context, listen: false);
              final success =
                  await escortProvider.deleteEscort(escort.id, widget.guest.id);
              if (success && mounted) {
                ScaffoldMessenger.of(context).showSnackBar(
                  const SnackBar(
                    content: Text('✅ Companion removed successfully'),
                    backgroundColor: Colors.green,
                  ),
                );
              }
            },
            style: ElevatedButton.styleFrom(
              backgroundColor: Colors.red,
              foregroundColor: Colors.white,
            ),
            child: const Text('Delete'),
          ),
        ],
      ),
    );
  }

  void _addEscort() async {
    // Navigate to escort registration screen
    final result = await context.push(
      '/guest/${widget.guest.id}/escorts/add',
      extra: {
        'guestId': widget.guest.id,
        'guestName': widget.guest.fullName,
      },
    );

    // Reload escorts if escort was added
    if (result == true && mounted) {
      Provider.of<EscortProvider>(context, listen: false)
          .loadEscortsForGuest(widget.guest.id);
    }
  }

  void _scanEscortDocument() {
    // Show info dialog about manual escort registration with scanning
    showDialog(
      context: context,
      builder: (context) => AlertDialog(
        title: const Row(
          children: [
            Icon(Icons.qr_code_scanner, color: AppTheme.primaryOrange),
            SizedBox(width: 12),
            Text('Scan Companion Document'),
          ],
        ),
        content: const Text(
          'To scan a companion\'s document:\n\n'
          '1. Click "Add Companion" button below\n'
          '2. On the registration form, scan their document first\n'
          '3. The form will auto-fill with scanned data\n'
          '4. Complete and submit the form\n\n'
          'This will register the companion for this guest.',
          style: TextStyle(fontSize: 15),
        ),
        actions: [
          TextButton(
            onPressed: () => Navigator.pop(context),
            child: const Text('Cancel'),
          ),
          ElevatedButton(
            onPressed: () {
              Navigator.pop(context);
              _addEscort(); // Go directly to registration
            },
            style: ElevatedButton.styleFrom(
              backgroundColor: AppTheme.primaryOrange,
              foregroundColor: Colors.white,
            ),
            child: const Text('Add Companion'),
          ),
        ],
      ),
    );
  }

  @override
  Widget build(BuildContext context) {
    final escortProvider = Provider.of<EscortProvider>(context);
    final escorts = escortProvider.getEscortsForGuest(widget.guest.id);
    final isLoading = escortProvider.isLoading;

    return Scaffold(
      appBar: AppBar(
        title: const Text('Companions'),
        actions: [
          IconButton(
            icon: const Icon(Icons.qr_code_scanner),
            tooltip: 'Scan Companion Document',
            onPressed: _scanEscortDocument,
          ),
        ],
      ),
      body: Column(
        children: [
          // Guest Info Card
          Container(
            margin: const EdgeInsets.fromLTRB(16, 16, 16, 12),
            padding: const EdgeInsets.all(14),
            decoration: BoxDecoration(
              color: AppTheme.primaryOrange,
              borderRadius: BorderRadius.circular(16),
            ),
            child: Row(
              children: [
                CircleAvatar(
                  radius: 24,
                  backgroundColor: Colors.white,
                  child: Text(
                    widget.guest.firstName[0].toUpperCase(),
                    style: const TextStyle(
                      fontSize: 20,
                      fontWeight: FontWeight.bold,
                      color: AppTheme.primaryOrange,
                    ),
                  ),
                ),
                const SizedBox(width: 12),
                Expanded(
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      Text(
                        widget.guest.fullName,
                        style: const TextStyle(
                          fontSize: 15,
                          fontWeight: FontWeight.bold,
                          color: Colors.white,
                        ),
                      ),
                      const SizedBox(height: 4),
                      Text(
                        widget.guest.roomNumber != null
                            ? 'Room ${widget.guest.roomNumber}'
                            : 'No room assigned',
                        style: const TextStyle(
                          fontSize: 12,
                          color: Colors.white,
                        ),
                      ),
                    ],
                  ),
                ),
                Container(
                  padding:
                      const EdgeInsets.symmetric(horizontal: 10, vertical: 6),
                  decoration: BoxDecoration(
                    color: Colors.white.withOpacity(0.25),
                    borderRadius: BorderRadius.circular(10),
                  ),
                  child: Text(
                    '${escorts.length} ${escorts.length == 1 ? 'Companion' : 'Companions'}',
                    style: const TextStyle(
                      fontSize: 11,
                      fontWeight: FontWeight.bold,
                      color: Colors.white,
                    ),
                  ),
                ),
              ],
            ),
          ),

          // Companions List
          Expanded(
            child: isLoading
                ? const Center(child: CircularProgressIndicator())
                : escorts.isEmpty
                    ? Center(
                        child: Column(
                          mainAxisAlignment: MainAxisAlignment.center,
                          children: [
                            Icon(
                              Icons.people_outline,
                              size: 80,
                              color: Colors.grey.shade300,
                            ),
                            const SizedBox(height: 16),
                            Text(
                              'No companions added yet',
                              style: TextStyle(
                                fontSize: 18,
                                color: Colors.grey.shade600,
                                fontWeight: FontWeight.w500,
                              ),
                            ),
                            const SizedBox(height: 8),
                            Text(
                              'Add companions for this guest',
                              style: TextStyle(
                                fontSize: 14,
                                color: Colors.grey.shade500,
                              ),
                            ),
                          ],
                        ),
                      )
                    : ListView.builder(
                        padding: const EdgeInsets.symmetric(horizontal: 16),
                        itemCount: escorts.length,
                        itemBuilder: (context, index) {
                          final escort = escorts[index];
                          return _EscortCard(
                            escort: escort,
                            onDelete: () => _showDeleteConfirmation(escort),
                          );
                        },
                      ),
          ),
        ],
      ),
      floatingActionButton: Column(
        mainAxisSize: MainAxisSize.min,
        children: [
          // Scan button
          FloatingActionButton(
            heroTag: 'scan_escort',
            onPressed: _scanEscortDocument,
            backgroundColor: Colors.blue,
            child: const Icon(Icons.qr_code_scanner),
          ),
          const SizedBox(height: 12),
          // Add manually button
          FloatingActionButton.extended(
            heroTag: 'add_escort',
            onPressed: _addEscort,
            backgroundColor: AppTheme.primaryOrange,
            icon: const Icon(Icons.add),
            label: const Text('Add Companion'),
          ),
        ],
      ),
    );
  }
}

class _EscortCard extends StatelessWidget {
  final Escort escort;
  final VoidCallback onDelete;

  const _EscortCard({
    required this.escort,
    required this.onDelete,
  });

  String _getRelationshipLabel(String? relationship) {
    switch (relationship) {
      case 'companion':
        return 'Companion';
      case 'family':
        return 'Family Member';
      case 'friend':
        return 'Friend';
      case 'business_associate':
        return 'Business Associate';
      default:
        return 'Other';
    }
  }

  IconData _getRelationshipIcon(String? relationship) {
    switch (relationship) {
      case 'companion':
        return Icons.person;
      case 'family':
        return Icons.family_restroom;
      case 'friend':
        return Icons.group;
      case 'business_associate':
        return Icons.business_center;
      default:
        return Icons.person_outline;
    }
  }

  @override
  Widget build(BuildContext context) {
    final hasInfo = escort.documentNumber != null ||
        escort.nationality != null ||
        escort.phone != null ||
        escort.email != null;

    return Container(
      margin: const EdgeInsets.only(bottom: 10),
      decoration: BoxDecoration(
        color: Colors.white,
        borderRadius: BorderRadius.circular(16),
        border: Border.all(color: Colors.grey[200]!, width: 1),
      ),
      child: Padding(
        padding: const EdgeInsets.all(14),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Row(
              children: [
                CircleAvatar(
                  radius: 22,
                  backgroundColor: AppTheme.primaryOrange,
                  child: Text(
                    escort.firstName[0].toUpperCase(),
                    style: const TextStyle(
                      fontSize: 18,
                      fontWeight: FontWeight.bold,
                      color: Colors.white,
                    ),
                  ),
                ),
                const SizedBox(width: 12),
                Expanded(
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      Text(
                        escort.fullName,
                        style: const TextStyle(
                          fontSize: 15,
                          fontWeight: FontWeight.bold,
                          color: Color(0xFF1F2937),
                        ),
                      ),
                      const SizedBox(height: 4),
                      Row(
                        children: [
                          Icon(
                            _getRelationshipIcon(escort.relationshipToGuest),
                            size: 12,
                            color: Colors.grey[600],
                          ),
                          const SizedBox(width: 4),
                          Text(
                            _getRelationshipLabel(escort.relationshipToGuest),
                            style: TextStyle(
                              fontSize: 11,
                              color: Colors.grey[600],
                              fontWeight: FontWeight.w500,
                            ),
                          ),
                        ],
                      ),
                    ],
                  ),
                ),
                Container(
                  width: 36,
                  height: 36,
                  decoration: BoxDecoration(
                    color: Colors.red[50],
                    borderRadius: BorderRadius.circular(8),
                  ),
                  child: IconButton(
                    icon: Icon(Icons.delete_outline,
                        color: Colors.red[700], size: 18),
                    onPressed: onDelete,
                    padding: EdgeInsets.zero,
                    constraints: const BoxConstraints(),
                  ),
                ),
              ],
            ),
            if (hasInfo) ...[
              const SizedBox(height: 12),
              Container(
                padding: const EdgeInsets.all(10),
                decoration: BoxDecoration(
                  color: Colors.grey[50],
                  borderRadius: BorderRadius.circular(10),
                ),
                child: Wrap(
                  spacing: 8,
                  runSpacing: 8,
                  children: [
                    if (escort.documentNumber != null)
                      _InfoChip(
                        icon: Icons.badge_outlined,
                        label: escort.documentNumber!,
                      ),
                    if (escort.nationality != null)
                      _InfoChip(
                        icon: Icons.flag_outlined,
                        label: escort.nationality!,
                      ),
                    if (escort.phone != null)
                      _InfoChip(
                        icon: Icons.phone_outlined,
                        label: escort.phone!,
                      ),
                    if (escort.email != null)
                      _InfoChip(
                        icon: Icons.email_outlined,
                        label: escort.email!,
                      ),
                  ],
                ),
              ),
            ],
          ],
        ),
      ),
    );
  }
}

class _InfoChip extends StatelessWidget {
  final IconData icon;
  final String label;

  const _InfoChip({
    required this.icon,
    required this.label,
  });

  @override
  Widget build(BuildContext context) {
    return Container(
      padding: const EdgeInsets.symmetric(horizontal: 8, vertical: 5),
      decoration: BoxDecoration(
        color: Colors.white,
        borderRadius: BorderRadius.circular(8),
        border: Border.all(color: Colors.grey[300]!, width: 1),
      ),
      child: Row(
        mainAxisSize: MainAxisSize.min,
        children: [
          Icon(icon, size: 12, color: Colors.grey[600]),
          const SizedBox(width: 4),
          Text(
            label,
            style: TextStyle(
              fontSize: 11,
              color: Colors.grey[700],
              fontWeight: FontWeight.w500,
            ),
          ),
        ],
      ),
    );
  }
}
