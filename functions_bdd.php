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
    $bdd=connexionBDD();
    $requeteSQL = "SELECT * FROM categorie";
    $resQuery = $bdd->query($requeteSQL);
    return $resQuery->fetchAll();

}

/// Liste des articles
function BDDarticle(){
    $bdd=connexionBDD();
    $requeteSQL = "SELECT * FROM article";
    $resQuery = $bdd->query($requeteSQL);
    return $resQuery->fetchAll();

}

function BDDDisplayArticle($articleID){
    $bdd=connexionBDD();
    $requeteSQL = "SELECT * FROM article where IDarticle = ?";
    $query = $bdd->prepare( $requeteSQL );
    $query->bindValue( 1, $articleID );
    $query->execute();
    return $query->fetch();

}

/// Liste des users
function BDDuser(){
    $bdd=connexionBDD();
    $requeteSQL = "SELECT * FROM utilisateur";
    $resQuery = $bdd->query($requeteSQL);
    return $resQuery->fetchAll();

}

/// nouvel utilisateur
function NewUser($nom, $prenom, $email, $motdepasse){
    $bdd=connexionBDD();
    $query = $bdd->prepare( "SELECT COUNT(email) FROM utilisateur WHERE email = ? " );
    $query->bindValue( 1, $email );
    $query->execute();
    $result=$query->fetchColumn();
    print_r($result);
    if( $result == 0 ) {
        $requeteSQL = "INSERT INTO utilisateur( NomUser, PrenomUser, email, mdp) VALUES (?,?,?,?)";
        $req = $bdd->prepare($requeteSQL);
        $req->execute(array($nom, $prenom, $email, $motdepasse));
        print_r("insert ok");
    }
    else {
        echo "Email exists yet !";
    }    


}

function UserInfo( $email)
{
    $bdd = connexionBDD();
    $query = $bdd->prepare("SELECT * FROM utilisateur WHERE email = ? LIMIT 1");
    $query->bindValue(1, $email);
    $query->execute();
    return $query->fetch();
}

?>