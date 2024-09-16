<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - Zoo Arcadia</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body>

    <header>
        <h1>Contact</h1>
        <p>Envoyez-nous un message.</p>
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
    

    <section id="contact">
        <h2>Formulaire de contact</h2>
        <form action="process_contact.php" method="POST">
            <label for="titre"><i class="fas fa-heading"></i> Titre :</label>
            <input type="text" id="titre" name="titre" required><br><br>
            
            <label for="description"><i class="fas fa-align-left"></i> Description :</label>
            <textarea id="description" name="description" rows="4" required></textarea><br><br>
            
            <label for="email"><i class="fas fa-envelope"></i> Adresse e-mail :</label>
            <input type="email" id="email" name="email" required><br><br>
            
            <input type="submit" value="Envoyer">
        </form>
    </section>

    <footer>
        <p>&copy; 2024 Zoo Arcadia - Tous droits réservés</p>
    </footer>

</body>
</html>
