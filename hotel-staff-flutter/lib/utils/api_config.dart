// API Configuration
//
// ⚠️ DEPRECATED: This file is kept for backward compatibility only.
//
// 👉 Please use NetworkConfig (network_config.dart) instead!
//    Change IP address in ONE PLACE: lib/utils/network_config.dart
//
// NetworkConfig automatically switches between WiFi and USB tethering modes.

import 'network_config.dart';

class ApiConfig {
  // Using centralized network configuration
  static String get baseUrl => NetworkConfig.nodeBackendUrl;

  static const Duration connectionTimeout = NetworkConfig.connectionTimeout;
  static const Duration receiveTimeout = NetworkConfig.receiveTimeout;

  // API Endpoints
  static const String authLogin = '/auth/login';
  static const String authRegister = '/auth/register';
  static const String guests = '/guests';
  static const String rooms = '/rooms';
  static const String health = '/health';
}
