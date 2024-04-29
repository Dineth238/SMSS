// Define a function to handle user log-in
function logIn(event) {
  event.preventDefault();
  const loginUsername = document.getElementById('login-username').value;
  const loginPassword = document.getElementById('login-password').value;
  
  // Send login credentials to server for validation
  fetch('/login', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({ username: loginUsername, password: loginPassword })
  })
  .then(response => {
    if (response.ok) {
      // User logged in successfully
      console.log('User logged in successfully');
      // Redirect to dashboard or homepage
      window.location.href = '/dashboard.html'; // Example redirection
    } else {
      // Failed to log in
      console.error('Failed to log in');
      // Display error message to the user
      // You can update the DOM to display an error message to the user
    }
  })
  .catch(error => {
    console.error('Error logging in:', error);
    // Handle other errors (e.g., network error)
  });
}

// Attach event listener to log-in form
document.getElementById('login-form').addEventListener('submit', logIn);

// Define variables for user types
const USER_TYPES = {
  SPONSOR: 'sponsor',
  CLUB: 'club'
};

// Define a function to handle user sign-up
function signUp(event) {
  event.preventDefault();
  const userType = document.getElementById('user-type').value;
  const username = document.getElementById('username').value;
  const password = document.getElementById('password').value;
  
  // Send sign-up data to server
  fetch('/signup', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({ userType, username, password })
  })
  .then(response => {
    if (response.ok) {
      // User signed up successfully
      console.log('User signed up successfully');
      // Redirect to login page or dashboard
      window.location.href = '/login.html'; // Example redirection
    } else {
      // Failed to sign up
      console.error('Failed to sign up');
      // Display error message to the user
      // You can update the DOM to display an error message to the user
    }
  })
  .catch(error => {
    console.error('Error signing up:', error);
    // Handle other errors (e.g., network error)
  });
}

// Attach event listener to sign-up form
document.getElementById('signup-form').addEventListener('submit', signUp);
