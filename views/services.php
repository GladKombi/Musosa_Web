<?php
# Se connecter à la BD
include '../connexion/connexion.php';
# Appel du script de selection 
require_once('../models/select/select-services.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Services</title>
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
                        <h4 class="text-white">Les Services</h4>
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
                    if (isset($_GET['AjoutServic'])) {
                    ?>
                        <div class="col-xl-12 mt-3">
                            <form action="<?= $url ?>" method="POST" class="shadow p-3" enctype="multipart/form-data">
                                <h4 class="text-center"><?= $title ?></h4>
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                        <label for="">Designation<span class="text-danger">*</span></label>
                                        <input required type="text" name="desingation" class="form-control" placeholder="Entrez le montant à payer">
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                        <label for="">Tarification plafond<span class="text-danger">*</span></label>
                                        <input required type="text" name="tarif" class="form-control" placeholder="Entrez le arif plafond">
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                        <label for="">Part de la Musosa<span class="text-danger">*</span></label>
                                        <input required type="text" name="partMuso" class="form-control" placeholder="Entrez le pourcentage de la part">
                                    </div>

                                    <div class="col-xl-12 col-lg-12 col-md-12 mt-10 col-sm-12 p-3 aling-center">
                                        <input type="submit" name="Valider" class="btn btn-success w-100" value="<?= $btn ?>">
                                    </div>
                                </div>
                            </form>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="col-xl-12 mb-3 mt-3 ">
                            <a href="services.php?AjoutServic" class="btn btn-success w-100">Ajouter un nouveau service</a>
                        </div>
                    <?php
                    }
                    ?>

                    <!-- La table qui affiche les données  -->
                    <div class="col-xl-12 table-responsive px-3 mt-3">
                        <h3 class="text-center pt-3">Liste des prestations enregistrées</h3>
                        <table class='table table-hover' id="table1">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Service</th>
                                    <th>Tarif Plafond</th>
                                    <th>Part Musosa</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $n = 0;
                                while ($service = $req->fetch()) {
                                    $n++;
                                ?>
                                    <tr>
                                        <td><?= $n; ?></td>
                                        <td><?= $service["desingation"] ?></td>
                                        <td><?= $service["tarifplafond"] ?> $</td>
                                        <td><?= $service["partmusosa"] ?> $</td>
                                        <td>
                                            <a href="" class="btn btn-success btn-sm">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <a onclick=" return confirm('Voulez-vous vraiment supprimer ?')" href="" class="btn btn-danger btn-sm mt-1">
                                                <i class="bi bi-trash-fill"></i>
                                            </a>
                                        </td>
                                    </tr>
                            </tbody>
                        <?php
                                }
                        ?>
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