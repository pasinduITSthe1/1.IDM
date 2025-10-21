import 'package:go_router/go_router.dart';
import '../screens/login_screen.dart';
import '../screens/dashboard_screen.dart';
import '../screens/mrz_scanner_screen.dart'; // FREE: ML Kit + Tesseract Scanner
import '../screens/guest_registration_screen.dart';
import '../screens/guest_list_screen.dart';
import '../screens/check_in_screen.dart';
import '../screens/check_out_screen.dart';

class AppRoutes {
  static final GoRouter router = GoRouter(
    initialLocation: '/',
    routes: [
      GoRoute(
        path: '/',
        name: 'login',
        builder: (context, state) => const LoginScreen(),
      ),
      GoRoute(
        path: '/dashboard',
        name: 'dashboard',
        builder: (context, state) => const DashboardScreen(),
      ),
      GoRoute(
        path: '/scan',
        name: 'scan',
        builder: (context, state) => const MRZScannerScreen(), // FREE: ML Kit + Tesseract
      ),
      GoRoute(
        path: '/register-guest',
        name: 'register-guest',
        builder: (context, state) {
          final scannedData = state.extra as Map<String, String>?;
          return GuestRegistrationScreen(scannedData: scannedData);
        },
      ),
      GoRoute(
        path: '/guests',
        name: 'guests',
        builder: (context, state) => const GuestListScreen(),
      ),
      GoRoute(
        path: '/check-in',
        name: 'check-in',
        builder: (context, state) => const CheckInScreen(),
      ),
      GoRoute(
        path: '/check-out',
        name: 'check-out',
        builder: (context, state) => const CheckOutScreen(),
      ),
    ],
  );
}
