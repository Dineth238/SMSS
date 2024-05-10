<?php
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Connect to the database (replace these values with your actual database credentials)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "SMSS";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement to fetch user from database
    $sql = "SELECT * FROM Signup_Details WHERE Email_Address = '$email'";
    $result = $conn->query($sql);

    if ($result) {
        if ($result->num_rows == 1) {
            // User found, verify password
            $row = $result->fetch_assoc();
            $hashed_password = $row['Password'];

            // Check if the entered password matches the hashed password
            if (password_verify($password, $hashed_password)) {
                // Password is correct, set session variables
                $_SESSION['user_id'] = $row['ID'];
                $_SESSION['user_type'] = $row['User_Type'];

                // Redirect user based on user type
                if ($row['User_Type'] == 'sponsor') {
                    header("Location: Sponsorview/home.html");
                    exit();
                } elseif ($row['User_Type'] == 'club') {
                    header("Location: Clubview/home.html");
                    exit();
                }
            } else {
                // Incorrect password
                echo "Incorrect password.";
            }
        } else {
            // User not found
            echo "User not found.";
        }
    } else {
        // Query failed, display error
        echo "Error: " . $conn->error;
    }

    // Close connection
    $conn->close();
}
?>
