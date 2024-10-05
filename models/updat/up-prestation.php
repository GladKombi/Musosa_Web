<?php
include_once("../../connexion/connexion.php");
if (isset($_POST["Valider"])) {
    $id = $_GET["idperio"];
    $paquet = htmlspecialchars($_POST["paquet"]);
    $pourcentage = htmlspecialchars($_POST["pourcentage"]);
    if (is_numeric($paquet) && is_numeric($pourcentage)) {
        $req = $connexion->prepare("UPDATE `anneeprestation` SET `paquet`=?,`pourcentage`=? WHERE id=?");
        $req->execute(array($paquet, $pourcentage, $id));
        if ($req) {
            $_SESSION["msg"] = "Modification reussi !";
            header("location:../../views/AnneePrestation.php");
        } else {
            $_SESSION["msg"] = "Echec de modification !";
            header("location:../../views/AnneePrestation.php");
        }
    } else {
        $smg = "Le paquet et pourcentage doivent etre des entiers !";
        $_SESSION['msg'] = $smg;
        header("location:../../views/AnneePrestation.php");
    }
} else {
    // # Redirection security
    header("location:../../views/AnneePrestation.php");
}
