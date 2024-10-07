<?php
if (isset($_GET["idcot"])) {
    $id=$_GET["idcot"];
    $req = $connexion->prepare("SELECT * FROM `cotisation` WHERE id=?");
    $req->execute(array($id));
    $select=$req->fetch();
    $action="../models/add/add-cotisation.php?idcot=$id";
    $titre= "Ajouter une cotisation";
    $tit= "Paiement";
    $bouton="Enregistrer";
}
else{
    $action="../models/update/up-cotisation.php";
    $titre= "Choisir le Membre";
    $tit= "Paiement";
    $bouton="Enregistrer"; 
}
