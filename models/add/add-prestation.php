<?php
include_once("../../connexion/connexion.php");
if (isset($_POST["Valider"])) {
    $annee = date("Y");
    $paquet = htmlspecialchars($_POST["paquet"]);
    $pourcentage = htmlspecialchars($_POST["pourcentage"]);
    if (is_numeric($paquet) && is_numeric($pourcentage)) {
        $req = $connexion->prepare("INSERT INTO `anneeprestation`(`annee`, `paquet`, `pourcentage`) VALUES (?,?,?)");
        $req->execute(array($annee, $paquet, $pourcentage));
        if ($req) {
            $_SESSION["msg"] = "Enregistrement reussie";
            header("location:../../views/AnneePrestation.php");
        }
    } else {
        $_SESSION["msg"] = "Le paquet et pourcentage doivent etre des entiers";
        header("location:../../views/AnneePrestation.php");
    }
}
