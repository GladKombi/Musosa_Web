<?php
include '../connexion/connexion.php';
$fonction= $_GET['fonction'];  
if(isset($_POST['connect']))
{
    $username=htmlspecialchars($_POST['username']);
    $password=htmlspecialchars($_POST['password']);

  if ($fonction=="user")   
  {
    $req=$connexion->prepare("SELECT * FROM `user` WHERE username=? and pwd=?");
    $req->execute(array($username,$password));
        $recup = $req->fetch();
        if($recup)
        {
            $_SESSION['id']=$recup['id'];
            $_SESSION['image']=$recup['photo'];
            $_SESSION['telephone']=$recup['tel'];
            $_SESSION['genre']=$recup['genre'];
            $_SESSION['adresse']=$recup['adresse'];
            $_SESSION['noms']=$recup['nom'].' '.$recup['postnom'];
            $_SESSION['nom']=$recup['nom'];
            $_SESSION['postnom']=$recup['postnom'];
            $_SESSION['pwd']=$recup['pwd'];
            header("Location: AnneePrestation.php");
        }
        else
        {
            $_SESSION["smg"]='Mot de passe incorrect ';
        }
  }
 
 if ($fonction=="membre") 
 {
   
  $req=$connexion->prepare("SELECT * FROM `beneficiaire` WHERE titulaire=? and pwd=?");
  $req->execute(array($username,$password));
      $recup = $req->fetch();
       if($recup)
       {
           $_SESSION['titulaire']=$recup['titulaire'];
           $_SESSION['image']=$recup['photo'];
           $_SESSION['telephone']=$recup['tel'];
           $_SESSION['genre']=$recup['genre'];
           $_SESSION['adresse']=$recup['adresse'];
           $_SESSION['noms']=$recup['nom'].' '.$recup['postnom'];
           $_SESSION['nom']=$recup['nom'];
           $_SESSION['postnom']=$recup['postnom'];
           $_SESSION['pwd']=$recup['pwd'];
           
           header("Location: affichgeben.php");
       }
       else
       {
        $_SESSION["smg"]= 'Mot de passe incorrect ';
       }
 }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<style>
body {
    min-height: 100vh;
}
</style>
<?php require_once('style.php')?>
<body class="d-flex justify-content-center align-items-center px-3 ">
    <div class="fixed-top container text-center pt-4">
        <span></span>
    </div>
    <form method="POST"  class="col-xl-4 col-lg-5 col-sm-7 col-md-6 card p-4">
    <div class="modal-header p-5 pb-4 border-bottom-0">
              <h4 >Connexion</h4>
              <a href="../index.php"><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></a>
            </div>
            <div class="row">
            <?php if($fonction=="user"){?>
                <div class="col-12 mb-3">
                <label for="">Adresse e-mail</label>
                <input type="email" class="form-control" placeholder="Ex: example@gmail.com" name="username">
            </div>
                <?php } else{ ?>
                    <div class="col-12 mb-3">
                <label for="">Matricule</label>
                <input type="text" class="form-control" placeholder="Matricule" name="username">
            </div>
                <?php } ?>
            <div class="col-12 mb-3">
                <label for="">Mot de passe</label>
                <input type="password" class="form-control" placeholder="Ex: *****" name="password">
            </div>
            <?php if(isset($_SESSION['msg']) && $_SESSION['msg']!=""){?>
            <div class="col-12 ">

                <div class="alert alert-danger text-center"><?php  echo $_SESSION['msg'];?></div>
            </div>
            <?php } ?>
            <div class="col-12 mb-3">
                <input type="submit" class="form-control btn-success btn" name="connect" value="Se connecter">
            </div>
            <div class="col-12 mb-3 d-flex justify-content-between">
                <label><input type="checkbox" class="form-check-input"> Tous ensemble pour la santé </label>
            </div>
        </div>
    </form>
    <div class="fixed-bottom container text-center pb-4">
        <span>MUSOSA</span>
    </div>
</body>

</html>



