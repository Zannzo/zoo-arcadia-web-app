<?php
session_start();
include 'connexion_bdd.php';

// Récupérer tous les habitats depuis la base de données
$requeteHabitats = $pdo->query("SELECT * FROM habitat");
$habitats = $requeteHabitats->fetchAll(PDO::FETCH_ASSOC);

// Vérifier si un habitat est sélectionné
$habitat_selectionne = null;
$animaux = [];
$animal_selectionne = null;
$rapports_veterinaire = [];

if (isset($_GET['habitat_id'])) {
    $habitat_id = $_GET['habitat_id'];

    // Récupérer les détails de l'habitat sélectionné
    $stmt = $pdo->prepare("SELECT * FROM habitat WHERE habitat_id = :habitat_id");
    $stmt->execute(['habitat_id' => $habitat_id]);
    $habitat_selectionne = $stmt->fetch(PDO::FETCH_ASSOC);

    // Récupérer les animaux associés à cet habitat
    $stmt_animaux = $pdo->prepare("SELECT animal.*, race.libelle AS race_libelle 
                                   FROM animal 
                                   JOIN race ON animal.race_id = race.race_id 
                                   WHERE animal.habitat_id = :habitat_id");
    $stmt_animaux->execute(['habitat_id' => $habitat_id]);
    $animaux = $stmt_animaux->fetchAll(PDO::FETCH_ASSOC);
}

// Vérifier si un animal est sélectionné pour afficher ses détails et les avis du vétérinaire
if (isset($_GET['animal_id'])) {
    $animal_id = $_GET['animal_id'];

    // Incrémenter le compteur de consultations de l'animal
    $stmt_incr = $pdo->prepare("UPDATE animal SET consultations_animaux = consultations_animaux + 1 WHERE animal_id = :animal_id");
    $stmt_incr->execute(['animal_id' => $animal_id]);

    // Récupérer les détails de l'animal sélectionné
    $stmt = $pdo->prepare("SELECT animal.*, race.libelle AS race_libelle 
                           FROM animal 
                           JOIN race ON animal.race_id = race.race_id 
                           WHERE animal.animal_id = :animal_id");
    $stmt->execute(['animal_id' => $animal_id]);
    $animal_selectionne = $stmt->fetch(PDO::FETCH_ASSOC);

    // Récupérer les rapports vétérinaires pour cet animal
    $stmt_rapports = $pdo->prepare("SELECT * FROM rapport_veterinaire WHERE animal_id = :animal_id ORDER BY date DESC");
    $stmt_rapports->execute(['animal_id' => $animal_id]);
    $rapports_veterinaire = $stmt_rapports->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nos Habitats</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Nos Habitats</h1>
        <nav>
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="habitats.php">Nos Habitats</a></li>
                <li><a href="services.php">Nos Services</a></li>
                <li><a href="connexion.php">Connexion</a></li>
                <li><a href="contact.php">Contactez-nous</a></li>
            </ul>
        </nav>
    </header>

    <section id="habitats">
        <h2>Découvrez nos habitats</h2>
        <?php foreach ($habitats as $habitat): ?>
            <div class="habitat">
                <!-- Lien pour afficher les détails de l'habitat -->
                <a href="habitats.php?habitat_id=<?= $habitat['habitat_id']; ?>">
                    <h3><?= htmlspecialchars($habitat['nom']); ?></h3>
                    <!-- Afficher uniquement l'image de l'habitat -->
                    <?php if (!empty($habitat['image'])): ?>
                        <img src="<?= htmlspecialchars($habitat['image']); ?>" alt="Image de <?= htmlspecialchars($habitat['nom']); ?>" />
                    <?php endif; ?>
                </a>
            </div>
        <?php endforeach; ?>
    </section>

    <?php if ($habitat_selectionne): ?>
        <section id="details-habitat">
            <h2>Détails de l'habitat : <?= htmlspecialchars($habitat_selectionne['nom']); ?></h2>
            <p><?= htmlspecialchars($habitat_selectionne['description']); ?></p>

            <h3>Animaux dans cet habitat :</h3>
            <?php if (!empty($animaux)): ?>
                <ul>
                    <?php foreach ($animaux as $animal): ?>
                        <li>
                            <a href="habitats.php?habitat_id=<?= $habitat_id; ?>&animal_id=<?= $animal['animal_id']; ?>">
                                <?= htmlspecialchars($animal['prenom']); ?> (Race : <?= htmlspecialchars($animal['race_libelle']); ?>)
                            </a>
                            <?php if (!empty($animal['image'])): ?>
                                <img src="<?= htmlspecialchars($animal['image']); ?>" alt="Image de <?= htmlspecialchars($animal['prenom']); ?>" />
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>Aucun animal trouvé pour cet habitat.</p>
            <?php endif; ?>
        </section>
    <?php endif; ?>

    <?php if ($animal_selectionne): ?>
        <section id="details-animal">
            <h2>Détails de l'animal : <?= htmlspecialchars($animal_selectionne['prenom']); ?></h2>
            <p>Race : <?= htmlspecialchars($animal_selectionne['race_libelle']); ?></p>
            <p>Habitat : <?= htmlspecialchars($animal_selectionne['habitat_id']); ?></p>

            <h3>Rapports vétérinaires :</h3>
            <?php if (!empty($rapports_veterinaire)): ?>
                <ul>
                    <?php foreach ($rapports_veterinaire as $rapport): ?>
                        <li>
                            <p><strong>Date de passage :</strong> <?= htmlspecialchars($rapport['date_passage']); ?></p>
                            <p><strong>État :</strong> <?= htmlspecialchars($rapport['detail']); ?></p>
                            <p><strong>Nourriture proposée :</strong> <?= htmlspecialchars($rapport['nourriture_proposee']); ?></p>
                            <p><strong>Grammage :</strong> <?= htmlspecialchars($rapport['grammage_nourriture']); ?> g</p>
                            <p><strong>Détails :</strong> <?= htmlspecialchars($rapport['detail_etat']); ?></p>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>Aucun rapport vétérinaire pour cet animal.</p>
            <?php endif; ?>
        </section>
    <?php endif; ?>

    <footer>
        <p>&copy; 2024 Zoo Arcadia - Tous droits réservés</p>
    </footer>
</body>
</html>
