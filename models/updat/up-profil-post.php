<?php
// Connexion à la base de données
include_once('../../connexion/connexion.php');
include_once('../../fonctions/fonctions.php');

// Vérifie la soumission du formulaire et les paramètres requis
if (isset($_POST['valider']) && isset($_GET['idMod']) && !empty($_GET['idMod']) && isset($_POST['type'])) {
    $_id = $_GET['idMod'];
    $_type = $_POST['type']; // Récupère le type d'utilisateur depuis le champ caché
    $_nom = htmlspecialchars($_POST['nom']);
    $_postnom = htmlspecialchars($_POST['postnom']);
    $_tel = htmlspecialchars($_POST['tel']);
    $_adresse = htmlspecialchars($_POST['adresse']);
    $_email = $_postnom . $_id . '@musosa.fin';

    // Récupération de l'image
    $image = $_FILES['photo']['name'];
    $file = $_FILES['photo'];
    $destination = "../../assets/img/profil/" . basename($image);

    // Fonction pour récupérer la photo et vérifier le format
    $newimage = RecuperPhoto($image, $file, $destination);

    // Vérifications de l'image
    if ($newimage === "") {
        $_SESSION['msg'] = "Aucune image n'a été fournie.";
    } elseif ($newimage === -1) {
        $_SESSION['msg'] = "Erreur lors de l'upload de l'image.";
    } elseif ($newimage === 0) {
        $_SESSION['msg'] = "Le format de cette image n'est pas recommandé dans ce système.";
    } else {
        // Vérifie le type d'utilisateur pour déterminer la table à mettre à jour
        if ($_type === 'user') {
            // Mise à jour de la table `user`
            $_upData = $connexion->prepare("UPDATE user SET nom=?, postnom=?, tel=?, adresse=?, username=?, photo=? WHERE id=?");
            $_rows = $_upData->execute([$_nom, $_postnom, $_tel, $_adresse, $_email, $newimage, $_id]);

            if ($_rows) {
                $_SESSION['msg'] = "Modification réussie.";
            } else {
                $_SESSION['msg'] = "Échec de la modification.";
            }
        } elseif ($_type === 'beneficiaire') {
            // Mise à jour de la table `beneficiaire`
            $_upData = $connexion->prepare("UPDATE beneficiaire SET nom=?, postnom=?, tel=?, adresse=?, photo=? WHERE titulaire=?");
            $_rows = $_upData->execute([$_nom, $_postnom, $_tel, $_adresse, $newimage, $_id]);

            if ($_rows) {
                $_SESSION['msg'] = "Modification réussie.";
            } else {
                $_SESSION['msg'] = "Échec de la modification.";
            }
        } else {
            $_SESSION['msg'] = "Type d'utilisateur inconnu : " . $_type;
        }
    }

    // Redirection vers la page de profil après modification
    header("Location: ../../views/UserProfil.php");
    exit();
} else {
    // Si l'ID ou le formulaire n'est pas défini, retour à la page de profil avec un message d'erreur
    $_SESSION['msg'] = "Erreur de soumission. Paramètre idMod ou type manquant.";
    header("Location: ../../views/UserProfil.php");
    exit();
}
?>
