<?php
include 'connexion_bdd.php';

// Récupérer les avis valides et visibles
$requeteAvis = $pdo->prepare("SELECT pseudo, commentaire FROM avis WHERE valide = 1 AND invisible = 0");
$requeteAvis->execute();
$avis = $requeteAvis->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zoo Arcadia - Accueil</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Bienvenue au Zoo Arcadia</h1>
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

    <section id="presentation">
        <h2>Présentation du Zoo</h2>
        <p>Le Zoo Arcadia vous propose une découverte unique de la faune sauvage avec ses différents habitats naturels recréés pour le bien-être des animaux. Venez découvrir nos animaux, nos services, et laissez-vous transporter dans notre monde.</p>
    </section>

    <section id="habitats">
        <h2>Découvrez nos Habitats</h2>
        <div class="habitat-container">
            <div class="habitat">
                <img src="images/savane.png" alt="Savane" />
                <h3>Savane</h3>
                <p>Découvrez les animaux de la savane africaine dans leur habitat naturel reconstitué.</p>
            </div>
            <div class="habitat">
                <img src="images/jungle.png" alt="Jungle" />
                <h3>Jungle</h3>
                <p>Venez explorer la jungle tropicale avec ses nombreuses espèces exotiques.</p>
            </div>
        </div>
    </section>

    <!-- Section des avis -->
    <section id="avis">
        <h2>Avis des visiteurs</h2>
        <p>Découvrez ce que nos visiteurs disent de leur expérience au Zoo Arcadia.</p>
        <?php if (!empty($avis)): ?>
            <div class="avis-container">
                <?php foreach ($avis as $avi): ?>
                    <div class="avis">
                        <h4><?= htmlspecialchars($avi['pseudo']); ?></h4>
                        <p><?= htmlspecialchars($avi['commentaire']); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>Aucun avis disponible pour le moment.</p>
        <?php endif; ?>
    </section>

    <footer>
        <p>&copy; 2024 Zoo Arcadia - Tous droits réservés</p>
    </footer>
</body>
</html>
