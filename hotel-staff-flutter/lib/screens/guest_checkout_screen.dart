import 'package:flutter/material.dart';
import 'package:go_router/go_router.dart';
import 'package:provider/provider.dart';
import '../providers/guest_provider.dart';
import '../providers/checkout_provider.dart';
import '../models/guest.dart';
import '../utils/app_theme.dart';

class GuestCheckoutScreen extends StatefulWidget {
  final String guestId;

  const GuestCheckoutScreen({
    super.key,
    required this.guestId,
  });

  @override
  State<GuestCheckoutScreen> createState() => _GuestCheckoutScreenState();
}

class _GuestCheckoutScreenState extends State<GuestCheckoutScreen> {
  bool _isLoading = false;

  @override
  void initState() {
    super.initState();
    WidgetsBinding.instance.addPostFrameCallback((_) {
      _loadCheckoutData();
    });
  }

  Future<void> _loadCheckoutData() async {
    final checkoutProvider = context.read<CheckoutProvider>();
    final guestProvider = context.read<GuestProvider>();
    final guest = guestProvider.guests.firstWhere(
      (g) => g.id == widget.guestId,
      orElse: () => Guest(
        id: '',
        firstName: '',
        lastName: '',
      ),
    );

    if (guest.id.isNotEmpty) {
      setState(() => _isLoading = true);
      // Load bill data
      // await checkoutProvider.getBill(checkinId);
      setState(() => _isLoading = false);
    }
  }

  @override
  Widget build(BuildContext context) {
    final guestProvider = Provider.of<GuestProvider>(context);

    final guest = guestProvider.guests.firstWhere(
      (g) => g.id == widget.guestId,
      orElse: () => Guest(
        id: '',
        firstName: '',
        lastName: '',
      ),
    );

    if (guest.id.isEmpty) {
      return Scaffold(
        appBar: AppBar(title: const Text('Checkout')),
        body: const Center(child: Text('Guest not found')),
      );
    }

    return Scaffold(
      body: Container(
        decoration: const BoxDecoration(
          gradient: LinearGradient(
            begin: Alignment.topLeft,
            end: Alignment.bottomRight,
            colors: [
              AppTheme.primaryOrange,
              AppTheme.secondaryOrange,
            ],
          ),
        ),
        child: SafeArea(
          child: SingleChildScrollView(
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                // Header
                Padding(
                  padding: const EdgeInsets.all(16.0),
                  child: Row(
                    children: [
                      IconButton(
                        icon: const Icon(Icons.arrow_back, color: Colors.white),
                        onPressed: () => context.pop(),
                      ),
                      const Expanded(
                        child: Text(
                          'Check-Out',
                          style: TextStyle(
                            fontSize: 22,
                            fontWeight: FontWeight.bold,
                            color: Colors.white,
                          ),
                        ),
                      ),
                    ],
                  ),
                ),

                // Guest Info Card
                Padding(
                  padding: const EdgeInsets.symmetric(horizontal: 16.0),
                  child: Card(
                    elevation: 4,
                    shape: RoundedRectangleBorder(
                      borderRadius: BorderRadius.circular(12),
                    ),
                    child: Padding(
                      padding: const EdgeInsets.all(16.0),
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          Row(
                            children: [
                              CircleAvatar(
                                radius: 30,
                                backgroundColor:
                                    AppTheme.primaryOrange.withOpacity(0.1),
                                child: Text(
                                  guest.fullName.isNotEmpty
                                      ? guest.fullName[0].toUpperCase()
                                      : '?',
                                  style: const TextStyle(
                                    fontSize: 24,
                                    fontWeight: FontWeight.bold,
                                    color: AppTheme.primaryOrange,
                                  ),
                                ),
                              ),
                              const SizedBox(width: 16),
                              Expanded(
                                child: Column(
                                  crossAxisAlignment: CrossAxisAlignment.start,
                                  children: [
                                    Text(
                                      guest.fullName,
                                      style: const TextStyle(
                                        fontSize: 18,
                                        fontWeight: FontWeight.bold,
                                      ),
                                    ),
                                    const SizedBox(height: 4),
                                    Container(
                                      padding: const EdgeInsets.symmetric(
                                        horizontal: 8,
                                        vertical: 4,
                                      ),
                                      decoration: BoxDecoration(
                                        color: Colors.green.withOpacity(0.2),
                                        borderRadius:
                                            BorderRadius.circular(4),
                                      ),
                                      child: const Text(
                                        'CHECKED IN',
                                        style: TextStyle(
                                          color: Colors.green,
                                          fontSize: 11,
                                          fontWeight: FontWeight.bold,
                                        ),
                                      ),
                                    ),
                                  ],
                                ),
                              ),
                            ],
                          ),
                          const SizedBox(height: 16),
                          const Divider(),
                          const SizedBox(height: 12),
                          Row(
                            children: [
                              Expanded(
                                child: _buildInfoItem(
                                  Icons.email,
                                  guest.email ?? 'No email',
                                ),
                              ),
                              Expanded(
                                child: _buildInfoItem(
                                  Icons.phone,
                                  guest.phone ?? 'No phone',
                                ),
                              ),
                            ],
                          ),
                          const SizedBox(height: 12),
                          _buildInfoItem(
                            Icons.hotel,
                            'Room: ${guest.roomNumber ?? 'Not assigned'}',
                          ),
                        ],
                      ),
                    ),
                  ),
                ),

                const SizedBox(height: 24),

                // Bill Summary Section
                Padding(
                  padding: const EdgeInsets.symmetric(horizontal: 16.0),
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      const Text(
                        'Bill Summary',
                        style: TextStyle(
                          fontSize: 18,
                          fontWeight: FontWeight.bold,
                          color: Colors.white,
                        ),
                      ),
                      const SizedBox(height: 12),
                      Card(
                        elevation: 4,
                        child: Padding(
                          padding: const EdgeInsets.all(16.0),
                          child: Column(
                            children: [
                              _buildBillRow(
                                'Room Charges',
                                '\$500.00',
                              ),
                              const Divider(),
                              _buildBillRow(
                                'Room Service',
                                '\$45.00',
                              ),
                              _buildBillRow(
                                'Laundry',
                                '\$25.00',
                              ),
                              _buildBillRow(
                                'Spa Services',
                                '\$60.00',
                              ),
                              const SizedBox(height: 12),
                              const Divider(),
                              const SizedBox(height: 12),
                              _buildBillRow(
                                'Total Charges',
                                '\$630.00',
                                isBold: true,
                              ),
                              const SizedBox(height: 12),
                              const Divider(),
                              const SizedBox(height: 12),
                              _buildBillRow(
                                'Amount Paid',
                                '\$0.00',
                                color: Colors.grey,
                              ),
                              _buildBillRow(
                                'Balance Due',
                                '\$630.00',
                                color: Colors.red,
                                isBold: true,
                              ),
                            ],
                          ),
                        ),
                      ),
                    ],
                  ),
                ),

                const SizedBox(height: 24),

                // Payment Section
                Padding(
                  padding: const EdgeInsets.symmetric(horizontal: 16.0),
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      const Text(
                        'Payment Method',
                        style: TextStyle(
                          fontSize: 18,
                          fontWeight: FontWeight.bold,
                          color: Colors.white,
                        ),
                      ),
                      const SizedBox(height: 12),
                      Card(
                        child: Padding(
                          padding: const EdgeInsets.symmetric(
                            horizontal: 16.0,
                            vertical: 8.0,
                          ),
                          child: DropdownButton<String>(
                            isExpanded: true,
                            value: 'card',
                            items: const [
                              DropdownMenuItem(
                                value: 'cash',
                                child: Row(
                                  children: [
                                    Icon(Icons.money, size: 20),
                                    SizedBox(width: 8),
                                    Text('Cash'),
                                  ],
                                ),
                              ),
                              DropdownMenuItem(
                                value: 'card',
                                child: Row(
                                  children: [
                                    Icon(Icons.credit_card, size: 20),
                                    SizedBox(width: 8),
                                    Text('Credit Card'),
                                  ],
                                ),
                              ),
                              DropdownMenuItem(
                                value: 'check',
                                child: Row(
                                  children: [
                                    Icon(Icons.receipt, size: 20),
                                    SizedBox(width: 8),
                                    Text('Check'),
                                  ],
                                ),
                              ),
                              DropdownMenuItem(
                                value: 'transfer',
                                child: Row(
                                  children: [
                                    Icon(Icons.account_balance, size: 20),
                                    SizedBox(width: 8),
                                    Text('Bank Transfer'),
                                  ],
                                ),
                              ),
                            ],
                            onChanged: (value) {},
                          ),
                        ),
                      ),
                    ],
                  ),
                ),

                const SizedBox(height: 24),

                // Action Buttons
                Padding(
                  padding: const EdgeInsets.symmetric(horizontal: 16.0),
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.stretch,
                    children: [
                          ElevatedButton.icon(
                        onPressed: _isLoading
                            ? null
                            : () => _handlePaymentAndCheckout(
                                  context,
                                  guest,
                                ),
                        icon: _isLoading
                            ? const SizedBox(
                                width: 20,
                                height: 20,
                                child: CircularProgressIndicator(
                                  strokeWidth: 2,
                                ),
                              )
                            : const Icon(Icons.check),
                        label: Text(
                          _isLoading ? 'Processing...' : 'Complete Payment & Checkout',
                        ),
                        style: ElevatedButton.styleFrom(
                          backgroundColor: Colors.green,
                          foregroundColor: Colors.white,
                          padding: const EdgeInsets.symmetric(vertical: 14),
                          shape: RoundedRectangleBorder(
                            borderRadius: BorderRadius.circular(8),
                          ),
                        ),
                      ),
                      const SizedBox(height: 12),
                      // Cancel Button
                      OutlinedButton.icon(
                        onPressed: () => context.pop(),
                        icon: const Icon(Icons.close),
                        label: const Text('Cancel'),
                        style: OutlinedButton.styleFrom(
                          padding: const EdgeInsets.symmetric(vertical: 14),
                          shape: RoundedRectangleBorder(
                            borderRadius: BorderRadius.circular(8),
                          ),
                        ),
                      ),
                    ],
                  ),
                ),

                const SizedBox(height: 32),
              ],
            ),
          ),
        ),
      ),
    );
  }

  Widget _buildInfoItem(IconData icon, String text) {
    return Row(
      children: [
        Icon(icon, size: 16, color: Colors.grey[600]),
        const SizedBox(width: 8),
        Expanded(
          child: Text(
            text,
            style: TextStyle(
              fontSize: 13,
              color: Colors.grey[700],
            ),
            overflow: TextOverflow.ellipsis,
          ),
        ),
      ],
    );
  }

  Widget _buildBillRow(
    String label,
    String amount, {
    bool isBold = false,
    Color? color,
  }) {
    return Row(
      mainAxisAlignment: MainAxisAlignment.spaceBetween,
      children: [
        Text(
          label,
          style: TextStyle(
            fontWeight: isBold ? FontWeight.bold : FontWeight.normal,
            fontSize: 14,
          ),
        ),
        Text(
          amount,
          style: TextStyle(
            fontWeight: isBold ? FontWeight.bold : FontWeight.normal,
            fontSize: 14,
            color: color,
          ),
        ),
      ],
    );
  }

  Future<void> _handlePaymentAndCheckout(
    BuildContext context,
    Guest guest,
  ) async {
    final checkoutProvider = context.read<CheckoutProvider>();
    setState(() => _isLoading = true);

    try {
      // Record payment
      final paymentSuccess = await checkoutProvider.recordPayment(
        customerId: int.parse(guest.id),
        checkinId: 1001, // This should come from guest data
        amount: 630.00,
        paymentMethod: 'card',
      );

      if (!paymentSuccess && context.mounted) {
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(
            content: Text('Payment failed: ${checkoutProvider.errorMessage}'),
            backgroundColor: Colors.red,
          ),
        );
        setState(() => _isLoading = false);
        return;
      }

      // Perform checkout
      final checkoutSuccess = await checkoutProvider.checkOut(
        customerId: int.parse(guest.id),
        checkinId: 1001,
        roomId: 789,
        finalBill: 630.00,
        paymentStatus: 'paid',
      );

      if (context.mounted) {
        setState(() => _isLoading = false);

        if (checkoutSuccess) {
          ScaffoldMessenger.of(context).showSnackBar(
            SnackBar(
              content: Text('${guest.fullName} checked out successfully!'),
              backgroundColor: Colors.green,
            ),
          );
          // Navigate back
          if (context.mounted) {
            context.pop();
          }
        } else {
          ScaffoldMessenger.of(context).showSnackBar(
            SnackBar(
              content: Text('Checkout failed: ${checkoutProvider.errorMessage}'),
              backgroundColor: Colors.red,
            ),
          );
        }
      }
    } catch (e) {
      if (context.mounted) {
        setState(() => _isLoading = false);
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(
            content: Text('Error: $e'),
            backgroundColor: Colors.red,
          ),
        );
      }
    }
  }
}
