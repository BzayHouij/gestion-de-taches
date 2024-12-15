<?php
session_start();
require_once('config.php');

// Vérifier si l'utilisateur est connecté et a le rôle admin
if ($_SESSION['role'] != 'admin') {
    echo "Accès interdit. Vous devez être administrateur.";
    exit;
}

// Récupérer toutes les tâches
$query = "SELECT * FROM taches";
$stmt = $pdo->query($query);
$taches = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Tâches</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Gestion des Tâches</h1>
    <a href="ajouter_tache.php">Ajouter une tâche</a>

    <h2>Tâches à faire</h2>
    <table>
        <thead>
            <tr>
                <th>Titre</th>
                <th>Description</th>
                <th>Date Limite</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($taches as $tache): ?>
                <tr>
                    <td><?php echo htmlspecialchars($tache['titre']); ?></td>
                    <td><?php echo htmlspecialchars($tache['description']); ?></td>
                    <td><?php echo htmlspecialchars($tache['date_limite']); ?></td>
                    <td>
                        <a href="modifier_tache.php?id=<?php echo $tache['id']; ?>">Modifier</a>
                        <a href="supprimer_tache.php?id=<?php echo $tache['id']; ?>">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
