# FREE MRZ Scanner App

A **100% FREE** Flutter application for scanning MRZ (Machine Readable Zone) from passports and ID cards using Google ML Kit.

## ✅ Features

- **Completely FREE** - No paid SDKs or licenses required
- **Google ML Kit** text recognition
- **MRZ Parser** library for data extraction
- Supports **TD-1** (ID Cards - 3 lines)
- Supports **TD-3** (Passports - 2 lines)
- Clean, modern Material Design 3 UI
- Camera permission handling
- Simple capture & scan workflow

## 📦 Dependencies (All FREE)

`yaml
google_mlkit_text_recognition: ^0.15.0  # FREE
camera: ^0.11.0+2                       # FREE
mrz_parser: ^2.0.0                      # FREE
permission_handler: ^11.3.0             # FREE
image: ^4.1.3                           # FREE
`

## 🚀 Getting Started

### 1. Install Dependencies

`ash
flutter pub get
`

### 2. Run the App

`ash
flutter run
`

### 3. How to Use

1. Tap **"Start Scanning"** on home screen
2. Position passport or ID card in camera view
3. Tap **"Capture & Scan"** button
4. Wait for processing (1-2 seconds)
5. View extracted MRZ data

## 📱 Supported Document Types

### TD-3 (Passports)
- 2 lines x 44 characters
- Format:
  `
  P<COUNTRY<<SURNAME<<GIVEN<NAMES<<<<<<<<<<<<<<<<<<
  DOCUMENT#<<<DOB<SEX<EXPIRY<NATIONALITY<<<<<<<<<<<<
  `

### TD-1 (ID Cards)
- 3 lines x 30 characters
- Format:
  `
  I<COUNTRY<DOCUMENT#<<<<<<<<<
  DOB<SEX<EXPIRY<NATIONALITY<<
  SURNAME<<GIVEN<NAMES<<<<<<<<
  `

## How It Works

1. **Camera Capture**: High-resolution photo with visual guide overlay
2. **Primary OCR**: Google ML Kit (fast, 50-100ms)
3. **OCR Error Correction**: Fixes I/1, O/0, S/5, Z/2 confusion
4. **Smart Detection**: Tries all MRZ formats (TD-1, TD-2, TD-3)
5. **Fallback OCR**: Tesseract with 3 different modes if ML Kit fails
6. **Manual Parsing**: Pattern-based extraction for damaged documents
7. **Parse & Display**: Structured data extraction via mrz_parser

## 📝 Android Permissions

Already configured in AndroidManifest.xml:
`xml
<uses-permission android:name="android.permission.CAMERA"/>
`

## ⚠️ Limitations

Since this uses FREE OCR (not specialized MRZ scanner):
- Requires good lighting
- Document must be flat and clear
- May need multiple attempts
- Works best with high contrast

## 🆚 Comparison with Paid SDKs

| Feature | FREE (This App) | Paid (BlinkID) |
|---------|-----------------|----------------|
| Cost | \ | \+/year |
| MRZ Detection | ML Kit OCR | Native MRZ SDK |
| Accuracy | 70-80% | 95%+ |
| Speed | 1-2 seconds | <1 second |
| Setup | Flutter pub get | License key required |

## 🐛 Troubleshooting

**"No MRZ found"**:
- Ensure good lighting
- Hold camera steady
- Make sure MRZ lines are visible
- Try capturing again

**"Camera permission denied"**:
- Go to Settings > Apps > FREE MRZ Scanner > Permissions
- Enable Camera permission

## 📄 License

MIT License - Free to use and modify

## 🙏 Credits

- Google ML Kit (FREE text recognition)
- mrz_parser (FREE MRZ parsing)
- Flutter Camera plugin
