<?php
if (isset($_GET['idBienfait'])) {
    $id=$_GET["idcoo"];
    $req = $connexion->prepare("SELECT * FROM `coorporation` WHERE id=?");
    $req->execute(array($id));
    $select=$req->fetch();
    $url="../models/update/up-coorporation.php?idcoo=$id";
    $titre= "Modification de la coorporation";
    $bouton="Modifier";
} else {
    # Url du traitement lors de l'enregistrement
    $url = "../models/add/add-Coorporation-post.php";
    $btn = "Enregistrer";
    $title = "Ajouter une Coorporation";
}

$getData = $connexion->prepare("SELECT * from coorporation WHERE supprimer=0");
$getData->execute();
