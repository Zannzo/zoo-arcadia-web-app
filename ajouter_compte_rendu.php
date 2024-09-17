<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'veterinaire') {
    header('Location: connexion.php');
    exit();
}

include 'connexion_bdd.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $animal_id = $_POST['animal_id'];
    $etat = $_POST['etat'];
    $nourriture_proposee = $_POST['nourriture_proposee'];
    $grammage_nourriture = $_POST['grammage_nourriture'];
    $date_passage = $_POST['date_passage'];
    $detail_etat = $_POST['detail_etat'] ?? null;

    // Insérer le compte rendu dans la base de données
    $stmt = $pdo->prepare("INSERT INTO comptes_rendus (animal_id, etat, nourriture_proposee, grammage_nourriture, date_passage, detail_etat) 
                           VALUES (:animal_id, :etat, :nourriture_proposee, :grammage_nourriture, :date_passage, :detail_etat)");
    $stmt->execute([
        'animal_id' => $animal_id,
        'etat' => $etat,
        'nourriture_proposee' => $nourriture_proposee,
        'grammage_nourriture' => $grammage_nourriture,
        'date_passage' => $date_passage,
        'detail_etat' => $detail_etat
    ]);

    // Redirection après ajout
    header('Location: veterinaire.php?animal_id=' . $animal_id);
    exit();
}
?>
