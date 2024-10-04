<?php
include_once("../../connexion/connexion.php");
if (isset($_POST["valider"])) {
    $id = $_GET["idcompte"];
    $nom = htmlspecialchars($_POST["nom"]);
    $postnom = htmlspecialchars($_POST["postnom"]);
    $genre = htmlspecialchars($_POST["genre"]);
    $tel = htmlspecialchars($_POST["tel"]);
    $adresse = htmlspecialchars($_POST["adresse"]);
    $paroisse = htmlspecialchars($_POST["paroisse"]);
    $zonesante = htmlspecialchars($_POST["zonesante"]);
    $etatcivil = htmlspecialchars($_POST["etatcivil"]);
    $coorporation = htmlspecialchars($_POST["coorporation"]);
    $lieunaissance = htmlspecialchars($_POST["lieunaissance"]);
    $datenaissance = htmlspecialchars($_POST["datenaissance"]);
    $verification = $connexion->prepare("SELECT * FROM membre WHERE nom=? and postnom=? and tel=? AND supprimer=?");
    $verification->execute([$nom, $postnom, $tel, 0]);
    $tab = $verification->fetch();
    if ($tab > 0) {
        $_SESSION["msg"] = 'Ce membre existe dejà dans la base de données';
        header("location:../../views/compte.php");
    } else {
        if (is_numeric($tel)) {
            $req = $connexion->prepare("UPDATE membre SET nom=?,postnom=?,genre=?,tel=?,adresse=?,paroisse=?,zonesante=?,etatcivil=?,coorporation=?,lieunaissance=?,datenaissance=? WHERE matricule=?");
            $req->execute(array($nom, $postnom, $genre, $tel, $adresse,$paroisse,$zonesante,$etatcivil, $coorporation, $lieunaissance, $datenaissance, $id));
            if ($req) {
                $_SESSION["msg"] = "Modification reussi";
                header("location:../../views/compte.php");
            } else {
                $_SESSION["msg"] = "Le numero de télephone doit etre  entiers";
                header("location:../../views/compte.php");
            }
        } else {
            $_SESSION["msg"] = "Echec de modification";
            header("location:../../views/compte.php");
        }
    }
}
