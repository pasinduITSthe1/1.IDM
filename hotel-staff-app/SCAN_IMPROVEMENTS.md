# Document Scanning Improvements

## Changes Made

### 1. **Larger Scan Area** 📸
- Increased minimum camera height from auto to **500px**
- Improved video quality: 1920x1080 → **2560x1440**
- Added `objectFit: 'cover'` for better camera display
- Set `screenshotQuality: 1` for maximum quality

### 2. **Enhanced Visual Guides** 🎯
- Added **corner guides** (4 orange L-shaped corners)
- Added **semi-transparent overlay** around scan area
- Made scan frame more prominent with dashed border
- Better visual indication of where to place document

### 3. **Improved MRZ Detection** 🔍
- Enhanced MRZ line detection with better regex patterns
- Try multiple combinations of MRZ lines (not just first 2-3)
- Added **debug console logging** to track detection
- Better whitespace handling in MRZ parsing
- Added date formatting (YYMMDD → DD/MM/YYYY)
- Improved character whitelist for Tesseract OCR

### 4. **Better OCR Extraction** 📄
- Enhanced pattern matching for various ID formats
- Added support for more field variations:
  - "First Name", "Given Name", "Name"
  - "Last Name", "Surname", "Family Name"
  - "DOB", "Date of Birth", "Born", "Birth Date"
  - "Exp", "Expiry", "Valid Until", "Expires"
  - "ID", "Doc", "Number", "Card", "Passport"
- Improved regex patterns for better text extraction
- Added console logging for debugging

### 5. **Auto-Fill Functionality** ✅
- Data automatically flows from scan to registration form
- Fields mapped correctly:
  - firstName → First Name
  - lastName → Last Name
  - dateOfBirth → Date of Birth
  - nationality → Nationality
  - documentType → Document Type
  - documentNumber → Document Number
  - expirationDate → Document Expiry
  - issuingCountry → Country

## How It Works

1. **Capture**: User aligns document within orange guides
2. **Scan**: Tesseract OCR extracts all text from image
3. **MRZ Parse**: Attempts to parse Machine Readable Zone first (highest accuracy)
4. **OCR Parse**: Falls back to pattern matching if MRZ not found
5. **Auto-Fill**: Extracted data is passed to registration form
6. **Success**: Green alert shows which fields were populated

## Tips for Best Results

### For Passports 🛂
- Place passport on flat surface
- Ensure MRZ (bottom 2-3 lines) is clearly visible
- Good lighting is essential
- Keep camera steady

### For ID Cards 🪪
- Place card flat within guides
- Ensure all text is visible and not cut off
- Avoid glare from plastic cards
- Hold camera steady

### For Driver's Licenses 🚗
- Place license flat on surface
- Ensure all fields are within frame
- Good contrast between text and background
- Avoid shadows

## Troubleshooting

### If MRZ Not Detected:
1. Check console logs (F12) for "Detected MRZ Lines"
2. Ensure bottom lines of passport are clear
3. Retake photo with better lighting
4. Make sure document fills most of the scan area

### If OCR Fails:
1. Check console logs for "OCR Extracted Data"
2. Retake photo with higher quality
3. Ensure text is readable (not blurry)
4. Manually enter data if auto-fill fails

### If No Data Auto-Fills:
1. After scanning, click "Use for Guest Registration"
2. Check if green success alert appears on registration page
3. Look for "Form auto-filled from scanned document" message
4. Manually fill any missing fields

## Debug Mode

Console logs now show:
- `OCR Result:` - Full text extracted from document
- `Detected MRZ Lines:` - Lines identified as potential MRZ
- `Attempting MRZ Parse:` - Each MRZ parsing attempt
- `MRZ Parse Success:` - Successfully parsed data
- `OCR Extracted Data:` - Data extracted via pattern matching

Open browser console (F12) to see these logs during scanning.

## Future Enhancements

- [ ] Add image preprocessing (brightness, contrast, edge detection)
- [ ] Support for more document types (visa, residence permit)
- [ ] Multi-language OCR support
- [ ] Real-time scanning (without capture button)
- [ ] Barcode/QR code scanning for modern IDs
- [ ] AI-powered document detection and cropping

---

**Note**: MRZ detection works best with machine-readable documents (passports, some national IDs). For other documents, the system falls back to OCR pattern matching.
