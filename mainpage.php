<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Court Booking System - Main Page</title>
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
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            padding: 30px;
            width: 90%;
            max-width: 500px;
            box-sizing: border-box;
            text-align: center;
        }

        /* Headings Styling */
        h2 {
            color: #004c3f;
            margin-bottom: 10px;
            font-size: 28px;
        }

        p {
            margin-bottom: 20px;
            font-size: 16px;
            color: #555;
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

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: all 0.3s ease;
            box-sizing: border-box;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: #004c3f;
            outline: none;
        }

        /* Submit Button Styling */
        .submit-btn {
            background: #004c3f;
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            font-weight: bold;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        .submit-btn:hover {
            background: #00382d;
            transform: translateY(-2px);
        }

        .submit-btn:active {
            transform: translateY(1px);
        }

        /* Warning Message */
        .warning {
            font-size: 14px;
            margin-top: 10px;
            color: red;
            font-weight: bold;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            h2 {
                font-size: 24px;
            }

            .form-group input,
            .form-group select {
                font-size: 13px;
            }

            .submit-btn {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Welcome to the Court Booking System</h2>
        <p>Select a court and fill out the booking form</p>

        <!-- Booking Form -->
        <form action="submit_booking.php" method="POST">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" placeholder="Enter your name" required>
            </div>
            <div class="form-group">
                <label for="sport">Select Sport</label>
                <select id="sport" name="sport" required>
                    <option value="">-- Choose a Sport --</option>
                    <option value="Badminton">Badminton</option>
                    <option value="Futsal">Futsal</option>
                    <option value="Ping Pong">Ping Pong</option>
                </select>
            </div>
            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" id="date" name="date" required>
            </div>
            <div class="form-group">
                <label for="time">Time</label>
                <select id="time" name="time" required>
                    <option value="">-- Select Time --</option>
                    <option value="09:00">9:00 AM</option>
                    <option value="10:00">10:00 AM</option>
                    <option value="11:00">11:00 AM</option>
                    <option value="12:00">12:00 PM</option>
                    <option value="01:00">1:00 PM</option>
                    <option value="02:00">2:00 PM</option>
                    <option value="03:00">3:00 PM</option>
                    <option value="04:00">4:00 PM</option>
                    <option value="05:00">5:00 PM</option>
                    <option value="06:00">6:00 PM</option>
                    <option value="07:00">7:00 PM</option>
                    <option value="08:00">8:00 PM</option>
                    <option value="09:00">9:00 PM</option>
                </select>
            </div>
            <div class="form-group">
                <label for="duration">Duration (Hours)</label>
                <select id="duration" name="duration" required>
                    <option value="1">1 Hour</option>
                    <option value="2">2 Hours</option>
                    <option value="3">3 Hours</option>
                </select>
            </div>

            <!-- Warning message -->
            <div class="warning" id="warning-message">Please select a sport, date, and time.</div>

            <button type="submit" class="submit-btn">Submit Booking</button>
        </form>
    </div>

    <script>
        // Set the minimum date to today's date
        window.onload = function() {
            const dateInput = document.getElementById("date");
            const today = new Date();
            const yyyy = today.getFullYear();
            const mm = String(today.getMonth() + 1).padStart(2, '0'); // Add leading zero
            const dd = String(today.getDate()).padStart(2, '0'); // Add leading zero
            dateInput.min = `${yyyy}-${mm}-${dd}`; // Format as YYYY-MM-DD
        };
    </script>
</body>
</html>
