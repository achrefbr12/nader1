<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['login'])) {
    // User is not logged in, redirect to login page
    header("Location: Login.html");
    exit;
}

// If user is logged in, continue to display the page
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Résultats</title>
</head>
<body>
    <?php

    // Check if user is logged in
    if (!isset($_SESSION['login'])) {
        // User is not logged in, redirect to login page
        header("Location: Login.html");
        exit;
    }
    
    // Connect to the database
    $conn = new mysqli("localhost", "root", "", "bd<nader>");
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Fetch data for the logged-in user
    $login = $_SESSION['login'];
    $query = "SELECT E.NomPrenom, N.Moy, M.Libelle
              FROM NOTE N
              JOIN ELEVE E ON N.NumEleve = E.Numero
              JOIN MATIERE M ON N.CodeMatiere = M.Code
              WHERE E.Numero IN (SELECT NumEleve FROM UTILISATEUR WHERE login = '$login')
              ORDER BY M.Libelle";
    
    $result = $conn->query($query);
    
    if ($result->num_rows > 0) {
        // Output data of each row
        echo "Bienvenu $login à l’établissement " . $_COOKIE['etablissement'] . "<br><br>";
        while($row = $result->fetch_assoc()) {
            echo "L’élève " . $row["NomPrenom"]. " a eu la moyenne " . $row["Moy"]. " en " . $row["Libelle"]. "<br>";
        }
    } else {
        echo "Aucun résultat trouvé";
    }
    
    $conn->close();
    ?>
    <a href="logout.php">Déconnexion</a>
</body>
</html>
