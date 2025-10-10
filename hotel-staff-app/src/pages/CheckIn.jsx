import React, { useState, useEffect } from 'react'
import { useNavigate, useLocation } from 'react-router-dom'
import {
  Box,
  Container,
  AppBar,
  Toolbar,
  IconButton,
  Typography,
  TextField,
  Button,
  Paper,
  Grid,
  MenuItem,
  Alert,
  Card,
  CardContent,
  Autocomplete,
  Divider,
} from '@mui/material'
import {
  ArrowBack,
  CheckCircle,
  PersonAdd,
} from '@mui/icons-material'
import { format } from 'date-fns'

export default function CheckIn() {
  const navigate = useNavigate()
  const location = useLocation()
  const preSelectedGuestId = location.state?.guestId

  const [guests, setGuests] = useState([])
  const [selectedGuest, setSelectedGuest] = useState(null)
  const [checkInData, setCheckInData] = useState({
    roomNumber: '',
    checkInDate: format(new Date(), 'yyyy-MM-dd'),
    checkOutDate: '',
    numberOfGuests: 1,
    specialRequests: '',
  })
  const [errors, setErrors] = useState({})
  const [processing, setProcessing] = useState(false)
  const [success, setSuccess] = useState(false)

  useEffect(() => {
    // Load guests from localStorage
    const storedGuests = JSON.parse(localStorage.getItem('hotelGuests') || '[]')
    setGuests(storedGuests)

    // Pre-select guest if coming from registration
    if (preSelectedGuestId) {
      const guest = storedGuests.find(g => g.id === preSelectedGuestId)
      if (guest) {
        setSelectedGuest(guest)
      }
    }
  }, [preSelectedGuestId])

  const handleChange = (field) => (event) => {
    setCheckInData({
      ...checkInData,
      [field]: event.target.value,
    })
    if (errors[field]) {
      setErrors({ ...errors, [field]: null })
    }
  }

  const validateForm = () => {
    const newErrors = {}

    if (!selectedGuest) newErrors.guest = 'Please select a guest'
    if (!checkInData.roomNumber) newErrors.roomNumber = 'Room number is required'
    if (!checkInData.checkOutDate) newErrors.checkOutDate = 'Check-out date is required'

    setErrors(newErrors)
    return Object.keys(newErrors).length === 0
  }

  const handleCheckIn = async () => {
    if (!validateForm()) return

    setProcessing(true)
    setSuccess(false)

    // Simulate API call
    setTimeout(() => {
      // Update guest status
      const updatedGuests = guests.map(g => 
        g.id === selectedGuest.id
          ? {
              ...g,
              status: 'checked-in',
              checkInDate: checkInData.checkInDate,
              checkOutDate: checkInData.checkOutDate,
              roomNumber: checkInData.roomNumber,
              numberOfGuests: checkInData.numberOfGuests,
              specialRequests: checkInData.specialRequests,
            }
          : g
      )

      localStorage.setItem('hotelGuests', JSON.stringify(updatedGuests))

      setProcessing(false)
      setSuccess(true)

      setTimeout(() => {
        navigate('/')
      }, 2000)
    }, 1000)
  }

  return (
    <Box sx={{ minHeight: '100vh', bgcolor: 'background.default' }}>
      <AppBar position="static">
        <Toolbar>
          <IconButton edge="start" color="inherit" onClick={() => navigate(-1)}>
            <ArrowBack />
          </IconButton>
          <Typography variant="h6" sx={{ flexGrow: 1, ml: 2, fontWeight: 600 }}>
            Guest Check-In
          </Typography>
        </Toolbar>
      </AppBar>

      <Container maxWidth="md" sx={{ py: 3 }}>
        {success && (
          <Alert severity="success" sx={{ mb: 3 }}>
            Check-in completed successfully! Redirecting to dashboard...
          </Alert>
        )}

        <Paper sx={{ p: 3, mb: 3 }}>
          <Typography variant="h6" gutterBottom sx={{ mb: 3, fontWeight: 600 }}>
            Select Guest
          </Typography>

          <Autocomplete
            options={guests.filter(g => g.status === 'registered')}
            getOptionLabel={(option) => `${option.firstName} ${option.lastName} - ${option.documentNumber}`}
            value={selectedGuest}
            onChange={(event, newValue) => setSelectedGuest(newValue)}
            renderInput={(params) => (
              <TextField
                {...params}
                label="Search Guest"
                placeholder="Type to search..."
                error={!!errors.guest}
                helperText={errors.guest}
              />
            )}
          />

          <Button
            variant="outlined"
            startIcon={<PersonAdd />}
            sx={{ mt: 2 }}
            onClick={() => navigate('/register')}
          >
            Register New Guest
          </Button>
        </Paper>

        {selectedGuest && (
          <>
            <Card sx={{ mb: 3 }}>
              <CardContent>
                <Typography variant="h6" gutterBottom fontWeight="600">
                  Guest Information
                </Typography>
                <Divider sx={{ my: 2 }} />
                <Grid container spacing={2}>
                  <Grid item xs={6}>
                    <Typography variant="caption" color="text.secondary">Name</Typography>
                    <Typography variant="body1" fontWeight="600">
                      {selectedGuest.firstName} {selectedGuest.lastName}
                    </Typography>
                  </Grid>
                  <Grid item xs={6}>
                    <Typography variant="caption" color="text.secondary">Email</Typography>
                    <Typography variant="body1">{selectedGuest.email}</Typography>
                  </Grid>
                  <Grid item xs={6}>
                    <Typography variant="caption" color="text.secondary">Phone</Typography>
                    <Typography variant="body1">{selectedGuest.phone}</Typography>
                  </Grid>
                  <Grid item xs={6}>
                    <Typography variant="caption" color="text.secondary">Document</Typography>
                    <Typography variant="body1">{selectedGuest.documentNumber}</Typography>
                  </Grid>
                </Grid>
              </CardContent>
            </Card>

            <Paper sx={{ p: 3 }}>
              <Typography variant="h6" gutterBottom sx={{ mb: 3, fontWeight: 600 }}>
                Check-In Details
              </Typography>

              <Grid container spacing={2}>
                <Grid item xs={12} sm={6}>
                  <TextField
                    fullWidth
                    label="Room Number"
                    required
                    value={checkInData.roomNumber}
                    onChange={handleChange('roomNumber')}
                    error={!!errors.roomNumber}
                    helperText={errors.roomNumber}
                  />
                </Grid>
                <Grid item xs={12} sm={6}>
                  <TextField
                    fullWidth
                    label="Number of Guests"
                    type="number"
                    value={checkInData.numberOfGuests}
                    onChange={handleChange('numberOfGuests')}
                    inputProps={{ min: 1 }}
                  />
                </Grid>
                <Grid item xs={12} sm={6}>
                  <TextField
                    fullWidth
                    label="Check-In Date"
                    type="date"
                    required
                    InputLabelProps={{ shrink: true }}
                    value={checkInData.checkInDate}
                    onChange={handleChange('checkInDate')}
                  />
                </Grid>
                <Grid item xs={12} sm={6}>
                  <TextField
                    fullWidth
                    label="Check-Out Date"
                    type="date"
                    required
                    InputLabelProps={{ shrink: true }}
                    value={checkInData.checkOutDate}
                    onChange={handleChange('checkOutDate')}
                    error={!!errors.checkOutDate}
                    helperText={errors.checkOutDate}
                  />
                </Grid>
                <Grid item xs={12}>
                  <TextField
                    fullWidth
                    label="Special Requests"
                    multiline
                    rows={3}
                    value={checkInData.specialRequests}
                    onChange={handleChange('specialRequests')}
                  />
                </Grid>
              </Grid>

              <Button
                fullWidth
                variant="contained"
                size="large"
                startIcon={<CheckCircle />}
                onClick={handleCheckIn}
                disabled={processing}
                sx={{ mt: 3 }}
              >
                {processing ? 'Processing...' : 'Complete Check-In'}
              </Button>
            </Paper>
          </>
        )}
      </Container>
    </Box>
  )
}
