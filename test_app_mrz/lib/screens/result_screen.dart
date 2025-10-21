import 'package:flutter/material.dart';

class ResultScreen extends StatelessWidget {
  final Map<String, String> mrzData;

  const ResultScreen({super.key, required this.mrzData});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Scan Result'),
        backgroundColor: Theme.of(context).colorScheme.inversePrimary,
      ),
      body: SingleChildScrollView(
        padding: const EdgeInsets.all(24.0),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Center(
              child: Icon(
                Icons.check_circle,
                color: Colors.green,
                size: 80,
              ),
            ),
            const SizedBox(height: 16),
            Text(
              'MRZ Data Extracted',
              style: Theme.of(context).textTheme.headlineSmall,
              textAlign: TextAlign.center,
            ),
            const SizedBox(height: 32),
            _buildDataCard(context),
            const SizedBox(height: 24),
            Row(
              children: [
                Expanded(
                  child: OutlinedButton.icon(
                    onPressed: () => Navigator.pop(context),
                    icon: const Icon(Icons.arrow_back),
                    label: const Text('Scan Again'),
                  ),
                ),
                const SizedBox(width: 16),
                Expanded(
                  child: FilledButton.icon(
                    onPressed: () {
                      Navigator.popUntil(context, (route) => route.isFirst);
                    },
                    icon: const Icon(Icons.home),
                    label: const Text('Home'),
                  ),
                ),
              ],
            ),
          ],
        ),
      ),
    );
  }

  Widget _buildDataCard(BuildContext context) {
    return Card(
      elevation: 2,
      child: Padding(
        padding: const EdgeInsets.all(16.0),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            _buildDataRow(context, 'Document Type', mrzData['type'] ?? ''),
            const Divider(),
            _buildDataRow(context, 'First Name', mrzData['firstName'] ?? ''),
            _buildDataRow(context, 'Last Name', mrzData['lastName'] ?? ''),
            const Divider(),
            _buildDataRow(context, 'Document Number', mrzData['documentNumber'] ?? ''),
            _buildDataRow(context, 'Nationality', mrzData['nationality'] ?? ''),
            _buildDataRow(context, 'Sex', mrzData['sex'] ?? ''),
            const Divider(),
            _buildDataRow(context, 'Date of Birth', mrzData['dateOfBirth'] ?? ''),
            _buildDataRow(context, 'Expiry Date', mrzData['expiryDate'] ?? ''),
          ],
        ),
      ),
    );
  }

  Widget _buildDataRow(BuildContext context, String label, String value) {
    return Padding(
      padding: const EdgeInsets.symmetric(vertical: 8.0),
      child: Row(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          SizedBox(
            width: 140,
            child: Text(
              label,
              style: TextStyle(
                fontWeight: FontWeight.bold,
                color: Colors.grey[700],
              ),
            ),
          ),
          Expanded(
            child: Text(
              value,
              style: const TextStyle(fontSize: 16),
            ),
          ),
        ],
      ),
    );
  }
}
