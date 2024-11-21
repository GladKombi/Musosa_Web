<?php
include '../connexion/connexion.php';
require_once("../models/select/select-BonSoin.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Bon de soin</title>
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
                        <h4 class="text-white">Bon de soin de santé</h4>
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
                    if (isset($_GET['AddBon']) && !empty($_GET['idcompte'])) {
                        $matricule = $_GET['idcompte'];
                    ?>
                        <div class="col-xl-12 ">                            
                            <form action="<?= $action ?>" method="POST" class="shadow p-3" enctype="multipart/form-data">
                            <h4 class="text-center"><?= $titre ?></h4>
                            <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                        <?php
                                        $getMembre = $connexion->prepare("SELECT  membre.`matricule`, membre.`nom`, membre.`postnom`,membre.`prenom`, membre.`photo`FROM `membre` WHERE membre.matricule=?");
                                        $getMembre->execute([$matricule]);
                                        while ($membre = $getMembre->fetch()) {
                                        ?>
                                            <h6 class="text-center">Membre : <?= $membre["nom"]." ".$membre["postnom"]." ".$membre["prenom"]  ?></h6>
                                            <div class="text-center">
                                                <img src="../photo/<?= $membre["photo"] ?>" class="rounded-circle mt-2 text-center" width="85px" height="85px">
                                            </div>
                                            <h6 class="text-center">Matricule : <?= $membre["matricule"] ?></h6>
                                            <div class="matricule">
                                            <input required type="text" name="matricule" hidden class="form-control" value="<?= $membre["matricule"] ?>">
                                            </div>
                                            
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                        <label for="">Fosa <span class="text-danger">*</span></label>
                                        <select required id="" name="fosa" class="form-control select2">
                                            <?php
                                            $supprimer = 0;
                                            $getFosa = $connexion->prepare("SELECT * FROM `fosa` WHERE supprimer=?");
                                            $getFosa->execute([$supprimer]);
                                            $fosa = "";
                                            while ($fosa = $getFosa->fetch()) {
                                                $fosaa = $tab['id'];
                                                if (isset($_GET['idAffectation'])) {
                                            ?>
                                                    <option <?php if ($fosa['id'] == $fosaa) { ?> Selected <?php } ?> value="<?php echo $fosaa['id']; ?>">
                                                        <?php echo  $fosaa['desingation'] ?>
                                                    </option>
                                                <?php } else {
                                                ?>
                                                    <option value="<?php echo $fosa['id']; ?>">
                                                        <?php echo  $fosa['desingation'] ?>
                                                    </option>
                                            <?php }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 mt-10 col-sm-6 p-3 aling-center">
                                        <a href="BonSoin.php" class="btn btn-danger w-100">Annuler</a>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 mt-10 col-sm-6 p-3 aling-center">
                                        <button class="btn btn-success w-100" name="Valider"><?= $bouton ?></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    <?php
                    } else {
                    ?>
                        <!-- La table qui affiche les données de membre  -->
                        <div class="col-xl-12 table-responsive px-3 mt-3">
                            <h4 class="text-center">Liste de membre</h4>
                            <table class='table table-hover' id="table-1">
                                <thead>
                                    <tr>
                                        <th>N°</th>
                                        <th>Matricule</th>
                                        <th>Noms </th>
                                        <th>Genre</th>
                                        <th>Tel</th>
                                        <th>Adresse</th>
                                        <th>Profil</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $n = 0;
                                    $req = $connexion->prepare("SELECT  membre.`matricule`, membre.`nom`, membre.`postnom`,membre.`prenom`, membre.`genre`, membre.`tel`, membre.`adresse`, membre.`paroisse`, membre.`zonesante`, membre.`etatcivil`, coorporation.desingation AS coorporation, 
                                membre.`lieunaissance`, membre.`datenaissance`, membre.`photo`, membre.`date`, membre.`supprimer` FROM `membre`,coorporation WHERE membre.coorporation=coorporation.id AND membre.supprimer=0");
                                    $req->execute();
                                    while ($compte = $req->fetch()) {
                                        $n++;
                                    ?>
                                        <tr>
                                            <td><?= $n; ?></td>
                                            <td><?= $compte["matricule"] ?></td>
                                            <td><?= $compte["nom"] . " " . $compte["postnom"] . " " . $compte["prenom"] ?></td>
                                            <td><?= $compte["genre"] ?></td>
                                            <td><?= $compte["tel"] ?></td>
                                            <td><?= $compte["adresse"] ?></td>
                                            <td> <img src="../photo/<?= $compte["photo"] ?>" class="rounded-circle mt-2" width="50px" height="50px"></td>

                                            <td>
                                                <a href="BonSoin.php?AddBon&idcompte=<?= $compte['matricule'] ?>" class="btn btn-success btn-sm">
                                                    <i class="bi bi-pencil-square"></i>Bon
                                                </a>
                                                <a href="beneficiaire.php?idtit=<?= $compte['matricule'] ?>" class="btn btn-info btn-sm mt-1">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    <?php
                    }
                    ?>


                </div>
            </div>
            <?php require_once('footer.php') ?>
        </div>
    </div>

    <?php require_once('script.php') ?>
</body>

</html>