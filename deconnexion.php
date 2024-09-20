<?php
session_start();
session_destroy(); // Détruit toutes les données de la session
header('Location: index.php'); // Redirection vers la page d'accueil
exit();
?>
