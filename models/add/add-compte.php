<?php
include_once ("../../connexion/connexion.php");
if (isset($_POST["valider"])) {
    
    $req = $connexion->prepare("SELECT * FROM `membre` ORDER BY matricule DESC LIMIT 1 ");
    $req->execute();
    if ($mat = $req->fetch()) {
        $valeur = $mat['matricule'];
        if (strlen($valeur) == 10) {
            $numero = substr($valeur, 4, 1) + 1;
            echo $numero;
        } else {
            $nb = strlen($valeur) - 10 + 1;
            $numero = substr($valeur, 4, $nb) + 1;
            echo $numero;

        }
    } else {
        $numero = 1;
    }
    $annee = date("Y");
    $nom = htmlspecialchars($_POST["nom"]);
    $postnom = htmlspecialchars($_POST["postnom"]);
    $prenom = htmlspecialchars($_POST["prenom"]);
    $genre = htmlspecialchars($_POST["genre"]);
    $tel = htmlspecialchars($_POST["tel"]);
    $adresse = htmlspecialchars($_POST["adresse"]);
    $paroisse = htmlspecialchars($_POST["paroisse"]);
    $zonesante = htmlspecialchars($_POST["zonesante"]);
    $etatcivil = htmlspecialchars($_POST["etatcivil"]);
    $matricule = 'MUS' . '/' . $numero . '/' . $annee;
    $matben='MUS' . '/' . "0" . '/' .$numero . '/' . $annee;
    echo $matricule;
    $coorporation = htmlspecialchars($_POST["coorporation"]);
    $lieunaissance = htmlspecialchars($_POST["lieunaissance"]);
    $datenaissance = htmlspecialchars($_POST["datenaissance"]);
    $date = date("Y-m-d");
    #Upload image
    $photo = $_FILES['photo']['name'];
    echo $photo;
    $upload = "../../photo/" . $photo;
    move_uploaded_file($_FILES['photo']['tmp_name'], $upload);
    $supprimer = 0;
    $lien="Titulaire";
    $titulaire=$matricule;
    #verifier si le fournisseur existe ou pas dans la bd
    $verification = $connexion->prepare("SELECT * FROM membre WHERE nom=? and postnom=? and tel=? AND supprimer=?");
    $verification->execute([$nom,$postnom,$tel,$supprimer]);
    $tab = $verification->fetch();
    if ($tab > 0) {
        $_SESSION["msg"] = 'Ce membre existe dejà dans la base de données';
        header("location:../../views/compte.php");
    } else {
    if (is_numeric($tel)) {
        $req = $connexion->prepare("INSERT INTO `membre`(`nom`, `postnom`,prenom, `genre`, `tel`, `adresse`, `paroisse`, `zonesante`, `etatcivil`, `matricule`, 
         `coorporation`, `lieunaissance`, `datenaissance`, `photo`, `date`,supprimer) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $req->execute(array($nom, $postnom,$prenom, $genre, $tel, $adresse,$paroisse, $zonesante,$etatcivil, $matricule, $coorporation, $lieunaissance, $datenaissance, $photo, $date, $supprimer));
        if ($req) {
            $save = $connexion->prepare("INSERT INTO `beneficiaire`(`nom`, `postnom`,prenom,`genre`, `tel`, `adresse`,`etatcivil`, `matricule`,`lien`, `lieunaissance`, `datenaissance`, 
            `photo`,titulaire, `date`,supprimer) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
            $save->execute(array($nom, $postnom,$prenom, $genre, $tel, $adresse, $etatcivil, $matben, $lien, $lieunaissance, $datenaissance, $photo, $titulaire, $date,$supprimer));
            $_SESSION["msg"] = "Enregistrement reussi";
            header("location:../../views/compte.php");
        }
    } else {
        $_SESSION["msg"] = "Le numero de télephone doit etre  entiers";
        header("location:../../views/compte.php");
    }
}
} else {
    header("location:../../views/compte.php");
}

