# 🔧 Passport Name Extraction Fix

## Issue Found
The passport MRZ line `PBLKAKAIKARAGE<<THAKSHILA<DINUPA<SALINDA<KAI` was not being parsed correctly.

## Root Cause
The regex pattern expected: `P<LKA<<SURNAME<<GIVENNAMES`
But Sri Lankan passports use: `PBLKA<<SURNAME<<GIVENNAMES` (no separator after P)

## Fix Applied

### 1. Updated Passport MRZ Parser (lines 187-213)
Added three fallback patterns:
1. Standard: `P<LKA<<SURNAME<<GIVENNAMES`
2. Sri Lankan: `PBLKA<<SURNAME<<GIVENNAMES`
3. Fallback: `P[ANY]<<SURNAME<<GIVENNAMES`

### 2. Enhanced OCR Fallback (lines 424-476)
Added patterns to extract from:
- MRZ format with `P` prefix
- "Surname:" labels
- "Given Names:" labels  
- "Name:" fallback

## Expected Result

**Before Fix**:
- Document Number: ✅ N10285538
- First Name: ❌ Empty
- Last Name: ❌ Empty

**After Fix**:
- Document Number: ✅ N10285538
- First Name: ✅ THAKSHILA DINUPA SALINDA
- Last Name: ✅ KAIKARAGE
- Date of Birth: ✅ 2002-09-05
- Sex: ✅ M
- Expiry Date: ✅ 2033-02-06

## Test Instructions

1. **Hot Reload**: Press `r` in the Flutter terminal
2. **Scan Again**: Take photo of the same passport
3. **Verify**: Check that First Name and Last Name are filled

## Files Modified
- `lib/utils/ocr_helper.dart` (MRZ parsing and OCR patterns)
