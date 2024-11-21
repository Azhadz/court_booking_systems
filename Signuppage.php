<?php
// PHP: Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Database configuration
    $servername = "localhost";
    $username = "root";
    $password = "Azhadz011221"; // Add your database password here
    $dbname = "court_booking_system"; // Replace with your database name

    // Establish database connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve and sanitize form inputs
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $password = $conn->real_escape_string($_POST['password']);
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hash the password for security

    // Check if the email already exists
    $checkEmailQuery = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($checkEmailQuery);

    if ($result->num_rows > 0) {
        echo "<script>alert('Email already exists. Please use a different email.');</script>";
    } else {
        // Insert the user into the database
        $sql = "INSERT INTO users (email, phone, password) VALUES ('$email', '$phone', '$hashedPassword')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Account created successfully!'); window.location.href = 'login.php';</script>";
        } else {
            echo "<script>alert('Error: " . $conn->error . "');</script>";
        }
    }

    // Close the connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup - Court Booking System</title>
    <style>
        /* Body Styling */
        body {
            font-family: 'Poppins', Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(
                rgba(0, 76, 63, 0.8),
                rgba(0, 76, 63, 0.8)
            ), url('https://source.unsplash.com/1600x900/?sports') no-repeat center center/cover;
            color: #fff;
        }

        /* Main Container Styling */
        .container {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            padding: 30px;
            width: 90%;
            max-width: 400px;
            box-sizing: border-box;
            color: #333;
            text-align: center;
        }

        /* Headings Styling */
        h2 {
            color: #004c3f;
            margin-bottom: 15px;
            font-size: 24px;
        }

        /* Form Group Styling */
        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-size: 14px;
            font-weight: bold;
            color: #004c3f;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .form-group input:focus {
            border-color: #004c3f;
            outline: none;
        }

        /* Button Styling */
        .submit-btn {
            background: #004c3f;
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            font-weight: bold;
            transition: background 0.3s ease;
        }

        .submit-btn:hover {
            background: #00382d;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            h2 {
                font-size: 20px;
            }

            .form-group input {
                font-size: 12px;
            }

            .submit-btn {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Create Your Account</h2>
        <form action="" method="POST">
            <!-- Email Field -->
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <!-- Phone Number Field -->
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" id="phone" name="phone" placeholder="Enter your phone number" required>
            </div>
            <!-- Password Field -->
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter a password" required>
            </div>
            <!-- Submit Button -->
            <button type="submit" class="submit-btn">Sign Up</button>
        </form>
        <p style="margin-top: 15px;">Already have an account? <a href="login.php" style="color: #004c3f; font-weight: bold;">Log in</a></p>
    </div>
</body>
</html>
