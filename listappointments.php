<?php ;
// Connexion à la base de données
$conn = new mysqli("localhost", "root", "", "mydb"); // Remplacez par vos informations de connexion

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupérer les rendez-vous depuis la base de données
$sql = "SELECT * FROM appointments"; // Assurez-vous que la table 'appointments' existe et contient des données
$result = $conn->query($sql);

// Vérifier si la requête a échoué
if (!$result) {
    die("Error executing query: " . $conn->error);
}
?>

<!-- Code HTML pour afficher la liste des rendez-vous -->
<!-- Liste des Rendez-vous -->
<div class="appointments-container">
    <header>
        <h1>List of Appointments 🗓️</h1>
        <hr />
        <p>Below are the scheduled appointments.</p>
    </header>

    <section class="appointments-content">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Service</th>
                    <th>Patient</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Appointment Time</th>
                    <th>Actions</th> <!-- Nouvelle colonne pour les actions -->
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    // Afficher chaque rendez-vous dans un tableau
                    while($row = $result->fetch_assoc()) {
                        echo "<tr id='appointment-".$row['id']."'>"; // Ajout d'un ID pour chaque ligne
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['service_name'] . "</td>";
                        echo "<td>" . $row['patient_name'] . "</td>";
                        echo "<td>" . $row['phone'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . date("Y-m-d H:i", strtotime($row['appointment_time'])) . "</td>"; // Format de date et heure
                        echo "<td class='actions'>
                                <button class='btn btn-success approve-btn' data-id='" . $row['id'] . "'> ✅ Approve</button>
                                <button class='btn btn-danger reject-btn' data-id='" . $row['id'] . "'>❌ Reject</button>
                            </td>"; // Boutons pour valider et refuser
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7' class='text-center'>No appointments available.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </section>
</div>
<footer>
    <p class="footer-message">Thank you for visiting! ✨</p>
    <p>© 2025 Reviews Application | <a href="terms.php">Terms</a> | <a href="privacy.php">Privacy</a></p>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
<script>
    $(document).ready(function() {
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,    
            "positionClass": "toast-top-right", // Placez au centre supérieur
            "preventDuplicates": true,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut",
        };

        $('.approve-btn').click(function() {
            var appointmentId = $(this).data('id');
            $.ajax({
                url: 'update_status.php',
                type: 'POST',
                data: {id: appointmentId, status: 'approved'},
                success: function(response) {
                    toastr.success('✅ Appointment approved! 🎉', "Success");
                    $('#appointment-' + appointmentId + ' .approve-btn').prop('disabled', true);
                    $('#appointment-' + appointmentId + ' .reject-btn').prop('disabled', true);
                },
                error: function() {
                    toastr.error('❌ Error approving the appointment.', "Error");
                }
            });
        });

        $('.reject-btn').click(function() {
            var appointmentId = $(this).data('id');
            $.ajax({
                url: 'update_status.php',
                type: 'POST',
                data: {id: appointmentId, status: 'rejected', action: 'delete'},
                success: function(response) {
                    toastr.warning('❌ Appointment rejected and deleted! 😔', "Rejected");
                    $('#appointment-' + appointmentId).remove();
                },
                error: function() {
                    toastr.error('❌ Error rejecting the appointment.', "Error");
                }
            });
        });
    });
</script>


<!-- Styling -->
<style>
    html, body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #8e44ad, #f39c12);
        color: #fff;
        margin: 0;
        padding: 0;
        overflow-x: hidden;
    }
    .appointments-container {
        background-color: #e8eaf6; /* Soft lavender for container background */ 
        border-radius: 12px; 
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1); 
        width: 100%;
        max-width: 1200px;
        margin: 100px auto; /* Adjust to avoid overlapping with header */
        padding: 20px;
        flex: 1; /* Allow this container to take up the available space */
    }

    h1 {
        text-align: center;
        color: #6a0dad;
        font-size: 2.5rem;
    }

    hr {
        width: 50%;
        margin: 20px auto;
        border-color: #ff7f00;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th, td {
        padding: 12px;
        text-align: center;
        border: 1px solid #ddd;
    }

    th {
        background-color: #6a0dad;
        color: white;
    }

    td {
        background-color: #f9f9f9;
    }
tr{
    color: #212529;
}
    tr:nth-child(even) {
        background-color:black;
    }

    table .text-center {
        text-align: center;
    }

    /* Styles for buttons */
    .actions {
        display: flex;
        justify-content: space-around;
        align-items: center;
    }

    .approve-btn, .reject-btn {
        padding: 10px 20px;
        font-size: 1.2rem;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        width: 100px;
        text-align: center;
    }

    .approve-btn {
        background-color: #28a745; /* Green for approve */
        color: white;
        transition: background-color 0.3s ease;
    }

    .approve-btn:hover {
        background-color: #218838;
    }

    .reject-btn {
        background-color: #dc3545; /* Red for reject */
        color: white;
        transition: background-color 0.3s ease;
    }

    .reject-btn:hover {
        background-color: #c82333;
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


