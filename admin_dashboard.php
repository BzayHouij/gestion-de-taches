<?php
session_start();
require_once('config.php');

// Vérifier si l'utilisateur est connecté et si c'est un administrateur
if (!isset($_SESSION['utilisateur']) || $_SESSION['utilisateur']['role'] != 'admin') {
    header("Location: connexion.php");
    exit();
}

// Récupérer toutes les tâches
$query = "SELECT * FROM taches";
$stmt = $pdo->prepare($query);
$stmt->execute();
$taches = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord Admin</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Tableau de bord Admin</h1>
        <a href="ajouter_tache.php">Ajouter une tâche</a>
        <h2>Tâches à gérer</h2>
        <table>
            <tr>
                <th>Titre</th>
                <th>Description</th>
                <th>Date Limite</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($taches as $tache) : ?>
                <tr>
                    <td><?php echo $tache['titre']; ?></td>
                    <td><?php echo $tache['description']; ?></td>
                    <td><?php echo $tache['date_limite']; ?></td>
                    <td>
                        <a href="modifier_tache.php?id=<?php echo $tache['id']; ?>">Modifier</a> |
                        <a href="supprimer_tache.php?id=<?php echo $tache['id']; ?>">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <a href="deconnexion.php">Se déconnecter</a>
    </div>
</body>
</html>
