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

// Insert booking into the database
$stmt = $conn->prepare("INSERT INTO bookings (name, sport, booking_date, booking_time, duration) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("ssssi", $name, $sport, $date, $time, $duration);

if ($stmt->execute()) {
    // Display a creative success page
    echo "
    <!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Booking Successful</title>
        <style>
            body {
                font-family: 'Arial', sans-serif;
                background: #f0f4f8;
                color: #333;
                text-align: center;
                padding: 40px;
            }
            .container {
                background-color: #fff;
                padding: 40px;
                border-radius: 10px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
                max-width: 600px;
                margin: 0 auto;
                text-align: center;
            }
            h2 {
                color: #00796b;
            }
            .message {
                font-size: 18px;
                margin: 20px 0;
                color: #333;
            }
            .message strong {
                color: #004d40;
            }
            .btn {
                background-color: #00796b;
                color: white;
                padding: 12px 30px;
                text-decoration: none;
                border-radius: 5px;
                margin-top: 20px;
                font-size: 16px;
                display: inline-block;
            }
            .btn:hover {
                background-color: #004d40;
            }
            .btn-logout {
                background-color: #f44336;
                margin-top: 20px;
            }
            .btn-logout:hover {
                background-color: #d32f2f;
            }
        </style>
    </head>
    <body>

        <div class='container'>
            <h2>Booking Successful!</h2>
            <p class='message'>
                <strong>Thank you, $name, for booking the $sport court!</strong><br>
                Your booking is confirmed for <strong>$date</strong> at <strong>$time</strong> for <strong>$duration hour(s)</strong>.
            </p>

            <p>We are thrilled to have you with us. We hope you enjoy your time on the court!</p>
            <a href='mainpage.php' class='btn'>Go to Homepage</a>
            <a href='booking_page.php' class='btn'>Make Another Booking</a>

            <br>
            <button onclick='logout()' class='btn btn-logout'>Logout</button>
        </div>

        <script>
            function logout() {
                if (confirm('Thank you for having us! See you next time. Are you sure you want to logout?')) {
                    window.location.href = 'logout.php'; // Redirect to logout page (you will need to create this)
                }
            }
        </script>

    </body>
    </html>";
} else {
    // If error occurs, show the error message
    echo "Error: " . $stmt->error;
}

// Close connections
$stmt->close();
$conn->close();
?>
