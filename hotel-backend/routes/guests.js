const express = require('express');
const router = express.Router();
const GuestController = require('../controllers/guestController');
const authMiddleware = require('../middleware/auth');

// Temporarily disable auth for testing - TODO: Re-enable in production
// router.use(authMiddleware);

// Guest CRUD
router.get('/', GuestController.getAllGuests);
router.get('/:id', GuestController.getGuest);
router.post('/', GuestController.createGuest);
router.put('/:id', GuestController.updateGuest);
router.delete('/:id', GuestController.deleteGuest);

// Guest operations
router.put('/:id/checkin', GuestController.checkinGuest);
router.put('/:id/checkout', GuestController.checkoutGuest);
router.get('/status/:status', GuestController.getGuestsByStatus);

// Check-in and Check-out history
router.get('/checkins/all', GuestController.getAllCheckIns);
router.get('/checkins/active', GuestController.getActiveCheckIns);
router.get('/checkouts/all', GuestController.getAllCheckOuts);
router.get('/:id/history', GuestController.getGuestHistory);

module.exports = router;
