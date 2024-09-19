<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'employe') {
    header('Location: connexion.php');
    exit();
}

include 'connexion_bdd.php';

// Récupérer les animaux
$requeteAnimaux = $pdo->query("SELECT * FROM animal");
$animaux = $requeteAnimaux->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les consommations pour un animal donné
$consommations = [];
if (isset($_GET['animal_id'])) {
    $animal_id = $_GET['animal_id'];
    $stmt = $pdo->prepare("SELECT * FROM consommations_nourriture WHERE animal_id = :animal_id ORDER BY date_consommation DESC, heure_consommation DESC");
    $stmt->execute(['animal_id' => $animal_id]);
    $consommations = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Employé</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Espace Employé</h1>

    <!-- Formulaire de sélection d'animal -->
    <form method="GET" action="employe.php">
        <label for="animal">Choisir un animal :</label>
        <select name="animal_id" id="animal" required>
            <option value="">Sélectionner un animal</option>
            <?php foreach ($animaux as $animal): ?>
                <option value="<?= $animal['animal_id']; ?>" <?= isset($animal_id) && $animal_id == $animal['animal_id'] ? 'selected' : ''; ?>>
                    <?= htmlspecialchars($animal['prenom']); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="Voir les consommations">
    </form>

    <h2>Consommations de nourriture</h2>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Heure</th>
                <th>Nourriture</th>
                <th>Quantité (grammes)</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($consommations)): ?>
                <?php foreach ($consommations as $consommation): ?>
                <tr>
                    <td><?= htmlspecialchars($consommation['date_consommation']); ?></td>
                    <td><?= htmlspecialchars($consommation['heure_consommation']); ?></td>
                    <td><?= htmlspecialchars($consommation['nourriture']); ?></td>
                    <td><?= htmlspecialchars($consommation['quantite']); ?>g</td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="4">Aucune consommation disponible pour cet animal.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <h2>Ajouter une consommation de nourriture</h2>
    <form action="ajouter_consommation.php" method="POST">
        <label for="animal_id">Animal :</label>
        <select name="animal_id" id="animal_id" required>
            <?php foreach ($animaux as $animal): ?>
                <option value="<?= $animal['animal_id']; ?>"><?= htmlspecialchars($animal['prenom']); ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <label for="nourriture">Nourriture donnée :</label>
        <input type="text" name="nourriture" id="nourriture" required><br><br>

        <label for="quantite">Quantité (en grammes) :</label>
        <input type="number" name="quantite" id="quantite" required><br><br>

        <label for="date_consommation">Date de consommation :</label>
        <input type="date" name="date_consommation" id="date_consommation" required><br><br>

        <label for="heure_consommation">Heure de consommation :</label>
        <input type="time" name="heure_consommation" id="heure_consommation" required><br><br>

        <button type="submit">Ajouter la consommation</button>
    </form>
</body>
</html>
