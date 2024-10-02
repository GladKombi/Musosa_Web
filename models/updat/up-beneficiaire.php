<?php
include_once("../../connexion/connexion.php");
if (isset($_POST["valider"])) {
    $id = $_GET["idben"];
    $nom = htmlspecialchars($_POST["nom"]);
    $postnom = htmlspecialchars($_POST["postnom"]);
    $genre = htmlspecialchars($_POST["genre"]);
    $tel = htmlspecialchars($_POST["tel"]);
    $adresse = htmlspecialchars($_POST["adresse"]);
    $etatcivil = htmlspecialchars($_POST["etatcivil"]);
    $lien = htmlspecialchars($_POST["lien"]);
    $lieunaissance = htmlspecialchars($_POST["lieunaissance"]);
    $datenaissance = htmlspecialchars($_POST["datenaissance"]);
    $verification = $connexion->prepare("SELECT * FROM beneficiaire WHERE nom=? and postnom=? and datenaissance=? AND supprimer=?");
    $verification->execute([$nom, $postnom, $datenaissance, 0]);
    $tab = $verification->fetch();
    if ($tab > 0) {
        $_SESSION["smg"] = 'Ce Beneficiaire existe dejà dans la base de données';
        header("location:../../views/beneficiaire.php?idtit=$id");
    } else {
        $req = $connexion->prepare("UPDATE beneficiaire SET nom=?,postnom=?,genre=?,tel=?,adresse=?,etatcivil=?,lien=?,lieunaissance=?,datenaissance=? WHERE matricule=?");
        $req->execute(array($nom, $postnom, $genre, $tel, $adresse, $etatcivil, $lien, $lieunaissance, $datenaissance, $id));
        if ($req) {
            $_SESSION["smg"] = "Modification reussi";
            header("location:../../views/beneficiaire.php?idtit=$id");
        } else {
            $_SESSION["smg"] = "Echec de modification";
            header("location:../../views/beneficiaire.php?idtit=$id");
        }
    }
}
