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

// Requête pour supprimer la tâche
$query = "DELETE FROM taches WHERE id = :id";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':id', $id_tache);
$stmt->execute();

echo "Tâche supprimée avec succès!";
?>

<a href="admin_dashboard.php">Retour au tableau de bord</a>
