<?php
// Database connection settings
$host = "localhost";
$username = "root";
$password = "Azhadz011221"; // Replace with your database password
$dbname = "court_booking_system"; // Replace with your database name

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the sport, date, and time from the query string
$sport = $_GET['sport'] ?? '';
$date = $_GET['date'] ?? '';
$time = $_GET['time'] ?? '';

// Prepare the query to check how many bookings exist for the selected sport, date, and time
$query = "SELECT COUNT(*) AS total_bookings FROM bookings WHERE sport = ? AND booking_date = ? AND booking_time = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("sss", $sport, $date, $time);
$stmt->execute();
$stmt->bind_result($total_bookings);
$stmt->fetch();
$stmt->close();

// Check if there are less than 5 bookings
$available = ($total_bookings < 5);

// Return the result as JSON
echo json_encode([
    'available' => $available,
    'booked' => $total_bookings
]);

// Close connection
$conn->close();
?>
