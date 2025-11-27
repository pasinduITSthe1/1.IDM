import 'package:flutter/material.dart';
import 'package:go_router/go_router.dart';
import 'package:provider/provider.dart';
import '../providers/auth_provider.dart';
import '../providers/theme_provider.dart';

class MenuScreen extends StatelessWidget {
  const MenuScreen({super.key});

  @override
  Widget build(BuildContext context) {
    final authProvider = Provider.of<AuthProvider>(context);
    final themeProvider = Provider.of<ThemeProvider>(context);
    final isDark = Theme.of(context).brightness == Brightness.dark;

    return Scaffold(
      backgroundColor: isDark ? const Color(0xFF121212) : Colors.grey.shade50,
      body: SafeArea(
        child: SingleChildScrollView(
          child: Column(
            children: [
              // Header Section - matching dashboard design
              Container(
                width: double.infinity,
                color: isDark ? const Color(0xFF1E1E1E) : Colors.white,
                padding: const EdgeInsets.all(20),
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    Row(
                      children: [
                        Image.asset('assets/images/logo_1.png',
                            height: 40, width: 48, fit: BoxFit.contain),
                        const SizedBox(width: 12),
                        Expanded(
                          child: Column(
                            crossAxisAlignment: CrossAxisAlignment.start,
                            children: [
                              Text('Hotel Staff',
                                  style: TextStyle(
                                      fontSize: 18,
                                      fontWeight: FontWeight.w800,
                                      color: isDark
                                          ? const Color(0xFFE1E1E1)
                                          : const Color(0xFF1A1A1A),
                                      letterSpacing: -0.3)),
                              Text(authProvider.userName ?? 'Staff Member',
                                  style: TextStyle(
                                      fontSize: 12,
                                      color: isDark
                                          ? const Color(0xFFB0B0B0)
                                          : Colors.grey.shade600,
                                      fontWeight: FontWeight.w500)),
                            ],
                          ),
                        ),
                      ],
                    ),
                    const SizedBox(height: 24),
                    Text('Menu',
                        style: TextStyle(
                            fontSize: 28,
                            fontWeight: FontWeight.w900,
                            color: isDark
                                ? const Color(0xFFE1E1E1)
                                : Colors.grey.shade900,
                            letterSpacing: -0.8,
                            height: 1.1)),
                    const SizedBox(height: 4),
                    Text('Access all hotel management features',
                        style: TextStyle(
                            fontSize: 13,
                            color: isDark
                                ? const Color(0xFFB0B0B0)
                                : Colors.grey.shade600,
                            fontWeight: FontWeight.w500)),
                  ],
                ),
              ),

              // Content Section
              Padding(
                padding: const EdgeInsets.all(16),
                child: Column(
                  children: [
                    // Management Section
                    _buildSection(
                      context,
                      'Management',
                      [
                        _buildOutlinedMenuItem(
                          context,
                          icon: Icons.people_rounded,
                          title: 'All Guests',
                          subtitle: 'View and manage guest records',
                          onTap: () => context.go('/guest-list'),
                        ),
                        const SizedBox(height: 12),
                        _buildOutlinedMenuItem(
                          context,
                          icon: Icons.meeting_room_rounded,
                          title: 'Room Management',
                          subtitle: 'Monitor room status and availability',
                          onTap: () => context.go('/rooms'),
                        ),
                      ],
                    ),

                    const SizedBox(height: 24),

                    // Reports & Analytics Section
                    _buildSection(
                      context,
                      'Reports & Analytics',
                      [
                        _buildOutlinedMenuItem(
                          context,
                          icon: Icons.analytics_rounded,
                          title: 'Generate Reports',
                          subtitle: 'Guest reports, occupancy & revenue',
                          onTap: () => _showReportsDialog(context),
                        ),
                        const SizedBox(height: 12),
                        _buildOutlinedMenuItem(
                          context,
                          icon: Icons.timeline_rounded,
                          title: 'Occupancy Trends',
                          subtitle: 'View booking trends and statistics',
                          onTap: () =>
                              _showComingSoon(context, 'Occupancy Trends'),
                        ),
                      ],
                    ),

                    const SizedBox(height: 24),

                    // Settings & Support Section
                    _buildSection(
                      context,
                      'Settings & Support',
                      [
                        _buildThemeToggle(context, themeProvider, isDark),
                        const SizedBox(height: 12),
                        _buildOutlinedMenuItem(
                          context,
                          icon: Icons.settings_rounded,
                          title: 'App Settings',
                          subtitle: 'Preferences and configurations',
                          onTap: () => _showComingSoon(context, 'Settings'),
                        ),
                        const SizedBox(height: 12),
                        _buildOutlinedMenuItem(
                          context,
                          icon: Icons.privacy_tip_rounded,
                          title: 'Privacy Policy',
                          subtitle: 'Data usage and privacy terms',
                          onTap: () => _showPrivacyPolicy(context),
                        ),
                        const SizedBox(height: 12),
                        _buildOutlinedMenuItem(
                          context,
                          icon: Icons.help_outline_rounded,
                          title: 'Help & Support',
                          subtitle: 'Get help and contact support',
                          onTap: () => _showHelpDialog(context),
                        ),
                        const SizedBox(height: 12),
                        _buildOutlinedMenuItem(
                          context,
                          icon: Icons.info_outline_rounded,
                          title: 'About',
                          subtitle: 'App version and information',
                          onTap: () => _showAboutDialog(context),
                        ),
                      ],
                    ),

                    const SizedBox(height: 32),

                    // Logout Button
                    _buildLogoutButton(context),
                    const SizedBox(height: 16),
                  ],
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }

  Widget _buildSection(
      BuildContext context, String title, List<Widget> children) {
    final isDark = Theme.of(context).brightness == Brightness.dark;
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Padding(
          padding: const EdgeInsets.only(left: 4, bottom: 12),
          child: Text(
            title,
            style: TextStyle(
              fontSize: 16,
              fontWeight: FontWeight.bold,
              color: isDark ? const Color(0xFFE1E1E1) : const Color(0xFF2D3436),
            ),
          ),
        ),
        Column(children: children),
      ],
    );
  }

  Widget _buildThemeToggle(
      BuildContext context, ThemeProvider themeProvider, bool isDark) {
    return Container(
      padding: const EdgeInsets.all(16),
      decoration: BoxDecoration(
        color: isDark ? const Color(0xFF2C2C2C) : Colors.white,
        borderRadius: BorderRadius.circular(14),
        border: Border.all(
          color: isDark ? const Color(0xFF404040) : Colors.grey.shade300,
          width: 2,
        ),
        boxShadow: [
          BoxShadow(
            color: Colors.grey.withOpacity(isDark ? 0.02 : 0.08),
            blurRadius: 8,
            offset: const Offset(0, 3),
          ),
        ],
      ),
      child: Row(
        children: [
          Container(
            padding: const EdgeInsets.all(10),
            decoration: BoxDecoration(
              color: const Color(0xFFFF6B35).withOpacity(0.1),
              borderRadius: BorderRadius.circular(10),
            ),
            child: Icon(
              isDark ? Icons.dark_mode_rounded : Icons.light_mode_rounded,
              color: const Color(0xFFFF6B35),
              size: 24,
            ),
          ),
          const SizedBox(width: 14),
          Expanded(
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text(
                  'Dark Mode',
                  style: TextStyle(
                    fontSize: 15,
                    fontWeight: FontWeight.bold,
                    color: isDark
                        ? const Color(0xFFE1E1E1)
                        : const Color(0xFF2D3436),
                  ),
                ),
                const SizedBox(height: 2),
                Text(
                  isDark ? 'Switch to light theme' : 'Switch to dark theme',
                  style: TextStyle(
                    fontSize: 11,
                    color:
                        isDark ? const Color(0xFFB0B0B0) : Colors.grey.shade600,
                  ),
                ),
              ],
            ),
          ),
          Switch(
            value: themeProvider.isDarkMode,
            onChanged: (value) => themeProvider.toggleTheme(),
            activeColor: const Color(0xFFFF6B35),
          ),
        ],
      ),
    );
  }

  Widget _buildOutlinedMenuItem(
    BuildContext context, {
    required IconData icon,
    required String title,
    required String subtitle,
    required VoidCallback onTap,
  }) {
    final isDark = Theme.of(context).brightness == Brightness.dark;
    return InkWell(
      onTap: onTap,
      borderRadius: BorderRadius.circular(14),
      child: Container(
        padding: const EdgeInsets.all(16),
        decoration: BoxDecoration(
          color: isDark ? const Color(0xFF2C2C2C) : Colors.white,
          borderRadius: BorderRadius.circular(14),
          border: Border.all(
            color: isDark ? const Color(0xFF404040) : Colors.grey.shade300,
            width: 2,
          ),
          boxShadow: [
            BoxShadow(
              color: Colors.grey.withOpacity(isDark ? 0.02 : 0.08),
              blurRadius: 8,
              offset: const Offset(0, 3),
            ),
          ],
        ),
        child: Row(
          children: [
            Container(
              padding: const EdgeInsets.all(10),
              decoration: BoxDecoration(
                color: const Color(0xFFFF6B35).withOpacity(0.1),
                borderRadius: BorderRadius.circular(10),
              ),
              child: Icon(icon, color: const Color(0xFFFF6B35), size: 24),
            ),
            const SizedBox(width: 14),
            Expanded(
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Text(
                    title,
                    style: TextStyle(
                      fontSize: 15,
                      fontWeight: FontWeight.bold,
                      color: isDark
                          ? const Color(0xFFE1E1E1)
                          : const Color(0xFF2D3436),
                    ),
                  ),
                  const SizedBox(height: 2),
                  Text(
                    subtitle,
                    style: TextStyle(
                      fontSize: 11,
                      color: isDark
                          ? const Color(0xFFB0B0B0)
                          : Colors.grey.shade600,
                    ),
                  ),
                ],
              ),
            ),
            Icon(
              Icons.arrow_forward_ios_rounded,
              color: isDark ? const Color(0xFF606060) : Colors.grey.shade400,
              size: 16,
            ),
          ],
        ),
      ),
    );
  }

  Widget _buildLogoutButton(BuildContext context) {
    return Container(
      width: double.infinity,
      padding: const EdgeInsets.symmetric(horizontal: 4),
      child: OutlinedButton.icon(
        onPressed: () async {
          final confirmed = await showDialog<bool>(
            context: context,
            builder: (context) => AlertDialog(
              shape: RoundedRectangleBorder(
                borderRadius: BorderRadius.circular(16),
              ),
              title: Row(
                children: [
                  Icon(Icons.logout, color: Colors.red.shade600, size: 24),
                  const SizedBox(width: 8),
                  const Text('Logout'),
                ],
              ),
              content: const Text(
                  'Are you sure you want to logout? You will need to login again to access the app.'),
              actions: [
                TextButton(
                  onPressed: () => Navigator.pop(context, false),
                  child: Text('Cancel',
                      style: TextStyle(color: Colors.grey.shade600)),
                ),
                ElevatedButton(
                  onPressed: () => Navigator.pop(context, true),
                  style: ElevatedButton.styleFrom(
                    backgroundColor: Colors.red,
                    foregroundColor: Colors.white,
                  ),
                  child: const Text('Logout'),
                ),
              ],
            ),
          );

          if (confirmed == true && context.mounted) {
            final authProvider =
                Provider.of<AuthProvider>(context, listen: false);
            await authProvider.logout();
            if (context.mounted) {
              context.go('/login');
            }
          }
        },
        icon: const Icon(Icons.logout_rounded),
        label: const Text('Logout'),
        style: OutlinedButton.styleFrom(
          foregroundColor: Colors.red,
          side: const BorderSide(color: Colors.red, width: 2),
          padding: const EdgeInsets.symmetric(vertical: 16),
          shape: RoundedRectangleBorder(
            borderRadius: BorderRadius.circular(12),
          ),
        ),
      ),
    );
  }

  void _showReportsDialog(BuildContext context) {
    final isDark = Theme.of(context).brightness == Brightness.dark;
    showModalBottomSheet(
      context: context,
      isScrollControlled: true,
      backgroundColor: Colors.transparent,
      builder: (context) => Container(
        decoration: BoxDecoration(
          color: isDark ? const Color(0xFF2C2C2C) : Colors.white,
          borderRadius: const BorderRadius.only(
            topLeft: Radius.circular(20),
            topRight: Radius.circular(20),
          ),
        ),
        padding: const EdgeInsets.all(20),
        child: Column(
          mainAxisSize: MainAxisSize.min,
          children: [
            Container(
              width: 40,
              height: 4,
              decoration: BoxDecoration(
                color: isDark ? const Color(0xFF404040) : Colors.grey.shade300,
                borderRadius: BorderRadius.circular(2),
              ),
            ),
            const SizedBox(height: 20),
            Row(
              children: [
                Icon(Icons.analytics_rounded,
                    color: const Color(0xFFFF6B35), size: 24),
                const SizedBox(width: 8),
                const Text(
                  'Generate Reports',
                  style: TextStyle(
                    fontSize: 18,
                    fontWeight: FontWeight.bold,
                  ),
                ),
              ],
            ),
            const SizedBox(height: 16),
            _buildReportOption(
              context,
              icon: Icons.people_outline,
              title: 'Guest Report',
              subtitle: 'Export guest data and check-in history',
              onTap: () => _showComingSoon(context, 'Guest Report'),
            ),
            const SizedBox(height: 12),
            _buildReportOption(
              context,
              icon: Icons.meeting_room_outlined,
              title: 'Occupancy Report',
              subtitle: 'Room occupancy rates and availability',
              onTap: () => _showComingSoon(context, 'Occupancy Report'),
            ),
            const SizedBox(height: 12),
            _buildReportOption(
              context,
              icon: Icons.attach_money_outlined,
              title: 'Revenue Report',
              subtitle: 'Financial summary and revenue analysis',
              onTap: () => _showComingSoon(context, 'Revenue Report'),
            ),
            const SizedBox(height: 20),
          ],
        ),
      ),
    );
  }

  Widget _buildReportOption(
    BuildContext context, {
    required IconData icon,
    required String title,
    required String subtitle,
    required VoidCallback onTap,
  }) {
    final isDark = Theme.of(context).brightness == Brightness.dark;
    return InkWell(
      onTap: () {
        Navigator.pop(context);
        onTap();
      },
      borderRadius: BorderRadius.circular(12),
      child: Container(
        padding: const EdgeInsets.all(16),
        decoration: BoxDecoration(
          border: Border.all(
            color: isDark ? const Color(0xFF404040) : Colors.grey.shade300,
          ),
          borderRadius: BorderRadius.circular(12),
        ),
        child: Row(
          children: [
            Icon(icon, color: const Color(0xFFFF6B35), size: 24),
            const SizedBox(width: 12),
            Expanded(
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Text(
                    title,
                    style: TextStyle(
                      fontSize: 14,
                      fontWeight: FontWeight.w600,
                      color: isDark ? const Color(0xFFE1E1E1) : Colors.black,
                    ),
                  ),
                  Text(
                    subtitle,
                    style: TextStyle(
                      fontSize: 12,
                      color: isDark
                          ? const Color(0xFFB0B0B0)
                          : Colors.grey.shade600,
                    ),
                  ),
                ],
              ),
            ),
            Icon(Icons.arrow_forward_ios,
                color: isDark ? const Color(0xFF606060) : Colors.grey.shade400,
                size: 16),
          ],
        ),
      ),
    );
  }

  void _showComingSoon(BuildContext context, String feature) {
    showDialog(
      context: context,
      builder: (context) => AlertDialog(
        shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(16)),
        title: Row(
          children: [
            Icon(Icons.construction, color: Colors.orange.shade600, size: 24),
            const SizedBox(width: 8),
            const Text('Coming Soon'),
          ],
        ),
        content: Text(
            '$feature feature is under development and will be available in a future update.'),
        actions: [
          TextButton(
            onPressed: () => Navigator.pop(context),
            child: const Text('OK'),
          ),
        ],
      ),
    );
  }

  void _showPrivacyPolicy(BuildContext context) {
    showDialog(
      context: context,
      builder: (context) => AlertDialog(
        shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(16)),
        title: Row(
          children: [
            Icon(Icons.privacy_tip_rounded,
                color: const Color(0xFFFF6B35), size: 24),
            const SizedBox(width: 8),
            const Text('Privacy Policy'),
          ],
        ),
        content: SingleChildScrollView(
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            mainAxisSize: MainAxisSize.min,
            children: [
              const Text(
                'Data Collection',
                style: TextStyle(fontWeight: FontWeight.bold),
              ),
              const SizedBox(height: 8),
              const Text(
                'We collect guest information including passport/ID data for registration purposes only.',
                style: TextStyle(fontSize: 14),
              ),
              const SizedBox(height: 16),
              const Text(
                'Data Usage',
                style: TextStyle(fontWeight: FontWeight.bold),
              ),
              const SizedBox(height: 8),
              const Text(
                'All guest data is used solely for hotel operations and is stored securely on your local servers.',
                style: TextStyle(fontSize: 14),
              ),
              const SizedBox(height: 16),
              const Text(
                'Data Security',
                style: TextStyle(fontWeight: FontWeight.bold),
              ),
              const SizedBox(height: 8),
              const Text(
                'We implement industry-standard security measures to protect guest information.',
                style: TextStyle(fontSize: 14),
              ),
            ],
          ),
        ),
        actions: [
          TextButton(
            onPressed: () => Navigator.pop(context),
            child: const Text('Close'),
          ),
        ],
      ),
    );
  }

  void _showHelpDialog(BuildContext context) {
    showDialog(
      context: context,
      builder: (context) => AlertDialog(
        shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(16)),
        title: Row(
          children: [
            Icon(Icons.help_outline_rounded,
                color: const Color(0xFFFF6B35), size: 24),
            const SizedBox(width: 8),
            const Text('Help & Support'),
          ],
        ),
        content: Column(
          mainAxisSize: MainAxisSize.min,
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            const Text('Need help with the app?'),
            const SizedBox(height: 16),
            ListTile(
              leading: const Icon(Icons.email_outlined),
              title: const Text('Email Support'),
              subtitle: const Text('support@hotelstaff.com'),
              dense: true,
              contentPadding: EdgeInsets.zero,
              onTap: () {
                // Email functionality would go here
              },
            ),
            ListTile(
              leading: const Icon(Icons.phone_outlined),
              title: const Text('Phone Support'),
              subtitle: const Text('+1 (555) 123-4567'),
              dense: true,
              contentPadding: EdgeInsets.zero,
              onTap: () {
                // Phone functionality would go here
              },
            ),
            ListTile(
              leading: const Icon(Icons.description_outlined),
              title: const Text('User Manual'),
              subtitle: const Text('View documentation'),
              dense: true,
              contentPadding: EdgeInsets.zero,
              onTap: () {
                Navigator.pop(context);
                _showComingSoon(context, 'User Manual');
              },
            ),
          ],
        ),
        actions: [
          TextButton(
            onPressed: () => Navigator.pop(context),
            child: const Text('Close'),
          ),
        ],
      ),
    );
  }

  void _showAboutDialog(BuildContext context) {
    showDialog(
      context: context,
      builder: (context) => AlertDialog(
        shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(16)),
        title: Row(
          children: [
            Image.asset('assets/images/logo_1.png',
                height: 24, width: 28, fit: BoxFit.contain),
            const SizedBox(width: 8),
            const Text('About 1.IDM'),
          ],
        ),
        content: Column(
          mainAxisSize: MainAxisSize.min,
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            const Text(
              'Hotel Staff Management App',
              style: TextStyle(fontWeight: FontWeight.bold, fontSize: 16),
            ),
            const SizedBox(height: 8),
            const Text('Version 1.0.0'),
            const SizedBox(height: 16),
            const Text(
              'A comprehensive hotel management solution for staff operations including guest registration, check-in/check-out, and room management.',
              style: TextStyle(fontSize: 14),
            ),
            const SizedBox(height: 16),
            const Text(
              'Developed By ITSthe1 Solutions',
              style: TextStyle(fontSize: 12, color: Colors.grey),
            ),
          ],
        ),
        actions: [
          TextButton(
            onPressed: () => Navigator.pop(context),
            child: const Text('Close'),
          ),
        ],
      ),
    );
  }
}
