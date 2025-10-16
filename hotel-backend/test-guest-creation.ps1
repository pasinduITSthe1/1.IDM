# Test Guest Creation and Database Connectivity

Write-Host "=" * 60 -ForegroundColor Cyan
Write-Host "Testing Hotel Backend API - Guest Operations" -ForegroundColor Cyan
Write-Host "=" * 60 -ForegroundColor Cyan
Write-Host ""

# Base URL
$baseUrl = "http://localhost:3000/api"

# Step 1: Login to get token
Write-Host "Step 1: Logging in to get authentication token..." -ForegroundColor Yellow
$loginBody = @{
    username = "admin"
    password = "admin123"
} | ConvertTo-Json

try {
    $loginResponse = Invoke-RestMethod -Uri "$baseUrl/auth/login" -Method Post -Body $loginBody -ContentType "application/json"
    $token = $loginResponse.data.token
    Write-Host "✅ Login successful!" -ForegroundColor Green
    Write-Host "Token: $($token.Substring(0, 20))..." -ForegroundColor Gray
    Write-Host ""
} catch {
    Write-Host "❌ Login failed: $($_.Exception.Message)" -ForegroundColor Red
    Write-Host "Error Details: $($_.ErrorDetails.Message)" -ForegroundColor Red
    exit 1
}

# Step 2: Test getting all guests (before creation)
Write-Host "Step 2: Getting all guests (before creation)..." -ForegroundColor Yellow
$headers = @{
    Authorization = "Bearer $token"
}

try {
    $guestsResponse = Invoke-RestMethod -Uri "$baseUrl/guests" -Method Get -Headers $headers
    Write-Host "✅ Current guest count: $($guestsResponse.count)" -ForegroundColor Green
    Write-Host ""
} catch {
    Write-Host "❌ Failed to get guests: $($_.Exception.Message)" -ForegroundColor Red
}

# Step 3: Create a new guest
Write-Host "Step 3: Creating a new guest..." -ForegroundColor Yellow
$guestData = @{
    firstName = "John"
    lastName = "Doe"
    documentNumber = "AB123456"
    documentType = "Passport"
    issuedCountry = "USA"
    issuedDate = "2020-01-15"
    expiryDate = "2030-01-15"
    dateOfBirth = "1990-05-20"
    sex = "M"
    nationality = "American"
    email = "john.doe@example.com"
    phone = "+1234567890"
    address = "123 Main St, New York, NY"
    visitPurpose = "Business"
    status = "pending"
    roomNumber = "101"
} | ConvertTo-Json

try {
    $createResponse = Invoke-RestMethod -Uri "$baseUrl/guests" -Method Post -Body $guestData -ContentType "application/json" -Headers $headers
    Write-Host "✅ Guest created successfully!" -ForegroundColor Green
    Write-Host "Guest ID: $($createResponse.data.id)" -ForegroundColor Gray
    Write-Host "Name: $($createResponse.data.first_name) $($createResponse.data.last_name)" -ForegroundColor Gray
    $guestId = $createResponse.data.id
    Write-Host ""
} catch {
    Write-Host "❌ Failed to create guest: $($_.Exception.Message)" -ForegroundColor Red
    Write-Host "Response: $($_.ErrorDetails.Message)" -ForegroundColor Red
    Write-Host ""
}

# Step 4: Verify guest was saved
Write-Host "Step 4: Verifying guest was saved to database..." -ForegroundColor Yellow
try {
    $guestsResponse = Invoke-RestMethod -Uri "$baseUrl/guests" -Method Get -Headers $headers
    Write-Host "✅ Total guests in database: $($guestsResponse.count)" -ForegroundColor Green
    
    if ($guestsResponse.count -gt 0) {
        Write-Host ""
        Write-Host "Guest List:" -ForegroundColor Cyan
        foreach ($guest in $guestsResponse.data) {
            Write-Host "  - ID: $($guest.id)" -ForegroundColor Gray
            Write-Host "    Name: $($guest.first_name) $($guest.last_name)" -ForegroundColor Gray
            Write-Host "    Document: $($guest.document_number)" -ForegroundColor Gray
            Write-Host "    Status: $($guest.status)" -ForegroundColor Gray
            Write-Host "    Room: $($guest.room_number)" -ForegroundColor Gray
            Write-Host ""
        }
    }
} catch {
    Write-Host "❌ Failed to verify guests: $($_.Exception.Message)" -ForegroundColor Red
}

# Step 5: Get specific guest
if ($guestId) {
    Write-Host "Step 5: Getting specific guest by ID..." -ForegroundColor Yellow
    try {
        $guestResponse = Invoke-RestMethod -Uri "$baseUrl/guests/$guestId" -Method Get -Headers $headers
        Write-Host "✅ Successfully retrieved guest!" -ForegroundColor Green
        Write-Host "Guest details:" -ForegroundColor Gray
        $guestResponse.data | ConvertTo-Json
        Write-Host ""
    } catch {
        Write-Host "❌ Failed to get guest: $($_.Exception.Message)" -ForegroundColor Red
    }

    # Step 6: Update guest
    Write-Host "Step 6: Updating guest status..." -ForegroundColor Yellow
    $updateData = @{
        firstName = "John"
        lastName = "Doe"
        documentNumber = "AB123456"
        documentType = "Passport"
        issuedCountry = "USA"
        issuedDate = "2020-01-15"
        expiryDate = "2030-01-15"
        dateOfBirth = "1990-05-20"
        sex = "M"
        nationality = "American"
        email = "john.doe@example.com"
        phone = "+1234567890"
        address = "123 Main St, New York, NY"
        visitPurpose = "Business"
        status = "checked_in"
        roomNumber = "101"
    } | ConvertTo-Json

    try {
        $updateResponse = Invoke-RestMethod -Uri "$baseUrl/guests/$guestId" -Method Put -Body $updateData -ContentType "application/json" -Headers $headers
        Write-Host "✅ Guest updated successfully!" -ForegroundColor Green
        Write-Host "New status: $($updateResponse.data.status)" -ForegroundColor Gray
        Write-Host ""
    } catch {
        Write-Host "❌ Failed to update guest: $($_.Exception.Message)" -ForegroundColor Red
    }

    # Step 7: Check-in guest
    Write-Host "Step 7: Testing check-in functionality..." -ForegroundColor Yellow
    $checkinData = @{
        roomNumber = "201"
    } | ConvertTo-Json

    try {
        $checkinResponse = Invoke-RestMethod -Uri "$baseUrl/guests/$guestId/checkin" -Method Post -Body $checkinData -ContentType "application/json" -Headers $headers
        Write-Host "✅ Guest checked in successfully!" -ForegroundColor Green
        Write-Host "Room: $($checkinResponse.data.room_number)" -ForegroundColor Gray
        Write-Host "Status: $($checkinResponse.data.status)" -ForegroundColor Gray
        Write-Host ""
    } catch {
        Write-Host "❌ Failed to check-in guest: $($_.Exception.Message)" -ForegroundColor Red
    }
}

# Step 8: Check database directly
Write-Host "Step 8: Checking database directly..." -ForegroundColor Yellow
Write-Host "Please verify in phpMyAdmin that guests are being saved." -ForegroundColor Cyan
Write-Host "URL: http://localhost/phpmyadmin" -ForegroundColor Cyan
Write-Host "Database: hotel_staff_db" -ForegroundColor Cyan
Write-Host "Table: guests" -ForegroundColor Cyan
Write-Host ""

Write-Host "=" * 60 -ForegroundColor Cyan
Write-Host "Testing completed!" -ForegroundColor Cyan
Write-Host "=" * 60 -ForegroundColor Cyan
