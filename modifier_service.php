<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: connexion.php');
    exit();
}

include 'connexion_bdd.php';

// Récupérer les données du service
if (isset($_GET['id'])) {
    $service_id = $_GET['id'];

    $stmt = $pdo->prepare("SELECT * FROM service WHERE service_id = :service_id");
    $stmt->execute(['service_id' => $service_id]);
    $service = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Mise à jour du service
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $description = $_POST['description'];

    if (!empty($nom) && !empty($description)) {
        $stmt = $pdo->prepare("UPDATE service SET nom = :nom, description = :description WHERE service_id = :service_id");
        $stmt->execute([
            'nom' => $nom,
            'description' => $description,
            'service_id' => $service_id
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
    <title>Modifier Service</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Modifier Service</h1>

    <form action="modifier_service.php?id=<?= $service_id ?>" method="POST">
        <label for="nom">Nom du service :</label>
        <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($service['nom']); ?>" required><br><br>

        <label for="description">Description :</label>
        <textarea id="description" name="description" required><?= htmlspecialchars($service['description']); ?></textarea><br><br>

        <button type="submit">Modifier</button>
    </form>
</body>
</html>
