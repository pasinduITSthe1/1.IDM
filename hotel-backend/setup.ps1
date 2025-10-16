# Hotel Backend Setup Script
# Run this script to set up the backend

Write-Host "╔════════════════════════════════════════════════════════╗" -ForegroundColor Cyan
Write-Host "║                                                        ║" -ForegroundColor Cyan
Write-Host "║        🏨 Hotel Backend Setup Script                  ║" -ForegroundColor Cyan
Write-Host "║                                                        ║" -ForegroundColor Cyan
Write-Host "╚════════════════════════════════════════════════════════╝" -ForegroundColor Cyan
Write-Host ""

# Check if Node.js is installed
Write-Host "🔍 Checking Node.js installation..." -ForegroundColor Yellow
try {
    $nodeVersion = node --version
    Write-Host "✅ Node.js is installed: $nodeVersion" -ForegroundColor Green
} catch {
    Write-Host "❌ Node.js is not installed!" -ForegroundColor Red
    Write-Host "Please install Node.js from: https://nodejs.org/" -ForegroundColor Yellow
    exit 1
}

# Check if npm is installed
Write-Host "🔍 Checking npm installation..." -ForegroundColor Yellow
try {
    $npmVersion = npm --version
    Write-Host "✅ npm is installed: $npmVersion" -ForegroundColor Green
} catch {
    Write-Host "❌ npm is not installed!" -ForegroundColor Red
    exit 1
}

Write-Host ""
Write-Host "📦 Installing dependencies..." -ForegroundColor Yellow
npm install

if ($LASTEXITCODE -eq 0) {
    Write-Host "✅ Dependencies installed successfully!" -ForegroundColor Green
} else {
    Write-Host "❌ Failed to install dependencies!" -ForegroundColor Red
    exit 1
}

Write-Host ""
Write-Host "🗄️  Initializing database..." -ForegroundColor Yellow
Write-Host "⚠️  Make sure MySQL/WAMP is running!" -ForegroundColor Yellow
Write-Host ""

$response = Read-Host "Is MySQL running? (y/n)"
if ($response -ne 'y') {
    Write-Host "Please start MySQL/WAMP and run this script again." -ForegroundColor Yellow
    exit 0
}

npm run init-db

if ($LASTEXITCODE -eq 0) {
    Write-Host ""
    Write-Host "╔════════════════════════════════════════════════════════╗" -ForegroundColor Green
    Write-Host "║                                                        ║" -ForegroundColor Green
    Write-Host "║          ✅ Setup completed successfully!              ║" -ForegroundColor Green
    Write-Host "║                                                        ║" -ForegroundColor Green
    Write-Host "╚════════════════════════════════════════════════════════╝" -ForegroundColor Green
    Write-Host ""
    Write-Host "📝 Next steps:" -ForegroundColor Cyan
    Write-Host "  1. Run: npm start" -ForegroundColor White
    Write-Host "  2. Test: http://localhost:3000/api/health" -ForegroundColor White
    Write-Host "  3. Login with: admin / admin123" -ForegroundColor White
    Write-Host ""
} else {
    Write-Host ""
    Write-Host "❌ Database initialization failed!" -ForegroundColor Red
    Write-Host "Please check your .env file and MySQL connection." -ForegroundColor Yellow
    Write-Host ""
}
