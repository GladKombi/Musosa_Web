
<?php
if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
    $id = $_SESSION['id'];
    //requette qui permet d'afficher les données existant dans la base des données
    $getDatamod = $connexion->prepare("SELECT * FROM user WHERE id=?");
    $getDatamod->execute(array($id));
    // on s'assure que les informations ont été recupere
    if ($_tab = $getDatamod->fetch()) {
        $_nom =  $_tab[1];
        $_postnom =  $_tab[2];
        $_email =  $_tab[6];
        $_adresse =  $_tab[5];
        $_telephone =  $_tab[4];
        $_image = $_tab[9];
    } else {
        $_SESSION['msg'] = "Aucune information trouvée";
    }
} elseif (isset($_SESSION['titulaire']) && !empty($_SESSION['titulaire'])) {
    $titulaire = $_SESSION['titulaire'];
    //requette qui permet d'afficher les données existant dans la base des données
    $getDatamod = $connexion->prepare("SELECT * FROM beneficiaire WHERE titulaire=?");
    $getDatamod->execute(array($titulaire));
    // on s'assure que les informations ont été recupere
    if ($_tab = $getDatamod->fetch()) {
        $_nom =  $_tab[1];
        $_postnom =  $_tab[2];
        // $_email =  $_tab[6];
        $_adresse =  $_tab[5];
        $_telephone =  $_tab[4];
        $_image = $_tab[12];
    } else {
        $_SESSION['msg'] = "Aucune information trouvée";
    }
}