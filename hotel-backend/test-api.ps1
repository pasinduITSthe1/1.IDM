# API Test Examples for PowerShell

Write-Host "🧪 Hotel Backend API Tests" -ForegroundColor Cyan
Write-Host "=====================================" -ForegroundColor Cyan
Write-Host ""

$baseUrl = "http://localhost:3000"

# Test 1: Health Check
Write-Host "1️⃣  Testing Health Check..." -ForegroundColor Yellow
try {
    $response = Invoke-RestMethod -Uri "$baseUrl/api/health" -Method Get
    Write-Host "✅ Health Check: " -ForegroundColor Green -NoNewline
    Write-Host $response.message -ForegroundColor White
} catch {
    Write-Host "❌ Health Check Failed!" -ForegroundColor Red
}

Write-Host ""

# Test 2: Login
Write-Host "2️⃣  Testing Login..." -ForegroundColor Yellow
try {
    $loginBody = @{
        username = "admin"
        password = "admin123"
    } | ConvertTo-Json

    $response = Invoke-RestMethod -Uri "$baseUrl/api/auth/login" `
        -Method Post `
        -ContentType "application/json" `
        -Body $loginBody

    $token = $response.data.token
    Write-Host "✅ Login Successful!" -ForegroundColor Green
    Write-Host "   Username: $($response.data.staff.username)" -ForegroundColor White
    Write-Host "   Name: $($response.data.staff.name)" -ForegroundColor White
    Write-Host "   Role: $($response.data.staff.role)" -ForegroundColor White
    Write-Host "   Token: $($token.Substring(0, 20))..." -ForegroundColor Gray
} catch {
    Write-Host "❌ Login Failed!" -ForegroundColor Red
    Write-Host $_.Exception.Message -ForegroundColor Red
    exit 1
}

Write-Host ""

# Test 3: Get All Guests
Write-Host "3️⃣  Testing Get All Guests..." -ForegroundColor Yellow
try {
    $headers = @{
        Authorization = "Bearer $token"
    }

    $response = Invoke-RestMethod -Uri "$baseUrl/api/guests" `
        -Method Get `
        -Headers $headers

    Write-Host "✅ Get Guests Successful!" -ForegroundColor Green
    Write-Host "   Total Guests: $($response.count)" -ForegroundColor White
} catch {
    Write-Host "❌ Get Guests Failed!" -ForegroundColor Red
    Write-Host $_.Exception.Message -ForegroundColor Red
}

Write-Host ""

# Test 4: Get All Rooms
Write-Host "4️⃣  Testing Get All Rooms..." -ForegroundColor Yellow
try {
    $headers = @{
        Authorization = "Bearer $token"
    }

    $response = Invoke-RestMethod -Uri "$baseUrl/api/rooms" `
        -Method Get `
        -Headers $headers

    Write-Host "✅ Get Rooms Successful!" -ForegroundColor Green
    Write-Host "   Total Rooms: $($response.count)" -ForegroundColor White
    
    foreach ($room in $response.data) {
        Write-Host "   - Room $($room.room_number): $($room.room_type) - $($room.status)" -ForegroundColor Gray
    }
} catch {
    Write-Host "❌ Get Rooms Failed!" -ForegroundColor Red
    Write-Host $_.Exception.Message -ForegroundColor Red
}

Write-Host ""

# Test 5: Create Guest
Write-Host "5️⃣  Testing Create Guest..." -ForegroundColor Yellow
try {
    $headers = @{
        Authorization = "Bearer $token"
    }

    $guestBody = @{
        firstName = "John"
        lastName = "Doe"
        documentNumber = "AB123456"
        documentType = "passport"
        issuedCountry = "USA"
        issuedDate = "2020-01-15"
        expiryDate = "2030-01-15"
        dateOfBirth = "1990-05-20"
        sex = "M"
        nationality = "American"
        email = "john.doe@example.com"
        phone = "+1234567890"
        address = "123 Main St, New York"
        visitPurpose = "Tourism"
        status = "pending"
    } | ConvertTo-Json

    $response = Invoke-RestMethod -Uri "$baseUrl/api/guests" `
        -Method Post `
        -Headers $headers `
        -ContentType "application/json" `
        -Body $guestBody

    Write-Host "✅ Create Guest Successful!" -ForegroundColor Green
    Write-Host "   Guest ID: $($response.data.id)" -ForegroundColor White
    Write-Host "   Name: $($response.data.first_name) $($response.data.last_name)" -ForegroundColor White
    Write-Host "   Status: $($response.data.status)" -ForegroundColor White
} catch {
    Write-Host "❌ Create Guest Failed!" -ForegroundColor Red
    Write-Host $_.Exception.Message -ForegroundColor Red
}

Write-Host ""
Write-Host "=====================================" -ForegroundColor Cyan
Write-Host "✅ All tests completed!" -ForegroundColor Green
Write-Host ""
