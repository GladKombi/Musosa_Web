<?php
include_once("../../connexion/connexion.php");
if (isset($_POST["Valider"])) {
    $supprimer=0;
    $desingation = htmlspecialchars($_POST["desingation"]);
    $req = $connexion->prepare("INSERT INTO `fosa`(`desingation`, `supprimer`) VALUES (?,?)");
    $req->execute(array($desingation, $supprimer));
    if ($req) {
        $_SESSION["msg"] = "Enregistrement reussi";
        header("location:../../views/fosa.php");
    } else {
        $_SESSION["msg"] = "Echec d'enregistrement";
        header("location:../../views/fosa.php");
    }
}
