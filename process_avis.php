<?php
session_start();
include 'connexion_bdd.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pseudo = $_POST['pseudo'];
    $commentaire = $_POST['commentaire'];

    if (!empty($pseudo) && !empty($commentaire)) {
        // Insertion de l'avis avec invisible à 1 (en attente de validation)
        $stmt = $pdo->prepare("INSERT INTO avis (pseudo, commentaire, invisible) VALUES (:pseudo, :commentaire, 1)");
        $stmt->execute(['pseudo' => $pseudo, 'commentaire' => $commentaire]);

        $confirmation = "Votre avis a été soumis et sera validé par un employé.";
    } else {
        $erreur = "Tous les champs sont requis.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soumettre un avis</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Soumettre un avis</h1>

    <?php if (isset($confirmation)): ?>
        <p style="color:green;"><?= htmlspecialchars($confirmation); ?></p>
    <?php endif; ?>

    <?php if (isset($erreur)): ?>
        <p style="color:red;"><?= htmlspecialchars($erreur); ?></p>
    <?php endif; ?>

    <form action="process_avis.php" method="POST">
        <label for="pseudo">Votre pseudo :</label>
        <input type="text" id="pseudo" name="pseudo" required><br><br>

        <label for="commentaire">Votre avis :</label>
        <textarea id="commentaire" name="commentaire" required></textarea><br><br>

        <button type="submit">Soumettre</button>
    </form>
</body>
</html>
