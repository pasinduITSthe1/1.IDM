import 'package:go_router/go_router.dart';
import '../screens/login_screen.dart';
import '../screens/dashboard_screen.dart';
import '../screens/scan_document_screen_v2.dart';
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
        builder: (context, state) => const ScanDocumentScreen(),
      ),
      GoRoute(
        path: '/register',
        name: 'register',
        builder: (context, state) {
          final extra = state.extra as Map<String, dynamic>?;
          return GuestRegistrationScreen(scannedData: extra?['scannedData']);
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
