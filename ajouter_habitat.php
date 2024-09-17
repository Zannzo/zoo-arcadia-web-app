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

    // Insérer un nouvel habitat dans la base de données
    $stmt = $pdo->prepare("INSERT INTO habitats (nom, description) VALUES (:nom, :description)");
    $stmt->execute(['nom' => $nom, 'description' => $description]);

    // Redirection après ajout
    header('Location: admin.php');
    exit();
}
?>
