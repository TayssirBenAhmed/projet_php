<?php  
// Database connection
$conn = new mysqli("localhost", "root", "", "mydb");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Delete a review
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $sql = "DELETE FROM reviews WHERE id = $delete_id";
    if ($conn->query($sql) === TRUE) {
        // Instead of redirect, we will set a 'deleted=true' flag in the URL for the toast notification
        $deleted = true;
    } else {
        echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
    }
}

// Retrieve all reviews
$sql = "SELECT * FROM reviews";
$result = $conn->query($sql);
?>

<div class="container">
    <header class="page-header">
        <h2>Reviews List 📝</h2>
        <p class="subheading">Check out patient feedback and manage reviews.</p>
        <p class="description">Welcome to the review management system. Here, you can view, edit, and delete patient reviews effortlessly. Make sure to address patient concerns to improve satisfaction.</p>
    </header>

    <div class="table-wrapper">
        <table class="table table-hover">
            <thead class="thead-dark">
                <tr class ="tr">
                    <th>#</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Email</th>
                    <th>Review</th>
                    <th>Emoji</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row['id'] . "</td>
                                <td>" . $row['name'] . "</td>
                                <td>" . $row['phone'] . "</td>
                                <td>" . $row['address'] . "</td>
                                <td>" . $row['email'] . "</td>
                                <td>" . $row['review_text'] . "</td>
                                <td style='font-size: 2rem;'>" . $row['emoji'] . "</td>
                                <td>
                                    <a href='reviews.php?delete_id=" . $row['id'] . "' class='btn btn-danger btn-sm'>🗑️</a>
                                </td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='9'>No reviews found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php
$conn->close();
?>

<!-- Add Toastr Library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />

<script>
    // Display success toast if the variable 'deleted' is set to true
    <?php if (isset($deleted) && $deleted) { ?>
        toastr.success('Review deleted successfully!');
    <?php } ?>
</script>

<style>
/* General Styles */
body {
    font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #8e44ad, #f39c12);
        color: #fff;
        margin: 0;
        padding: 0;
        overflow-x: hidden;}

.container { 
    background-color: #e8eaf6; /* Soft lavender for container background */ 
    border-radius: 12px; 
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1); 
    width: 100%;
    max-width: 1200px;
    margin: 100px auto; /* Adjust to avoid overlapping with header */
    padding: 20px;
}
tr{
    color:#212529;
}

.page-header { 
    text-align: center; 
    margin-bottom: 40px; 
}

.page-header h2 { 
    color: #5a4fcf; /* Purple for the header */ 
    font-size: 2.8rem; 
    margin-bottom: 15px; 
}
.tr{
    background-color: #6a0dad;
    color: #f9f5ff
}
.page-header .subheading { 
    color: #7b5cd6; /* Slightly lighter purple */ 
    font-size: 1.3rem; 
}

.page-header .description {
    color: #5a5f7d; /* Muted grey-violet for description */
    font-size: 1rem;
    margin-top: 10px;
    font-style: italic;
}

.table-wrapper { 
    background-color: #ffffff; 
    padding: 20px; 
    border-radius: 12px; 
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1); 
    margin-top: 40px; 
}

/* Table styles */
table { 
    border-collapse: collapse; 
    width: 100%;
    font-size: 1.1rem; /* Adjusted to enlarge text */
}

table th, table td { 
    padding: 18px; /* Increased padding for larger cells */
    text-align: center; 
    border: 2px solid #9c27b0; /* Violet border for table */
}

table th { 
    background-color: #9c27b0; /* Violet background for the headers */
    color: #fff; 
    font-size: 1.2rem; 
    font-weight: bold; 
}

table tr:hover { 
    background-color: #f9f5ff; /* Light violet hover effect */ 
    transition: all 0.2s; 
}

table td a { 
    margin: 5px; 
    padding: 8px 15px; /* Reduced padding for compact buttons */
    border-radius: 6px; 
    font-size: 1rem; /* Smaller font size */
    cursor: pointer; 
    transition: all 0.3s ease; /* Smooth transition on hover */
    text-decoration: none; 
}

/* Emoji Styles */
table td .emoji {
    font-size: 2.5rem; /* Enlarging emojis */
}

/* Button Styles */
.btn { 
    font-size: 1rem; 
    padding: 8px 15px; /* Smaller padding */
    border-radius: 6px; 
    cursor: pointer; 
    transition: all 0.3s ease; /* Smooth transition on hover */
    text-decoration: none; 
}

/* Red Button Styles */
.btn-danger { 
    background-color: #dc3545; /* Red for delete button */
    color: white; 
}

.btn-danger:hover { 
    background-color: #9c27b0; /* Violet background on hover */
    transform: scale(1.05); /* Slightly enlarge button on hover */
}

/* Responsive Styles */
@media (max-width: 768px) { 
    .container { 
        padding: 20px; 
    } 
    table th, table td { 
        font-size: 1.2rem; 
    } 
}

/* Toast container styles */
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


</style> 
