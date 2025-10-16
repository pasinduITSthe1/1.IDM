# 🏨 ITSthe1 Hotel Staff App - Flutter Edition

A modern, mobile-first hotel guest management system with advanced ID/Passport scanning capabilities built with Flutter.

## ✨ Features

### 🔐 Authentication
- **Dual Mode Login**: Online and Demo modes
- **Orange Theme**: Consistent gradient branding (#FF6B35 to #F7931E)
- **Secure Storage**: Token-based authentication with secure storage

### 📸 ID/Passport Scanning
- **Advanced OCR**: Google ML Kit text recognition with image preprocessing
- **MRZ Detection**: Automatic machine-readable zone parsing for passports and ID cards
- **Enhanced Pattern Matching**: Multiple regex patterns for various document formats
- **Image Enhancement**: Contrast and brightness adjustment before OCR
- **Real-time Feedback**: Visual corner guides and progress indicators
- **Error Recovery**: Comprehensive user guidance with manual entry fallback

### 👥 Guest Management
- **Quick Registration**: Auto-fill from scanned documents
- **Real-time Statistics**: Total, checked-in, checked-out, and pending guests
- **Status Tracking**: Manage guest check-in/check-out status
- **Profile Management**: Complete guest information with documents

### 🎨 Modern UI/UX
- **Material Design 3**: Clean, modern interface
- **Orange Gradient Theme**: Consistent branding throughout
- **Responsive Layout**: Optimized for all screen sizes
- **Smooth Animations**: Polished transitions and interactions
- **Dark Camera UI**: Professional scanning interface

## 🚀 Getting Started

### Prerequisites

- Flutter SDK (>=3.0.0)
- Android Studio / Xcode
- Android device/emulator (API 21+) or iOS device/simulator (iOS 11+)

### Installation

1. **Install dependencies**
   ```bash
   flutter pub get
   ```

2. **Run the app**
   ```bash
   flutter run
   ```

## 📦 Key Dependencies

- `google_mlkit_text_recognition` - OCR engine
- `camera` - Camera access
- `image` - Image processing
- `provider` - State management
- `go_router` - Navigation
- `mrz_parser` - MRZ parsing

## 📂 Project Structure

```
lib/
├── main.dart                       # App entry point
├── models/                         # Data models
│   └── guest.dart                 # Guest model
├── providers/                      # State management
│   ├── auth_provider.dart         # Authentication state
│   └── guest_provider.dart        # Guest management state
├── screens/                        # UI screens
│   ├── login_screen.dart          # Login with dual mode
│   ├── dashboard_screen.dart      # Main dashboard
│   ├── scan_document_screen.dart  # Camera scanning
│   ├── guest_registration_screen.dart  # Guest form
│   └── ...                        # Other screens
└── utils/                          # Utilities
    ├── app_theme.dart             # Orange theme
    ├── app_routes.dart            # Navigation
    └── ocr_helper.dart            # OCR processing
```

## 🎯 Enhanced OCR Features

### Image Preprocessing
1. Contrast enhancement (1.5x)
2. Brightness adjustment (1.2x)
3. Quality optimization

### Data Extraction (Hierarchical)
1. MRZ parsing (passports/ID cards)
2. Pattern matching (various formats)
3. Fallback patterns (simplified extraction)

### Supported Formats
- **Passports**: TD-3 (2-line MRZ, 44 chars)
- **ID Cards**: TD-1 (3-line MRZ, 30 chars)
- **General**: Multiple regex patterns per field

## 📝 Usage

### Demo Login
- Email: `demo@hotel.com`
- Password: `demo123`

### Scanning Tips
1. Lay document flat on table
2. Use good, even lighting
3. Fill frame with document
4. Hold steady for 2-3 seconds

## 🧪 Building

```bash
# Android APK
flutter build apk --release

# iOS
flutter build ios --release
```

## 🚧 Development Status

### ✅ Completed
- Authentication (Online/Demo)
- Dashboard with statistics
- ID/Passport scanning with OCR
- MRZ detection
- Enhanced pattern matching
- Image preprocessing
- Guest registration with auto-fill
- Orange theme implementation

### 📋 Planned
- Guest list view
- Check-in/Check-out management
- QloApps API integration
- Offline sync

---

**Made with ❤️ using Flutter**
