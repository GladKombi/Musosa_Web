<?php
include_once ("../../connexion/connexion.php");
if (isset($_POST["valider"])) {
    $desingation = htmlspecialchars($_POST["desingation"]);
    $statut=0;
    $verification = $connexion->prepare("SELECT * FROM coorporation WHERE desingation=? AND supprimer=?");
    $verification->execute([$desingation,0]);
    $tab = $verification->fetch();
    if ($tab > 0) {
        $_SESSION["smg"] = 'Cette coorporation existe déjà dans la base de données';
        header("location:../../views/coorporation.php");
    } else {
    $req = $connexion->prepare("INSERT INTO `coorporation`(`desingation,supprimer`) VALUES (?,?)");
    $req->execute(array($desingation,$statut));
    if ($req) {
        $_SESSION["smg"] = "Enregistrement reussi";
        header("location:../../views/coorporation.php");
    } else {
        $_SESSION["smg"] = "Echec d'enregistrement";
        header("location:../../views/coorporation.php");
    }
}
}