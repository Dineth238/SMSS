document.getElementById('login-button').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the form from submitting

    // Get form data
    var userType = document.getElementById('user-type').value;
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;

    // Send AJAX request to login.php
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'login.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Request successful
                var response = xhr.responseText;
                if (response === 'User not found.') {
                    // Handle user not found error
                    alert(response);
                } else if (response === 'Incorrect password.') {
                    // Handle incorrect password error
                    alert(response);
                } else {
                    // Redirect to the appropriate page
                    window.location.href = response;
                }
            } else {
                // Request failed
                alert('Error: ' + xhr.statusText);
            }
        }
    };
    var formData = 'user-type=' + encodeURIComponent(userType) + '&email=' + encodeURIComponent(email) + '&password=' + encodeURIComponent(password);
    xhr.send(formData);
});
