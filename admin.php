<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: connexion.php');
    exit();
}

include 'connexion_bdd.php';

// Récupérer tous les services et habitats
$services = $pdo->query("SELECT * FROM services")->fetchAll(PDO::FETCH_ASSOC);
$habitats = $pdo->query("SELECT * FROM habitats")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Administrateur - Gestion des Services et Habitats</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Gestion des Services</h1>

    <!-- Formulaire pour ajouter un nouveau service -->
    <form action="ajouter_service.php" method="POST">
        <label for="nom">Nom du service :</label>
        <input type="text" id="nom" name="nom" required><br><br>
        
        <label for="description">Description du service :</label>
        <textarea id="description" name="description" required></textarea><br><br>
        
        <input type="submit" value="Ajouter le service">
    </form>

    <h2>Liste des services existants</h2>
    <table>
        <tr>
            <th>Nom</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
        <?php foreach ($services as $service): ?>
        <tr>
            <td><?= htmlspecialchars($service['nom']); ?></td>
            <td><?= htmlspecialchars($service['description']); ?></td>
            <td>
                <a href="modifier_service.php?id=<?= $service['id']; ?>">Modifier</a>
                <a href="supprimer_service.php?id=<?= $service['id']; ?>">Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <h1>Gestion des Habitats</h1>

    <!-- Formulaire pour ajouter un nouvel habitat -->
    <form action="ajouter_habitat.php" method="POST">
        <label for="nom">Nom de l'habitat :</label>
        <input type="text" id="nom" name="nom" required><br><br>
        
        <label for="description">Description de l'habitat :</label>
        <textarea id="description" name="description" required></textarea><br><br>
        
        <input type="submit" value="Ajouter l'habitat">
    </form>

    <h2>Liste des habitats existants</h2>
    <table>
        <tr>
            <th>Nom</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
        <?php foreach ($habitats as $habitat): ?>
        <tr>
            <td><?= htmlspecialchars($habitat['nom']); ?></td>
            <td><?= htmlspecialchars($habitat['description']); ?></td>
            <td>
                <a href="modifier_habitat.php?id=<?= $habitat['id']; ?>">Modifier</a>
                <a href="supprimer_habitat.php?id=<?= $habitat['id']; ?>">Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <!-- Ajouter des liens vers d'autres sections, comme la page d'accueil -->
    <a href="index.php">Retour à l'accueil</a>

</body>
</html>