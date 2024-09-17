<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'employe') {
    header('Location: connexion.php');
    exit();
}

include 'connexion_bdd.php';

// Activer l'affichage des erreurs
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $animal_id = $_POST['animal_id'];
    $nourriture = $_POST['nourriture'];
    $grammage = $_POST['grammage'];
    $date_consommation = $_POST['date_consommation'];

    // Vérifier que toutes les données sont bien transmises
    if (empty($animal_id) || empty($nourriture) || empty($grammage) || empty($date_consommation)) {
        die("Veuillez remplir tous les champs du formulaire.");
    }

    // Insérer la consommation dans la base de données
    try {
        $stmt = $pdo->prepare("INSERT INTO consommations_nourriture (animal_id, nourriture, grammage, date_consommation) 
                               VALUES (:animal_id, :nourriture, :grammage, :date_consommation)");
        $stmt->execute([
            'animal_id' => $animal_id,
            'nourriture' => $nourriture,
            'grammage' => $grammage,
            'date_consommation' => $date_consommation
        ]);
        // Redirection après ajout réussi
        header('Location: employe.php?animal_id=' . $animal_id);
        exit();
    } catch (PDOException $e) {
        // Afficher un message d'erreur en cas de problème
        die("Erreur lors de l'insertion : " . $e->getMessage());
    }
}
?>
