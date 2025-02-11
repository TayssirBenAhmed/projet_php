<?php
session_start();
$conn = new mysqli("localhost", "root", "", "mydb");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle login and registration
$error_message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $phone = $_POST['phone'];
    $name = $_POST['name'] ?? null;

    // Check if the user exists in the database
    $stmt = $conn->prepare("SELECT * FROM users WHERE phone = ?");
    $stmt->bind_param("s", $phone);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User exists, log them in
        $_SESSION['user_phone'] = $phone;
        header("Location: choice.php"); // Redirect to choice page
        exit();
    } else {
        if ($name) {
            // New user registration
            $stmt = $conn->prepare("INSERT INTO users (name, phone) VALUES (?, ?)");
            $stmt->bind_param("ss", $name, $phone);
            if ($stmt->execute()) {
                $_SESSION['user_phone'] = $phone;
                header("Location: choice.php"); // Redirect to choice page
                exit();
            } else {
                $error_message = "Error while saving your data. Please try again.";
            }
        } else {
            // Prompt for registration
            $error_message = "Phone number not found. Please register by providing your name.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🔒 Welcome | Login or Register</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #8e44ad, #f39c12);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            transition: background 0.3s, transform 0.3s;
        }

        

        .login-container {
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            max-width: 450px;
            width: 100%;
            padding: 30px;
            text-align: center;
        }

        .login-container h2 {
            color: #6a0dad;
            margin-bottom: 15px;
        }

        .login-container p {
            font-size: 1rem;
            color: #555;
            margin-bottom: 20px;
        }

        .login-container p em {
            font-style: italic;
            color: #2c3e50;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: 2px solid #6a0dad;
            font-size: 1rem;
        }

        .btn-login {
            background: linear-gradient(135deg, #6a0dad, #f39c12);
            color: white;
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .btn-login:hover {
            background: #e67e22;
        }

        .error-message {
            color: red;
            font-size: 0.9rem;
            margin-bottom: 20px;
        }

        .news-container {
            margin-top: 30px;
            text-align: left;
        }

        .news-card {
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            margin-bottom: 20px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .news-card:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        }

        .news-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }

        .news-card-content {
            padding: 15px;
        }

        .news-title {
            font-size: 1.1rem;
            font-weight: bold;
            color: #6a0dad;
            margin-bottom: 10px;
        }

        .news-date {
            font-size: 0.9rem;
            color: #7f8c8d;
            margin-bottom: 10px;
        }

        .news-description {
            font-size: 0.95rem;
            color: #2c3e50;
        }
    </style>
</head>
<body>
<div class="login-container">
    <h2>🔒 Welcome to Login or Register</h2>
    <p><em>🌟 Secure your access with your phone number.</em></p>
    <p><em>✨ Not registered? Add your name and join us today!</em></p>

    <?php if (!empty($error_message)): ?>
        <p class="error-message">⚠️ <?= $error_message ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="form-group">
            <label for="phone">📱 Phone Number</label>
            <input 
                type="password" 
                id="phone" 
                name="phone" 
                class="form-control" 
                placeholder="Enter your phone number (8 digits)" 
                required 
                pattern="[0-9]{8}" 
                title="The phone number must be exactly 8 digits."
            >
        </div>
        <div class="form-group">
            <label for="name">🖊️ Name (Optional)</label>
            <input 
                type="text" 
                id="name" 
                name="name" 
                class="form-control" 
                placeholder="Enter your name if registering"
            >
        </div>
        <button type="submit" class="btn-login">Submit</button>
    </form>

    <div class="news-container">
        <h3>📢 Latest News</h3>

        <div class="news-card">
            <img src="https://www.shutterstock.com/image-photo/news-word-made-wooden-cubes-260nw-2502962335.jpg" alt="News Image">
            <div class="news-card-content">
                <p class="news-title">🌟 New Features Launched!</p>
                <p class="news-date">January 24, 2025</p>
                <p class="news-description">Experience our new design and enhanced features for a better user journey.</p>
            </div>
        </div>

        <div class="news-card">
            <img src="https://pixelsagency.fr/wp-content/uploads/2021/04/maintenance-site-web.jpg" alt="News Image">
            <div class="news-card-content">
                <p class="news-title">⚙️ Scheduled Maintenance</p>
                <p class="news-date">January 26, 2025</p>
                <p class="news-description">Our platform will be down for maintenance from 12:00 AM to 4:00 AM. We appreciate your patience.</p>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    <?php if (!empty($error_message)): ?>
        toastr.error("<?= $error_message ?>");
    <?php endif; ?>
</script>
</body>
</html>

