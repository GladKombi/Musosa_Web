<?php
# Se connecter à la BD
include '../connexion/connexion.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Cotisation</title>
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
                        <h4 class="text-white">Cotisations</h4>
                    </div>
                    <!-- pour afficher les massage  -->

                    <?php
                    if (isset($_GET["idcot"])) {
                        if (isset($_SESSION['msg']) && !empty($_SESSION['msg'])) { ?>
                            <div class="col-xl-12 mt-3">
                                <div class="alert-info alert text-center"><?= $_SESSION['msg'] ?></div>
                            </div>
                        <?php }
                        #Cette ligne permet de vider la valeur qui se trouve dans la session message
                        unset($_SESSION['msg']);
                        ?>
                        <!-- Le formulaire pour entreer une nouvelle cotisation du membres -->
                        <div class="col-xl-12 mt-3">                            
                            <form action="" method="POST" class="shadow p-3">
                            <h4 class="text-center">Nouvelle cotisation</h4>
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12 col-md-6  col-sm-6 p-3">
                                        <label for="">Montant<span class="text-danger">*</span></label>
                                        <input required type="text" name="desingation" class="form-control" placeholder="Entrez le montant">
                                    </div>
                                                                       
                                    <div class="col-xl-12 col-lg-12 col-md-12 mt-10 col-sm-12 p-3 aling-center">
                                        <input type="submit" name="Valider" class="btn btn-success w-100" value="Enregistrer">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- La table qui affiche les differentes cotisation du membres -->
                        <div class="col-xl-12 table-responsive px-3 mt-3">
                            <table class='table table-hover' id="table1">
                                <thead>
                                    <tr>
                                        <th>N°</th>
                                        <th>Matricule</th>
                                        <th>Noms </th>
                                        <th>Genre</th>
                                        <th>Montant Payer</th>
                                        <th>Annee</th>
                                        <th>Date Paiement</th>
                                        <th>Profil</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $titulaire = $_GET["idcot"];
                                    $n = 0;
                                    $req = $connexion->prepare("SELECT cotisation.`id`, cotisation.`matBeneficiaire`, beneficiaire.nom,beneficiaire.postnom,beneficiaire.genre, cotisation.`montant`, cotisation.`anneeprestation`, cotisation.date,beneficiaire.photo  FROM `cotisation`,beneficiaire WHERE cotisation.`supprimer`=0 and beneficiaire.matricule=cotisation.matBeneficiaire AND cotisation.matTitilaire=? ORDER BY matricule ASC");
                                    $req->execute(array($titulaire));
                                    while ($ben = $req->fetch()) {
                                        $n++;
                                    ?>
                                        <tr>
                                            <td><?= $n; ?></td>
                                            <td><?= $ben["matBeneficiaire"] ?></td>
                                            <td><?= $ben["nom"] . " " . $ben["postnom"] ?></td>
                                            <td><?= $ben["genre"] ?></td>
                                            <td><?= $ben["montant"] ?></td>
                                            <td><?= $ben["anneeprestation"] ?></td>
                                            <td><?= $ben["date"] ?></td>
                                            <td><img src="../photo/<?= $ben["photo"] ?>" class="rounded-circle mt-2" width="65px" height="60px"></td>
                                        </tr>
                                    <?php }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="col-xl-12 mb-3 mt-3 ">
                            <a href="#" class="btn btn-success w-100">Choisir un membre dans le tableaux</a>
                        </div>

                        <!-- La table qui affiche les données  -->
                        <div class="col-xl-12 table-responsive px-3 mt-3">
                            <table class='table table-hover' id="table1">
                                <thead>
                                    <tr>
                                        <th>N°</th>
                                        <th>Matricule</th>
                                        <th>Noms </th>
                                        <th>Tel</th>
                                        <th>Coorporation</th>
                                        <th>Profil</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>                                
                                <tbody>
                                    <?php
                                    $n = 0;
                                    $req = $connexion->prepare("SELECT  membre.`matricule`, membre.`nom`, membre.`postnom`, membre.`genre`, membre.`tel`, membre.`adresse`, membre.`etatcivil`, coorporation.desingation AS coorporation, 
                                membre.`lieunaissance`, membre.`datenaissance`, membre.`photo`, membre.`date`, membre.`supprimer` FROM `membre`,coorporation WHERE membre.coorporation=coorporation.id AND membre.supprimer=0");
                                    $req->execute();
                                    while ($compte = $req->fetch()) {
                                        $n++;
                                    ?>
                                        <tr>
                                            <td><?= $n; ?></td>
                                            <td><?= $compte["matricule"] ?></td>
                                            <td><?= $compte["nom"] . " " . $compte["postnom"] ?></td>
                                            <td><?= $compte["tel"] ?></td>
                                            <td><?= $compte["coorporation"] ?></td>
                                            <td> <img src="../photo/<?= $compte["photo"] ?>" class="rounded-circle mt-2" width="50px" height="50px"></td>

                                            <td>
                                                <a href="cotisation.php?idcot=<?= $compte['matricule'] ?>" class="btn btn-success btn-sm">
                                                    <i class="bi bi-calculator"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    <?php
                    } ?>



                </div>
            </div>
            <?php require_once('footer.php') ?>
        </div>
    </div>

    <?php require_once('script.php') ?>
</body>

</html>