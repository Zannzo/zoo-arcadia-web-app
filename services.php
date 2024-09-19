<?php
session_start();
include 'connexion_bdd.php';

// Récupérer les services depuis la base de données
$requeteServices = $pdo->query("SELECT * FROM service");
$services = $requeteServices->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nos Services</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Nos Services</h1>
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

    <section id="services">
        <h2>Découvrez nos services</h2>
        <ul>
            <?php foreach ($services as $service): ?>
                <li><?= htmlspecialchars($service['nom']); ?> - <?= htmlspecialchars($service['description']); ?></li>
            <?php endforeach; ?>
        </ul>
    </section>

    <footer>
        <p>&copy; 2024 Zoo Arcadia - Tous droits réservés</p>
    </footer>
</body>
</html>
