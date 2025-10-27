# 📸 Photo Preview & Retake Feature

## ✨ Overview

Added comprehensive photo preview and retake functionality to the Guest Registration screen. Users can now view captured document photos, preview them in full-screen, and retake if needed.

---

## 🎯 Features Implemented

### 1. **Photo Display Section**
- Shows captured document photos at the top of the registration form
- Adaptive layout:
  - **Passport**: Shows 1 photo (photo page)
  - **ID Card**: Shows 2 photos (front + back)
- Clean card-based design with labels

### 2. **Photo Preview**
- Click/tap on any photo to view in full-screen
- Interactive viewer with zoom and pan capabilities:
  - **Pinch to zoom** (0.5x to 4x)
  - **Pan** to move around zoomed image
  - **Double-tap** to zoom in/out
- Shows photo title in app bar
- Close button to return

### 3. **Retake Photos**
- "Retake" button to recapture all photos
- Navigates back to photo capture screen
- Preserves all MRZ data
- Requires re-capturing all photos

---

## 📱 UI Components

### **Photo Preview Card**

```
┌─────────────────────┐
│  [Photo Thumbnail]  │
│                     │
│    👁️ (Preview)     │
│                     │
├─────────────────────┤
│   Front Side        │
└─────────────────────┘
```

**Features**:
- 160px height photo thumbnail
- Rounded corners with shadow
- Eye icon overlay (top-right)
- Label below photo
- Tap to preview

### **Photos Section Layout**

```
┌──────────────────────────────────┐
│ 📷 Captured Photos    [Retake]   │
├──────────────────────────────────┤
│  [Front Photo]  [Back Photo]     │  ← ID Card (2 photos)
│  Passport Photo                  │  ← Passport (1 photo)
├──────────────────────────────────┤
│ ✓ Both sides captured            │
└──────────────────────────────────┘
```

### **Full-Screen Preview Dialog**

```
┌──────────────────────────────────┐
│ ← Front Side                   X │  ← App Bar
├──────────────────────────────────┤
│                                  │
│                                  │
│      [Photo Full-Screen]         │  ← Zoomable
│                                  │
│                                  │
└──────────────────────────────────┘
```

---

## 🔧 Technical Implementation

### **State Variables Added**

```dart
String? _frontPhotoPath;   // Path to front photo
String? _backPhotoPath;    // Path to back photo (ID cards only)
bool _isPassport = false;  // Document type flag
```

### **Data Extraction**

```dart
void _populateScannedData() {
  // Extract photo paths from scanned data
  _frontPhotoPath = data['frontPhotoPath'];
  _backPhotoPath = data['backPhotoPath'];
  
  // Extract document type
  if (data['isPassport'] != null) {
    _isPassport = data['isPassport'].toString().toLowerCase() == 'true';
  }
}
```

### **Retake Function**

```dart
void _retakePhotos() {
  // Navigate back to photo capture with MRZ data
  final mrzData = Map<String, dynamic>.from(widget.scannedData ?? {});
  
  // Remove photo paths to force recapture
  mrzData.remove('frontPhotoPath');
  mrzData.remove('backPhotoPath');
  
  context.go('/capture-id-photos', extra: mrzData);
}
```

### **Preview Function**

```dart
void _previewPhoto(String photoPath, String title) {
  showDialog(
    context: context,
    builder: (context) => Dialog(
      child: Column(
        children: [
          AppBar(title: Text(title)),
          Expanded(
            child: InteractiveViewer(
              panEnabled: true,
              minScale: 0.5,
              maxScale: 4.0,
              child: Image.file(File(photoPath)),
            ),
          ),
        ],
      ),
    ),
  );
}
```

---

## 📊 Data Flow

### **Complete Flow**

```
1. MRZ Scanner
   ↓ (scans document)
2. Photo Capture Screen
   ↓ (captures photos, saves to storage)
   ↓ (adds photo paths to data)
3. Guest Registration Screen
   ↓ (displays photos with preview)
   ↓ (user can retake or continue)
4. Submit Registration
```

### **Retake Flow**

```
Guest Registration
   ↓ (click "Retake")
Photo Capture Screen
   ↓ (recapture photos)
Guest Registration
   ↓ (updated photos)
```

### **Preview Flow**

```
Guest Registration
   ↓ (tap photo)
Full-Screen Preview Dialog
   ↓ (zoom, pan, view)
   ↓ (close)
Guest Registration
```

---

## 🎨 Visual Design

### **Photo Card Design**
- **Size**: 160px height, full width
- **Border**: 2px gray border with shadow
- **Corners**: 8px rounded
- **Overlay**: Eye icon in semi-transparent circle
- **Label**: 12px bold text below

### **Section Container**
- **Background**: Light gray (grey.shade50)
- **Border**: 1px gray border
- **Padding**: 16px all around
- **Radius**: 12px rounded corners

### **Colors**
- **Primary**: Orange (AppTheme.primaryOrange)
- **Success**: Green (#4CAF50)
- **Border**: Gray (grey.shade300)
- **Text**: Dark gray (grey.shade700)

---

## 📱 User Experience

### **For Passport** 📖
1. User sees **1 photo card** labeled "Passport Photo"
2. Can tap to preview in full-screen
3. Can zoom and pan to verify details
4. Can click "Retake" to recapture

### **For ID Card** 🪪
1. User sees **2 photo cards**:
   - "Front Side" (left)
   - "Back Side" (right)
2. Can preview each photo independently
3. Can zoom each to verify quality
4. "Retake" recaptures both sides

### **Preview Interaction**
1. **Tap photo** → Opens full-screen dialog
2. **Pinch gesture** → Zoom in/out (0.5x - 4x)
3. **Drag** → Pan around zoomed image
4. **Double-tap** → Quick zoom toggle
5. **X button** → Close preview

---

## ✅ Benefits

### **For Users**
- ✅ Visual confirmation of captured photos
- ✅ Verify photo quality before submission
- ✅ Easy retake if photos are blurry
- ✅ Zoom to check document details
- ✅ Professional UI/UX

### **For Staff**
- ✅ Reduce submission errors
- ✅ Ensure high-quality document photos
- ✅ Save time by catching issues early
- ✅ Better guest registration data

### **For System**
- ✅ Fewer re-registrations needed
- ✅ Higher data quality
- ✅ Better document verification
- ✅ Improved user confidence

---

## 🧪 Testing Checklist

### **Passport Testing**
- [ ] Single photo displays correctly
- [ ] Photo labeled "Passport Photo"
- [ ] Tap opens full-screen preview
- [ ] Zoom works (pinch to zoom)
- [ ] Pan works when zoomed
- [ ] Close button returns to form
- [ ] "Retake" navigates to capture screen
- [ ] After retake, new photo displays

### **ID Card Testing**
- [ ] Two photos display side-by-side
- [ ] Front labeled "Front Side"
- [ ] Back labeled "Back Side"
- [ ] Both photos preview independently
- [ ] Zoom and pan work for both
- [ ] "Retake" recaptures both photos
- [ ] Status shows "Both sides captured"

### **Preview Functionality**
- [ ] Full-screen preview opens
- [ ] Title shows correct label
- [ ] Photo displays at full resolution
- [ ] Pinch-to-zoom works smoothly
- [ ] Pan gesture works when zoomed
- [ ] Double-tap toggles zoom
- [ ] Close button works
- [ ] No lag or performance issues

### **Retake Functionality**
- [ ] "Retake" button visible
- [ ] Navigates to photo capture
- [ ] MRZ data preserved
- [ ] Photo paths cleared
- [ ] Can capture new photos
- [ ] Returns to registration with new photos
- [ ] Old photos replaced with new ones

---

## 📝 Code Files Modified

### **`lib/screens/guest_registration_screen.dart`**

**Added**:
1. Import `dart:io` for File handling
2. State variables for photo paths and passport flag
3. Photo path extraction in `_populateScannedData()`
4. `_retakePhotos()` method
5. `_previewPhoto()` method
6. Photo preview section in build method
7. `_PhotoCard` widget component

**Total Lines Added**: ~180 lines

---

## 🚀 Usage Example

### **Passport Flow**
```
[MRZ Scan] → [Capture 1 Photo] → [Registration]
                                      ↓
                          ┌───────────────────────┐
                          │ 📷 Captured Photos    │
                          │  [Passport Photo 👁️]  │
                          │  ✓ Photo captured     │
                          └───────────────────────┘
                          [Tap photo] → Full preview
                          [Retake] → Recapture
```

### **ID Card Flow**
```
[MRZ Scan] → [Capture Front & Back] → [Registration]
                                           ↓
                              ┌────────────────────────┐
                              │ 📷 Captured Photos     │
                              │ [Front 👁️] [Back 👁️]   │
                              │ ✓ Both sides captured  │
                              └────────────────────────┘
                              [Tap either] → Preview
                              [Retake] → Recapture both
```

---

## 💡 Future Enhancements

### **Potential Additions**
1. **Individual Photo Retake**: Allow retaking just front or back
2. **Photo Editing**: Rotate, crop, adjust brightness
3. **Quality Indicators**: Show photo quality score
4. **Auto-Quality Check**: Warn if photos are blurry
5. **Photo Comparison**: Side-by-side view for ID cards
6. **OCR Validation**: Verify data matches photo text
7. **Photo Guidelines**: Overlay guide during capture
8. **History**: View previously captured photos

---

## 🎯 Result

**Before**: No photo preview, couldn't verify quality
**After**: Full photo preview with zoom, easy retake option

Perfect for your hotel guest registration system! ✨

The feature is now **ready for testing** on your device.
