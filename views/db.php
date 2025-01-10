<?php
// Database connection parameters
$host = 'localhost';
$username = 'root';  // Update with your MySQL username
$password = '';      // Update with your MySQL password
$database = 'student_counseling';

// Create a new connection to the database
$conn = new mysqli($host, $username, $password, $database);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
