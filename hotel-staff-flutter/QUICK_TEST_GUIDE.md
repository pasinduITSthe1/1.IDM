# Quick Start Guide - Testing MRZ/OCR Scanning

## Testing the Improvements

### Prerequisites
1. Android device or emulator with camera
2. Sample passport or ID card (or use test images)
3. Good lighting conditions

### Quick Test Steps

#### 1. Build & Run
```bash
cd c:\wamp64\www\1.IDM\hotel-staff-flutter
flutter clean
flutter pub get
flutter run
```

#### 2. Navigate to Scanner
1. Open app
2. Login (use credentials from LOGIN_CREDENTIALS.txt)
3. Tap "Guest Registration" or "Scan Document"

#### 3. Scan Test Document
- **For Passport:**
  - Focus on bottom 2 lines (MRZ zone)
  - Lines look like: `P<UTOERIKSSON<<ANNA<MARIA<<<<<<<<<<<<<<`
  
- **For ID Card:**
  - Focus on bottom 3 lines (MRZ zone)
  - Lines look like: `IDUTO1234567890<<<<<<<<<<<<<<<`

#### 4. Verify Results
Look for these fields to auto-fill:
- ✅ First Name
- ✅ Last Name
- ✅ Document Number
- ✅ Date of Birth
- ✅ Nationality
- ✅ Sex
- ✅ Expiration Date
- ✅ Document Type

### Check Debug Logs

Enable debug output in VS Code terminal:
```
🔍 MRZ Detection: Processing X lines
📝 OCR Results: X blocks, Y lines
✅ Strategy 1: MRZ extraction...
✅ Final Extracted Data (X fields):
  firstName: JOHN
  lastName: SMITH
  documentNumber: A12345678
  ...
```

### Test Scenarios

#### ✅ Perfect Conditions
- Well-lit room
- Document flat on table
- Camera stable
- **Expected:** 7-8 fields extracted

#### ⚠️ Challenging Conditions  
- Dim lighting
- Slightly tilted document
- Handheld (some shake)
- **Expected:** 4-6 fields extracted

#### ❌ Poor Conditions
- Very dark
- Document curved/damaged
- Heavy motion blur
- **Expected:** 0-3 fields, manual entry suggested

### Common Issues & Fixes

| Issue | Fix |
|-------|-----|
| No camera permission | Go to Settings → Apps → Hotel Staff → Permissions |
| Black screen | Restart app |
| No fields extracted | Better lighting, hold closer |
| Wrong data | Always verify & correct |
| App crash | Check logs, report issue |

### Sample MRZ Test Data

#### Passport (TD-3):
```
P<UTOERIKSSON<<ANNA<MARIA<<<<<<<<<<<<<<<<<<<
L898902C36UTO7408122F1204159ZE184226B<<<<<10
```

#### ID Card (TD-1):
```
I<UTOD231458907<<<<<<<<<<<<<<<
7408122F1204159UTO<<<<<<<<<<<6
ERIKSSON<<ANNA<MARIA<<<<<<<<<<
```

### Performance Expectations

| Metric | Target | Acceptable | Poor |
|--------|--------|------------|------|
| Success Rate | 80-90% | 60-80% | <60% |
| Fields Extracted | 7-8 | 5-6 | <5 |
| Processing Time | 2-4s | 4-6s | >6s |
| Accuracy | 90%+ | 80-90% | <80% |

### Report Issues

If scanning consistently fails:
1. Check debug logs
2. Note lighting conditions
3. Take photo of document (redact sensitive info)
4. Report device model and Android version
5. Include log output

---

## Additional Testing

### A. Test Different Document Types
- [ ] Passport
- [ ] National ID Card
- [ ] Driver's License
- [ ] Visa
- [ ] Refugee Travel Document

### B. Test Different Lighting
- [ ] Bright sunlight
- [ ] Indoor LED light
- [ ] Fluorescent light
- [ ] Dim room light
- [ ] Flash on
- [ ] Flash off

### C. Test Different Angles
- [ ] Straight on (0°)
- [ ] Slight tilt (<10°)
- [ ] Moderate tilt (10-20°)
- [ ] Heavy tilt (>20°)

### D. Test Different Distances
- [ ] Very close (<10cm)
- [ ] Close (10-20cm)
- [ ] Medium (20-30cm)
- [ ] Far (>30cm)

---

## Success Indicators

✅ **Excellent Performance:**
- 8+ fields extracted consistently
- <3 seconds processing
- High accuracy (90%+)
- Minimal corrections needed

✅ **Good Performance:**
- 6-7 fields extracted
- 3-5 seconds processing
- Good accuracy (80%+)
- Minor corrections needed

⚠️ **Acceptable Performance:**
- 4-5 fields extracted
- 5-7 seconds processing
- Fair accuracy (70%+)
- Moderate corrections needed

❌ **Poor Performance:**
- <4 fields extracted
- >7 seconds processing
- Low accuracy (<70%)
- Manual entry recommended

---

## Tips for Best Results

### 📸 Camera
- Clean lens before scanning
- Enable HDR if available
- Disable digital zoom
- Use rear camera (better quality)

### 💡 Lighting
- Use natural daylight when possible
- Avoid direct shadows on document
- Avoid glare/reflections
- Use desk lamp if indoors

### 📄 Document
- Place on flat, dark surface
- Ensure MRZ zone is visible
- Straighten document edges
- Remove protective covers

### 📱 Technique
- Hold phone parallel to document
- Fill frame with document
- Hold steady for 2-3 seconds
- Tap capture when focused

---

**Happy Testing! 🎉**

For questions or issues, check the full documentation in `MRZ_OCR_IMPROVEMENTS.md`
