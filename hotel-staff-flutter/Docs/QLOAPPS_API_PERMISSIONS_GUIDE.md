# 🔐 QloApps WebService API Permissions Guide

## Overview
This guide shows you **exactly which QloApps API resources** to enable for the Hotel Staff App to work properly.

---

## 🎯 Quick Answer - Essential Permissions

For your hotel staff app, you need to grant permissions to **16 core resources**:

### ✅ MUST HAVE (Critical - App won't work without these)

| Resource | View (GET) | Add (POST) | Modify (PUT) | Delete (DELETE) | Fast View (HEAD) | Why Needed |
|----------|------------|------------|--------------|-----------------|------------------|------------|
| **customers** | ✅ | ✅ | ✅ | ❌ | ✅ | Create guests from scanned documents |
| **addresses** | ✅ | ✅ | ✅ | ❌ | ✅ | Store guest addresses |
| **bookings** | ✅ | ❌ | ✅ | ❌ | ✅ | View and update booking status |
| **hotels** | ✅ | ❌ | ❌ | ❌ | ✅ | Get hotel information |
| **hotel_rooms** | ✅ | ❌ | ✅ | ❌ | ✅ | View room availability |
| **hotel_room_types** | ✅ | ❌ | ❌ | ❌ | ✅ | Get room type details |
| **orders** | ✅ | ❌ | ✅ | ❌ | ✅ | Process check-in/check-out |

### 🟡 RECOMMENDED (Enhanced functionality)

| Resource | View (GET) | Add (POST) | Modify (PUT) | Delete (DELETE) | Fast View (HEAD) | Why Needed |
|----------|------------|------------|--------------|-----------------|------------------|------------|
| **images** | ✅ | ✅ | ❌ | ❌ | ✅ | Upload guest ID photos |
| **order_details** | ✅ | ❌ | ❌ | ❌ | ✅ | View booking details |
| **order_payments** | ✅ | ✅ | ❌ | ❌ | ✅ | Process payments |
| **room_bookings** | ✅ | ❌ | ✅ | ❌ | ✅ | Manage room assignments |
| **customer_messages** | ✅ | ✅ | ❌ | ❌ | ✅ | Guest communication |
| **employees** | ✅ | ❌ | ❌ | ❌ | ✅ | Staff authentication |

### 🟢 OPTIONAL (Future features)

| Resource | View (GET) | Add (POST) | Modify (PUT) | Delete (DELETE) | Fast View (HEAD) | Why Needed |
|----------|------------|------------|--------------|-----------------|------------------|------------|
| **extra_demands** | ✅ | ✅ | ❌ | ❌ | ✅ | Additional services |
| **hotel_features** | ✅ | ❌ | ❌ | ❌ | ✅ | Room amenities |
| **services** | ✅ | ❌ | ❌ | ❌ | ✅ | Hotel services |

---

## 📋 Step-by-Step Setup Instructions

### Step 1: Access QloApps Admin Panel
```
1. Go to: http://localhost/1.IDM/admin134miqa0b/
2. Login with your admin credentials
3. Navigate to: Advanced Parameters > Webservice
```

### Step 2: Enable WebService
```
1. Click "Yes" to enable webservice
2. Click "Save"
```

### Step 3: Generate API Key
```
1. Click "Add new" webservice key
2. Fill in the form:
   - Key: Click "Generate!" button (or manually enter)
   - Description: "Hotel Staff Mobile App"
   - Status: ✅ Enabled
```

### Step 4: Set Permissions (THE IMPORTANT PART!)

**Copy this checklist and follow it exactly:**

#### ✅ CRITICAL RESOURCES (Check all boxes)

**customers**
- [x] View (GET)
- [x] Add (POST)
- [x] Modify (PUT)
- [ ] Delete (DELETE) - ❌ Don't enable for security
- [x] Fast view (HEAD)

**addresses**
- [x] View (GET)
- [x] Add (POST)
- [x] Modify (PUT)
- [ ] Delete (DELETE)
- [x] Fast view (HEAD)

**bookings**
- [x] View (GET)
- [ ] Add (POST) - Created via orders
- [x] Modify (PUT)
- [ ] Delete (DELETE)
- [x] Fast view (HEAD)

**hotels**
- [x] View (GET)
- [ ] Add (POST) - Read-only
- [ ] Modify (PUT) - Read-only
- [ ] Delete (DELETE)
- [x] Fast view (HEAD)

**hotel_rooms**
- [x] View (GET)
- [ ] Add (POST) - Managed in admin
- [x] Modify (PUT) - Update status
- [ ] Delete (DELETE)
- [x] Fast view (HEAD)

**hotel_room_types**
- [x] View (GET)
- [ ] Add (POST) - Read-only
- [ ] Modify (PUT) - Read-only
- [ ] Delete (DELETE)
- [x] Fast view (HEAD)

**orders**
- [x] View (GET)
- [ ] Add (POST) - Created via bookings
- [x] Modify (PUT)
- [ ] Delete (DELETE)
- [x] Fast view (HEAD)

#### 🟡 RECOMMENDED RESOURCES

**images**
- [x] View (GET)
- [x] Add (POST)
- [ ] Modify (PUT)
- [ ] Delete (DELETE)
- [x] Fast view (HEAD)

**order_details**
- [x] View (GET)
- [ ] Add (POST)
- [ ] Modify (PUT)
- [ ] Delete (DELETE)
- [x] Fast view (HEAD)

**order_payments**
- [x] View (GET)
- [x] Add (POST)
- [ ] Modify (PUT)
- [ ] Delete (DELETE)
- [x] Fast view (HEAD)

**room_bookings**
- [x] View (GET)
- [ ] Add (POST)
- [x] Modify (PUT)
- [ ] Delete (DELETE)
- [x] Fast view (HEAD)

**customer_messages**
- [x] View (GET)
- [x] Add (POST)
- [ ] Modify (PUT)
- [ ] Delete (DELETE)
- [x] Fast view (HEAD)

**employees**
- [x] View (GET)
- [ ] Add (POST)
- [ ] Modify (PUT)
- [ ] Delete (DELETE)
- [x] Fast view (HEAD)

#### 🟢 OPTIONAL RESOURCES (For future features)

**extra_demands**
- [x] View (GET)
- [x] Add (POST)
- [ ] Modify (PUT)
- [ ] Delete (DELETE)
- [x] Fast view (HEAD)

**hotel_features**
- [x] View (GET)
- [ ] Add (POST)
- [ ] Modify (PUT)
- [ ] Delete (DELETE)
- [x] Fast view (HEAD)

**services**
- [x] View (GET)
- [ ] Add (POST)
- [ ] Modify (PUT)
- [ ] Delete (DELETE)
- [x] Fast view (HEAD)

### Step 5: Save API Key
```
1. Click "Save" at the bottom
2. Copy the generated API key
```

### Step 6: Update Flutter App
```dart
// File: lib/services/qloapps_api_service.dart
// Line 18: Replace with your API key

static const String apiKey = 'YOUR_COPIED_API_KEY_HERE';
```

---

## 🚫 Resources You Should NOT Enable

**For security reasons, DO NOT enable DELETE permissions or these resources:**

❌ **cart_rules** - Not needed (admin only)  
❌ **configurations** - Security risk  
❌ **employees** (DELETE) - Security risk  
❌ **price_ranges** - Not needed  
❌ **stock_movements** - Not needed  
❌ **supply_orders** - Not needed  
❌ **warehouses** - Not needed  
❌ **tax_rules** - Not needed  

---

## 🔒 Security Best Practices

### 1. **Minimal Permissions**
Only enable what you need. Start with the MUST HAVE list, test, then add more if needed.

### 2. **No DELETE Permissions**
Never enable DELETE for any resource. If you need to "delete" something, use PUT to set status to inactive.

### 3. **Separate API Keys**
Create different API keys for:
- Mobile app (limited permissions)
- Admin panel (full permissions)
- Testing (temporary key)

### 4. **IP Restrictions (Optional)**
In production, restrict API access to specific IPs or domains.

### 5. **HTTPS Only**
Always use HTTPS in production:
```dart
static const String baseUrl = 'https://yourdomain.com/api';
```

---

## 🧪 Testing Your Setup

After configuring permissions, test with this screen:

```bash
# In your Flutter project
# Run the app and navigate to:
More > QloApps API Test
```

Or use the test screen directly:
```dart
Navigator.pushNamed(context, '/qloapps-test');
```

### Expected Results:
✅ Test Customers: Should load  
✅ Test Hotels: Should load  
✅ Create Customer: Should succeed  
✅ Get Orders: Should load  

---

## 📊 Permission Summary Table

| Category | Resources | GET | POST | PUT | DELETE | HEAD |
|----------|-----------|-----|------|-----|--------|------|
| **Guests** | customers, addresses | ✅ | ✅ | ✅ | ❌ | ✅ |
| **Bookings** | bookings, orders, room_bookings | ✅ | ❌ | ✅ | ❌ | ✅ |
| **Hotels** | hotels, hotel_rooms, hotel_room_types | ✅ | ❌ | ❌/✅ | ❌ | ✅ |
| **Media** | images | ✅ | ✅ | ❌ | ❌ | ✅ |
| **Payments** | order_payments | ✅ | ✅ | ❌ | ❌ | ✅ |
| **Communication** | customer_messages | ✅ | ✅ | ❌ | ❌ | ✅ |
| **Staff** | employees | ✅ | ❌ | ❌ | ❌ | ✅ |
| **Optional** | extra_demands, hotel_features, services | ✅ | ✅/❌ | ❌ | ❌ | ✅ |

---

## 🎯 Quick Copy-Paste Checklist

**Print this and check off as you enable each resource:**

```
CRITICAL (Must enable):
□ customers (GET, POST, PUT, HEAD)
□ addresses (GET, POST, PUT, HEAD)
□ bookings (GET, PUT, HEAD)
□ hotels (GET, HEAD)
□ hotel_rooms (GET, PUT, HEAD)
□ hotel_room_types (GET, HEAD)
□ orders (GET, PUT, HEAD)

RECOMMENDED (Should enable):
□ images (GET, POST, HEAD)
□ order_details (GET, HEAD)
□ order_payments (GET, POST, HEAD)
□ room_bookings (GET, PUT, HEAD)
□ customer_messages (GET, POST, HEAD)
□ employees (GET, HEAD)

OPTIONAL (Nice to have):
□ extra_demands (GET, POST, HEAD)
□ hotel_features (GET, HEAD)
□ services (GET, HEAD)

VERIFY:
□ API key copied to Flutter app
□ API test screen shows success
□ Guest registration creates customer
□ Full workflow: Scan → Capture → Register → Success
```

---

## 🐛 Troubleshooting

### Error: "Unauthorized" or 401
**Solution:** Check API key is correct in `qloapps_api_service.dart`

### Error: "Forbidden" or 403
**Solution:** Enable the required permission for that resource

### Error: "Method not allowed"
**Solution:** Enable the HTTP method (GET/POST/PUT) for that resource

### Error: "Resource not found"
**Solution:** Check resource name spelling (e.g., `customers` not `customer`)

### No data returned
**Solution:** Verify there's data in QloApps admin (create test booking/customer)

---

## 📱 App Features → API Mapping

| App Feature | Required Resources |
|-------------|-------------------|
| **Guest Registration** | customers, addresses |
| **Check-In** | bookings, orders, hotel_rooms |
| **Check-Out** | orders, order_payments |
| **Guest List** | customers, bookings |
| **Room Status** | hotel_rooms, room_bookings |
| **Upload ID Photos** | images, customers |
| **View Booking Details** | orders, order_details, bookings |
| **Staff Login** | employees |

---

## ✅ Final Verification

After setup, verify everything works:

1. **Open QloApps API Test Screen** in the app
2. **Click each test button** - all should show ✅
3. **Try complete flow:**
   - Scan document → Capture photos → Register guest
   - Check if customer appears in QloApps admin
4. **Check API logs** in browser developer tools
5. **Test on real device** (not just emulator)

---

## 📞 Need Help?

If you're stuck, check:
1. API key is correctly copied (no extra spaces)
2. WebService is enabled in QloApps
3. Permissions are checked correctly
4. QloApps is running (http://localhost/1.IDM/api should respond)
5. Network connectivity between app and QloApps server

---

_Last Updated: October 27, 2025_  
_Compatible with: QloApps 1.5+ and Hotel Staff App v1.0.0_
