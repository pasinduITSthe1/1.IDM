import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:provider/provider.dart';
import 'providers/auth_provider.dart';
import 'providers/guest_provider.dart';
import 'providers/checkout_provider.dart';
import 'providers/escort_provider.dart';
import 'providers/room_provider.dart';
import 'providers/notification_provider.dart';
import 'utils/app_theme.dart';
import 'utils/app_routes.dart';

void main() async {
  WidgetsFlutterBinding.ensureInitialized();

  // Set preferred orientations
  await SystemChrome.setPreferredOrientations([
    DeviceOrientation.portraitUp,
    DeviceOrientation.portraitDown,
  ]);

  // Set status bar style
  SystemChrome.setSystemUIOverlayStyle(
    const SystemUiOverlayStyle(
      statusBarColor: Colors.transparent,
      statusBarIconBrightness: Brightness.dark,
    ),
  );

  runApp(const HotelStaffApp());
}

class HotelStaffApp extends StatelessWidget {
  const HotelStaffApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MultiProvider(
      providers: [
        ChangeNotifierProvider(create: (_) => AuthProvider()),
        ChangeNotifierProvider(create: (_) => GuestProvider()),
        ChangeNotifierProvider(create: (_) => CheckoutProvider()),
        ChangeNotifierProvider(create: (_) => EscortProvider()),
        ChangeNotifierProvider(create: (_) => RoomProvider()),
        ChangeNotifierProvider(create: (_) => NotificationProvider()),
      ],
      child: MaterialApp.router(
        title: '1.IDM',
        debugShowCheckedModeBanner: false,
        theme: AppTheme.lightTheme,
        routerConfig: AppRoutes.router,
      ),
    );
  }
}
