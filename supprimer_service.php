<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: connexion.php');
    exit();
}

include 'connexion_bdd.php';

if (isset($_GET['id'])) {
    $service_id = $_GET['id'];

    // Suppression sécurisée avec une requête préparée
    $stmt = $pdo->prepare("DELETE FROM service WHERE service_id = :service_id");
    $stmt->execute(['service_id' => $service_id]);

    header('Location: admin.php'); // Redirection après suppression
    exit();
} else {
    echo "Service non trouvé.";
}
?>
