<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviews App</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #9b59b6, #f39c12);
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }
        p{
            text-align: center;

            font-size: 1.5rem;        }

        /* Navbar styles */
        .navbar {
            background: linear-gradient(135deg, #6a0dad, #ff7f00);
            padding: 10px 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        .navbar-brand {
            font-size: 1.8rem;
            font-weight: bold;
            color: white;
            letter-spacing: 1.5px;
            position: relative;

        }

        .navbar-brand::after {
            content:'🩺';
            font-size: 1.8rem;
            position: absolute;
            top: 1;
            right: -40px;
        }

        .navbar-brand:hover {
            color: #ffea00;
        }

        .navbar-nav .nav-link {
            color: white;
            font-size: 1.1rem;
            margin-right: 20px;
            transition: color 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            color: #ffea00;
        }

        .navbar-toggler {
            background-color: white;
            border: none;
        }

        .navbar-toggler-icon {
            background-color: white;
        }

        /* Sidebar styles */
        .sidebar {
            position: fixed;
            height: 100vh;
            width: 300px;
            background: linear-gradient(135deg, #6a0dad, #ff7f00);
            padding: 20px;
            overflow-y: auto;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.3);
            animation: slideIn 0.5s ease;
        }

        @keyframes slideIn {
            from {
                left: -350px;
            }
            to {
                left: 0;
            }
        }

        .sidebar .nav-link {
            color: white;
            font-size: 1.2rem;
            letter-spacing: 1.5px;
            margin-bottom: 10px;
            transition: transform 0.3s ease, background 0.3s ease;
        }

        .sidebar .nav-link:hover {
            background: rgba(255, 255, 255, 0.2);
            color: #ffea00;
            transform: translateX(10px);
        }

        .content-wrapper {
            margin-left: 300px;
            padding: 20px;
        }

        h1 {
            color: #6a0dad;
    font-size: 4rem;
    text-align: center;

    font-weight: bold;
    text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
    animation: fadeIn 1s ease;
}


        h2 {
            font-size: 2.2rem;
            color: orange;
            font-style: italic;
            animation: slideInTitle 2s ease;
            text-align: center;
            letter-spacing: 1px;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes slideInTitle {
            from {
                transform: translateX(-100%);
            }
            to {
                transform: translateX(0);
            }
        }

        footer {
            text-align: center;
            padding: 20px;
            color: white;
            background: linear-gradient(135deg, #6a0dad, #ff7f00);
            margin-top: auto;
        }

        footer a {
            color: #ffea00;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }

        .animated-icon {
            font-size: 1.5rem;
            color: white;
            animation: bounce 1s infinite;
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-10px);
            }
            60% {
                transform: translateY(-5px);
            }
        }

        /* Portal sections in sidebar */
        .portal-title {
            font-size: 1.6rem;
            color: #ffea00;
            font-weight: bold;
            text-align: center;
            padding:20px;
            margin-bottom: 20px;
            animation: slideInTitle 2s ease;
        }

        .patient-portal, .clinic-portal {
            margin-top: 40px;
            padding: 20px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            animation: fadeIn 1s ease;
        }

        .patient-portal ul, .clinic-portal ul {
            padding-left: 20px;
        }
        .text-white.text-center {
    position: relative;
    font-size: 2.8rem; /* Taille du titre */
    font-weight: bold;
    text-transform: uppercase;
    text-align: center;
    background: linear-gradient(135deg, #6a0dad, #ff7f00, #ffea00);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent; /* Applique le dégradé au texte */
    letter-spacing: 3px;
    margin-bottom: 20px;
    transition: transform 0.3s ease, letter-spacing 0.3s ease;
}

/* Ajout d'un effet subtil au survol */
.text-white.text-center:hover {
    transform: scale(1.05); /* Agrandit légèrement le texte */
    letter-spacing: 5px; /* Espacement des lettres augmenté */
}

/* Texte additionnel */
.text-white.text-center::before {
    content: 'Welcome to'; /* Texte d'introduction */
    display: block;
    font-size: 1.5rem;
    color: #ffea00; /* Jaune doré */
    margin-bottom: 10px;
    text-align: center;
}

.text-white.text-center {
    position: relative;
    font-size: 3rem; /* Taille du titre */
    font-weight: bold;
    text-transform: uppercase;
    text-align: center;
    color: #ffffff; /* Blanc pur pour le texte principal */
    letter-spacing: 2px;
    margin-bottom: 20px;
}

/* Texte avec un emoji avant */
.text-white.text-center::before {
    content: ' Welcome to '; /* Emoji ordinateur et clinique */
    display: block;
    font-size: 1.5rem;
    font-weight: normal;
    color: #7f00ff; /* Violet Royal */
    margin-bottom: 10px;
    animation: fadeInMove 1.5s ease-in-out;
    text-align: center;
}

/* Animation subtile pour l'apparition */
@keyframes fadeInMove {
    0% {
        opacity: 0;
        transform: translateY(-10px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Dégradé violet royal au texte */
.text-white.text-center span {
    background: linear-gradient(135deg, #7f00ff, #e100ff); /* Violet royal et rose vif */
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent; /* Applique le dégradé */
    display: inline-block;
    transition: transform 0.3s ease, letter-spacing 0.3s ease;
}

/* Effet au survol */
.text-white.text-center:hover span {
    transform: scale(1.05); /* Légère mise en avant */
    letter-spacing: 3px; /* Espacement légèrement augmenté */
    background: linear-gradient(135deg, #e100ff, #7f00ff); /* Inverse le dégradé au survol */
}

    </style>
</head>
<body>
    <!-- Top Navbar -->
    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand" href="index.php">
        HealthSys
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php"><i class="fas fa-home"></i> Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php"><i class="fas fa-info-circle"></i> About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php"><i class="fas fa-envelope"></i> Contact</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Sidebar -->
    <nav class="sidebar">
        <h2 class="text-white text-center"> CliniSys</h2>
        
        <!-- Patient Portal Section -->
        <div class="patient-portal">
            <h3 class="portal-title">👩‍⚕️ Patient Portal</h3>
            <ul class="navbar-nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="login.php"><i class="fas fa-user-circle"></i> Secure Login Access</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="appointments.php"><i class="fas fa-calendar-alt"></i> Reserve an Appointment</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="addreview.php"><i class="fas fa-comment-alt"></i> Share Your Feedback</a>
                </li>
            </ul>
        </div>

        <!-- Clinic Portal Section -->
        <div class="clinic-portal">
            <h3 class="portal-title">🏥 Clinic Portal</h3>
            <ul class="navbar-nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="listappointments.php"><i class="fas fa-calendar-check"></i> Appointment Overview</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="reviews.php"><i class="fas fa-star"></i> Customer Reviews</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="statistics.php"><i class="fas fa-chart-line"></i> Clinic Analytics</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="content-wrapper">
        <h1>Welcome to our plateform</h1>
        <h2>🏥 Hospital Information System 🏥</h2>
        <p>Explore our services and manage your appointments easily with our user-friendly platform.</p>
    </div>

    <!-- Footer -->
    
    <!-- Bootstrap and Font Awesome Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
