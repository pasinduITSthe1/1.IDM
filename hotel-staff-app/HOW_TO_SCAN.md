# 📸 How to Scan ID/Passport Successfully

## ❌ Why Your Scan Failed

Looking at your screenshot, the scan failed because:
1. **ID Card was tilted/at an angle** - not flat
2. **Text was not readable** by OCR
3. **Possible lighting/shadow issues**

## ✅ How to Get Perfect Scans

### Step 1: Position the Document
```
❌ DON'T:                    ✅ DO:
- Hold in hand              - Place flat on table
- Tilt at angle            - Keep perfectly flat
- Partial in frame         - Fill entire orange frame
- Too far away             - Get close (fill 80% of frame)
```

### Step 2: Lighting
```
❌ DON'T:                    ✅ DO:
- Direct overhead light    - Diffused, even lighting
- Camera flash             - Natural light if possible
- Shadows on document      - No shadows
- Too dark                 - Bright but not glaring
```

### Step 3: Focus & Clarity
```
❌ DON'T:                    ✅ DO:
- Blurry photo             - Sharp, clear text
- Moving while capturing   - Hold camera steady
- Reflections/glare        - Matte surface, no glare
```

## 📋 Step-by-Step Perfect Scan

### For ID Cards (like yours):

1. **Place on Table**
   - Put ID card flat on a white/light colored surface
   - No need to hold it

2. **Position Camera**
   - Hold phone/camera directly above ID (parallel)
   - Get close enough so ID fills the orange guides (80-90%)
   - Make sure ALL text is visible and in frame

3. **Check Lighting**
   - Turn on room lights
   - Avoid direct overhead lights that create shadows
   - Ideal: natural window light from the side

4. **Capture Photo**
   - Hold camera steady
   - Make sure focus is on the ID (tap to focus on mobile)
   - Text should look sharp on screen BEFORE capturing
   - Click "Capture"

5. **Review Captured Image**
   - Before clicking "Scan Document"
   - Zoom in to check if text is readable
   - If blurry → click "Retake"

6. **Scan**
   - If image looks clear → click "Scan Document"
   - Watch console logs (F12) to see what's happening
   - Wait for results

### For Passports:

1. **Open passport to photo/info page**

2. **Place flat on table**
   - Book should be fully open and flat

3. **CRITICAL: MRZ Lines Must Be Visible**
   - MRZ = Machine Readable Zone
   - These are the 2-3 lines of text at the BOTTOM
   - They look like: `P<USADOE<<JOHN<<<<<<...`
   - Make sure these lines are IN THE FRAME and CLEAR

4. **Follow same lighting/capture steps as ID card**

## 🔍 What the App Is Looking For

### For Passports (Best Results):
The app looks for **MRZ lines** (bottom of passport):
```
P<USADOE<<JOHN<<<<<<<<<<<<<<<<<<<<<<<<<<
L898902C36USA8001014M2501017<<<<<<<<<<<<<<6
```
These contain ALL the data encoded!

### For ID Cards (Medium Results):
The app uses OCR to read visible text:
- **Name:** First Name, Last Name, Full Name
- **Document Number:** ID No, Card No, Doc #
- **Date of Birth:** DOB, Birth Date, Born
- **Expiration:** Exp, Expiry, Expires, Valid Until
- **Other:** Nationality, Sex/Gender

## 💡 Pro Tips

### ✅ Best Practices:
1. **Clean the document** - no smudges, fingerprints
2. **Clean camera lens** - wipe with soft cloth
3. **Use white/light background** - better contrast
4. **Natural daylight is best** - near window
5. **Hold phone parallel** - not at angle
6. **Fill the orange guides** - document should be 80-90% of frame
7. **Check focus** - tap on document to focus (mobile)
8. **Steady hands** - rest elbows on table if shaky

### 📱 Mobile Specific:
- Use **back camera** (better quality)
- **Tap to focus** on the document text
- **Hold steady** for 2 seconds before capturing
- Use **HDR mode** if available (better lighting)

### 💻 Desktop Webcam:
- **External lighting** helps (desk lamp from side)
- Get as **close as possible** to document
- Use **highest resolution** camera has
- May need to **manual focus** if webcam supports it

## 🎯 Your Next Attempt

Based on your failed scan, here's what to do differently:

1. ✅ **Place ID FLAT on table** (don't hold it)
2. ✅ **Get closer** - ID should fill 80% of the orange frame
3. ✅ **Hold camera directly above** (parallel, not angled)
4. ✅ **Turn on more lights** - make sure text is clearly visible
5. ✅ **Before clicking Capture** - check if YOU can read all the text on screen
   - If you can't read it clearly, neither can the OCR
6. ✅ **After capturing** - review the image
   - Can you read the name?
   - Can you read the ID number?
   - If NO → Retake!
7. ✅ **Then click "Scan Document"**

## 📊 What Success Looks Like

### In Console (F12):
```
Starting OCR recognition...
=== FULL OCR TEXT ===
[Actual readable text from your ID]
====================
Cleaned Lines: ["Name", "JOHN DOE", "ID No", "123456789", ...]
✅ MRZ PARSED SUCCESSFULLY!  ← (passports)
  OR
Found firstName: "JOHN"
Found lastName: "DOE"
Found documentNumber: "123456789"
OCR Extracted Data: {firstName: "JOHN", lastName: "DOE", ...}
✅ Final Scan Result: {...}
```

### On Screen:
- You'll see **green card** with extracted data
- **Document Type** chip at top
- All fields populated with your info
- Button: "Use for Guest Registration"

## 🆘 Still Not Working?

### Quick Diagnostic:
1. Open Console (F12)
2. Look at `=== FULL OCR TEXT ===`
3. Can you read ANY text from your ID there?

**If YES** → Text is being extracted, patterns need adjustment
**If NO** → Image quality issue, follow tips above

### Last Resort:
If scanning keeps failing after multiple attempts:
1. Click "Use for Guest Registration" anyway
2. Manually enter the data (takes 2 minutes)
3. The form will still work perfectly!

---

**Remember**: The scanning is a helper feature, not required. You can always enter data manually! 😊
