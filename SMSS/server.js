// server.js

const express = require('express');
const mysql = require('mysql');
const bodyParser = require('body-parser');

const app = express();
const port = 3000;

// MySQL database connection
const db = mysql.createConnection({
  host: 'localhost',
  user: 'your_username',
  password: 'your_password',
  database: 'sponsorship_management'
});

db.connect((err) => {
  if (err) {
    throw err;
  }
  console.log('MySQL connected');
});

// Middleware
app.use(bodyParser.urlencoded({ extended: false }));
app.use(bodyParser.json());

// Sign-up endpoint
app.post('/signup', (req, res) => {
  const { username, password } = req.body;

  // Insert user into database
  const sql = 'INSERT INTO users (username, password) VALUES (?, ?)';
  db.query(sql, [username, password], (err, result) => {
    if (err) {
      res.status(500).json({ error: 'Error signing up user' });
    } else {
      res.status(200).json({ message: 'User signed up successfully' });
    }
  });
});

// Log-in endpoint
app.post('/login', (req, res) => {
  const { username, password } = req.body;

  // Check if user exists in database
  const sql = 'SELECT * FROM users WHERE username = ? AND password = ?';
  db.query(sql, [username, password], (err, result) => {
    if (err) {
      res.status(500).json({ error: 'Error logging in user' });
    } else if (result.length === 0) {
      res.status(401).json({ error: 'Invalid username or password' });
    } else {
      res.status(200).json({ message: 'User logged in successfully' });
      console.log("login successfull");
    }
  });
});

// Start server
app.listen(port, () => {
  console.log(`Server running on port ${port}`);
});
