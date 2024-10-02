<?php
include_once("../../connexion/connexion.php");
if (isset($_POST["valider"])) {
    $desingation = htmlspecialchars($_POST["desingation"]);
    $req = $connexion->prepare("INSERT INTO `fosa`(`desingation`) VALUES (?)");
    $req->execute(array($desingation));
    if ($req) {
        $_SESSION["smg"] = "Enregistrement reussi";
        header("location:../../views/fosa.php");
    } else {
        $_SESSION["smg"] = "Echec d'enregistrement";
        header("location:../../views/fosa.php");
    }
}
