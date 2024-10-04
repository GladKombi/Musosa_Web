<?php
if (isset($_GET["idcompte"])) {
    $id = $_GET["idcompte"];
    $req = $connexion->prepare("SELECT * FROM membre WHERE matricule=? ORDER BY matricule ASC");
    $req->execute(array($id));
    $select = $req->fetch();
    $action = "../models/updat/up-compte.php?idcompte=$id";
    $titre = "Modification du compte";
    $bouton = "Modifier";
} else {
    $action = "../models/add/add-compte.php";
    $titre = "Ajout du compte";
    $bouton = "Enregistrer";
}
