
<?php


////////////////////////////////////////
// Fonctions à appeler pour le catalogue
////////////////////////////////////////

///
function afficheArticle($id,  $NomArticle, $prix) {


    $article = array();
    $article['id']=$id;
    $article['nom']=$NomArticle[$id];
    $article['prix']=$prix[$id];

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