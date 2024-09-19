<?php
session_start();
include 'connexion_bdd.php';

// Récupérer les habitats depuis la base de données
$requeteHabitats = $pdo->query("SELECT * FROM habitat");
$habitats = $requeteHabitats->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nos Habitats</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Nos Habitats</h1>
        <nav>
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="habitats.php">Nos Habitats</a></li>
                <li><a href="services.php">Nos Services</a></li>
                <li><a href="connexion.php">Connexion</a></li>
                <li><a href="contact.php">Contactez-nous</a></li>
            </ul>
        </nav>
    </header>

    <section id="habitats">
        <h2>Découvrez nos habitats</h2>
        <?php foreach ($habitats as $habitat): ?>
            <div class="habitat">
                <h3><?= htmlspecialchars($habitat['nom']); ?></h3>
                <p><?= htmlspecialchars($habitat['description']); ?></p>
            </div>
        <?php endforeach; ?>
    </section>

    <footer>
        <p>&copy; 2024 Zoo Arcadia - Tous droits réservés</p>
    </footer>
</body>
</html>
