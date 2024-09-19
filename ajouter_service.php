<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: connexion.php');
    exit();
}

include 'connexion_bdd.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $description = $_POST['description'];

    // Vérification simple avant l'insertion
    if (!empty($nom) && !empty($description)) {
        $stmt = $pdo->prepare("INSERT INTO service (nom, description) VALUES (:nom, :description)");
        $stmt->execute(['nom' => $nom, 'description' => $description]);

        header('Location: admin.php'); // Rediriger vers l'admin après ajout
        exit();
    } else {
        echo "Veuillez remplir tous les champs.";
    }
}
?>
