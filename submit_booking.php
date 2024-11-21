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

// Retrieve form data
$name = $_POST['name'] ?? null;
$sport = $_POST['sport'] ?? null;
$date = $_POST['date'] ?? null;
$time = $_POST['time'] ?? null;
$duration = $_POST['duration'] ?? null;

// Validate that all fields are filled
if (!$name || !$sport || !$date || !$time || !$duration) {
    die("Error: All fields are required.");
}

// Generate a unique booking reference
$booking_ref = 'BOOK-' . strtoupper(uniqid());

// Insert booking into the database
$stmt = $conn->prepare("INSERT INTO bookings (name, sport, booking_date, booking_time, duration, booking_ref) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssis", $name, $sport, $date, $time, $duration, $booking_ref);

if ($stmt->execute()) {
    // Successful booking message with styled design
    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Booking Successful</title>
        <style>
            body {
                font-family: 'Arial', sans-serif;
                background-color: #f4f4f4;
                margin: 0;
                padding: 0;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
            }
            .container {
                background: #ffffff;
                border-radius: 8px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
                padding: 20px;
                text-align: center;
                width: 90%;
                max-width: 600px;
            }
            h2 {
                color: #004c3f;
                font-size: 2rem;
            }
            p {
                font-size: 1.2rem;
                color: #333;
                margin-bottom: 20px;
            }
            .button {
                background: #004c3f;
                color: #fff;
                padding: 10px 20px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                text-decoration: none;
                font-size: 1.2rem;
                display: inline-block;
                margin-top: 20px;
            }
            .button:hover {
                background: #00382d;
            }
            .thank-you {
                font-size: 1.5rem;
                margin-top: 40px;
                color: #4CAF50;
            }
        </style>
    </head>
    <body>
        <div class='container'>
            <h2>Booking Successful!</h2>
            <p>Thank you, <strong>$name</strong>, for booking the <strong>$sport</strong> court on <strong>$date</strong> at <strong>$time</strong> for <strong>$duration hour(s)</strong>.</p>
            <p>Your booking reference is: <strong>$booking_ref</strong></p>
            <p>Please show this reference when you arrive at the counter.</p>

            <p class='thank-you'>Thank you for using our Court Booking System. We look forward to seeing you!</p>
            
            <a href='homepage.html' class='button' onclick='confirmLogout()'>Logout</a>
            <a href='mainpage.php' class='button'>Go to Booking Page</a>
        </div>

        <script>
            function confirmLogout() {
                if (confirm('Thank you for having us! See you again soon! Do you want to logout?')) {
                    window.location.href = 'homepage.php'; // Redirect to the homepage
                }
            }
        </script>
    </body>
    </html>";
} else {
    echo "Error: " . $stmt->error;
}

// Close connections
$stmt->close();
$conn->close();
?>
