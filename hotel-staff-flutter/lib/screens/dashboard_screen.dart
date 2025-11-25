import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:go_router/go_router.dart';
import '../providers/auth_provider.dart';
import '../providers/guest_provider.dart';
import '../providers/theme_provider.dart';
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
    final isDark = Theme.of(context).brightness == Brightness.dark;

    // Get screen dimensions for responsive layout
    final screenWidth = MediaQuery.of(context).size.width;
    final screenHeight = MediaQuery.of(context).size.height;
    final isSmallScreen = screenWidth < 360;

    // Responsive sizing
    final horizontalPadding = screenWidth * 0.04; // 4% of screen width
    final verticalSpacing = screenHeight *
        0.012; // 1.2% of screen height (reduced for non-scrollable)

    return Scaffold(
      backgroundColor: isDark ? const Color(0xFF121212) : Colors.grey.shade50,
      body: SafeArea(
        child: RefreshIndicator(
          onRefresh: () => guestProvider.loadGuests(),
          child: LayoutBuilder(
            builder: (context, constraints) {
              return SingleChildScrollView(
                  physics: const AlwaysScrollableScrollPhysics(),
                  child: ConstrainedBox(
                    constraints: BoxConstraints(
                      minHeight: constraints.maxHeight,
                    ),
                    child: IntrinsicHeight(
                      child: Column(
                        children: [
                          // Header Section
                          Container(
                            width: double.infinity,
                            color:
                                isDark ? const Color(0xFF1E1E1E) : Colors.white,
                            padding: EdgeInsets.symmetric(
                              horizontal: horizontalPadding,
                              vertical: screenHeight * 0.015,
                            ),
                            child: Column(
                              crossAxisAlignment: CrossAxisAlignment.start,
                              children: [
                                Row(
                                  children: [
                                    Image.asset('assets/images/logo_1.png',
                                        height: isSmallScreen ? 30 : 34,
                                        width: isSmallScreen ? 36 : 40,
                                        fit: BoxFit.contain),
                                    SizedBox(width: screenWidth * 0.03),
                                    Expanded(
                                      child: Column(
                                        crossAxisAlignment:
                                            CrossAxisAlignment.start,
                                        children: [
                                          Text('Hotel Staff',
                                              style: TextStyle(
                                                  fontSize:
                                                      isSmallScreen ? 16 : 17,
                                                  fontWeight: FontWeight.w800,
                                                  color: isDark
                                                      ? const Color(0xFFE1E1E1)
                                                      : const Color(0xFF1A1A1A),
                                                  letterSpacing: -0.3)),
                                          Text(
                                              authProvider.userName ??
                                                  'Staff Member',
                                              style: TextStyle(
                                                  fontSize:
                                                      isSmallScreen ? 10 : 11,
                                                  color: isDark
                                                      ? const Color(0xFFB0B0B0)
                                                      : Colors.grey.shade600,
                                                  fontWeight: FontWeight.w500)),
                                        ],
                                      ),
                                    ),
                                    Consumer<ThemeProvider>(
                                      builder: (context, themeProvider, _) =>
                                          GestureDetector(
                                        onTap: () =>
                                            themeProvider.toggleTheme(),
                                        child: AnimatedContainer(
                                          duration:
                                              const Duration(milliseconds: 300),
                                          curve: Curves.easeInOut,
                                          width: isSmallScreen ? 54 : 58,
                                          height: isSmallScreen ? 27 : 29,
                                          decoration: BoxDecoration(
                                            color: isDark
                                                ? const Color(0xFF2C2C2C)
                                                : Colors.grey.shade200,
                                            borderRadius:
                                                BorderRadius.circular(30),
                                            boxShadow: [
                                              BoxShadow(
                                                color: Colors.black
                                                    .withOpacity(0.1),
                                                blurRadius: 6,
                                                offset: const Offset(0, 2),
                                              ),
                                            ],
                                          ),
                                          child: Stack(
                                            children: [
                                              AnimatedPositioned(
                                                duration: const Duration(
                                                    milliseconds: 300),
                                                curve: Curves.easeInOut,
                                                left: isDark
                                                    ? (isSmallScreen ? 27 : 29)
                                                    : 0,
                                                top: 0,
                                                bottom: 0,
                                                child: Container(
                                                  width:
                                                      isSmallScreen ? 27 : 29,
                                                  height:
                                                      isSmallScreen ? 27 : 29,
                                                  decoration: BoxDecoration(
                                                    color: isDark
                                                        ? const Color(
                                                            0xFF1E1E1E)
                                                        : Colors.white,
                                                    shape: BoxShape.circle,
                                                    boxShadow: [
                                                      BoxShadow(
                                                        color: Colors.black
                                                            .withOpacity(0.2),
                                                        blurRadius: 4,
                                                        offset:
                                                            const Offset(0, 2),
                                                      ),
                                                    ],
                                                  ),
                                                  child: Icon(
                                                    isDark
                                                        ? Icons
                                                            .dark_mode_rounded
                                                        : Icons
                                                            .light_mode_rounded,
                                                    color: isDark
                                                        ? Colors.orange.shade400
                                                        : Colors
                                                            .orange.shade600,
                                                    size:
                                                        isSmallScreen ? 15 : 16,
                                                  ),
                                                ),
                                              ),
                                            ],
                                          ),
                                        ),
                                      ),
                                    ),
                                  ],
                                ),
                                SizedBox(height: verticalSpacing * 1.2),
                                Text('Dashboard',
                                    style: TextStyle(
                                        fontSize: isSmallScreen ? 22 : 24,
                                        fontWeight: FontWeight.w900,
                                        color: isDark
                                            ? const Color(0xFFE1E1E1)
                                            : Colors.grey.shade900,
                                        letterSpacing: -0.8,
                                        height: 1.1)),
                                SizedBox(height: 3),
                                Text('Monitor and manage your hotel guests',
                                    style: TextStyle(
                                        fontSize: isSmallScreen ? 11 : 12,
                                        color: isDark
                                            ? const Color(0xFFB0B0B0)
                                            : Colors.grey.shade600,
                                        fontWeight: FontWeight.w500)),
                              ],
                            ),
                          ),

                          // Content Section
                          Padding(
                            padding: EdgeInsets.symmetric(
                              horizontal: horizontalPadding,
                              vertical: verticalSpacing,
                            ),
                            child: Column(
                              children: [
                                // Stats Cards
                                Row(
                                  children: [
                                    Expanded(
                                        child: _StatsCard(
                                            label: 'Total',
                                            value: stats['total'].toString(),
                                            icon: Icons.groups_rounded,
                                            color: const Color(0xFF6C5CE7))),
                                    SizedBox(width: screenWidth * 0.03),
                                    Expanded(
                                        child: _StatsCard(
                                            label: 'Checked In',
                                            value:
                                                stats['checkedIn'].toString(),
                                            icon: Icons.login_rounded,
                                            color: const Color(0xFF00B894))),
                                  ],
                                ),
                                SizedBox(height: verticalSpacing),
                                Row(
                                  children: [
                                    Expanded(
                                        child: _StatsCard(
                                            label: 'Checked Out',
                                            value:
                                                stats['checkedOut'].toString(),
                                            icon: Icons.logout_rounded,
                                            color: const Color(0xFF0984E3))),
                                    SizedBox(width: screenWidth * 0.03),
                                    Expanded(
                                        child: _StatsCard(
                                            label: 'Pending',
                                            value: stats['pending'].toString(),
                                            icon: Icons.pending_actions_rounded,
                                            color: const Color(0xFFE17055))),
                                  ],
                                ),
                                SizedBox(height: verticalSpacing * 1.5),

                                // Quick Actions Header
                                Row(
                                  mainAxisAlignment:
                                      MainAxisAlignment.spaceBetween,
                                  children: [
                                    Text('Quick Actions',
                                        style: TextStyle(
                                            fontSize: isSmallScreen ? 15 : 16,
                                            fontWeight: FontWeight.bold,
                                            color: isDark
                                                ? const Color(0xFFE1E1E1)
                                                : const Color(0xFF2D3436))),
                                    Text('Tap to start',
                                        style: TextStyle(
                                            fontSize: isSmallScreen ? 10 : 11,
                                            color: isDark
                                                ? const Color(0xFFB0B0B0)
                                                : Colors.grey.shade500,
                                            fontWeight: FontWeight.w500)),
                                  ],
                                ),
                                SizedBox(height: verticalSpacing),

                                // Quick Action Buttons
                                _PrimaryActionCard(
                                    title: 'Room Status',
                                    subtitle: 'View and manage room status',
                                    icon: Icons.meeting_room_rounded,
                                    gradientColors: const [
                                      Color(0xFF6C5CE7),
                                      Color(0xFF8B7FE8)
                                    ],
                                    onTap: () => context.push('/rooms')),
                                SizedBox(height: verticalSpacing),
                                _PrimaryActionCard(
                                    title: 'Scan ID/Passport',
                                    subtitle:
                                        'Quick guest registration with OCR',
                                    icon: Icons.document_scanner_rounded,
                                    gradientColors: const [
                                      Color(0xFFFF6B35),
                                      Color(0xFFF7931E)
                                    ],
                                    onTap: () => context.push('/scan')),
                                SizedBox(height: verticalSpacing),

                                // Compact Action Cards Row
                                Row(
                                  children: [
                                    Expanded(
                                        child: _CompactActionCard(
                                            title: 'Check-In',
                                            icon: Icons.login_rounded,
                                            color: const Color(0xFF00B894),
                                            onTap: () =>
                                                context.push('/check-in'))),
                                    SizedBox(width: screenWidth * 0.03),
                                    Expanded(
                                        child: _CompactActionCard(
                                            title: 'Room\nChange',
                                            icon: Icons.swap_horiz_rounded,
                                            color: const Color(0xFF0984E3),
                                            onTap: () =>
                                                context.push('/room-change'))),
                                    SizedBox(width: screenWidth * 0.03),
                                    Expanded(
                                        child: _CompactActionCard(
                                            title: 'Check-Out',
                                            icon: Icons.logout_rounded,
                                            color: const Color(0xFFE74C3C),
                                            onTap: () =>
                                                context.push('/check-out'))),
                                  ],
                                ),
                                SizedBox(height: verticalSpacing),

                                // View All Guests Card
                                _OutlinedActionCard(
                                    title: 'View All Guests',
                                    subtitle: 'Browse and manage guest list',
                                    icon: Icons.list_alt_rounded,
                                    onTap: () => context.push('/guests')),
                              ],
                            ),
                          ),
                        ],
                      ),
                    ),
                  ));
            },
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
    final isDark = Theme.of(context).brightness == Brightness.dark;
    final screenWidth = MediaQuery.of(context).size.width;
    final isSmallScreen = screenWidth < 360;

    return Container(
      padding: EdgeInsets.symmetric(
        horizontal: isSmallScreen ? 8 : 10,
        vertical: isSmallScreen ? 8 : 10,
      ),
      decoration: BoxDecoration(
        color: isDark ? const Color(0xFF2C2C2C) : Colors.white,
        borderRadius: BorderRadius.circular(10),
        border: Border.all(
          color: isDark ? const Color(0xFF404040) : Colors.grey.shade200,
          width: 1,
        ),
        boxShadow: [
          BoxShadow(
              color: Colors.black.withValues(alpha: isDark ? 0.05 : 0.03),
              blurRadius: 6,
              offset: const Offset(0, 2))
        ],
      ),
      child: Row(
        children: [
          Container(
              padding: EdgeInsets.all(isSmallScreen ? 6 : 7),
              decoration: BoxDecoration(
                  color: color.withValues(alpha: 0.1),
                  borderRadius: BorderRadius.circular(8)),
              child: Icon(icon, color: color, size: isSmallScreen ? 16 : 17)),
          SizedBox(width: isSmallScreen ? 6 : 8),
          Expanded(
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              mainAxisSize: MainAxisSize.min,
              children: [
                Text(label,
                    style: TextStyle(
                        fontSize: isSmallScreen ? 9 : 10,
                        color: Colors.grey.shade600,
                        fontWeight: FontWeight.w500)),
                SizedBox(height: 2),
                FittedBox(
                  fit: BoxFit.scaleDown,
                  alignment: Alignment.centerLeft,
                  child: Text(value,
                      style: TextStyle(
                          fontSize: isSmallScreen ? 18 : 20,
                          fontWeight: FontWeight.w900,
                          color: color,
                          height: 1,
                          letterSpacing: -0.5)),
                ),
              ],
            ),
          ),
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
    final screenWidth = MediaQuery.of(context).size.width;
    final isSmallScreen = screenWidth < 360;

    return InkWell(
      onTap: onTap,
      borderRadius: BorderRadius.circular(14),
      child: Container(
        padding: EdgeInsets.all(isSmallScreen ? 12 : 14),
        decoration: BoxDecoration(
            gradient: LinearGradient(
                begin: Alignment.topLeft,
                end: Alignment.bottomRight,
                colors: gradientColors),
            borderRadius: BorderRadius.circular(14),
            boxShadow: [
              BoxShadow(
                  color: gradientColors.first.withValues(alpha: 0.4),
                  blurRadius: 12,
                  offset: const Offset(0, 6))
            ]),
        child: Row(children: [
          Container(
              padding: EdgeInsets.all(isSmallScreen ? 10 : 11),
              decoration: BoxDecoration(
                  color: Colors.white.withValues(alpha: 0.2),
                  borderRadius: BorderRadius.circular(10)),
              child: Icon(icon,
                  color: Colors.white, size: isSmallScreen ? 24 : 26)),
          SizedBox(width: isSmallScreen ? 10 : 12),
          Expanded(
              child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                Text(title,
                    style: TextStyle(
                        fontSize: isSmallScreen ? 14 : 15,
                        fontWeight: FontWeight.bold,
                        color: Colors.white)),
                SizedBox(height: 2),
                Text(subtitle,
                    style: TextStyle(
                        fontSize: isSmallScreen ? 11 : 12,
                        color: Colors.white.withValues(alpha: 0.9)))
              ])),
          Icon(Icons.arrow_forward_ios_rounded,
              color: Colors.white, size: isSmallScreen ? 16 : 17)
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
    final screenWidth = MediaQuery.of(context).size.width;
    final isSmallScreen = screenWidth < 360;

    return InkWell(
      onTap: onTap,
      borderRadius: BorderRadius.circular(12),
      child: Container(
        height: isSmallScreen ? 75 : 85,
        padding: EdgeInsets.symmetric(
          vertical: isSmallScreen ? 8 : 10,
          horizontal: isSmallScreen ? 6 : 8,
        ),
        decoration: BoxDecoration(
            color: color,
            borderRadius: BorderRadius.circular(12),
            boxShadow: [
              BoxShadow(
                  color: color.withValues(alpha: 0.3),
                  blurRadius: 8,
                  offset: const Offset(0, 4))
            ]),
        child: Column(
            mainAxisAlignment: MainAxisAlignment.center,
            mainAxisSize: MainAxisSize.min,
            children: [
              Icon(icon, color: Colors.white, size: isSmallScreen ? 24 : 26),
              SizedBox(height: isSmallScreen ? 6 : 7),
              FittedBox(
                fit: BoxFit.scaleDown,
                child: Text(title,
                    style: TextStyle(
                        fontSize: isSmallScreen ? 11 : 12,
                        fontWeight: FontWeight.bold,
                        color: Colors.white,
                        height: 1.1),
                    textAlign: TextAlign.center,
                    maxLines: 2,
                    overflow: TextOverflow.ellipsis),
              )
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
    final isDark = Theme.of(context).brightness == Brightness.dark;
    final screenWidth = MediaQuery.of(context).size.width;
    final isSmallScreen = screenWidth < 360;

    return InkWell(
      onTap: onTap,
      borderRadius: BorderRadius.circular(12),
      child: Container(
        padding: EdgeInsets.all(isSmallScreen ? 12 : 14),
        decoration: BoxDecoration(
            color: isDark ? const Color(0xFF2C2C2C) : Colors.white,
            borderRadius: BorderRadius.circular(12),
            border: Border.all(
              color: isDark ? const Color(0xFF404040) : Colors.grey.shade300,
              width: 1.5,
            ),
            boxShadow: [
              BoxShadow(
                  color: Colors.grey.withValues(alpha: isDark ? 0.02 : 0.08),
                  blurRadius: 8,
                  offset: const Offset(0, 3))
            ]),
        child: Row(children: [
          Container(
              padding: EdgeInsets.all(isSmallScreen ? 8 : 9),
              decoration: BoxDecoration(
                  color: AppTheme.primaryOrange.withValues(alpha: 0.1),
                  borderRadius: BorderRadius.circular(8)),
              child: Icon(icon,
                  color: AppTheme.primaryOrange,
                  size: isSmallScreen ? 22 : 23)),
          SizedBox(width: isSmallScreen ? 10 : 12),
          Expanded(
              child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                Text(title,
                    style: TextStyle(
                        fontSize: isSmallScreen ? 14 : 15,
                        fontWeight: FontWeight.bold,
                        color: isDark
                            ? const Color(0xFFE1E1E1)
                            : const Color(0xFF2D3436))),
                SizedBox(height: 2),
                Text(subtitle,
                    style: TextStyle(
                      fontSize: isSmallScreen ? 10 : 11,
                      color: isDark
                          ? const Color(0xFFB0B0B0)
                          : Colors.grey.shade600,
                    ))
              ])),
          Icon(Icons.arrow_forward_ios_rounded,
              color: isDark ? const Color(0xFF606060) : Colors.grey.shade400,
              size: isSmallScreen ? 14 : 15)
        ]),
      ),
    );
  }
}
