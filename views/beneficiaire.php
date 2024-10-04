<?php
include '../connexion/connexion.php';
require_once ("../models/select/select-beneficiaire.php");
require_once('../fonction/function.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>beneficiaire</title>
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
                        <h4 class="text-white">Beneficiaire</h4>
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
                    if (isset($_GET['AjoutBen'])) {
                        $idtitulaire = $_GET["idtit"];
                    ?>
                        <div class="col-xl-12 ">
                            <h4 class="text-center"><?= $titre?></h4>
                            <form action="<?= $action ?>" method="POST" class="shadow p-3" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                        <label for="">Nom <span class="text-danger">*</span></label>
                                        <input required type="text" class="form-control" placeholder="Entrez le nom"  name="nom" <?php if (isset($_GET["idben"])) { ?>value="<?= $select["nom"]; ?>" <?php } ?>>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                        <label for="">Postnom <span class="text-danger">*</span></label>
                                        <input required type="text" class="form-control" placeholder="Entrez le postnom"  name="postnom" <?php if (isset($_GET["idben"])) { ?>value="<?= $select["postnom"]; ?>" <?php } ?>>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                        <label for="">Prenom <span class="text-danger">*</span></label>
                                        <input required type="text" class="form-control" placeholder="Entrez le prenom" name="prenom" <?php if (isset($_GET["idben"])) { ?>value="<?= $select["prenom"]; ?>" <?php } ?>>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                        <label for="">Genre <span class="text-danger">*</span></label>
                                        <select required id="" name="genre" class="form-control select2">
                                        <?php 
                                    if(isset($_GET["idben"])){ 
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
                                        <label for="">Num Tél <span class="text-danger">*</span></label>
                                        <input required type="text" class="form-control" placeholder="Entrez le Num Tél" name="tel"
                                                <?php if (isset($_GET["idben"])) { ?>value="<?= $select["tel"]; ?>" <?php } ?>>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                        <label for="">Adresse <span class="text-danger">*</span></label>
                                        <input required type="text" class="form-control" placeholder="Adresse" name="adresse"
                                                <?php if (isset($_GET["idben"])) { ?>value="<?= $select["adresse"]; ?>"
                                                <?php } ?>>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                        <label for="">Etat Civile <span class="text-danger">*</span></label>
                                        <select required id="" name="etatcivil" class="form-control select2">
                                            <?php if (isset($_GET["idben"])) {
                                                $genre = $tab['genre'];
                                            ?>
                                                <option value="Celibataire">Celibataire</option>
                                                <option <?php if ($genre == "Marie") { ?> Selected <?php } ?>value="Marie">Marié(e)</option>
                                            <?php
                                            } else {
                                            ?>
                                                <option value="Celibataire">Celibataire</option>
                                                <option value="Marie">Marié(e)</option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                        <label for="">Lien <span class="text-danger">*</span></label>
                                        <select required name="lien" id="" class="form-control select2">
                                        <?php if (isset($_GET["idben"])) {
                                                $genre = $tab['genre'];
                                            ?>
                                                <option value="Epoux">Epoux(se)</option>
                                                <option <?php if ($genre == "Enfant") { ?> Selected <?php } ?>value="Enfant">Enfant</option>
                                            <?php
                                            } else {
                                            ?>
                                                <option value="Epoux">Epoux(se)</option>
                                                <option value="Enfant">Enfant</option>
                                                <option value="Tante">Tante</option>
                                                <option value="Autre">Autre</option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                        <label for="">Date de naissance <span class="text-danger">*</span></label>
                                        <input required type="Date"  class="form-control" placeholder="date..."
                                                name="datenaissance" <?php if (isset($_GET["idben"])) { ?>value="<?= $select["datenaissance"]; ?>" <?php } ?>>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                        <label for="">Lieu de naissance <span class="text-danger">*</span></label>
                                        <input required type="text" class="form-control"placeholder="lieu..."
                                                name="lieunaissance" <?php if (isset($_GET["idben"])) { ?>value="<?= $select["lieunaissance"]; ?>" <?php } ?>>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                        <label for="">Profil du membre <span class="text-danger">*</span></label>
                                        <input required type="file" name="photo" class="form-control"<?php if (isset($_GET["idben"])) { ?>
                                            value=<?php echo $select['photo']; ?> <?php } ?>>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-12 mt-10 col-sm-12 p-3 aling-center">
                                        <button class="btn btn-success w-100" name="valider"><?= $bouton ?></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <?php
                    } else {
                    ?>
                        <div class="col-xl-12 mb-3 mt-3 ">
                            <a href="beneficiaire.php?AjoutBen&idtit=<?=$idtitulaire?>" class="btn btn-success w-100">Ajouter un Béneficiaire</a>
                        </div>
                    <?php
                    }
                    ?>

                    <!-- La table qui affiche les données  -->
                    <div class="col-xl-12 table-responsive px-3 mt-3">
                        <table class='table table-hover' id="table1">
                        <thead>
                                    <tr>
                                        <th>Num</th>
                                        <th>Matricule</th>
                                        <th>Noms </th>
                                        <th>Genre</th>
                                        <th>Tel</th>
                                        <th>Adresse</th>
                                        <th>Etat Civil</th>
                                        <th>Lien</th>
                                        <th>Lieu naissance</th>
                                        <th>Date naissance</th>
                                        <th>Profil</th>
                                        <th>Titulaire</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $titulaire = $_GET["idtit"];
                                    $n = 0;
                                    $req = $connexion->prepare("SELECT beneficiaire.`matricule`,beneficiaire.`nom`, beneficiaire.`postnom`,beneficiaire.prenom, beneficiaire.`genre`, beneficiaire.`tel`, beneficiaire.`adresse`, beneficiaire.`etatcivil`,
                                      beneficiaire.`lien`, beneficiaire.`lieunaissance`, beneficiaire.`datenaissance`, beneficiaire.`photo`, membre.matricule AS mattitulaire,membre.nom as nomtit,membre.postnom as posttit, beneficiaire.`date`, beneficiaire.`supprimer` FROM `beneficiaire`,membre WHERE beneficiaire.titulaire=membre.matricule and beneficiaire.titulaire=? and beneficiaire.supprimer=0 ORDER BY matricule ASC");
                                    $req->execute([$titulaire]);
                                    while ($ben = $req->fetch()) {
                                        $n++;
                                        ?>
                                        <tr>
                                            <td><?= $n; ?></td>
                                            <td><?= $ben["matricule"] ?></td>
                                            <td><?= $ben["nom"] . " " . $ben["postnom"] . " " . $ben["prenom"] ?></td>
                                            <td><?= $ben["genre"] ?></td>
                                            <td><?= $ben["tel"] ?></td>
                                            <td><?= $ben["adresse"] ?></td>
                                            <td><?= $ben["etatcivil"] ?></td>
                                            <td><?= $ben["lien"] ?></td>
                                            <td><?= $ben["lieunaissance"] ?></td>
                                            <td><?= $ben["datenaissance"] ?></td>
                                            <td><img src="../photo/<?= $ben["photo"] ?>" width='45' height="45" style="object-fit: cover;"></td>
                                            <td><?= $ben["mattitulaire"] . " " . $ben["nomtit"] . " " . $ben["posttit"]  ?></td>
                                            <td><?= $ben["date"] ?></td>
                                            <td>
                                                <a href='beneficiaire.php?AjoutBen&idben=<?= $ben['matricule'] ?>&idtit=<?=$idtitulaire?>'
                                                class="btn btn-success btn-sm">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                                <a onclick=" return confirm('Voulez-vous vraiment supprimer ?')"
                                                    href="../models/delete/del-beneficiaire.php?idSup=<?= $ben['matricule'] ?>"
                                                    class="btn btn-danger btn-sm">
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