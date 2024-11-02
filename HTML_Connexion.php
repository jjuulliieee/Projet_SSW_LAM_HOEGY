<?php

session_start();

if (!isset($_SESSION['csrf_connexion_add']) || empty($_SESSION['csrf_connexion_add'])){
    $_SESSION['csrf_connexion_add'] = bin2hex(random_bytes(32));
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Connexion</title>
</head>
<body>
    <form action = "Traitement_connexion.php" method = "POST" class="connexion">
        <h2 class="htmltext">CONNEXION</h2>
        <label for="pseudo" class="htmltext">Pseudo</label>
        <input type="text" name="pseudo" id="pseudo" placeholder="Pseudo">
        <br>
        <label for="mail" class="htmltext">Adresse mail</label>
        <input type="text" name="mail" id="mail" placeholder="Adresse mail">
        <br>
        <label for="mdp" class="htmltext">Mot de passe</label>
        <input type="password" name="mdp" id="mdp" placeholder="Mot de passe">
        <br>
        <input type="hidden" name="token" value="<?= $_SESSION['csrf_connexion_add']; ?>">
        <input type="submit" name="connexion" value="Se connecter">
        <br>
        <p class="annonce">Pas de compte ? <a href="HTML_Inscription.php">Inscrivez-vous-ici !</p>
    </form>
</body>
