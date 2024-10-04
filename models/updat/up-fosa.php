<?php
include_once("../../connexion/connexion.php");
if (isset($_POST["Valider"])) {
    $id = $_GET["idFosa"];
    $desingation = htmlspecialchars($_POST["designation"]);
    if (!empty($desingation)) {
        #verifier si le client existe ou pas dans la bd
        $statut = 0;
        $getClass = $connexion->prepare("SELECT * FROM fosa where desingation=? AND supprimer=?");
        $getClass->execute([$desingation, $statut]);
        ($Class = $getClass->fetch());
        if ($Class > 0) {
            $msg = "Cette Class existe déjà dans la base de données !";
            $_SESSION['msg'] = $msg;
            header("location:../../views/fosa.php");
        } else {
            $req = $connexion->prepare("UPDATE fosa SET desingation=? WHERE id=?");
            $req->execute(array($desingation, $id));
            if ($req) {
                $_SESSION["msg"] = "Modification reussi";
                header("location:../../views/fosa.php");
            } else {
                $_SESSION["msg"] = "Echec de modification";
                header("location:../../views/fosa.php");
            }
        }
    }
}
