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
        title: const Text('Delete Escort'),
        content: Text(
            'Are you sure you want to remove ${escort.fullName} from the escorts list?'),
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
                    content: Text('✅ Escort removed successfully'),
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
            Text('Scan Escort Document'),
          ],
        ),
        content: const Text(
          'To scan an escort\'s document:\n\n'
          '1. Click "Add Escort" button below\n'
          '2. On the registration form, scan their document first\n'
          '3. The form will auto-fill with scanned data\n'
          '4. Complete and submit the form\n\n'
          'This will register the escort for this guest.',
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
            child: const Text('Add Escort'),
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
        title: const Text('Escorts & Companions'),
        actions: [
          IconButton(
            icon: const Icon(Icons.qr_code_scanner),
            tooltip: 'Scan Escort Document',
            onPressed: _scanEscortDocument,
          ),
        ],
      ),
      body: Column(
        children: [
          // Guest Info Card
          Container(
            margin: const EdgeInsets.all(16),
            padding: const EdgeInsets.all(16),
            decoration: BoxDecoration(
              gradient: const LinearGradient(
                begin: Alignment.topLeft,
                end: Alignment.bottomRight,
                colors: [
                  AppTheme.primaryOrange,
                  AppTheme.secondaryOrange,
                ],
              ),
              borderRadius: BorderRadius.circular(12),
              boxShadow: [
                BoxShadow(
                  color: AppTheme.primaryOrange.withOpacity(0.3),
                  blurRadius: 8,
                  offset: const Offset(0, 4),
                ),
              ],
            ),
            child: Row(
              children: [
                CircleAvatar(
                  radius: 30,
                  backgroundColor: Colors.white,
                  child: Text(
                    widget.guest.firstName[0].toUpperCase(),
                    style: const TextStyle(
                      fontSize: 24,
                      fontWeight: FontWeight.bold,
                      color: AppTheme.primaryOrange,
                    ),
                  ),
                ),
                const SizedBox(width: 16),
                Expanded(
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      Text(
                        widget.guest.fullName,
                        style: const TextStyle(
                          fontSize: 18,
                          fontWeight: FontWeight.bold,
                          color: Colors.white,
                        ),
                      ),
                      const SizedBox(height: 4),
                      Text(
                        widget.guest.roomNumber != null
                            ? 'Room ${widget.guest.roomNumber}'
                            : 'No room assigned',
                        style: TextStyle(
                          fontSize: 14,
                          color: Colors.white.withOpacity(0.9),
                        ),
                      ),
                      const SizedBox(height: 4),
                      Container(
                        padding: const EdgeInsets.symmetric(
                            horizontal: 8, vertical: 4),
                        decoration: BoxDecoration(
                          color: Colors.white.withOpacity(0.2),
                          borderRadius: BorderRadius.circular(12),
                        ),
                        child: Text(
                          '${escorts.length} ${escorts.length == 1 ? 'Escort' : 'Escorts'}',
                          style: const TextStyle(
                            fontSize: 12,
                            fontWeight: FontWeight.w600,
                            color: Colors.white,
                          ),
                        ),
                      ),
                    ],
                  ),
                ),
              ],
            ),
          ),

          // Escorts List
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
                              'No escorts added yet',
                              style: TextStyle(
                                fontSize: 18,
                                color: Colors.grey.shade600,
                                fontWeight: FontWeight.w500,
                              ),
                            ),
                            const SizedBox(height: 8),
                            Text(
                              'Add companions or escorts for this guest',
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
            label: const Text('Add Escort'),
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
    return Card(
      margin: const EdgeInsets.only(bottom: 12),
      elevation: 2,
      shape: RoundedRectangleBorder(
        borderRadius: BorderRadius.circular(12),
      ),
      child: Padding(
        padding: const EdgeInsets.all(16),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Row(
              children: [
                CircleAvatar(
                  radius: 24,
                  backgroundColor: AppTheme.primaryOrange.withOpacity(0.1),
                  child: Text(
                    escort.firstName[0].toUpperCase(),
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
                        escort.fullName,
                        style: const TextStyle(
                          fontSize: 16,
                          fontWeight: FontWeight.bold,
                        ),
                      ),
                      const SizedBox(height: 4),
                      Row(
                        children: [
                          Icon(
                            _getRelationshipIcon(escort.relationshipToGuest),
                            size: 14,
                            color: Colors.grey.shade600,
                          ),
                          const SizedBox(width: 4),
                          Text(
                            _getRelationshipLabel(escort.relationshipToGuest),
                            style: TextStyle(
                              fontSize: 13,
                              color: Colors.grey.shade600,
                            ),
                          ),
                        ],
                      ),
                    ],
                  ),
                ),
                IconButton(
                  icon: const Icon(Icons.delete_outline, color: Colors.red),
                  onPressed: onDelete,
                ),
              ],
            ),
            if (escort.documentNumber != null ||
                escort.nationality != null ||
                escort.phone != null) ...[
              const Divider(height: 24),
              Wrap(
                spacing: 16,
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
      padding: const EdgeInsets.symmetric(horizontal: 10, vertical: 6),
      decoration: BoxDecoration(
        color: Colors.grey.shade100,
        borderRadius: BorderRadius.circular(16),
      ),
      child: Row(
        mainAxisSize: MainAxisSize.min,
        children: [
          Icon(icon, size: 14, color: Colors.grey.shade700),
          const SizedBox(width: 4),
          Text(
            label,
            style: TextStyle(
              fontSize: 12,
              color: Colors.grey.shade700,
            ),
          ),
        ],
      ),
    );
  }
}
