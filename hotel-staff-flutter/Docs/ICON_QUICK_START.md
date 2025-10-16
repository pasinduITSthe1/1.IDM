# Quick App Icon Setup

## 🚀 Quick Start (3 Steps)

### 1️⃣ Save Your Icon
Save the orange "1.IDM" icon as:
```
assets/icons/app_icon.png
```
(Must be PNG, 1024x1024 or 512x512 pixels)

### 2️⃣ Run the Setup Script
```powershell
.\setup-app-icon.ps1
```

### 3️⃣ Test Your App
```bash
flutter run
```

---

## 📱 Manual Setup (Alternative)

If you prefer to do it manually:

```bash
# 1. Install dependencies
flutter pub get

# 2. Generate icons
flutter pub run flutter_launcher_icons

# 3. Clean and run
flutter clean
flutter run
```

---

## ✅ What's Configured

Your `pubspec.yaml` has been updated with:

- **flutter_launcher_icons** package
- Orange background color: `#FF8C42`
- Icon path: `assets/icons/app_icon.png`
- Both Android and iOS enabled
- Adaptive icons for Android

---

## 🎨 Icon Specifications

Your icon will be generated in these sizes:

### Android:
- `mdpi` - 48x48
- `hdpi` - 72x72
- `xhdpi` - 96x96
- `xxhdpi` - 144x144
- `xxxhdpi` - 192x192
- Adaptive icons with orange background

### iOS:
- Multiple sizes from 20x20 to 1024x1024
- All required for App Store submission

---

## 🔍 Verify Installation

Check these files after setup:

```
✅ android/app/src/main/res/mipmap-hdpi/ic_launcher.png
✅ android/app/src/main/res/mipmap-mdpi/ic_launcher.png
✅ android/app/src/main/res/mipmap-xhdpi/ic_launcher.png
✅ android/app/src/main/res/mipmap-xxhdpi/ic_launcher.png
✅ android/app/src/main/res/mipmap-xxxhdpi/ic_launcher.png
✅ ios/Runner/Assets.xcassets/AppIcon.appiconset/
```

---

## 🐛 Troubleshooting

**Icon not showing?**
```bash
flutter clean
flutter pub get
# Uninstall app from device/simulator
flutter run
```

**Need different background color?**
Edit `pubspec.yaml` and change:
```yaml
adaptive_icon_background: "#YOUR_COLOR"
```

---

## 📋 Icon Checklist

- [ ] Icon saved to `assets/icons/app_icon.png`
- [ ] Icon is PNG format
- [ ] Icon is square (1024x1024 recommended)
- [ ] Dependencies installed (`flutter pub get`)
- [ ] Icons generated (`flutter pub run flutter_launcher_icons`)
- [ ] App tested on device
- [ ] Icon appears in app drawer
- [ ] Icon appears in task switcher

---

**Need help?** Check `APP_ICON_SETUP.md` for detailed instructions.
