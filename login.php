<?php
// Login.php
session_start();

// Define database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bd<nader>";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve login credentials from form
$login = $_POST['login'];
$password = $_POST['password'];
$etablissement = $_POST['etablissement'];
setcookie("etablissement", "$etablissement", time() + (86400 * 365), "/");
// Query to check user credentials
$sql = "SELECT * FROM UTILISATEUR WHERE login='$login' AND pwd='$password'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    // Login successful, set session variables
    $_SESSION['login'] = $login;
    // Redirect to Resultat.php
    header("Location: Resultat.php");
} else {
    // Login failed
    echo "Identifiant ou mot de passe incorrect.";
}

$conn->close();
?>
