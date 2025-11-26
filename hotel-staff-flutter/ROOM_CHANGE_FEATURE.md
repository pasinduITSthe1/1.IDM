# Guest Room Change Feature

## Overview
This feature allows hotel staff to change a guest's room assignment when needed (e.g., room maintenance issues, guest request for upgrade/downgrade, or other operational reasons). The feature includes full tracking of room changes with reasons, staff accountability, and status management.

## Database Structure

### Table: `roomchange`
Located in: `database_roomchange_table.sql`

**Fields:**
- `id` - Primary key (auto-increment)
- `booking_id` - Reference to the guest's booking
- `guest_name` - Guest's full name
- `old_room_id` - Previous room ID
- `old_room_num` - Previous room number
- `new_room_id` - New room ID
- `new_room_num` - New room number
- `change_reason` - Reason for the room change (required)
- `changed_by` - Staff member who made the change
- `change_date` - Timestamp of when change was made
- `check_in_date` - Guest check-in date
- `check_out_date` - Guest check-out date
- `status` - Status of room change (pending, completed, cancelled)
- `notes` - Additional notes about the change
- `created_at` - Record creation timestamp
- `updated_at` - Last update timestamp

## Backend API

### Endpoint: `/api/room-change.php`

**Methods:**

#### GET Actions:
1. **Get All Room Changes**
   - Action: `get-all`
   - Parameters: `status` (optional), `limit`, `offset`
   - Returns: List of all room changes with detailed information

2. **Get Room Change by ID**
   - Action: `get-by-id`
   - Parameters: `id`
   - Returns: Single room change details

3. **Get Room Changes by Booking**
   - Action: `get-by-booking`
   - Parameters: `booking_id`
   - Returns: All room changes for a specific booking

4. **Get Available Rooms**
   - Action: `available-rooms`
   - Parameters: `check_in_date`, `check_out_date`, `current_room_id`
   - Returns: List of available rooms for the date range

5. **Get Statistics**
   - Action: `statistics`
   - Parameters: `start_date` (optional), `end_date` (optional)
   - Returns: Room change statistics

#### POST Actions:
1. **Create Room Change**
   - Action: `create`
   - Body: RoomChangeRequest JSON
   - Process: 
     - Validates required fields
     - Checks room availability
     - Creates room change record in transaction
     - Updates booking with new room
     - Commits or rolls back transaction

2. **Update Status**
   - Action: `update-status`
   - Body: `id`, `status`, `notes` (optional)
   - Updates room change status

## Flutter Implementation

### Models (`lib/models/room_change.dart`)

**Classes:**
1. `RoomChange` - Main room change data model
2. `RoomChangeRequest` - Request model for creating changes
3. `RoomChangeStatistics` - Statistics data model

### Service Layer (`lib/services/room_change_service.dart`)

**Methods:**
- `getAllRoomChanges()` - Fetch all room changes with filters
- `getRoomChangeById()` - Get specific room change
- `getRoomChangesByBookingId()` - Get changes for a booking
- `getAvailableRoomsForChange()` - Get available rooms
- `createRoomChange()` - Create new room change
- `updateRoomChangeStatus()` - Update status
- `getRoomChangeStatistics()` - Get statistics
- Helper methods: `completeRoomChange()`, `cancelRoomChange()`, `getPendingRoomChanges()`, `getCompletedRoomChanges()`

### State Management (`lib/providers/room_change_provider.dart`)

**Provider: RoomChangeProvider**

**Properties:**
- `roomChanges` - List of room changes
- `availableRooms` - Available rooms for change
- `statistics` - Room change statistics
- `isLoading` - Loading state
- `isLoadingAvailableRooms` - Available rooms loading state
- `error` - Error message
- `statusFilter` - Current status filter

**Methods:**
- `loadRoomChanges()` - Load room changes
- `loadRoomChangeById()` - Load single change
- `loadRoomChangesByBookingId()` - Load changes by booking
- `loadAvailableRoomsForChange()` - Load available rooms
- `createRoomChange()` - Create new change
- `updateRoomChangeStatus()` - Update status
- `completeRoomChange()` - Mark as completed
- `cancelRoomChange()` - Mark as cancelled
- `loadStatistics()` - Load statistics
- `refresh()` - Refresh all data
- `filterByStatus()` - Filter by status

### UI Screens

#### 1. Room Change List Screen (`room_change_list_screen.dart`)
**Features:**
- Statistics cards (Total, Pending, Completed)
- Filter chips (All, Pending, Completed, Cancelled)
- List of room changes with details
- Swipe to refresh
- Floating action button to create new change

**Card Display:**
- Guest name and booking ID
- Status badge with color coding
- Old room → New room with arrow
- Room types
- Change reason
- Staff name and timestamp

#### 2. Room Change Details Screen (`room_change_details_screen.dart`)
**Sections:**
- Status card with color coding
- Guest Information (name, booking ID, dates)
- Room Change Details (old room → new room comparison)
- Change Information (reason, changed by, date, notes)
- Action buttons (Complete/Cancel for pending changes)

**Features:**
- Color-coded status display
- Detailed room comparison
- Status update with confirmation dialog
- Optional notes when updating status

#### 3. Create Room Change Screen (`create_room_change_screen.dart`)
**Form Sections:**
1. **Guest Information**
   - Guest name (auto-filled if room selected)
   - Check-in/Check-out dates with date pickers

2. **Current Room**
   - Dropdown of occupied rooms
   - Shows room number, guest name, room type

3. **New Room**
   - Dropdown of available rooms (filtered by dates)
   - Shows room number, room type, floor
   - Auto-loads when dates/old room changes

4. **Change Information**
   - Reason for change (required, multiline)
   - Staff name (required)
   - Additional notes (optional, multiline)

**Validation:**
- All required fields checked
- Date validation (checkout after checkin)
- Room availability verification
- Cannot change to same room

**Features:**
- Auto-populate guest info from selected room
- Real-time available room filtering
- Form validation
- Transaction-based submission
- Success/error feedback

## Status Flow

1. **Pending** - Room change created, awaiting action
2. **Completed** - Room change successfully completed
3. **Cancelled** - Room change cancelled

## Color Coding

- **Pending**: Orange (#ffc107)
- **Completed**: Green (#28a745)
- **Cancelled**: Red (#dc3545)
- **Old Room**: Red indicator
- **New Room**: Green indicator

## Integration Steps

### 1. Database Setup
```bash
# Run the SQL script to create the table
mysql -u your_user -p your_database < database_roomchange_table.sql
```

### 2. Provider Registration
Add to `main.dart`:
```dart
MultiProvider(
  providers: [
    // ... existing providers
    ChangeNotifierProvider(create: (_) => RoomChangeProvider()),
  ],
  child: MyApp(),
)
```

### 3. Navigation Menu
Add menu item for Room Changes:
```dart
ListTile(
  leading: Icon(Icons.swap_horiz),
  title: Text('Room Changes'),
  onTap: () {
    Navigator.push(
      context,
      MaterialPageRoute(
        builder: (context) => RoomChangeListScreen(),
      ),
    );
  },
)
```

### 4. Quick Access from Room Details
Add button in room details screen for occupied rooms:
```dart
if (room.isOccupied)
  ElevatedButton(
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
    child: Text('Change Room'),
  )
```

## API Testing

Test the API endpoint:
```bash
# Get all room changes
GET http://your-server/api/room-change.php?action=get-all

# Get available rooms
GET http://your-server/api/room-change.php?action=available-rooms&check_in_date=2024-01-01&check_out_date=2024-01-05&current_room_id=1

# Create room change
POST http://your-server/api/room-change.php
Content-Type: application/json

{
  "action": "create",
  "booking_id": 123,
  "guest_name": "John Doe",
  "old_room_id": 5,
  "old_room_num": "101",
  "new_room_id": 8,
  "new_room_num": "205",
  "change_reason": "Room maintenance required",
  "changed_by": "Staff Name",
  "check_in_date": "2024-01-01",
  "check_out_date": "2024-01-05"
}
```

## Security Considerations

1. **Transaction Safety**: Database operations use transactions to ensure data integrity
2. **Validation**: All inputs validated on both frontend and backend
3. **Room Availability**: System checks room availability before allowing change
4. **Audit Trail**: All changes tracked with staff name and timestamp
5. **Status Protection**: Cannot modify completed/cancelled changes

## Usage Workflow

### Creating a Room Change:
1. Staff navigates to Room Changes
2. Clicks "New Room Change" button
3. Selects current occupied room (or pre-selected)
4. System loads available rooms for booking dates
5. Staff selects new room
6. Enters reason and staff name
7. Submits (system validates and updates booking in transaction)
8. Confirmation shown

### Managing Room Changes:
1. View list of all room changes (filter by status)
2. Tap on a change to view details
3. For pending changes, can Complete or Cancel
4. Optional notes can be added when changing status
5. System tracks all status changes

## File Structure

```
hotel-staff-flutter/
├── lib/
│   ├── models/
│   │   └── room_change.dart          ✅
│   ├── services/
│   │   └── room_change_service.dart   ✅
│   ├── providers/
│   │   └── room_change_provider.dart  ✅
│   └── screens/
│       └── room_change/
│           ├── room_change_list_screen.dart     ✅
│           ├── room_change_details_screen.dart  ✅
│           └── create_room_change_screen.dart   ✅
│
Backend:
├── api/
│   └── room-change.php                ✅
└── database_roomchange_table.sql      ✅
```

## Dependencies Required

All dependencies already in `pubspec.yaml`:
- `flutter/material.dart`
- `provider`
- `http`

## Future Enhancements

1. **Room Change History**: Timeline view of all changes for a guest
2. **Bulk Changes**: Change multiple rooms at once
3. **Notifications**: Alert housekeeping about room changes
4. **Analytics**: Room change trends and reasons analysis
5. **Guest Communication**: Auto-notify guests about room changes
6. **Pricing Adjustments**: Handle room rate differences
7. **Photo Evidence**: Attach photos of room issues
8. **Priority Levels**: Mark urgent vs routine changes

## Feature Complete! 🎉

All components implemented and ready for integration and testing.
