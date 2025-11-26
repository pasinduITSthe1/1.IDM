# Connection Troubleshooting Guide

## ❌ **Error: Connection Refused**

**Symptoms:**
```
SocketException: Connection refused (OS Error: Connection refused, errno = 111)
address = 10.0.1.24, port = 53016
uri=http://10.0.1.24/1.IDM/api/customers?output_format=JSON
```

## 🔍 **Root Causes & Solutions**

### **1. WAMP Server Not Running**

**Check:**
- Look for WAMP icon in system tray (bottom-right of Windows taskbar)
- Icon should be **GREEN** (all services running)
- **ORANGE** = some services not running
- **RED** = all services stopped

**Fix:**
```
1. Click WAMP icon in system tray
2. Click "Start All Services"
3. Wait until icon turns GREEN
4. Verify Apache is running (should show port 80)
5. Verify MySQL is running (should show port 3306)
```

---

### **2. Apache Not Started**

**Check:**
```
1. Click WAMP icon
2. Click "Apache" → "Service"
3. Should say "Stop Service" (means it's running)
```

**Fix if not running:**
```
1. Click WAMP icon
2. Click "Apache" → "Service" → "Start/Resume Service"
3. Wait 5-10 seconds
4. Check WAMP icon turns green
```

---

### **3. Wrong IP Address**

**Current IP in app:** `10.0.1.24`

**Verify your computer's actual IP:**

```powershell
# Run this in PowerShell:
ipconfig

# Look for:
# Wireless LAN adapter Wi-Fi:
#   IPv4 Address. . . . . . . . . . . : 10.0.1.XX
```

**If IP is different (e.g., `10.0.1.30`):**

Update in `qloapps_api_service.dart`:
```dart
// Line 18
static const String baseUrl = 'http://10.0.1.30/1.IDM/api';
```

---

### **4. Firewall Blocking Connection**

**Windows Firewall may block incoming connections.**

**Fix:**
```
1. Press Win + R
2. Type: firewall.cpl
3. Click "Allow an app through firewall"
4. Find "Apache HTTP Server" or "httpd.exe"
5. Check BOTH "Private" and "Public"
6. Click OK
```

---

### **5. Device Not on Same WiFi**

**Both computer and phone MUST be on same network.**

**Check on phone:**
```
Settings → WiFi → Connected Network
Should match computer's WiFi name
```

**Check on computer:**
```
Settings → Network → WiFi
Note the network name
```

---

### **6. Port 80 Being Used by Another Program**

**Check what's using port 80:**

```powershell
netstat -ano | findstr :80
```

**If another program is using port 80:**
```
1. Stop that program
2. Or change WAMP Apache port:
   - Click WAMP icon
   - Apache → httpd.conf
   - Find "Listen 80"
   - Change to "Listen 8080"
   - Save and restart Apache
   - Update app URL to http://10.0.1.24:8080/1.IDM/api
```

---

## ✅ **Quick Test Procedure**

### **Step 1: Test from Computer Browser**
```
Open: http://localhost/1.IDM/
Should see QloApps homepage
```

### **Step 2: Test with IP from Computer Browser**
```
Open: http://10.0.1.24/1.IDM/
Should see QloApps homepage
```

### **Step 3: Test API from Computer Browser**
```
Open: http://10.0.1.24/1.IDM/api/customers?output_format=JSON
Should see JSON response or authentication prompt
```

### **Step 4: Test from Phone Browser**
```
1. Open Chrome/Safari on phone
2. Go to: http://10.0.1.24/1.IDM/
3. Should see QloApps website
```

**If any step fails, the problem is at that level.**

---

## 🚀 **Complete Solution**

### **For Your Current Error:**

1. **Start WAMP:**
   - Double-click WAMP icon
   - Click "Start All Services"
   - Wait for GREEN icon

2. **Verify IP Address:**
   ```powershell
   ipconfig
   ```
   Look for: `IPv4 Address. . . . : 10.0.1.XX`

3. **Test in Browser:**
   ```
   http://10.0.1.24/1.IDM/
   ```

4. **Test API:**
   ```
   http://10.0.1.24/1.IDM/api/customers?output_format=JSON
   ```

5. **If API test works, restart Flutter app:**
   ```powershell
   cd C:\wamp64\www\1.IDM\hotel-staff-flutter
   flutter run
   ```

---

## 📝 **Checklist**

Before running the app, verify:

- [ ] WAMP icon is **GREEN**
- [ ] Can open `http://localhost/1.IDM/` in browser
- [ ] Can open `http://10.0.1.24/1.IDM/` in browser
- [ ] Can open `http://10.0.1.24/1.IDM/api/customers?output_format=JSON`
- [ ] Phone connected to same WiFi as computer
- [ ] Can open `http://10.0.1.24/1.IDM/` on phone's browser
- [ ] Windows Firewall allows Apache

---

## 🔧 **Common Issues**

### **Issue: "Cannot find 10.0.1.24 in browser"**
**Solution:** IP changed, run `ipconfig` to get new IP

### **Issue: "WAMP icon is orange"**
**Solution:** Port 80 conflict, stop Skype/IIS or change Apache port

### **Issue: "Works on computer, not on phone"**
**Solution:** Firewall blocking, add firewall exception

### **Issue: "403 Forbidden"**
**Solution:** Apache permissions, edit httpd.conf Directory settings

---

## 📞 **Still Not Working?**

Run this diagnostic:

```powershell
# Check WAMP services
netstat -ano | findstr :80
netstat -ano | findstr :3306

# Check IP
ipconfig | findstr IPv4

# Test localhost
curl http://localhost/1.IDM/

# Test with IP
curl http://10.0.1.24/1.IDM/

# Test API
curl http://10.0.1.24/1.IDM/api/
```

---

**Last Updated:** October 28, 2025  
**Status:** Troubleshooting Guide
