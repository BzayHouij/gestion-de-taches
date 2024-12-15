<?php
session_start();
require_once('config.php');

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['utilisateur'])) {
    header("Location: connexion.php");
    exit();
}

$id_utilisateur = $_SESSION['utilisateur']['id'];  // Récupérer l'ID de l'utilisateur connecté

// Récupérer les tâches pour cet utilisateur
$query = "SELECT * FROM taches WHERE utilisateur_id = :utilisateur_id";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':utilisateur_id', $id_utilisateur);
$stmt->execute();
$taches = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord Utilisateur</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Tableau de bord Utilisateur</h1>
        <h2>Tâches assignées</h2>
        
        <?php if (empty($taches)): ?>
            <p>Aucune tâche assignée pour le moment.</p>
        <?php else: ?>
            <table>
                <tr>
                    <th>Titre</th>
                    <th>Description</th>
                    <th>Date Limite</th>
                    <th>Statut</th>
                </tr>
                <?php foreach ($taches as $tache): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($tache['titre']); ?></td>
                        <td><?php echo htmlspecialchars($tache['description']); ?></td>
                        <td><?php echo htmlspecialchars($tache['date_limite']); ?></td>
                        <td><?php echo htmlspecialchars($tache['statut']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
        <a href="deconnexion.php">Se déconnecter</a>
    </div>
</body>
</html>
