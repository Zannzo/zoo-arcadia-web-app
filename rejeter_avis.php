<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'employe') {
    header('Location: connexion.php');
    exit();
}

include 'connexion_bdd.php';

if (isset($_GET['id'])) {
    $avis_id = $_GET['id'];

    // Supprimer l'avis
    $stmt = $pdo->prepare("DELETE FROM avis WHERE avis_id = :avis_id");
    $stmt->execute(['avis_id' => $avis_id]);

    header('Location: avis.php'); 
    exit();
} else {
    echo "Avis non trouvé.";
}
?>
