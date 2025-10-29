# 🎨 QloApps API Setup - Visual Step-by-Step Guide

## 📸 Follow these exact steps with screenshots descriptions

---

## Step 1: Access Admin Panel

```
┌─────────────────────────────────────────────────────┐
│  🌐 Browser Address Bar                             │
│  http://localhost/1.IDM/admin134miqa0b/             │
└─────────────────────────────────────────────────────┘

Enter your QloApps admin credentials:
- Email: your-admin@email.com
- Password: ••••••••
```

---

## Step 2: Navigate to WebService Settings

```
┌─────────────────────────────────────────────────────┐
│  QloApps Admin Dashboard                            │
│                                                      │
│  Click on the menu:                                 │
│  Advanced Parameters > Webservice                   │
│                                                      │
│  You should see:                                    │
│  ┌───────────────────────────────────────────┐     │
│  │ Enable webservice: [NO] [YES]              │     │
│  │ Enable CGI mode: [NO] [YES]                │     │
│  └───────────────────────────────────────────┘     │
└─────────────────────────────────────────────────────┘

⚠️ Make sure "Enable webservice" is set to YES
```

---

## Step 3: Add New WebService Key

```
┌─────────────────────────────────────────────────────┐
│  WebService Keys List                               │
│                                                      │
│  ┌────────────────────────────────────────────┐    │
│  │  [+ Add new webservice key]                 │    │
│  └────────────────────────────────────────────┘    │
│                                                      │
│  Click this button ↑                               │
└─────────────────────────────────────────────────────┘
```

---

## Step 4: Generate API Key

```
┌─────────────────────────────────────────────────────┐
│  Add/Edit Webservice Key                            │
│                                                      │
│  Key: [                              ] [Generate!]  │
│       ↑ Click "Generate!" button                   │
│                                                      │
│  Result: 32 character key appears:                  │
│  AB12CD34EF56GH78IJ90KL12MN34OP56                  │
│                                                      │
│  Description: [Hotel Staff Mobile App        ]     │
│               ↑ Type this                          │
│                                                      │
│  Status: ( ) Disabled  (•) Enabled                 │
│          ↑ Select "Enabled"                        │
└─────────────────────────────────────────────────────┘

💡 TIP: Right-click the key and "Copy" it immediately!
```

---

## Step 5: Set Permissions (THE CRITICAL PART!)

```
┌─────────────────────────────────────────────────────────────────────┐
│  Permissions                                                         │
│                                                                      │
│  Resource            All  View  Modify  Add  Delete  Fast View      │
│  ─────────────────────────────────────────────────────────────────  │
│                                                                      │
│  ⚠️ DO NOT CHECK "All" - It gives too many permissions!            │
│                                                                      │
│  Scroll down and CHECK THESE BOXES:                                │
│                                                                      │
│  addresses           [ ]  [✓]   [✓]    [✓]  [ ]     [✓]            │
│  bookings            [ ]  [✓]   [✓]    [ ]  [ ]     [✓]            │
│  customer_messages   [ ]  [✓]   [ ]    [✓]  [ ]     [✓]            │
│  customers           [ ]  [✓]   [✓]    [✓]  [ ]     [✓]            │
│  employees           [ ]  [✓]   [ ]    [ ]  [ ]     [✓]            │
│  extra_demands       [ ]  [✓]   [ ]    [✓]  [ ]     [✓]            │
│  hotel_features      [ ]  [✓]   [ ]    [ ]  [ ]     [✓]            │
│  hotel_room_types    [ ]  [✓]   [ ]    [ ]  [ ]     [✓]            │
│  hotel_rooms         [ ]  [✓]   [✓]    [ ]  [ ]     [✓]            │
│  hotels              [ ]  [✓]   [ ]    [ ]  [ ]     [✓]            │
│  images              [ ]  [✓]   [ ]    [✓]  [ ]     [✓]            │
│  order_details       [ ]  [✓]   [ ]    [ ]  [ ]     [✓]            │
│  order_payments      [ ]  [✓]   [ ]    [✓]  [ ]     [✓]            │
│  orders              [ ]  [✓]   [✓]    [ ]  [ ]     [✓]            │
│  room_bookings       [ ]  [✓]   [✓]    [ ]  [ ]     [✓]            │
│  services            [ ]  [✓]   [ ]    [ ]  [ ]     [✓]            │
│                                                                      │
│  ⚠️ LEAVE ALL OTHER RESOURCES UNCHECKED!                           │
│  ⚠️ NEVER CHECK "Delete" FOR ANY RESOURCE!                         │
│                                                                      │
│  [Save]  [Cancel]                                                   │
│   ↑ Click Save when done                                           │
└─────────────────────────────────────────────────────────────────────┘

📋 Print the QLOAPPS_PERMISSIONS_CHECKLIST.md and check boxes as you go!
```

---

## Step 6: Verify API Key Creation

```
┌─────────────────────────────────────────────────────┐
│  WebService Keys List                               │
│                                                      │
│  Key          Description              Status       │
│  ──────────── ──────────────────────── ────────     │
│  AB12CD34...  Hotel Staff Mobile App   ✅ Enabled   │
│                                                      │
│  ✅ You should see your key listed here            │
└─────────────────────────────────────────────────────┘
```

---

## Step 7: Update Flutter App

Open your code editor (VS Code):

```dart
// File: lib/services/qloapps_api_service.dart
// Find line 18:

static const String apiKey = 'YOUR_QLOAPPS_API_KEY_HERE';

// Replace with:

static const String apiKey = 'AB12CD34EF56GH78IJ90KL12MN34OP56';
//                            ↑ Your actual API key
```

**Save the file!** (Ctrl+S or Cmd+S)

---

## Step 8: Restart Flutter App

```bash
# Stop the app (if running)
Ctrl+C in terminal

# Or in VS Code, click the red stop button

# Start again
flutter run
```

---

## Step 9: Test API Connection

```
┌─────────────────────────────────────────────────────┐
│  📱 Hotel Staff App                                 │
│                                                      │
│  Navigate to:                                       │
│  Dashboard > More > QloApps API Test                │
│                                                      │
│  You should see:                                    │
│  ┌────────────────────────────────────────────┐    │
│  │ QloApps API Connection Test                 │    │
│  │                                              │    │
│  │ [Test Get Customers]                         │    │
│  │ [Test Get Hotels]                            │    │
│  │ [Test Get Products]                          │    │
│  │ [Test Create Customer]                       │    │
│  │ [Test Get Orders]                            │    │
│  │ [Test Get Bookings]                          │    │
│  └────────────────────────────────────────────┘    │
│                                                      │
│  Click each button - all should show:              │
│  ✅ Success!                                        │
└─────────────────────────────────────────────────────┘
```

---

## Step 10: Test Full Workflow

```
┌─────────────────────────────────────────────────────┐
│  Complete Guest Registration Flow                   │
│                                                      │
│  1. Dashboard > [New Guest]                         │
│     ↓                                               │
│  2. MRZ Scanner > Scan passport                     │
│     ↓                                               │
│  3. Auto-filled form appears                        │
│     ↓                                               │
│  4. [Capture ID Photos]                             │
│     ↓                                               │
│  5. Front photo > Back photo                        │
│     ↓                                               │
│  6. Preview > [Continue]                            │
│     ↓                                               │
│  7. [Submit Registration]                           │
│     ↓                                               │
│  8. ✅ Success! Guest created in QloApps           │
└─────────────────────────────────────────────────────┘

Verify in QloApps Admin:
Customers > Search for the guest name
You should see the newly created customer!
```

---

## 🎨 Visual Permission Matrix

```
Resource          GET  POST  PUT  DELETE  HEAD
                  👁️   ➕    ✏️    🗑️     ⚡
──────────────────────────────────────────────
addresses          ✅   ✅    ✅    ❌     ✅
bookings           ✅   ❌    ✅    ❌     ✅
customer_messages  ✅   ✅    ❌    ❌     ✅
customers          ✅   ✅    ✅    ❌     ✅
employees          ✅   ❌    ❌    ❌     ✅
extra_demands      ✅   ✅    ❌    ❌     ✅
hotel_features     ✅   ❌    ❌    ❌     ✅
hotel_room_types   ✅   ❌    ❌    ❌     ✅
hotel_rooms        ✅   ❌    ✅    ❌     ✅
hotels             ✅   ❌    ❌    ❌     ✅
images             ✅   ✅    ❌    ❌     ✅
order_details      ✅   ❌    ❌    ❌     ✅
order_payments     ✅   ✅    ❌    ❌     ✅
orders             ✅   ❌    ✅    ❌     ✅
room_bookings      ✅   ❌    ✅    ❌     ✅
services           ✅   ❌    ❌    ❌     ✅

Legend:
👁️ GET     = View/Read data
➕ POST    = Create new records
✏️ PUT     = Update existing records
🗑️ DELETE  = Delete records (NEVER enable!)
⚡ HEAD    = Quick check (performance)
```

---

## 🚨 Common Mistakes to Avoid

```
❌ WRONG: Checking "All" checkbox
✅ RIGHT: Manually check only required resources

❌ WRONG: Enabling DELETE permissions
✅ RIGHT: Leave all DELETE unchecked

❌ WRONG: Forgetting to enable HEAD
✅ RIGHT: Always enable HEAD with GET

❌ WRONG: Copy-pasting API key with spaces
✅ RIGHT: Trim whitespace before pasting

❌ WRONG: Using HTTP in production
✅ RIGHT: Always use HTTPS in production
```

---

## 🎯 Quick Troubleshooting

### Problem: "Unauthorized" error
```
Check:
1. API key copied correctly (no spaces)
2. API key pasted in correct location (line 18)
3. App restarted after updating key
4. WebService is enabled in QloApps
```

### Problem: "Forbidden" error
```
Check:
1. Correct permissions enabled for that resource
2. Correct HTTP method enabled (GET/POST/PUT)
3. Status is "Enabled" for the API key
```

### Problem: "No data returned"
```
Check:
1. Data exists in QloApps (create test customer)
2. Network connection between app and server
3. QloApps server is running
4. URL is correct (http://localhost/1.IDM/api)
```

---

## 📊 Setup Time Estimate

```
┌─────────────────────────────────────────┐
│ Task                          Time      │
├─────────────────────────────────────────┤
│ Access admin panel            1 min    │
│ Navigate to webservice        1 min    │
│ Generate API key              2 min    │
│ Set permissions (16 resources) 5 min   │
│ Update Flutter app            2 min    │
│ Test connection               3 min    │
│ Verify full workflow          5 min    │
├─────────────────────────────────────────┤
│ TOTAL                         ~19 min   │
└─────────────────────────────────────────┘

💡 First time: 20-30 minutes (learning)
⚡ Second time: 10-15 minutes (experienced)
```

---

## ✅ Final Checklist

Before considering setup complete:

```
□ WebService enabled in QloApps
□ API key generated (32 characters)
□ Description set to "Hotel Staff Mobile App"
□ Status set to "Enabled"
□ 16 resources configured with correct permissions
□ No "Delete" permissions enabled
□ API key copied to Flutter app (line 18)
□ No whitespace in API key
□ App restarted
□ Test screen shows all ✅ green
□ Created test guest successfully
□ Guest appears in QloApps admin
□ Full workflow tested: Scan → Capture → Register
□ Documentation saved for future reference
```

---

## 🎉 Success Indicators

You'll know it's working when:

1. **QloApps Test Screen:**
   - All buttons show ✅ Success
   - Response data is displayed
   - No error messages

2. **Guest Registration:**
   - Form auto-fills from scanned data
   - Photos upload without errors
   - Success message appears
   - Guest shows in QloApps admin

3. **Performance:**
   - API calls complete in < 2 seconds
   - No timeout errors
   - Smooth user experience

---

_Follow these steps exactly and you'll have a working QloApps integration in under 30 minutes!_

_Last Updated: October 27, 2025_
