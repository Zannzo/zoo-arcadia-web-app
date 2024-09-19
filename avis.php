<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'employe') {
    header('Location: connexion.php');
    exit();
}

include 'connexion_bdd.php';

// Récupérer les avis invisibles (en attente de validation)
$requeteAvis = $pdo->query("SELECT * FROM avis WHERE invisible = 1");
$avis = $requeteAvis->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Avis</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Gestion des Avis en attente</h1>

    <table>
        <thead>
            <tr>
                <th>Pseudo</th>
                <th>Commentaire</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($avis as $a) : ?>
            <tr>
                <td><?= htmlspecialchars($a['pseudo']); ?></td>
                <td><?= htmlspecialchars($a['commentaire']); ?></td>
                <td>
                    <a href="valider_avis.php?id=<?= $a['avis_id']; ?>">Valider</a>
                    <a href="rejeter_avis.php?id=<?= $a['avis_id']; ?>">Rejeter</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
