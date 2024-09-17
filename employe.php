<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'employe') {
    header('Location: connexion.php');
    exit();
}

include 'connexion_bdd.php';

// Récupérer les avis non validés
$avis = $pdo->query("SELECT * FROM avis WHERE valide = FALSE")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Employé - Validation des avis</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Bienvenue dans l'espace Employé</h1>
    <h2>Validation des avis</h2>

    <table>
        <tr>
            <th>Pseudo</th>
            <th>Avis</th>
            <th>Action</th>
        </tr>
        <?php foreach ($avis as $a): ?>
        <tr>
            <td><?= htmlspecialchars($a['pseudo']); ?></td>
            <td><?= htmlspecialchars($a['commentaire']); ?></td>
            <td>
                <!-- Boutons Valider et Rejeter -->
                <a href="valider_avis.php?id=<?= $a['id']; ?>">Valider</a>
                <a href="rejeter_avis.php?id=<?= $a['id']; ?>">Rejeter</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
