
<?php


////////////////////////////////////////
// Fonctions à appeler pour le catalogue
////////////////////////////////////////

///
function afficheArticle($idarticle,  $NomArticle, $prix) {


    $article = array();
    $article['id']=$idarticle;
    $article['nom']=$NomArticle[$idarticle];
    $article['prix']=$prix[$idarticle];

    return $article;
}

function NewSession(){


    if (!isset($_SESSION))
    {
        session_start();
    }

    if (isset($_GET['newsession'])){
        $_SESSION = array();
        session_destroy();
        session_start();

    }



}


?>