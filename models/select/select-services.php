<?php
if (isset($_GET["idser"])) {
    $id = $_GET["idser"];
    # Selection of services registed in BD
    $req = $connexion->prepare("SELECT * FROM `service` WHERE id=?");
    $req->execute(array($id));
    $select = $req->fetch();
    # URL for updating a service
    $action = "../models/update/up-service.php?idser=$id";
    $titre = "Modification du service";
    $bouton = "Modifier";
} else {
    # URL wich to add a service
    $action = "../models/add/add-service.php";
    $titre = "Enregistrement d'un nouvau service";
    $bouton = "Enregistrer";
}
$req = $connexion->prepare("SELECT * FROM `service` WHERE supprimer=0");
$req->execute();
