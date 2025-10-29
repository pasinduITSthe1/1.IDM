# Add firewall rule for QloApps API access
Write-Host "Adding firewall rule for port 80..." -ForegroundColor Yellow

# Remove old rule if exists
netsh advfirewall firewall delete rule name="QloApps API Port 80" 2>$null

# Add new rule
$result = netsh advfirewall firewall add rule name="QloApps API Port 80" dir=in action=allow protocol=TCP localport=80 profile=any

if ($LASTEXITCODE -eq 0) {
    Write-Host "`n✅ Firewall rule added successfully!" -ForegroundColor Green
    Write-Host "Port 80 is now accessible from your phone." -ForegroundColor Green
} else {
    Write-Host "`n❌ Failed to add firewall rule." -ForegroundColor Red
    Write-Host "Error: $result" -ForegroundColor Red
}

Write-Host "`nPress any key to continue..."
$null = $Host.UI.RawUI.ReadKey("NoEcho,IncludeKeyDown")
