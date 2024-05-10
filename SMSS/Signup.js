document.getElementById('signup_button').addEventListener('click', function() {
    // Get form data
    var userType = document.getElementById('user-type').value;
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;
    var repassword = document.getElementById('repassword').value;

    // Validate password
    if (password !== repassword) {
        alert("Passwords do not match");
        return;
    }

    // Send form data to PHP script using AJAX
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'Signup.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (xhr.status === 200) {
            // Handle successful response
            alert(xhr.responseText); // Display response from PHP script
            // Redirect or perform any other actions as needed
        } else {
            // Handle error
            alert('Error: ' + xhr.statusText);
        }
    };
    xhr.onerror = function() {
        // Handle network errors
        alert('Network Error');
    };
    xhr.send('user-type=' + userType + '&email=' + email + '&password=' + password); // Send form data to PHP script
});
