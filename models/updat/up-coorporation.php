<?php
include_once("../../connexion/connexion.php");
if (isset($_POST["Valider"])) {
    $id = $_GET["idcoo"];
    $desingation = htmlspecialchars($_POST["designation"]);
    $verification = $connexion->prepare("SELECT * FROM coorporation WHERE desingation=? AND supprimer=?");
    $verification->execute([$desingation, 0]);
    $tab = $verification->fetch();
    if ($tab > 0) {
        $_SESSION["msg"] = 'Ce coorporation existe dejà dans la base de données';
        header("location:../../views/coorporation.php");
    } else {
        $req = $connexion->prepare("UPDATE `coorporation` SET desingation=? WHERE id=?");
        $req->execute(array($desingation, $id));
        if ($req) {
            $_SESSION["msg"] = "Modification reussi";
            header("location:../../views/coorporation.php");
        } else {
            $_SESSION["msg"] = "Echec de modification";
            header("location:../../views/coorporation.php");
        }
    }
}
