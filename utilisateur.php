<?php
session_start();

// Connexion à la base de données
$host = "localhost";
$username = "root";
$password = "";
$database = "gestion_taches";

// Crée une connexion MySQL
$conn = new mysqli($host, $username, $password, $database);

// Vérifie la connexion
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    // Redirige vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: connexion.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Récupère les tâches de l'utilisateur
$sql = "SELECT * FROM taches WHERE utilisateur_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$taches = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace utilisateur</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Bienvenue, <?php echo htmlspecialchars($_SESSION['nom']); ?></h1>
    </header>
    <main>
        <section>
            <h2>Voici vos tâches :</h2>
            <table>
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Description</th>
                        <th>Date limite</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($taches->num_rows > 0): ?>
                        <?php while ($tache = $taches->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($tache['titre']); ?></td>
                                <td><?php echo htmlspecialchars($tache['description']); ?></td>
                                <td><?php echo htmlspecialchars($tache['date_limite']); ?></td>
                                <td>
                                    <?php 
                                    echo $tache['statut'] == 1 ? "Terminée" : "À faire"; 
                                    ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4">Aucune tâche disponible.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </section>
        <section>
            <a href="deconnexion.php">Se déconnecter</a>
        </section>
    </main>
</body>
</html>
