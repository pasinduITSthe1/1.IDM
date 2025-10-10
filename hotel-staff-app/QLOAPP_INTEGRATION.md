# QloApps Integration Guide

## 🔗 Integration Overview

The ITSthe1 Hotel Staff App is now connected to your QloApps backend admin panel. The integration allows:

- **Real-time authentication** with QloApps employee accounts
- **Customer/Guest management** synced with QloApps database
- **Booking management** for check-in/check-out operations
- **Dashboard statistics** from actual hotel data
- **Dual mode operation:** Online (QloApps) and Offline (Demo)

---

## 📁 Files Created for Integration

### Frontend (Mobile App)
```
hotel-staff-app/
├── src/
│   ├── api/
│   │   └── qloAppsClient.js         ✅ API client with all services
│   ├── config/
│   │   └── api.config.js            ✅ API endpoints configuration
│   └── pages/
│       ├── Login.jsx                ✅ Updated with QloApps auth
│       └── Dashboard.jsx            ✅ Updated with real stats
├── .env.development                 ✅ Environment variables
```

### Backend (QloApps)
```
1.IDM/
└── admin134miqa0b/
    └── ajax-mobile-api.php          ✅ Mobile API endpoints
```

---

## 🚀 Setup Instructions

### 1. Backend Setup (QloApps)

The mobile API endpoint is already created at:
```
http://localhost:81/1.IDM/admin134miqa0b/ajax-mobile-api.php
```

**Features:**
- ✅ CORS enabled for mobile app access
- ✅ Employee authentication
- ✅ Customer CRUD operations
- ✅ Order/Booking management
- ✅ Dashboard statistics
- ✅ Token-based security

### 2. Frontend Configuration

Update `.env.development` if your QloApps URL is different:

```env
VITE_API_URL=http://localhost:81/1.IDM
VITE_ADMIN_PATH=/admin134miqa0b
```

### 3. Test the Integration

1. **Start the mobile app:**
   ```bash
   cd hotel-staff-app
   npm run dev
   ```

2. **Access at:** http://localhost:3000

3. **Login with QloApps credentials:**
   - Toggle **"QloApps Mode"** switch
   - Use your admin email: `pasindu.itsthe1@gmail.com`
   - Enter your admin password

---

## 🔐 Authentication

### QloApps Mode (Online)
- Uses real QloApps employee authentication
- Validates credentials against QloApps database
- Generates secure token for API requests
- Auto-logout on token expiration

### Demo Mode (Offline)
- For testing without backend connection
- Uses local storage for data
- Credentials: `staff@hotel.com` / `demo123`

---

## 📊 API Endpoints

### Authentication
```
POST /ajax-mobile-api.php?action=staffLogin
GET  /ajax-mobile-api.php?action=verifyToken
POST /ajax-mobile-api.php?action=staffLogout
```

### Customers (Guests)
```
GET  /ajax-mobile-api.php?controller=AdminCustomers&action=getCustomers
GET  /ajax-mobile-api.php?controller=AdminCustomers&action=getCustomer&id={id}
POST /ajax-mobile-api.php?controller=AdminCustomers&action=addCustomer
POST /ajax-mobile-api.php?controller=AdminCustomers&action=updateCustomer
POST /ajax-mobile-api.php?controller=AdminCustomers&action=deleteCustomer
GET  /ajax-mobile-api.php?controller=AdminCustomers&action=searchCustomers&query={q}
```

### Orders (Bookings)
```
GET  /ajax-mobile-api.php?controller=AdminOrders&action=getOrders
GET  /ajax-mobile-api.php?controller=AdminOrders&action=getOrder&id={id}
POST /ajax-mobile-api.php?controller=AdminOrders&action=createBooking
POST /ajax-mobile-api.php?controller=AdminOrders&action=checkIn
POST /ajax-mobile-api.php?controller=AdminOrders&action=checkOut
```

### Dashboard
```
GET /ajax-mobile-api.php?controller=AdminDashboard&action=getStats
```

---

## 🔄 Data Flow

### Guest Registration Flow
```
Mobile App (Scan Document)
    ↓
Extract data (OCR/MRZ)
    ↓
Guest Registration Form (Auto-filled)
    ↓
API: POST /ajax-mobile-api.php?controller=AdminCustomers&action=addCustomer
    ↓
QloApps Database (Customer + Address tables)
    ↓
Return customer ID
    ↓
Mobile App (Ready for check-in)
```

### Check-In Flow
```
Mobile App (Select Guest)
    ↓
Assign Room + Dates
    ↓
API: POST /ajax-mobile-api.php?controller=AdminOrders&action=checkIn
    ↓
QloApps Database (Create/Update booking)
    ↓
Update room status
    ↓
Mobile App (Confirmation)
```

---

## 🗄️ Database Mapping

### Mobile App → QloApps

| Mobile App Field | QloApps Table | QloApps Field |
|-----------------|---------------|---------------|
| firstName | ps_customer | firstname |
| lastName | ps_customer | lastname |
| email | ps_customer | email |
| phone | ps_address | phone_mobile |
| dateOfBirth | ps_customer | birthday |
| documentNumber | ps_customer | note (custom) |
| address | ps_address | address1 |
| city | ps_address | city |
| postalCode | ps_address | postcode |
| country | ps_address | id_country |

---

## 🧪 Testing the Integration

### Test Authentication
```javascript
// In browser console
localStorage.clear()
// Try logging in with QloApps mode
```

### Test Customer Creation
1. Scan a document (or use manual registration)
2. Fill in guest details
3. Click "Save & Continue"
4. Check QloApps admin → Customers → Manage Customers
5. Verify new customer appears

### Test Dashboard Stats
1. Login to mobile app
2. Check dashboard statistics
3. Compare with QloApps admin dashboard
4. Should show real-time data

---

## 🔧 Troubleshooting

### Issue: CORS Error

**Error:** `Access to XMLHttpRequest has been blocked by CORS policy`

**Solution:**
The PHP endpoint already includes CORS headers, but ensure your Apache/server allows them:

```apache
# In .htaccess or httpd.conf
Header set Access-Control-Allow-Origin "*"
Header set Access-Control-Allow-Methods "GET, POST, PUT, DELETE, OPTIONS"
Header set Access-Control-Allow-Headers "Content-Type, Authorization"
```

### Issue: Authentication Fails

**Error:** `Invalid credentials` or `401 Unauthorized`

**Check:**
1. Verify employee email exists in QloApps
2. Ensure employee account is active
3. Check password is correct
4. Review `ajax-mobile-api.php` error logs

**Debug:**
```php
// Add to ajax-mobile-api.php after line 53
error_log('Login attempt: ' . $email);
error_log('Employee found: ' . ($authentication ? 'Yes' : 'No'));
```

### Issue: Connection Refused

**Error:** `Network error` or `Connection refused`

**Check:**
1. Verify WAMP is running
2. Check URL: `http://localhost:81/1.IDM`
3. Test endpoint directly in browser:
   ```
   http://localhost:81/1.IDM/admin134miqa0b/ajax-mobile-api.php?controller=AdminDashboard&action=getStats
   ```

### Issue: Empty Dashboard Stats

**Error:** Stats show `0` for everything

**Check:**
1. Verify `htl_booking_detail` table exists
2. Check if bookings are created in QloApps
3. Review SQL queries in `ajax-mobile-api.php`

**Fix:** Add test data:
```sql
-- Check existing bookings
SELECT * FROM ps_htl_booking_detail LIMIT 10;
```

---

## 🔐 Security Considerations

### Current Implementation
- ✅ CORS enabled (for development)
- ✅ Token-based authentication
- ✅ SQL injection protection (pSQL)
- ✅ Employee validation

### Production Recommendations
1. **Restrict CORS Origins:**
   ```php
   header('Access-Control-Allow-Origin: https://yourdomain.com');
   ```

2. **Implement JWT Tokens:**
   ```bash
   composer require firebase/php-jwt
   ```

3. **Add Rate Limiting:**
   - Limit login attempts
   - Throttle API requests

4. **Enable HTTPS:**
   - SSL certificate required for production
   - Camera access requires HTTPS

5. **Add API Key Authentication:**
   ```php
   $apiKey = $_SERVER['HTTP_X_API_KEY'] ?? '';
   if ($apiKey !== 'your-secret-key') {
       sendError('Invalid API key', 401);
   }
   ```

---

## 📈 Next Steps

### Immediate
- [x] Test authentication with real QloApps account
- [ ] Create test bookings in QloApps
- [ ] Verify customer creation from mobile app
- [ ] Test check-in/check-out flows

### Phase 2 Enhancements
- [ ] Implement real-time room availability
- [ ] Add payment processing integration
- [ ] Enable email notifications
- [ ] Sync booking modifications
- [ ] Add housekeeping status
- [ ] Implement guest messaging

---

## 🎯 Quick Test Commands

### Test API Directly (Browser/Postman)

**Get Dashboard Stats:**
```
GET http://localhost:81/1.IDM/admin134miqa0b/ajax-mobile-api.php?controller=AdminDashboard&action=getStats
```

**Login:**
```
POST http://localhost:81/1.IDM/admin134miqa0b/ajax-mobile-api.php?action=staffLogin

Body (JSON):
{
  "email": "pasindu.itsthe1@gmail.com",
  "passwd": "your-password"
}
```

**Get Customers:**
```
GET http://localhost:81/1.IDM/admin134miqa0b/ajax-mobile-api.php?controller=AdminCustomers&action=getCustomers

Headers:
Authorization: Bearer {your-token}
```

---

## 📞 Support

### Error Logs
- **PHP Errors:** Check WAMP logs (`c:\wamp64\logs\php_error.log`)
- **Apache Errors:** Check Apache error log
- **Browser Console:** Check for JavaScript errors

### Database Queries
```sql
-- Check customers created via mobile app
SELECT * FROM ps_customer ORDER BY date_add DESC LIMIT 10;

-- Check recent bookings
SELECT * FROM ps_htl_booking_detail 
ORDER BY date_add DESC LIMIT 10;

-- Check today's check-ins
SELECT * FROM ps_htl_booking_detail 
WHERE DATE(date_from) = CURDATE();
```

---

## ✅ Integration Checklist

- [x] API endpoint created (`ajax-mobile-api.php`)
- [x] CORS enabled for mobile access
- [x] Authentication implemented
- [x] Customer management endpoints
- [x] Booking management endpoints
- [x] Dashboard statistics endpoint
- [x] Frontend API client configured
- [x] Login page updated with dual mode
- [x] Dashboard updated with real stats
- [x] Environment variables configured
- [ ] **Test with real QloApps account** ← YOU ARE HERE
- [ ] Verify customer creation
- [ ] Test booking workflows
- [ ] Deploy to production server

---

**Integration Status:** ✅ **READY FOR TESTING**

**Next Action:** Login to the mobile app with QloApps mode and test customer creation!

---

**Last Updated:** October 8, 2025  
**Integration Version:** 1.0  
**Compatible with:** QloApps 1.6.x / PrestaShop 1.6.x
