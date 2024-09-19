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
    $quantite = $_POST['quantite'];  // Remplacer grammage par quantite
    $date_consommation = $_POST['date_consommation'];
    $heure_consommation = $_POST['heure_consommation'];  // Ajouter l'heure de consommation

    // Vérifier que toutes les données sont bien transmises
    if (empty($animal_id) || empty($nourriture) || empty($quantite) || empty($date_consommation) || empty($heure_consommation)) {
        die("Veuillez remplir tous les champs du formulaire.");
    }

    // Insérer la consommation dans la base de données
    try {
        $stmt = $pdo->prepare("
            INSERT INTO consommations_nourriture (animal_id, nourriture, quantite, date_consommation, heure_consommation) 
            VALUES (:animal_id, :nourriture, :quantite, :date_consommation, :heure_consommation)
        ");
        $stmt->execute([
            'animal_id' => $animal_id,
            'nourriture' => $nourriture,
            'quantite' => $quantite,  // Utiliser quantite au lieu de grammage
            'date_consommation' => $date_consommation,
            'heure_consommation' => $heure_consommation  // Insertion de l'heure de consommation
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
