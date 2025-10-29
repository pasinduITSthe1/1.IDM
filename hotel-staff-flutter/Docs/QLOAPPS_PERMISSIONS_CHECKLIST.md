# 🎯 QloApps API Permissions - Quick Checklist

## Print this and check off as you configure!

---

## ✅ CRITICAL RESOURCES (App won't work without these)

### 1. customers
- [ ] View (GET) ✅
- [ ] Add (POST) ✅
- [ ] Modify (PUT) ✅
- [ ] Delete (DELETE) ❌ LEAVE UNCHECKED
- [ ] Fast view (HEAD) ✅

### 2. addresses
- [ ] View (GET) ✅
- [ ] Add (POST) ✅
- [ ] Modify (PUT) ✅
- [ ] Delete (DELETE) ❌ LEAVE UNCHECKED
- [ ] Fast view (HEAD) ✅

### 3. bookings
- [ ] View (GET) ✅
- [ ] Add (POST) ❌ LEAVE UNCHECKED
- [ ] Modify (PUT) ✅
- [ ] Delete (DELETE) ❌ LEAVE UNCHECKED
- [ ] Fast view (HEAD) ✅

### 4. hotels
- [ ] View (GET) ✅
- [ ] Add (POST) ❌ LEAVE UNCHECKED
- [ ] Modify (PUT) ❌ LEAVE UNCHECKED
- [ ] Delete (DELETE) ❌ LEAVE UNCHECKED
- [ ] Fast view (HEAD) ✅

### 5. hotel_rooms
- [ ] View (GET) ✅
- [ ] Add (POST) ❌ LEAVE UNCHECKED
- [ ] Modify (PUT) ✅
- [ ] Delete (DELETE) ❌ LEAVE UNCHECKED
- [ ] Fast view (HEAD) ✅

### 6. hotel_room_types
- [ ] View (GET) ✅
- [ ] Add (POST) ❌ LEAVE UNCHECKED
- [ ] Modify (PUT) ❌ LEAVE UNCHECKED
- [ ] Delete (DELETE) ❌ LEAVE UNCHECKED
- [ ] Fast view (HEAD) ✅

### 7. orders
- [ ] View (GET) ✅
- [ ] Add (POST) ❌ LEAVE UNCHECKED
- [ ] Modify (PUT) ✅
- [ ] Delete (DELETE) ❌ LEAVE UNCHECKED
- [ ] Fast view (HEAD) ✅

---

## 🟡 RECOMMENDED RESOURCES (For full functionality)

### 8. images
- [ ] View (GET) ✅
- [ ] Add (POST) ✅
- [ ] Modify (PUT) ❌ LEAVE UNCHECKED
- [ ] Delete (DELETE) ❌ LEAVE UNCHECKED
- [ ] Fast view (HEAD) ✅

### 9. order_details
- [ ] View (GET) ✅
- [ ] Add (POST) ❌ LEAVE UNCHECKED
- [ ] Modify (PUT) ❌ LEAVE UNCHECKED
- [ ] Delete (DELETE) ❌ LEAVE UNCHECKED
- [ ] Fast view (HEAD) ✅

### 10. order_payments
- [ ] View (GET) ✅
- [ ] Add (POST) ✅
- [ ] Modify (PUT) ❌ LEAVE UNCHECKED
- [ ] Delete (DELETE) ❌ LEAVE UNCHECKED
- [ ] Fast view (HEAD) ✅

### 11. room_bookings
- [ ] View (GET) ✅
- [ ] Add (POST) ❌ LEAVE UNCHECKED
- [ ] Modify (PUT) ✅
- [ ] Delete (DELETE) ❌ LEAVE UNCHECKED
- [ ] Fast view (HEAD) ✅

### 12. customer_messages
- [ ] View (GET) ✅
- [ ] Add (POST) ✅
- [ ] Modify (PUT) ❌ LEAVE UNCHECKED
- [ ] Delete (DELETE) ❌ LEAVE UNCHECKED
- [ ] Fast view (HEAD) ✅

### 13. employees
- [ ] View (GET) ✅
- [ ] Add (POST) ❌ LEAVE UNCHECKED
- [ ] Modify (PUT) ❌ LEAVE UNCHECKED
- [ ] Delete (DELETE) ❌ LEAVE UNCHECKED
- [ ] Fast view (HEAD) ✅

---

## 🟢 OPTIONAL RESOURCES (For future features)

### 14. extra_demands
- [ ] View (GET) ✅
- [ ] Add (POST) ✅
- [ ] Modify (PUT) ❌ LEAVE UNCHECKED
- [ ] Delete (DELETE) ❌ LEAVE UNCHECKED
- [ ] Fast view (HEAD) ✅

### 15. hotel_features
- [ ] View (GET) ✅
- [ ] Add (POST) ❌ LEAVE UNCHECKED
- [ ] Modify (PUT) ❌ LEAVE UNCHECKED
- [ ] Delete (DELETE) ❌ LEAVE UNCHECKED
- [ ] Fast view (HEAD) ✅

### 16. services
- [ ] View (GET) ✅
- [ ] Add (POST) ❌ LEAVE UNCHECKED
- [ ] Modify (PUT) ❌ LEAVE UNCHECKED
- [ ] Delete (DELETE) ❌ LEAVE UNCHECKED
- [ ] Fast view (HEAD) ✅

---

## 📝 After Setup Checklist

- [ ] API Key generated
- [ ] Description set to "Hotel Staff Mobile App"
- [ ] Status set to "Enabled"
- [ ] All 16 resources configured with correct permissions
- [ ] API Key copied to clipboard
- [ ] API Key pasted into Flutter app (lib/services/qloapps_api_service.dart line 18)
- [ ] App restarted
- [ ] QloApps API Test screen shows all green checkmarks
- [ ] Test guest registration works end-to-end

---

## 🚨 IMPORTANT SECURITY NOTES

### ❌ NEVER CHECK THESE:
- Any "Delete (DELETE)" checkbox
- "All" checkbox at the top
- Resources not listed above

### ⚠️ REMEMBER:
- Use HTTPS in production
- Create separate API keys for testing and production
- Keep API key secret (don't commit to Git)
- Regular audit of API access logs

---

## 📊 Permission Count Summary

Total resources to enable: **16**

- Critical: **7 resources** (customers, addresses, bookings, hotels, hotel_rooms, hotel_room_types, orders)
- Recommended: **6 resources** (images, order_details, order_payments, room_bookings, customer_messages, employees)
- Optional: **3 resources** (extra_demands, hotel_features, services)

---

## 🎯 Quick Summary

**What to enable:**
- ✅ GET (View) for all 16 resources
- ✅ POST (Add) for: customers, addresses, images, order_payments, customer_messages, extra_demands
- ✅ PUT (Modify) for: customers, addresses, bookings, hotel_rooms, orders, room_bookings
- ✅ HEAD (Fast view) for all 16 resources
- ❌ DELETE for NONE (security)

**Total checkboxes to check: 56 out of 80 possible**

---

_Print this page and keep it next to your computer while configuring!_  
_Last Updated: October 27, 2025_
