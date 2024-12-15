<?php
// Connexion à la base de données
require_once('config.php');  // Ce fichier doit contenir la configuration de la connexion PDO

// Données de l'admin à ajouter
$nom = "Admin";
$email = "newadmin@example.com";  // Nouveau email unique
$mot_de_passe = "motdepasseadmin"; // Ton mot de passe brut pour l'admin
$role = "admin"; // Rôle de l'utilisateur

// Hachage du mot de passe
$mot_de_passe_hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);

// Requête d'insertion dans la base de données
$query = "INSERT INTO utilisateurs (nom, email, mot_de_passe, role) VALUES (:nom, :email, :mot_de_passe, :role)";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':nom', $nom);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':mot_de_passe', $mot_de_passe_hash);
$stmt->bindParam(':role', $role);
$stmt->execute();

echo "Utilisateur admin ajouté avec succès.";
?>
