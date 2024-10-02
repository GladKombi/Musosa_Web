<?php
include_once("../../connexion/connexion.php");
if (isset($_POST["valider"])) {
    $req = $connexion->prepare("SELECT id from user order by id DESC limit 1 ");
    $req->execute();
    if ($val = $req->fetch()) {
        $valid = $val['id'] + 1;
    } else {
        $valid = 1;
    }
    $nom = htmlspecialchars($_POST["nom"]);
    $postnom = htmlspecialchars($_POST["postnom"]);
    $genre = htmlspecialchars($_POST["genre"]);
    $tel = htmlspecialchars($_POST["tel"]);
    $adresse = htmlspecialchars($_POST["adresse"]);
    $username = $postnom . $valid . '@musosa.fin';
    $pwd = htmlspecialchars($_POST["pwd"]);
    $fonction = htmlspecialchars($_POST["fonction"]);
    $date = date("Y-m-d");
    #Upload image
    $photo = $_FILES['photo']['name'];
    echo $photo;
    $upload = "../../photo/" . $photo;
    move_uploaded_file($_FILES['photo']['tmp_name'], $upload);
    $supprimer = 0;
    $verification = $connexion->prepare("SELECT * FROM user WHERE nom=? and postnom=? and tel=? AND supprimer=?");
    $verification->execute(array($nom, $postnom, $tel, $supprimer));
    $tab = $verification->fetch();
    if ($tab > 0) {
        $_SESSION["smg"] = 'Cet utilisateur existe dejà dans la base de données';
        header("location:../../views/user.php");
    } else {
        $req = $connexion->prepare("INSERT INTO `user`( `nom`, `postnom`, `genre`, `tel`, `adresse`, `username`, `pwd`, `fonction`, `photo`, `date`, `supprimer`) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
        $req->execute(array($nom, $postnom, $genre, $tel, $adresse, $username, $pwd, $fonction, $photo, $date, $supprimer));
        if ($req) {
            $_SESSION["smg"] = "Enregistrement reussi";
            header("location:../../views/user.php");
        } else {
            $_SESSION["smg"] = "Echec d'enregistrement";
            header("location:../../views/user.php");
        }
    }
}
