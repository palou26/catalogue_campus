
<?php


////////////////////////////////////////
// Fonctions à appeler pour le catalogue
////////////////////////////////////////

///
function afficheArticle($id, $idArticle, $NomArticle, $prix) {


    $article = array();
    $article['id']=$idArticle[$id -1];
    $article['nom']=$NomArticle[$id -1];
    $article['prix']=$prix[$id -1];

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