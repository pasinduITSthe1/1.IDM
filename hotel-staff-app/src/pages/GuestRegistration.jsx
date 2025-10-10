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
  Chip,
  Stack,
} from '@mui/material'
import {
  ArrowBack,
  Save,
  CameraAlt,
} from '@mui/icons-material'

export default function GuestRegistration() {
  const navigate = useNavigate()
  const location = useLocation()
  const scannedData = location.state?.scannedData || null

  const [formData, setFormData] = useState({
    firstName: '',
    lastName: '',
    email: '',
    phone: '',
    dateOfBirth: '',
    nationality: '',
    documentType: '',
    documentNumber: '',
    documentExpiry: '',
    address: '',
    city: '',
    country: '',
    postalCode: '',
  })

  const [errors, setErrors] = useState({})
  const [saving, setSaving] = useState(false)
  const [success, setSuccess] = useState(false)

  // Auto-populate from scanned data
  useEffect(() => {
    if (scannedData) {
      console.log('📄 Received scanned data:', scannedData)
      
      const updatedData = {
        firstName: scannedData.firstName || '',
        lastName: scannedData.lastName || '',
        dateOfBirth: scannedData.dateOfBirth || '',
        nationality: scannedData.nationality || '',
        documentType: scannedData.documentType || '',
        documentNumber: scannedData.documentNumber || '',
        documentExpiry: scannedData.expirationDate || '',
        country: scannedData.issuingCountry || '',
      }
      
      console.log('✅ Auto-filling form with:', updatedData)
      
      setFormData((prev) => ({
        ...prev,
        ...updatedData,
      }))
    }
  }, [scannedData])

  const handleChange = (field) => (event) => {
    setFormData({
      ...formData,
      [field]: event.target.value,
    })
    // Clear error for this field
    if (errors[field]) {
      setErrors({
        ...errors,
        [field]: null,
      })
    }
  }

  const validateForm = () => {
    const newErrors = {}

    if (!formData.firstName) newErrors.firstName = 'First name is required'
    if (!formData.lastName) newErrors.lastName = 'Last name is required'
    if (!formData.email) {
      newErrors.email = 'Email is required'
    } else if (!/\S+@\S+\.\S+/.test(formData.email)) {
      newErrors.email = 'Email is invalid'
    }
    if (!formData.phone) newErrors.phone = 'Phone number is required'
    if (!formData.documentType) newErrors.documentType = 'Document type is required'
    if (!formData.documentNumber) newErrors.documentNumber = 'Document number is required'

    setErrors(newErrors)
    return Object.keys(newErrors).length === 0
  }

  const handleSubmit = async (e) => {
    e.preventDefault()

    if (!validateForm()) {
      return
    }

    setSaving(true)
    setSuccess(false)

    // Simulate API call - Replace with actual API integration
    setTimeout(() => {
      // Save to localStorage for demo
      const guests = JSON.parse(localStorage.getItem('hotelGuests') || '[]')
      const newGuest = {
        id: Date.now(),
        ...formData,
        registeredDate: new Date().toISOString(),
        status: 'registered',
      }
      guests.push(newGuest)
      localStorage.setItem('hotelGuests', JSON.stringify(guests))

      setSaving(false)
      setSuccess(true)

      // Navigate to check-in after success
      setTimeout(() => {
        navigate('/check-in', { state: { guestId: newGuest.id } })
      }, 1500)
    }, 1000)
  }

  return (
    <Box sx={{ minHeight: '100vh', bgcolor: 'background.default' }}>
      {/* Header */}
      <AppBar position="static">
        <Toolbar>
          <IconButton edge="start" color="inherit" onClick={() => navigate(-1)}>
            <ArrowBack />
          </IconButton>
          <Typography variant="h6" sx={{ flexGrow: 1, ml: 2, fontWeight: 600 }}>
            Guest Registration
          </Typography>
          <IconButton color="inherit" onClick={() => navigate('/scan')}>
            <CameraAlt />
          </IconButton>
        </Toolbar>
      </AppBar>

      <Container maxWidth="md" sx={{ py: 3 }}>
        {/* Auto-fill indicator */}
        {scannedData && (
          <Alert severity="success" sx={{ mb: 3 }}>
            <Stack direction="row" alignItems="center" spacing={1}>
              <Typography variant="body2">
                Form auto-filled from scanned document
              </Typography>
              <Chip label={scannedData.documentType} size="small" color="primary" />
            </Stack>
          </Alert>
        )}

        {/* Success Message */}
        {success && (
          <Alert severity="success" sx={{ mb: 3 }}>
            Guest registered successfully! Redirecting to check-in...
          </Alert>
        )}

        <Paper sx={{ p: 3 }}>
          <form onSubmit={handleSubmit}>
            {/* Personal Information */}
            <Typography variant="h6" gutterBottom sx={{ mb: 2, fontWeight: 600 }}>
              Personal Information
            </Typography>

            <Grid container spacing={2} sx={{ mb: 3 }}>
              <Grid item xs={12} sm={6}>
                <TextField
                  fullWidth
                  label="First Name"
                  required
                  value={formData.firstName}
                  onChange={handleChange('firstName')}
                  error={!!errors.firstName}
                  helperText={errors.firstName}
                />
              </Grid>
              <Grid item xs={12} sm={6}>
                <TextField
                  fullWidth
                  label="Last Name"
                  required
                  value={formData.lastName}
                  onChange={handleChange('lastName')}
                  error={!!errors.lastName}
                  helperText={errors.lastName}
                />
              </Grid>
              <Grid item xs={12} sm={6}>
                <TextField
                  fullWidth
                  label="Email"
                  type="email"
                  required
                  value={formData.email}
                  onChange={handleChange('email')}
                  error={!!errors.email}
                  helperText={errors.email}
                />
              </Grid>
              <Grid item xs={12} sm={6}>
                <TextField
                  fullWidth
                  label="Phone Number"
                  required
                  value={formData.phone}
                  onChange={handleChange('phone')}
                  error={!!errors.phone}
                  helperText={errors.phone}
                />
              </Grid>
              <Grid item xs={12} sm={6}>
                <TextField
                  fullWidth
                  label="Date of Birth"
                  type="date"
                  InputLabelProps={{ shrink: true }}
                  value={formData.dateOfBirth}
                  onChange={handleChange('dateOfBirth')}
                />
              </Grid>
              <Grid item xs={12} sm={6}>
                <TextField
                  fullWidth
                  label="Nationality"
                  value={formData.nationality}
                  onChange={handleChange('nationality')}
                />
              </Grid>
            </Grid>

            {/* Document Information */}
            <Typography variant="h6" gutterBottom sx={{ mb: 2, fontWeight: 600 }}>
              Document Information
            </Typography>

            <Grid container spacing={2} sx={{ mb: 3 }}>
              <Grid item xs={12} sm={6}>
                <TextField
                  fullWidth
                  select
                  label="Document Type"
                  required
                  value={formData.documentType}
                  onChange={handleChange('documentType')}
                  error={!!errors.documentType}
                  helperText={errors.documentType}
                >
                  <MenuItem value="Passport">Passport</MenuItem>
                  <MenuItem value="ID Card">ID Card</MenuItem>
                  <MenuItem value="Driver License">Driver License</MenuItem>
                  <MenuItem value="Other">Other</MenuItem>
                </TextField>
              </Grid>
              <Grid item xs={12} sm={6}>
                <TextField
                  fullWidth
                  label="Document Number"
                  required
                  value={formData.documentNumber}
                  onChange={handleChange('documentNumber')}
                  error={!!errors.documentNumber}
                  helperText={errors.documentNumber}
                />
              </Grid>
              <Grid item xs={12} sm={6}>
                <TextField
                  fullWidth
                  label="Document Expiry Date"
                  type="date"
                  InputLabelProps={{ shrink: true }}
                  value={formData.documentExpiry}
                  onChange={handleChange('documentExpiry')}
                />
              </Grid>
            </Grid>

            {/* Address Information */}
            <Typography variant="h6" gutterBottom sx={{ mb: 2, fontWeight: 600 }}>
              Address Information
            </Typography>

            <Grid container spacing={2} sx={{ mb: 3 }}>
              <Grid item xs={12}>
                <TextField
                  fullWidth
                  label="Street Address"
                  value={formData.address}
                  onChange={handleChange('address')}
                />
              </Grid>
              <Grid item xs={12} sm={6}>
                <TextField
                  fullWidth
                  label="City"
                  value={formData.city}
                  onChange={handleChange('city')}
                />
              </Grid>
              <Grid item xs={12} sm={6}>
                <TextField
                  fullWidth
                  label="Postal Code"
                  value={formData.postalCode}
                  onChange={handleChange('postalCode')}
                />
              </Grid>
              <Grid item xs={12}>
                <TextField
                  fullWidth
                  label="Country"
                  value={formData.country}
                  onChange={handleChange('country')}
                />
              </Grid>
            </Grid>

            {/* Action Buttons */}
            <Stack direction="row" spacing={2} justifyContent="flex-end">
              <Button
                variant="outlined"
                size="large"
                onClick={() => navigate(-1)}
                disabled={saving}
              >
                Cancel
              </Button>
              <Button
                type="submit"
                variant="contained"
                size="large"
                startIcon={<Save />}
                disabled={saving}
                sx={{ px: 4 }}
              >
                {saving ? 'Saving...' : 'Save & Continue'}
              </Button>
            </Stack>
          </form>
        </Paper>
      </Container>
    </Box>
  )
}
