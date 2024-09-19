<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $email = $_POST['email'];

    if (!empty($titre) && !empty($description) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Envoi du message (à configurer selon les besoins)
        $confirmation = "Votre message a été envoyé.";
    } else {
        $erreur = "Veuillez remplir tous les champs correctement.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactez-nous</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Contactez-nous</h1>
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

    <section id="contact">
        <h2>Envoyez-nous un message</h2>
        <?php if (isset($confirmation)): ?>
            <p style="color:green;"><?= htmlspecialchars($confirmation); ?></p>
        <?php elseif (isset($erreur)): ?>
            <p style="color:red;"><?= htmlspecialchars($erreur); ?></p>
        <?php endif; ?>

        <form action="contact.php" method="POST">
            <label for="titre">Titre :</label>
            <input type="text" id="titre" name="titre" required><br><br>

            <label for="description">Description :</label>
            <textarea id="description" name="description" required></textarea><br><br>

            <label for="email">Votre email :</label>
            <input type="email" id="email" name="email" required><br><br>

            <button type="submit">Envoyer</button>
        </form>
    </section>

    <footer>
        <p>&copy; 2024 Zoo Arcadia - Tous droits réservés</p>
    </footer>
</body>
</html>
