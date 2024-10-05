<?php
if (isset($_GET["idFosa"])) {
    $id = $_GET["idFosa"];
    # Selection of Fosa registed in BD
    $req = $connexion->prepare("SELECT * FROM fosa WHERE id=?");
    $req->execute(array($id));
    $select = $req->fetch();
    # URL for updating Fosa
    $url = "../models/updat/up-fosa.php?idFosa=$id";
    $title = "Modification de la fosa";
    $btn = "Modifier";
} else {
    # URL for Adding Fosa
    $url = "../models/add/add-fosa.php";
    $title = "Ajout de la fosa";
    $btn = "Enregistrer";
}
$req = $connexion->prepare("SELECT * FROM fosa where supprimer=0");
$req->execute();
