import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:provider/provider.dart';
import 'providers/auth_provider.dart';
import 'providers/guest_provider.dart';
import 'providers/checkout_provider.dart';
import 'providers/escort_provider.dart';
import 'providers/room_provider.dart';
import 'providers/room_change_provider.dart';
import 'providers/notification_provider.dart';
import 'providers/theme_provider.dart';
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
        ChangeNotifierProvider(create: (_) => ThemeProvider()),
        ChangeNotifierProvider(create: (_) => AuthProvider()),
        ChangeNotifierProvider(create: (_) => GuestProvider()),
        ChangeNotifierProvider(create: (_) => CheckoutProvider()),
        ChangeNotifierProvider(create: (_) => EscortProvider()),
        ChangeNotifierProvider(create: (_) => RoomProvider()),
        ChangeNotifierProvider(create: (_) => RoomChangeProvider()),
        ChangeNotifierProvider(create: (_) => NotificationProvider()),
      ],
      child: Consumer<ThemeProvider>(
        builder: (context, themeProvider, child) {
          // Update system UI overlay style based on theme
          SystemChrome.setSystemUIOverlayStyle(
            SystemUiOverlayStyle(
              statusBarColor: Colors.transparent,
              statusBarIconBrightness:
                  themeProvider.isDarkMode ? Brightness.light : Brightness.dark,
              statusBarBrightness:
                  themeProvider.isDarkMode ? Brightness.dark : Brightness.light,
            ),
          );

          return MaterialApp.router(
            title: '1.IDM',
            debugShowCheckedModeBanner: false,
            debugShowMaterialGrid: false,
            showPerformanceOverlay: false,
            showSemanticsDebugger: false,
            checkerboardRasterCacheImages: false,
            checkerboardOffscreenLayers: false,
            theme: AppTheme.lightTheme,
            darkTheme: AppTheme.darkTheme,
            themeMode:
                themeProvider.isDarkMode ? ThemeMode.dark : ThemeMode.light,
            routerConfig: AppRoutes.router,
          );
        },
      ),
    );
  }
}
