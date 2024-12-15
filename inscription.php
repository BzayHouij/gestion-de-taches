<?php
session_start();
require_once('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];
    $role = 'utilisateur'; // Par défaut, le rôle est "utilisateur"

    // Vérification si l'email existe déjà dans la base de données
    $query = "SELECT * FROM utilisateurs WHERE email = :email";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo "Cet email est déjà utilisé.";
    } else {
        // Hachage du mot de passe
        $mot_de_passe_hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);

        // Insertion dans la base de données
        $query = "INSERT INTO utilisateurs (nom, email, mot_de_passe, role) VALUES (:nom, :email, :mot_de_passe, :role)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':mot_de_passe', $mot_de_passe_hash);
        $stmt->bindParam(':role', $role);
        $stmt->execute();

        echo "Inscription réussie. Vous pouvez maintenant vous connecter.";
    }
}
?>
<link rel="stylesheet" href="style.css">
<form method="POST">
    <label for="nom">Nom:</label>
    <input type="text" id="nom" name="nom" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>

    <label for="mot_de_passe">Mot de passe:</label>
    <input type="password" id="mot_de_passe" name="mot_de_passe" required>

    <button type="submit">S'inscrire</button>
</form>

<p>Déjà inscrit ? <a href="connexion.php">Se connecter ici</a></p>
