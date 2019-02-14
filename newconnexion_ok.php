<?php
session_start();

require('functions_bdd.php');

if(isset($_POST['Nom']) && isset($_POST['Prenom']) && isset($_POST['email']) && isset($_POST['pwd']) ){

$Nom = $_POST['Nom'];
$Prenom = $_POST['Prenom'] ;
$email = $_POST['email'] ;
$mdp = $_POST['pwd'] ;


$conok=FALSE;
$users = BDDuser();
foreach ($users as $user){


  if ( $user['email'] == $email &&  $user['mdp'] == $mdp )  {
      $conok=TRUE;
      $_SESSION['email'] = $_POST['email'];
      $_SESSION['IDUser'] = $user['IDUser'];
      $_SESSION['NomUser'] = $user['NomUser'];
      $_SESSION['PrenomUser'] = $user['PrenomUser'];

  }
}

if ($conok) {
    print_r("email est OK");
    header( 'Location: catalogue.php');
    exit();
} else {
    print_r("email non reconnu");
    NewUser($Nom, $Prenom, $email, $mdp);
    $userinfo = UserInfo( $email);

    $_SESSION['email'] = $email;
    $_SESSION['IDUser'] = $userinfo['IDUser'];
    $_SESSION['NomUser'] = $Nom;
    $_SESSION['PrenomUser'] = $Prenom;
    $_SESSION['connexion'] = "oui";
    print_r($_SESSION);
   header( 'Location: catalogue.php');
    exit();
}

} else {

    print_r("pas d'email");

}


?>
