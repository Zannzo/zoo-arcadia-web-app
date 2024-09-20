<?php
session_start();

// Connexion à la base de données
include 'connexion_bdd.php';

// Vérifier si l'utilisateur est connecté et s'il est administrateur
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: connexion.php');
    exit();
}

// Récupérer tous les services
$requeteServices = $pdo->query("SELECT * FROM service");
$services = $requeteServices->fetchAll(PDO::FETCH_ASSOC);

// Récupérer tous les habitats
$requeteHabitats = $pdo->query("SELECT * FROM habitat");
$habitats = $requeteHabitats->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les statistiques de consultation des animaux
$stmt = $pdo->query("
    SELECT prenom, consultations_animaux 
    FROM animal
    ORDER BY consultations_animaux DESC
");
$consultations = $stmt->fetchAll(PDO::FETCH_ASSOC);
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

<h2>Créer un compte employé ou vétérinaire</h2>
<form action="creer_utilisateur.php" method="POST">
    <label for="username">Email (Username) :</label>
    <input type="email" id="username" name="username" required><br><br>

    <label for="role">Rôle :</label>
    <select id="role" name="role" required>
        <option value="employe">Employé</option>
        <option value="veterinaire">Vétérinaire</option>
    </select><br><br>

    <button type="submit">Créer l'utilisateur</button>
</form>

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


<h2>Statistiques de consultation des animaux</h2>
<table>
    <thead>
        <tr>
            <th>Animal</th>
            <th>Consultations</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($consultations as $consultation): ?>
            <tr>
                <td><?= htmlspecialchars($consultation['prenom']); ?></td>
                <td><?= htmlspecialchars($consultation['consultations_animaux']); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<h2>Espace Administrateur</h2>
<a href="deconnexion.php">Déconnexion</a>

