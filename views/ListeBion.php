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
                    if (isset($_GET['idBon'])) {
                        $id = $_GET['idBon'];
                    ?>
                        <div class="col-xl-12 ">
                            <form action="<?= $action ?>" method="POST" class="shadow p-3 mt-3" enctype="multipart/form-data">
                                <h4 class="text-center"><?= $titre ?></h4>
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                        <?php
                                        if (isset($_GET['idBon'])) {
                                        ?>
                                            <h6 class="text-center">Membre : <?= $select["nom"] . " " . $select["postnom"] . " " . $select["prenom"]  ?></h6>
                                            <div class="text-center">
                                                <img src="../photo/<?= $select["photo"] ?>" class="rounded-circle mt-2 text-center" width="85px" height="85px">
                                            </div>
                                            <h6 class="text-center">Matricule : <?= $select["maticule"] ?></h6>
                                            <div class="matricule">
                                                <input required type="text" name="matricule" hidden class="form-control" value="<?= $select["maticule"] ?>">
                                            </div>

                                        <?php

                                        } else {
                                            $getMembre = $connexion->prepare("SELECT  membre.`matricule`, membre.`nom`, membre.`postnom`,membre.`prenom`, membre.`photo`FROM `membre` WHERE membre.matricule=?");
                                            $getMembre->execute([$matricule]);
                                            while ($membre = $getMembre->fetch()) {
                                                ?>
                                                    <h6 class="text-center">Membre : <?= $membre["nom"] . " " . $membre["postnom"] . " " . $membre["prenom"]  ?></h6>
                                                    <div class="text-center">
                                                        <img src="../photo/<?= $membre["photo"] ?>" class="rounded-circle mt-2 text-center" width="85px" height="85px">
                                                    </div>
                                                    <h6 class="text-center">Matricule : <?= $membre["matricule"] ?></h6>
                                                    <div class="matricule">
                                                        <input required type="text" name="matricule" hidden class="form-control" value="<?= $membre["matricule"] ?>">
                                                    </div>
                                                <?php
                                            }
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
                                                $fosaa = $select['fosa'];
                                                if (isset($_GET['idBon'])) {
                                                    ?>
                                                        <option <?php if ($fosa['id'] == $fosaa) { ?> Selected <?php } ?> value="<?php echo $fosa['id']; ?>">
                                                            <?php echo  $fosa['desingation'] ?>
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
                                        <a href="<?= $Annuler?>" class="btn btn-danger w-100">Annuler</a>
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
                            <h4 class="text-center">Liste de bons de soin de santé</h4>
                            <table class='table table-hover' id="table-1">
                                <thead>
                                    <tr>
                                        <th>N°</th>
                                        <th>Date</th>
                                        <th>Identité du membre</th>
                                        <th>Photo </th>
                                        <th>Fosa</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $n = 0;
                                    $supp = 0;
                                    $req = $connexion->prepare("SELECT `bonsoin`.*,membre.nom,membre.postnom,membre.prenom,membre.photo,fosa.desingation FROM `bonsoin`,membre,fosa WHERE bonsoin.fosa=fosa.id AND bonsoin.maticule=membre.matricule AND bonsoin.supprimer=?;");
                                    $req->execute([$supp]);
                                    while ($bonSoin = $req->fetch()) {
                                        $n++;
                                    ?>
                                        <tr>
                                            <td><?= $n; ?></td>
                                            <td><?= $bonSoin["date"] ?></td>
                                            <td><?= $bonSoin["nom"] . " " . $bonSoin["postnom"] . " " . $bonSoin["prenom"] ?></td>
                                            <td> <img src="../photo/<?= $bonSoin["photo"] ?>" class="rounded-circle mt-2" width="75px" height="75px"></td>
                                            <td><?= $bonSoin["desingation"] ?></td>
                                            <td>
                                                <a href="ListeBion.php?idBon=<?= $bonSoin['id'] ?>" class="btn btn-success btn-sm">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                <a href="beneficiaire.php?idtit=<?= $bonSoin['id'] ?>" class="btn btn-info btn-sm ">
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