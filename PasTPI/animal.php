<!DOCTYPE html>
<?php
session_start();
require './dao.php';
if (isset($_REQUEST["btnsave"])) {
    $animal = inscriptionAnimal($_REQUEST["espece"], $_REQUEST["nom"], $_REQUEST["date"], $_REQUEST["remarques"], $_SESSION["id"]);
    if (count($animal) > 0) {
        header('Location:index.php');
    } else {
        echo "problème pendant l'insertion";
    }
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Animal</title>
    </head>
    <body>
        <nav>
            <a href='inscription.php'>Inscription</a>
            <a href='connexion.php'>Connexion</a>
            <a href='animal.php'>Inscrire animal</a>
            <a href="profil.php">Profil</a>
        </nav>
        <form action="animal.php" method="POST">
            <label>Espèce :</label><input type="text" name="espece" required=""><br/>
            <label>Date de naissance :</label><input type="date" name="date" required=""><br/>
            <label>Nom :</label><input type="text" name="nom" required=""><br/>
            <label>Remaques :</label><input type="text" name="remarques" required=""><br/>
            <input type="submit" value="S'enregistrer" name="btnsave" >
        </form>
    </body>
</html>
