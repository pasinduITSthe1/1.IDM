import 'package:flutter/material.dart';
import 'package:go_router/go_router.dart';
import 'package:shared_preferences/shared_preferences.dart';

class MenuScreen extends StatelessWidget {
  const MenuScreen({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Menu'),
      ),
      body: ListView(
        padding: const EdgeInsets.all(16),
        children: [
          _buildSection(
            'Operations',
            [
              _buildMenuItem(
                context,
                icon: Icons.person_add,
                title: 'Register Guest',
                subtitle: 'Scan MRZ and register new guest',
                onTap: () => context.go('/mrz-scanner'),
              ),
              _buildMenuItem(
                context,
                icon: Icons.login,
                title: 'Check-In',
                subtitle: 'Check in registered guests',
                onTap: () => context.go('/check-in'),
              ),
              _buildMenuItem(
                context,
                icon: Icons.logout,
                title: 'Check-Out',
                subtitle: 'Process guest check-out',
                onTap: () => context.go('/check-out'),
              ),
            ],
          ),
          const SizedBox(height: 24),
          _buildSection(
            'Management',
            [
              _buildMenuItem(
                context,
                icon: Icons.people,
                title: 'All Guests',
                subtitle: 'View and manage guests',
                onTap: () => context.go('/guest-list'),
              ),
              _buildMenuItem(
                context,
                icon: Icons.meeting_room,
                title: 'Room Management',
                subtitle: 'Manage room status',
                onTap: () => context.go('/rooms'),
              ),
            ],
          ),
          const SizedBox(height: 24),
          _buildSection(
            'Settings',
            [
              _buildMenuItem(
                context,
                icon: Icons.settings,
                title: 'Settings',
                subtitle: 'App preferences',
                onTap: () {
                  ScaffoldMessenger.of(context).showSnackBar(
                    const SnackBar(content: Text('Settings coming soon')),
                  );
                },
              ),
            ],
          ),
          const SizedBox(height: 32),
          _buildLogoutButton(context),
        ],
      ),
    );
  }

  Widget _buildSection(String title, List<Widget> children) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Padding(
          padding: const EdgeInsets.only(left: 16, bottom: 12),
          child: Text(
            title,
            style: const TextStyle(
              fontSize: 14,
              fontWeight: FontWeight.w600,
              color: Colors.grey,
            ),
          ),
        ),
        Card(
          elevation: 0,
          shape: RoundedRectangleBorder(
            borderRadius: BorderRadius.circular(12),
            side: BorderSide(color: Colors.grey[200]!),
          ),
          child: Column(children: children),
        ),
      ],
    );
  }

  Widget _buildMenuItem(
    BuildContext context, {
    required IconData icon,
    required String title,
    required String subtitle,
    required VoidCallback onTap,
  }) {
    return ListTile(
      leading: Container(
        width: 48,
        height: 48,
        decoration: BoxDecoration(
          color: const Color(0xFFFF6B35).withOpacity(0.1),
          borderRadius: BorderRadius.circular(12),
        ),
        child: Icon(icon, color: const Color(0xFFFF6B35)),
      ),
      title: Text(title, style: const TextStyle(fontWeight: FontWeight.w500)),
      subtitle: Text(subtitle,
          style: TextStyle(fontSize: 13, color: Colors.grey[600])),
      trailing: const Icon(Icons.chevron_right, color: Colors.grey),
      onTap: onTap,
    );
  }

  Widget _buildLogoutButton(BuildContext context) {
    return Padding(
      padding: const EdgeInsets.symmetric(horizontal: 16),
      child: OutlinedButton.icon(
        onPressed: () async {
          final confirmed = await showDialog<bool>(
            context: context,
            builder: (context) => AlertDialog(
              title: const Text('Logout'),
              content: const Text('Are you sure you want to logout?'),
              actions: [
                TextButton(
                  onPressed: () => Navigator.pop(context, false),
                  child: const Text('Cancel'),
                ),
                TextButton(
                  onPressed: () => Navigator.pop(context, true),
                  child: const Text('Logout'),
                ),
              ],
            ),
          );

          if (confirmed == true && context.mounted) {
            final prefs = await SharedPreferences.getInstance();
            await prefs.clear();
            if (context.mounted) {
              context.go('/login');
            }
          }
        },
        icon: const Icon(Icons.logout),
        label: const Text('Logout'),
        style: OutlinedButton.styleFrom(
          foregroundColor: Colors.red,
          side: const BorderSide(color: Colors.red),
          padding: const EdgeInsets.symmetric(vertical: 12),
        ),
      ),
    );
  }
}
