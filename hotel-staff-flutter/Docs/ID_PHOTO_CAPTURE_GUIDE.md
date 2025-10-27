# ID Photo Capture Feature - Implementation Guide

## 📸 Overview
**Smart document photo capture** system with automatic type detection:
- **Passports**: Captures 1 photo (photo page with MRZ)
- **ID Cards**: Captures 2 photos (front + back)
- **Frame-based cropping**: Only captures the highlighted frame area (not full screen)
- **Document-specific frames**: Passport frame (tall) vs ID card frame (wide)

## 🔄 User Flow

### **For Passports** 📖
```
1. MRZ Scanner Screen
   ↓ (Scan passport MRZ)
   ↓ (Preview scanned data)
   ↓ (Click "Next: Capture Photos")
   
2. ID Photo Capture Screen
   ↓ (Position passport photo page in TALL frame)
   ↓ (Capture 1 photo - cropped to frame)
   ↓ (Auto-save to /IDM/{docNumber}/front.jpg)
   
3. Guest Registration Screen
   ↓ (Form pre-filled with passport data)
   ↓ (1 photo path included)
```

### **For ID Cards** 🪪
```
1. MRZ Scanner Screen
   ↓ (Scan ID card MRZ)
   ↓ (Preview scanned data)
   ↓ (Click "Next: Capture Photos")
   
2. ID Photo Capture Screen
   ↓ (Position FRONT in WIDE frame)
   ↓ (Capture front - cropped to frame)
   ↓ (Position BACK in WIDE frame)
   ↓ (Capture back - cropped to frame)
   ↓ (Auto-save to /IDM/{docNumber}/front.jpg + back.jpg)
   
3. Guest Registration Screen
   ↓ (Form pre-filled with ID card data)
   ↓ (2 photo paths included)
```

## 📁 Storage Structure

```
/storage/emulated/0/IDM/
├── {documentNumber}/
│   ├── front.jpg
│   └── back.jpg
├── {documentNumber2}/
│   ├── front.jpg
│   └── back.jpg
```

**Example:**
- Guest with document number "AB123456" → `/IDM/AB123456/front.jpg`
- Guest with timestamp (no doc number) → `/IDM/1729612800000/front.jpg`

## 🆕 New Files Created

### 1. `lib/utils/id_photo_storage.dart`
Storage helper class with methods:
- ✅ `requestPermissions()` - Request camera and storage permissions
- ✅ `getIDMDirectory()` - Get base IDM folder
- ✅ `getGuestDirectory(guestId)` - Get guest-specific folder
- ✅ `saveFrontPhoto(guestId, imagePath)` - Save front photo
- ✅ `saveBackPhoto(guestId, imagePath)` - Save back photo
- ✅ `getFrontPhotoPath(guestId)` - Get front photo path
- ✅ `getBackPhotoPath(guestId)` - Get back photo path
- ✅ `deleteGuestPhotos(guestId)` - Delete guest photos
- ✅ `getStorageInfo()` - Get storage statistics

### 2. `lib/screens/id_photo_capture_screen.dart`
Full-featured photo capture screen with:
- ✅ Camera preview with ID card overlay guide
- ✅ Sequential capture flow (front → back)
- ✅ Flash/torch toggle
- ✅ Real-time instruction banner
- ✅ Photo thumbnails showing captured images
- ✅ Retake functionality for both photos
- ✅ Auto-save to IDM folder
- ✅ Haptic feedback
- ✅ Portrait orientation lock
- ✅ ID card ratio frame (85.6mm × 53.98mm)

## 🔧 Modified Files

### 1. `lib/screens/mrz_scanner_screen.dart`
**Line 368-374**: Changed navigation from direct registration to photo capture
```dart
// OLD: context.go('/register-guest', extra: validated);
// NEW: context.go('/capture-id-photos', extra: validated);
```

### 2. `lib/utils/app_routes.dart`
**Added route**:
```dart
GoRoute(
  path: '/capture-id-photos',
  name: 'capture-id-photos',
  builder: (context, state) {
    final mrzData = state.extra as Map<String, String>;
    return IDPhotoCaptureScreen(mrzData: mrzData);
  },
),
```

### 3. `android/app/src/main/AndroidManifest.xml`
**Added permission** for Android 11+:
```xml
<uses-permission android:name="android.permission.MANAGE_EXTERNAL_STORAGE" />
```

## 🎨 UI Features

### Camera Overlay
- **Orange border** for front photo
- **Blue border** for back photo
- **Corner markers** for alignment
- **Card ratio frame** (realistic ID card proportions)

### Instruction Banner
- Dynamic text based on current stage
- Orange gradient background
- Credit card icon
- Clear alignment instructions

### Capture Button
- Large circular button (80px)
- Orange gradient fill
- White border
- Loading indicator during capture
- Haptic feedback on press

### Photo Thumbnails
- **Front photo thumbnail** (bottom left)
- 80px width, 50px height
- White border
- Green checkmark when captured
- Tap to retake

### Top Bar
- Back button (left)
- Document number display
- Flash toggle (right)

## 🔑 Key Data Flow

### MRZ Data Passed Forward:
```dart
{
  'type': 'Passport (TD-3)',
  'firstName': 'JOHN',
  'lastName': 'DOE',
  'documentNumber': 'AB123456',
  'nationality': 'USA',
  'dateOfBirth': '1990-01-15',
  'sex': 'M',
  'expiryDate': '2030-12-31',
}
```

### After Photo Capture (Added):
```dart
{
  ...mrzData,
  'frontPhotoPath': '/storage/emulated/0/IDM/AB123456/front.jpg',
  'backPhotoPath': '/storage/emulated/0/IDM/AB123456/back.jpg',
  'guestId': 'AB123456',
}
```

## 🧪 Testing Checklist

- [ ] MRZ scan works
- [ ] Navigate to photo capture screen
- [ ] Capture front photo successfully
- [ ] See front photo thumbnail
- [ ] Capture back photo successfully
- [ ] Photos saved to IDM folder correctly
- [ ] Navigate to registration with all data
- [ ] Flash toggle works
- [ ] Retake front photo works
- [ ] Cancel button returns to scanner
- [ ] Storage permissions granted
- [ ] Folder structure created correctly

## 📱 Permissions Required

### Android
- ✅ `CAMERA` - Already granted
- ✅ `WRITE_EXTERNAL_STORAGE` - Already granted
- ✅ `READ_EXTERNAL_STORAGE` - Already granted
- ✅ `MANAGE_EXTERNAL_STORAGE` - **NEW** (Android 11+)

### iOS (Future)
- Camera access (handled by permission_handler)
- Photo library access

## 🐛 Troubleshooting

### Photos not saving?
1. Check storage permissions granted
2. Verify IDM folder exists: `/storage/emulated/0/IDM/`
3. Check device has sufficient storage
4. Review logs for error messages

### Camera not working?
1. Check camera permission granted
2. Verify device has rear camera
3. Check camera not in use by another app

### Can't find photos?
1. Use `IDPhotoStorage.getStorageInfo()` to check paths
2. Navigate to folder using file manager
3. Check guestId matches document number

## 🚀 Future Enhancements

- [ ] Add image compression for smaller file sizes
- [ ] Add image quality check before saving
- [ ] Add manual crop/rotate functionality
- [ ] Add gallery picker option for existing photos
- [ ] Add photo preview before confirmation
- [ ] Add photo metadata (timestamp, location)
- [ ] Add cloud backup option
- [ ] Add photo encryption for security

## 📊 Performance Considerations

- **Photo resolution**: High (1920px width typically)
- **File size**: ~500KB - 2MB per photo
- **Storage impact**: ~1-4MB per guest (2 photos)
- **Capture speed**: <1 second per photo
- **No preprocessing**: Direct JPEG save for speed

## 🔒 Security Notes

- Photos stored in plain JPEG format
- Accessible via file manager
- Consider encryption for production
- Implement auto-delete after upload
- Add watermark with timestamp
- Implement access control

---

**Status**: ✅ **READY TO TEST**
**Version**: 1.0.0
**Date**: October 22, 2025
