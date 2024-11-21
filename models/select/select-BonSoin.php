<?php
if (isset($_GET["idBon"])) {
    $id = $_GET["idBon"];
    $getMembre = $connexion->prepare("SELECT `bonsoin`.*,membre.nom,membre.postnom,membre.prenom,membre.photo,fosa.desingation FROM `bonsoin`,membre,fosa WHERE bonsoin.fosa=fosa.id AND bonsoin.maticule=membre.matricule AND bonsoin.id=?;");
    $getMembre->execute(array($id));
    $select = $getMembre->fetch();
    $action = "../models/updat/up-Bon.php?idBon=$id";
    $titre = "Modifier bon";
    $bouton = "Modifier";
    $Annuler = "ListeBion.php";
} else {
    $action = "../models/add/add-BonSoin.php";
    $titre = "Etablir bon";
    $bouton = "Enregistrer";
    $Annuler="BonSoin.php";
}
