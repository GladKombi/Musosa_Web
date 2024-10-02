<?php
include_once("../../connexion/connexion.php");
if (isset($_POST["valider"])) {
    $id = $_GET["idser"];
    $desingation = htmlspecialchars($_POST["desingation"]);
    $tarifplafond = htmlspecialchars($_POST["tarifplafond"]);
    $partmusosa = htmlspecialchars($_POST["partmusosa"]);
    if (is_numeric($tarifplafond) && is_numeric($partmusosa)) {
        $req = $connexion->prepare("UPDATE `service` SET `desingation`=?,`tarifplafond`=?,`partmusosa`=? WHERE id=?");
        $req->execute(array($desingation, $tarifplafond, $partmusosa, $id));
        if ($req) {
            $_SESSION["smg"] = "Modification reussi";
            header("location:../../views/service.php");
        } else {
            $_SESSION["smg"] = "Echec de Modification";
            header("location:../../views/service.php");
        }
    }
}
