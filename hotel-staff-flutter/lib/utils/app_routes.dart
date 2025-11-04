import 'package:go_router/go_router.dart';
import '../screens/splash_screen.dart';
import '../screens/login_screen.dart';
import '../screens/dashboard_screen.dart';
import '../screens/mrz_scanner_screen.dart'; // FREE: ML Kit + Tesseract Scanner
import '../screens/id_photo_capture_screen.dart'; // ID Photo Capture
import '../screens/guest_registration_screen.dart';
import '../screens/guest_list_screen.dart';
import '../screens/check_in_screen.dart';
import '../screens/check_out_screen.dart';
import '../screens/guest_escorts_screen.dart';
import '../screens/escort_registration_screen.dart';
import '../models/guest.dart';

class AppRoutes {
  static final GoRouter router = GoRouter(
    initialLocation: '/',
    routes: [
      GoRoute(
        path: '/',
        name: 'splash',
        builder: (context, state) => const SplashScreen(),
      ),
      GoRoute(
        path: '/login',
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
        builder: (context, state) {
          return const MRZScannerScreen(); // FREE: ML Kit + Tesseract
        },
      ),
      GoRoute(
        path: '/capture-id-photos',
        name: 'capture-id-photos',
        builder: (context, state) {
          final mrzData = state.extra as Map<String, String>;
          return IDPhotoCaptureScreen(mrzData: mrzData);
        },
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
      GoRoute(
        path: '/guest/:guestId/escorts',
        name: 'guest-escorts',
        builder: (context, state) {
          final guest = state.extra as Guest;
          return GuestEscortsScreen(guest: guest);
        },
      ),
      GoRoute(
        path: '/guest/:guestId/escorts/add',
        name: 'add-escort',
        builder: (context, state) {
          final extra = state.extra as Map<String, dynamic>;
          return EscortRegistrationScreen(
            guestId: extra['guestId'] as String,
            guestName: extra['guestName'] as String,
            scannedData: extra['scannedData'] as Map<String, dynamic>?,
          );
        },
      ),
    ],
  );
}
