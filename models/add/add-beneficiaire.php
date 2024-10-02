<?php
include_once("../../connexion/connexion.php");
if (isset($_POST["valider"])) {
    $val = $_GET["idtit"];
    $long = strlen($val);
    if ($long == 10) {
        $vals = substr($val, 4, 1);
        // echo $vals; 
    } else {
        $nombre = $long - 10 + 1;
        $vals = substr($val, 4, $nombre);
        echo $vals;
    }
    $req = $connexion->prepare("SELECT * FROM beneficiaire ORDER BY  matricule DESC LIMIT 1 ");
    $req->execute();
    if ($mat = $req->fetch()) {
        $valeur = $mat['matricule'];
        if (strlen($valeur) == 12) {
            $numero = substr($valeur, 4, 1) + 1;
            echo $numero;
        } else {
            $nb = strlen($valeur) - 12 + 1;
            $numero = substr($valeur, 4, $nb);
            echo $valeur;
        }
    } else {
        $numero = 1;
    }
    $id = $_GET["idtit"];
    $annee = date("Y");
    $nom = htmlspecialchars($_POST["nom"]);
    $postnom = htmlspecialchars($_POST["postnom"]);
    $genre = htmlspecialchars($_POST["genre"]);
    $tel = htmlspecialchars($_POST["tel"]);
    $adresse = htmlspecialchars($_POST["adresse"]);
    $etatcivil = htmlspecialchars($_POST["etatcivil"]);
    $matricule = 'MUS' . '/' . $numero . '/' . $vals . '/' . $annee;
    echo $matricule;
    $lien = htmlspecialchars($_POST["lien"]);
    $lieunaissance = htmlspecialchars($_POST["lieunaissance"]);
    $datenaissance = htmlspecialchars($_POST["datenaissance"]);
    #Upload image
    $photo = $_FILES['photo']['name'];
    echo $photo;
    $upload = "../../photo/" . $photo;
    move_uploaded_file($_FILES['photo']['tmp_name'], $upload);
    echo $photo;
    $titulaire = $id;
    $date = date("Y-m-d");
    $supprimer = 0;
    $verification = $connexion->prepare("SELECT * FROM beneficiaire WHERE nom=? and postnom=? and datenaissance=?AND supprimer=?");
    $verification->execute([$nom, $postnom, $datenaissance, 0]);
    $tab = $verification->fetch();
    if ($tab > 0) {
        $_SESSION["smg"] = 'Ce Beneficiaire existe dejà dans la base de données';
        header("location:../../views/beneficiaire.php?idtit=$id");
    } else {
        if (is_numeric($tel)) {
            $req = $connexion->prepare("INSERT INTO `beneficiaire`(`nom`, `postnom`, `genre`, `tel`, `adresse`, `etatcivil`, `matricule`,`lien`, `lieunaissance`, `datenaissance`, 
         `photo`,titulaire, `date`,supprimer) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
            $req->execute(array($nom, $postnom, $genre, $tel, $adresse, $etatcivil, $matricule, $lien, $lieunaissance, $datenaissance, $photo, $titulaire, $date, $supprimer));
            if ($req) {
                $_SESSION["smg"] = "Enregistrement reussi";
                header("location:../../views/beneficiaire.php?idtit=$id");
            }
        } else {
            $_SESSION["smg"] = "Le numero de télephone doit etre  entiers";
            header("location:../../views/beneficiaire.php?idtit=$id");
        }
    }
}
