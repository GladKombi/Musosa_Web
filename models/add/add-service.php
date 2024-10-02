<?php
include_once("../../connexion/connexion.php");
if (isset($_POST["valider"])) {
    $desingation = htmlspecialchars($_POST["desingation"]);
    $tarifplafond = htmlspecialchars($_POST["tarifplafond"]);
    $partmusosa = htmlspecialchars($_POST["partmusosa"]);
    if (is_numeric($tarifplafond) && is_numeric($partmusosa)) {
        $req = $connexion->prepare("INSERT INTO `service`(`desingation`, `tarifplafond`, `partmusosa`) VALUES(?,?,?) ");
        $req->execute(array($desingation, $tarifplafond, $partmusosa));
        if ($req) {
            $_SESSION["smg"] = "Enregistrement reussi";
            header("location:../../views/service.php");
        }
    } else {
        $_SESSION["smg"] = "Le tarif plafond et La part musosa doivent etre des entiers";
        header("location:../../views/service.php");
    }
}
