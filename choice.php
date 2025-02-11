<?php
session_start();
if (!isset($_SESSION['user_phone'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choose Action</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: linear-gradient(135deg, #9b59b6, #f39c12);
        }

        .btn {
            display: inline-block;
            margin: 10px;
            padding: 10px 20px;
            color: white;
            background: #6a0dad;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            font-size: 1.2rem;
            transition: background 0.3s ease;
        }

        .btn:hover {
            background: #f39c12;
        }
    </style>
</head>
<body>
    <h2>Welcome, <?= htmlspecialchars($_SESSION['user_phone']) ?>!</h2>
    <p>What would you like to do?</p>
    <a href="addreview.php" class="btn">Add a Review</a>
    <a href="appointments.php" class="btn">Book an Appointment</a>
</body>
</html>
