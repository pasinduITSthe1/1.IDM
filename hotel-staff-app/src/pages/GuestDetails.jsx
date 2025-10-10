import React, { useState, useEffect } from 'react'
import { useNavigate, useParams } from 'react-router-dom'
import {
  Box,
  Container,
  AppBar,
  Toolbar,
  IconButton,
  Typography,
  Card,
  CardContent,
  Grid,
  Chip,
  Button,
  Divider,
  Avatar,
  Alert,
} from '@mui/material'
import {
  ArrowBack,
  Edit,
  Login as LoginIcon,
  ExitToApp,
  Delete,
} from '@mui/icons-material'
import { format } from 'date-fns'

export default function GuestDetails() {
  const navigate = useNavigate()
  const { id } = useParams()

  const [guest, setGuest] = useState(null)
  const [loading, setLoading] = useState(true)

  useEffect(() => {
    const storedGuests = JSON.parse(localStorage.getItem('hotelGuests') || '[]')
    const foundGuest = storedGuests.find(g => g.id === parseInt(id))
    
    setGuest(foundGuest)
    setLoading(false)
  }, [id])

  const handleCheckIn = () => {
    navigate('/check-in', { state: { guestId: guest.id } })
  }

  const handleCheckOut = () => {
    navigate('/check-out')
  }

  const handleDelete = () => {
    if (window.confirm('Are you sure you want to delete this guest record?')) {
      const storedGuests = JSON.parse(localStorage.getItem('hotelGuests') || '[]')
      const updatedGuests = storedGuests.filter(g => g.id !== guest.id)
      localStorage.setItem('hotelGuests', JSON.stringify(updatedGuests))
      navigate('/guests')
    }
  }

  const getStatusColor = (status) => {
    const colors = {
      'registered': 'default',
      'checked-in': 'success',
      'checked-out': 'error',
    }
    return colors[status] || 'default'
  }

  const getStatusLabel = (status) => {
    const labels = {
      'registered': 'Registered',
      'checked-in': 'Checked In',
      'checked-out': 'Checked Out',
    }
    return labels[status] || status
  }

  if (loading) {
    return (
      <Box sx={{ display: 'flex', justifyContent: 'center', alignItems: 'center', minHeight: '100vh' }}>
        <Typography>Loading...</Typography>
      </Box>
    )
  }

  if (!guest) {
    return (
      <Box sx={{ minHeight: '100vh', bgcolor: 'background.default' }}>
        <AppBar position="static">
          <Toolbar>
            <IconButton edge="start" color="inherit" onClick={() => navigate(-1)}>
              <ArrowBack />
            </IconButton>
            <Typography variant="h6" sx={{ flexGrow: 1, ml: 2 }}>
              Guest Not Found
            </Typography>
          </Toolbar>
        </AppBar>
        <Container maxWidth="md" sx={{ py: 3 }}>
          <Alert severity="error">Guest not found</Alert>
        </Container>
      </Box>
    )
  }

  return (
    <Box sx={{ minHeight: '100vh', bgcolor: 'background.default' }}>
      <AppBar position="static">
        <Toolbar>
          <IconButton edge="start" color="inherit" onClick={() => navigate(-1)}>
            <ArrowBack />
          </IconButton>
          <Typography variant="h6" sx={{ flexGrow: 1, ml: 2, fontWeight: 600 }}>
            Guest Details
          </Typography>
        </Toolbar>
      </AppBar>

      <Container maxWidth="md" sx={{ py: 3 }}>
        {/* Guest Header */}
        <Card sx={{ mb: 3 }}>
          <CardContent>
            <Box sx={{ display: 'flex', alignItems: 'center', mb: 2 }}>
              <Avatar
                sx={{
                  width: 80,
                  height: 80,
                  bgcolor: 'primary.main',
                  fontSize: '2rem',
                  mr: 3,
                }}
              >
                {guest.firstName[0]}{guest.lastName[0]}
              </Avatar>
              <Box sx={{ flexGrow: 1 }}>
                <Typography variant="h5" fontWeight="700" gutterBottom>
                  {guest.firstName} {guest.lastName}
                </Typography>
                <Chip
                  label={getStatusLabel(guest.status)}
                  color={getStatusColor(guest.status)}
                  size="small"
                />
                {guest.roomNumber && (
                  <Chip
                    label={`Room ${guest.roomNumber}`}
                    color="primary"
                    size="small"
                    sx={{ ml: 1 }}
                  />
                )}
              </Box>
            </Box>
          </CardContent>
        </Card>

        {/* Quick Actions */}
        <Grid container spacing={2} sx={{ mb: 3 }}>
          {guest.status === 'registered' && (
            <Grid item xs={12}>
              <Button
                fullWidth
                variant="contained"
                size="large"
                startIcon={<LoginIcon />}
                onClick={handleCheckIn}
              >
                Check In Guest
              </Button>
            </Grid>
          )}
          {guest.status === 'checked-in' && (
            <Grid item xs={12}>
              <Button
                fullWidth
                variant="contained"
                size="large"
                startIcon={<ExitToApp />}
                onClick={handleCheckOut}
                color="warning"
              >
                Check Out Guest
              </Button>
            </Grid>
          )}
        </Grid>

        {/* Personal Information */}
        <Card sx={{ mb: 3 }}>
          <CardContent>
            <Typography variant="h6" gutterBottom fontWeight="600">
              Personal Information
            </Typography>
            <Divider sx={{ my: 2 }} />
            <Grid container spacing={2}>
              <Grid item xs={6}>
                <Typography variant="caption" color="text.secondary">Email</Typography>
                <Typography variant="body1">{guest.email}</Typography>
              </Grid>
              <Grid item xs={6}>
                <Typography variant="caption" color="text.secondary">Phone</Typography>
                <Typography variant="body1">{guest.phone}</Typography>
              </Grid>
              {guest.dateOfBirth && (
                <Grid item xs={6}>
                  <Typography variant="caption" color="text.secondary">Date of Birth</Typography>
                  <Typography variant="body1">{guest.dateOfBirth}</Typography>
                </Grid>
              )}
              {guest.nationality && (
                <Grid item xs={6}>
                  <Typography variant="caption" color="text.secondary">Nationality</Typography>
                  <Typography variant="body1">{guest.nationality}</Typography>
                </Grid>
              )}
            </Grid>
          </CardContent>
        </Card>

        {/* Document Information */}
        <Card sx={{ mb: 3 }}>
          <CardContent>
            <Typography variant="h6" gutterBottom fontWeight="600">
              Document Information
            </Typography>
            <Divider sx={{ my: 2 }} />
            <Grid container spacing={2}>
              <Grid item xs={6}>
                <Typography variant="caption" color="text.secondary">Document Type</Typography>
                <Typography variant="body1">{guest.documentType || 'N/A'}</Typography>
              </Grid>
              <Grid item xs={6}>
                <Typography variant="caption" color="text.secondary">Document Number</Typography>
                <Typography variant="body1">{guest.documentNumber}</Typography>
              </Grid>
              {guest.documentExpiry && (
                <Grid item xs={6}>
                  <Typography variant="caption" color="text.secondary">Expiry Date</Typography>
                  <Typography variant="body1">{guest.documentExpiry}</Typography>
                </Grid>
              )}
            </Grid>
          </CardContent>
        </Card>

        {/* Address Information */}
        {(guest.address || guest.city || guest.country) && (
          <Card sx={{ mb: 3 }}>
            <CardContent>
              <Typography variant="h6" gutterBottom fontWeight="600">
                Address Information
              </Typography>
              <Divider sx={{ my: 2 }} />
              <Grid container spacing={2}>
                {guest.address && (
                  <Grid item xs={12}>
                    <Typography variant="caption" color="text.secondary">Street Address</Typography>
                    <Typography variant="body1">{guest.address}</Typography>
                  </Grid>
                )}
                {guest.city && (
                  <Grid item xs={6}>
                    <Typography variant="caption" color="text.secondary">City</Typography>
                    <Typography variant="body1">{guest.city}</Typography>
                  </Grid>
                )}
                {guest.country && (
                  <Grid item xs={6}>
                    <Typography variant="caption" color="text.secondary">Country</Typography>
                    <Typography variant="body1">{guest.country}</Typography>
                  </Grid>
                )}
                {guest.postalCode && (
                  <Grid item xs={6}>
                    <Typography variant="caption" color="text.secondary">Postal Code</Typography>
                    <Typography variant="body1">{guest.postalCode}</Typography>
                  </Grid>
                )}
              </Grid>
            </CardContent>
          </Card>
        )}

        {/* Stay Information */}
        {guest.checkInDate && (
          <Card sx={{ mb: 3 }}>
            <CardContent>
              <Typography variant="h6" gutterBottom fontWeight="600">
                Stay Information
              </Typography>
              <Divider sx={{ my: 2 }} />
              <Grid container spacing={2}>
                <Grid item xs={6}>
                  <Typography variant="caption" color="text.secondary">Check-In Date</Typography>
                  <Typography variant="body1">
                    {format(new Date(guest.checkInDate), 'MMM dd, yyyy')}
                  </Typography>
                </Grid>
                <Grid item xs={6}>
                  <Typography variant="caption" color="text.secondary">Check-Out Date</Typography>
                  <Typography variant="body1">
                    {guest.checkOutDate ? format(new Date(guest.checkOutDate), 'MMM dd, yyyy') : 'N/A'}
                  </Typography>
                </Grid>
                {guest.numberOfGuests && (
                  <Grid item xs={6}>
                    <Typography variant="caption" color="text.secondary">Number of Guests</Typography>
                    <Typography variant="body1">{guest.numberOfGuests}</Typography>
                  </Grid>
                )}
                {guest.specialRequests && (
                  <Grid item xs={12}>
                    <Typography variant="caption" color="text.secondary">Special Requests</Typography>
                    <Typography variant="body1">{guest.specialRequests}</Typography>
                  </Grid>
                )}
              </Grid>
            </CardContent>
          </Card>
        )}

        {/* Registration Info */}
        <Card sx={{ mb: 3 }}>
          <CardContent>
            <Typography variant="h6" gutterBottom fontWeight="600">
              Registration Information
            </Typography>
            <Divider sx={{ my: 2 }} />
            <Grid container spacing={2}>
              <Grid item xs={12}>
                <Typography variant="caption" color="text.secondary">Registered Date</Typography>
                <Typography variant="body1">
                  {format(new Date(guest.registeredDate), 'MMM dd, yyyy HH:mm')}
                </Typography>
              </Grid>
            </Grid>
          </CardContent>
        </Card>

        {/* Danger Zone */}
        <Card sx={{ borderColor: 'error.main', borderWidth: 1, borderStyle: 'solid' }}>
          <CardContent>
            <Typography variant="h6" gutterBottom fontWeight="600" color="error">
              Danger Zone
            </Typography>
            <Divider sx={{ my: 2 }} />
            <Typography variant="body2" color="text.secondary" sx={{ mb: 2 }}>
              Deleting a guest record is permanent and cannot be undone.
            </Typography>
            <Button
              variant="outlined"
              color="error"
              startIcon={<Delete />}
              onClick={handleDelete}
            >
              Delete Guest Record
            </Button>
          </CardContent>
        </Card>
      </Container>
    </Box>
  )
}
