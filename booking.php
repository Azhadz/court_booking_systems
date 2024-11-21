<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $date = $_POST['booking_date'];
    $time = $_POST['booking_time'];
    $duration = $_POST['duration'];

    // Assume `user_id` is obtained after login
    session_start();
    $user_id = $_SESSION['user_id'];

    // Insert the booking details into the database
    $sql = "INSERT INTO bookings (user_id, name, booking_date, booking_time, duration) 
            VALUES ('$user_id', '$name', '$date', '$time', '$duration')";

    if ($conn->query($sql) === TRUE) {
        echo "Booking successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
