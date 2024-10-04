<?php
include_once("../../connexion/connexion.php");
if (isset($_POST["Valider"])) {
    $desingation = htmlspecialchars($_POST["desingation"]);
    $tarifplafond = htmlspecialchars($_POST["tarifplafond"]);
    $partmusosa = htmlspecialchars($_POST["partmusosa"]);
    if (is_numeric($tarifplafond) && is_numeric($partmusosa)) {
        $req = $connexion->prepare("INSERT INTO `service`(`desingation`, `tarifplafond`, `partmusosa`) VALUES(?,?,?) ");
        $req->execute(array($desingation, $tarifplafond, $partmusosa));
        if ($req) {
            $_SESSION["msg"] = "Enregistrement reussi !";
            header("location:../../views/services.php");
        }
    } else {
        $_SESSION["msg"] = "Le tarif plafond et La part musosa doivent etre des entiers !";
        header("location:../../views/services.php");
    }
}
