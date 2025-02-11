<?php


// Connexion à la base de données
$conn = new mysqli("localhost", "root", "", "mydb");

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Déclaration des variables pour les notifications
$toastr_type = '';
$toastr_message = '';

// Ajouter l'avis à la base de données
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $name = $conn->real_escape_string($_POST['name']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $email = $conn->real_escape_string($_POST['email']);
    $address = $conn->real_escape_string($_POST['address']);
    $review_text = $conn->real_escape_string($_POST['review_text']);
    $emoji = $conn->real_escape_string($_POST['emoji']);
    $questionnaire = json_encode($_POST['questionnaire'], JSON_UNESCAPED_UNICODE);

    // Insérer dans la base de données
    $sql = "INSERT INTO reviews (name, phone, email, address, review_text, emoji, questionnaire)
            VALUES ('$name', '$phone', '$email', '$address', '$review_text', '$emoji', '$questionnaire')";

    if ($conn->query($sql) === TRUE) {
        $toastr_type = 'success';
        $toastr_message = 'Review added successfully!';
    } else {
        $toastr_type = 'error';
        $toastr_message = 'Error: Unable to add the review. Please try again.';
    }
}
?>
<body>
<div id="toast-container"></div>

<div class="form-container">
    <header>
        <h1>Patient Experience Portal</h1>
        <hr />
        <h3 class="animated-title">Share your feedback and make a difference! 💜</h3>
    </header>

    <main>
        <form method="POST" class="review-form">
            <div class="input-section">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" placeholder="Enter your name" required />
            </div>
            <div class="input-section">
                <label for="phone">Phone:</label>
                <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" required />
            </div>
            <div class="input-section">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required />
            </div>
            <div class="input-section">
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" placeholder="Enter your address" required />
            </div>
            <div class="emoji-section">
                <label>Choose an emoji:</label>
                <div class="emoji-buttons">
                    <?php
                    $emojis = ['😊', '😢', '😡', '❤️', '👍', '👎'];
                    foreach ($emojis as $emoji) {
                        echo "<button type='button' class='emoji-btn' data-value='$emoji'>$emoji</button>";
                    }
                    ?>
                </div>
                <input type="hidden" name="emoji" id="selectedEmoji" required />
                <div id="selectedEmojiDisplay" class="selected-emoji"></div>
            </div>
            <div class="input-section">
                <label for="reviewText">Your Review:</label>
                <textarea id="reviewText" name="review_text" placeholder="Share your review here..." rows="6" required></textarea>
            </div>
            <div class="questionnaire">
                <h3>Satisfaction Questionnaire</h3>
                <?php
                $questions = [
                    "1. Was the reception at the clinic warm and professional?",
                    "2. Are the equipment and facilities modern and in good condition?",
                    "3. Does the medical staff appear well-trained and up-to-date with their knowledge?"
                ];
                foreach ($questions as $index => $question) {
                    echo "<fieldset class='question'>
                            <legend>$question</legend>
                            <div class='emoji-rating'>";
                    foreach (['😢', '😐', '😊'] as $emoji) {
                        echo "<label>
                                <input type='radio' name='questionnaire[$index]' value='$emoji' required />
                                <span class='emoji-large'>$emoji</span>
                              </label>";
                    }
                    echo "</div></fieldset>";
                }
                ?>
            </div>
            <div class="buttons">
                <button type="submit" name="submit" class="violet-btn">Submit</button>
                <a href="index.php" type="reset" id="resetButton" class="violet-btn">Reset</a>
            </div>
            <img src=""
        </form>
    </main>
</div>

<!-- Ajouter les fichiers CSS et JS nécessaires -->
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


    // Afficher les notifications Toastr
    <?php if (!empty($toastr_type)) { ?>
        toastr.<?php echo $toastr_type; ?>('<?php echo $toastr_message; ?>');
        <?php if ($toastr_type === 'success') { ?>
            setTimeout(() => {
                window.location.href = 'index.php'; // Redirection après succès
            }, 2000); // Délai de 2 secondes
        <?php } ?>
    <?php } ?>
    
       
    
    // Gestion de l'emoji sélectionné
    document.querySelectorAll('.emoji-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const emoji = this.dataset.value;
            document.getElementById('selectedEmoji').value = emoji;
            document.getElementById('selectedEmojiDisplay').innerText = `Selected Emoji: ${emoji}`;
        });
    });
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
<style>
    body{
        font-family: 'Roboto', sans-serif;
        background: linear-gradient(135deg, #f8f9ff, #f7f1ff);
        color: #333;
        overflow-x: hidden;  
    }
/* Général Styling */
.form-container {
    width: 60%;
    margin: 50px auto;
    background: #fff;
    padding: 40px;
    border-radius: 15px;
    box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.2);
    animation: fadeIn 1s ease-in-out;
    border: 1px solid #eee; /* Ajout d'une bordure légère */
}

header h1 {
    font-size: 2rem;
    color: #6a0dad;
    text-align: center;
    margin-bottom: 10px;
}

header hr {
    width: 50%;
    margin: 15px auto;
    border: 1px solid #ff7043;
}

header h3 {
    text-align: center;
    color: #333;
    font-weight: 400;
    margin-top: 0;
}

.input-section {
    margin-bottom: 20px;
    animation: slideUp 0.5s ease-in-out;
}

label {
    font-size: 1.1rem;
    color: #555;
    margin-bottom: 6px;
    display: block;
}

input, textarea {
    width: 100%;
    padding: 15px;
    border: 2px solid #ddd;
    border-radius: 8px;
    margin-top: 6px;
    font-size: 1rem;
    transition: all 0.3s ease;
    background-color: #f9f9f9;
}

input:focus, textarea:focus {
    border-color: #ff7043; /* Bordure orange au focus */
    box-shadow: 0 0 8px rgba(255, 112, 67, 0.2);
    outline: none;
    background-color: #fff;
}

textarea {
    resize: none;
}

.phone-input {
    display: flex;
    align-items: center;
    border: 2px solid #ddd;
    border-radius: 8px;
    padding: 8px;
    background-color: #f9f9f9;
}

.phone-prefix {
    font-size: 1rem;
    color: #555;
    margin-right: 8px;
    font-weight: bold;
}

.flag-icon {
    width: 30px;
    margin-left: 10px;
}

/* Emojis Section */
.emoji-buttons button {
    font-size: 2.5rem; /* Augmenter la taille des emojis */
    background: none;
    border: 2px solid #ff7043; /* Bordure orange */
    border-radius: 50%; /* Bordure arrondie */
    margin: 10px;
    padding: 15px;
    cursor: pointer;
    transition: all 0.3s ease;
}

/* Animation des emojis */
.emoji-buttons button:hover {
    transform: scale(1.2); /* Agrandir au survol */
    background-color: #ff7043; /* Changer la couleur de fond */
    color: white; /* Texte blanc */
}

/* Sélection de l'emoji */
.selected-emoji {
    margin-top: 10px;
    font-size: 1.5rem;
    color: #6a0dad;
    font-weight: bold;
}

/* Questionnaire */
.questionnaire {
    margin-top: 30px;
    animation: fadeIn 1s ease-in-out;
}

/* Titre des questions en orange */
.question legend {
    color: #ff7043; /* Légende orange */
    font-size: 1.3rem;
    font-weight: bold;
    margin-bottom: 10px;
}

/* Améliorer l'animation des questions */
.question {
    animation: bounceInUp 1s ease-out;
}

/* Agrandir les boutons radio */
.question input[type="radio"] {
    transform: scale(1.5); /* Agrandir les boutons radio */
    margin: 0 10px; /* Espacement entre les boutons */
    transition: all 0.2s ease;
}

/* Animation sur les boutons radio au survol */
.question input[type="radio"]:hover {
    transform: scale(1.6); /* Augmenter la taille au survol */
    cursor: pointer;
}

/* Emoji des réponses du questionnaire */
/* Disposition des emojis pour les questions du questionnaire */
.emoji-rating {
    display: flex;
    justify-content: space-evenly; /* Aligner les emojis horizontalement */
    gap: 15px; /* Espacement entre les emojis */
    margin-top: 10px;
}

/* Agrandir les emojis du questionnaire */
.emoji-rating label {
    font-size: 3rem; /* Augmenter la taille des emojis */
    cursor: pointer;
    transition: transform 0.3s ease-in-out;
    border: 2px solid #ff7043; /* Bordure orange autour des emojis */
    border-radius: 50%; /* Bordure arrondie */
    padding: 10px; /* Ajouter un peu d'espace autour de l'emoji */
}

/* Agrandissement au survol des emojis du questionnaire */
.emoji-rating label:hover {
    transform: scale(1.3); /* Agrandir l'emoji au survol */
    background-color: #ff7043; /* Changer la couleur de fond */
    color: white; /* Texte blanc */
}

/* Agrandir les boutons radio */
.emoji-rating input[type="radio"] {
    width: 30px;
    height: 30px;
    margin-right: 10px;
    accent-color: #ff7043; /* Couleur de survol du bouton radio */
}

/* Ajouter un effet de survol pour le label du radio button */
.emoji-rating input[type="radio"]:hover {
    transform: scale(1.1); /* Agrandir le bouton radio au survol */
    cursor: pointer;
}

/* Ajout de la bordure orange aux questions */
.question {
    border: 2px solid #ff7043; /* Bordure orange */
    padding: 15px;
    border-radius: 8px;
    margin-bottom: 20px;
    transition: border-color 0.3s ease;
}

.question:hover {
    border-color: #6a0dad; /* Changer la bordure lors du survol */
}

/* Boutons de soumission */
.violet-btn {
    background: linear-gradient(90deg, #6a0dad, #ff7043); /* Dégradé violet et orange */
    color: white;
    padding: 15px 30px;
    border: none;
    border-radius: 25px;
    font-size: 1.2rem;
    cursor: pointer;
    transition: transform 0.3s ease;
}

/* Animation des boutons */
.violet-btn:hover {
    transform: scale(1.1); /* Agrandir le bouton au survol */
}

/* Bordure des entrées */
input, textarea {
    border: 2px solid #ddd;
}

/* Toast Container */
#toast-container {
    z-index: 9999;
    font-size: 3rem;
    top: 20px;        /* Espacement du haut de l'écran */
    right: 20px;      /* Espacement du côté droit de l'écran */
    pointer-events: none; /* S'assurer que la notification ne bloque pas l'interaction avec d'autres éléments */
}
     /* Placer le toast au-dessus */
.toast {
    font-size: 2rem; /* Texte clair et visible */
    min-width: 650px; /* Largeur adaptée, pas trop petite */
    max-width: 550px; /* Largeur maximale contrôlée */
    padding: 25px; /* Plus d'espace pour un design agréable */
    border-radius: 12px; /* Coins arrondis pour une finition moderne */
    box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.3); /* Douce ombre élégante */
    text-align: center; /* Centrer le contenu */
}


/* QR Code */

h3 {
    color: #6a0dad;
    font-size: 1.5rem;
    margin-bottom: 15px;
}

/* Keyframes for Animations */
@keyframes fadeIn {
    0% {
        opacity: 0;
    }
    100% {
        opacity: 1;
    }
}

@keyframes slideUp {
    0% {
        transform: translateY(50px);
        opacity: 0;
    }
    100% {
        transform: translateY(0);
        opacity: 1;
    }
}

/* Animation pour les questions */
@keyframes bounceInUp {
    0% {
        transform: translateY(100px);
        opacity: 0;
    }
    60% {
        transform: translateY(-20px);
        opacity: 1;
    }
    100% {
        transform: translateY(0);
    }
}
/* Style du champ de téléphone */
#phone {
    width: 750px;
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

.toast-success {
    background-color: #28a745 !important; /* Vert élégant pour succès */
    color: white;
}

.toast-error {
    background-color: #dc3545 !important; /* Rouge vif pour erreurs */
    color: white;
}

.toast-warning {
    background-color: #ffc107 !important; /* Jaune pour avertissements */
    color: #212529;
}

.toast-title {
    font-weight: bold;
    font-size: 2.2rem; /* Titre légèrement plus grand */
    margin-bottom: 10px;
}

.toast-message {
    font-size: 1.8rem; /* Message bien lisible */
}




</style>

