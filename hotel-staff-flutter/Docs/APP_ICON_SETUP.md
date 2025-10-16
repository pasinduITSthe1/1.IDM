# App Icon Setup Guide

## Steps to Set Your App Icon

### 1. Save Your Icon Image
Save the orange "1.IDM" icon image as:
```
assets/icons/app_icon.png
```

**Requirements:**
- Format: PNG
- Recommended size: 1024x1024 pixels (or at least 512x512)
- The image should be square
- No transparency needed (or will be removed for iOS)

### 2. Install Dependencies
Run this command to install the flutter_launcher_icons package:
```bash
flutter pub get
```

### 3. Generate App Icons
Run this command to generate all the required icon sizes for Android and iOS:
```bash
flutter pub run flutter_launcher_icons
```

This will automatically:
- ✅ Generate all Android icon sizes (mdpi, hdpi, xhdpi, xxhdpi, xxxhdpi)
- ✅ Generate adaptive icons for Android (with orange background #FF8C42)
- ✅ Generate all iOS icon sizes
- ✅ Update AndroidManifest.xml and Info.plist

### 4. Verify the Icons
After generation, check these locations:

**Android:**
- `android/app/src/main/res/mipmap-*/ic_launcher.png`
- `android/app/src/main/res/mipmap-*/ic_launcher_foreground.png`

**iOS:**
- `ios/Runner/Assets.xcassets/AppIcon.appiconset/`

### 5. Test Your App
Run your app to see the new icon:
```bash
flutter run
```

## Configuration Details

The icon configuration in `pubspec.yaml`:

```yaml
flutter_launcher_icons:
  android: true                                    # Generate for Android
  ios: true                                        # Generate for iOS
  image_path: "assets/icons/app_icon.png"         # Your icon file
  adaptive_icon_background: "#FF8C42"             # Orange background
  adaptive_icon_foreground: "assets/icons/app_icon.png"  # Foreground image
  remove_alpha_ios: true                          # Remove transparency for iOS
```

## Troubleshooting

### If icons don't appear:
1. Clean and rebuild your app:
   ```bash
   flutter clean
   flutter pub get
   flutter run
   ```

2. For Android, uninstall the app first:
   ```bash
   flutter clean
   flutter pub get
   flutter pub run flutter_launcher_icons
   flutter run
   ```

### Custom Icon Sizes
If you need custom sizes, you can specify them in pubspec.yaml:
```yaml
flutter_launcher_icons:
  android: "ic_launcher"
  ios: true
  image_path: "assets/icons/app_icon.png"
  min_sdk_android: 21
  adaptive_icon_background: "#FF8C42"
  adaptive_icon_foreground: "assets/icons/app_icon.png"
```

## Next Steps

After setting up the icon:
1. Test on both Android and iOS devices
2. Check the icon appears correctly in:
   - App drawer/home screen
   - Recent apps/task switcher
   - Settings/app info
3. Build release versions to ensure icons are included

---
**Note:** Make sure your icon image is high quality (at least 512x512px) for best results across all device sizes.
