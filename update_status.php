<?php
// Connexion à la base de données
$conn = new mysqli("localhost", "root", "", "mydb"); // Remplacez par vos informations de connexion

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Vérification des paramètres reçus par POST
if (isset($_POST['id']) && isset($_POST['status'])) {
    $appointmentId = $_POST['id'];
    $status = $_POST['status'];

    // Vérification si l'action est de supprimer le rendez-vous
    if (isset($_POST['action']) && $_POST['action'] == 'delete') {
        // Supprimer le rendez-vous de la base de données
        $sql = "DELETE FROM appointments WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $appointmentId);
        
        if ($stmt->execute()) {
            echo "Appointment deleted successfully!"; // Réponse de succès
        } else {
            echo "Error deleting appointment: " . $conn->error; // Message d'erreur si la suppression échoue
        }

        $stmt->close();
    } else {
        // Si l'action n'est pas de supprimer, mettre à jour le statut du rendez-vous
        $sql = "UPDATE appointments SET status = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $status, $appointmentId);

        if ($stmt->execute()) {
            echo "Status updated successfully!"; // Réponse de succès
        } else {
            echo "Error updating status: " . $conn->error; // Message d'erreur si la mise à jour échoue
        }

        $stmt->close();
    }
}

$conn->close();
?>
