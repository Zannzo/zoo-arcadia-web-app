<?php
include 'connexion_bdd.php';

if (isset($_GET['animal_id'])) {
    $animal_id = $_GET['animal_id'];

    // Incrémenter le compteur de consultations
    $stmt = $pdo->prepare("UPDATE animaux SET consultations = consultations + 1 WHERE id = :animal_id");
    $stmt->execute(['animal_id' => $animal_id]);

    // Récupérer les détails de l'animal
    $stmt = $pdo->prepare("SELECT * FROM animaux WHERE id = :animal_id");
    $stmt->execute(['animal_id' => $animal_id]);
    $animal = $stmt->fetch(PDO::FETCH_ASSOC);

    // Afficher les détails de l'animal (nom, description, etc.)
    echo "<h1>" . htmlspecialchars($animal['nom']) . "</h1>";
    echo "<p>Nombre de consultations : " . $animal['consultations'] . "</p>";
}
?>
