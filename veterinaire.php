<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'veterinaire') {
    header('Location: connexion.php');
    exit();
}

include 'connexion_bdd.php';

// Récupérer la liste des animaux
$animaux = $pdo->query("SELECT * FROM animaux")->fetchAll(PDO::FETCH_ASSOC);

// Initialiser la variable $comptes_rendus
$comptes_rendus = [];

// Vérifier si un animal est sélectionné
if (isset($_GET['animal_id'])) {
    $animal_id = $_GET['animal_id'];

    // Préparer et exécuter la requête avec un paramètre
    $stmt = $pdo->prepare("SELECT * FROM comptes_rendus WHERE animal_id = :animal_id ORDER BY date_passage DESC");
    $stmt->execute(['animal_id' => $animal_id]);
    $comptes_rendus = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Vétérinaire - Comptes rendus</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- Formulaire de sélection d'animal -->
<form method="GET" action="veterinaire.php">
    <label for="animal">Choisir un animal :</label>
    <select name="animal_id" id="animal" required>
        <option value="">Sélectionner un animal</option>
        <?php foreach ($animaux as $animal): ?>
            <option value="<?= $animal['id']; ?>" <?= isset($animal_id) && $animal_id == $animal['id'] ? 'selected' : ''; ?>>
                <?= htmlspecialchars($animal['nom']); ?>
            </option>
        <?php endforeach; ?>
    </select>
    <input type="submit" value="Voir les comptes rendus">
</form>

<h2>Comptes rendus existants</h2>
<table>
    <tr>
        <th>Date</th>
        <th>État</th>
        <th>Nourriture</th>
        <th>Quantité</th>
        <th>Détails</th>
    </tr>
    <?php if (!empty($comptes_rendus)): ?>
        <?php foreach ($comptes_rendus as $compte): ?>
        <tr>
            <td><?= htmlspecialchars($compte['date_passage']); ?></td>
            <td><?= htmlspecialchars($compte['etat']); ?></td>
            <td><?= htmlspecialchars($compte['nourriture_proposee']); ?></td>
            <td><?= htmlspecialchars($compte['grammage_nourriture']); ?>g</td>
            <td><?= htmlspecialchars($compte['detail_etat']); ?></td>
        </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr><td colspan="5">Aucun compte rendu disponible pour cet animal.</td></tr>
    <?php endif; ?>
</table>

    <h1>Ajouter un compte rendu</h1>

    <form action="ajouter_compte_rendu.php" method="POST">
        <label for="animal">Sélectionner l'animal :</label>
        <select id="animal" name="animal_id" required>
            <?php foreach ($animaux as $animal): ?>
                <option value="<?= $animal['id']; ?>"><?= htmlspecialchars($animal['nom']); ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <label for="etat">État de l'animal :</label>
        <textarea id="etat" name="etat" required></textarea><br><br>

        <label for="nourriture">Nourriture proposée :</label>
        <input type="text" id="nourriture" name="nourriture_proposee" required><br><br>

        <label for="grammage">Grammage de la nourriture (en grammes) :</label>
        <input type="number" id="grammage" name="grammage_nourriture" required><br><br>

        <label for="date">Date de passage :</label>
        <input type="date" id="date" name="date_passage" required><br><br>

        <label for="detail">Détails supplémentaires (facultatif) :</label>
        <textarea id="detail" name="detail_etat"></textarea><br><br>

        <input type="submit" value="Ajouter le compte rendu">
    </form>
</body>
</html>
