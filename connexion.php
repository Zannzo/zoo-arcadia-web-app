<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Zoo Arcadia</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header>
        <h1>Connexion</h1>
        <p>Accédez à votre espace personnel.</p>
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
    
    <section id="connexion">
        <h2>Identifiez-vous</h2>
        <form action="process_connexion.php" method="POST">
            <label for="username">Nom d'utilisateur :</label>
            <input type="text" id="username" name="username" required><br><br>
            
            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="mot_de_passe" required><br><br>
            
            <input type="submit" value="Se connecter">
        </form>
    </section>

    <footer>
        <p>&copy; 2024 Zoo Arcadia - Tous droits réservés</p>
    </footer>

</body>
</html>
