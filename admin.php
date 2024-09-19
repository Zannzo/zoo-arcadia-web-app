<?php
session_start();

// Vérifier si l'utilisateur est connecté et s'il est administrateur
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: connexion.php');
    exit();
}


// Connexion à la base de données
include 'connexion_bdd.php';

// Récupérer tous les services
$requeteServices = $pdo->query("SELECT * FROM service");
$services = $requeteServices->fetchAll(PDO::FETCH_ASSOC);

// Récupérer tous les habitats
$requeteHabitats = $pdo->query("SELECT * FROM habitat");
$habitats = $requeteHabitats->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Administrateur</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Gestion des Services et Habitats</h1>

    <!-- Gestion des Services -->
    <h2>Ajouter un Service</h2>
    <form action="ajouter_service.php" method="POST">
        <label for="nom_service">Nom du service :</label>
        <input type="text" id="nom_service" name="nom" required>
        <label for="description_service">Description :</label>
        <textarea id="description_service" name="description" required></textarea>
        <button type="submit">Ajouter le service</button>
    </form>

    <h2>Services existants</h2>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($services as $service) : ?>
            <tr>
                <td><?= htmlspecialchars($service['nom']); ?></td>
                <td><?= htmlspecialchars($service['description']); ?></td>
                <td>
                    <a href="modifier_service.php?id=<?= $service['service_id']; ?>">Modifier</a>
                    <a href="supprimer_service.php?id=<?= $service['service_id']; ?>">Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Gestion des Habitats -->
    <h2>Ajouter un Habitat</h2>
    <form action="ajouter_habitat.php" method="POST">
        <label for="nom_habitat">Nom de l'habitat :</label>
        <input type="text" id="nom_habitat" name="nom" required>
        <label for="description_habitat">Description :</label>
        <textarea id="description_habitat" name="description" required></textarea>
        <button type="submit">Ajouter l'habitat</button>
    </form>

    <h2>Habitats existants</h2>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($habitats as $habitat) : ?>
            <tr>
                <td><?= htmlspecialchars($habitat['nom']); ?></td>
                <td><?= htmlspecialchars($habitat['description']); ?></td>
                <td>
                    <a href="modifier_habitat.php?id=<?= $habitat['habitat_id']; ?>">Modifier</a>
                    <a href="supprimer_habitat.php?id=<?= $habitat['habitat_id']; ?>">Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
