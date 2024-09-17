<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'employe') {
    header('Location: connexion.php');
    exit();
}

include 'connexion_bdd.php';

// Récupérer la liste des animaux
$animaux = $pdo->query("SELECT * FROM animaux")->fetchAll(PDO::FETCH_ASSOC);

// Initialiser la variable $animal_id pour éviter l'erreur
$animal_id = null;

// Vérifier si un animal est sélectionné
if (isset($_GET['animal_id'])) {
    $animal_id = $_GET['animal_id'];

    // Récupérer les consommations passées pour l'animal sélectionné
    $stmt = $pdo->prepare("SELECT * FROM consommations_nourriture WHERE animal_id = :animal_id ORDER BY date_consommation DESC");
    $stmt->execute(['animal_id' => $animal_id]);
    $consommations = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $consommations = [];
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de la nourriture des animaux</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- Formulaire pour ajouter une nouvelle consommation -->
<h1>Ajouter une consommation de nourriture</h1>

<form action="ajouter_consommation.php" method="POST">
    <label for="animal">Sélectionner l'animal :</label>
    <select id="animal" name="animal_id" required>
        <?php foreach ($animaux as $animal): ?>
            <option value="<?= $animal['id']; ?>" <?= isset($animal_id) && $animal_id == $animal['id'] ? 'selected' : ''; ?>>
                <?= htmlspecialchars($animal['nom']); ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <label for="nourriture">Type de nourriture :</label>
    <input type="text" id="nourriture" name="nourriture" required><br><br>

    <label for="grammage">Quantité (en grammes) :</label>
    <input type="number" id="grammage" name="grammage" required><br><br>

    <label for="date">Date et heure :</label>
    <input type="datetime-local" id="date" name="date_consommation" required><br><br>

    <input type="submit" value="Ajouter la consommation">
</form>

<!-- Affichage des consommations passées -->
<h2>Consommations passées</h2>
<table>
    <tr>
        <th>Date</th>
        <th>Nourriture</th>
        <th>Quantité</th>
    </tr>
    <?php if (!empty($consommations)): ?>
        <?php foreach ($consommations as $consommation): ?>
        <tr>
            <td><?= htmlspecialchars($consommation['date_consommation']); ?></td>
            <td><?= htmlspecialchars($consommation['nourriture']); ?></td>
            <td><?= htmlspecialchars($consommation['grammage']); ?>g</td>
        </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr><td colspan="3">Aucune consommation enregistrée pour cet animal.</td></tr>
    <?php endif; ?>
</table>

</body>
</html>
