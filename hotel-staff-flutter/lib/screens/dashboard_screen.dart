import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:go_router/go_router.dart';
import '../providers/auth_provider.dart';
import '../providers/guest_provider.dart';
import '../utils/app_theme.dart';

class DashboardScreen extends StatefulWidget {
  const DashboardScreen({super.key});
  @override
  State<DashboardScreen> createState() => _DashboardScreenState();
}

class _DashboardScreenState extends State<DashboardScreen> {
  @override
  void initState() {
    super.initState();
    WidgetsBinding.instance.addPostFrameCallback((_) {
      if (mounted) {
        Provider.of<GuestProvider>(context, listen: false).loadGuests();
      }
    });
  }

  @override
  Widget build(BuildContext context) {
    final authProvider = Provider.of<AuthProvider>(context);
    final guestProvider = Provider.of<GuestProvider>(context);
    final stats = guestProvider.statistics;
    return Scaffold(
      backgroundColor: Colors.grey.shade50,
      body: SafeArea(
        child: RefreshIndicator(
          onRefresh: () => guestProvider.loadGuests(),
          child: SingleChildScrollView(
            physics: const AlwaysScrollableScrollPhysics(),
            child: Column(
              children: [
                Container(
                  width: double.infinity,
                  color: Colors.white,
                  padding: const EdgeInsets.all(20),
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      Row(
                        children: [
                          Image.asset('assets/images/logo.png',
                              height: 48, width: 48, fit: BoxFit.contain),
                          const SizedBox(width: 12),
                          Expanded(
                            child: Column(
                              crossAxisAlignment: CrossAxisAlignment.start,
                              children: [
                                const Text('Hotel Staff',
                                    style: TextStyle(
                                        fontSize: 18,
                                        fontWeight: FontWeight.w800,
                                        color: Color(0xFF1A1A1A),
                                        letterSpacing: -0.3)),
                                Text(authProvider.userName ?? 'Staff Member',
                                    style: TextStyle(
                                        fontSize: 12,
                                        color: Colors.grey.shade600,
                                        fontWeight: FontWeight.w500)),
                              ],
                            ),
                          ),
                          Container(
                            padding: const EdgeInsets.symmetric(
                                horizontal: 10, vertical: 6),
                            decoration: BoxDecoration(
                              color: authProvider.isDemoMode
                                  ? Colors.orange.shade50
                                  : Colors.green.shade50,
                              borderRadius: BorderRadius.circular(20),
                              border: Border.all(
                                  color: authProvider.isDemoMode
                                      ? Colors.orange.shade200
                                      : Colors.green.shade200,
                                  width: 1.5),
                            ),
                            child: Row(
                              children: [
                                Icon(
                                    authProvider.isDemoMode
                                        ? Icons.offline_bolt_rounded
                                        : Icons.wifi_rounded,
                                    color: authProvider.isDemoMode
                                        ? Colors.orange.shade700
                                        : Colors.green.shade700,
                                    size: 13),
                                const SizedBox(width: 5),
                                Text(authProvider.isDemoMode ? 'Demo' : 'Live',
                                    style: TextStyle(
                                        color: authProvider.isDemoMode
                                            ? Colors.orange.shade700
                                            : Colors.green.shade700,
                                        fontSize: 11,
                                        fontWeight: FontWeight.bold)),
                              ],
                            ),
                          ),
                          const SizedBox(width: 8),
                          PopupMenuButton(
                            icon: Icon(Icons.more_vert_rounded,
                                color: Colors.grey.shade700),
                            shape: RoundedRectangleBorder(
                                borderRadius: BorderRadius.circular(16)),
                            itemBuilder: (context) => [
                              PopupMenuItem(
                                child: ListTile(
                                  leading: const Icon(Icons.storage,
                                      size: 20, color: Colors.blue),
                                  title: const Text('Verify Database'),
                                  contentPadding: EdgeInsets.zero,
                                  onTap: () async {
                                    Navigator.pop(context);
                                    await guestProvider.debugPrintStoredData();
                                    if (mounted) {
                                      ScaffoldMessenger.of(context).showSnackBar(
                                        const SnackBar(
                                          content: Text('✅ Check console/debug output for database details'),
                                          backgroundColor: Colors.blue,
                                          duration: Duration(seconds: 3),
                                        ),
                                      );
                                    }
                                  },
                                ),
                              ),
                              PopupMenuItem(
                                child: ListTile(
                                  leading: const Icon(Icons.logout_rounded,
                                      size: 20, color: Colors.red),
                                  title: const Text('Logout'),
                                  contentPadding: EdgeInsets.zero,
                                  onTap: () async {
                                    Navigator.pop(context);
                                    await authProvider.logout();
                                    if (mounted) context.go('/');
                                  },
                                ),
                              ),
                            ],
                          ),
                        ],
                      ),
                      const SizedBox(height: 24),
                      Text('Dashboard',
                          style: TextStyle(
                              fontSize: 28,
                              fontWeight: FontWeight.w900,
                              color: Colors.grey.shade900,
                              letterSpacing: -0.8,
                              height: 1.1)),
                      const SizedBox(height: 4),
                      Text('Monitor and manage your hotel guests',
                          style: TextStyle(
                              fontSize: 13,
                              color: Colors.grey.shade600,
                              fontWeight: FontWeight.w500)),
                    ],
                  ),
                ),
                Padding(
                  padding: const EdgeInsets.all(16),
                  child: Column(
                    children: [
                      Row(
                        children: [
                          Expanded(
                              child: _StatsCard(
                                  label: 'Total',
                                  value: stats['total'].toString(),
                                  icon: Icons.groups_rounded,
                                  color: const Color(0xFF6C5CE7))),
                          const SizedBox(width: 12),
                          Expanded(
                              child: _StatsCard(
                                  label: 'Checked In',
                                  value: stats['checkedIn'].toString(),
                                  icon: Icons.login_rounded,
                                  color: const Color(0xFF00B894))),
                        ],
                      ),
                      const SizedBox(height: 12),
                      Row(
                        children: [
                          Expanded(
                              child: _StatsCard(
                                  label: 'Checked Out',
                                  value: stats['checkedOut'].toString(),
                                  icon: Icons.logout_rounded,
                                  color: const Color(0xFF0984E3))),
                          const SizedBox(width: 12),
                          Expanded(
                              child: _StatsCard(
                                  label: 'Pending',
                                  value: stats['pending'].toString(),
                                  icon: Icons.pending_actions_rounded,
                                  color: const Color(0xFFE17055))),
                        ],
                      ),
                      const SizedBox(height: 24),
                      Row(
                        mainAxisAlignment: MainAxisAlignment.spaceBetween,
                        children: [
                          const Text('Quick Actions',
                              style: TextStyle(
                                  fontSize: 18,
                                  fontWeight: FontWeight.bold,
                                  color: Color(0xFF2D3436))),
                          Text('Tap to start',
                              style: TextStyle(
                                  fontSize: 12,
                                  color: Colors.grey.shade500,
                                  fontWeight: FontWeight.w500)),
                        ],
                      ),
                      const SizedBox(height: 12),
                      _PrimaryActionCard(
                          title: 'Scan ID/Passport',
                          subtitle: 'Quick guest registration with OCR',
                          icon: Icons.document_scanner_rounded,
                          gradientColors: const [
                            Color(0xFFFF6B35),
                            Color(0xFFF7931E)
                          ],
                          onTap: () => context.push('/scan')),
                      const SizedBox(height: 12),
                      Row(
                        children: [
                          Expanded(
                              child: _CompactActionCard(
                                  title: 'Check-In',
                                  icon: Icons.login_rounded,
                                  color: const Color(0xFF00B894),
                                  onTap: () => context.push('/check-in'))),
                          const SizedBox(width: 20),
                          Expanded(
                              child: _CompactActionCard(
                                  title: 'Check-Out',
                                  icon: Icons.logout_rounded,
                                  color: const Color(0xFF0984E3),
                                  onTap: () => context.push('/check-out'))),
                        ],
                      ),
                      const SizedBox(height: 12),
                      _OutlinedActionCard(
                          title: 'View All Guests',
                          subtitle: 'Browse and manage guest list',
                          icon: Icons.list_alt_rounded,
                          onTap: () => context.push('/guests')),
                      const SizedBox(height: 16),
                    ],
                  ),
                ),
              ],
            ),
          ),
        ),
      ),
    );
  }
}

class _StatsCard extends StatelessWidget {
  final String label;
  final String value;
  final IconData icon;
  final Color color;
  const _StatsCard(
      {required this.label,
      required this.value,
      required this.icon,
      required this.color});
  @override
  Widget build(BuildContext context) {
    return Container(
      padding: const EdgeInsets.all(12),
      decoration: BoxDecoration(
        color: Colors.white,
        borderRadius: BorderRadius.circular(12),
        border: Border.all(color: Colors.grey.shade200, width: 1),
        boxShadow: [
          BoxShadow(
              color: Colors.black.withValues(alpha: 0.03),
              blurRadius: 8,
              offset: const Offset(0, 2))
        ],
      ),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Row(
            mainAxisAlignment: MainAxisAlignment.spaceBetween,
            children: [
              Container(
                  padding: const EdgeInsets.all(6),
                  decoration: BoxDecoration(
                      color: color.withValues(alpha: 0.1),
                      borderRadius: BorderRadius.circular(8)),
                  child: Icon(icon, color: color, size: 16)),
              Icon(Icons.trending_up_rounded,
                  color: Colors.grey.shade400, size: 14),
            ],
          ),
          const SizedBox(height: 8),
          Text(value,
              style: TextStyle(
                  fontSize: 22,
                  fontWeight: FontWeight.w900,
                  color: color,
                  height: 1,
                  letterSpacing: -0.5)),
          const SizedBox(height: 2),
          Text(label,
              style: TextStyle(
                  fontSize: 11,
                  color: Colors.grey.shade600,
                  fontWeight: FontWeight.w600)),
        ],
      ),
    );
  }
}

class _PrimaryActionCard extends StatelessWidget {
  final String title;
  final String subtitle;
  final IconData icon;
  final List<Color> gradientColors;
  final VoidCallback onTap;
  const _PrimaryActionCard(
      {required this.title,
      required this.subtitle,
      required this.icon,
      required this.gradientColors,
      required this.onTap});
  @override
  Widget build(BuildContext context) {
    return InkWell(
      onTap: onTap,
      borderRadius: BorderRadius.circular(16),
      child: Container(
        padding: const EdgeInsets.all(16),
        decoration: BoxDecoration(
            gradient: LinearGradient(
                begin: Alignment.topLeft,
                end: Alignment.bottomRight,
                colors: gradientColors),
            borderRadius: BorderRadius.circular(16),
            boxShadow: [
              BoxShadow(
                  color: gradientColors.first.withValues(alpha: 0.4),
                  blurRadius: 16,
                  offset: const Offset(0, 8))
            ]),
        child: Row(children: [
          Container(
              padding: const EdgeInsets.all(12),
              decoration: BoxDecoration(
                  color: Colors.white.withValues(alpha: 0.2),
                  borderRadius: BorderRadius.circular(12)),
              child: Icon(icon, color: Colors.white, size: 28)),
          const SizedBox(width: 14),
          Expanded(
              child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                Text(title,
                    style: const TextStyle(
                        fontSize: 16,
                        fontWeight: FontWeight.bold,
                        color: Colors.white)),
                const SizedBox(height: 2),
                Text(subtitle,
                    style: TextStyle(
                        fontSize: 12,
                        color: Colors.white.withValues(alpha: 0.9)))
              ])),
          const Icon(Icons.arrow_forward_ios_rounded,
              color: Colors.white, size: 18)
        ]),
      ),
    );
  }
}

class _CompactActionCard extends StatelessWidget {
  final String title;
  final IconData icon;
  final Color color;
  final VoidCallback onTap;
  const _CompactActionCard(
      {required this.title,
      required this.icon,
      required this.color,
      required this.onTap});
  @override
  Widget build(BuildContext context) {
    return InkWell(
      onTap: onTap,
      borderRadius: BorderRadius.circular(14),
      child: Container(
        padding: const EdgeInsets.symmetric(vertical: 16, horizontal: 12),
        decoration: BoxDecoration(
            color: color,
            borderRadius: BorderRadius.circular(14),
            boxShadow: [
              BoxShadow(
                  color: color.withValues(alpha: 0.3),
                  blurRadius: 10,
                  offset: const Offset(0, 5))
            ]),
        child: Column(children: [
          Icon(icon, color: Colors.white, size: 28),
          const SizedBox(height: 10),
          Text(title,
              style: const TextStyle(
                  fontSize: 13,
                  fontWeight: FontWeight.bold,
                  color: Colors.white),
              textAlign: TextAlign.center)
        ]),
      ),
    );
  }
}

class _OutlinedActionCard extends StatelessWidget {
  final String title;
  final String subtitle;
  final IconData icon;
  final VoidCallback onTap;
  const _OutlinedActionCard(
      {required this.title,
      required this.subtitle,
      required this.icon,
      required this.onTap});
  @override
  Widget build(BuildContext context) {
    return InkWell(
      onTap: onTap,
      borderRadius: BorderRadius.circular(14),
      child: Container(
        padding: const EdgeInsets.all(16),
        decoration: BoxDecoration(
            color: Colors.white,
            borderRadius: BorderRadius.circular(14),
            border: Border.all(color: Colors.grey.shade300, width: 2),
            boxShadow: [
              BoxShadow(
                  color: Colors.grey.withValues(alpha: 0.08),
                  blurRadius: 8,
                  offset: const Offset(0, 3))
            ]),
        child: Row(children: [
          Container(
              padding: const EdgeInsets.all(10),
              decoration: BoxDecoration(
                  color: AppTheme.primaryOrange.withValues(alpha: 0.1),
                  borderRadius: BorderRadius.circular(10)),
              child: Icon(icon, color: AppTheme.primaryOrange, size: 24)),
          const SizedBox(width: 14),
          Expanded(
              child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                Text(title,
                    style: const TextStyle(
                        fontSize: 15,
                        fontWeight: FontWeight.bold,
                        color: Color(0xFF2D3436))),
                const SizedBox(height: 2),
                Text(subtitle,
                    style: TextStyle(fontSize: 11, color: Colors.grey.shade600))
              ])),
          Icon(Icons.arrow_forward_ios_rounded,
              color: Colors.grey.shade400, size: 16)
        ]),
      ),
    );
  }
}
