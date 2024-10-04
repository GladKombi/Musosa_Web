<?php
include_once ("../../connexion/connexion.php");
if (isset($_POST["Valider"])) {
    $designation = htmlspecialchars($_POST["designation"]);
    $statut=0;
    $verification = $connexion->prepare("SELECT * FROM coorporation WHERE desingation=? AND supprimer=?");
    $verification->execute([$designation,0]);
    $tab = $verification->fetch();
    if ($tab > 0) {
        $_SESSION["msg"] = 'Cette coorporation existe déjà dans la base de données';
        header("location:../../views/coorporation.php");
    } else {
    $req = $connexion->prepare("INSERT INTO `coorporation`(desingation,supprimer) VALUES (?,?)");
    $req->execute(array($designation,$statut));
    if ($req) {
        $_SESSION["msg"] = "Enregistrement reussi !";
        header("location:../../views/coorporation.php");
    } else {
        $_SESSION["msg"] = "Echec d'enregistrement !";
        header("location:../../views/coorporation.php");
    }
}
}