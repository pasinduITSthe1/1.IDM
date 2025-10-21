import 'package:flutter/material.dart';
import 'package:flutter_test/flutter_test.dart';
import 'package:test_app_mrz/main.dart';

void main() {
  testWidgets('App smoke test', (WidgetTester tester) async {
    await tester.pumpWidget(const MRZScannerApp());
    expect(find.text('FREE MRZ Scanner'), findsOneWidget);
  });
}
