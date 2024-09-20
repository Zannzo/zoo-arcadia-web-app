<?php
session_start();
include 'connexion_bdd.php'; // Connexion à la base de données

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $pseudo = $_POST['pseudo'];

    if (!empty($titre) && !empty($description) && !empty($pseudo)) {
        
        $stmt = $pdo->prepare("INSERT INTO avis (pseudo, commentaire, invisible, valide) VALUES (:pseudo, :commentaire, 0, 0)");
        $stmt->execute([
            'pseudo' => $pseudo,
            'commentaire' => $description
        ]);

        $confirmation = "Votre avis a été soumis et est en attente de validation.";
    } else {
        $erreur = "Veuillez remplir tous les champs.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laisser un avis</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Laissez un avis</h1>
        <nav>
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="habitats.php">Nos Habitats</a></li>
                <li><a href="services.php">Nos Services</a></li>
                <li><a href="connexion.php">Connexion</a></li>
                <li><a href="contact.php">Laisser un avis</a></li>
            </ul>
        </nav>
    </header>

    <section id="avis">
        <h2>Envoyez-nous votre avis</h2>
        <?php if (isset($confirmation)): ?>
            <p style="color:green;"><?= htmlspecialchars($confirmation); ?></p>
        <?php elseif (isset($erreur)): ?>
            <p style="color:red;"><?= htmlspecialchars($erreur); ?></p>
        <?php endif; ?>

        <form action="contact.php" method="POST">
            <label for="titre">Titre :</label>
            <input type="text" id="titre" name="titre" required><br><br>

            <label for="description">Votre avis :</label>
            <textarea id="description" name="description" required></textarea><br><br>

            <label for="pseudo">Votre pseudo :</label>
            <input type="text" id="pseudo" name="pseudo" required><br><br>

            <button type="submit">Envoyer</button>
        </form>
    </section>

    <footer>
        <p>&copy; 2024 Zoo Arcadia - Tous droits réservés</p>
    </footer>
</body>
</html>
