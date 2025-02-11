<?php


// Connexion à la base de données
$conn = new mysqli("localhost", "root", "", "mydb");

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

// Variable pour le message Toastr
$message = '';
$messageType = '';

// Traitement du formulaire d'ajout d'un rendez-vous
if (isset($_POST['submit'])) {
    $service = $_POST['service'];
    $appointment_time = $_POST['appointment_time'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    // Insertion des données de rendez-vous
    $stmt = $conn->prepare("INSERT INTO appointments (service_name, appointment_time, patient_name, phone, email) VALUES (?, ?, ?, ?, ?)");
    if (!$stmt) {
        $message = "Erreur de préparation de la requête pour appointments : " . $conn->error;
        $messageType = "error";
    } else {
        $stmt->bind_param("sssss", $service, $appointment_time, $name, $phone, $email);

        if ($stmt->execute()) {
            $message = "Appointment Added successfully !";
            $messageType = "success";
        } else {
            $message = "Erreur lors de l'ajout du rendez-vous : " . $stmt->error;
            $messageType = "error";
        }
    }
}

// Fermeture de la connexion à la base de données
$conn->close();
?>

<!-- HTML -->

<div class="appointments-container">
    <header>
        <h1>Book Your Medical Appointment📅</h1>
        <hr />
        <p>Get the best care from our expert team. Choose a service, time, and let us take care of the rest!🩺</p>
    </header>

    <section class="appointments-content">
        <!-- Notifications Toastr -->
        <form method="POST" action="">
            <!-- Service Selection -->
            <div class="service-selection">
                <h2>Select a Service</h2>
                <select id="serviceSelect" name="service" required>
                    <option value="" disabled selected>Choose a service</option>
                    <option value="Urgence">🏥Urgency</option>
                    <option value="Cardiology">❤️Cardiology</option>
                    <option value="Dentist">🦷Dentist</option>
                </select>
            </div>

            <!-- Time Slot Selection -->
            <div class="time-selection">
                <h2>Choose a Time Slot</h2>
                <input type="datetime-local" id="appointmentTime" name="appointment_time" required />
            </div>

            <!-- Patient Details -->
            <div class="patient-details">
                <h2>Your Information</h2>
                <label for="patientName">Name:</label>
                <input type="text" id="patientName" name="name" placeholder="Enter your name" required />

                <div class="input-section phone-section">
                    <label for="phone">Phone:</label>
                    <div class="phone-input">
                        <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" required />
                    </div>
                </div>

                <label for="patientEmail">Email:</label>
                <input type="email" id="patientEmail" name="email" placeholder="Enter your email address" required />
            </div>

            <!-- Submit and Reset Buttons -->
            <div class="appointment-buttons">
                <button type="submit" name="submit" id="bookAppointmentBtn">Book Appointment✅</button>
                <button type="reset" id="resetBtn">Reset🔄</button>
            </div>
        </form>
    </section>
</div>

<!-- Toastr Notifications -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    // Configuration des options de Toastr
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

    // Affichage du message Toastr si disponible
    <?php if (!empty($message)) : ?>
        toastr["<?php echo $messageType; ?>"]("<?php echo $message; ?>");
    <?php endif; ?>
</script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<script>
    window.onload = function() {
        // Initialiser le champ téléphone avec intl-tel-input
        var input = document.querySelector("#phone");
        var iti = window.intlTelInput(input, {
            initialCountry: "tn", // définir le pays par défaut
            preferredCountries: ["us", "gb", "fr", "ca"], // pays préférés
            separateDialCode: true, // afficher le code pays séparément
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js" // script d'utils pour validation
        });
    }
</script>


<!-- Styles CSS -->
<style>
    body {
        font-family: 'Roboto', sans-serif;
        background: linear-gradient(135deg, #f8f9ff, #f7f1ff);
        color: #333;
        overflow-x: hidden;
    }

    header {
        text-align: center;
        margin-top: 50px;
        margin-bottom: 20px;
    }

    h1 {
        color: #6a0dad;
        font-size: 2.5rem;
    }

    h2 {
        color: #6a0dad;
        font-size: 1.8rem;
        margin-bottom: 10px;
    }

    p {
        font-size: 1.2rem;
        color: #ff7f00;
        margin-bottom: 20px;
    }

    .appointments-container {
        background-color: #ffffff;
        border-radius: 12px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        max-width: 800px;
        margin: 150px auto;
        padding: 30px;
        text-align: left;
        flex-grow: 1;
    }

    input[type="text"], input[type="tel"], input[type="email"], input[type="datetime-local"], select {
        width: 100%;
        padding: 15px;
        margin: 10px 0;
        border: 2px solid #ff7f00;
        border-radius: 8px;
        font-size: 1rem;
        box-shadow: inset 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    input:focus, select:focus {
        border-color: #6a0dad;
        outline: none;
        box-shadow: 0 0 5px rgba(106, 13, 173, 0.3);
    }

    label {
        font-size: 1.1rem;
        color: #6a0dad;
        margin-top: 10px;
        display: block;
    }

    button {
        background-color: #6a0dad;
        color: white;
        padding: 15px 30px;
        font-size: 1.2rem;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    button:hover {
        background-color: #ff7f00;
        transform: scale(1.05);
    }

    button:focus {
        outline: none;
        box-shadow: 0 0 8px rgba(255, 127, 0, 0.5);
    }

    .appointment-buttons {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
    }

    footer {
        text-align: center;
        padding: 2rem;
        color: white;
        font-size: 1.2rem;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        background: linear-gradient(135deg, #6a0dad, #ff7f00);
        border-top: 2px solid #cc7a00;
        width: 100%;
    }

    footer a {
        color: white;
        text-decoration: none;
        font-weight: bold;
        transition: color 0.3s ease;
    }

    footer a:hover {
        color: #fef9e7;
    }

    /* Style du champ de téléphone */
    #phone {
        width: 720px;
        padding: 15px;
        border: 2px solid #ddd;
        border-radius: 8px;
        font-size: 1rem;
        background-color: #f9f9f9;
        transition: all 0.3s ease;
    }

    /* Focus sur le champ de téléphone */
    #phone:focus {
        border-color: #6a0dad;
        box-shadow: 0 0 8px rgba(106, 13, 173, 0.2);
        outline: none;
        background-color: #fff;
    }
    .toast {
    font-size: 2rem; /* Texte clair et visible */
    min-width: 650px; /* Largeur adaptée, pas trop petite */
    max-width: 550px; /* Largeur maximale contrôlée */
    padding: 25px; /* Plus d'espace pour un design agréable */
    border-radius: 12px; /* Coins arrondis pour une finition moderne */
    box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.3); /* Douce ombre élégante */
    text-align: center; /* Centrer le contenu */
}
</style>

