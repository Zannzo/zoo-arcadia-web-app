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

    // Supprimer l'habitat de la base de données
    $stmt = $pdo->prepare("DELETE FROM habitats WHERE id = :id");
    $stmt->execute(['id' => $id]);

    // Redirection après suppression
    header('Location: admin.php');
    exit();
}
?>
