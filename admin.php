<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: connexion.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Administrateur</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Bienvenue dans l'espace Administrateur</h1>
    <p>Ici, vous pouvez gérer les utilisateurs, les services, et les habitats.</p>
    <!-- Ajoute plus tard les fonctionnalités pour gérer les services et habitats -->
</body>
</html>
