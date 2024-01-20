// api.js
const express = require('express');
const router = express.Router();
const db = require('./db');

router.post('/login', (req, res) => {
  const { username, password } = req.body;

  // Perform authentication check against your MySQL database
  // Example query: SELECT * FROM users WHERE username = ? AND password = ?;
  db.query('SELECT * FROM users WHERE username = ? AND password = ?', [username, password], (err, results) => {
    if (err) {
      console.error('Error executing MySQL query:', err);
      res.status(500).json({ error: 'Internal Server Error' });
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

module.exports = router;
