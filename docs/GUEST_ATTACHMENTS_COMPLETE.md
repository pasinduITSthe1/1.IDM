# ✅ Guest Photo Attachments - Database Integration Complete

## 🎯 What Was Implemented

The system now saves guest ID photo file paths to the database table `guest_attachments` automatically when a guest is registered.

---

## 📁 Files Modified/Created

### ✅ New Files
1. **`src/api/upload-guest-attachments-api.php`** - PHP API for saving/retrieving attachment records
2. **`hotel-staff-flutter/lib/services/guest_attachment_service.dart`** - Flutter service for attachment management
3. **`test-guest-attachments.html`** - Test page for API verification

### ✅ Modified Files
1. **`hotel-staff-flutter/lib/utils/network_config.dart`** - Added `guestAttachmentsApiUrl` endpoint
2. **`hotel-staff-flutter/lib/providers/guest_provider.dart`** - Enhanced to save photos after guest creation
3. **`hotel-staff-flutter/lib/screens/guest_registration_screen.dart`** - Passes photo paths to provider

---

## 🗃️ Database Table Structure

The `guest_attachments` table stores:

```sql
CREATE TABLE IF NOT EXISTS guest_attachments (
    id INT(11) NOT NULL AUTO_INCREMENT,
    id_customer INT(11) NOT NULL,
    attachment_type VARCHAR(50) NOT NULL,
    file_path VARCHAR(255) NOT NULL,
    upload_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    KEY idx_customer (id_customer),
    KEY idx_type (attachment_type)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

**Columns:**
- `id` - Auto-increment primary key
- `id_customer` - Reference to customer ID
- `attachment_type` - Type of attachment (`id_front`, `id_back`, `passport`)
- `file_path` - Full file path on device (e.g., `/storage/emulated/0/IDM/123/front.jpg`)
- `upload_date` - Timestamp when record was created

---

## 🔄 How It Works

### 1. Photo Capture Flow
```
📸 User captures ID photos
    ↓
💾 Photos saved to device: /storage/emulated/0/IDM/{guestId}/
    ↓
📝 Guest registration submitted
    ↓
✅ Guest created in database (gets customer ID)
    ↓
💾 Photo paths saved to guest_attachments table
```

### 2. API Endpoints

#### Save Attachment
```http
POST /src/api/upload-guest-attachments-api.php
Content-Type: application/json

{
  "id_customer": 123,
  "attachment_type": "id_front",
  "file_path": "/storage/emulated/0/IDM/ABC123/front.jpg"
}
```

**Response:**
```json
{
  "success": true,
  "message": "Attachment saved successfully",
  "data": {
    "id": 1,
    "id_customer": 123,
    "attachment_type": "id_front",
    "file_path": "/storage/emulated/0/IDM/ABC123/front.jpg",
    "upload_date": "2025-11-07 10:30:00"
  }
}
```

#### Get Attachments
```http
GET /src/api/upload-guest-attachments-api.php?id_customer=123
```

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "id_customer": 123,
      "attachment_type": "id_front",
      "file_path": "/storage/emulated/0/IDM/ABC123/front.jpg",
      "upload_date": "2025-11-07 10:30:00"
    },
    {
      "id": 2,
      "id_customer": 123,
      "attachment_type": "id_back",
      "file_path": "/storage/emulated/0/IDM/ABC123/back.jpg",
      "upload_date": "2025-11-07 10:30:05"
    }
  ],
  "count": 2
}
```

---

## 🧪 Testing

### Test the API
1. Open: `http://localhost/1.IDM/test-guest-attachments.html`
2. Click **💾 Test Save** to save a test attachment
3. Click **📥 Get Attachments** to retrieve attachments
4. Click **🔍 Check Table** to verify database connection

### Test the Flutter App
1. Register a new guest with ID photos
2. Check the database:
   ```sql
   SELECT * FROM guest_attachments ORDER BY upload_date DESC LIMIT 10;
   ```
3. Verify file paths are saved correctly

---

## 📊 What Gets Saved

### For National ID Cards
- ✅ **Front Photo**: Saved as `id_front` type
- ✅ **Back Photo**: Saved as `id_back` type

### For Passports
- ✅ **Passport Photo**: Saved as `passport` type

### File Path Format
```
/storage/emulated/0/IDM/{guestId}/front.jpg
/storage/emulated/0/IDM/{guestId}/back.jpg
```

Where `{guestId}` is either:
- Document number from MRZ (cleaned)
- Timestamp if no document number

---

## 🔍 Querying Attachments

### Get all attachments for a guest
```sql
SELECT * FROM guest_attachments 
WHERE id_customer = 123;
```

### Get only front ID photos
```sql
SELECT * FROM guest_attachments 
WHERE id_customer = 123 
AND attachment_type = 'id_front';
```

### Get recent attachments
```sql
SELECT 
    ga.*,
    c.firstname,
    c.lastname
FROM guest_attachments ga
JOIN qlo_customer c ON ga.id_customer = c.id_customer
ORDER BY ga.upload_date DESC
LIMIT 10;
```

### Count attachments by type
```sql
SELECT 
    attachment_type,
    COUNT(*) as count
FROM guest_attachments
GROUP BY attachment_type;
```

---

## ✅ Benefits

1. **Database Tracking** - All photo uploads are tracked in the database
2. **Customer History** - Can see all attachments for each customer
3. **Audit Trail** - Upload dates are recorded
4. **Easy Retrieval** - Query attachments by customer or type
5. **Data Integrity** - Foreign key relationship with customer table

---

## 🔄 Future Enhancements

Potential improvements:
- Add file size tracking
- Add file hash for duplicate detection
- Support multiple file versions
- Add deletion tracking (soft delete)
- Add approval/verification status
- Link to booking records

---

## 📞 API Integration

### Flutter Service Usage
```dart
final attachmentService = GuestAttachmentService();

// Save single attachment
await attachmentService.saveAttachment(
  customerId: 123,
  attachmentType: 'id_front',
  filePath: '/path/to/photo.jpg',
);

// Save multiple attachments
await attachmentService.saveMultipleAttachments(
  customerId: 123,
  frontPhotoPath: '/path/front.jpg',
  backPhotoPath: '/path/back.jpg',
);

// Get all attachments
final attachments = await attachmentService.getAttachments(123);
```

---

## 🎉 Summary

Your guest photo attachment system is now fully integrated with the database! Every time a guest registers with ID photos:

1. ✅ Photos are saved to device storage (`/storage/emulated/0/IDM/`)
2. ✅ Guest is created in the database
3. ✅ Photo file paths are saved to `guest_attachments` table
4. ✅ All data is queryable and traceable

The system provides a complete audit trail of all guest document uploads! 🚀
