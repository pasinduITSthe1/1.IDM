# Fix Apache 403 Forbidden Error for QloApps API

## Problem
```
403 Forbidden
You don't have permission to access this resource.
Apache/2.4.62 (Win64) PHP/8.3.14
```

## Solution: Update Apache Configuration

### Step 1: Open Apache Config File

1. Click WAMP icon → Apache → httpd.conf
2. Or manually open: `C:\wamp64\bin\apache\apache2.4.62\conf\httpd.conf`

### Step 2: Find and Update Directory Permissions

Search for this section (around line 230-250):

```apache
<Directory "c:/wamp64/www/">
    Options +Indexes +FollowSymLinks +MultiViews
    AllowOverride All
    Require local
</Directory>
```

**Change it to:**

```apache
<Directory "c:/wamp64/www/">
    Options +Indexes +FollowSymLinks +MultiViews
    AllowOverride All
    # CHANGED: Allow from all networks, not just local
    Require all granted
</Directory>
```

### Step 3: Allow Access from Your WiFi Network

Add this section after the previous one:

```apache
# Allow access from local network (10.0.1.x)
<Directory "c:/wamp64/www/1.IDM/">
    Options +Indexes +FollowSymLinks +MultiViews
    AllowOverride All
    Require all granted
</Directory>
```

### Step 4: Restart Apache

1. Click WAMP icon
2. Click "Restart All Services"
3. Wait for green icon

## Alternative: Quick WAMP Fix

1. **Left-click WAMP icon**
2. Click **"Put Online"** (if available)
3. Or go to: Apache → httpd-vhosts.conf
4. Make sure the VirtualHost allows network access

## Verify Fix

Test in browser on your phone:
```
http://10.0.1.26/1.IDM/
```

Should see QloApps homepage (not 403 error)

Then test API:
```
http://10.0.1.26/1.IDM/api/customers?output_format=JSON
```

Should see JSON or authentication prompt (not 403 error)
