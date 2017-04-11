<?php

/* stocker l'id de l'utilisateur dans le $_SESSION
 * 
 */
DEFINE('DB_USER', 'root');
DEFINE('DB_PASSWORD', '');
DEFINE('DB_HOST', '127.0.0.1');
DEFINE('DB_NAME', 'pasbuddy');

function maConnexion() {
    static $dbc = null;
    if ($dbc == null) {
        try {
            $dbc = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", PDO::ATTR_PERSISTENT => true));
            $dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            echo'Erreur : ' . $e->getMessage() . '<br/>';
            echo'n° ' . $e->getCode();
            die('could not connect to MySQL');
        }
    }
    return $dbc;
}

function recupererUtilisateur($idUtilisateur) {
    try {
        $pssUtilisateur = maConnexion()->prepare("SELECT * FROM utilisateur WHERE idUtilisateur = :id");
        $pssUtilisateur->bindParam(':id', $idUtilisateur, PDO::PARAM_INT);
        $pssUtilisateur->execute();
        return $pssUtilisateur->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die('Error during the execution of the SQL statement');
    }
}

function getAnimauxFromUser($idUtilisateur) {
    try {
        $pssAnimal = maConnexion()->prepare("SELECT * FROM animal WHERE idUtilisateur = :id");
        $pssAnimal->bindParam(':id', $idUtilisateur, PDO::PARAM_INT);
        $pssAnimal->execute();
        return $pssAnimal->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die('Error during the execution of the SQL statement');
    }
}

function recupererAnimal($idAnimal) {
    
}

function insererAdresse($pays, $rue, $numero, $npa) {
    try {
        $psiAdresse = maConnexion()->prepare("INSERT INTO adresse(numero,nomRue,CodePostal,pays) "
                . "VALUES (:numero,:rue,:npa,:pays);");
        $psiAdresse->bindParam(':numero', $numero, PDO::PARAM_STR);
        $psiAdresse->bindParam(':rue', $rue, PDO::PARAM_STR);
        $psiAdresse->bindParam(':npa', $npa, PDO::PARAM_STR);
        $psiAdresse->bindParam(':pays', $pays, PDO::PARAM_STR);
        $psiAdresse->execute();
        return maConnexion()->lastInsertId();
    } catch (PDOException $e) {
        die('Error during the execution of the SQL statement');
    }
}

function inscriptionUtilisateur($nom, $prenom, $mdp, $naissance, $description, $pays, $rue, $numero, $npa) {
    $LastId = insererAdresse($pays, $rue, $numero, $npa);
    try {
        $psiUtilisateur = maConnexion()->prepare("INSERT INTO utilisateur(nom,prenom,mdp,dateNaissance,description,idAdresse) "
                . "VALUES (:nom,:prenom,:mdp,:naissance,:description,:adresse);");
        $psiUtilisateur->bindParam(':nom', $nom, PDO::PARAM_STR);
        $psiUtilisateur->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $psiUtilisateur->bindParam(':mdp', $mdp, PDO::PARAM_STR);
        $psiUtilisateur->bindParam(':naissance', $naissance, PDO::PARAM_STR);
        $psiUtilisateur->bindParam(':description', $description, PDO::PARAM_STR);
        $psiUtilisateur->bindParam(':adresse', $LastId, PDO::PARAM_STR);
        $psiUtilisateur->execute();
        return maConnexion()->lastInsertId();
    } catch (PDOException $e) {
        die('Error during the execution of the SQL statement');
    }
}

function inscriptionAnimal($espece, $nom, $naissance, $remarques, $idUtilisateur) {
    try {
        $psiAnimal = maConnexion()->prepare("INSERT INTO animal(espece,nomAnimal,dateNaissanceAnimal,remarques,idUtilisateur) "
                . "VALUES (:espece,:nom,:naissance,:remarques,:id);");
        $psiAnimal->bindParam(':nom', $nom, PDO::PARAM_STR);
        $psiAnimal->bindParam(':naissance', $naissance, PDO::PARAM_STR);
        $psiAnimal->bindParam(':espece', $espece, PDO::PARAM_STR);
        $psiAnimal->bindParam(':remarques', $remarques, PDO::PARAM_STR);
        $psiAnimal->bindParam(':id', $idUtilisateur, PDO::PARAM_STR);
        $psiAnimal->execute();
        return maConnexion()->lastInsertId();
    } catch (PDOException $e) {
        die('Error during the execution of the SQL statement');
    }
}

function rechercherGardien() {
    
}

function ajouterDisponibilites() {
    
}

function connexion($mdp, $nom) {
    $pssConnexion = maConnexion()->prepare("SELECT idUtilisateur,nom,mdp FROM utilisateur WHERE nom = :nom AND mdp = :mdp");
    $pssConnexion->bindParam(":nom", $nom, PDO::PARAM_STR);
    $pssConnexion->bindparam(":mdp", $mdp, PDO::PARAM_STR);
    $pssConnexion->execute();

    return $pssConnexion->fetchAll(PDO::FETCH_ASSOC);
}

function modifierAdresse($rue, $numero, $npa, $pays, $idUtlisateur) {
    $psuAdresse = maConnexion()->prepare("UPDATE adresse "
            . "SET numero=:numero, nomRue=:rue, CodePostal=:npa, Pays=:pays "
            . "WHERE idAdresse = "
            . "(SELECT idAdresse "
            . "FROM utilisateur "
            . "WHERE idUtilisateur = :id)");
    $psuAdresse->bindParam(":numero", $numero, PDO::PARAM_STR);
    $psuAdresse->bindParam(":rue", $rue, PDO::PARAM_STR);
    $psuAdresse->bindParam(":npa", $npa, PDO::PARAM_STR);
    $psuAdresse->bindParam(":pays", $pays, PDO::PARAM_STR);
    $psuAdresse->bindParam(':id', $idUtlisateur, PDO::PARAM_STR);
    $psuAdresse->execute();
}

function modifierUtilisateur($nom, $prenom, $mdp, $naissance, $description, $idUtlisateur) {
    $psuUtilisateur = maConnexion()->prepare("UPDATE utilisateur "
            . "SET nom=:nom, prenom=:prenom, mdp=:mdp, dateNaissance=:naissance, description=:description "
            . "WHERE idUser = :id");
    $psuUtilisateur->bindParam(':nom', $nom, PDO::PARAM_STR);
    $psuUtilisateur->bindParam(':prenom', $prenom, PDO::PARAM_STR);
    $psuUtilisateur->bindParam(':mdp', $mdp, PDO::PARAM_STR);
    $psuUtilisateur->bindParam(':naissance', $naissance, PDO::PARAM_STR);
    $psuUtilisateur->bindParam(':description', $description, PDO::PARAM_STR);
    $psuUtilisateur->bindParam(':id', $idUtlisateur, PDO::PARAM_STR);
    $psuUtilisateur->execute();
}
