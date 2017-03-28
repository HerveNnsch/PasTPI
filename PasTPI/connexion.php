<!DOCTYPE html>
<?php
/* stocker l'id de l'utilisateur dans le $_SESSION
 * 
 * 
 * 
 *
 */
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form action="inscription.php" method="POST">
            <label>Nom :</label><input type="text" name="nom" required=""><br/>
            <label>Mot de passe :</label><input type="password" name="pwd" required=""><br/>
            <input type="submit" value="S'enregistrer" name="btnsave" >
        </form>
    </body>
</html>
