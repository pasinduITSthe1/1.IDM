import React, { useState } from 'react'
import {
  Box,
  Card,
  CardContent,
  TextField,
  Button,
  Typography,
  Alert,
  InputAdornment,
  IconButton,
  Chip,
  Avatar,
  Container,
  Stack,
  Divider,
} from '@mui/material'
import { Visibility, VisibilityOff, Email, Lock, Hotel, CloudDone, CloudOff } from '@mui/icons-material'
import { authService, handleApiError } from '../api/qloAppsClient'

export default function Login({ onLogin }) {
  const [email, setEmail] = useState('')
  const [password, setPassword] = useState('')
  const [showPassword, setShowPassword] = useState(false)
  const [error, setError] = useState('')
  const [loading, setLoading] = useState(false)
  const [useDemoMode, setUseDemoMode] = useState(false)

  const handleSubmit = async (e) => {
    e.preventDefault()
    setError('')
    setLoading(true)

    // Simple validation
    if (!email || !password) {
      setError('Please enter both email and password')
      setLoading(false)
      return
    }

    try {
      if (useDemoMode) {
        // Demo mode - offline testing
        if (email === 'staff@hotel.com' && password === 'demo123') {
          localStorage.setItem('hotelStaffToken', 'demo-token-' + Date.now())
          localStorage.setItem('hotelStaffUser', JSON.stringify({
            id: 1,
            firstname: 'Demo',
            lastname: 'Staff',
            name: 'Demo Staff',
            email: 'staff@hotel.com',
            role: 'receptionist',
            mode: 'demo',
          }))
          onLogin()
        } else {
          setError('Invalid credentials. Use: staff@hotel.com / demo123')
        }
        setLoading(false)
      } else {
        // Real QloApps login
        try {
          const result = await authService.login(email, password)
          if (result.success) {
            onLogin()
          } else {
            setError('Login failed. Please check your credentials.')
          }
          setLoading(false)
        } catch (apiError) {
          console.error('API Login error:', apiError)
          // If API fails, suggest demo mode
          setError('Cannot connect to QloApps server. Please switch to Demo Mode or check your connection.')
          setLoading(false)
        }
      }
    } catch (err) {
      console.error('Login error:', err)
      const { error: errorMsg } = handleApiError(err)
      setError(errorMsg || 'Login failed. Please switch to Demo Mode to test offline.')
      setLoading(false)
    }
  }

  return (
    <Box
      sx={{
        minHeight: '100vh',
        background: 'linear-gradient(135deg, #FF6B35 0%, #F7931E 100%)',
        display: 'flex',
        alignItems: 'center',
        py: 4,
      }}
    >
      <Container maxWidth="sm">
        {/* Elegant Card */}
        <Card 
          elevation={24}
          sx={{ 
            borderRadius: 4,
            overflow: 'hidden',
            backdropFilter: 'blur(10px)',
          }}
        >
          {/* Header with Gradient */}
          <Box 
            sx={{ 
              background: 'linear-gradient(135deg, #FF6B35 0%, #F7931E 100%)',
              color: 'white',
              p: 4,
              textAlign: 'center',
              position: 'relative',
            }}
          >
            <Avatar 
              sx={{ 
                width: 90, 
                height: 90, 
                bgcolor: 'rgba(255,255,255,0.25)',
                margin: '0 auto',
                mb: 2.5,
                backdropFilter: 'blur(10px)',
              }}
            >
              <Hotel sx={{ fontSize: 52 }} />
            </Avatar>
            <Typography variant="h3" sx={{ fontWeight: 800, mb: 1, letterSpacing: 1 }}>
              ITSthe1
            </Typography>
            <Typography variant="subtitle1" sx={{ opacity: 0.95, fontWeight: 300 }}>
              Hotel Staff Portal
            </Typography>
          </Box>

          <CardContent sx={{ p: 4 }}>
            {/* Mode Toggle */}
            <Stack direction="row" spacing={2} sx={{ mb: 3 }}>
              <Chip
                icon={<CloudDone />}
                label="Online"
                onClick={() => setUseDemoMode(false)}
                color={!useDemoMode ? 'primary' : 'default'}
                variant={!useDemoMode ? 'filled' : 'outlined'}
                sx={{ 
                  flex: 1, 
                  py: 2.5, 
                  fontSize: '0.95rem',
                  fontWeight: 600,
                  cursor: 'pointer',
                  borderWidth: 2,
                  transition: 'all 0.3s ease',
                  '&:hover': {
                    transform: 'scale(1.05)',
                  }
                }}
              />
              <Chip
                icon={<CloudOff />}
                label="Demo"
                onClick={() => setUseDemoMode(true)}
                color={useDemoMode ? 'secondary' : 'default'}
                variant={useDemoMode ? 'filled' : 'outlined'}
                sx={{ 
                  flex: 1, 
                  py: 2.5, 
                  fontSize: '0.95rem',
                  fontWeight: 600,
                  cursor: 'pointer',
                  borderWidth: 2,
                  transition: 'all 0.3s ease',
                  '&:hover': {
                    transform: 'scale(1.05)',
                  }
                }}
              />
            </Stack>

            {error && (
              <Alert severity="error" sx={{ mb: 3, borderRadius: 2 }}>
                {error}
              </Alert>
            )}

            {useDemoMode && (
              <Alert 
                severity="info" 
                sx={{ 
                  mb: 3, 
                  borderRadius: 2,
                  bgcolor: '#e3f2fd',
                  '& .MuiAlert-icon': {
                    color: '#1976d2'
                  }
                }}
              >
                <strong>Demo Credentials</strong><br />
                staff@hotel.com / demo123
              </Alert>
            )}

            <form onSubmit={handleSubmit}>
              <TextField
                fullWidth
                label="Email Address"
                type="email"
                value={email}
                onChange={(e) => setEmail(e.target.value)}
                autoComplete="email"
                autoFocus
                disabled={loading}
                sx={{ 
                  mb: 2.5,
                  '& .MuiOutlinedInput-root': {
                    borderRadius: 2,
                  }
                }}
                InputProps={{
                  startAdornment: (
                    <InputAdornment position="start">
                      <Email color="action" />
                    </InputAdornment>
                  ),
                }}
              />

              <TextField
                fullWidth
                label="Password"
                type={showPassword ? 'text' : 'password'}
                value={password}
                onChange={(e) => setPassword(e.target.value)}
                autoComplete="current-password"
                disabled={loading}
                sx={{ 
                  mb: 3,
                  '& .MuiOutlinedInput-root': {
                    borderRadius: 2,
                  }
                }}
                InputProps={{
                  startAdornment: (
                    <InputAdornment position="start">
                      <Lock color="action" />
                    </InputAdornment>
                  ),
                  endAdornment: (
                    <InputAdornment position="end">
                      <IconButton
                        onClick={() => setShowPassword(!showPassword)}
                        edge="end"
                      >
                        {showPassword ? <VisibilityOff /> : <Visibility />}
                      </IconButton>
                    </InputAdornment>
                  ),
                }}
              />

              <Button
                type="submit"
                fullWidth
                variant="contained"
                size="large"
                disabled={loading}
                sx={{ 
                  py: 1.8,
                  fontSize: '1.05rem',
                  fontWeight: 700,
                  borderRadius: 2,
                  textTransform: 'none',
                  background: 'linear-gradient(135deg, #FF6B35 0%, #F7931E 100%)',
                  boxShadow: '0 8px 20px rgba(255, 107, 53, 0.35)',
                  transition: 'all 0.3s ease',
                  '&:hover': {
                    background: 'linear-gradient(135deg, #E55A2B 0%, #E07A10 100%)',
                    transform: 'translateY(-2px)',
                    boxShadow: '0 12px 28px rgba(255, 107, 53, 0.45)',
                  },
                  '&:active': {
                    transform: 'translateY(0px)',
                  }
                }}
              >
                {loading ? 'Signing in...' : 'Sign In'}
              </Button>
            </form>

            <Divider sx={{ my: 3 }} />

            <Box 
              sx={{ 
                textAlign: 'center',
                p: 2.5,
                bgcolor: '#f8f9fa',
                borderRadius: 2,
              }}
            >
              <Typography variant="caption" color="text.secondary" sx={{ display: 'block', lineHeight: 1.6 }}>
                <strong>Online Mode:</strong> Connect to QloApps<br />
                <strong>Demo Mode:</strong> Test with sample data
              </Typography>
            </Box>
          </CardContent>
        </Card>

        {/* Footer */}
        <Typography 
          variant="body2" 
          sx={{ 
            textAlign: 'center', 
            mt: 3, 
            color: 'white',
            opacity: 0.95,
            fontWeight: 300,
          }}
        >
          © 2025 ITSthe1 Hotel. All rights reserved.
        </Typography>
      </Container>
    </Box>
  )
}
