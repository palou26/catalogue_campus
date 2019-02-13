<?php


////////////////////////////////////////
// Fonctions BDD
////////////////////////////////////////

/// connexion à la BDD
function connexionBDD()
{
    try {
        //connexion à la BDD avec un meilleur retour des erreurs
        $bdd = new PDO('mysql:host=localhost;dbname=boutiq;charset=utf8', 'pascaladmin', 'adminadmin',
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        // Sous MAMP (Mac)
        //$bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', 'root');
        return $bdd;
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

/// Liste des catégories
function BDDcategorie(){

    $requeteSQL = "SELECT * FROM categorie";
    $resQuery = $bdd->query($requeteSQL);
    return $resQuery->fetchAll();

}

/// Liste des catégories
function BDDarticle(){

    $requeteSQL = "SELECT * FROM categorie";
    $resQuery = $bdd->query($requeteSQL);
    return $resQuery->fetchAll();

}

/// Liste des catégories
function NewUser($nom, $prenom, $mail, $motdepasse){

    $query = $bdd->prepare( "SELECT COUNT(email) FROMt utilisateur WHERE email = ?" );
    $query->bindValue( 1, $email );
    $query->execute();
    print_r($query);
    if( $query == 0 ) {
        $requeteSQL = "INSERT INTO utilisateur(IDUser, NomUser, PrenomUser, email, mdp) VALUES (?,?,?,?)");
        $req = $bdd->prepare($requeteSQL);
        $req->execute(array($nom, $prenom, $mail, $motdepasse));
    }
    else {
        echo "Email exists yet !";
    }    


}


?>