const express = require('express');
const router = express.Router();
const db = require('./db');

// Middleware for handling errors
const handleErrors = (res, error, message) => {
  console.error(message, error);
  res.status(500).json({ error: 'Internal Server Error' });
};

// Login route with parameterized query
router.post('/login', (req, res) => {
  const { username, password } = req.body;

  // Perform authentication check against your MySQL database
  // Example query: SELECT * FROM users WHERE username = ? AND password = ?;
  db.query('SELECT * FROM users WHERE username = ? AND password = ?', [username, password], (err, results) => {
    if (err) {
      handleErrors(res, err, 'Error executing MySQL query for login:');
      return;
    }

    if (results.length > 0) {
      // User authenticated successfully
      res.json({ success: true, user: results[0] });
    } else {
      // Invalid credentials
      res.status(401).json({ error: 'Invalid credentials' });
    }
  });
});

// Customer route with parameterized query
router.get('/customer', (req, res) => {
  // Perform a simple query to get all customers from the 'court' table
  db.query('SELECT * FROM court', (err, results) => {
    if (err) {
      handleErrors(res, err, 'Error executing MySQL query for customer data:');
      return;
    }

    // Send the results as JSON
    res.json({ success: true, customers: results });
  });
});


router.get('/payments', async (req, res) => {
  try {
    const [results] = await db.promise().query(`
      SELECT booking.*, court.name AS court_name, court.email AS court_email, court.contact AS court_contact
      FROM booking
      JOIN court ON booking.court_id = court.id
    `);

    res.json({ success: true, payments: results });
  } catch (err) {
    handleErrors(res, err, 'Error executing MySQL query for payment data:');
  }
});

router.get('/totalBookings', async (req, res) => {
  try {
    const [result] = await db.promise().query('SELECT COUNT(*) AS totalBookings FROM booking');
    
    res.json({ success: true, totalBookings: result[0].totalBookings });
  } catch (err) {
    handleErrors(res, err, 'Error executing MySQL query for total bookings:');
  }
});





module.exports = router;
