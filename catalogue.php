<?php
include 'functions.php';
include 'functions_bdd.php';
include 'bdd.php';

NewSession();

if (!isset($_SESSION['date'])) {
    $_SESSION['date'] = getdate();
}

if (!isset($_SESSION['ChoosenArcticle'])) {
    $_SESSION['ChoosenArcticle'] = array();
}
if (!isset($_SESSION['$QtePerArticle'])) {
    $_SESSION['$QtePerArticle'] = array();
}
if (!isset($_SESSION['$errorQte'])) {
    $_SESSION['$errorQte'] = array();
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

    <title>BAGS STORE Catalogue</title>
</head>

<body>
<header>

    <div class="container-fluid ">
        <h1>BAGS STORE</h1>
    </div>

    <div class="container-fluid ">
        <h2>Catalogue</h2>
    </div>

    <?php include("navigation.php"); ?>
</header>

<main>
    <div class="container">
        <form action="panier.php" method="post">
            <?php
            foreach ($idArticle as $i) :
                ?>
                <div class="row align-items-center articlelist">

                    <div class="col-md-3">
                        <img src="photos/sac<?= $i ?>.jpg" class="photosac" height="80px" alt="Photo du Sac <?= $i ?> "
                             title="Photo du Sac <?= $i ?> ">
                    </div>
                    <div class="col-md-6">
                        <h2>  <?= $NomArticle[$i] ?> </h2>
                    </div>

                    <div class="col-md-2  ">
                        <p class="prix"><?= $PrixArticle[$i] ?> €</p>
                    </div>

                    <div class="col-md-1  form-check ">
                        <input class="form-check-input big-checkbox" name="ChoosenArcticle[]" type="checkbox"
                               value="<?= $i ?>" id="article<?= $i ?>">
                    </div>

                </div>

            <?php endforeach; ?>


            <button type="submit" class="BtnEnvPanier">Envoyer au Panier</button>
        </form>
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