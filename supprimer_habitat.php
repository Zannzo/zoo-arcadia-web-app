<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: connexion.php');
    exit();
}

include 'connexion_bdd.php';

if (isset($_GET['id'])) {
    $habitat_id = $_GET['id'];

    // Suppression sécurisée avec une requête préparée
    $stmt = $pdo->prepare("DELETE FROM habitat WHERE habitat_id = :habitat_id");
    $stmt->execute(['habitat_id' => $habitat_id]);

    header('Location: admin.php'); // Redirection après suppression
    exit();
} else {
    echo "Habitat non trouvé.";
}
?>
