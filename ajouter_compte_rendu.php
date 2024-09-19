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
    $nourriture = $_POST['nourriture_proposee'];
    $grammage = $_POST['grammage_nourriture'];
    $date_passage = $_POST['date_passage'];
    $detail_etat = $_POST['detail_etat'] ?? ''; // Optionnel

    if (!empty($animal_id) && !empty($etat) && !empty($nourriture) && !empty($grammage) && !empty($date_passage)) {
        $stmt = $pdo->prepare("INSERT INTO rapport_veterinaire (animal_id, date, detail) 
            VALUES (:animal_id, :date_passage, :etat)");
        $stmt->execute([
            'animal_id' => $animal_id,
            'date_passage' => $date_passage,
            'etat' => $etat
        ]);

        header('Location: veterinaire.php'); // Redirection après ajout
        exit();
    } else {
        echo "Tous les champs sont requis.";
    }
}
?>
