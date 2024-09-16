<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donnez votre avis - Zoo Arcadia</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header>
        <h1>Laissez un avis</h1>
        <p>Votre avis compte pour nous !</p>
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
    

    <section id="avis">
        <h2>Donnez votre avis</h2>
        <form action="process_avis.php" method="POST">
            <label for="pseudo">Pseudo :</label>
            <input type="text" id="pseudo" name="pseudo" required><br><br>
            
            <label for="avis">Votre avis :</label>
            <textarea id="avis" name="avis" rows="4" required></textarea><br><br>
            
            <input type="submit" value="Envoyer">
        </form>
    </section>

    <footer>
        <p>&copy; 2024 Zoo Arcadia - Tous droits réservés</p>
    </footer>

</body>
</html>
