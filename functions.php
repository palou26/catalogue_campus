<?php


////////////////////////////////////////
// Fonctions à appeler pour le catalogue
////////////////////////////////////////

///
function afficheArticle($idarticle, $NomArticle, $prix,$WeightArticle)
{
    $article = array();
    $article['id'] = $idarticle;
    $article['nom'] = $NomArticle[$idarticle];
    $article['prix'] = $prix[$idarticle];
    $article['weight'] = $WeightArticle[$idarticle];

    return $article;
}


///frais de port
/// de 0 à 500g  -> 5 euros de frais de port
//de 500g à 2kg  -> 10% du montant total de frais de port
//>2kg -> frais de port gratuits.
function Shipping($weight, $totalprice)
{
    if ($weight >= 2000 | $weight == 0) {

        return 0;

    } elseif ($weight >= 500){

        return $totalprice * 0.1;
    } else {

        return 5;
    }

}


function NewSession()
{


    if (!isset($_SESSION)) {
        session_start();
    }

    if (isset($_GET['newsession'])) {
        $_SESSION = array();
        session_destroy();
        session_start();

    }


}


?>