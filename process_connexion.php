<?php
session_start();
include 'connexion_bdd.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Requête pour récupérer l'utilisateur
    $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vérification du mot de passe
    if ($user && password_verify($password, $user['mot_de_passe'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        //Redirection en fonction du rôle 
        if ($user['role'] == 'admin') {
            header('Location: admin.php');
        } elseif ($user['role'] == 'employe') {
            header('Location: employe.php');
        } elseif ($user['role'] == 'veterinaire') {
            header('Location: veterinaire.php');
        }
        exit();
    } else {
        echo "Identifiants incorrects.";
    }
    
}
?>
