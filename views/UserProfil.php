<?php
    include '../connexion/connexion.php';
    include_once('../models/select/select-profil.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Users_Profile</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <?php require_once('style.php'); ?>
</head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <?php require_once('navbar.php'); ?>
      <div class="main-sidebar sidebar-style-2">
        <?php require_once('aside.php'); ?>
      </div>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Profile</h1>
          </div>
          <div class="section-body">
            <h2 class="section-title"><?php echo htmlspecialchars($_SESSION['noms']); ?></h2>
            <p class="section-lead">Voulez-vous changer une information dans votre profil ??</p>

            <div class="row mt-sm-4">
              <div class="col-12 col-md-12 col-lg-5">
                <div class="card profile-widget">
                  <div class="profile-widget-header">
                    <img alt="image" src="assets/img/profil/lad.jpg" class="rounded-circle profile-widget-picture">
                    <div class="profile-widget-items">
                      <div class="profile-widget-item">
                        <div class="profile-widget-item-label">Cotisations</div>
                        <div class="profile-widget-item-value">187</div>
                      </div>
                      <div class="profile-widget-item">
                        <div class="profile-widget-item-label">Episodes</div>
                        <div class="profile-widget-item-value">6,8K</div>
                      </div>
                      <div class="profile-widget-item">
                        <div class="profile-widget-item-label">Bénéficiaire</div>
                        <div class="profile-widget-item-value">2,1K</div>
                      </div>
                    </div>
                  </div>
                  <div class="profile-widget-description">
                    <div class="profile-widget-name">
                      <?php echo htmlspecialchars($_SESSION['noms']); ?>
                      <div class="text-muted d-inline font-weight-normal">
                        <div class="slash"></div> Web Developer
                      </div>
                    </div>
                    Glad Kombi est un super-héros dans le <b>développement web</b>, notamment en HTML et CSS. Ce n'est pas un personnage fictif, mais un héros pour sa famille, ses enfants et sa femme.
                  </div>
                  <div class="card-footer text-center">
                    <div class="font-weight-bold mb-2">Suivez Glad Kombi</div>
                    <a href="#" class="btn btn-social-icon btn-facebook mr-1">
                      <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="btn btn-social-icon btn-twitter mr-1">
                      <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="btn btn-social-icon btn-github mr-1">
                      <i class="fab fa-github"></i>
                    </a>
                    <a href="#" class="btn btn-social-icon btn-instagram">
                      <i class="fab fa-instagram"></i>
                    </a>
                  </div>
                </div>
              </div>

              <div class="col-12 col-md-12 col-lg-7">
                <div class="card">
                <form method="POST" enctype="multipart/form-data" 
                      action="../models/updat/up-profil-post.php?idMod=<?php echo $_SESSION['id'] ?? $_SESSION['titulaire']; ?>">
                    
                    <!-- Champ caché pour le type d'utilisateur -->
                    <input type="hidden" name="type" value="<?php echo isset($_SESSION['id']) ? 'user' : 'beneficiaire'; ?>">
                    
                    <div class="card-header">
                        <h4>Modifiez votre Profil</h4>
                    </div>

                    <!-- Affichage des messages de notification -->
                    <?php if (isset($_SESSION['msg']) && !empty($_SESSION['msg'])) { ?>
                        <div class="col-xl-12 mt-3">
                            <div class="alert-info alert text-center"><?= $_SESSION['msg'] ?></div>
                        </div>
                    <?php } unset($_SESSION['msg']); ?>

                    <div class="card-body">
                        <!-- Champs du formulaire -->
                        <div class="row">
                            <div class="form-group col-md-6 col-12">
                                <label>Nom</label>
                                <input type="text" name="nom" class="form-control" placeholder="Glad" required 
                                      value="<?php echo htmlspecialchars($_nom ?? ''); ?>">
                                <div class="invalid-feedback">Veuillez saisir ici votre nom svp !</div>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>Postnom</label>
                                <input type="text" name="postnom" class="form-control" placeholder="Kombi" required 
                                      value="<?php echo htmlspecialchars($_postnom ?? ''); ?>">
                                <div class="invalid-feedback">Veuillez saisir ici votre postnom svp !</div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6 col-12">
                                <label>Numéro de téléphone</label>
                                <input type="text" name="tel" class="form-control" placeholder="EX:+243997019883" required 
                                      value="<?php echo htmlspecialchars($_telephone ?? ''); ?>">
                                <div class="invalid-feedback">Veuillez saisir ici votre numéro de téléphone svp !</div>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>Adresse</label>
                                <input type="text" name="adresse" class="form-control" placeholder="EX:+243997019883" required 
                                      value="<?php echo htmlspecialchars($_adresse ?? ''); ?>">
                                <div class="invalid-feedback">Veuillez saisir ici votre adresse svp !</div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6 col-12">
                                <label>Photo</label>
                                <img src="<?php echo isset($_image) && !empty($_image) ? '../assets/img/profil/' . htmlspecialchars($_image) : ''; ?>" 
                                    alt="Profile" width="40" height="40">
                                <input autocomplete="off" name="photo" type="file" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="card-footer text-right">
                        <button class="btn btn-success" name="valider" type="submit">Enregistrer les modifications</button>
                    </div>
                </form>

                </div>
              </div>
            </div>
          </div>
        </section>
      </div>

      <?php require_once('footer.php'); ?>
    </div>
  </div>

  <?php require_once('script.php'); ?>
</body>
</html>
