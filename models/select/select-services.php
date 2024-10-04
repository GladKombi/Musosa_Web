<?php
if (isset($_GET["idService"])) {
    $id = $_GET["idService"];
    # Selection of services registed in BD
    $req = $connexion->prepare("SELECT * FROM `service` WHERE id=?");
    $req->execute(array($id));
    $select = $req->fetch();
    # URL for updating a service
    $url = "../models/updat/up-service.php?idService=$id";
    $title = "Modification du service";
    $btn = "Modifier";
} else {
    # URL wich to add a service
    $url = "../models/add/add-service.php";
    $title = "Enregistrement d'un nouvau service";
    $btn = "Enregistrer";
}
$req = $connexion->prepare("SELECT * FROM `service` WHERE supprimer=0");
$req->execute();
