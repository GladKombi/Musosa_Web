<?php
if (isset($_GET["iduser"])) {
    $id = $_GET["iduser"];
    $req = $connexion->prepare("SELECT * FROM `user` WHERE id=? ");
    $req->execute(array($id));
    $select = $req->fetch();
    $url = "../models/update/up-user.php?iduser=$id";
    $title = "Modification de l'utilisateur";
    $btn = "Modifier";
} else {
    $url = "../models/add/add-user.php";
    $title = "Enregistrement d'un nouvelle utilisateur";
    $btn = "Enregistrer";
}
