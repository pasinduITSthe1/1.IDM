import React, { useEffect, useState } from 'react'
import { useNavigate } from 'react-router-dom'
import {
  Box,
  Container,
  Grid,
  Card,
  CardContent,
  Typography,
  IconButton,
  Avatar,
  Menu,
  MenuItem,
  CircularProgress,
  Alert,
  Chip,
  Stack,
} from '@mui/material'
import {
  Logout,
  PersonAdd,
  Login as LoginIcon,
  MeetingRoom,
  People,
  QrCodeScanner,
  Hotel,
  Settings,
  Notifications,
  TrendingUp,
  CheckCircle,
  Schedule,
  EventAvailable,
} from '@mui/icons-material'
import { dashboardService, handleApiError } from '../api/qloAppsClient'

export default function Dashboard({ onLogout }) {
  const navigate = useNavigate()
  const [anchorEl, setAnchorEl] = React.useState(null)
  const [stats, setStats] = useState({
    todayCheckIns: 0,
    todayCheckOuts: 0,
    activeGuests: 0,
    pendingActions: 0,
  })
  const [loading, setLoading] = useState(true)
  const [error, setError] = useState(null)

  const user = JSON.parse(localStorage.getItem('hotelStaffUser') || '{}')
  const isDemo = user.mode === 'demo'

  // Fetch dashboard stats
  useEffect(() => {
    const fetchStats = async () => {
      if (isDemo) {
        // Use demo data
        setStats({
          todayCheckIns: 12,
          todayCheckOuts: 8,
          activeGuests: 45,
          pendingActions: 3,
        })
        setLoading(false)
        return
      }

      try {
        setLoading(true)
        const response = await dashboardService.getStats()
        if (response.success) {
          setStats(response.data)
        }
        setLoading(false)
      } catch (err) {
        console.error('Failed to fetch stats:', err)
        const { error: errorMsg } = handleApiError(err)
        setError(errorMsg)
        setLoading(false)
        
        // Use fallback data
        setStats({
          todayCheckIns: 0,
          todayCheckOuts: 0,
          activeGuests: 0,
          pendingActions: 0,
        })
      }
    }

    fetchStats()
  }, [isDemo])

  const handleMenu = (event) => {
    setAnchorEl(event.currentTarget)
  }

  const handleClose = () => {
    setAnchorEl(null)
  }

  const handleLogout = () => {
    handleClose()
    onLogout()
    navigate('/login')
  }

  const quickActions = [
    {
      title: 'Scan Document',
      icon: <QrCodeScanner />,
      path: '/scan',
      gradient: 'linear-gradient(135deg, #FF6B35 0%, #F7931E 100%)',
      description: 'Quick ID scan',
    },
    {
      title: 'Register',
      icon: <PersonAdd />,
      path: '/register',
      gradient: 'linear-gradient(135deg, #4CAF50 0%, #81C784 100%)',
      description: 'Add guest',
    },
    {
      title: 'Check-In',
      icon: <LoginIcon />,
      path: '/check-in',
      gradient: 'linear-gradient(135deg, #2196F3 0%, #64B5F6 100%)',
      description: 'Arrival',
    },
    {
      title: 'Check-Out',
      icon: <MeetingRoom />,
      path: '/check-out',
      gradient: 'linear-gradient(135deg, #FFA726 0%, #FFB74D 100%)',
      description: 'Departure',
    },
  ]

  const StatCard = ({ value, label, icon, color, trend }) => (
    <Card 
      elevation={0}
      sx={{ 
        height: '100%',
        background: 'linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%)',
        border: '1px solid #e0e0e0',
        borderRadius: 3,
        transition: 'all 0.3s ease',
        '&:hover': {
          transform: 'translateY(-4px)',
          boxShadow: '0 12px 24px rgba(0,0,0,0.08)'
        }
      }}
    >
      <CardContent>
        <Box sx={{ display: 'flex', alignItems: 'flex-start', justifyContent: 'space-between' }}>
          <Box>
            <Typography variant="body2" color="text.secondary" sx={{ mb: 1, fontWeight: 500 }}>
              {label}
            </Typography>
            <Typography variant="h4" sx={{ fontWeight: 700, color: color, mb: 1 }}>
              {loading ? <CircularProgress size={24} /> : value}
            </Typography>
            {trend && (
              <Box sx={{ display: 'flex', alignItems: 'center', gap: 0.5 }}>
                <TrendingUp sx={{ fontSize: 16, color: '#10b981' }} />
                <Typography variant="caption" sx={{ color: '#10b981', fontWeight: 600 }}>
                  {trend}
                </Typography>
              </Box>
            )}
          </Box>
          <Avatar sx={{ bgcolor: color, width: 48, height: 48 }}>
            {icon}
          </Avatar>
        </Box>
      </CardContent>
    </Card>
  )

  return (
    <Box sx={{ minHeight: '100vh', bgcolor: '#f5f7fa' }}>
      {/* Premium Header */}
      <Box 
        sx={{ 
          background: 'linear-gradient(135deg, #FF6B35 0%, #F7931E 100%)',
          color: 'white',
          pt: 3,
          pb: 8,
          px: 3,
        }}
      >
        <Container maxWidth="lg">
          <Box sx={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', mb: 3 }}>
            <Box sx={{ display: 'flex', alignItems: 'center', gap: 2 }}>
              <Avatar sx={{ width: 64, height: 64, bgcolor: 'rgba(255,255,255,0.25)', backdropFilter: 'blur(10px)' }}>
                <Hotel sx={{ fontSize: 36 }} />
              </Avatar>
              <Box>
                <Typography variant="h5" sx={{ fontWeight: 700, mb: 0.5 }}>
                  ITSthe1 Hotel
                </Typography>
                <Typography variant="body2" sx={{ opacity: 0.9 }}>
                  Welcome, {user.firstname || user.name || 'Staff'}
                </Typography>
              </Box>
            </Box>
            <Stack direction="row" spacing={1}>
              <IconButton sx={{ color: 'white' }}>
                <Notifications />
              </IconButton>
              <IconButton sx={{ color: 'white' }} onClick={handleMenu}>
                <Settings />
              </IconButton>
              <Menu
                anchorEl={anchorEl}
                open={Boolean(anchorEl)}
                onClose={handleClose}
              >
                <MenuItem disabled>
                  <Typography variant="body2">
                    {user.email || 'staff@hotel.com'}
                  </Typography>
                </MenuItem>
                <MenuItem onClick={handleLogout}>
                  <Logout sx={{ mr: 1 }} fontSize="small" />
                  Logout
                </MenuItem>
              </Menu>
            </Stack>
          </Box>
          
          {isDemo && (
            <Chip 
              label="Demo Mode" 
              size="small" 
              sx={{ 
                bgcolor: 'rgba(255,255,255,0.25)', 
                color: 'white',
                fontWeight: 600,
                backdropFilter: 'blur(10px)',
              }} 
            />
          )}
        </Container>
      </Box>

      <Container maxWidth="lg" sx={{ mt: -5, pb: 4 }}>
        {/* Statistics Cards */}
        <Grid container spacing={3} sx={{ mb: 4 }}>
          <Grid item xs={6} md={3}>
            <StatCard 
              value={stats.todayCheckIns} 
              label="Check-ins" 
              icon={<CheckCircle />}
              color="#FF6B35"
              trend="+12%"
            />
          </Grid>
          <Grid item xs={6} md={3}>
            <StatCard 
              value={stats.activeGuests} 
              label="Active Guests" 
              icon={<People />}
              color="#2196F3"
              trend="+8%"
            />
          </Grid>
          <Grid item xs={6} md={3}>
            <StatCard 
              value={stats.todayCheckOuts} 
              label="Check-outs" 
              icon={<Schedule />}
              color="#4CAF50"
            />
          </Grid>
          <Grid item xs={6} md={3}>
            <StatCard 
              value={stats.pendingActions} 
              label="Pending" 
              icon={<EventAvailable />}
              color="#FFA726"
            />
          </Grid>
        </Grid>

        {/* Quick Actions */}
        <Typography variant="h6" sx={{ fontWeight: 700, mb: 3, color: '#1e293b' }}>
          Quick Actions
        </Typography>
        
        <Grid container spacing={2} sx={{ mb: 4 }}>
          {quickActions.map((action, index) => (
            <Grid item xs={6} sm={4} md={3} key={index}>
              <Card
                onClick={() => navigate(action.path)}
                elevation={0}
                sx={{
                  height: 110,
                  background: action.gradient,
                  color: 'white',
                  cursor: 'pointer',
                  borderRadius: 2.5,
                  transition: 'all 0.3s ease',
                  border: 'none',
                  '&:hover': {
                    transform: 'translateY(-4px) scale(1.02)',
                    boxShadow: '0 12px 24px rgba(0,0,0,0.15)'
                  },
                  '&:active': {
                    transform: 'translateY(-2px) scale(1.01)',
                  }
                }}
              >
                <CardContent sx={{ 
                  height: '100%', 
                  display: 'flex', 
                  flexDirection: 'column',
                  justifyContent: 'space-between',
                  p: 2
                }}>
                  <Avatar sx={{ bgcolor: 'rgba(255,255,255,0.25)', width: 36, height: 36, backdropFilter: 'blur(10px)' }}>
                    {React.cloneElement(action.icon, { sx: { fontSize: 20 } })}
                  </Avatar>
                  <Box>
                    <Typography variant="subtitle2" sx={{ fontWeight: 700, mb: 0.2, fontSize: '0.9rem' }}>
                      {action.title}
                    </Typography>
                    <Typography variant="caption" sx={{ opacity: 0.85, fontSize: '0.7rem' }}>
                      {action.description}
                    </Typography>
                  </Box>
                </CardContent>
              </Card>
            </Grid>
          ))}
        </Grid>

        {/* Guest List Card */}
        <Card 
          elevation={0}
          sx={{ 
            border: '1px solid #e0e0e0',
            borderRadius: 3,
            cursor: 'pointer',
            transition: 'all 0.3s ease',
            '&:hover': {
              transform: 'translateY(-2px)',
              boxShadow: '0 8px 16px rgba(0,0,0,0.08)'
            }
          }}
          onClick={() => navigate('/guests')}
        >
          <CardContent sx={{ p: 3 }}>
            <Box sx={{ display: 'flex', alignItems: 'center', justifyContent: 'space-between' }}>
              <Box sx={{ display: 'flex', alignItems: 'center', gap: 2 }}>
                <Avatar sx={{ bgcolor: '#f0f0f0', width: 56, height: 56 }}>
                  <People sx={{ color: '#FF6B35', fontSize: 32 }} />
                </Avatar>
                <Box>
                  <Typography variant="h6" sx={{ fontWeight: 700 }}>
                    View Guest List
                  </Typography>
                  <Typography variant="body2" color="text.secondary">
                    Manage all registered guests
                  </Typography>
                </Box>
              </Box>
              <Typography 
                variant="button" 
                sx={{ 
                  color: '#FF6B35', 
                  fontWeight: 600,
                  textTransform: 'none'
                }}
              >
                View All →
              </Typography>
            </Box>
          </CardContent>
        </Card>
      </Container>
    </Box>
  )
}
