<!DOCTYPE html>
<?php
session_start();
require './dao.php';
$utilisateur = recupererUtilisateur($_SESSION["id"]);
$animaux = getAnimauxFromUser($_SESSION["id"]);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Profil</title>
    </head>
    <body>
        <nav>
            <a href="index.php">Accueil</a>
            <a href='inscription.php'>Inscription</a>
            <a href='connexion.php'>Connexion</a>
            <a href='animal.php'>Inscrire animal</a>
            <a href="profil.php">Profil</a>
        </nav>
        <h1>Profil</h1>
        <h2>Informations personnels</h2>
        <?php var_dump($utilisateur); ?>
        <h2>Mes animaux</h2>
        <?php var_dump($animaux); ?>
    </body>
</html>
