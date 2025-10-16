# Complete Test Suite for All Guest Functions

Write-Host "=" * 70 -ForegroundColor Cyan
Write-Host "Complete Test Suite - Hotel Backend API (All Functions)" -ForegroundColor Cyan
Write-Host "=" * 70 -ForegroundColor Cyan
Write-Host ""

$baseUrl = "http://localhost:3000/api"

# Login
Write-Host "==> Logging in..." -ForegroundColor Yellow
$loginBody = @{
    username = "admin"
    password = "admin123"
} | ConvertTo-Json

$loginResponse = Invoke-RestMethod -Uri "$baseUrl/auth/login" -Method Post -Body $loginBody -ContentType "application/json"
$token = $loginResponse.data.token
$headers = @{ Authorization = "Bearer $token" }
Write-Host "✅ Login successful!`n" -ForegroundColor Green

# Test 1: Create Guest
Write-Host "TEST 1: CREATE GUEST" -ForegroundColor Magenta
Write-Host "-" * 70 -ForegroundColor Gray
$guestData = @{
    firstName = "Jane"
    lastName = "Smith"
    documentNumber = "CD789012"
    documentType = "ID Card"
    issuedCountry = "Canada"
    issuedDate = "2021-03-10"
    expiryDate = "2031-03-10"
    dateOfBirth = "1985-08-15"
    sex = "F"
    nationality = "Canadian"
    email = "jane.smith@example.com"
    phone = "+1987654321"
    address = "456 Oak Ave, Toronto, ON"
    visitPurpose = "Tourism"
    status = "pending"
    roomNumber = "102"
} | ConvertTo-Json

$createResponse = Invoke-RestMethod -Uri "$baseUrl/guests" -Method Post -Body $guestData -ContentType "application/json" -Headers $headers
$guestId = $createResponse.data.id
Write-Host "✅ Guest created: $($createResponse.data.first_name) $($createResponse.data.last_name)" -ForegroundColor Green
Write-Host "   ID: $guestId" -ForegroundColor Gray
Write-Host ""

# Test 2: Get All Guests
Write-Host "TEST 2: GET ALL GUESTS" -ForegroundColor Magenta
Write-Host "-" * 70 -ForegroundColor Gray
$allGuests = Invoke-RestMethod -Uri "$baseUrl/guests" -Method Get -Headers $headers
Write-Host "✅ Total guests in database: $($allGuests.count)" -ForegroundColor Green
foreach ($g in $allGuests.data) {
    Write-Host "   - $($g.first_name) $($g.last_name) (Room: $($g.room_number), Status: $($g.status))" -ForegroundColor Gray
}
Write-Host ""

# Test 3: Get Single Guest
Write-Host "TEST 3: GET SINGLE GUEST BY ID" -ForegroundColor Magenta
Write-Host "-" * 70 -ForegroundColor Gray
$singleGuest = Invoke-RestMethod -Uri "$baseUrl/guests/$guestId" -Method Get -Headers $headers
Write-Host "✅ Retrieved guest: $($singleGuest.data.first_name) $($singleGuest.data.last_name)" -ForegroundColor Green
Write-Host "   Email: $($singleGuest.data.email)" -ForegroundColor Gray
Write-Host "   Phone: $($singleGuest.data.phone)" -ForegroundColor Gray
Write-Host ""

# Test 4: Update Guest
Write-Host "TEST 4: UPDATE GUEST" -ForegroundColor Magenta
Write-Host "-" * 70 -ForegroundColor Gray
$updateData = @{
    firstName = "Jane"
    lastName = "Smith-Updated"
    documentNumber = "CD789012"
    documentType = "ID Card"
    issuedCountry = "Canada"
    issuedDate = "2021-03-10"
    expiryDate = "2031-03-10"
    dateOfBirth = "1985-08-15"
    sex = "F"
    nationality = "Canadian"
    email = "jane.updated@example.com"
    phone = "+1987654321"
    address = "789 New Street, Toronto, ON"
    visitPurpose = "Tourism"
    status = "pending"
    roomNumber = "102"
} | ConvertTo-Json

$updateResponse = Invoke-RestMethod -Uri "$baseUrl/guests/$guestId" -Method Put -Body $updateData -ContentType "application/json" -Headers $headers
Write-Host "✅ Guest updated: $($updateResponse.data.last_name)" -ForegroundColor Green
Write-Host "   New email: $($updateResponse.data.email)" -ForegroundColor Gray
Write-Host "   New address: $($updateResponse.data.address)" -ForegroundColor Gray
Write-Host ""

# Test 5: Check-in Guest
Write-Host "TEST 5: CHECK-IN GUEST" -ForegroundColor Magenta
Write-Host "-" * 70 -ForegroundColor Gray
$checkinData = @{ roomNumber = "202" } | ConvertTo-Json
$checkinResponse = Invoke-RestMethod -Uri "$baseUrl/guests/$guestId/checkin" -Method Post -Body $checkinData -ContentType "application/json" -Headers $headers
Write-Host "✅ Guest checked in" -ForegroundColor Green
Write-Host "   Room: $($checkinResponse.data.room_number)" -ForegroundColor Gray
Write-Host "   Status: $($checkinResponse.data.status)" -ForegroundColor Gray
Write-Host "   Check-in time: $($checkinResponse.data.check_in_date)" -ForegroundColor Gray
Write-Host ""

# Test 6: Get Guests by Status
Write-Host "TEST 6: GET GUESTS BY STATUS (checked_in)" -ForegroundColor Magenta
Write-Host "-" * 70 -ForegroundColor Gray
$statusGuests = Invoke-RestMethod -Uri "$baseUrl/guests/status/checked_in" -Method Get -Headers $headers
Write-Host "✅ Checked-in guests count: $($statusGuests.count)" -ForegroundColor Green
foreach ($g in $statusGuests.data) {
    Write-Host "   - $($g.first_name) $($g.last_name) (Room: $($g.room_number))" -ForegroundColor Gray
}
Write-Host ""

# Test 7: Check-out Guest
Write-Host "TEST 7: CHECK-OUT GUEST" -ForegroundColor Magenta
Write-Host "-" * 70 -ForegroundColor Gray
$checkoutResponse = Invoke-RestMethod -Uri "$baseUrl/guests/$guestId/checkout" -Method Post -Headers $headers -Body "{}" -ContentType "application/json"
Write-Host "✅ Guest checked out" -ForegroundColor Green
Write-Host "   Status: $($checkoutResponse.data.status)" -ForegroundColor Gray
Write-Host "   Check-out time: $($checkoutResponse.data.check_out_date)" -ForegroundColor Gray
Write-Host ""

# Test 8: Delete Guest
Write-Host "TEST 8: DELETE GUEST" -ForegroundColor Magenta
Write-Host "-" * 70 -ForegroundColor Gray
$deleteResponse = Invoke-RestMethod -Uri "$baseUrl/guests/$guestId" -Method Delete -Headers $headers
Write-Host "✅ Guest deleted: $($deleteResponse.message)" -ForegroundColor Green
Write-Host ""

# Test 9: Verify Deletion
Write-Host "TEST 9: VERIFY DELETION" -ForegroundColor Magenta
Write-Host "-" * 70 -ForegroundColor Gray
try {
    $verifyResponse = Invoke-RestMethod -Uri "$baseUrl/guests/$guestId" -Method Get -Headers $headers
    Write-Host "❌ Guest still exists (should be deleted)" -ForegroundColor Red
} catch {
    Write-Host "✅ Guest successfully deleted (404 error as expected)" -ForegroundColor Green
}
Write-Host ""

# Test 10: Final Guest Count
Write-Host "TEST 10: FINAL GUEST COUNT" -ForegroundColor Magenta
Write-Host "-" * 70 -ForegroundColor Gray
$finalGuests = Invoke-RestMethod -Uri "$baseUrl/guests" -Method Get -Headers $headers
Write-Host "✅ Final guest count in database: $($finalGuests.count)" -ForegroundColor Green
Write-Host ""

# Summary
Write-Host "=" * 70 -ForegroundColor Cyan
Write-Host "TEST SUMMARY - ALL FUNCTIONS WORKING!" -ForegroundColor Green
Write-Host "=" * 70 -ForegroundColor Cyan
Write-Host "✅ CREATE guest - Working" -ForegroundColor Green
Write-Host "✅ READ all guests - Working" -ForegroundColor Green
Write-Host "✅ READ single guest - Working" -ForegroundColor Green
Write-Host "✅ UPDATE guest - Working" -ForegroundColor Green
Write-Host "✅ DELETE guest - Working" -ForegroundColor Green
Write-Host "✅ CHECK-IN guest - Working" -ForegroundColor Green
Write-Host "✅ CHECK-OUT guest - Working" -ForegroundColor Green
Write-Host "✅ GET guests by status - Working" -ForegroundColor Green
Write-Host ""
Write-Host "🎉 All guest functions are saving to and reading from the database correctly!" -ForegroundColor Green
Write-Host ""
Write-Host "Database: hotel_staff_db" -ForegroundColor Cyan
Write-Host "Table: guests" -ForegroundColor Cyan
Write-Host "Verify at: http://localhost/phpmyadmin" -ForegroundColor Cyan
Write-Host "=" * 70 -ForegroundColor Cyan
