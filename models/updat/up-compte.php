<?php
include_once("../../connexion/connexion.php");
if (isset($_POST["valider"])) {
    $id = $_GET["idcompte"];
    $nom = htmlspecialchars($_POST["nom"]);
    $postnom = htmlspecialchars($_POST["postnom"]);
    $genre = htmlspecialchars($_POST["genre"]);
    $tel = htmlspecialchars($_POST["tel"]);
    $adresse = htmlspecialchars($_POST["adresse"]);
    $etatcivil = htmlspecialchars($_POST["etatcivil"]);
    $coorporation = htmlspecialchars($_POST["coorporation"]);
    $lieunaissance = htmlspecialchars($_POST["lieunaissance"]);
    $datenaissance = htmlspecialchars($_POST["datenaissance"]);
    $verification = $connexion->prepare("SELECT * FROM membre WHERE nom=? and postnom=? and tel=? AND supprimer=?");
    $verification->execute([$nom, $postnom, $tel, 0]);
    $tab = $verification->fetch();
    if ($tab > 0) {
        $_SESSION["smg"] = 'Ce membre existe dejà dans la base de données';
        header("location:../../views/compte.php");
    } else {
        if (is_numeric($tel)) {
            $req = $connexion->prepare("UPDATE membre SET nom=?,postnom=?,genre=?,tel=?,adresse=?,etatcivil=?,coorporation=?,lieunaissance=?,datenaissance=? WHERE matricule=?");
            $req->execute(array($nom, $postnom, $genre, $tel, $adresse, $etatcivil, $coorporation, $lieunaissance, $datenaissance, $id));
            if ($req) {
                $_SESSION["smg"] = "Modification reussi";
                header("location:../../views/compte.php");
            } else {
                $_SESSION["smg"] = "Le numero de télephone doit etre  entiers";
                header("location:../../views/compte.php");
            }
        } else {
            $_SESSION["smg"] = "Echec de modification";
            header("location:../../views/compte.php");
        }
    }
}
