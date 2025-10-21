import 'package:flutter/material.dart';
import 'screens/home_screen.dart';

void main() {
  runApp(const MRZScannerApp());
}

class MRZScannerApp extends StatelessWidget {
  const MRZScannerApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'FREE MRZ Scanner',
      debugShowCheckedModeBanner: false,
      theme: ThemeData(
        colorScheme: ColorScheme.fromSeed(
          seedColor: Colors.blue,
          brightness: Brightness.light,
        ),
        useMaterial3: true,
      ),
      home: const HomeScreen(),
    );
  }
}
