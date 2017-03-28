<!DOCTYPE html>
<?php
require './dao.php';
if(isset($_REQUEST["btnsave"])){
    if($_REQUEST["pwd"]==$_REQUEST["pwd2"]){
        inscriptionUtilisateur($_REQUEST["nom"], $_REQUEST["prenom"], $_REQUEST["mdp"], $_REQUEST["date"], 
                $_REQUEST["desc"], $_REQUEST["pays"], $_REQUEST["rue"], $_REQUEST["numero"], $_REQUEST["codepostal"]);
    }
    else{
        echo"Les deux mots de passe ne correspondent pas";
    }
}
?>    
<html>
    <head>
        <meta charset="UTF-8">
        <title>Inscription</title>
    </head>
    <body>
        <form action="inscription.php" method="POST">
            <label>Nom :</label><input type="text" name="nom" required="" value="<?php if (isset($_REQUEST['nom'])) echo $_REQUEST['nom']; ?>"><br/>
            <label>Prénom :</label><input type="text" name="prenom" required="" value="<?php if (isset($_REQUEST['prenom'])) echo $_REQUEST['prenom']; ?>"><br/>
            <label>Mot de passe :</label><input type="password" name="pwd" required=""><br/>
            <label>Confimer le mot de passe :</label><input type="password" name="pwd2" required=""><br/>
            <label>Date de naissance :</label><input type="date" name="date" required="" value="<?php isset($_REQUEST["date"])?$_REQUEST["date"]:""; ?>"><br/>
            <label>Decrivez-vous :</label><input type="text" name="desc" value="<?php isset($_REQUEST["desc"])?$_REQUEST["desc"]:""; ?>"><br/>
                
            <label>Pays</label><input type="text" name="pays" required="" value="<?php isset($_REQUEST["pays"])?$_REQUEST["pays"]:""; ?>"><br/>
            <label>Rue</label><input type="text" name="rue" required="" value="<?php isset($_REQUEST["rue"])?$_REQUEST["rue"]:""; ?>"><br/>
            <label>Numéro de rue</label><input type="text" name="numero" required="" value="<?php isset($_REQUEST["numero"])?$_REQUEST["numero"]:""; ?>"><br/>
            <label>Code postal</label><input type="text" name="codepostal" required="" value="<?php isset($_REQUEST["codepostal"])?$_REQUEST["codepostal"]:""; ?>"><br/>
            <input type="submit" value="S'enregistrer" name="btnsave" >
        </form>
    </body>
</html>
