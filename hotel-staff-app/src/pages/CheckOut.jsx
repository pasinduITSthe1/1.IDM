import React, { useState, useEffect } from 'react'
import { useNavigate } from 'react-router-dom'
import {
  Box,
  Container,
  AppBar,
  Toolbar,
  IconButton,
  Typography,
  Button,
  Paper,
  Card,
  CardContent,
  Grid,
  Chip,
  Autocomplete,
  TextField,
  Alert,
  Divider,
} from '@mui/material'
import {
  ArrowBack,
  ExitToApp,
} from '@mui/icons-material'
import { format } from 'date-fns'

export default function CheckOut() {
  const navigate = useNavigate()

  const [guests, setGuests] = useState([])
  const [selectedGuest, setSelectedGuest] = useState(null)
  const [processing, setProcessing] = useState(false)
  const [success, setSuccess] = useState(false)

  useEffect(() => {
    const storedGuests = JSON.parse(localStorage.getItem('hotelGuests') || '[]')
    setGuests(storedGuests)
  }, [])

  const handleCheckOut = async () => {
    if (!selectedGuest) return

    setProcessing(true)
    setSuccess(false)

    setTimeout(() => {
      const updatedGuests = guests.map(g => 
        g.id === selectedGuest.id
          ? { ...g, status: 'checked-out', actualCheckOutDate: new Date().toISOString() }
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

  const calculateStayDuration = () => {
    if (!selectedGuest?.checkInDate || !selectedGuest?.checkOutDate) return 'N/A'
    
    const checkIn = new Date(selectedGuest.checkInDate)
    const checkOut = new Date(selectedGuest.checkOutDate)
    const days = Math.ceil((checkOut - checkIn) / (1000 * 60 * 60 * 24))
    
    return `${days} ${days === 1 ? 'night' : 'nights'}`
  }

  return (
    <Box sx={{ minHeight: '100vh', bgcolor: 'background.default' }}>
      <AppBar position="static">
        <Toolbar>
          <IconButton edge="start" color="inherit" onClick={() => navigate(-1)}>
            <ArrowBack />
          </IconButton>
          <Typography variant="h6" sx={{ flexGrow: 1, ml: 2, fontWeight: 600 }}>
            Guest Check-Out
          </Typography>
        </Toolbar>
      </AppBar>

      <Container maxWidth="md" sx={{ py: 3 }}>
        {success && (
          <Alert severity="success" sx={{ mb: 3 }}>
            Check-out completed successfully! Redirecting to dashboard...
          </Alert>
        )}

        <Paper sx={{ p: 3, mb: 3 }}>
          <Typography variant="h6" gutterBottom sx={{ mb: 3, fontWeight: 600 }}>
            Select Guest to Check Out
          </Typography>

          <Autocomplete
            options={guests.filter(g => g.status === 'checked-in')}
            getOptionLabel={(option) => 
              `Room ${option.roomNumber} - ${option.firstName} ${option.lastName}`
            }
            value={selectedGuest}
            onChange={(event, newValue) => setSelectedGuest(newValue)}
            renderInput={(params) => (
              <TextField
                {...params}
                label="Search by Room or Guest Name"
                placeholder="Type to search..."
              />
            )}
            renderOption={(props, option) => (
              <li {...props}>
                <Box sx={{ width: '100%' }}>
                  <Typography variant="body1" fontWeight="600">
                    Room {option.roomNumber} - {option.firstName} {option.lastName}
                  </Typography>
                  <Typography variant="caption" color="text.secondary">
                    Check-in: {format(new Date(option.checkInDate), 'MMM dd, yyyy')}
                  </Typography>
                </Box>
              </li>
            )}
          />
        </Paper>

        {selectedGuest && (
          <>
            <Card sx={{ mb: 3 }}>
              <CardContent>
                <Box sx={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', mb: 2 }}>
                  <Typography variant="h6" fontWeight="600">
                    Guest Information
                  </Typography>
                  <Chip label={`Room ${selectedGuest.roomNumber}`} color="primary" />
                </Box>
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

            <Card sx={{ mb: 3 }}>
              <CardContent>
                <Typography variant="h6" gutterBottom fontWeight="600">
                  Stay Details
                </Typography>
                <Divider sx={{ my: 2 }} />
                <Grid container spacing={2}>
                  <Grid item xs={6}>
                    <Typography variant="caption" color="text.secondary">Check-In Date</Typography>
                    <Typography variant="body1" fontWeight="600">
                      {format(new Date(selectedGuest.checkInDate), 'MMM dd, yyyy')}
                    </Typography>
                  </Grid>
                  <Grid item xs={6}>
                    <Typography variant="caption" color="text.secondary">Expected Check-Out</Typography>
                    <Typography variant="body1" fontWeight="600">
                      {format(new Date(selectedGuest.checkOutDate), 'MMM dd, yyyy')}
                    </Typography>
                  </Grid>
                  <Grid item xs={6}>
                    <Typography variant="caption" color="text.secondary">Duration</Typography>
                    <Typography variant="body1" fontWeight="600">
                      {calculateStayDuration()}
                    </Typography>
                  </Grid>
                  <Grid item xs={6}>
                    <Typography variant="caption" color="text.secondary">Number of Guests</Typography>
                    <Typography variant="body1" fontWeight="600">
                      {selectedGuest.numberOfGuests || 1}
                    </Typography>
                  </Grid>
                  {selectedGuest.specialRequests && (
                    <Grid item xs={12}>
                      <Typography variant="caption" color="text.secondary">Special Requests</Typography>
                      <Typography variant="body2">
                        {selectedGuest.specialRequests}
                      </Typography>
                    </Grid>
                  )}
                </Grid>
              </CardContent>
            </Card>

            <Paper sx={{ p: 3 }}>
              <Alert severity="info" sx={{ mb: 3 }}>
                Please ensure all room charges are settled before completing check-out.
              </Alert>

              <Button
                fullWidth
                variant="contained"
                size="large"
                startIcon={<ExitToApp />}
                onClick={handleCheckOut}
                disabled={processing}
              >
                {processing ? 'Processing...' : 'Complete Check-Out'}
              </Button>
            </Paper>
          </>
        )}
      </Container>
    </Box>
  )
}
