<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'veterinaire') {
    header('Location: connexion.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Vétérinaire</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Bienvenue dans l'espace Vétérinaire</h1>
    <p>Ici, vous pouvez consulter et ajouter des comptes rendus pour les animaux.</p>
</body>
</html>
