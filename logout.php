<?php
// logout.php
session_start();
// Destroy the session
session_destroy();
// Redirect to Saisie.html
header("Location: Saisie.html");
exit;
?>
