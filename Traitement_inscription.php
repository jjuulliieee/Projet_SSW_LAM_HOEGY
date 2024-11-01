<?php

session_start();

if (!isset($_POST['token']) || $_POST['token'] != $_SESSION['csrf_connexion_add']){
    die('<p>CSRF invalide</p>');
}

// Supprime le token en session pour qu'il soit regénéré
unset($_SESSION['csrf_connexion_add']);


if (isset($_POST["pseudo"]) && !empty($_POST["pseudo"])){
    $pseudo = htmlspecialchars($_POST["pseudo"]);
}
else {
    echo "<p>Le pseudo est obligatoire</p>";
}

if (isset($_POST["mail"]) && !empty($_POST["mail"])){
    $mail = htmlspecialchars($_POST["mail"]);
}
else {
    echo "<p>Le mail est obligatoire</p>";
}

if (isset($_POST["mdp"]) && !empty($_POST["mdp"])) {
    $mdp = htmlspecialchars($_POST["mdp"]); // Mot de passe en clair
    $hashedPassword = password_hash($mdp, PASSWORD_BCRYPT);
}
else {
    echo "<p>Le mot de passe est obligatoire</p>";
}

if (isset($pseudo) && isset($mail) && isset($mdp)){

    // Pas d'erreur => on sauvegarde la plante
    require_once 'bdd.php';

    // Vérifier le slug (pas de caractères spéciaux ni d'espaces)
    $sauvegarde = $connexion->prepare("INSERT INTO connexion (pseudo, mail, mdp)
                                       VALUES (:pseudo, :mail, :mdp)");

    $sauvegarde->execute(params: ["pseudo" => $pseudo, "mail" => $mail, "mdp" => $mdp]);

    if ($sauvegarde->rowCount() > 0) {
        echo "<p>Sauvegarde effectuée</p>";
        echo "<a href='HTML_Connexion.php'>Accéder à la page de connexion</a>";
    }
    else {
        echo "<p>Une erreur est survenue</p>";
    }
}

?>