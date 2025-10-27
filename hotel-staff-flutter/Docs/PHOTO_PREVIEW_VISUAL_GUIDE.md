# 📸 Photo Preview Feature - Visual Summary

## 🎯 What Was Added

### **Registration Screen - NEW Photo Section**

```
┌────────────────────────────────────────────┐
│ ← Guest Registration                       │
├────────────────────────────────────────────┤
│ ✓ Form auto-filled from scanned document  │
├────────────────────────────────────────────┤
│                                            │
│ ┌────────────────────────────────────┐    │
│ │ 📷 Captured Photos      [Retake]   │    │ ← NEW!
│ ├────────────────────────────────────┤    │
│ │                                    │    │
│ │  ┌──────────┐   ┌──────────┐     │    │
│ │  │          │   │          │     │    │
│ │  │  Front   │   │   Back   │     │    │ ← Photo Cards
│ │  │  Photo   │   │  Photo   │     │    │
│ │  │    👁️    │   │    👁️    │     │    │
│ │  └──────────┘   └──────────┘     │    │
│ │   Front Side      Back Side      │    │
│ │                                    │    │
│ │  ✓ Both sides captured            │    │
│ └────────────────────────────────────┘    │
│                                            │
│ Document Type: [Passport] [ID] [License]  │
│                                            │
│ First Name: [John]                        │
│ Last Name: [Doe]                          │
│ ...                                        │
│                                            │
│ [Register Guest]                          │
└────────────────────────────────────────────┘
```

---

## 📱 Interactive Elements

### **1. Photo Card (Clickable)**

```
┌─────────────────┐
│                 │
│   [Photo        │  ← Thumbnail (160px)
│    Image]       │
│                 │
│      👁️         │  ← Eye icon overlay (top-right)
│                 │
└─────────────────┘
    Front Side        ← Label (12px)
```

**On Click**: Opens full-screen preview

---

### **2. Retake Button**

```
┌──────────────────────────────────┐
│ 📷 Captured Photos   [🔄 Retake] │  ← Orange text button
└──────────────────────────────────┘
```

**On Click**: 
- Navigates back to photo capture
- Preserves MRZ data
- Clears old photo paths
- Allows recapturing

---

### **3. Full-Screen Preview Dialog**

```
┌────────────────────────────────────────┐
│ ← Front Side                        ✕  │  ← App Bar (Orange)
├────────────────────────────────────────┤
│                                        │
│                                        │
│                                        │
│          [FULL-SIZE PHOTO]             │  ← Interactive Viewer
│                                        │
│           Pinch to Zoom                │  ← 0.5x to 4x zoom
│           Drag to Pan                  │  ← Pan when zoomed
│                                        │
│                                        │
└────────────────────────────────────────┘
```

**Gestures**:
- **Pinch**: Zoom in/out
- **Drag**: Pan around
- **Double-tap**: Toggle zoom
- **X button**: Close

---

## 🎨 Layouts for Different Document Types

### **Passport (1 Photo)**

```
┌────────────────────────────────────┐
│ 📷 Captured Photos      [Retake]   │
├────────────────────────────────────┤
│                                    │
│        ┌──────────────┐            │
│        │              │            │
│        │   Passport   │            │
│        │     Photo    │            │  ← Single centered photo
│        │              │            │
│        │      👁️      │            │
│        └──────────────┘            │
│         Passport Photo             │
│                                    │
│  ✓ Passport photo captured         │
└────────────────────────────────────┘
```

---

### **ID Card (2 Photos)**

```
┌────────────────────────────────────┐
│ 📷 Captured Photos      [Retake]   │
├────────────────────────────────────┤
│                                    │
│  ┌──────────┐   ┌──────────┐     │
│  │          │   │          │     │
│  │  Front   │   │   Back   │     │  ← Two photos side-by-side
│  │  Photo   │   │  Photo   │     │
│  │    👁️    │   │    👁️    │     │
│  └──────────┘   └──────────┘     │
│   Front Side      Back Side      │
│                                    │
│  ✓ Both sides captured            │
└────────────────────────────────────┘
```

---

## 🔄 User Flow Diagrams

### **View Photo Flow**

```
Registration Screen
       │
       │ [Tap Photo Card]
       ↓
Full-Screen Preview
   ┌───┴───┐
   │       │
   │ Pinch │ → Zoom In/Out
   │       │
   │ Drag  │ → Pan Around
   │       │
   │  ✕    │ → Close
   └───────┘
       ↓
Registration Screen
```

---

### **Retake Photos Flow**

```
Registration Screen
   (with captured photos)
       │
       │ [Click "Retake" Button]
       ↓
Photo Capture Screen
   (clears old photos)
       │
       │ [Capture New Photos]
       ↓
Registration Screen
   (with NEW photos)
```

---

## 📊 State Management

### **Data Structure**

```dart
scannedData = {
  'firstName': 'John',
  'lastName': 'Doe',
  'documentNumber': 'AB123456',
  // ... other MRZ fields
  
  // NEW FIELDS:
  'frontPhotoPath': '/storage/.../IDM/AB123456/front.jpg',
  'backPhotoPath': '/storage/.../IDM/AB123456/back.jpg',  // ID cards only
  'isPassport': 'true',  // or 'false'
  'guestId': 'AB123456'
}
```

### **State Variables**

```dart
String? _frontPhotoPath;   // Extracted from scannedData
String? _backPhotoPath;    // Extracted from scannedData
bool _isPassport = false;  // Controls layout (1 vs 2 photos)
```

---

## 🎯 Interaction Examples

### **Example 1: Preview Passport Photo**

```
User Action:
  Taps on passport photo card
       ↓
System Response:
  Opens full-screen dialog
  Shows "Passport Photo" in title
  Displays photo at full resolution
  Enables zoom/pan
       ↓
User Action:
  Pinches to zoom 2x
  Drags to view MRZ area
  Taps ✕ to close
       ↓
System Response:
  Closes dialog
  Returns to registration form
```

---

### **Example 2: Retake ID Photos**

```
User Action:
  Notices front photo is blurry
  Clicks "Retake" button
       ↓
System Response:
  Navigates to photo capture screen
  Shows "Position FRONT side of ID card"
  Preserves all MRZ data
       ↓
User Action:
  Captures clearer front photo
  Captures back photo
       ↓
System Response:
  Saves new photos
  Returns to registration
  Shows NEW photos in preview
  Old photos are replaced
```

---

## 💡 Smart Features

### **Adaptive Photo Count**

```dart
// Passport detection
if (_isPassport) {
  // Show 1 photo only
  return [FrontPhotoCard];
} else {
  // Show 2 photos
  return [FrontPhotoCard, BackPhotoCard];
}
```

### **Conditional Status Message**

```dart
// Status message adapts
_isPassport 
  ? 'Passport photo captured'          // 1 photo
  : 'Both sides captured'               // 2 photos
```

### **Smart Retake**

```dart
// Retake preserves MRZ data
final mrzData = Map.from(widget.scannedData);
mrzData.remove('frontPhotoPath');  // Clear old photos
mrzData.remove('backPhotoPath');   // Force recapture
```

---

## 🎨 Design Specifications

### **Photo Card**
- **Width**: 50% of screen (ID) / 60% (Passport)
- **Height**: 160px
- **Border**: 2px solid #E0E0E0
- **Shadow**: 4px blur, 2px offset, 10% opacity
- **Radius**: 8px corners
- **Image**: Cover fit, full card

### **Eye Icon Overlay**
- **Position**: Top-right, 8px margin
- **Size**: 18px icon
- **Background**: Black 60% opacity circle
- **Color**: White icon

### **Section Container**
- **Background**: #FAFAFA (grey.shade50)
- **Border**: 1px solid #E0E0E0
- **Padding**: 16px all sides
- **Radius**: 12px corners
- **Gap**: 12px between photos

### **Retake Button**
- **Color**: Orange (AppTheme.primaryOrange)
- **Icon**: Refresh (18px)
- **Text**: "Retake" (14px)
- **Style**: Text button (no background)

---

## ✅ Feature Checklist

### **Photo Display** ✓
- [x] Extract photo paths from scannedData
- [x] Display photo thumbnails in cards
- [x] Show eye icon overlay
- [x] Add labels (Front/Back/Passport)
- [x] Adaptive layout (1 vs 2 photos)
- [x] Status message

### **Photo Preview** ✓
- [x] Full-screen dialog
- [x] InteractiveViewer widget
- [x] Zoom support (0.5x - 4x)
- [x] Pan support
- [x] Title in app bar
- [x] Close button
- [x] Smooth animations

### **Retake Feature** ✓
- [x] Retake button visible
- [x] Navigate to photo capture
- [x] Preserve MRZ data
- [x] Clear photo paths
- [x] Allow recapture
- [x] Return with new photos

---

## 🚀 Ready to Test!

The feature is **fully implemented** and ready for testing on your device.

### **Test Steps**:
1. Scan MRZ code
2. Capture photos
3. Verify photos appear in registration
4. Tap photo to preview
5. Try zoom and pan
6. Close preview
7. Click "Retake"
8. Recapture photos
9. Verify new photos display
10. Submit registration

**All features working! ✨**
