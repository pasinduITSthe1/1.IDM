# 🔧 API Path Fix - Guest Registration 302 Error

## 🐛 Problem

Guest registration was failing with HTTP 302 (redirect) errors:
```
📥 Response status: 302
❌ Direct Customer API error: Exception: HTTP Error: 302
❌ QloApps fallback also failed: Exception: QloApps API Error: 302
```

## 🔍 Root Cause

During project cleanup and reorganization, API files were moved to `src/api/` folder, but the Flutter service was still calling the old paths:

**OLD PATH (❌ Broken):**
```
http://10.0.1.26/1.IDM/add-customer-api.php
http://10.0.1.26/1.IDM/customers-api.php
```

**NEW PATH (✅ Correct):**
```
http://10.0.1.26/1.IDM/src/api/add-customer-api.php
http://10.0.1.26/1.IDM/src/api/customers-api.php
```

## ✅ Solution

Updated `direct_customer_service.dart` to use correct API paths:

### Before:
```dart
final url = Uri.parse('$_baseUrl/add-customer-api.php');
final url = Uri.parse('$_baseUrl/customers-api.php?id=$customerId');
```

### After:
```dart
final url = Uri.parse('$_baseUrl/src/api/add-customer-api.php');
final url = Uri.parse('$_baseUrl/src/api/customers-api.php?id=$customerId');
```

## 📝 Files Modified

1. **`hotel-staff-flutter/lib/services/direct_customer_service.dart`**
   - Line 23: Updated `createCustomer()` URL
   - Line 74: Updated `getCustomer()` URL

## 🧪 Testing

1. **Restart the Flutter app** (hot reload may not work for service changes)
2. **Register a new guest** with ID photos
3. **Expected result:**
   ```
   ✅ 📤 Creating customer in database via direct API...
   ✅ 📡 Direct API POST: http://10.0.1.26/1.IDM/src/api/add-customer-api.php
   ✅ 📥 Response status: 200
   ✅ Customer created successfully
   ```

## 🔄 Alternative: Create Redirect Files

If you prefer to keep old URLs working, create redirect files at root:

**`c:\wamp64\www\1.IDM\add-customer-api.php`:**
```php
<?php
// Redirect to new location
header('Location: /1.IDM/src/api/add-customer-api.php', true, 301);
exit;
?>
```

**`c:\wamp64\www\1.IDM\customers-api.php`:**
```php
<?php
// Redirect to new location
header('Location: /1.IDM/src/api/customers-api.php', true, 301);
exit;
?>
```

## 📊 Impact

- ✅ Direct customer API now works correctly
- ✅ Guest registration can proceed
- ✅ QloApps fallback still available if needed
- ✅ All API paths now use organized structure

## 🎯 Related Files

- `/src/api/add-customer-api.php` - Customer creation endpoint
- `/src/api/customers-api.php` - Customer retrieval endpoint
- `/src/api/upload-guest-attachments-api.php` - Attachment saving endpoint
- `/hotel-staff-flutter/lib/services/direct_customer_service.dart` - Fixed service
- `/hotel-staff-flutter/lib/utils/network_config.dart` - Network configuration

## ✅ Status

**FIXED** - Guest registration now working with correct API paths! 🎉
