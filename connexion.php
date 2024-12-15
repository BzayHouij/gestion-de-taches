<?php
session_start();
require_once('config.php'); // Inclure la connexion à la base de données

// Vérifier si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    // Préparer la requête pour rechercher l'utilisateur par email
    $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $utilisateur = $stmt->fetch();

    // Si l'utilisateur existe et que le mot de passe est correct
    if ($utilisateur && password_verify($mot_de_passe, $utilisateur['mot_de_passe'])) {
        $_SESSION['utilisateur'] = $utilisateur; // Enregistrer l'utilisateur dans la session

        // Vérifier le rôle de l'utilisateur
        if ($utilisateur['role'] == 'admin') {
            // Rediriger vers la page d'administration
            header("Location: admin_dashboard.php");  // Cette redirection doit être correcte
        } else {
            // Rediriger vers la page de l'utilisateur
            header("Location: utilisateur_dashboard.php");
        }
        exit();
    } else {
        // Afficher un message d'erreur si les identifiants sont incorrects
        $erreur = "Identifiants incorrects.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Connexion</h1>
        <?php
        if (isset($erreur)) {
            echo "<p class='alert'>$erreur</p>";
        }
        ?>
        <form method="POST" action="connexion.php">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>

            <label for="mot_de_passe">Mot de passe</label>
            <input type="password" name="mot_de_passe" id="mot_de_passe" required>

            <button type="submit">Se connecter</button>
        </form>
    </div>
</body>
</html>
