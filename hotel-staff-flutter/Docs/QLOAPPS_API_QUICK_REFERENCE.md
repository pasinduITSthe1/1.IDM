# QloApps WebService API - Quick Reference

## 🚀 Quick Start (5 Minutes)

### Step 1: Generate API Key
```
1. Open: http://localhost/1.IDM/admin134miqa0b (your QloApps admin)
2. Go to: Advanced Parameters > Webservice
3. Click: "Add new"
4. Fill in:
   - Key: Click "Generate!" button
   - Description: "Flutter Hotel Staff App"
   - Status: YES
5. Set Permissions (check ALL boxes for these resources):
   ✅ customers
   ✅ addresses
   ✅ orders
   ✅ products
   ✅ hotels
6. Click SAVE
7. COPY the generated key
```

### Step 2: Update Flutter App
```dart
// Open: lib/services/qloapps_api_service.dart
// Line 18: Replace this:
static const String apiKey = 'YOUR_QLOAPPS_API_KEY_HERE';

// With your actual key:
static const String apiKey = 'ABC123XYZ789...'; // Your copied key
```

### Step 3: Test Connection
```dart
// Add test route to your router
GoRoute(
  path: '/api-test',
  builder: (context, state) => const QloAppsApiTestScreen(),
),

// Or test programmatically:
final isConnected = await QloAppsApiService().testConnection();
print(isConnected ? '✅ Connected!' : '❌ Failed');
```

## 📚 Common API Calls

### Get All Guests
```dart
final guests = await QloAppsApiService().getCustomers(
  filters: {
    'display': 'full',        // Get all fields
    'limit': '50',            // Limit results
    'sort': '[id_DESC]',      // Sort by ID descending
  }
);

// Response: List<dynamic> of customer objects
for (var guest in guests) {
  print('${guest['firstname']} ${guest['lastname']}');
}
```

### Search Guest by Email
```dart
final guest = await QloAppsApiService().searchCustomerByEmail(
  'john.doe@example.com'
);

if (guest != null) {
  print('Found: ${guest['firstname']} ${guest['lastname']}');
  print('ID: ${guest['id']}');
} else {
  print('Guest not found');
}
```

### Create New Guest
```dart
final newGuest = await QloAppsApiService().createCustomer(
  firstName: 'John',
  lastName: 'Doe',
  email: 'john.doe@example.com',
  password: 'SecurePass123!',
  phone: '+1234567890',
  dateOfBirth: '1990-05-15',
);

print('Created customer ID: ${newGuest['customer']['id']}');
```

### Get Recent Bookings (Last 30 Days)
```dart
final bookings = await QloAppsApiService().getRecentOrders();

print('Found ${bookings.length} recent bookings');
for (var booking in bookings) {
  print('Order #${booking['id']} - ${booking['reference']}');
  print('Customer: ${booking['id_customer']}');
  print('Total: \$${booking['total_paid']}');
}
```

### Get Guest's Bookings
```dart
final customerId = 123;
final bookings = await QloAppsApiService().getOrdersByCustomer(customerId);

print('${bookings.length} bookings for customer #$customerId');
```

### Get Available Rooms
```dart
final rooms = await QloAppsApiService().getActiveRooms();

for (var room in rooms) {
  print('Room: ${room['name']}');
  print('Price: \$${room['price']}');
}
```

### Get All Hotels
```dart
final hotels = await QloAppsApiService().getHotels();

for (var hotel in hotels) {
  print('Hotel: ${hotel['hotel_name']}');
  print('Address: ${hotel['address']}');
}
```

## 🔍 Advanced Filters

### Filter Syntax
```dart
filters: {
  // Exact match
  'filter[email]': '[john@example.com]',
  
  // Greater than
  'filter[date_add]': '>[2025-10-01]',
  
  // Less than
  'filter[id]': '<[100]',
  
  // Range
  'filter[id]': '[10,50]',
  
  // Multiple values (OR)
  'filter[id]': '[1|5|10]',
  
  // Display specific fields only
  'display': '[id,firstname,lastname,email]',
  
  // Display all fields
  'display': 'full',
  
  // Limit results
  'limit': '10',
  
  // Sort
  'sort': '[id_DESC]',  // or [id_ASC]
}
```

### Complex Example
```dart
// Get customers created in October 2025 with email containing "gmail"
final customers = await QloAppsApiService().getCustomers(
  filters: {
    'filter[date_add]': '>[2025-10-01 00:00:00]<[2025-10-31 23:59:59]',
    'filter[email]': '%[gmail]%',
    'display': 'full',
    'sort': '[date_add_DESC]',
    'limit': '20',
  }
);
```

## 🏗️ Available Resources

| Resource | Description | GET | POST | PUT | DELETE |
|----------|-------------|-----|------|-----|--------|
| `customers` | Guest profiles | ✅ | ✅ | ✅ | ✅ |
| `addresses` | Guest addresses | ✅ | ✅ | ✅ | ✅ |
| `orders` | Bookings/reservations | ✅ | ✅ | ✅ | ⚠️ |
| `order_details` | Booking line items | ✅ | ❌ | ❌ | ❌ |
| `products` | Rooms (as products) | ✅ | ⚠️ | ⚠️ | ⚠️ |
| `hotels` | Hotel information | ✅ | ⚠️ | ⚠️ | ❌ |
| `rooms` | Room availability | ✅ | ❌ | ❌ | ❌ |
| `carriers` | Delivery methods | ✅ | ⚠️ | ⚠️ | ⚠️ |
| `countries` | Country list | ✅ | ❌ | ❌ | ❌ |
| `states` | State/province list | ✅ | ❌ | ❌ | ❌ |

✅ = Recommended  
⚠️ = Use with caution (may affect bookings)  
❌ = Not available/not recommended

## ⚡ Performance Tips

### 1. Use Display Filters
```dart
// ❌ Bad - Downloads all fields
await api.getCustomers();

// ✅ Good - Only get needed fields
await api.getCustomers(filters: {
  'display': '[id,firstname,lastname,email]'
});
```

### 2. Limit Results
```dart
// ❌ Bad - May return thousands
await api.getOrders();

// ✅ Good - Paginate results
await api.getOrders(filters: {'limit': '50'});
```

### 3. Cache Responses
```dart
class GuestService {
  List<dynamic>? _cachedGuests;
  DateTime? _cacheTime;
  
  Future<List<dynamic>> getGuests() async {
    // Return cache if less than 5 minutes old
    if (_cachedGuests != null && 
        _cacheTime != null &&
        DateTime.now().difference(_cacheTime!) < Duration(minutes: 5)) {
      return _cachedGuests!;
    }
    
    // Fetch fresh data
    _cachedGuests = await QloAppsApiService().getCustomers();
    _cacheTime = DateTime.now();
    return _cachedGuests!;
  }
}
```

## 🐛 Common Issues & Solutions

### Issue 1: 401 Unauthorized
```
Error: QloApps API Error: 401
```
**Solution:**
- Check API key is correct in `qloapps_api_service.dart`
- Verify key is active in QloApps admin
- Check permissions are set for the resource

### Issue 2: 405 Method Not Allowed
```
Error: QloApps API Error: 405
```
**Solution:**
- Check resource supports that HTTP method (GET/POST/PUT/DELETE)
- Verify permissions include that method in admin panel

### Issue 3: Empty Response
```
Response: {"customers": []}
```
**Solution:**
- Check filter syntax is correct
- Try without filters to see if data exists
- Verify database has data for that resource

### Issue 4: Connection Timeout
```
Error: Network error: SocketException
```
**Solution:**
- Check QloApps is running: `http://localhost/1.IDM`
- Verify firewall allows connections
- Check baseUrl in `qloapps_api_service.dart` is correct

### Issue 5: XML/JSON Parsing Error
```
Error: FormatException: Unexpected character
```
**Solution:**
- Ensure `output_format=JSON` is in query params
- Check QloApps version supports JSON (may need XML parser)
- Verify response is valid JSON

## 🔐 Security Checklist

- [ ] API key stored securely (not in Git)
- [ ] Use HTTPS in production (not HTTP)
- [ ] Limit permissions to only needed resources
- [ ] Use separate keys for dev/staging/production
- [ ] Rotate keys periodically
- [ ] Monitor API usage logs
- [ ] Implement rate limiting on client side
- [ ] Validate all user input before API calls

## 📊 Testing Checklist

- [ ] Connection test passes
- [ ] Can retrieve customers
- [ ] Can search customer by email
- [ ] Can create new customer
- [ ] Can retrieve orders
- [ ] Can retrieve rooms/products
- [ ] Filters work correctly
- [ ] Error handling works
- [ ] Performance is acceptable
- [ ] Works on real device (not just emulator)

## 🚀 Next Steps

1. **Replace Node.js calls** in existing screens:
   ```dart
   // Old (Node.js)
   await ApiService().get('/guests');
   
   // New (QloApps)
   await QloAppsApiService().getCustomers();
   ```

2. **Update models** to match QloApps response format

3. **Add error handling** for QloApps-specific errors

4. **Implement caching** for frequently accessed data

5. **Test thoroughly** with real QloApps data

## 📞 Support

- **QloApps Documentation**: Check `/webservice/` folder in installation
- **PrestaShop API Docs**: QloApps is based on PrestaShop
- **Test Endpoint**: `http://localhost/1.IDM/api/?ws_key=YOUR_KEY`

---
**Last Updated:** October 23, 2025  
**Status:** Ready to use  
**Complexity:** Low-Medium  
**Estimated Migration Time:** 1-2 days
