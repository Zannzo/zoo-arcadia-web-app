<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'employe') {
    header('Location: connexion.php');
    exit();
}

include 'connexion_bdd.php';

if (isset($_GET['id'])) {
    $stmt = $pdo->prepare("DELETE FROM avis WHERE id = :id");
    $stmt->execute(['id' => $_GET['id']]);

    // Redirection vers l'espace employé
    header('Location: employe.php');
    exit();
}
?>
