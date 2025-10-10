// API Integration Template for QloApps Backend
// This file provides a template for integrating with QloApps API in Phase 2

import axios from 'axios'

// ============================================
// API CLIENT CONFIGURATION
// ============================================

const apiClient = axios.create({
  baseURL: import.meta.env.VITE_API_URL || 'http://localhost:8000/api',
  timeout: 15000,
  headers: {
    'Content-Type': 'application/json',
  },
})

// Request interceptor - Add auth token to all requests
apiClient.interceptors.request.use(
  (config) => {
    const token = localStorage.getItem('hotelStaffToken')
    if (token) {
      config.headers.Authorization = `Bearer ${token}`
    }
    return config
  },
  (error) => {
    return Promise.reject(error)
  }
)

// Response interceptor - Handle errors globally
apiClient.interceptors.response.use(
  (response) => response,
  (error) => {
    if (error.response?.status === 401) {
      // Unauthorized - redirect to login
      localStorage.removeItem('hotelStaffToken')
      localStorage.removeItem('hotelStaffUser')
      window.location.href = '/login'
    }
    return Promise.reject(error)
  }
)

// ============================================
// AUTHENTICATION SERVICE
// ============================================

export const authService = {
  // Login
  login: async (username, password) => {
    const response = await apiClient.post('/auth/login', {
      username,
      password,
    })
    
    // Store token and user data
    localStorage.setItem('hotelStaffToken', response.data.token)
    localStorage.setItem('hotelStaffUser', JSON.stringify(response.data.user))
    
    return response.data
  },

  // Logout
  logout: async () => {
    try {
      await apiClient.post('/auth/logout')
    } finally {
      localStorage.removeItem('hotelStaffToken')
      localStorage.removeItem('hotelStaffUser')
    }
  },

  // Verify token
  verifyToken: async () => {
    const response = await apiClient.get('/auth/verify')
    return response.data
  },

  // Refresh token
  refreshToken: async () => {
    const response = await apiClient.post('/auth/refresh')
    localStorage.setItem('hotelStaffToken', response.data.token)
    return response.data
  },
}

// ============================================
// GUEST SERVICE
// ============================================

export const guestService = {
  // Get all guests with pagination and filters
  getAll: async (params = {}) => {
    const response = await apiClient.get('/guests', { params })
    return response.data
  },

  // Search guests
  search: async (query) => {
    const response = await apiClient.get('/guests/search', {
      params: { q: query },
    })
    return response.data
  },

  // Get guest by ID
  getById: async (id) => {
    const response = await apiClient.get(`/guests/${id}`)
    return response.data
  },

  // Create new guest
  create: async (guestData) => {
    const response = await apiClient.post('/guests', guestData)
    return response.data
  },

  // Update guest
  update: async (id, guestData) => {
    const response = await apiClient.put(`/guests/${id}`, guestData)
    return response.data
  },

  // Delete guest
  delete: async (id) => {
    await apiClient.delete(`/guests/${id}`)
  },

  // Upload document scan
  uploadDocument: async (guestId, file, documentType) => {
    const formData = new FormData()
    formData.append('document', file)
    formData.append('type', documentType)

    const response = await apiClient.post(
      `/guests/${guestId}/documents`,
      formData,
      {
        headers: {
          'Content-Type': 'multipart/form-data',
        },
      }
    )
    return response.data
  },

  // Process scanned document with OCR/MRZ
  processDocument: async (guestId, imageData) => {
    const response = await apiClient.post(`/guests/${guestId}/process-document`, {
      image: imageData,
    })
    return response.data
  },
}

// ============================================
// CHECK-IN/OUT SERVICE
// ============================================

export const bookingService = {
  // Check in guest
  checkIn: async (guestId, checkInData) => {
    const response = await apiClient.post(`/bookings/check-in`, {
      guestId,
      roomNumber: checkInData.roomNumber,
      checkInDate: checkInData.checkInDate,
      checkOutDate: checkInData.checkOutDate,
      numberOfGuests: checkInData.numberOfGuests,
      specialRequests: checkInData.specialRequests,
    })
    return response.data
  },

  // Check out guest
  checkOut: async (bookingId) => {
    const response = await apiClient.post(`/bookings/${bookingId}/check-out`, {
      checkOutDate: new Date().toISOString(),
    })
    return response.data
  },

  // Get booking details
  getBooking: async (bookingId) => {
    const response = await apiClient.get(`/bookings/${bookingId}`)
    return response.data
  },

  // Get active bookings
  getActive: async () => {
    const response = await apiClient.get('/bookings/active')
    return response.data
  },

  // Update booking
  updateBooking: async (bookingId, bookingData) => {
    const response = await apiClient.put(`/bookings/${bookingId}`, bookingData)
    return response.data
  },
}

// ============================================
// ROOM SERVICE
// ============================================

export const roomService = {
  // Get all rooms
  getAll: async () => {
    const response = await apiClient.get('/rooms')
    return response.data
  },

  // Get available rooms
  getAvailable: async (startDate, endDate) => {
    const response = await apiClient.get('/rooms/available', {
      params: { startDate, endDate },
    })
    return response.data
  },

  // Get room details
  getById: async (id) => {
    const response = await apiClient.get(`/rooms/${id}`)
    return response.data
  },

  // Update room status
  updateStatus: async (id, status) => {
    const response = await apiClient.patch(`/rooms/${id}/status`, { status })
    return response.data
  },
}

// ============================================
// DASHBOARD/ANALYTICS SERVICE
// ============================================

export const analyticsService = {
  // Get dashboard stats
  getDashboardStats: async () => {
    const response = await apiClient.get('/analytics/dashboard')
    return response.data
  },

  // Get check-in stats for date range
  getCheckInStats: async (startDate, endDate) => {
    const response = await apiClient.get('/analytics/check-ins', {
      params: { startDate, endDate },
    })
    return response.data
  },

  // Get occupancy rate
  getOccupancyRate: async (date) => {
    const response = await apiClient.get('/analytics/occupancy', {
      params: { date },
    })
    return response.data
  },
}

// ============================================
// NOTIFICATION SERVICE
// ============================================

export const notificationService = {
  // Send check-in confirmation email
  sendCheckInConfirmation: async (guestId, bookingId) => {
    const response = await apiClient.post('/notifications/check-in-confirmation', {
      guestId,
      bookingId,
    })
    return response.data
  },

  // Send check-out confirmation
  sendCheckOutConfirmation: async (guestId, bookingId) => {
    const response = await apiClient.post('/notifications/check-out-confirmation', {
      guestId,
      bookingId,
    })
    return response.data
  },

  // Send custom notification
  send: async (guestId, notification) => {
    const response = await apiClient.post('/notifications/send', {
      guestId,
      ...notification,
    })
    return response.data
  },
}

// ============================================
// ERROR HANDLING HELPER
// ============================================

export const handleApiError = (error) => {
  if (error.response) {
    // Server responded with error status
    const message = error.response.data?.message || 'An error occurred'
    const statusCode = error.response.status

    switch (statusCode) {
      case 400:
        return { error: 'Invalid request. Please check your input.', details: message }
      case 401:
        return { error: 'Unauthorized. Please log in again.', details: message }
      case 403:
        return { error: 'Access denied.', details: message }
      case 404:
        return { error: 'Resource not found.', details: message }
      case 409:
        return { error: 'Conflict. Resource already exists.', details: message }
      case 500:
        return { error: 'Server error. Please try again later.', details: message }
      default:
        return { error: message, details: null }
    }
  } else if (error.request) {
    // Request made but no response received
    return { error: 'Network error. Please check your connection.', details: null }
  } else {
    // Something else happened
    return { error: error.message || 'An unexpected error occurred.', details: null }
  }
}

// ============================================
// USAGE EXAMPLES
// ============================================

/*
// Example 1: Login
try {
  const user = await authService.login('staff', 'password123')
  console.log('Logged in:', user)
} catch (error) {
  const { error: errorMsg } = handleApiError(error)
  console.error(errorMsg)
}

// Example 2: Create guest
try {
  const newGuest = await guestService.create({
    firstName: 'John',
    lastName: 'Doe',
    email: 'john@example.com',
    phone: '+1234567890',
    documentType: 'Passport',
    documentNumber: 'P12345678',
  })
  console.log('Guest created:', newGuest)
} catch (error) {
  const { error: errorMsg } = handleApiError(error)
  console.error(errorMsg)
}

// Example 3: Check in guest
try {
  const booking = await bookingService.checkIn(guestId, {
    roomNumber: '301',
    checkInDate: '2024-01-10',
    checkOutDate: '2024-01-15',
    numberOfGuests: 2,
    specialRequests: 'Late check-in',
  })
  console.log('Checked in:', booking)
} catch (error) {
  const { error: errorMsg } = handleApiError(error)
  console.error(errorMsg)
}

// Example 4: Get available rooms
try {
  const rooms = await roomService.getAvailable('2024-01-10', '2024-01-15')
  console.log('Available rooms:', rooms)
} catch (error) {
  const { error: errorMsg } = handleApiError(error)
  console.error(errorMsg)
}

// Example 5: Upload document
try {
  const file = document.querySelector('input[type="file"]').files[0]
  const result = await guestService.uploadDocument(guestId, file, 'passport')
  console.log('Document uploaded:', result)
} catch (error) {
  const { error: errorMsg } = handleApiError(error)
  console.error(errorMsg)
}
*/

// ============================================
// EXPORT DEFAULT CLIENT
// ============================================

export default apiClient
