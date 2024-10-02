<?php
include_once("../../connexion/connexion.php");
if (isset($_POST["valider"])) {
    $montant = htmlspecialchars($_POST["montant"]);
    $titulaire = $_GET["idcot"];
    // if (strlen($titulaire) == 10) {
    //     $numero = substr($titulaire, 6, 4) ;
    //     echo $numero;
    // } else {
    //     $nb = strlen($titulaire) - 4 ;
    //     $numero = substr($titulaire, $nb, 4) ;
    //     echo $numero;

    // }

    $annee = date("Y");
    $reqannee = $connexion->prepare("SELECT * FROM `anneeprestation` where annee=?");
    $reqannee->execute(array($annee));
    $affiche = $reqannee->fetch();
    $paquet = $affiche["paquet"];

    $date = date("Y-m-d");
    $supprimer = 0;
    while ($montant > 0) {

        $reqben = $connexion->prepare("SELECT matricule FROM beneficiaire WHERE titulaire=? AND (matricule) NOT IN (SELECT matBeneficiaire from cotisation where anneeprestation=? GROUP by matBeneficiaire HAVING SUM(montant)=?)");
        $reqben->execute(array($titulaire, $annee, $paquet));
        if ($donnes = $reqben->fetch()) {
            $matriculeBen = $donnes["matricule"];
            // echo $matriculeBen;
            $req = $connexion->prepare("SELECT  montant  FROM cotisation where cotisation.matBeneficiaire=? and anneeprestation=?");
            $req->execute(array($matriculeBen, $annee));
            if ($ben = $req->fetch()) {

                $mont = $ben["montant"];

                $reste = $paquet - $mont;


                $montant = $montant - $reste;
                //  echo $reste;



            } else {

                if ($montant < $paquet) {
                    $reste = $montant;

                    echo $montant . " est inf a" . $paquet;
                } else {
                    $reste = $paquet;
                }
                $montant = $montant - $reste;
            }




            $req = $connexion->prepare("INSERT INTO `cotisation`(matTitilaire,matBeneficiaire,montant,anneeprestation,date) VALUES (?,?,?,?,?)");
            $req->execute(array($titulaire, $matriculeBen, $reste, $annee, $date));
            if ($req) {
                $_SESSION["smg"] = "Enregistrement reussi";
                header("location:../../views/cotisation.php");
            } else {
                $_SESSION["smg"] = "Echec d'enregistrement";
                header("location:../../views/cotisation.php");
            }
        } else {
            echo 'tout payer';
            $_SESSION["smg"] = "le montant a remetre est de " . $montant;
            $montant = 0;
            header("location:../../views/cotisation.php");
        }
    }
}
