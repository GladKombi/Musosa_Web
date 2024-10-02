<?php
include_once("../../connexion/connexion.php");
if (isset($_POST["valider"])) {
    $annee = date("Y");
    $paquet = htmlspecialchars($_POST["paquet"]);
    $pourcentage = htmlspecialchars($_POST["pourcentage"]);
    if (is_numeric($paquet) && is_numeric($pourcentage)) {
        $req = $connexion->prepare("INSERT INTO `anneeprestation`(`annee`, `paquet`, `pourcentage`) VALUES (?,?,?)");
        $req->execute(array($annee, $paquet, $pourcentage));
        if ($req) {
            $_SESSION["smg"] = "Enregistrement reussi";
            header("location:../../views/prestation.php");
        }
    } else {
        $_SESSION["smg"] = "Le paquet et pourcentage doivent etre des entiers";
        header("location:../../views/prestation.php");
    }
}
