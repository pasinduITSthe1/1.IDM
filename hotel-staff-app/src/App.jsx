import React from 'react'
import { BrowserRouter, Routes, Route, Navigate } from 'react-router-dom'
import { ThemeProvider, createTheme } from '@mui/material/styles'
import { CssBaseline } from '@mui/material'

// Pages
import Login from './pages/Login'
import Dashboard from './pages/Dashboard'
import ScanDocument from './pages/ScanDocument'
import GuestRegistration from './pages/GuestRegistration'
import CheckIn from './pages/CheckIn'
import CheckOut from './pages/CheckOut'
import GuestList from './pages/GuestList'
import GuestDetails from './pages/GuestDetails'

// Create ITSthe1 branded theme
const theme = createTheme({
  palette: {
    primary: {
      main: '#FF6B35', // ITSthe1 Orange
      light: '#FF8A5B',
      dark: '#E54E1F',
      contrastText: '#ffffff',
    },
    secondary: {
      main: '#1A1A2E', // ITSthe1 Dark Blue/Black
      light: '#2A2A3E',
      dark: '#0A0A1E',
      contrastText: '#ffffff',
    },
    background: {
      default: '#F5F7FA',
      paper: '#FFFFFF',
    },
    success: {
      main: '#4CAF50',
    },
    warning: {
      main: '#FF9800',
    },
    error: {
      main: '#F44336',
    },
  },
  typography: {
    fontFamily: '"Roboto", "Helvetica", "Arial", sans-serif',
    h4: {
      fontWeight: 700,
      fontSize: '1.75rem',
    },
    h5: {
      fontWeight: 600,
      fontSize: '1.5rem',
    },
    h6: {
      fontWeight: 600,
      fontSize: '1.25rem',
    },
    button: {
      textTransform: 'none',
      fontWeight: 600,
    },
  },
  shape: {
    borderRadius: 12,
  },
  components: {
    MuiButton: {
      styleOverrides: {
        root: {
          borderRadius: 12,
          padding: '12px 24px',
          fontSize: '1rem',
          boxShadow: 'none',
          '&:hover': {
            boxShadow: '0 4px 12px rgba(255, 107, 53, 0.3)',
          },
        },
        contained: {
          '&:active': {
            transform: 'scale(0.98)',
          },
        },
      },
    },
    MuiCard: {
      styleOverrides: {
        root: {
          boxShadow: '0 2px 8px rgba(0, 0, 0, 0.08)',
          borderRadius: 16,
        },
      },
    },
    MuiTextField: {
      styleOverrides: {
        root: {
          '& .MuiOutlinedInput-root': {
            borderRadius: 12,
          },
        },
      },
    },
  },
})

function App() {
  const [isAuthenticated, setIsAuthenticated] = React.useState(false)

  React.useEffect(() => {
    // Check if user is logged in
    const token = localStorage.getItem('hotelStaffToken')
    setIsAuthenticated(!!token)
  }, [])

  const handleLogin = () => {
    setIsAuthenticated(true)
  }

  const handleLogout = () => {
    localStorage.removeItem('hotelStaffToken')
    localStorage.removeItem('hotelStaffUser')
    setIsAuthenticated(false)
  }

  return (
    <ThemeProvider theme={theme}>
      <CssBaseline />
      <BrowserRouter>
        <Routes>
          {!isAuthenticated ? (
            <>
              <Route path="/login" element={<Login onLogin={handleLogin} />} />
              <Route path="*" element={<Navigate to="/login" replace />} />
            </>
          ) : (
            <>
              <Route path="/" element={<Dashboard onLogout={handleLogout} />} />
              <Route path="/scan" element={<ScanDocument />} />
              <Route path="/register" element={<GuestRegistration />} />
              <Route path="/check-in" element={<CheckIn />} />
              <Route path="/check-out" element={<CheckOut />} />
              <Route path="/guests" element={<GuestList />} />
              <Route path="/guest/:id" element={<GuestDetails />} />
              <Route path="*" element={<Navigate to="/" replace />} />
            </>
          )}
        </Routes>
      </BrowserRouter>
    </ThemeProvider>
  )
}

export default App
