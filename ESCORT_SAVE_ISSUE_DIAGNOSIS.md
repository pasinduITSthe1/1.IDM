# 🔍 ESCORT SAVE ISSUE - DIAGNOSIS

## Problem Description
When adding escorts, they are being saved as **new guests** instead of being linked to the **main guest**.

## Root Cause Analysis

### Expected Behavior:
1. User selects guest "Ali Khan" (id_customer = 33 or similar)
2. Clicks "Add Escort"
3. Escort should be saved with `id_customer = 33` in `guest_escorts` table
4. Escort appears under "Ali Khan" only

### Current Behavior (Suspected):
1. Escort being saved without proper `id_customer` link
2. OR escort being created as a new guest in `qlo_customer` table
3. OR `id_customer` value is incorrect/null

## Investigation Steps

### Step 1: Check what guestId is being passed ✅

**From guest_escorts_screen.dart line 70:**
```dart
'guestId': widget.guest.id,
'guestName': widget.guest.fullName,
```

**To escort_registration_screen.dart line 343:**
```dart
guestId: widget.guestId,
```

**To API via toApiJson() line 166:**
```dart
'id_customer': guestId,
```

✅ **Code flow is correct!**

### Step 2: Check Guest ID Format

Need to verify:
- What is `widget.guest.id` actually containing?
- Is it a number string ("33") or UUID string ("abc-123-def")?
- Does it match `id_customer` in `qlo_customer` table?

### Step 3: Check Backend Receives Correct Data

Added debug logging in `routes/escorts.js`:
```javascript
console.log('📥 Received escort data:', JSON.stringify(req.body, null, 2));
console.log('🔍 Extracted id_customer:', id_customer, '(type:', typeof id_customer, ')');
```

### Step 4: Verify Database Insert

Check if `id_customer` in INSERT query is valid:
```sql
INSERT INTO guest_escorts (id_customer, first_name, ...) 
VALUES (?, ?, ...)
```

## Possible Issues

### Issue 1: Guest ID is UUID instead of integer
**Problem:** Flutter app uses UUID for guest ID, but database expects integer
**Solution:** Need to use `id_customer` from qlo_customer table

### Issue 2: Foreign key constraint failing
**Problem:** `id_customer` value doesn't exist in `qlo_customer` table
**Solution:** Verify the guest exists before adding escort

### Issue 3: Wrong database table
**Problem:** Backend might be inserting into wrong table
**Solution:** Confirm INSERT goes to `guest_escorts`, not `qlo_customer`

## Next Steps

1. **Test in Flutter app** - Try adding an escort
2. **Check backend console** - Look for debug logs showing received data
3. **Query database** - Check what was actually inserted:
   ```sql
   USE qloapps_db;
   SELECT * FROM guest_escorts ORDER BY created_at DESC LIMIT 1;
   SELECT * FROM qlo_customer ORDER BY date_add DESC LIMIT 1;
   ```

4. **Verify guest ID** - Check what ID the Flutter app is using:
   ```sql
   SELECT id_customer, firstname, lastname 
   FROM qlo_customer 
   WHERE firstname = 'Ali';
   ```

## Test Data

Based on screenshot:
- Guest Name: Ali Khan
- Room: 99
- Current Escorts: 0

Need to find this guest's `id_customer` value and verify it's being passed correctly to the escort registration.

---

**Status:** Debugging in progress with console logging enabled
**Next:** Try adding an escort and check the backend console output
