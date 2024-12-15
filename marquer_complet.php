<?php
session_start();
require_once('config.php');

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['utilisateur'])) {
    header("Location: connexion.php");
    exit();
}

// Vérifier si l'ID de la tâche est passé en paramètre
if (isset($_GET['id'])) {
    $id_tache = $_GET['id'];

    // Mettre à jour le statut de la tâche à "complété"
    $query = "UPDATE taches SET statut = 'complété' WHERE id = :id AND utilisateur_id = :utilisateur_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $id_tache);
    $stmt->bindParam(':utilisateur_id', $_SESSION['utilisateur']['id']);
    $stmt->execute();

    echo "Tâche marquée comme terminée!";
    header("Location: utilisateur_dashboard.php");
    exit();
} else {
    echo "Aucune tâche spécifiée.";
}
?>
