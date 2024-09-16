<?php
// Connexion à la base de données
include 'connexion_bdd.php';

// Récupérer les avis validés depuis la base de données
$avis = $pdo->query("SELECT pseudo, commentaire FROM avis WHERE valide = TRUE")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zoo Arcadia</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header>
        <h1>Bienvenue au Zoo Arcadia</h1>
        <p>Découvrez nos habitats, nos animaux et notre engagement écologique.</p>
    </header>

    <nav>
        <ul>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="habitats.php">Nos Habitats</a></li>
            <li><a href="services.php">Nos Services</a></li>
            <li><a href="connexion.php">Connexion</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
    </nav>

    <section id="habitats">
        <h2>Nos Habitats</h2>
        <div class="habitat">
            <h3>Savane</h3>
            <img src="https://via.placeholder.com/150" alt="Savane">
            <p>La savane accueille les éléphants, lions et bien plus encore.</p>
        </div>
        <div class="habitat">
            <h3>Jungle</h3>
            <img src="https://via.placeholder.com/150" alt="Jungle">
            <p>Explorez la jungle et découvrez nos singes, perroquets et autres espèces exotiques.</p>
        </div>
    </section>

    <section id="affichage-avis">
        <h2>Avis des visiteurs</h2>
        <!-- Affichage dynamique des avis validés depuis la base de données -->
        <?php foreach ($avis as $a): ?>
            <div class="avis">
                <p><strong><?= htmlspecialchars($a['pseudo']); ?> :</strong> <?= htmlspecialchars($a['commentaire']); ?></p>
            </div>
        <?php endforeach; ?>
    </section>

    <section id="services">
        <h2>Nos Services</h2>
        <ul>
            <li>Restauration</li>
            <li>Visite guidée des habitats</li>
            <li>Petit train du zoo</li>
        </ul>
    </section>

    <footer>
        <p>&copy; 2024 Zoo Arcadia - Tous droits réservés</p>
    </footer>

</body>
</html>
