<?php
include 'functions.php';
include 'bdd.php';
session_start();


//on récuppère les articles choisis
if (isset($_POST['ChoosenArcticle']) && is_array($_POST['ChoosenArcticle'])) {

    $_SESSION['ChoosenArcticle'] = $_POST['ChoosenArcticle'];
    $ChoosenArcticle = $_POST['ChoosenArcticle'];

} elseif (isset($_SESSION['ChoosenArcticle'])) {
    $ChoosenArcticle = $_SESSION['ChoosenArcticle'];
    if (isset($_GET['idsuppr'])) {
        $idsuppr = $_GET['idsuppr'];
        //print_r($ChoosenArcticle);
        //print_r(array_keys(array_diff($ChoosenArcticle,array_diff($ChoosenArcticle, array($idsuppr)))));
        $keyASuppr = array_keys(array_diff($ChoosenArcticle,array_diff($ChoosenArcticle, array($idsuppr))));
        $ChoosenArcticle = array_values(array_diff($ChoosenArcticle, [$idsuppr]));
        $_SESSION['ChoosenArcticle'] = $ChoosenArcticle;

    }


}

//Quantité

if (!isset($_GET['idsuppr'])   ) {
    $QtePerArticle = array();
    $errorQte = array();
    foreach ($ChoosenArcticle as $ChoosenArcticleId) {
        if (isset($_POST['Qte' . $ChoosenArcticleId])) {
            if ( preg_match('/^[0-9]+$/', $_POST['Qte' . $ChoosenArcticleId])) {
                array_push($QtePerArticle, $_POST['Qte' . $ChoosenArcticleId]);
                array_push($errorQte , "");
            } else {
                array_push($QtePerArticle, 1);
                array_push($errorQte , "Doit être un entier");
            }
        } else {
            array_push($QtePerArticle, 1);
            array_push($errorQte , "");
        }
    }
    $_SESSION['$QtePerArticle'] = $QtePerArticle;
    $_SESSION['$errorQte'] = $errorQte;
} elseif (isset($_SESSION['$QtePerArticle'])) {
    $QtePerArticle = $_SESSION['$QtePerArticle'];
    $errorQte = $_SESSION['$errorQte'];
    unset($QtePerArticle[$keyASuppr[0]]);
    unset($errorQte[$keyASuppr[0]]);
    $QtePerArticle = array_values($QtePerArticle);
    $errorQte = array_values($errorQte);
    $_SESSION['$QtePerArticle'] = $QtePerArticle;
    $_SESSION['$errorQte'] = $errorQte;

}


?>


<!doctype html>
<html lang="fr">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Boutique de sacs">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
          integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS"
          crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">

    <title>BAGS STORE Mon Panier</title>
</head>

<body>
<header>

    <div class="container-fluid ">
        <h1>BAGS STORE</h1>
    </div>

    <div class="container-fluid ">
        <h2>Mon Panier</h2>
    </div>

</header>

<main>
    <div class="container">
        <form id="recalcul" action="panier.php" method="post">
            <?php
            $CommandSum = 0;
            foreach ($ChoosenArcticle as $key => $ChoosenArcticleid) {

                $DescrChoosenAricle = afficheArticle($ChoosenArcticleid, $idArticle, $NomArticle, $PrixArticle);
                $Qte = $QtePerArticle[$key];
                $CommandSum = $CommandSum + $DescrChoosenAricle['prix'] * $Qte;
                echo '
        <div class="row align-items-center articlelist">

            <div class="col-md-3">
                <img src="photos/sac' . $DescrChoosenAricle['id'] . '.jpg" class="photosac" height="80px"  alt="Photo du Sac ' . $DescrChoosenAricle['id'] . '" title="Photo du Sac ' . $DescrChoosenAricle['id'] . '">
            </div>
           <div class="col-md-5">
               <h2>  ' . $DescrChoosenAricle['nom'] . '</h2>
           </div>

           <div class="col-md-2  align-items-center">
               <p class="prix">' . $DescrChoosenAricle['prix'] . '€</p>               
           </div>


          <div class="col-md-2  align-items-center">
              <div class="row form-group">
                <label class ="col-6" for="Qté">Qté :</label>
                <input type="text" class=" col-6 form-control" name="Qte' . $DescrChoosenAricle['id'] . '"  value="' . $Qte . '">
                <small class="QtéHelp" class="form-text text-muted">'.$errorQte[$key].'</small>
              </div>
               
               <div  class="row">
                    <a class = "croixrouge" href="panier.php?idsuppr=' . $DescrChoosenAricle['id'] . '">&#x2718; Supprimer</a> 
               </div>             
           </div>
           
           
        </div>
    ';
            }

            //Display the sum of the command
            echo '
        <div class="row align-items-center">
            <div class="col-md-10  align-items-center divtotalcommand">
                 <h3> Total de la commande  : </h3>
            </div>
            <div class="col-md-2  align-items-center">
                 <p class="totalcommande"> ' . $CommandSum . ' €</p>
            </div>
        </div>
        ';

            ?>
            <button type="Submit">Calculer et Enregistrer</button>
        </form>
    </div>

    <div>
        <a class="croixrouge" href="catalogue.php">Retour Catalogue</a>

    </div>

</main>
<!-- FOOTER -->
<footer>
    <div class="container-fluid">

    </div>
</footer><!-- FIN FOOTER -->


<!-- JQUERY -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
        integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
        integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
        crossorigin="anonymous"></script>
</body>

</html>
