<?php
include_once("../../connexion/connexion.php");
if (isset($_POST["valider"])) {
    $id = $_GET["idfosa"];
    $desingation = htmlspecialchars($_POST["desingation"]);
    $req = $connexion->prepare("UPDATE fosa SET desingation=? WHERE id=?");
    $req->execute(array($desingation, $id));
    if ($req) {
        $_SESSION["smg"] = "Modification reussi";
        header("location:../../views/fosa.php");
    } else {
        $_SESSION["smg"] = "Echec de modification";
        header("location:../../views/fosa.php");
    }
}
