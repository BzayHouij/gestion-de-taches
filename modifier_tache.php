<?php
session_start();
require_once('config.php');

// Vérifier si l'utilisateur est connecté et si c'est un administrateur
if (!isset($_SESSION['utilisateur']) || $_SESSION['utilisateur']['role'] != 'admin') {
    header("Location: connexion.php");
    exit();
}

// Vérifier si une tâche est sélectionnée
if (!isset($_GET['id'])) {
    echo "Aucune tâche sélectionnée.";
    exit();
}

$id_tache = $_GET['id'];

// Récupérer les informations de la tâche
$query = "SELECT * FROM taches WHERE id = :id";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':id', $id_tache);
$stmt->execute();
$tache = $stmt->fetch();

if (!$tache) {
    echo "Tâche non trouvée.";
    exit();
}

// Modifier la tâche
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $date_limite = $_POST['date_limite'];

    // Requête pour mettre à jour la tâche
    $query = "UPDATE taches SET titre = :titre, description = :description, date_limite = :date_limite WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':titre', $titre);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':date_limite', $date_limite);
    $stmt->bindParam(':id', $id_tache);
    $stmt->execute();

    echo "Tâche mise à jour avec succès!";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier la tâche</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Modifier la tâche</h1>
        <form method="POST" action="modifier_tache.php?id=<?php echo $id_tache; ?>">
            <label for="titre">Titre</label>
            <input type="text" name="titre" id="titre" value="<?php echo $tache['titre']; ?>" required>

            <label for="description">Description</label>
            <textarea name="description" id="description" required><?php echo $tache['description']; ?></textarea>

            <label for="date_limite">Date limite</label>
            <input type="date" name="date_limite" id="date_limite" value="<?php echo $tache['date_limite']; ?>" required>

            <button type="submit">Modifier la tâche</button>
        </form>
        <a href="admin_dashboard.php">Retour au tableau de bord</a>
    </div>
</body>
</html>
