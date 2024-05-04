<?php
// Saisir.php
// Connect to the database
$conn = new mysqli("localhost", "root", "", "bd<nader>");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$numEleve = $_POST['numEleve'];
$matiere = $_POST['matiere'];
$moyenne = $_POST['moyenne'];

// Check if the student exists
$check_query = "SELECT * FROM ELEVE WHERE Numero = '$numEleve'";
$result = $conn->query($check_query);

if ($result->num_rows == 0) {
    echo "Élève non inscrit";
} else {
    // Check if the student already has a grade for the selected subject
    $grade_check_query = "SELECT * FROM NOTE WHERE NumEleve = '$numEleve' AND CodeMatiere = '$matiere'";
    $grade_result = $conn->query($grade_check_query);

    if ($grade_result->num_rows > 0) {
        echo "Moyenne déjà saisie";
    } else {
        // Insert the grade into the database
        $insert_query = "INSERT INTO NOTE (NumEleve, CodeMatiere, Moy) VALUES ('$numEleve', '$matiere', '$moyenne')";
        if ($conn->query($insert_query) === TRUE) {
            echo "Saisie réussie!";
            ?>
<script>
window.setTimeout(function() {
    window.location = 'page2.php';
  }, 5000);
</script>
            <?php
        } else {
            echo "Erreur lors de la saisie: " . $conn->error;
        }
    }
}

$conn->close();
?>
