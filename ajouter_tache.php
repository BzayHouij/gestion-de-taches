<?php
// Inclure la configuration pour la connexion à la base de données
require_once 'config.php';

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $date_limite = $_POST['date_limite'];
    $utilisateur_id = $_POST['utilisateur_id'];

    // Ajouter la tâche dans la base de données
    $query = "INSERT INTO taches (titre, description, date_limite, utilisateur_id) VALUES (:titre, :description, :date_limite, :utilisateur_id)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':titre', $titre);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':date_limite', $date_limite);
    $stmt->bindParam(':utilisateur_id', $utilisateur_id);

    if ($stmt->execute()) {
        echo "<p style='color: green;'>Tâche ajoutée avec succès.</p>";
    } else {
        echo "<p style='color: red;'>Erreur lors de l'ajout de la tâche.</p>";
    }
}

// Récupérer les utilisateurs pour les afficher dans le menu déroulant
$query_users = "SELECT id, nom FROM utilisateurs";
$stmt_users = $pdo->prepare($query_users);
$stmt_users->execute();
$utilisateurs = $stmt_users->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Tâche</title>
    <link rel="stylesheet" href="style.css"> <!-- Lien vers le fichier CSS -->
</head>
<body>
    <h1>Ajouter une nouvelle tâche</h1>
    <form action="ajouter_tache.php" method="POST">
        <label for="titre">Titre :</label>
        <input type="text" id="titre" name="titre" required>

        <label for="description">Description :</label>
        <textarea id="description" name="description" required></textarea>

        <label for="date_limite">Date limite :</label>
        <input type="date" id="date_limite" name="date_limite" required>

        <label for="utilisateur_id">Assigner à l'utilisateur :</label>
        <select id="utilisateur_id" name="utilisateur_id" required>
            <option value="" disabled selected>-- Sélectionner un utilisateur --</option>
            <?php foreach ($utilisateurs as $utilisateur) : ?>
                <option value="<?= $utilisateur['id'] ?>">
                    <?= $utilisateur['id'] . " - " . htmlspecialchars($utilisateur['nom']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Ajouter la tâche</button>
    </form>
</body>
</html>
