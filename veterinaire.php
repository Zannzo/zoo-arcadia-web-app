<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'veterinaire') {
    header('Location: connexion.php');
    exit();
}

include 'connexion_bdd.php';

// Récupérer les animaux
$requeteAnimaux = $pdo->query("SELECT * FROM animal");
$animaux = $requeteAnimaux->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les comptes rendus pour un animal donné
$comptes_rendus = [];
if (isset($_GET['animal_id'])) {
    $animal_id = $_GET['animal_id'];
    $stmt = $pdo->prepare("SELECT grammage_nourriture, nourriture_proposee, date, detail FROM rapport_veterinaire WHERE animal_id = :animal_id ORDER BY date DESC");
    $stmt->execute(['animal_id' => $animal_id]);
    $comptes_rendus = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Récupérer les consommations pour un animal donné
$consommations = [];
if (isset($_GET['animal_id'])) {
    $stmt = $pdo->prepare("SELECT * FROM consommations_nourriture WHERE animal_id = :animal_id ORDER BY date_consommation DESC");
    $stmt->execute(['animal_id' => $animal_id]);
    $consommations = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Vétérinaire</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Espace Vétérinaire</h2>
<a href="deconnexion.php">Déconnexion</a>

<!-- Formulaire de sélection d'animal -->
<form method="GET" action="veterinaire.php">
    <label for="animal">Choisir un animal :</label>
    <select name="animal_id" id="animal" required>
        <option value="">Sélectionner un animal</option>
        <?php foreach ($animaux as $animal): ?>
            <option value="<?= $animal['animal_id']; ?>" <?= isset($animal_id) && $animal_id == $animal['animal_id'] ? 'selected' : ''; ?>>
                <?= htmlspecialchars($animal['prenom']); ?>
            </option>
        <?php endforeach; ?>
    </select>
    <input type="submit" value="Voir les comptes rendus">
</form>

<h2>Comptes rendus existants</h2>
<table>
    <thead>
        <tr>
            <th>Date</th>
            <th>Détail</th>
            <th>Nourriture</th>
            <th>Grammage (g)</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($comptes_rendus)): ?>
            <?php foreach ($comptes_rendus as $compte): ?>
            <tr>
                <td><?= htmlspecialchars($compte['date']); ?></td>
                <td><?= htmlspecialchars($compte['detail']); ?></td>
                <td><?= htmlspecialchars($compte['nourriture_proposee']); ?></td>
                <td><?= htmlspecialchars($compte['grammage_nourriture']); ?>g</td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="4">Aucun compte rendu disponible pour cet animal.</td></tr>
        <?php endif; ?>
    </tbody>
</table>

<h2>Ajouter un compte rendu</h2>
<form action="ajouter_compte_rendu.php" method="POST">
    <label for="animal_id">Animal :</label>
    <select name="animal_id" id="animal_id" required>
        <?php foreach ($animaux as $animal): ?>
            <option value="<?= $animal['animal_id']; ?>"><?= htmlspecialchars($animal['prenom']); ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <label for="etat">Détail de l'état de l'animal :</label>
    <textarea name="detail" id="etat" required></textarea><br><br>

    <label for="nourriture_proposee">Nourriture proposée :</label>
    <input type="text" name="nourriture_proposee" id="nourriture_proposee" required><br><br>

    <label for="grammage_nourriture">Grammage :</label>
    <input type="number" name="grammage_nourriture" id="grammage_nourriture" required><br><br>

    <label for="date_passage">Date de passage :</label>
    <input type="date" name="date_passage" id="date_passage" required><br><br>

    <button type="submit">Ajouter le compte rendu</button>
</form>

<h2>Historique des consommations de nourriture</h2>
<table>
    <thead>
        <tr>
            <th>Date</th>
            <th>Nourriture</th>
            <th>Quantité (g)</th>
        </tr>
    </thead>
    <tbody>
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
    </tbody>
</table>

</body>
</html>
