// QloApps API Configuration
// Configure connection to QloApps backend

const config = {
  // QloApps Backend URL (adjust based on your setup)
  API_BASE_URL: import.meta.env.VITE_API_URL || 'http://localhost:81/1.IDM',
  
  // API Endpoints
  ENDPOINTS: {
    // Authentication
    AUTH: {
      LOGIN: '/admin134miqa0b/ajax-mobile-api.php?action=staffLogin',
      LOGOUT: '/admin134miqa0b/ajax-mobile-api.php?action=staffLogout',
      VERIFY: '/admin134miqa0b/ajax-mobile-api.php?action=verifyToken',
    },
    
    // Customers (Guests)
    CUSTOMERS: {
      LIST: '/admin134miqa0b/ajax-mobile-api.php?controller=AdminCustomers&action=getCustomers',
      GET: '/admin134miqa0b/ajax-mobile-api.php?controller=AdminCustomers&action=getCustomer',
      CREATE: '/admin134miqa0b/ajax-mobile-api.php?controller=AdminCustomers&action=addCustomer',
      UPDATE: '/admin134miqa0b/ajax-mobile-api.php?controller=AdminCustomers&action=updateCustomer',
      DELETE: '/admin134miqa0b/ajax-mobile-api.php?controller=AdminCustomers&action=deleteCustomer',
      SEARCH: '/admin134miqa0b/ajax-mobile-api.php?controller=AdminCustomers&action=searchCustomers',
    },
    
    // Bookings (Orders)
    BOOKINGS: {
      LIST: '/admin134miqa0b/ajax-mobile-api.php?controller=AdminOrders&action=getOrders',
      GET: '/admin134miqa0b/ajax-mobile-api.php?controller=AdminOrders&action=getOrder',
      CREATE: '/admin134miqa0b/ajax-mobile-api.php?controller=AdminOrders&action=createBooking',
      UPDATE: '/admin134miqa0b/ajax-mobile-api.php?controller=AdminOrders&action=updateOrder',
      CHECK_IN: '/admin134miqa0b/ajax-mobile-api.php?controller=AdminOrders&action=checkIn',
      CHECK_OUT: '/admin134miqa0b/ajax-mobile-api.php?controller=AdminOrders&action=checkOut',
    },
    
    // Rooms (Products)
    ROOMS: {
      LIST: '/admin134miqa0b/ajax-mobile-api.php?controller=AdminProducts&action=getRooms',
      AVAILABLE: '/admin134miqa0b/ajax-mobile-api.php?controller=AdminProducts&action=getAvailableRooms',
      GET: '/admin134miqa0b/ajax-mobile-api.php?controller=AdminProducts&action=getRoom',
    },
    
    // Hotels
    HOTELS: {
      LIST: '/admin134miqa0b/ajax-mobile-api.php?controller=AdminHotels&action=getHotels',
      GET: '/admin134miqa0b/ajax-mobile-api.php?controller=AdminHotels&action=getHotel',
    },
    
    // Dashboard
    DASHBOARD: {
      STATS: '/admin134miqa0b/ajax-mobile-api.php?controller=AdminDashboard&action=getStats',
      TODAY_CHECKINS: '/admin134miqa0b/ajax-mobile-api.php?controller=AdminDashboard&action=getTodayCheckIns',
      TODAY_CHECKOUTS: '/admin134miqa0b/ajax-mobile-api.php?controller=AdminDashboard&action=getTodayCheckOuts',
    },
  },
  
  // Request timeout
  TIMEOUT: 30000, // 30 seconds
  
  // Headers
  HEADERS: {
    'Content-Type': 'application/json',
    'Accept': 'application/json',
  },
}

export default config
