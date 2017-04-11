<!DOCTYPE html>
<?php
session_start();
require './dao.php';
if (isset($_REQUEST["btnsave"])) {
    $utilisateur = connexion(sha1($_REQUEST["pwd"]), $_REQUEST["nom"]);
    if (count($utilisateur) > 0) {
        $_SESSION["id"] = $utilisateur[0]["idUtilisateur"];
        header('Location: index.php');
    }
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Connexion</title>

    </head>
    <body>
        <nav>
            <a href='inscription.php'>Inscription</a>
            <a href='connexion.php'>Connexion</a>
            <a href='animal.php'>Inscrire animal</a>
            <a href="profil.php">Profil</a>
        </nav>
        <form action="connexion.php" method="POST">
            <label>Nom :</label><input type="text" name="nom" required=""><br/>
            <label>Mot de passe :</label><input type="password" name="pwd" required=""><br/>
            <input type="submit" value="S'enregistrer" name="btnsave" >
        </form>
    </body>
</html>
