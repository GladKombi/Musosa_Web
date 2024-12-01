<?php if(isset($_GET['search']))
 {
     $recherche=$_GET['search'];
    $selben=$connexion->prepare("SELECT * From beneficiaire where  beneficiaire.supprimer=0 and  beneficiaire.matricule LIKE ? OR beneficiaire.nom   LIKE ? OR beneficiaire.postnom  LIKE ? OR beneficiaire.prenom  LIKE ? OR beneficiaire.tel LIKE ?");
    $selben->execute(["%".$recherche."%","%".$recherche."%","%".$recherche."%","%".$recherche."%","%".$recherche."%"]); 
     $message="Aucun element correspond  a votre recherche";
     
 }
 else{
    $selben=$connexion->prepare("SELECT * from beneficiaire where supprimer=0");
    $selben->execute();
    $message="Veillez creer le beneficiaire";
 }