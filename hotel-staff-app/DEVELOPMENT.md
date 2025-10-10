# Development & Deployment Guide

## Quick Start Commands

```bash
# Install dependencies
npm install

# Start development server
npm run dev

# Build for production
npm run build

# Preview production build
npm run preview

# Run linting
npm run lint
```

---

## Development Environment Setup

### VS Code Extensions (Recommended)
- ESLint
- Prettier
- ES7+ React/Redux/React-Native snippets
- Material-UI Snippets
- GitLens

### Browser DevTools
- React Developer Tools
- Redux DevTools (if added)
- Lighthouse (for PWA testing)

---

## Testing on Mobile Devices

### Local Network Testing

1. **Find your network IP:**
   - Windows: `ipconfig` (look for IPv4 Address)
   - Mac/Linux: `ifconfig` (look for inet)

2. **Access from mobile device:**
   ```
   http://YOUR_IP:3000
   ```
   Example: `http://10.0.1.24:3000`

3. **Grant camera permissions** on mobile browser

### HTTPS for Camera Access

Camera API requires HTTPS. For local development:

#### Option 1: Use ngrok
```bash
# Install ngrok
npm install -g ngrok

# In one terminal, run dev server
npm run dev

# In another terminal, expose with ngrok
ngrok http 3000
```

#### Option 2: Use Vite HTTPS
Update `vite.config.js`:
```javascript
export default defineConfig({
  server: {
    https: true,
    port: 3000,
  },
  // ... rest of config
})
```

---

## Building for Production

### 1. Environment Configuration

Create `.env.production`:
```env
VITE_API_URL=https://your-api-domain.com
VITE_APP_NAME=ITSthe1 Hotel Management
VITE_APP_VERSION=1.0.0
```

### 2. Build the App

```bash
npm run build
```

Output will be in `dist/` directory.

### 3. Test Production Build Locally

```bash
npm run preview
```

---

## Deployment Options

### Option 1: Static Hosting (Netlify)

1. **Install Netlify CLI:**
   ```bash
   npm install -g netlify-cli
   ```

2. **Deploy:**
   ```bash
   npm run build
   netlify deploy --prod --dir=dist
   ```

3. **Configure redirects** (create `public/_redirects`):
   ```
   /*    /index.html   200
   ```

### Option 2: Vercel

1. **Install Vercel CLI:**
   ```bash
   npm install -g vercel
   ```

2. **Deploy:**
   ```bash
   npm run build
   vercel --prod
   ```

### Option 3: Traditional Web Server (Apache/Nginx)

1. **Build the app:**
   ```bash
   npm run build
   ```

2. **Copy `dist/` contents to server:**
   ```bash
   # Example for Linux server
   scp -r dist/* user@server:/var/www/hotel-app/
   ```

3. **Configure server:**

   **Apache (.htaccess):**
   ```apache
   <IfModule mod_rewrite.c>
     RewriteEngine On
     RewriteBase /
     RewriteRule ^index\.html$ - [L]
     RewriteCond %{REQUEST_FILENAME} !-f
     RewriteCond %{REQUEST_FILENAME} !-d
     RewriteRule . /index.html [L]
   </IfModule>
   ```

   **Nginx:**
   ```nginx
   server {
     listen 80;
     server_name your-domain.com;
     root /var/www/hotel-app;
     index index.html;

     location / {
       try_files $uri $uri/ /index.html;
     }
   }
   ```

### Option 4: Docker Deployment

1. **Create Dockerfile:**
   ```dockerfile
   FROM node:18-alpine as builder
   WORKDIR /app
   COPY package*.json ./
   RUN npm install
   COPY . .
   RUN npm run build

   FROM nginx:alpine
   COPY --from=builder /app/dist /usr/share/nginx/html
   COPY nginx.conf /etc/nginx/conf.d/default.conf
   EXPOSE 80
   CMD ["nginx", "-g", "daemon off;"]
   ```

2. **Build and run:**
   ```bash
   docker build -t hotel-staff-app .
   docker run -p 80:80 hotel-staff-app
   ```

---

## PWA Installation

### Desktop Installation
1. Open app in Chrome/Edge
2. Look for install icon in address bar
3. Click "Install"

### Mobile Installation
1. Open app in mobile browser
2. **iOS Safari:** Tap Share → Add to Home Screen
3. **Android Chrome:** Tap Menu → Install app

---

## Performance Optimization

### Image Optimization
- Use WebP format for images
- Compress images before deployment
- Implement lazy loading

### Code Splitting
Vite automatically splits code. For manual splitting:
```javascript
const GuestList = lazy(() => import('./pages/GuestList'))
```

### Lighthouse Audit
```bash
# Install lighthouse
npm install -g lighthouse

# Run audit
lighthouse http://localhost:3000 --view
```

---

## API Integration (Phase 2)

### Setup API Client

Create `src/api/client.js`:
```javascript
import axios from 'axios'

const apiClient = axios.create({
  baseURL: import.meta.env.VITE_API_URL || 'http://localhost:8000/api',
  timeout: 10000,
  headers: {
    'Content-Type': 'application/json',
  },
})

// Add auth token to requests
apiClient.interceptors.request.use((config) => {
  const token = localStorage.getItem('hotelStaffToken')
  if (token) {
    config.headers.Authorization = `Bearer ${token}`
  }
  return config
})

export default apiClient
```

### API Service Example

Create `src/api/guestService.js`:
```javascript
import apiClient from './client'

export const guestService = {
  // Get all guests
  getAll: async () => {
    const response = await apiClient.get('/guests')
    return response.data
  },

  // Get single guest
  getById: async (id) => {
    const response = await apiClient.get(`/guests/${id}`)
    return response.data
  },

  // Create guest
  create: async (guestData) => {
    const response = await apiClient.post('/guests', guestData)
    return response.data
  },

  // Update guest
  update: async (id, guestData) => {
    const response = await apiClient.put(`/guests/${id}`, guestData)
    return response.data
  },

  // Delete guest
  delete: async (id) => {
    await apiClient.delete(`/guests/${id}`)
  },

  // Check-in
  checkIn: async (guestId, checkInData) => {
    const response = await apiClient.post(`/guests/${guestId}/check-in`, checkInData)
    return response.data
  },

  // Check-out
  checkOut: async (guestId) => {
    const response = await apiClient.post(`/guests/${guestId}/check-out`)
    return response.data
  },
}
```

---

## Environment Variables

Create `.env` files for different environments:

### `.env.development`
```env
VITE_API_URL=http://localhost:8000/api
VITE_APP_ENV=development
VITE_ENABLE_LOGS=true
```

### `.env.production`
```env
VITE_API_URL=https://api.yourhotel.com
VITE_APP_ENV=production
VITE_ENABLE_LOGS=false
```

### Usage in Code
```javascript
const apiUrl = import.meta.env.VITE_API_URL
```

---

## Troubleshooting Common Issues

### Build Errors

**Error: Module not found**
```bash
# Clear cache and reinstall
rm -rf node_modules package-lock.json
npm install
```

**Error: Out of memory**
```bash
# Increase Node memory
export NODE_OPTIONS=--max-old-space-size=4096
npm run build
```

### Development Issues

**Port already in use**
```bash
# Kill process on port 3000 (Windows)
netstat -ano | findstr :3000
taskkill /PID <PID> /F

# Or change port in vite.config.js
server: { port: 3001 }
```

**Hot reload not working**
```bash
# Try clearing Vite cache
rm -rf node_modules/.vite
npm run dev
```

---

## Security Checklist

### Before Deployment
- [ ] Remove console.log statements
- [ ] Remove demo credentials
- [ ] Enable HTTPS
- [ ] Set up CORS properly
- [ ] Implement rate limiting
- [ ] Add input validation
- [ ] Enable CSP headers
- [ ] Implement authentication
- [ ] Add error logging
- [ ] Set up monitoring

### Security Headers (Nginx)
```nginx
add_header X-Frame-Options "SAMEORIGIN" always;
add_header X-Content-Type-Options "nosniff" always;
add_header X-XSS-Protection "1; mode=block" always;
add_header Referrer-Policy "no-referrer-when-downgrade" always;
add_header Content-Security-Policy "default-src 'self' https:;" always;
```

---

## Monitoring & Analytics

### Setup Error Tracking (Sentry Example)

```bash
npm install @sentry/react
```

In `src/main.jsx`:
```javascript
import * as Sentry from "@sentry/react"

Sentry.init({
  dsn: "YOUR_SENTRY_DSN",
  environment: import.meta.env.MODE,
  tracesSampleRate: 1.0,
})
```

### Google Analytics

```bash
npm install react-ga4
```

In `src/App.jsx`:
```javascript
import ReactGA from 'react-ga4'

ReactGA.initialize('YOUR_GA_ID')

// Track page views
useEffect(() => {
  ReactGA.send({ hitType: "pageview", page: location.pathname })
}, [location])
```

---

## Version Control

### Git Workflow

```bash
# Create feature branch
git checkout -b feature/document-scanning

# Commit changes
git add .
git commit -m "feat: Add document scanning with OCR"

# Push to remote
git push origin feature/document-scanning

# Create Pull Request on GitHub
```

### Conventional Commits
```
feat: New feature
fix: Bug fix
docs: Documentation changes
style: Code style changes
refactor: Code refactoring
test: Add tests
chore: Build/tooling changes
```

---

## Backup & Recovery

### Database Backup (When integrated with backend)
```bash
# Schedule daily backups
0 2 * * * /usr/bin/mysqldump -u user -p database > /backups/hotel_$(date +\%Y\%m\%d).sql
```

### Code Backup
- Use Git (GitHub/GitLab/Bitbucket)
- Enable branch protection
- Tag releases: `git tag -a v1.0.0 -m "Release v1.0.0"`

---

## Support & Maintenance

### Regular Tasks
- Weekly: Check error logs
- Monthly: Update dependencies (`npm outdated`, `npm update`)
- Quarterly: Security audit (`npm audit`)
- Yearly: Review and update documentation

### Dependency Updates
```bash
# Check outdated packages
npm outdated

# Update packages
npm update

# Update to latest versions
npx npm-check-updates -u
npm install
```

---

## Resources

- [React Documentation](https://react.dev)
- [Vite Documentation](https://vitejs.dev)
- [Material-UI Documentation](https://mui.com)
- [Tesseract.js Documentation](https://tesseract.projectnaptha.com)
- [PWA Documentation](https://web.dev/progressive-web-apps)

---

**Last Updated:** January 2024  
**Maintained by:** ITSthe1 Development Team
