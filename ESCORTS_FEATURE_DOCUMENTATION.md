# Escorts & Companions Feature Documentation

## Overview
The escorts feature allows hotel staff to register and manage companions, family members, and associates who are accompanying main guests. This feature follows the same workflow as guest registration with document scanning capabilities.

## Features

### 1. **Add Escorts to Guests**
   - Each escort is linked to a main guest (customer)
   - Supports the same document types: Passport, ID Card, Visa
   - Full MRZ scanning support for quick data entry
   - Stores relationship type (companion, family, friend, business_associate, other)

### 2. **Two Registration Methods**

#### A. Manual Entry
   - Navigate to guest details → "Manage Escorts & Companions"
   - Click "Add Escort" button
   - Fill in the registration form manually

#### B. Document Scanning
   - Navigate to guest details → "Manage Escorts & Companions"
   - Click the scan button (QR code icon)
   - Scan the escort's passport or ID card using MRZ scanner
   - Auto-fill the registration form with scanned data
   - Review and complete the registration

### 3. **Escort Management**
   - View all escorts for a specific guest
   - Display escort information including:
     - Full name
     - Relationship to guest
     - Document details
     - Contact information
   - Delete escorts when needed

## Database Structure

### Table: `guest_escorts`
```sql
CREATE TABLE IF NOT EXISTS guest_escorts (
  id INT PRIMARY KEY AUTO_INCREMENT,
  id_customer INT NOT NULL,  -- Reference to main guest
  first_name VARCHAR(100) NOT NULL,
  last_name VARCHAR(100) NOT NULL,
  document_type VARCHAR(50),
  document_number VARCHAR(100),
  date_of_birth DATE,
  nationality VARCHAR(100),
  sex CHAR(1),
  email VARCHAR(255),
  phone VARCHAR(50),
  address TEXT,
  issued_country VARCHAR(100),
  issued_date DATE,
  expiry_date DATE,
  relationship_to_guest VARCHAR(50),
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (id_customer) REFERENCES qlo_customer(id_customer) ON DELETE CASCADE
);
```

### Table: `escort_attachments`
```sql
CREATE TABLE IF NOT EXISTS escort_attachments (
  id INT PRIMARY KEY AUTO_INCREMENT,
  id_escort INT NOT NULL,
  attachment_type VARCHAR(50),  -- 'document_front', 'document_back', 'profile_photo'
  file_path VARCHAR(255),
  upload_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (id_escort) REFERENCES guest_escorts(id) ON DELETE CASCADE
);
```

## Architecture

### Models
- **`Escort`** (`lib/models/escort.dart`)
  - Contains all escort personal information
  - Linked to guest via `guestId` field
  - Supports JSON serialization for API communication

### Providers
- **`EscortProvider`** (`lib/providers/escort_provider.dart`)
  - Manages escort state across the app
  - Handles CRUD operations (Create, Read, Update, Delete)
  - Organizes escorts by guest ID
  - Provides statistics and counts

### Services
- **`EscortService`** (`lib/services/escort_service.dart`)
  - Handles API communication with backend
  - Endpoints:
    - `POST /api/escorts` - Add new escort
    - `GET /api/escorts/guest/:guestId` - Get escorts for a guest
    - `PUT /api/escorts/:id` - Update escort
    - `DELETE /api/escorts/:id` - Delete escort

### Screens
1. **`GuestEscortsScreen`** (`lib/screens/guest_escorts_screen.dart`)
   - Displays all escorts for a specific guest
   - Shows guest information at the top
   - Lists escorts with their details
   - Provides add/delete actions

2. **`EscortRegistrationScreen`** (`lib/screens/escort_registration_screen.dart`)
   - Registration form for adding escorts
   - Auto-fills from scanned document data
   - Validates required fields
   - Saves escort to database

## User Flow

### Adding an Escort

1. **From Guest List:**
   ```
   Guest List → Select Guest → Guest Details Modal → "Manage Escorts & Companions"
   ```

2. **Manual Registration:**
   ```
   Escorts Screen → "Add Escort" (FAB) → Fill Form → Submit
   ```

3. **With Scanning:**
   ```
   Escorts Screen → Scan Icon → MRZ Scanner → Photo Capture → 
   Auto-filled Form → Review → Submit
   ```

### Viewing Escorts
```
Guest List → Select Guest → Guest Details → "Manage Escorts & Companions" → 
View all escorts with details
```

### Deleting an Escort
```
Escorts Screen → Click Delete Icon on Escort Card → Confirm → Deleted
```

## API Integration

### Backend Endpoints Needed

```javascript
// Add Escort
POST /api/escorts
Body: {
  id_customer: number,
  first_name: string,
  last_name: string,
  document_type: string,
  document_number: string,
  date_of_birth: string,
  nationality: string,
  sex: string,
  email: string,
  phone: string,
  address: string,
  issued_country: string,
  issued_date: string,
  expiry_date: string,
  relationship_to_guest: string
}

// Get Escorts for Guest
GET /api/escorts/guest/:guestId

// Update Escort
PUT /api/escorts/:id
Body: { ...escort data }

// Delete Escort
DELETE /api/escorts/:id
```

## Relationship Types

The system supports the following relationship types:
- **companion** - General companion/partner
- **family** - Family member (spouse, child, parent, sibling)
- **friend** - Friend
- **business_associate** - Business colleague/associate
- **other** - Other relationship

## Benefits

1. **Complete Guest Records** - Track all people associated with a guest
2. **Security** - Document all individuals in hotel premises
3. **Compliance** - Meet regulatory requirements for visitor registration
4. **Efficiency** - Quick registration via document scanning
5. **Organization** - Easy-to-manage escort lists per guest

## Future Enhancements

1. **Photo Capture** - Store escort photos in `escort_attachments` table
2. **Bulk Import** - Register multiple escorts at once
3. **Access Control** - Manage escort access to hotel facilities
4. **Reports** - Generate reports on escorts per guest, per date range
5. **Notifications** - Alert staff when escorts check in/out

## Testing

### To Test the Feature:

1. **Run SQL Scripts:**
   ```sql
   -- Run database_escort_tables.sql to create tables
   source database_escort_tables.sql;
   ```

2. **Start the App:**
   ```bash
   cd hotel-staff-flutter
   flutter run
   ```

3. **Test Flow:**
   - Login to the app
   - Go to Guest List
   - Select any guest
   - Click "Manage Escorts & Companions"
   - Add an escort (manually or with scanning)
   - View the escort in the list
   - Delete the escort

## Notes

- Escorts are automatically deleted when their associated guest is deleted (CASCADE)
- The feature uses the same document scanning flow as guest registration
- All escort data is stored in the backend database, not locally
- The UI follows the same design patterns as guest management for consistency

## Support

For issues or questions about the escorts feature, check:
- Provider implementation in `escort_provider.dart`
- API service in `escort_service.dart`
- Screen implementations in `screens/` directory
- Database schema in `database_escort_tables.sql`
