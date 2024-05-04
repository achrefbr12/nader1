<?php
$conn = new mysqli("localhost", "root", "", "bd<nader>");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$numEleve = $_POST['numEleve'];

$check_query = "SELECT * FROM NOTE WHERE NumEleve = '$numEleve'";
$result = $conn->query($check_query);

if ($result->num_rows == 0) {
    echo "Pas de notes saisies";
} else {
    $delete_query = "DELETE FROM NOTE WHERE NumEleve = '$numEleve'";
    if ($conn->query($delete_query) === TRUE) {
        echo "Notes supprimées avec succès!";
    } else {
        echo "Erreur lors de la suppression: " . $conn->error;
    }
}

$conn->close();
?>
