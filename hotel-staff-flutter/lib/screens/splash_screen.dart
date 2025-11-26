import 'package:flutter/material.dart';
import 'package:go_router/go_router.dart';
import 'package:provider/provider.dart';
import '../providers/auth_provider.dart';
import '../utils/app_theme.dart';

class SplashScreen extends StatefulWidget {
  const SplashScreen({super.key});

  @override
  State<SplashScreen> createState() => _SplashScreenState();
}

class _SplashScreenState extends State<SplashScreen> {
  @override
  void initState() {
    super.initState();
    _checkAuthentication();
  }

  Future<void> _checkAuthentication() async {
    final authProvider = Provider.of<AuthProvider>(context, listen: false);

    // Load saved auth state
    await authProvider.loadAuthState();

    // Check if session is valid
    final isSessionValid = await authProvider.isSessionValid();

    if (mounted) {
      if (authProvider.isAuthenticated && isSessionValid) {
        // Session is valid, go to dashboard
        debugPrint('✅ Session valid - redirecting to dashboard');
        context.go('/dashboard');
      } else {
        // Session expired or not logged in, go to login
        debugPrint('🔓 Session invalid - redirecting to login');
        context.go('/login');
      }
    }
  }

  @override
  Widget build(BuildContext context) {
    final isDark = Theme.of(context).brightness == Brightness.dark;
    
    return Scaffold(
      backgroundColor: isDark ? const Color(0xFF121212) : Colors.white,
      body: Center(
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            // Logo
            Image.asset(
              'assets/images/logo.png',
              width: 180,
              height: 70,
              fit: BoxFit.contain,
              errorBuilder: (context, error, stackTrace) {
                return Container(
                  padding: const EdgeInsets.all(20),
                  decoration: BoxDecoration(
                    color: AppTheme.primaryOrange.withOpacity(0.1),
                    shape: BoxShape.circle,
                  ),
                  child: const Icon(
                    Icons.business,
                    size: 64,
                    color: AppTheme.primaryOrange,
                  ),
                );
              },
            ),
            const SizedBox(height: 40),
            const Text(
              '1.IDM',
              style: TextStyle(
                fontSize: 36,
                fontWeight: FontWeight.bold,
                color: AppTheme.primaryOrange,
                letterSpacing: 4,
              ),
            ),
            const SizedBox(height: 8),
            Text(
              'Hotel Management System',
              style: TextStyle(
                fontSize: 16,
                color: isDark ? const Color(0xFFB0B0B0) : Colors.grey[700],
                fontWeight: FontWeight.w500,
              ),
            ),
            const SizedBox(height: 60),
            const CircularProgressIndicator(
              color: AppTheme.primaryOrange,
            ),
          ],
        ),
      ),
    );
  }
}
