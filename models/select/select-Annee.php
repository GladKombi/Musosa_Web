<?php
if (isset($_GET["idperio"])) {
    $id=$_GET["idperio"];
    # Selection of prestations registed in BD
    $req = $connexion->prepare("SELECT * FROM `anneeprestation` WHERE id=?");
    $req->execute(array($id));
    $select=$req->fetch();
    # URL for updating a prestation per year
    $url="../models/updat/up-prestation.php?idperio=$id";
    $title= "Modification de la période de prestation";
    $btn="Modifier";
}
else{
    # URL for adding a prestation for a new year
    $url="../models/add/add-prestation.php";
    $title= "Ajout de la période de prestation";
    $btn="Enregistrer"; 
}
$req = $connexion->prepare("SELECT * FROM `anneeprestation`");
$req->execute();