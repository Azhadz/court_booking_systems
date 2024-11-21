<?php
// Database connection settings
$servername = "localhost";
$username = "root"; // Replace with your DB username
$password = "Azhadz011221";     // Replace with your DB password
$dbname = "court_booking_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Prepare the SQL statement to fetch the user
    $stmt = $conn->prepare("SELECT password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);

    // Execute and fetch the result
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashedPassword);
        $stmt->fetch();

        // Verify the hashed password
        if (password_verify($password, $hashedPassword)) {
            echo "<script>alert('Login successful!'); window.location.href = 'mainpage.php';</script>";
        } else {
            echo "<script>alert('Invalid password.');</script>";
        }
    } else {
        echo "<script>alert('No user found with that email address.');</script>";
    }

    // Close statement and connection
    $stmt->close();
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Court Booking System</title>
    <style>
        body {
            font-family: 'Poppins', Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: linear-gradient(
                rgba(0, 76, 63, 0.8),
                rgba(0, 76, 63, 0.8)
            ), url('https://source.unsplash.com/1600x900/?court') no-repeat center center/cover;
            color: #fff;
        }
        .login-container {
            width: 400px;
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            box-sizing: border-box;
        }
        .login-container h2 {
            color: #004c3f;
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
        }
        td {
            padding: 10px;
            vertical-align: middle;
        }
        label {
            color: #004c3f; /* Green color for labels */
        }
        input[type="email"], input[type="password"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            transition: all 0.3s ease;
        }
        input[type="email"]:focus, input[type="password"]:focus {
            border-color: #004c3f;
            outline: none;
        }
        .remember-me {
            display: flex;
            align-items: center;
            font-size: 14px;
        }
        .remember-me input {
            margin-right: 10px;
        }
        .login-btn {
            width: 100%;
            background-color: #004c3f;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .login-btn:hover {
            background-color: #00382d;
        }
        .links {
            margin-top: 20px;
            text-align: center;
            font-size: 14px;
        }
        .links a {
            color: #004c3f;
            text-decoration: none;
            font-weight: bold;
        }
        .links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Log in to CourtMate!</h2>
        <form method="POST" action="">
            <table>
                <tr>
                    <td><label for="email">Email:</label></td>
                    <td><input type="email" id="email" name="email" placeholder="your@email.com" required></td>
                </tr>
                <tr>
                    <td><label for="password">Password:</label></td>
                    <td><input type="password" id="password" name="password" placeholder="Your password" required></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="remember-me">
                            <input type="checkbox" id="remember-me" name="remember">
                            <label for="remember-me">Remember me</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button type="submit" class="login-btn">Log in</button>
                    </td>
                </tr>
            </table>
        </form>
        <div class="links">
            <p><a href="ForgotPass.html">Forgot password or can't login?</a></p>
            <p><a href="Signuppage.php">Sign Up ?</a></p>
        </div>
    </div>
</body>
</html>
