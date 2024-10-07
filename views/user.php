<?php
# Se connecter à la BD
include '../connexion/connexion.php';
# Appel du script de selection 
require_once('../models/select/select-Users.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Users</title>
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
                        <h4 class="text-white">Utilisateurs</h4>
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
                    if (isset($_GET['AjoutUser'])) {
                    ?>
                        <div class="col-xl-12 mt-3">
                        <form action="<?= $url ?>" method="POST" class="shadow p-3" enctype="multipart/form-data">
                                <h4 class="text-center"><?= $title ?></h4>
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                        <label for="">Nom <span class="text-danger">*</span></label>
                                        <input required type="text" class="form-control" placeholder="Entrez le nom"name="nom" <?php if (isset($_GET["iduser"])) { ?>value="<?= $select["nom"]; ?>" <?php } ?>>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                        <label for="">Postnom <span class="text-danger">*</span></label>
                                        <input required type="text" class="form-control" placeholder="Entrez le postnom"name="postnom" <?php if (isset($_GET["iduser"])) { ?>value="<?= $select["postnom"]; ?>" <?php } ?>>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                        <label for="">Genre <span class="text-danger">*</span></label>
                                        <select required id="" name="genre" class="form-control select2">
                                        <?php 
                                    if(isset($_GET['iduser'])){ 
                                        ?>
                                            
                                              <?php if($select['genre']=='Masculin')
                                              {?> 
                                               <option value="Masculin" Selected>Masculin</option>
                                               <option value="Feminin">Feminin</option>


                                    <?php     }
                                        else {
                                              ?>  
                                            <option value="Masculin" >Masculin</option>
                                            <option value="Feminin" Selected>Feminin</option>

                                        <?php }
                                    }else{ 
                                        ?>
                                            <option value="" desabled>Choisir un genre</option>
                                            <option value="Masculin">Masculin</option>
                                            <option value="Feminin">Feminin</option>
                                        <?php  
                                    } 
                                ?>

                                        </select>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                        <label for="">Fonction <span class="text-danger">*</span></label>
                                        <select required name="fonction" id="" class="form-control select2">
                                       
                                            <option value="">Choisir la fonction</option>
                                            <option value="Admin">Admin</option>
                                            <option value="Secretaire">Secretaire</option>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                        <label for="">Numero de telephone<span class="text-danger">*</span></label>
                                        <input required type="text" class="form-control" placeholder="EX: +243997019883"name="tel"
                                                <?php if (isset($_GET["iduser"])) { ?>value="<?= $select["tel"]; ?>" <?php } ?>>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                        <label for="">Adresse <span class="text-danger">*</span></label>
                                        <input required type="text" class="form-control" placeholder="Adresse" name="adresse"
                                                <?php if (isset($_GET["iduser"])) { ?>value="<?= $select["adresse"]; ?>"
                                                <?php } ?>>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                        <label for="">Mot de passe <span class="text-danger">*</span></label>
                                        <input required type="password" class="form-control" placeholder="Entrez le mot de pass" name="pwd">
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                        <label for="">Profil <span class="text-danger">*</span></label>
                                        <input required type="file" class="form-control" name="photo"<?php if (isset($_GET["iduser"])) { ?>
                                            value=<?php echo $select['photo']; ?> <?php } ?>>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-12 mt-4 col-sm-6 p-3">
                                    <button class="btn btn-success w-100" name="valider"><?=  $btn ?></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="col-xl-12 mb-3 mt-3 ">
                            <a href="user.php?AjoutUser" class="btn btn-success w-100">Ajouter un Utilisateur</a>
                        </div>
                    <?php
                    }
                    ?>

                    <!-- La table qui affiche les données  -->
                    <div class="col-xl-12 table-responsive px-3 mt-3">
                        <h3 class="text-center pt-3">Liste des Utilisateurs</h3>
                        <table class='table table-hover' id="table1">
                            <thead>
                                <tr>
                                    <th>Num</th>
                                    <th>Noms </th>
                                    <th>Genre</th>
                                    <th>Tel</th>
                                    <th>Adresse</th>
                                    <th>User Name</th>
                                    <th>Pwd</th>
                                    <th>Fonction</th>
                                    <th>Profil</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $n = 0;
                                $req = $connexion->prepare("SELECT * FROM `user` WHERE  supprimer=0");
                                $req->execute();
                                while ($user = $req->fetch()) {
                                    $n++;
                                ?>
                                    <tr>
                                        <td><?= $n; ?></td>
                                        <td><?= $user["nom"] . " " . $user["postnom"] ?></td>
                                        <td><?= $user["genre"] ?></td>
                                        <td><?= $user["tel"] ?></td>
                                        <td><?= $user["adresse"] ?></td>
                                        <td><?= $user["username"] ?></td>
                                        <td><?= $user["pwd"] ?></td>
                                        <td><?= $user["fonction"] ?></td>
                                        <td> <img src="../photo/<?= $user["photo"] ?>" class="rounded-circle mt-2" width="65px" height="60px"></td>
                                        <td><?= $user["date"] ?></td>
                                        <td>
                                            <a href="user.php?AjoutUser&iduser=<?= $user['id'] ?>" class="btn btn-success btn-sm">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <a href="../models/delete/del-user-post.php?idSup=<?=$user['id'] ?>" class="btn btn-danger btn-sm mt-1">
                                                <i class="bi bi-trash-fill"></i>
                                            </a>
                                        </td>
                                    </tr>
                            </tbody>
                        <?php
                                }
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