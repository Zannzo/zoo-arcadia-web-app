<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'employe') {
    header('Location: connexion.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Employé</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Bienvenue dans l'espace Employé</h1>
    <p>Ici, vous pouvez valider les avis et gérer la nourriture des animaux.</p>
</body>
</html>
