# 🧪 Testing the Database Fix

## Quick Test Steps

### Test 1: Register and Verify Storage
1. **Start the app:**
   ```powershell
   flutter run
   ```

2. **Register a test guest:**
   - Dashboard → "New Registration"
   - Fill in:
     - First Name: John
     - Last Name: Doe
     - Email: john@test.com
     - Phone: 1234567890
     - Document Number: ABC123
   - Tap "Register Guest"

3. **Check debug console:**
   - You should see: `✅ Saved 1 guests to local storage`

4. **Verify guest appears:**
   - Dashboard stats should show "1" Total Guest
   - "1" in Pending Check-Ins

### Test 2: Check-In and Verify Storage
1. **Check in the guest:**
   - Dashboard → "Check-In"
   - Find "John Doe" in the list
   - Enter room number: 101
   - Tap "Check In" → Confirm

2. **Check debug console:**
   - You should see: `✅ Saved 1 guests to local storage`

3. **Verify status updated:**
   - Dashboard stats should show "1" Checked-In
   - "0" Pending Check-Ins

### Test 3: Restart App and Verify Persistence
1. **Close the app completely:**
   - Stop the Flutter app (Ctrl+C in terminal or stop in IDE)

2. **Restart the app:**
   ```powershell
   flutter run
   ```

3. **Check debug console on startup:**
   - You should see: `✅ Loaded 1 guests from local storage`

4. **Verify data persisted:**
   - Dashboard should show same stats (1 Total, 1 Checked-In)
   - View All Guests → John Doe should be there
   - Status should be "Checked-In"
   - Room number should be "101"

### Test 4: Multiple Guests
1. **Register more guests:**
   - Register 3-4 more guests
   - Check console after each: `✅ Saved X guests to local storage`

2. **Check in some guests:**
   - Check in 2 guests with different room numbers
   - Console should confirm saves

3. **Restart and verify:**
   - Close app
   - Restart app
   - Console should show: `✅ Loaded X guests from local storage`
   - All guests should be there with correct statuses

### Test 5: Check-Out and Verify
1. **Check out a guest:**
   - Dashboard → "Check-Out"
   - Select a checked-in guest
   - Tap "Check Out" → Confirm

2. **Check console:**
   - Should see: `✅ Saved X guests to local storage`

3. **Restart and verify:**
   - Guest status should persist as "Checked-Out"
   - Check-out date should be saved

## Expected Console Output

### On First App Launch (No Data):
```
ℹ️ No guests found in local storage
```

### After Registering First Guest:
```
✅ Saved 1 guests to local storage
```

### After Check-In:
```
✅ Saved 1 guests to local storage
```

### On App Restart (With Data):
```
✅ Loaded 1 guests from local storage
```

### After Multiple Operations:
```
✅ Saved 3 guests to local storage
✅ Loaded 3 guests from local storage
```

## What to Look For

### ✅ Success Indicators:
- Console shows save messages after operations
- Console shows load message on app start
- Guest counts match in dashboard stats
- All guest data is retained after restart
- Check-in dates and room numbers persist
- Status changes are saved correctly

### ❌ If Something's Wrong:
- No console messages → Provider not initializing
- "No guests found" on restart → Data not saving
- Guests disappear on restart → Storage not loading
- Wrong counts → Status values incorrect

## Troubleshooting

### Issue: No console messages
**Solution:** Check that debug console is visible in your IDE

### Issue: Data not persisting
**Solution:** 
1. Check SharedPreferences permissions
2. Verify no errors in console
3. Try uninstalling and reinstalling app

### Issue: Wrong guest counts
**Solution:**
1. Check guest status values match: 'pending', 'checked-in', 'checked-out'
2. Verify filter logic in screens

## Running the App

### Development Mode:
```powershell
cd c:\wamp64\www\1.IDM\hotel-staff-flutter
flutter run
```

### Debug Mode with Logs:
```powershell
flutter run --verbose
```

### Hot Reload:
- Press `r` in terminal to hot reload
- Press `R` in terminal to hot restart

### View Logs:
```powershell
flutter logs
```

## Clearing Data (For Testing)

If you want to start fresh and clear all saved data:

1. **Option 1: Uninstall app**
   - Uninstall from device/emulator
   - Reinstall with `flutter run`

2. **Option 2: Clear app data**
   - Android: Settings → Apps → 1.IDM → Storage → Clear Data

3. **Option 3: Add clear button (temporary):**
   ```dart
   // In dashboard, add a button to clear:
   final prefs = await SharedPreferences.getInstance();
   await prefs.clear();
   ```

## Success Criteria

✅ **Fix is working if:**
1. Guests persist after app restart
2. Check-ins save with room numbers and dates
3. Check-outs save with checkout dates
4. Dashboard stats are accurate
5. All guest data is retained
6. Console shows save/load messages

## Next Steps After Testing

Once you've verified the fix works:
1. Test with real device (not just emulator)
2. Test with more guests (10-20)
3. Test edge cases (special characters in names, etc.)
4. Consider implementing API sync for production
5. Add data export/backup feature
6. Implement data migration if needed

## Need Help?

If you encounter issues:
1. Check the console output
2. Look for error messages
3. Verify SharedPreferences package is installed
4. Check file: `lib/providers/guest_provider.dart`
5. Review: `Docs/DATABASE_FIX.md` for implementation details
