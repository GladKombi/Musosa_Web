<?php
include '../connexion/connexion.php'; 
require_once('../models/select/select-bon.php'); 
require_once('../fonction/function.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Bon</title>
    <?php require_once('style.php') ?>

</head>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <?php require_once('navbar.php') ?>
            <div class="main-sidebar sidebar-style-2">
                <?php require_once('aside.php') ?>
            </div>

            <!-- Main Content -->
            <div class="main-content">
                <div class="row">
                    <div class="col-12">
                        <h4 class="text-white">Bon</h4>
                    </div>
                    <!-- pour afficher les massage  -->
                    <?php
                    if (isset($_SESSION['msg']) && !empty($_SESSION['msg'])) { ?>
                        <div class="col-xl-12 mt-3">
                            <div class="alert-info alert text-center"><?= $_SESSION['msg'] ?></div>
                        </div>
                    <?php }
                    #Cette ligne permet de vider la valeur qui se trouve dans la session message
                    unset($_SESSION['msg']);
                    ?>
                    <!-- Le form qui enregistrer les données  -->
                    <?php
                    if (isset($_GET['neew'])) {
                    ?>
                        <div class="col-xl-12 ">
                            <h4 class="text-center">Chosir l'hopital</h4>
                            <form action="../models/add/add-bon.php?ben=<?=$_GET['matricule']?>" method="POST" class="shadow p-3" enctype="multipart/form-data">
                                <div class="row">
                                    
                                   
                              
                                   

                                   
                                    <div class="col-xl-12 col-lg-12 col-md-12  col-sm-12 p-3">
                                        <label for="">Hopital(Fosa)<span class="text-danger">*</span></label>
                                        <select required name="fosa" id="" class="form-control select2">
                                          <?php 
                                      $req = $connexion->prepare("SELECT * from fosa WHERE supprimer!=1");
                                      $req->execute();
                                      while ($fos= $req->fetch()) {
                                          ?>
                                          <option value="<?php echo $fos['id'] ?>">
                                          <?php echo $fos['desingation'] ?>
                                          </option>
                                      <?php }
                                       ?>
                                        </select>
                                    </div>
                                   
                                    <div class="col-xl-12 col-lg-12 col-md-12 mt-10 col-sm-12 p-3 aling-center">
                                        <button class="btn btn-success w-100" name="valider">Enregistrer et imprimer</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    
                    <?php   } else  if (isset($_GET['new'])) {
                    ?>
                        <div class="col-xl-12 ">
                            <h4 class="text-center">Choisir le beneficiaire</h4>
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12  col-sm-12 p-3">
                                     <label for=""></span></label>
                                     <a href="bon.php?fin"><input type="buttom" class="btn btn-primary w-100" name="annuler " value="Annuler l'operation"></a>
                                </div>
                                            
                                <div class="col-xl-12 col-lg-12  p-3">
                                    <form class="search-form d-flex row "   method="get">
                                        <input class="col-xl-10 col-lg-10 col-md-10  col-sm-10 p-3 m-1" required autocomplete="off" type="text" name="search" placeholder="Rechercher avec le nom ou le matricule du beneficiaire" title="">
                                        <input hidden type="text" name="new">
                                        <button class="col-xl-1 col-lg-1 col-md-1  col-sm-1 p-3 m-1 btn btn-success" type="submit" title="Search"><i class="bi bi-search "></i></button>
                                        <?php if(isset($_GET['search'])){ ?>
                                            <div class="col-xl-12 col-lg-12 col-md-12  col-sm-12">
                                                <a href="bon.php?new"><input  class="btn btn-primary "type="button" value="Voir tout"></a>
                                            </div>
                                        <?php } ?>
                                    </form>
                                </div>
                                <?php
                                 $nb=0;
                                
                                 while($beneficiaire= $selben->fetch()){
                                 $nb++;
                                 ?>
                                        <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6  ">
                                            <a class=" btn btn-white shadow m-3 w-100" href="bon.php?neew&matricule=<?=$beneficiaire['matricule']?>">
                                                <div class=row>
                                                    <div class="col-3 ">
                                                        <img src="../photo/<?=$beneficiaire['photo']?>" alt="profil" class="rounded-circle"  width="100" height="100" >
                                                    </div>
                                                    <div class="col-9">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <b>Matricule : </b><?=$beneficiaire['matricule']?>
                                                            </div>
                                                            <div class="col-12">
                                                                <b>Noms : </b><?=$beneficiaire['nom'].' '.$beneficiaire['postnom'].' '.$beneficiaire['prenom']?>
                                                            </div>
                                                            <div class="col-12">
                                                                <b>telephone : </b> <?=$beneficiaire['tel']?>
                                                            </div>
                                                                        
                                                                        
                                                        </div>
                                                                        
                                                    </div>
                                              </div>
                                            </a>
                                    </div>
                                    
                                 <?php } ?> 
                                <div class="col-12">
                                     <?php if($nb==0){ ?>
                                            <center><?=$message?></center>
                                        <?php } ?> 

                                </div>
                                       
                            </div>
                        </div>
                    
                    
                   <?php
                    } else {
                    ?>
                        <div class="col-xl-12 mb-3 mt-3 ">
                            <a href="bon.php?new" class="btn btn-success w-100">accorder un bon</a>
                        </div>
                    <?php
                    }
                    ?>

                    <!-- La table qui affiche les données  -->
                    <div class="col-xl-12 table-responsive px-3 mt-3">
                        <table class='table table-hover' id="table1">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Date</th>
                                    <th>Matricule | noms</th>
                                    <th>fosa</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $n = 0;
                                $req = $connexion->prepare("SELECT beneficiaire.*,fosa.desingation,bonsoin.dates,bonsoin.id as idb,user.username from beneficiaire,fosa,bonsoin,user where bonsoin.matricule=beneficiaire.matricule and bonsoin.fosa=fosa.id and bonsoin.utilisateur=user.id and bonsoin.supprimer=0");
                                $req->execute();
                                while ($data = $req->fetch()) {
                                    $n++;
                                ?>
                                    <tr>
                                        <td><?= $n; ?></td>
                                        <td><?php $dates=strtotime($data["dates"]); echo date('d/m/Y',$dates);?></td>
                                        <td><?= $data["matricule"]." |   ".$data["nom"] . " " . $data["postnom"] . " " . $data["prenom"]?></td>
                                        <td><?=$data['desingation']?></td>
                                        <td>
                                            
                                            <a href="beneficiaire.php?idtit=<?= $data['idb'] ?>" class="btn btn-info btn-sm mt-1">
                                                <i class="bi bi-printer-fill"></i>
                                            </a>

                                            <a onclick=" return confirm('Voulez-vous vraiment supprimer ?')" href="../models/delete/del-bon.php?idSup=<?=$data['idb'] ?>" class="btn btn-danger btn-sm mt-1">
                                                <i class="bi bi-trash-fill"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php require_once('footer.php') ?>
        </div>
    </div>

    <?php require_once('script.php') ?>
</body>

</html>