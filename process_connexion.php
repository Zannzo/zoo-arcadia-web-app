<?php
session_start();
include 'connexion_bdd.php'; // Connexion à la base de données

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $mot_de_passe = $_POST['mot_de_passe'];

    // Requête pour récupérer l'utilisateur et son rôle
    $stmt = $pdo->prepare("
        SELECT utilisateur.*, role.label AS role_label 
        FROM utilisateur 
        JOIN role ON utilisateur.role_id = role.role_id 
        WHERE username = :username
    ");
    $stmt->execute(['username' => $username]);
    $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vérification du mot de passe
    if ($utilisateur && password_verify($mot_de_passe, $utilisateur['password'])) {
        // Démarrer la session pour l'utilisateur
        $_SESSION['user_id'] = $utilisateur['username'];  
        $_SESSION['username'] = $utilisateur['username'];
        $_SESSION['role'] = $utilisateur['role_label'];  

        // Rediriger en fonction du rôle stocké dans la session
        if ($_SESSION['role'] === 'admin') {
            header('Location: admin.php');  
        } elseif ($_SESSION['role'] === 'employe') {
            header('Location: employe.php');  
        } elseif ($_SESSION['role'] === 'veterinaire') {
            header('Location: veterinaire.php');  
        } else {
            header('Location: index.php'); 
        }
        exit();
    } else {
        $erreur = "Nom d'utilisateur ou mot de passe incorrect";
    }
}
?>
