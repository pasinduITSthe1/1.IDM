# ID/Passport Scanning Guide 🆔

## ✅ What Was Fixed

### 1. **Improved MRZ Detection**
- ✅ Better line cleaning and detection
- ✅ Tries both 2-line (ID cards) and 3-line (passports) MRZ formats
- ✅ Multiple parsing attempts with different line combinations
- ✅ Proper date formatting (YYMMDD → YYYY-MM-DD for form inputs)

### 2. **Enhanced OCR Pattern Matching**
- ✅ More flexible regex patterns
- ✅ Handles various label formats (spaces, capitalization)
- ✅ Extracts full names if separate first/last not found
- ✅ Automatic date format conversion
- ✅ Minimum 2 fields required before returning data

### 3. **Auto-Fill Functionality**
- ✅ Proper date format for HTML date inputs (YYYY-MM-DD)
- ✅ Console logging at every step
- ✅ Clear visual feedback when data is populated
- ✅ Green success alert on registration page

## 🧪 How to Test

### Step 1: Open the App
```
http://localhost:3001
```

### Step 2: Login
- Toggle to "Demo Mode"
- Email: `staff@hotel.com`
- Password: `demo123`

### Step 3: Scan Document
1. Click **"Scan Document"** card
2. Allow camera access when prompted
3. Place ID or Passport within the orange guides
4. Click **"Capture"** button
5. Click **"Scan Document"** button
6. Wait for progress bar to complete

### Step 4: Check Console (F12)
Open browser Developer Tools (F12) and look for these logs:

```
Starting OCR recognition...
=== FULL OCR TEXT ===
[Full extracted text shown here]
====================
Cleaned Lines: [...]
Potential MRZ Lines: [...]
Trying 2-line MRZ: [...]  or  Trying 3-line MRZ: [...]
✅ MRZ PARSED SUCCESSFULLY!
MRZ Result: {...}
Extracted Data: {firstName: "...", lastName: "...", ...}
✅ Final Scan Result: {...}
```

### Step 5: Use Scanned Data
1. Click **"Use for Guest Registration"** button
2. You should see:
   - Green alert: "Form auto-filled from scanned document"
   - Form fields populated with extracted data
   - Console log: `📄 Received scanned data:`
   - Console log: `✅ Auto-filling form with:`

## 📋 Supported Document Types

### ✅ Passports (Best Results)
- **Features**: 3-line MRZ at bottom
- **Data Extracted**:
  - First Name
  - Last Name
  - Document Number
  - Nationality
  - Date of Birth
  - Expiration Date
  - Sex
  - Issuing Country

### ✅ National ID Cards
- **Features**: 2-line MRZ (some countries)
- **Data Extracted**: Same as passport

### ⚠️ Driver's Licenses / Other IDs
- **Features**: No MRZ, uses OCR pattern matching
- **Data Extracted**: 
  - Depends on text clarity
  - May require manual entry for missing fields

## 🎯 Tips for Best Results

### For Passports
1. ✅ Open passport to photo/info page
2. ✅ Place flat on table
3. ✅ Ensure **MRZ lines at bottom are clearly visible**
4. ✅ Good, even lighting (avoid shadows)
5. ✅ No glare on the page
6. ✅ Fill the orange frame with the passport

### For ID Cards
1. ✅ Place card flat
2. ✅ Center within orange guides
3. ✅ Ensure all text is visible
4. ✅ Avoid reflections from plastic surface
5. ✅ Hold camera steady

### Lighting Tips
- ☀️ Use natural light when possible
- 💡 Avoid overhead lights that create shadows
- ⚠️ No direct flash on document
- ✅ Diffused, even lighting is best

## 🔍 Debugging Guide

### If MRZ Detection Fails:

**Check Console Logs:**
```javascript
// Should show MRZ lines:
Potential MRZ Lines: ["P<USADOE<<JOHN<<<<<<...", "L898902C36USA8001014M..."]

// If empty array:
Potential MRZ Lines: []
```

**Solutions:**
1. ✅ Ensure MRZ lines are in frame
2. ✅ Take photo closer to document
3. ✅ Improve lighting
4. ✅ Clean camera lens
5. ✅ Try multiple times

### If OCR Pattern Fails:

**Check Console Logs:**
```javascript
Attempting OCR pattern extraction...
Found firstName: "JOHN"
Found lastName: "DOE"
OCR Extracted Data: {firstName: "JOHN", lastName: "DOE", ...}
```

**Solutions:**
1. ✅ Ensure text is sharp and clear
2. ✅ Improve lighting/contrast
3. ✅ Hold camera steady
4. ✅ Clean document (no smudges)

### If Auto-Fill Fails:

**Check Registration Page Console:**
```javascript
📄 Received scanned data: {firstName: "JOHN", ...}
✅ Auto-filling form with: {firstName: "JOHN", ...}
```

**If NOT showing above:**
- ❌ Data not passed from scan page
- Check if "Use for Guest Registration" button was clicked
- Check browser navigation state

## 📊 What Each Field Means

| Field Name | Source | Format | Example |
|------------|--------|--------|---------|
| firstName | MRZ/OCR | Text | JOHN |
| lastName | MRZ/OCR | Text | DOE |
| documentNumber | MRZ/OCR | Alphanumeric | L898902C3 |
| nationality | MRZ/OCR | 3-letter code | USA |
| dateOfBirth | MRZ/OCR | YYYY-MM-DD | 1980-01-01 |
| expirationDate | MRZ/OCR | YYYY-MM-DD | 2030-12-31 |
| sex | MRZ/OCR | M/F | M |
| issuingCountry | MRZ only | 3-letter code | USA |

## 🐛 Common Issues

### Issue: "Could not extract data from document"
**Causes:**
- Document not clear enough
- Poor lighting
- MRZ not visible/in frame
- Text too blurry

**Fix:**
- Retake photo with better conditions
- Ensure entire document is in frame
- Use better lighting

### Issue: "Some fields are empty after auto-fill"
**Causes:**
- OCR couldn't read those fields
- Field not present on document
- Text too small/blurry

**Fix:**
- Manually enter missing data
- These fields can be edited after auto-fill

### Issue: "Dates are in wrong format"
**Causes:**
- Old code or browser caching

**Fix:**
- Hard refresh (Ctrl+F5)
- Clear browser cache
- Dates should be YYYY-MM-DD format

## 📱 Mobile Testing

For best mobile experience:
1. Access app via mobile IP: `http://192.168.251.166:3001`
2. Use back camera (better quality)
3. Tap to focus on MRZ area
4. Hold device steady
5. Ensure good lighting

## 🎓 Sample Test Documents

You can test with:
- ✅ Your own passport (safest - no data stored)
- ✅ Sample passport images online
- ✅ ID card or driver's license
- ⚠️ Avoid using other people's documents

## 📞 Need Help?

Check the browser console (F12) for detailed logs showing:
- Full OCR text extraction
- MRZ detection attempts
- Data extraction results
- Form auto-fill confirmation

All major steps are logged for debugging!

---

**Last Updated**: 2025-01-09
**Version**: 2.0
**Status**: ✅ Production Ready
