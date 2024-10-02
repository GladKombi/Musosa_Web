<?php
include_once("../../connexion/connexion.php");
if (isset($_POST["valider"])) {
    $id = $_GET["iduser"];
    $nom = htmlspecialchars($_POST["nom"]);
    $postnom = htmlspecialchars($_POST["postnom"]);
    $genre = htmlspecialchars($_POST["genre"]);
    $tel = htmlspecialchars($_POST["tel"]);
    $adresse = htmlspecialchars($_POST["adresse"]);
    $username = $postnom . $id . '@musosa.fin';
    $pwd = htmlspecialchars($_POST["pwd"]);
    $fonction = htmlspecialchars($_POST["fonction"]);
    $verification = $connexion->prepare("SELECT * FROM user WHERE nom=? and postnom=? and tel=? AND supprimer=?");
    $verification->execute([$nom, $postnom, $tel, 0]);
    $tab = $verification->fetch();
    if ($tab > 0) {
        $_SESSION["smg"] = 'Cet utilisqteur existe dejà dans la base de données';
        header("location:../../views/user.php");
    } else {
        if (is_numeric($tel)) {
            $req = $connexion->prepare("UPDATE user SET nom=?,postnom=?,genre=?,tel=?,adresse=?,pwd=?,fonction=?WHERE id=?");
            $req->execute(array($nom, $postnom, $genre, $tel, $adresse, $pwd, $fonction, $id));
            if ($req) {
                $_SESSION["smg"] = "Modification reussi";
                header("location:../../views/user.php");
            } else {
                $_SESSION["smg"] = "Le numero de télephone doit etre  entiers";
                header("location:../../views/user.php");
            }
        } else {
            $_SESSION["smg"] = "Echec de modification";
            header("location:../../views/user.php");
        }
    }
}
