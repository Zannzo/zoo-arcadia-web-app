<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: connexion.php');
    exit();
}

include 'connexion_bdd.php';

// Récupérer les données de l'habitat
if (isset($_GET['id'])) {
    $habitat_id = $_GET['id'];

    $stmt = $pdo->prepare("SELECT * FROM habitat WHERE habitat_id = :habitat_id");
    $stmt->execute(['habitat_id' => $habitat_id]);
    $habitat = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Mise à jour de l'habitat
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $description = $_POST['description'];

    if (!empty($nom) && !empty($description)) {
        $stmt = $pdo->prepare("UPDATE habitat SET nom = :nom, description = :description WHERE habitat_id = :habitat_id");
        $stmt->execute([
            'nom' => $nom,
            'description' => $description,
            'habitat_id' => $habitat_id
        ]);

        header('Location: admin.php'); // Redirection après modification
        exit();
    } else {
        echo "Veuillez remplir tous les champs.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Habitat</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Modifier Habitat</h1>

    <form action="modifier_habitat.php?id=<?= $habitat_id ?>" method="POST">
        <label for="nom">Nom de l'habitat :</label>
        <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($habitat['nom']); ?>" required><br><br>

        <label for="description">Description :</label>
        <textarea id="description" name="description" required><?= htmlspecialchars($habitat['description']); ?></textarea><br><br>

        <button type="submit">Modifier</button>
    </form>
</body>
</html>
