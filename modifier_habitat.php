<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: connexion.php');
    exit();
}

include 'connexion_bdd.php';

// Vérifier si l'ID de l'habitat est passé en paramètre
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Récupérer les informations de l'habitat à modifier
    $stmt = $pdo->prepare("SELECT * FROM habitats WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $habitat = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$habitat) {
        echo "Habitat non trouvé.";
        exit();
    }
}

// Si le formulaire est soumis, on met à jour les informations de l'habitat
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $description = $_POST['description'];

    // Mettre à jour l'habitat dans la base de données
    $stmt = $pdo->prepare("UPDATE habitats SET nom = :nom, description = :description WHERE id = :id");
    $stmt->execute(['nom' => $nom, 'description' => $description, 'id' => $id]);

    // Redirection après modification
    header('Location: admin.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Habitat</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Modifier l'Habitat</h1>

    <form action="modifier_habitat.php?id=<?= $habitat['id']; ?>" method="POST">
        <label for="nom">Nom de l'habitat :</label>
        <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($habitat['nom']); ?>" required><br><br>
        
        <label for="description">Description de l'habitat :</label>
        <textarea id="description" name="description" required><?= htmlspecialchars($habitat['description']); ?></textarea><br><br>
        
        <input type="submit" value="Modifier l'habitat">
    </form>
</body>
</html>
