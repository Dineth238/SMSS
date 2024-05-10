<?php
// Check if form data is received
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $userType = $_POST['user-type'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate form data (you may add more validation if needed)
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Invalid email format
        echo "Invalid email format";
        exit;
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Connect to MySQL database
    $servername = "localhost"; // Change this to your MySQL server hostname
    $username = "root"; // Change this to your MySQL username
    $password = ""; // Change this to your MySQL password
    $dbname = "SMSS"; // Change this to your database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to insert data into database
    $sql = "INSERT INTO Signup_Details (User_Type, Email_Address, Password) VALUES ('$userType', '$email', '$hashedPassword')";

    if ($conn->query($sql) === TRUE) {
        echo "Signup successful"; // Response message sent back to JavaScript
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    } else {
        echo "Error: Form data not received";
    }

?>
