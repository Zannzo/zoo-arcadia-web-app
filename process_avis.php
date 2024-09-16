<?php
include 'connexion_bdd.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pseudo = $_POST['pseudo'];
    $commentaire = $_POST['avis'];

    // Préparation de la requête pour insérer l'avis
    $stmt = $pdo->prepare("INSERT INTO avis (pseudo, commentaire) VALUES (:pseudo, :commentaire)");
    $stmt->execute(['pseudo' => $pseudo, 'commentaire' => $commentaire]);

    echo "Votre avis a bien été soumis et sera validé par un employé.";
}
?>
