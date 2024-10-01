<?php
    if (isset($_GET["idcompte"])) {
        $id = $_GET["idcompte"];
        $req = $connexion->prepare("SELECT * FROM membre WHERE matricule=? ORDER BY matricule ASC");
        $req->execute(array($id));
        $select = $req->fetch();
        # Url du traitement lors de la modification
        $url = "../models/update/up-compte.php?idcompte=$id";
        $title = "Modification du compte";
        $btn = "Modifier";
    } else {
         # Url du traitement lors de l'enregistrement
        $url = "../models/add/add-compte.php";
        $title = "Enregistrement d'un nouveau compte";
        $btn = "Enregistrer";
    }
    
    $statut = 0;
    $rep = $connexion->prepare("SELECT * from coorporation WHERE supprimer=?;");
    $n = 0;
    $req = $connexion->prepare("SELECT  membre.`matricule`, membre.`nom`, membre.`postnom`, membre.`genre`, membre.`tel`, membre.`adresse`, membre.`etatcivil`, coorporation.desingation AS coorporation, 
    membre.`lieunaissance`, membre.`datenaissance`, membre.`photo`, membre.`date`, membre.`supprimer` FROM `membre`,coorporation WHERE membre.coorporation=coorporation.id AND membre.supprimer=0");
    $req->execute();