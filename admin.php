<?php
session_start();
require_once('config.php');

// Vérifier si l'utilisateur est connecté et est un administrateur
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: connexion.php"); // Redirection si l'utilisateur n'est pas administrateur
    exit();
}

// Afficher les tâches pour l'administrateur
$query = "SELECT * FROM taches";
$stmt = $pdo->prepare($query);
$stmt->execute();
$taches = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="admin-container">
        <h1>Bienvenue, Admin</h1>
        <a href="ajouter_tache.php" class="btn">Ajouter une tâche</a>

        <h2>Liste des tâches</h2>
        <table>
            <tr>
                <th>Titre</th>
                <th>Description</th>
                <th>Date limite</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($taches as $tache): ?>
                <tr>
                    <td><?= $tache['titre'] ?></td>
                    <td><?= $tache['description'] ?></td>
                    <td><?= $tache['date_limite'] ?></td>
                    <td><?= $tache['statut'] ?></td>
                    <td>
                        <a href="modifier_tache.php?id=<?= $tache['id'] ?>" class="btn">Modifier</a>
                        <a href="supprimer_tache.php?id=<?= $tache['id'] ?>" class="btn btn-danger">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>
