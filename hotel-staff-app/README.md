# ITSthe1 Hotel Guest Management WebApp 🏨

A **mobile-first Progressive Web App (PWA)** for hotel staff to manage guest check-ins and check-outs with **ID/Passport scanning capabilities** using MRZ (Machine Readable Zone) and OCR (Optical Character Recognition).

![ITSthe1 Brand Color](https://via.placeholder.com/150x50/FF6B35/FFFFFF?text=ITSthe1)

---

## 🌟 Features

### Core Functionality
- **📸 Document Scanning**
  - Camera-based ID/Passport scanning
  - MRZ (Machine Readable Zone) parsing for passports
  - OCR text extraction for ID cards and driver licenses
  - Auto-population of guest registration forms
  - Support for front/back camera switching

- **👤 Guest Management**
  - Register new guests with comprehensive information
  - Auto-fill registration forms from scanned documents
  - Search and filter guest list
  - View detailed guest profiles
  - Track guest status (Registered, Checked-In, Checked-Out)

- **🔐 Check-In/Check-Out Workflows**
  - Streamlined check-in process
  - Room assignment
  - Special requests tracking
  - Quick check-out with stay summary
  - Duration calculation

- **📱 Mobile-First Design**
  - Optimized for tablets and smartphones
  - Touch-friendly UI with large tap targets
  - Portrait orientation optimized
  - Responsive layout for all screen sizes
  - PWA capabilities for offline access and home screen installation

### Technology Stack
- **Frontend:** React 18 + Vite
- **UI Framework:** Material-UI (MUI) v5
- **Camera Access:** react-webcam
- **OCR Engine:** Tesseract.js
- **MRZ Parser:** mrz library
- **State Management:** Zustand
- **Routing:** React Router v6
- **Date Handling:** date-fns
- **PWA:** vite-plugin-pwa

---

## 🚀 Getting Started

### Prerequisites
- Node.js 18+ and npm
- Modern web browser with camera support
- HTTPS connection (required for camera access)

### Installation

1. **Clone or navigate to the project directory:**
   ```bash
   cd hotel-staff-app
   ```

2. **Install dependencies:**
   ```bash
   npm install
   ```

3. **Start the development server:**
   ```bash
   npm run dev
   ```

4. **Open in browser:**
   - Local: http://localhost:3000
   - Network: Available on your local network IP

### Building for Production

```bash
npm run build
```

The production-ready files will be in the `dist` directory.

To preview the production build:
```bash
npm run preview
```

---

## 📱 Usage Guide

### First-Time Setup

1. **Login with demo credentials:**
   - Username: `staff`
   - Password: `demo123`

2. **Grant camera permissions** when prompted (required for document scanning)

### Workflow Examples

#### Scanning a Document
1. Tap **"Scan Document"** from the dashboard
2. Position the ID/Passport within the guide frame
3. Ensure good lighting and document is flat
4. Tap **"Capture"** button
5. Review captured image and tap **"Scan Document"**
6. Wait for OCR/MRZ processing (progress shown)
7. Review extracted data and tap **"Use for Guest Registration"**

#### Registering a New Guest
1. Navigate to **"Register Guest"** (or after scanning)
2. Fill in required fields (auto-filled if coming from scan)
3. Review all information for accuracy
4. Tap **"Save & Continue"** to proceed to check-in

#### Checking In a Guest
1. Go to **"Check-In"** from dashboard
2. Search and select the guest from the list
3. Assign room number
4. Set check-in and check-out dates
5. Add special requests if needed
6. Tap **"Complete Check-In"**

#### Checking Out a Guest
1. Go to **"Check-Out"** from dashboard
2. Search by room number or guest name
3. Review stay details and charges
4. Tap **"Complete Check-Out"**

---

## 🎨 Branding

### ITSthe1 Color Palette
- **Primary Orange:** `#FF6B35` (Main brand color)
- **Dark Background:** `#1A1A2E` (Secondary color)
- **Light Background:** `#F5F7FA`

### Design Principles
- Clean, modern interface
- Large touch targets (minimum 44px)
- High contrast for readability
- Smooth animations and transitions
- Minimal clutter for mobile efficiency

---

## 📁 Project Structure

```
hotel-staff-app/
├── src/
│   ├── pages/
│   │   ├── Login.jsx              # Staff authentication
│   │   ├── Dashboard.jsx          # Main menu with quick stats
│   │   ├── ScanDocument.jsx       # Camera + OCR/MRZ scanning
│   │   ├── GuestRegistration.jsx  # Guest registration form
│   │   ├── CheckIn.jsx            # Check-in workflow
│   │   ├── CheckOut.jsx           # Check-out workflow
│   │   ├── GuestList.jsx          # Browse all guests
│   │   └── GuestDetails.jsx       # Individual guest profile
│   ├── App.jsx                    # Main app component with routing
│   ├── main.jsx                   # React entry point
│   └── index.css                  # Global styles
├── public/
│   └── vite.svg                   # App icon
├── package.json                   # Dependencies
├── vite.config.js                 # Vite + PWA configuration
├── index.html                     # HTML entry point
└── README.md                      # This file
```

---

## 🔧 Configuration

### Camera Settings
The app uses the device's rear camera by default for better document scanning. You can switch to the front camera using the "Flip" button.

### OCR Settings
Tesseract.js is configured for English language recognition. To add more languages:

```javascript
// In ScanDocument.jsx
const { data: { text } } = await Tesseract.recognize(
  capturedImage,
  'eng+fra+deu', // Add language codes
  { /* options */ }
)
```

### PWA Settings
Edit `vite.config.js` to customize PWA manifest:
- App name
- Icons
- Display mode
- Theme color
- Orientation

---

## 🔐 Security Notes

### Current Implementation (Demo Mode)
- Uses localStorage for demo purposes
- Simple client-side authentication
- No encryption or secure token handling

### Production Recommendations
1. **Backend Integration:**
   - Replace localStorage with secure API calls
   - Implement proper JWT authentication
   - Use HTTPS for all requests

2. **Data Protection:**
   - Encrypt sensitive guest information
   - Implement role-based access control (RBAC)
   - Add audit logging for GDPR compliance

3. **Document Security:**
   - Store scanned images securely
   - Implement document retention policies
   - Add watermarking for legal compliance

---

## 🌐 QloApps Integration (Phase 2)

### Planned Integration Points
1. **Authentication:** Sync with QloApps user system
2. **Room Management:** Real-time room availability
3. **Booking System:** Link guests to bookings
4. **Payment Processing:** Integrate with QloApps billing
5. **Reporting:** Sync data for analytics

### API Endpoints to Implement
```javascript
// Example API structure
const API_BASE = 'https://your-qloapp-backend.com/api'

// Guest Management
POST   /guests                 // Create guest
GET    /guests/:id            // Get guest details
PUT    /guests/:id            // Update guest
DELETE /guests/:id            // Delete guest

// Check-In/Out
POST   /check-in              // Check in guest
POST   /check-out             // Check out guest

// Rooms
GET    /rooms/available       // Get available rooms
GET    /rooms/:id            // Get room details
```

---

## 📊 Data Storage

### Current Demo Mode (localStorage)
Data is stored locally in the browser. Keys used:
- `hotelStaffToken` - Authentication token
- `hotelStaffUser` - User profile
- `hotelGuests` - Array of all guest records

### Guest Object Structure
```javascript
{
  id: 123456789,
  firstName: "John",
  lastName: "Doe",
  email: "john@example.com",
  phone: "+1234567890",
  dateOfBirth: "1990-01-15",
  nationality: "USA",
  documentType: "Passport",
  documentNumber: "P12345678",
  documentExpiry: "2030-01-15",
  address: "123 Main St",
  city: "New York",
  country: "USA",
  postalCode: "10001",
  status: "checked-in",        // registered | checked-in | checked-out
  checkInDate: "2024-01-10",
  checkOutDate: "2024-01-15",
  roomNumber: "301",
  numberOfGuests: 2,
  specialRequests: "Late check-in",
  registeredDate: "2024-01-09T14:30:00Z"
}
```

---

## 🐛 Troubleshooting

### Camera Not Working
1. Ensure HTTPS is enabled (camera requires secure context)
2. Grant camera permissions in browser settings
3. Check if another app is using the camera
4. Try refreshing the page

### OCR/MRZ Not Detecting Text
1. Ensure good lighting conditions
2. Keep document flat and within the frame
3. Avoid reflections and shadows
4. Try capturing from different angles
5. Clean the camera lens

### App Not Installing as PWA
1. Ensure HTTPS is enabled
2. Check manifest.json is served correctly
3. Verify service worker is registered
4. Use supported browser (Chrome, Safari, Edge)

### Performance Issues
1. Clear browser cache
2. Close unnecessary tabs
3. Restart the browser
4. Check device memory/storage

---

## 📈 Future Enhancements

### Planned Features
- [ ] Offline mode with sync capabilities
- [ ] Multi-language support (i18n)
- [ ] Biometric authentication
- [ ] QR code generation for guest access
- [ ] Advanced reporting and analytics
- [ ] Email/SMS notifications
- [ ] Document verification with AI
- [ ] Integration with payment gateways
- [ ] Housekeeping status tracking
- [ ] Guest messaging system

---

## 👥 Development Team

**Project:** ITSthe1 Hotel Guest Management System  
**Phase:** Phase 1 - Mobile WebApp  
**Status:** In Development  

---

## 📄 License

This project is proprietary software for ITSthe1 Hotel Management.  
All rights reserved © 2024 ITSthe1

---

## 🤝 Support

For technical support or feature requests, contact the development team.

---

## 🎯 Quick Reference Card

### Demo Login
```
Username: staff
Password: demo123
```

### Dashboard Quick Actions
- 📸 **Scan Document** - Start camera for ID scanning
- ➕ **Register Guest** - Manual guest registration
- 🔵 **Check-In** - Process guest arrival
- 🟠 **Check-Out** - Process guest departure
- 👥 **Guest List** - View all guests

### Keyboard Shortcuts
- `Esc` - Go back
- `Enter` - Submit form
- `Space` - Capture photo (when in camera mode)

---

**Built with ❤️ using React + Vite + Material-UI**
