<?php
include 'connexion_bdd.php';

if (isset($_GET['animal_id'])) {
    $animal_id = $_GET['animal_id'];

    // Incrémenter le compteur de consultations
    $stmt = $pdo->prepare("UPDATE animal SET consultations_animaux = consultations_animaux + 1 WHERE animal_id = :animal_id");
    $stmt->execute(['animal_id' => $animal_id]);

    // Récupérer les détails de l'animal
    $stmt = $pdo->prepare("SELECT * FROM animal WHERE animal_id = :animal_id");
    $stmt->execute(['animal_id' => $animal_id]);
    $animal = $stmt->fetch(PDO::FETCH_ASSOC);

    // Afficher les détails de l'animal (nom, description, etc.)
    echo "<h1>" . htmlspecialchars($animal['prenom']) . "</h1>";
    echo "<p>Nombre de consultations : " . $animal['consultations_animaux'] . "</p>";
}
?>
