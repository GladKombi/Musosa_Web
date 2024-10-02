<?php
include_once("../../connexion/connexion.php");
if (isset($_POST["valider"])) {
    $id = $_GET["idcoo"];
    $desingation = htmlspecialchars($_POST["desingation"]);
    $verification = $connexion->prepare("SELECT * FROM coorporation WHERE desingation=? AND supprimer=?");
    $verification->execute([$desingation, 0]);
    $tab = $verification->fetch();
    if ($tab > 0) {
        $_SESSION["smg"] = 'Ce coorporation existe dejà dans la base de données';
        header("location:../../views/coorporation.php");
    } else {
        $req = $connexion->prepare("UPDATE `coorporation` SET desingation=? WHERE id=?");
        $req->execute(array($desingation, $id));
        if ($req) {
            $_SESSION["smg"] = "Modification reussi";
            header("location:../../views/coorporation.php");
        } else {
            $_SESSION["smg"] = "Echec de modification";
            header("location:../../views/coorporation.php");
        }
    }
}
