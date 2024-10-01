<?php
include '../connexion/connexion.php'; //Se connecter à la BD
require_once('../models/select/select-compte.php'); //Appel du script de selection
require_once('../fonction/function.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Tutilaire</title>
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
                        <h4 class="text-white">Comptes</h4>
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
                    if (isset($_GET['AjoutCompt'])) {
                    ?>
                        <div class="col-xl-12 ">
                            <h4 class="text-center"><?= $title ?></h4>
                            <form action="<?= $url ?>" method="POST" class="shadow p-3" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                        <label for="">Nom <span class="text-danger">*</span></label>
                                        <input required type="text" name="nom" class="form-control" placeholder="Entrez le nom" <?php if (isset($_GET['idCompte'])) { ?>
                                            value=<?php echo $tab['nom']; ?> <?php } ?>>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                        <label for="">Postnom <span class="text-danger">*</span></label>
                                        <input required type="text" name="postnom" class="form-control" placeholder="Entrez le postnom" <?php if (isset($_GET['idCompte'])) { ?>
                                            value=<?php echo $tab['postnom']; ?> <?php } ?>>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                        <label for="">Prenom <span class="text-danger">*</span></label>
                                        <input required type="text" name="prenom" class="form-control" placeholder="Entrez le prenom" <?php if (isset($_GET['idCompte'])) { ?>
                                            value=<?php echo $tab['prenom']; ?> <?php } ?>>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                        <label for="">Genre <span class="text-danger">*</span></label>
                                        <select required id="" name="genre" class="form-control select2">
                                            <?php if (isset($_GET['idCompte'])) {
                                                $genre = $tab['genre'];
                                            ?>
                                                <option value="Masculin">Masculin</option>
                                                <option <?php if ($genre == "Feminin") { ?> Selected <?php } ?>value="Feminin">Feminin</option>
                                            <?php
                                            } else {
                                            ?>
                                                <option desabled>Choisir un genre</option>
                                                <option value="Masculin">Masculin</option>
                                                <option value="Feminin">Feminin</option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                        <label for="">Etat Civile <span class="text-danger">*</span></label>
                                        <select required id="" name="etatCivil" class="form-control select2">
                                            <?php if (isset($_GET['idCompte'])) {
                                                $genre = $tab['genre'];
                                            ?>
                                                <option value="Celibataire">Celibataire</option>
                                                <option <?php if ($genre == "Marie") { ?> Selected <?php } ?>value="Feminin">Feminin</option>
                                            <?php
                                            } else {
                                            ?>
                                                <option value="Celibataire">Masculin</option>
                                                <option value="Marie">Marié(e)</option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                        <label for="">Corporation <span class="text-danger">*</span></label>
                                        <select required name="enfant" id="" class="form-control select2">
                                            <?php
                                            $rep->execute([$statut]);
                                            while ($Coorp = $rep->fetch()) {
                                            ?>
                                                <option value="<?php echo $Coorp['id']; ?>">
                                                    <?php echo  $Coorp['desingation']; ?>
                                                </option>
                                            <?php }

                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                        <label for="">Date de naissance <span class="text-danger">*</span></label>
                                        <input required type="Date" name="DateNaissance" class="form-control" <?php if (isset($_GET['idCompte'])) { ?>
                                            value=<?php echo $tab['age']; ?> <?php } ?>>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                        <label for="">Lieu de naissance <span class="text-danger">*</span></label>
                                        <input required type="text" name="lieuNais" class="form-control" placeholder="Entrez le prenom" <?php if (isset($_GET['idCompte'])) { ?>
                                            value=<?php echo $tab['lieu']; ?> <?php } ?>>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                        <label for="">Profil du membre <span class="text-danger">*</span></label>
                                        <input required type="file" name="photo" class="form-control" placeholder="Choisir la photo de l'eleve" <?php if (isset($_GET['idCompte'])) { ?>
                                            value=<?php echo $tab['photo']; ?> <?php } ?>>
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
                            <a href="compte.php?AjoutCompt" class="btn btn-success w-100">Ajouter nouveau un Compte</a>
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
                                    <th>Matricule</th>
                                    <th>Noms </th>
                                    <th>Genre</th>
                                    <th>Tel</th>
                                    <th>Adresse</th>
                                    <th>Etat Civil</th>
                                    <th>Coorporation</th>
                                    <th>Lieu naissance</th>
                                    <th>Date naissance</th>
                                    <th>Profil</th>
                                    <th>Date</th>
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
                                        <td><?= $compte["genre"] ?></td>
                                        <td><?= $compte["tel"] ?></td>
                                        <td><?= $compte["adresse"] ?></td>
                                        <td><?= $compte["etatcivil"] ?></td>
                                        <td><?= $compte["coorporation"] ?></td>
                                        <td><?= $compte["lieunaissance"] ?></td>
                                        <td><?= $compte["datenaissance"] ?></td>
                                        <td> <img src="../photo/<?= $compte["photo"] ?>" class="rounded-circle mt-2" width="75px" height="70px"></td>
                                        <td><?= $compte["date"] ?></td>
                                        <td>
                                            <a href="compte.php?idcompte=<?= $compte['matricule'] ?>" class="btn btn-success btn-sm">
                                                <i class="bi bi-pencil-square"></i>
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
                </div>
            </div>
            <?php require_once('footer.php') ?>
        </div>
    </div>

    <?php require_once('script.php') ?>
</body>

</html>