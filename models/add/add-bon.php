<?php
include_once("../../connexion/connexion.php");
if (isset($_POST["valider"])) {
    $supprimer=0;
    $date=date('Y-m-d');
    $beneficiaire=$_GET['ben'];
    $user= $_SESSION['id'];
    $fosa = htmlspecialchars($_POST["fosa"]);

    echo $beneficiaire.$fosa;
    $req = $connexion->prepare("INSERT INTO bonsoin(dates,matricule,fosa,utilisateur,supprimer) VALUES (?,?,?,?,?)");
    $req->execute(array($date,$beneficiaire,$fosa,$user,$supprimer));
    if ($req) {
        $_SESSION["msg"] = "Enregistrement reussi";
        header("location:../../views/bon.php");
    } else {
        $_SESSION["msg"] = "Echec d'enregistrement";
        header("location:../../views/bon.php");
    }
}
