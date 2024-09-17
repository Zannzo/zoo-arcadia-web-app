<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: connexion.php');
    exit();
}

include 'connexion_bdd.php';

// Vérifier si l'ID du service est passé en paramètre
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Récupérer les informations du service à modifier
    $stmt = $pdo->prepare("SELECT * FROM services WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $service = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$service) {
        echo "Service non trouvé.";
        exit();
    }
}

// Si le formulaire est soumis, on met à jour les informations du service
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $description = $_POST['description'];

    // Mettre à jour le service dans la base de données
    $stmt = $pdo->prepare("UPDATE services SET nom = :nom, description = :description WHERE id = :id");
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
    <title>Modifier un Service</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Modifier le Service</h1>

    <form action="modifier_service.php?id=<?= $service['id']; ?>" method="POST">
        <label for="nom">Nom du service :</label>
        <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($service['nom']); ?>" required><br><br>
