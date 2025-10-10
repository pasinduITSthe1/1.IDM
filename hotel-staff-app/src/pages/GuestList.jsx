import React, { useState, useEffect } from 'react'
import { useNavigate } from 'react-router-dom'
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
  TextField,
  InputAdornment,
  MenuItem,
  Avatar,
  Stack,
} from '@mui/material'
import {
  ArrowBack,
  Search,
  Person,
  FilterList,
} from '@mui/icons-material'
import { format } from 'date-fns'

export default function GuestList() {
  const navigate = useNavigate()

  const [guests, setGuests] = useState([])
  const [filteredGuests, setFilteredGuests] = useState([])
  const [searchQuery, setSearchQuery] = useState('')
  const [statusFilter, setStatusFilter] = useState('all')

  useEffect(() => {
    const storedGuests = JSON.parse(localStorage.getItem('hotelGuests') || '[]')
    setGuests(storedGuests)
    setFilteredGuests(storedGuests)
  }, [])

  useEffect(() => {
    let filtered = guests

    // Filter by status
    if (statusFilter !== 'all') {
      filtered = filtered.filter(g => g.status === statusFilter)
    }

    // Filter by search query
    if (searchQuery) {
      const query = searchQuery.toLowerCase()
      filtered = filtered.filter(g =>
        g.firstName.toLowerCase().includes(query) ||
        g.lastName.toLowerCase().includes(query) ||
        g.email.toLowerCase().includes(query) ||
        g.documentNumber.toLowerCase().includes(query) ||
        (g.roomNumber && g.roomNumber.toLowerCase().includes(query))
      )
    }

    setFilteredGuests(filtered)
  }, [searchQuery, statusFilter, guests])

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

  return (
    <Box sx={{ minHeight: '100vh', bgcolor: 'background.default' }}>
      <AppBar position="static">
        <Toolbar>
          <IconButton edge="start" color="inherit" onClick={() => navigate(-1)}>
            <ArrowBack />
          </IconButton>
          <Typography variant="h6" sx={{ flexGrow: 1, ml: 2, fontWeight: 600 }}>
            Guest List
          </Typography>
        </Toolbar>
      </AppBar>

      <Container maxWidth="md" sx={{ py: 3 }}>
        {/* Filters */}
        <Card sx={{ mb: 3 }}>
          <CardContent>
            <Grid container spacing={2}>
              <Grid item xs={12} sm={8}>
                <TextField
                  fullWidth
                  placeholder="Search by name, email, room, or document..."
                  value={searchQuery}
                  onChange={(e) => setSearchQuery(e.target.value)}
                  InputProps={{
                    startAdornment: (
                      <InputAdornment position="start">
                        <Search />
                      </InputAdornment>
                    ),
                  }}
                />
              </Grid>
              <Grid item xs={12} sm={4}>
                <TextField
                  fullWidth
                  select
                  label="Status"
                  value={statusFilter}
                  onChange={(e) => setStatusFilter(e.target.value)}
                  InputProps={{
                    startAdornment: (
                      <InputAdornment position="start">
                        <FilterList />
                      </InputAdornment>
                    ),
                  }}
                >
                  <MenuItem value="all">All Guests</MenuItem>
                  <MenuItem value="registered">Registered</MenuItem>
                  <MenuItem value="checked-in">Checked In</MenuItem>
                  <MenuItem value="checked-out">Checked Out</MenuItem>
                </TextField>
              </Grid>
            </Grid>
          </CardContent>
        </Card>

        {/* Guest Count */}
        <Typography variant="body2" color="text.secondary" sx={{ mb: 2 }}>
          Showing {filteredGuests.length} {filteredGuests.length === 1 ? 'guest' : 'guests'}
        </Typography>

        {/* Guest Cards */}
        {filteredGuests.length === 0 ? (
          <Card>
            <CardContent sx={{ textAlign: 'center', py: 5 }}>
              <Person sx={{ fontSize: 64, color: 'text.secondary', mb: 2 }} />
              <Typography variant="h6" color="text.secondary">
                No guests found
              </Typography>
              <Typography variant="body2" color="text.secondary">
                {searchQuery || statusFilter !== 'all'
                  ? 'Try adjusting your filters'
                  : 'Start by registering a new guest'}
              </Typography>
            </CardContent>
          </Card>
        ) : (
          <Stack spacing={2}>
            {filteredGuests.map((guest) => (
              <Card
                key={guest.id}
                sx={{
                  cursor: 'pointer',
                  transition: 'all 0.2s',
                  '&:hover': {
                    transform: 'translateY(-4px)',
                    boxShadow: '0 4px 12px rgba(0, 0, 0, 0.15)',
                  },
                  '&:active': {
                    transform: 'translateY(-2px)',
                  },
                }}
                onClick={() => navigate(`/guest/${guest.id}`)}
              >
                <CardContent>
                  <Box sx={{ display: 'flex', alignItems: 'flex-start' }}>
                    <Avatar
                      sx={{
                        width: 56,
                        height: 56,
                        bgcolor: 'primary.main',
                        mr: 2,
                      }}
                    >
                      {guest.firstName[0]}{guest.lastName[0]}
                    </Avatar>

                    <Box sx={{ flexGrow: 1 }}>
                      <Box sx={{ display: 'flex', justifyContent: 'space-between', alignItems: 'flex-start', mb: 1 }}>
                        <Box>
                          <Typography variant="h6" fontWeight="600">
                            {guest.firstName} {guest.lastName}
                          </Typography>
                          {guest.roomNumber && (
                            <Chip
                              label={`Room ${guest.roomNumber}`}
                              size="small"
                              color="primary"
                              sx={{ mt: 0.5 }}
                            />
                          )}
                        </Box>
                        <Chip
                          label={getStatusLabel(guest.status)}
                          color={getStatusColor(guest.status)}
                          size="small"
                        />
                      </Box>

                      <Stack spacing={0.5}>
                        <Typography variant="body2" color="text.secondary">
                          📧 {guest.email}
                        </Typography>
                        <Typography variant="body2" color="text.secondary">
                          📱 {guest.phone}
                        </Typography>
                        <Typography variant="body2" color="text.secondary">
                          🆔 {guest.documentNumber}
                        </Typography>
                        {guest.checkInDate && (
                          <Typography variant="body2" color="text.secondary">
                            📅 {format(new Date(guest.checkInDate), 'MMM dd, yyyy')}
                            {guest.checkOutDate && ` - ${format(new Date(guest.checkOutDate), 'MMM dd, yyyy')}`}
                          </Typography>
                        )}
                      </Stack>
                    </Box>
                  </Box>
                </CardContent>
              </Card>
            ))}
          </Stack>
        )}
      </Container>
    </Box>
  )
}
