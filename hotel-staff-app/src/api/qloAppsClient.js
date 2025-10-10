// QloApps API Client
// Handles all communication with QloApps backend

import axios from 'axios'
import config from '../config/api.config'

// Create axios instance
const apiClient = axios.create({
  baseURL: config.API_BASE_URL,
  timeout: config.TIMEOUT,
  headers: config.HEADERS,
})

// Request interceptor - Add auth token
apiClient.interceptors.request.use(
  (requestConfig) => {
    const token = localStorage.getItem('hotelStaffToken')
    if (token) {
      requestConfig.headers.Authorization = `Bearer ${token}`
    }
    
    // Log request for debugging
    if (import.meta.env.DEV) {
      console.log('🚀 API Request:', {
        method: requestConfig.method?.toUpperCase(),
        url: requestConfig.url,
        data: requestConfig.data,
      })
    }
    
    return requestConfig
  },
  (error) => {
    console.error('❌ Request Error:', error)
    return Promise.reject(error)
  }
)

// Response interceptor - Handle errors globally
apiClient.interceptors.response.use(
  (response) => {
    // Log response for debugging
    if (import.meta.env.DEV) {
      console.log('✅ API Response:', {
        url: response.config.url,
        status: response.status,
        data: response.data,
      })
    }
    
    return response
  },
  (error) => {
    // Handle different error scenarios
    if (error.response) {
      // Server responded with error status
      console.error('❌ API Error Response:', {
        status: error.response.status,
        data: error.response.data,
        url: error.config?.url,
      })
      
      // Handle 401 Unauthorized - redirect to login
      if (error.response.status === 401) {
        localStorage.removeItem('hotelStaffToken')
        localStorage.removeItem('hotelStaffUser')
        window.location.href = '/login'
      }
    } else if (error.request) {
      // Request made but no response
      console.error('❌ Network Error:', error.message)
    } else {
      // Something else happened
      console.error('❌ Error:', error.message)
    }
    
    return Promise.reject(error)
  }
)

// ============================================
// AUTHENTICATION SERVICE
// ============================================

export const authService = {
  // Login to QloApps
  login: async (email, password) => {
    try {
      const response = await apiClient.post(config.ENDPOINTS.AUTH.LOGIN, {
        email,
        passwd: password,
        submitLogin: 1,
      })
      
      if (response.data.success) {
        const { token, user } = response.data
        localStorage.setItem('hotelStaffToken', token)
        localStorage.setItem('hotelStaffUser', JSON.stringify(user))
        return { success: true, user }
      } else {
        throw new Error(response.data.message || 'Login failed')
      }
    } catch (error) {
      console.error('Login error:', error)
      throw error
    }
  },

  // Logout
  logout: async () => {
    try {
      await apiClient.post(config.ENDPOINTS.AUTH.LOGOUT)
    } finally {
      localStorage.removeItem('hotelStaffToken')
      localStorage.removeItem('hotelStaffUser')
    }
  },

  // Verify token
  verifyToken: async () => {
    const response = await apiClient.get(config.ENDPOINTS.AUTH.VERIFY)
    return response.data
  },
}

// ============================================
// CUSTOMER/GUEST SERVICE (QloApps Customers)
// ============================================

export const guestService = {
  // Get all customers
  getAll: async (params = {}) => {
    const response = await apiClient.get(config.ENDPOINTS.CUSTOMERS.LIST, { params })
    return response.data
  },

  // Search customers
  search: async (query) => {
    const response = await apiClient.get(config.ENDPOINTS.CUSTOMERS.SEARCH, {
      params: { query },
    })
    return response.data
  },

  // Get customer by ID
  getById: async (id) => {
    const response = await apiClient.get(config.ENDPOINTS.CUSTOMERS.GET, {
      params: { id },
    })
    return response.data
  },

  // Create new customer (guest registration)
  create: async (guestData) => {
    // Map our app data structure to QloApps customer structure
    const customerData = {
      firstname: guestData.firstName,
      lastname: guestData.lastName,
      email: guestData.email,
      phone: guestData.phone,
      phone_mobile: guestData.phone,
      birthday: guestData.dateOfBirth,
      id_gender: guestData.sex === 'M' ? 1 : 2, // QloApps gender IDs
      
      // Address data
      address1: guestData.address,
      city: guestData.city,
      postcode: guestData.postalCode,
      country: guestData.country,
      
      // Document information (custom fields)
      document_type: guestData.documentType,
      document_number: guestData.documentNumber,
      document_expiry: guestData.documentExpiry,
      nationality: guestData.nationality,
      
      // Status
      active: 1,
    }
    
    const response = await apiClient.post(config.ENDPOINTS.CUSTOMERS.CREATE, customerData)
    return response.data
  },

  // Update customer
  update: async (id, guestData) => {
    const customerData = {
      id_customer: id,
      firstname: guestData.firstName,
      lastname: guestData.lastName,
      email: guestData.email,
      phone: guestData.phone,
      birthday: guestData.dateOfBirth,
      // ... other fields
    }
    
    const response = await apiClient.post(config.ENDPOINTS.CUSTOMERS.UPDATE, customerData)
    return response.data
  },

  // Delete customer
  delete: async (id) => {
    await apiClient.post(config.ENDPOINTS.CUSTOMERS.DELETE, {
      id_customer: id,
    })
  },
}

// ============================================
// BOOKING SERVICE (QloApps Orders)
// ============================================

export const bookingService = {
  // Get all bookings/orders
  getAll: async (params = {}) => {
    const response = await apiClient.get(config.ENDPOINTS.BOOKINGS.LIST, { params })
    return response.data
  },

  // Get booking by ID
  getById: async (id) => {
    const response = await apiClient.get(config.ENDPOINTS.BOOKINGS.GET, {
      params: { id_order: id },
    })
    return response.data
  },

  // Create new booking
  create: async (bookingData) => {
    const orderData = {
      id_customer: bookingData.customerId,
      id_hotel: bookingData.hotelId || 1,
      date_from: bookingData.checkInDate,
      date_to: bookingData.checkOutDate,
      id_room: bookingData.roomId,
      num_rooms: 1,
      num_guests: bookingData.numberOfGuests || 1,
      booking_type: bookingData.bookingType || 'date_range',
      comment: bookingData.specialRequests || '',
    }
    
    const response = await apiClient.post(config.ENDPOINTS.BOOKINGS.CREATE, orderData)
    return response.data
  },

  // Check-in guest
  checkIn: async (orderId, checkInData) => {
    const response = await apiClient.post(config.ENDPOINTS.BOOKINGS.CHECK_IN, {
      id_order: orderId,
      check_in_date: checkInData.checkInDate || new Date().toISOString(),
      room_number: checkInData.roomNumber,
      status: 'checked_in',
    })
    return response.data
  },

  // Check-out guest
  checkOut: async (orderId) => {
    const response = await apiClient.post(config.ENDPOINTS.BOOKINGS.CHECK_OUT, {
      id_order: orderId,
      check_out_date: new Date().toISOString(),
      status: 'checked_out',
    })
    return response.data
  },

  // Update booking
  update: async (id, bookingData) => {
    const response = await apiClient.post(config.ENDPOINTS.BOOKINGS.UPDATE, {
      id_order: id,
      ...bookingData,
    })
    return response.data
  },
}

// ============================================
// ROOM SERVICE (QloApps Products/Rooms)
// ============================================

export const roomService = {
  // Get all rooms
  getAll: async () => {
    const response = await apiClient.get(config.ENDPOINTS.ROOMS.LIST)
    return response.data
  },

  // Get available rooms
  getAvailable: async (startDate, endDate, hotelId = null) => {
    const response = await apiClient.get(config.ENDPOINTS.ROOMS.AVAILABLE, {
      params: {
        date_from: startDate,
        date_to: endDate,
        id_hotel: hotelId,
      },
    })
    return response.data
  },

  // Get room by ID
  getById: async (id) => {
    const response = await apiClient.get(config.ENDPOINTS.ROOMS.GET, {
      params: { id_product: id },
    })
    return response.data
  },
}

// ============================================
// HOTEL SERVICE
// ============================================

export const hotelService = {
  // Get all hotels
  getAll: async () => {
    const response = await apiClient.get(config.ENDPOINTS.HOTELS.LIST)
    return response.data
  },

  // Get hotel by ID
  getById: async (id) => {
    const response = await apiClient.get(config.ENDPOINTS.HOTELS.GET, {
      params: { id_hotel: id },
    })
    return response.data
  },
}

// ============================================
// DASHBOARD SERVICE
// ============================================

export const dashboardService = {
  // Get dashboard statistics
  getStats: async () => {
    const response = await apiClient.get(config.ENDPOINTS.DASHBOARD.STATS)
    return response.data
  },

  // Get today's check-ins
  getTodayCheckIns: async () => {
    const response = await apiClient.get(config.ENDPOINTS.DASHBOARD.TODAY_CHECKINS)
    return response.data
  },

  // Get today's check-outs
  getTodayCheckOuts: async () => {
    const response = await apiClient.get(config.ENDPOINTS.DASHBOARD.TODAY_CHECKOUTS)
    return response.data
  },
}

// ============================================
// ERROR HANDLING HELPER
// ============================================

export const handleApiError = (error) => {
  if (error.response) {
    const message = error.response.data?.message || error.response.data?.error || 'An error occurred'
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
    return { error: 'Network error. Please check your connection.', details: null }
  } else {
    return { error: error.message || 'An unexpected error occurred.', details: null }
  }
}

// Export API client for custom requests
export default apiClient
