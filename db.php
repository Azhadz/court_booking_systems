<?php
$servername = "localhost";
$username = "root"; // Default for XAMPP
$password = "Azhadz011221"; // Default for XAMPP
$dbname = "court_booking_system"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
