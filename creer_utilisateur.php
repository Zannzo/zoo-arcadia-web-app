<?php
session_start();
include 'connexion_bdd.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $role = $_POST['role'];

    // Générer un mot de passe aléatoire
    $mot_de_passe = bin2hex(random_bytes(4)); // Génère un mot de passe aléatoire de 8 caractères
    $mot_de_passe_hache = password_hash($mot_de_passe, PASSWORD_BCRYPT);

    // Définir le rôle_id basé sur le rôle sélectionné
    $role_id = ($role === 'employe') ? 2 : 3; // 2 pour employé, 3 pour vétérinaire, à ajuster selon ta DB

    // Insérer l'utilisateur dans la base de données
    $stmt = $pdo->prepare("INSERT INTO utilisateur (username, password, role_id) VALUES (:username, :password, :role_id)");
    $stmt->execute([
        'username' => $username,
        'password' => $mot_de_passe_hache,
        'role_id' => $role_id
    ]);

    // Envoyer un email avec le nom d'utilisateur (email), mais sans le mot de passe
    $to = $username;
    $subject = "Votre compte a été créé sur Zoo Arcadia";
    $message = "Bonjour,\n\nVotre compte en tant que $role a été créé. Votre nom d'utilisateur est $username.\nVeuillez contacter l'administrateur pour obtenir votre mot de passe.";
    $headers = "From: admin@zoo-arcadia.com";

    if (mail($to, $subject, $message, $headers)) {
        echo "L'email a été envoyé avec succès à $username";
    } else {
        echo "L'envoi de l'email a échoué.";
    }

    // Redirection vers l'espace administrateur
    header('Location: admin.php');
    exit();
}
?>
