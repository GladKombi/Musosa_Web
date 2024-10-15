<?php
    //la connexion a la base de donnees
    include_once('../../connexion/connexion.php');
    include_once('../../fonctions/fonctions.php');

    //la creation de l'evenement qui sert à envoyer les données à la base de données
    //Lors qu'on a cliquer sur le bouton valider

    if (isset($_POST['valider']) && isset($_GET['idMod']) && !empty($_GET['idMod'])) {
        $_id = $_GET['idMod'];
        $_nom = htmlspecialchars($_POST['nom']);
        $_postnom = htmlspecialchars($_POST['postnom']);
        $_email = htmlspecialchars($_POST['email']);
        $_tel = htmlspecialchars($_POST['tel']);
        $_adresse = htmlspecialchars($_POST['adresse']);
        // recupereration de l'image
        $image = $_FILES['photo']['name'];
        $file = $_FILES['photo'];
        $destination = "../../assets/img/profil/" . basename($image);

        // la fonction qui permet de recuperer la photo
        $newimage = RecuperPhoto($image, $file, $destination);

        print $newimage;

        if (! empty($_email)){
            if($newimage != "" && $newimage != -1 ){
                if($newimage == 0){
                    $_SESSION['msg'] = "Le format de cette image n'est pas recomandé dans ce système";
                    header("Location:../../views/UserProfil.php");
                } else {
                    $_upData = $connexion->prepare("UPDATE user SET  nom=?, postnom=?, tel=?,adresse=?,username=?,photo=? WHERE id=?");
                    $_rows = $_upData->execute([$_nom, $_postnom, $_tel,$_adresse, $_email, $newimage, $_id]);
                    if ($_rows == 1) {
                        $_SESSION['msg'] = "modification reussie";
                        header("Location:../../views/UserProfil.php");
                    } else {
                        $_SESSION['msg'] = "Echec de la modification";
                        header("Location:../../views/UserProfil.php");
                    }
                }
            }
        }else{
            if($newimage != "" && $newimage != -1 ){
                if($newimage == 0){
                    $_SESSION['msg'] = "Le format de cette image n'est pas recomandé dans ce système";
                    header("Location:../../views/UserProfil.php");
                } else {
                    $_upData = $connexion->prepare("UPDATE beneficiaire SET   nom=?, postnom=?, tel=?,adresse=?,photo=? WHERE titulaire=?");
                    $_rows = $_upData->execute([$_nom, $_postnom, $_tel,$_adresse,$newimage, $_id]);
                    if ($_rows == 1) {
                        $_SESSION['msg'] = "Modification reussie";
                        header("Location:../../views/UserProfil.php");
                    } else {
                        $_SESSION['msg'] = "Echec de la modification";
                        header("Location:../../views/UserProfil.php");
                    }
                }
            } 
        }

        
    }else{
        header("Location:../../views/UserProfil.php");
    }
        