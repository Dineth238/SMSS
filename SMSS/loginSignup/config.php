<?php
// Establishing connection to MySQL database
$conn = mysqli_connect("localhost", "root", "", "user_db");

// Check connection
if (!$conn) {
    // If connection fails, output an error message and terminate script
    die("Connection failed: " . mysqli_connect_error());
}
?>
