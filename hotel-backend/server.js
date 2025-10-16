const express = require('express');
const cors = require('cors');
const bodyParser = require('body-parser');
require('dotenv').config();

const app = express();
const PORT = process.env.PORT || 3000;

// Middleware
app.use(cors());
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: true }));

// Request logging
app.use((req, res, next) => {
  console.log(`${new Date().toISOString()} - ${req.method} ${req.path}`);
  next();
});

// Routes
app.use('/api/auth', require('./routes/auth'));
app.use('/api/guests', require('./routes/guests'));
app.use('/api/rooms', require('./routes/rooms'));

// Health check route
app.get('/api/health', (req, res) => {
  res.json({
    success: true,
    message: 'Hotel Staff API is running',
    timestamp: new Date().toISOString()
  });
});

// Root route
app.get('/', (req, res) => {
  res.json({
    success: true,
    message: 'Welcome to Hotel Staff Management API',
    version: '1.0.0',
    endpoints: {
      health: '/api/health',
      auth: '/api/auth',
      guests: '/api/guests',
      rooms: '/api/rooms'
    }
  });
});

// 404 handler
app.use((req, res) => {
  res.status(404).json({
    success: false,
    message: 'Route not found'
  });
});

// Error handler
app.use((err, req, res, next) => {
  console.error('Error:', err);
  res.status(500).json({
    success: false,
    message: 'Internal server error',
    error: process.env.NODE_ENV === 'development' ? err.message : undefined
  });
});

// Start server - Listen on all network interfaces for physical device access
app.listen(PORT, '0.0.0.0', () => {
  console.log('╔════════════════════════════════════════════════════════╗');
  console.log('║                                                        ║');
  console.log('║        🏨 Hotel Staff Management API Server           ║');
  console.log('║                                                        ║');
  console.log('╚════════════════════════════════════════════════════════╝');
  console.log('');
  console.log(`✅ Server running on port ${PORT}`);
  console.log(`🌍 Local: http://localhost:${PORT}`);
  console.log(`📱 Network: http://10.0.1.24:${PORT}`);
  console.log(`📚 Environment: ${process.env.NODE_ENV}`);
  console.log('');
  console.log('Available endpoints:');
  console.log(`  - GET  /api/health`);
  console.log(`  - POST /api/auth/login`);
  console.log(`  - POST /api/auth/register`);
  console.log(`  - GET  /api/guests`);
  console.log(`  - POST /api/guests`);
  console.log(`  - GET  /api/rooms`);
  console.log('');
});

module.exports = app;
