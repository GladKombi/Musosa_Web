<?php
include_once("../../connexion/connexion.php");
if (isset($_POST["Valider"])) {
    $supprimer=0;
    $date= date("Y-m-d");
    $fosa = htmlspecialchars($_POST["fosa"]);
    $matricule = htmlspecialchars($_POST["matricule"]);
    // if (isset($_SESSION['User']) && !empty($_SESSION['User'])){
    //     $utilisateur=$_SESSION['User'];
    // }
    
    $utilisateur=1;
    $req = $connexion->prepare("INSERT INTO `bonsoin`(`date`,`maticule`, `fosa`, `utilisateur`, `supprimer`) VALUES (?,?,?,?,?)");
    $req->execute(array($date, $matricule,$fosa,$utilisateur, $supprimer));
    if ($req) {
        $_SESSION["msg"] = "Enregistrement reussi";
        header("location:../../views/Bonsoin.php");
    } else {
        $_SESSION["msg"] = "Echec d'enregistrement";
        header("location:../../views/Bonsoin.php");
    }
}
