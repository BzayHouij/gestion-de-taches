<?php
session_start();
if (!isset($_SESSION['utilisateur_id']) || $_SESSION['role'] !== 'utilisateur') {
    header("Location: connexion.html");
    exit;
}

$conn = new mysqli("localhost", "root", "", "gestion_taches");

if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $tache_id = $_GET['id'];
    $stmt = $conn->prepare("UPDATE taches SET statut = 'fait' WHERE id = ?");
    $stmt->bind_param("i", $tache_id);
    $stmt->execute();
    header("Location: utilisateur.php");
    exit;
}
$conn->close();
?>
