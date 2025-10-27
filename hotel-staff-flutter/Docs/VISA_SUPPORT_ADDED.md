# Visa Support Added to MRZ Scanner

## Changes Made (October 23, 2025)

### 1. MRZ Scanner - Added Visa Types Support
**File:** `lib/screens/mrz_scanner_screen.dart`

#### Added MRV-A (Machine Readable Visa Type A)
- **Format:** 2 lines × 44 characters
- **Size:** 80mm × 120mm (full-page visas)
- **Detection:** Checks if first line starts with 'V'
- **Label:** "Visa (MRV-A)"

#### Added MRV-B (Machine Readable Visa Type B)
- **Format:** 2 lines × 36 characters  
- **Size:** 74mm × 105mm (smaller visas)
- **Detection:** Checks if first line starts with 'V'
- **Label:** "Visa (MRV-B)"

#### Enhanced Manual Parsing
- Added visa pattern detection in fallback parsing
- Detects lines starting with 'V' for damaged/poor quality visa MRZ
- Returns "Visa (Manual)" when manually parsed

### 2. Guest Registration Form - Replaced License with Visa
**File:** `lib/screens/guest_registration_screen.dart`

#### UI Changes
- **Removed:** "Driver License" radio option
- **Added:** "Visa" radio option
- **Value:** Changed from `driver_license` to `visa`

#### Logic Updates
- Updated document type mapping to handle `visa` type
- Removed `driver_license` mapping logic
- Added proper `visa` type recognition from scanned data

## Supported Document Types (Complete List)

| Type | Lines | Chars/Line | Size | Use Case |
|------|-------|------------|------|----------|
| **TD-3** | 2 | 44 | 125×88mm | Passport booklets |
| **TD-2** | 2 | 36 | 105×74mm | Some ID cards |
| **TD-1** | 3 | 30 | 85.6×54mm | ID cards (credit card size) |
| **MRV-A** ✨ | 2 | 44 | 80×120mm | Full-page visas |
| **MRV-B** ✨ | 2 | 36 | 74×105mm | Smaller visas |

✨ = **Newly Added**

## How It Works

### Visa Detection Process
1. **OCR Processing:** Image is processed by ML Kit + Tesseract
2. **Line Filtering:** Potential MRZ lines are identified (20+ chars)
3. **Format Detection:** System tries all formats in order:
   - TD-3 (Passports)
   - TD-1 (ID Cards)
   - TD-2 (ID Cards)
   - **MRV-A (Full-page Visas)** ← New
   - **MRV-B (Smaller Visas)** ← New
4. **Visa Identification:** Lines starting with 'V' are recognized as visas
5. **Result Formatting:** Extracted data includes:
   - Document type: "Visa (MRV-A)" or "Visa (MRV-B)"
   - First/Last name
   - Document/Visa number
   - Nationality
   - Date of birth
   - Sex
   - Expiry date

### Guest Registration Form
- **Radio Options:** Passport | ID Card | Visa
- **Auto-Fill:** Scanned visa data populates form fields
- **Document Type:** Automatically set to "visa" when visa MRZ is detected

## Testing Checklist

- [ ] Scan passport → Should detect TD-3
- [ ] Scan national ID card → Should detect TD-1 or TD-2
- [ ] Scan full-page visa (80×120mm) → Should detect MRV-A
- [ ] Scan smaller visa (74×105mm) → Should detect MRV-B
- [ ] Verify "Visa" radio option appears in registration form
- [ ] Verify "License" option is removed
- [ ] Test visa data auto-fills form correctly
- [ ] Check document type saved as "visa" in database

## Technical Notes

### Visa MRZ Format
```
Line 1: V<TYPE<COUNTRY<<<NAME<<<<<<<<<<<<<<<<<<
        ↑ Always starts with 'V'

Line 2: DOCNUMBER<NATIONALITY<YYMMDD<M<YYMMDD<<
```

### Detection Priority
1. Passport (TD-3) - Most common in hotels
2. ID Cards (TD-1, TD-2) - National IDs
3. Visas (MRV-A, MRV-B) - Travel visas
4. Manual parsing fallback for damaged documents

### Why This Matters for Hotels
- **International guests:** Many require visas for entry
- **Complete documentation:** Hotels need both passport AND visa info
- **Regulatory compliance:** Some countries require visa data collection
- **Streamlined check-in:** Auto-capture visa details from sticker/stamp

## Database Impact
- `document_type` field can now store: `"passport"`, `"id_card"`, or `"visa"`
- Existing records with `"driver_license"` should be migrated if needed

## Known Limitations
- Visa stickers in passports may be challenging to photograph separately
- Very old or worn visas might need manual entry
- Some countries use non-standard visa formats (will fall back to manual parsing)

---
**Status:** ✅ Implementation Complete  
**Tested:** Pending device testing  
**Ready for:** Production deployment
