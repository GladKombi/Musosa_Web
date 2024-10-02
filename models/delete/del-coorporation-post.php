<?php
include('../../connexion/connexion.php');
#suppression
if (isset($_GET['idSup']) && !empty($_GET['idSup'])) {
  $id = $_GET['idSup'];
  $supprimer = 1;
  $req = $connexion->prepare("UPDATE coorporation SET supprimer=? WHERE id=?");
  $resultat = $req->execute([$supprimer, $id]);

  if ($resultat == true) {
    $_SESSION['msg'] = "Suppression réussie";
    header("location:../../views/coorporation.php");
  } else {
    $_SESSION['msg'] = "Echec de la suppression";
    header("location:../../views/coorporation.php");
  }
} else {
  header("location:../../views/coorporation.php");
}
