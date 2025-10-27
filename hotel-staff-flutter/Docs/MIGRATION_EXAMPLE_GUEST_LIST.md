# Migration Example: Guest List Screen

## Before (Using Node.js API) vs After (Using QloApps API)

### BEFORE: Node.js API Implementation

```dart
// lib/screens/guest_list_screen_OLD.dart

import '../services/api_service.dart';

class GuestListScreen extends StatefulWidget {
  @override
  State<GuestListScreen> createState() => _GuestListScreenState();
}

class _GuestListScreenState extends State<GuestListScreen> {
  final _apiService = ApiService();
  List<Map<String, dynamic>> _guests = [];
  bool _isLoading = true;

  @override
  void initState() {
    super.initState();
    _loadGuests();
  }

  // ❌ OLD METHOD - Uses Node.js middleware
  Future<void> _loadGuests() async {
    setState(() => _isLoading = true);
    
    try {
      // Call Node.js API endpoint
      final response = await _apiService.get('/guests');
      
      setState(() {
        _guests = List<Map<String, dynamic>>.from(response['data']);
        _isLoading = false;
      });
    } catch (e) {
      setState(() => _isLoading = false);
      ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(content: Text('Error: $e')),
      );
    }
  }

  // ❌ OLD METHOD - Search via Node.js
  Future<void> _searchGuests(String query) async {
    try {
      final response = await _apiService.get('/guests/search?q=$query');
      setState(() {
        _guests = List<Map<String, dynamic>>.from(response['data']);
      });
    } catch (e) {
      ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(content: Text('Search error: $e')),
      );
    }
  }

  @override
  Widget build(BuildContext context) {
    // ... UI code
  }
}
```

---

### AFTER: QloApps API Implementation

```dart
// lib/screens/guest_list_screen_NEW.dart

import '../services/qloapps_api_service.dart';

class GuestListScreen extends StatefulWidget {
  @override
  State<GuestListScreen> createState() => _GuestListScreenState();
}

class _GuestListScreenState extends State<GuestListScreen> {
  final _apiService = QloAppsApiService(); // ✅ Changed to QloApps
  List<dynamic> _guests = [];
  bool _isLoading = true;

  @override
  void initState() {
    super.initState();
    _loadGuests();
  }

  // ✅ NEW METHOD - Direct QloApps API
  Future<void> _loadGuests() async {
    setState(() => _isLoading = true);
    
    try {
      // Call QloApps WebService directly
      final guests = await _apiService.getCustomers(
        filters: {
          'display': 'full',           // Get all customer fields
          'sort': '[date_add_DESC]',   // Sort by newest first
          'limit': '100',              // Limit to 100 results
        },
      );
      
      setState(() {
        _guests = guests;
        _isLoading = false;
      });
    } catch (e) {
      setState(() => _isLoading = false);
      ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(content: Text('Error: $e')),
      );
    }
  }

  // ✅ NEW METHOD - Search directly in QloApps
  Future<void> _searchGuests(String query) async {
    if (query.isEmpty) {
      _loadGuests();
      return;
    }
    
    try {
      // Search by email or name
      final guests = await _apiService.getCustomers(
        filters: {
          'filter[email]': '%[$query]%',  // Wildcard search
          'display': 'full',
        },
      );
      
      setState(() => _guests = guests);
    } catch (e) {
      ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(content: Text('Search error: $e')),
      );
    }
  }

  // ✅ NEW METHOD - Get guest's bookings
  Future<void> _showGuestBookings(int customerId) async {
    try {
      final bookings = await _apiService.getOrdersByCustomer(customerId);
      
      // Show dialog with bookings
      showDialog(
        context: context,
        builder: (context) => AlertDialog(
          title: Text('Bookings (${bookings.length})'),
          content: SingleChildScrollView(
            child: Column(
              children: bookings.map((booking) {
                return ListTile(
                  title: Text('Order #${booking['id']}'),
                  subtitle: Text('${booking['reference']} - \$${booking['total_paid']}'),
                );
              }).toList(),
            ),
          ),
          actions: [
            TextButton(
              onPressed: () => Navigator.pop(context),
              child: const Text('Close'),
            ),
          ],
        ),
      );
    } catch (e) {
      ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(content: Text('Error loading bookings: $e')),
      );
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Guests'),
        actions: [
          IconButton(
            icon: const Icon(Icons.refresh),
            onPressed: _loadGuests,
          ),
        ],
      ),
      body: Column(
        children: [
          // Search bar
          Padding(
            padding: const EdgeInsets.all(16),
            child: TextField(
              decoration: const InputDecoration(
                hintText: 'Search by email...',
                prefixIcon: Icon(Icons.search),
                border: OutlineInputBorder(),
              ),
              onChanged: (value) {
                // Debounce search
                Future.delayed(const Duration(milliseconds: 500), () {
                  _searchGuests(value);
                });
              },
            ),
          ),
          
          // Guest list
          Expanded(
            child: _isLoading
              ? const Center(child: CircularProgressIndicator())
              : _guests.isEmpty
                ? const Center(child: Text('No guests found'))
                : ListView.builder(
                    itemCount: _guests.length,
                    itemBuilder: (context, index) {
                      final guest = _guests[index];
                      
                      // ✅ NEW - Access QloApps customer fields
                      final id = guest['id'];
                      final firstName = guest['firstname'] ?? '';
                      final lastName = guest['lastname'] ?? '';
                      final email = guest['email'] ?? '';
                      final phone = guest['phone'] ?? '';
                      final dateAdded = guest['date_add'] ?? '';
                      
                      return Card(
                        margin: const EdgeInsets.symmetric(
                          horizontal: 16,
                          vertical: 8,
                        ),
                        child: ListTile(
                          leading: CircleAvatar(
                            child: Text(
                              firstName.isNotEmpty ? firstName[0] : '?',
                            ),
                          ),
                          title: Text('$firstName $lastName'),
                          subtitle: Column(
                            crossAxisAlignment: CrossAxisAlignment.start,
                            children: [
                              Text(email),
                              if (phone.isNotEmpty) Text('📞 $phone'),
                              Text(
                                'Added: ${dateAdded.split(' ')[0]}',
                                style: const TextStyle(fontSize: 11),
                              ),
                            ],
                          ),
                          trailing: IconButton(
                            icon: const Icon(Icons.history),
                            onPressed: () => _showGuestBookings(int.parse(id)),
                            tooltip: 'View bookings',
                          ),
                          onTap: () {
                            // Navigate to guest details
                            Navigator.push(
                              context,
                              MaterialPageRoute(
                                builder: (context) => GuestDetailsScreen(
                                  customerId: int.parse(id),
                                ),
                              ),
                            );
                          },
                        ),
                      );
                    },
                  ),
          ),
        ],
      ),
      floatingActionButton: FloatingActionButton(
        onPressed: () {
          // Navigate to add new guest
          Navigator.push(
            context,
            MaterialPageRoute(
              builder: (context) => const AddGuestScreen(),
            ),
          ).then((_) => _loadGuests()); // Refresh after adding
        },
        child: const Icon(Icons.person_add),
      ),
    );
  }
}
```

---

## Key Differences Summary

| Aspect | Node.js API | QloApps API |
|--------|-------------|-------------|
| **Import** | `api_service.dart` | `qloapps_api_service.dart` |
| **Method** | `get('/guests')` | `getCustomers(filters: {...})` |
| **Response Type** | `Map<String, dynamic>` | `List<dynamic>` |
| **Data Access** | `response['data']` | Direct list |
| **Field Names** | Custom | QloApps standard (`firstname`, `lastname`, `email`) |
| **Search** | `/guests/search?q=` | Filters: `'filter[email]': '%[query]%'` |
| **Filtering** | URL params | `filters` parameter |
| **Sorting** | `/guests?sort=name` | `'sort': '[date_add_DESC]'` |
| **Pagination** | `/guests?page=1&limit=50` | `'limit': '50'` |

---

## Migration Checklist for Each Screen

### 1. Guest List Screen
- [ ] Import QloAppsApiService
- [ ] Replace `get('/guests')` with `getCustomers()`
- [ ] Update data access: `response['data']` → direct list
- [ ] Update field names to QloApps format
- [ ] Implement QloApps filters for search
- [ ] Test thoroughly

### 2. Guest Details Screen
- [ ] Replace `get('/guests/:id')` with `getCustomer(id)`
- [ ] Update field access
- [ ] Load related data (addresses, orders)
- [ ] Test edit functionality

### 3. Add Guest Screen
- [ ] Replace `post('/guests', data)` with `createCustomer(...)`
- [ ] Build proper request data
- [ ] Handle response
- [ ] Test validation

### 4. Guest Registration Screen
- [ ] Check if guest exists: `searchCustomerByEmail()`
- [ ] Create if not exists: `createCustomer()`
- [ ] Link to booking
- [ ] Test MRZ integration

### 5. Booking Management
- [ ] Replace `get('/bookings')` with `getOrders()`
- [ ] Update order creation logic
- [ ] Test booking flow
- [ ] Verify payment integration

---

## Testing Strategy

### 1. Unit Tests
```dart
test('QloApps API can retrieve customers', () async {
  final api = QloAppsApiService();
  final customers = await api.getCustomers();
  
  expect(customers, isNotEmpty);
  expect(customers[0], containsKey('id'));
  expect(customers[0], containsKey('email'));
});
```

### 2. Integration Tests
```dart
testWidgets('Guest list loads from QloApps', (tester) async {
  await tester.pumpWidget(MyApp());
  await tester.tap(find.text('Guests'));
  await tester.pumpAndSettle();
  
  expect(find.byType(ListTile), findsWidgets);
});
```

### 3. Manual Testing
1. Run app on device
2. Navigate to guest list
3. Verify guests load
4. Test search functionality
5. Test adding new guest
6. Check error handling
7. Verify performance

---

## Rollback Plan

If QloApps API doesn't work as expected:

1. **Keep Node.js code**: Don't delete old files immediately
2. **Feature flag**: Use conditional logic
   ```dart
   final useQloApps = false; // Set to true when ready
   
   if (useQloApps) {
     await QloAppsApiService().getCustomers();
   } else {
     await ApiService().get('/guests');
   }
   ```
3. **Gradual migration**: Migrate screen by screen
4. **Monitor logs**: Check for errors in production
5. **Easy rollback**: Just change flag to `false`

---

## Performance Comparison

### Load 100 Guests

**Node.js API:**
```
Request → Node.js Server → Parse → Query MySQL → Transform → Response
⏱️ ~500-800ms
```

**QloApps API:**
```
Request → QloApps WebService → Query MySQL → Response
⏱️ ~300-500ms
```

**Winner:** QloApps (fewer hops) ⚡

---

## Final Recommendation

✅ **Use QloApps API for:**
- Standard guest/customer operations (90% of use cases)
- Booking retrieval and display
- Room availability checks
- Standard CRUD operations

🔄 **Keep Node.js API for:**
- Complex business logic (bulk operations, analytics)
- Real-time features (if needed)
- Custom integrations
- Features not supported by QloApps API

🎯 **Hybrid Approach:**
Start with QloApps API for basic screens, keep Node.js for advanced features.

---

**Next Step:** Generate your API key and test connection! 🚀
