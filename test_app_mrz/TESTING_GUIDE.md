# Testing Guide - Enhanced MRZ Scanner

## What Was Improved

### 🎯 Major Enhancements

1. **Universal Format Support**
   - ✅ TD-3 (Passports - 2 lines × 44 chars)
   - ✅ TD-1 (ID Cards - 3 lines × 30 chars)
   - ✅ TD-2 (ID Cards - 2 lines × 36 chars)

2. **OCR Error Correction**
   - Automatic I→1 conversion in numbers
   - Automatic O→0 conversion in document numbers
   - S→5, Z→2 for numeric sequences

3. **Multi-Mode Tesseract**
   - PSM 6: Uniform block (best for clean MRZ)
   - PSM 7: Single line (line-by-line)
   - PSM 11: Sparse text (damaged docs)

4. **Visual Guide Overlay**
   - Green frame shows MRZ positioning
   - Tips banner at top
   - Real-time status messages

5. **Manual Parsing Fallback**
   - Pattern-based extraction for damaged MRZ
   - Partial data extraction when automated parsing fails

6. **Smart Line Combination**
   - Tries all possible line combinations
   - Auto-pads/truncates to standard lengths
   - Case-insensitive matching

---

## Testing Checklist

### Test Set 1: Modern Passports (TD-3)

**Expected Success Rate: 90-95%**

Test with:
- [ ] US Passport
- [ ] UK Passport
- [ ] EU Passport (any country)
- [ ] Indian Passport
- [ ] Any other country passport

**What to check:**
- ✅ Both MRZ lines detected
- ✅ Name extracted correctly
- ✅ Document number correct
- ✅ Dates formatted as YYYY-MM-DD
- ✅ Processing time < 2 seconds

**Debug logs should show:**
```
Found 2 MRZ candidate lines
Line 0: P<COUNTRY<<<SURNAME...
Line 1: L898902C<3UTO...
✓ TD-3 Passport detected at lines 0, 1
```

---

### Test Set 2: National ID Cards (TD-1)

**Expected Success Rate: 85-92%**

Test with:
- [ ] German ID card
- [ ] Italian ID card
- [ ] Spanish DNI
- [ ] Any European ID card
- [ ] Turkish ID card

**What to check:**
- ✅ All 3 MRZ lines detected
- ✅ Type shows "ID Card (TD-1)"
- ✅ Personal data extracted
- ✅ ML Kit or Tesseract successful

**Debug logs should show:**
```
Found 3 MRZ candidate lines
✓ TD-1 ID Card detected at lines 0, 1, 2
```

---

### Test Set 3: TD-2 Format IDs

**Expected Success Rate: 85-90%**

Test with:
- [ ] Argentine DNI
- [ ] Mexican ID card
- [ ] Any South American ID
- [ ] Visa stickers with MRZ

**What to check:**
- ✅ 2 lines detected (36 chars each)
- ✅ Type shows "ID Card (TD-2)"
- ✅ Data extraction successful

---

### Test Set 4: Challenging Conditions

#### A. Poor Lighting
- [ ] Dim indoor light
- [ ] Shadow on document
- [ ] Backlit conditions

**Expected:** Tesseract fallback activates, success 70-80%

**Debug logs should show:**
```
Trying Tesseract OCR...
Trying Tesseract with PSM 6
✓ Tesseract succeeded with PSM 6
```

---

#### B. Worn/Damaged Documents
- [ ] Old passport (10+ years)
- [ ] Scratched MRZ area
- [ ] Faded ink
- [ ] Water-damaged

**Expected:** Manual parsing may activate, partial data 40-60%

**Debug logs should show:**
```
Manual parsing: Detected passport pattern
```

**Result may show:** "Passport (Manual)" with some "N/A" fields

---

#### C. Positioning Issues
- [ ] Document tilted 15°
- [ ] Partial MRZ in frame
- [ ] Too far from camera
- [ ] Too close (blurry)

**Expected:** May need 2-3 attempts, guidance helps

---

### Test Set 5: Edge Cases

#### A. Multi-Line Names
**Test:** Passport with very long name
**Expected:** Names truncated/split correctly
**Check:** No crashes, reasonable output

#### B. Special Characters in Names
**Test:** Names with ñ, é, ö, etc.
**Expected:** Converted to Latin (n, e, o)
**Example:** José → JOSE

#### C. Very New Passports
**Test:** Passport issued in 2024-2025
**Expected:** 95%+ success (pristine condition)

#### D. Mixed Document Session
**Test:** Scan passport, then ID, then passport again
**Expected:** Correct type detected each time

---

## Performance Benchmarks

### Expected Processing Times

| Scenario | ML Kit Only | + Tesseract PSM 6 | + PSM 7 | + PSM 11 |
|----------|-------------|-------------------|---------|----------|
| Perfect conditions | 50-100ms | - | - | - |
| Good conditions | 50-100ms | 300-400ms | - | - |
| Poor lighting | Failed | 400-500ms | 600ms | - |
| Damaged MRZ | Failed | Failed | 700ms | 900ms |

### Success Rate Goals

| Document Type | Target | Achieved (Test) |
|--------------|--------|-----------------|
| Modern Passport | 90% | ____% |
| New ID Card | 85% | ____% |
| Worn Passport | 65% | ____% |
| Damaged MRZ | 50% | ____% |
| **Overall** | **80%** | **____%** |

---

## How to Test Systematically

### Setup
1. ✅ App installed and running
2. ✅ Good lighting available
3. ✅ USB debugging enabled for logs
4. ✅ Run `flutter logs` in terminal
5. ✅ Have 5-10 different documents ready

### Test Protocol

For each document:

1. **Capture Screenshot** (before scan)
2. **Tap "Capture & Scan"**
3. **Note Status Messages:**
   - "Scanning with ML Kit..." → Fast success
   - "Trying Tesseract OCR..." → Fallback activated
   - "No MRZ found" → Failed completely

4. **Record Results:**
   - ✅ Success / ❌ Failed
   - Time taken: ____ seconds
   - Accuracy: All correct / Partial / Wrong

5. **Check Debug Logs:**
   - How many lines found?
   - Which format detected?
   - Any errors logged?

6. **Take Screenshot** (result screen)

### Comparison Test

**Old version (hotel-staff-flutter):**
- Success rate: 30-40%
- Processing: Complex preprocessing
- Code: 1000+ lines

**New version (test_app_mrz):**
- Success rate: ___% (measure!)
- Processing: Simple dual OCR
- Code: ~400 lines

**Goal:** New version should be **2x better** (60-80% success)

---

## Troubleshooting During Testing

### Problem: Still failing on some documents

**Check:**
1. Are debug logs showing lines found?
   - If 0 lines: Lighting/focus issue
   - If 1 line: MRZ partially visible
   - If 2+ lines but fail: Format issue

2. What do the lines look like?
   ```
   Line 0: P<COUNTRY<<<... (Good)
   Line 0: P<C0UNTRY<<<... (OCR error - 0 instead of O)
   Line 0: P<COUNY<<<...   (Too damaged)
   ```

3. Is Tesseract being tried?
   - Should see "Trying Tesseract OCR..." message
   - Check all 3 PSM modes attempted

**Solutions:**
- Add more OCR error corrections
- Adjust PSM modes
- Improve visual guide positioning

---

### Problem: Wrong data extracted

**Check:**
1. Compare debug log lines with physical document
2. Look for character substitutions:
   - Document: L898902C
   - Detected: L89890ZC (2→Z error)

**Solutions:**
- Add more character fixes in `_fixOCRErrors()`
- Try different Tesseract language data

---

### Problem: App crashes

**Check:**
1. Error in logs?
2. Which document caused it?
3. What format (TD-1/TD-2/TD-3)?

**Report:**
- Document type
- Full error stack trace
- Screenshot if possible

---

## Success Metrics

### Minimum Acceptable Performance (MVP)
- ✅ 70%+ success rate on modern documents
- ✅ 50%+ on worn documents
- ✅ < 2 seconds average processing time
- ✅ No crashes

### Target Performance (Good)
- ✅ 85%+ success rate on modern documents
- ✅ 65%+ on worn documents
- ✅ < 1.5 seconds average processing time
- ✅ Helpful error messages

### Excellent Performance (Ideal)
- ✅ 95%+ success rate on modern documents
- ✅ 80%+ on worn documents
- ✅ < 1 second average processing time
- ✅ Live detection (future)

---

## Reporting Results

### Format

```
Test Date: [Date]
Device: [Model]
Android Version: [Version]
Documents Tested: [Number]

Results:
- Passports (TD-3): X/Y successful (Z%)
- ID Cards (TD-1): X/Y successful (Z%)
- ID Cards (TD-2): X/Y successful (Z%)
- Damaged docs: X/Y successful (Z%)

Average time: X.X seconds
Tesseract triggered: X% of scans

Issues found:
1. [Issue description]
2. [Issue description]

Recommendations:
1. [Suggestion]
2. [Suggestion]
```

---

## Debug Commands

### View real-time logs:
```bash
flutter logs | grep -E "(MRZ|Tesseract|OCR)"
```

### Filter for errors only:
```bash
flutter logs | grep -E "(error|Error|ERROR)"
```

### Save logs to file:
```bash
flutter logs > mrz_test_logs.txt
```

---

## Next Steps After Testing

Based on results:

**If success rate < 70%:**
- Add image preprocessing (contrast, sharpness)
- Try different Tesseract configs
- Add more OCR error corrections

**If success rate 70-85%:**
- Fine-tune existing settings
- Add specific fixes for common failures
- Improve user guidance

**If success rate > 85%:**
- ✅ Production ready!
- Add polish features (animations, sounds)
- Consider live detection mode

---

## Remember

- 📸 Always test in realistic conditions (not just perfect lighting)
- 📝 Document failures with screenshots and logs
- 🔄 Test the same document 3 times to check consistency
- 🌍 Test documents from different countries
- ⏱️ Measure time for user experience
- 🐛 Every failure is a learning opportunity!

---

**Happy Testing!** 🚀
