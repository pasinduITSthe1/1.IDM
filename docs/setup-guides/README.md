# 📚 Setup Guides - Hotel Management System

This folder contains all the documentation you need to set up and configure the Hotel Management System on any device.

---

## 📖 Available Guides

### 🚀 [INSTALLATION_GUIDE.md](./INSTALLATION_GUIDE.md)
**Complete step-by-step installation guide**
- Backend setup (WAMP, Node.js, MySQL)
- Frontend setup (Flutter app)
- Firewall configuration
- Multiple deployment scenarios
- Verification checklist
- Troubleshooting section
- Security notes

**Use this when:** Setting up the system on a new computer from scratch

---

### ⚡ [QUICK_SETUP.md](./QUICK_SETUP.md)
**5-minute quick reference**
- TL;DR configuration summary
- Quick setup commands
- Common mistakes to avoid
- Troubleshooting table
- Pro tips

**Use this when:** You've already installed once and need a quick reminder

---

### 🔧 [HOW_IT_WORKS.md](./HOW_IT_WORKS.md)
**Technical explanation of automatic configuration**
- How the centralized config works
- Code examples with Dart getters
- Visual flow diagrams
- Benefits of the architecture
- Comparison old vs new approach

**Use this when:** You want to understand the technical implementation

---

### 📡 [WIFI_SETUP_GUIDE.md](./WIFI_SETUP_GUIDE.md)
**WiFi network configuration details**
- Current network setup
- How to switch between WiFi and USB
- Testing procedures
- Troubleshooting network issues

**Use this when:** Configuring network connections or troubleshooting connectivity

---

### 🧰 [NETWORK_CONFIG_README.md](./NETWORK_CONFIG_README.md)
**NetworkConfig class usage guide**
- How to update computer IP
- WiFi vs USB mode switching
- What gets auto-configured
- Quick examples for different scenarios

**Use this when:** Updating network settings in the Flutter app

---

## 🎯 Quick Navigation by Use Case

### "I'm installing on a new computer"
1. Start with → [INSTALLATION_GUIDE.md](./INSTALLATION_GUIDE.md)
2. Reference → [QUICK_SETUP.md](./QUICK_SETUP.md) for commands
3. Understand → [HOW_IT_WORKS.md](./HOW_IT_WORKS.md) if curious

### "My IP address changed"
1. Find new IP → `ipconfig` (Windows) or `ifconfig` (Mac/Linux)
2. Update → [NETWORK_CONFIG_README.md](./NETWORK_CONFIG_README.md)
3. Just edit: `hotel-staff-flutter/lib/utils/network_config.dart`

### "I can't connect from my phone"
1. Check → [WIFI_SETUP_GUIDE.md](./WIFI_SETUP_GUIDE.md)
2. Verify same WiFi network
3. Test connection from phone browser
4. Check firewall settings

### "I want to switch to USB tethering"
1. Follow → [WIFI_SETUP_GUIDE.md](./WIFI_SETUP_GUIDE.md) (USB section)
2. Set `useWiFi = false` in network_config.dart
3. Run ADB port forwarding commands

### "I'm a developer and want to understand the code"
1. Read → [HOW_IT_WORKS.md](./HOW_IT_WORKS.md)
2. Check → [NETWORK_CONFIG_README.md](./NETWORK_CONFIG_README.md)
3. Review → `hotel-staff-flutter/lib/utils/network_config.dart` source code

---

## 🔑 Key Concepts

### Single Source of Truth
All network configuration is in **ONE FILE**: `network_config.dart`

### Two Values to Configure
```dart
static const String computerIp = 'YOUR_IP';  // 1️⃣ Your computer's IP
static const bool useWiFi = true;            // 2️⃣ WiFi or USB mode
```

### Automatic URL Generation
All API endpoints are automatically built from these 2 values:
- Customer API
- Escort API
- Hotel Backend API
- QloApps API
- And more...

---

## 📞 Quick Reference

### Find Your IP
```bash
# Windows
ipconfig

# Mac
ifconfig | grep "inet "

# Linux
ip addr show
```

### Test Backend Services
```bash
# Customer API (Apache/WAMP)
curl http://YOUR_IP/1.IDM/customers-api.php

# Escort API (Node.js)
curl http://YOUR_IP:3000/api/health
```

### Update Network Config
```dart
// File: hotel-staff-flutter/lib/utils/network_config.dart
static const String computerIp = 'YOUR_IP_HERE';
static const bool useWiFi = true;
```

---

## 💡 Pro Tips

1. **Bookmark your IP**: Keep a note of your computer's IP address
2. **Same WiFi**: Always ensure phone and computer are on the same network
3. **Hot reload**: After changing IP, press `r` in Flutter terminal
4. **Firewall**: Allow ports 80 and 3000 in Windows Firewall
5. **Keep servers running**: Don't close WAMP or Node.js terminal

---

## 🆘 Common Issues

| Issue | Solution |
|-------|----------|
| Can't connect | Verify same WiFi network → [WIFI_SETUP_GUIDE.md](./WIFI_SETUP_GUIDE.md) |
| IP changed | Update network_config.dart → [NETWORK_CONFIG_README.md](./NETWORK_CONFIG_README.md) |
| First time setup | Follow complete guide → [INSTALLATION_GUIDE.md](./INSTALLATION_GUIDE.md) |
| Quick reminder | Check quick setup → [QUICK_SETUP.md](./QUICK_SETUP.md) |
| Understand code | Read how it works → [HOW_IT_WORKS.md](./HOW_IT_WORKS.md) |

---

## 📝 Summary

**What you configure:**
- Database credentials (once)
- Computer IP address (when network changes)

**What's automatic:**
- All API endpoints ✅
- All service URLs ✅
- All backend connections ✅

**Result:** Works on any computer, any network! 🎉

---

## 🎯 Need Help?

1. Check the appropriate guide above
2. Look at the troubleshooting sections
3. Review the quick reference commands
4. Test connections step by step

All guides include detailed troubleshooting sections and examples!
