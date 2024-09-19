<?php


// Si un mot de passe a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mot_de_passe = $_POST['mot_de_passe'];

    // Générer le hash du mot de passe
    if (!empty($mot_de_passe)) {
        $hash = password_hash($mot_de_passe, PASSWORD_BCRYPT);
        echo "Mot de passe haché : " . htmlspecialchars($hash);
    } else {
        echo "Veuillez saisir un mot de passe.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Générer un mot de passe</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Générer un mot de passe haché</h1>

    <form action="generer_mot_de_passe.php" method="POST">
        <label for="mot_de_passe">Saisir le mot de passe :</label>
        <input type="text" id="mot_de_passe" name="mot_de_passe" required><br><br>

        <button type="submit">Générer le hash</button>
    </form>
</body>
</html>
