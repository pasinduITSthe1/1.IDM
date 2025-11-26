# Room Change Feature - Integration Guide

## Quick Start Integration

Follow these steps to integrate the Room Change feature into your Flutter app.

### Step 1: Setup Database Table

Run the SQL script to create the `roomchange` table:

```bash
# Navigate to your database
mysql -u your_user -p your_database

# Run the SQL file
source database_roomchange_table.sql

# Or manually execute:
mysql -u your_user -p your_database < database_roomchange_table.sql
```

### Step 2: Register Provider in main.dart

Add `RoomChangeProvider` to your MultiProvider list:

```dart
import 'package:provider/provider.dart';
import 'providers/room_change_provider.dart'; // Add this import

void main() {
  runApp(
    MultiProvider(
      providers: [
        // ... your existing providers
        ChangeNotifierProvider(create: (_) => RoomProvider()),
        ChangeNotifierProvider(create: (_) => RoomChangeProvider()), // ← Add this
      ],
      child: MyApp(),
    ),
  );
}
```

### Step 3: Add Navigation Menu Item

Add a menu item to access Room Changes. Update your menu/navigation screen:

```dart
// In your main navigation screen or drawer
ListTile(
  leading: const Icon(Icons.swap_horiz, color: Colors.blue),
  title: const Text('Room Changes'),
  subtitle: const Text('Manage guest room changes'),
  onTap: () {
    Navigator.push(
      context,
      MaterialPageRoute(
        builder: (context) => const RoomChangeListScreen(),
      ),
    );
  },
),
```

### Step 4: Add Quick Access from Room Details (Optional)

If you have a room details screen, add a button to quickly create room changes for occupied rooms:

```dart
import '../screens/room_change/create_room_change_screen.dart';

// In your room details screen, add this button for occupied rooms:
if (room.isOccupiedStatus) ...[
  const SizedBox(height: 16),
  ElevatedButton.icon(
    onPressed: () {
      Navigator.push(
        context,
        MaterialPageRoute(
          builder: (context) => CreateRoomChangeScreen(
            initialRoom: room,
            bookingId: room.bookingId,
          ),
        ),
      );
    },
    icon: const Icon(Icons.swap_horiz),
    label: const Text('Change Room'),
    style: ElevatedButton.styleFrom(
      backgroundColor: Colors.orange,
      minimumSize: const Size(double.infinity, 50),
    ),
  ),
]
```

### Step 5: Test the Backend API

Before using the feature, test the backend API:

```bash
# Test get all room changes
curl "http://localhost/1.IDM/api/room-change.php?action=get-all"

# Test get statistics
curl "http://localhost/1.IDM/api/room-change.php?action=statistics"

# Test available rooms (replace with your actual values)
curl "http://localhost/1.IDM/api/room-change.php?action=available-rooms&check_in_date=2024-12-01&check_out_date=2024-12-05&current_room_id=1"
```

### Step 6: Update Network Configuration (If needed)

Verify your `network_config.dart` has the correct IP address:

```dart
// lib/utils/network_config.dart
class NetworkConfig {
  static const String computerIp = 'YOUR_IP_ADDRESS'; // Update this
  // ... rest of the config
}
```

### Step 7: Run the App

```bash
cd hotel-staff-flutter
flutter pub get  # Install any missing dependencies
flutter run      # Run on your device/emulator
```

## Usage Guide

### Creating a Room Change

1. **From Room Changes Screen:**
   - Open the app menu
   - Tap "Room Changes"
   - Tap the blue "+" button (New Room Change)
   - Fill in the form:
     - Enter guest name
     - Select check-in and check-out dates
     - Choose current occupied room
     - Select new available room
     - Enter reason for change
     - Enter staff name
     - (Optional) Add notes
   - Tap "Create Room Change"

2. **From Room Details (Quick Access):**
   - View an occupied room
   - Tap "Change Room" button
   - Form pre-filled with room and guest info
   - Select new room and complete form

### Managing Room Changes

1. **View All Changes:**
   - Open "Room Changes" from menu
   - See statistics at top (Total, Pending, Completed)
   - Filter by status using chips (All, Pending, Completed, Cancelled)
   - Pull down to refresh

2. **View Details:**
   - Tap any room change card
   - View complete information
   - See old → new room comparison

3. **Update Status:**
   - Open a pending room change
   - Tap "Complete" to mark as completed
   - Tap "Cancel" to mark as cancelled
   - Optionally add notes
   - Confirm action

## Verification Checklist

After integration, verify:

- [ ] Database table created successfully
- [ ] Provider registered in main.dart
- [ ] Navigation menu item added
- [ ] Backend API accessible and returning data
- [ ] Can create new room change
- [ ] Can view list of room changes
- [ ] Can filter by status
- [ ] Can view room change details
- [ ] Can complete/cancel pending changes
- [ ] Statistics display correctly
- [ ] Available rooms load correctly

## Troubleshooting

### Issue: "Failed to load room changes"
**Solution:** Check:
- Backend API is running
- Database table exists
- Network configuration IP is correct
- API URL in network_config.dart is correct

### Issue: "No available rooms found"
**Solution:**
- Ensure dates are selected
- Check if rooms are actually available for those dates
- Verify current room is selected
- Check database has rooms with active status

### Issue: "Provider not found"
**Solution:**
- Verify RoomChangeProvider is registered in main.dart
- Ensure import statement is correct
- Restart the app after adding provider

### Issue: Room change created but booking not updated
**Solution:**
- Check database transaction support
- Verify booking_id is correct
- Check htl_booking_detail table exists
- Review API logs for errors

## File Changes Summary

**New Files Created:**
```
✅ database_roomchange_table.sql
✅ api/room-change.php
✅ lib/models/room_change.dart
✅ lib/services/room_change_service.dart
✅ lib/providers/room_change_provider.dart
✅ lib/screens/room_change/room_change_list_screen.dart
✅ lib/screens/room_change/room_change_details_screen.dart
✅ lib/screens/room_change/create_room_change_screen.dart
✅ ROOM_CHANGE_FEATURE.md
✅ ROOM_CHANGE_INTEGRATION.md (this file)
```

**Files to Modify:**
```
📝 lib/main.dart - Add RoomChangeProvider
📝 lib/screens/menu_screen.dart (or navigation) - Add menu item
📝 lib/screens/rooms/room_details_screen.dart (optional) - Add quick access button
```

## Next Steps After Integration

1. **Test the Feature Thoroughly:**
   - Create room changes with different scenarios
   - Test all status transitions
   - Verify database updates correctly

2. **Customize as Needed:**
   - Adjust colors to match your theme
   - Modify form fields if needed
   - Add additional validations

3. **Train Staff:**
   - Create user guide for staff
   - Demonstrate the workflow
   - Explain status meanings

4. **Monitor Performance:**
   - Check API response times
   - Monitor database queries
   - Optimize if needed

## Support

If you encounter any issues:
1. Check the troubleshooting section above
2. Review the ROOM_CHANGE_FEATURE.md documentation
3. Verify all integration steps completed
4. Check console logs for error messages

---

**Feature Status: ✅ READY FOR INTEGRATION**

All components are implemented and ready to use!
