<!DOCTYPE html>
<?php
session_start();
require 'dao.php';
if (isset($_SESSION["id"])) {
    $utilisateur = recupererUtilisateur($_SESSION["id"]);
    $adresse = getAdresse($utilisateur[0]["idAdresse"]);
} else {
    header('Location: index.php');
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <nav>
            <a href='inscription.php'>Inscription</a>
            <a href='connexion.php'>Connexion</a>
            <a href='animal.php'>Inscrire animal</a>
            <a href="profil.php">Profil</a>
        </nav>
        <h1>Disponibilités</h1>
        <label>Nom :</label><label><?= $utilisateur[0]["nom"]; ?></label><br/>
        <label>Adresse:</label><label><?= var_dump($adresse) ?></label><br/>
        <label>Disponibilités:</label><br/>
        <table border="1">
            <tr>
                <td>Lundi</td>
            </tr>
            <tr>
                <td>
                    <input type="checkbox" name="LundiMatin" value="1"> Matin<br>
                    <input type="checkbox" name="LundiAprès-midi" value="2"> Après-midi<br>
                    <input type="checkbox" name="LundiSoir" value="3"> Soir
                </td>
            </tr>
        </table>
        <br/>
        <label>Espèce:</label><br/>
    </body>
</html>
