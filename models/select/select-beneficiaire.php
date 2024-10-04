<?php
if (isset($_GET["idben"])) {
    $id = $_GET["idben"];
    $req = $connexion->prepare("SELECT * FROM beneficiaire WHERE matricule=? ORDER BY matricule ASC");
    $req->execute(array($id));
    $select = $req->fetch();
    $action = "../models/updat/up-beneficiaire.php?idben=$id";
    $titre = "Modification du Béneficiaire";
    $bouton = "Modifier";
} else {
    $idtitulaire = $_GET["idtit"];
    $action = "../models/add/add-beneficiaire.php?idtit=$idtitulaire";
    $titre = "Ajout du Béneficiaire";
    $bouton = "Enregistrer";
} 