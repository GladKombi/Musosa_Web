<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Users_Profile </title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <?php require_once('style.php'); ?>

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
        <section class="section">
          <div class="section-header">
            <h1>Profile</h1>
          </div>
          <div class="section-body">
            <h2 class="section-title">Glad Kombi</h2>
            <p class="section-lead">
              Voulez-vous change une information dans votre profil ??
            </p>

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
                        <div class="profile-widget-item-label">Beneficiaire</div>
                        <div class="profile-widget-item-value">2,1K</div>
                      </div>
                    </div>
                  </div>
                  <div class="profile-widget-description">
                    <div class="profile-widget-name">Glad Kombi<div class="text-muted d-inline font-weight-normal">
                        <div class="slash"></div> Web Developer
                      </div>
                    </div>
                    Glad Kombi is a superhero name in <b>Web developpement</b>, especially in HTML and CSS. He is not a fictional character but an original hero in my family, a hero for his children and for his wife.
                  </div>
                  <div class="card-footer text-center">
                    <div class="font-weight-bold mb-2">Follow Glad Kombi</div>
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
                  <form method="post" class="needs-validation" novalidate="">
                    <div class="card-header">
                      <h4>Modifiez votre Profil</h4>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="form-group col-md-6 col-12">
                          <label>Nom</label>
                          <input type="text" class="form-control" placeholder="Glad" required="">
                          <div class="invalid-feedback">
                            Veillez saisir ici votre nom svp !
                          </div>
                        </div>
                        <div class="form-group col-md-6 col-12">
                          <label>Postnom</label>
                          <input type="text" class="form-control" placeholder="Kombi" required="">
                          <div class="invalid-feedback">
                            Veillez saisir ici votre postnom svp !
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-md-7 col-12">
                          <label>Email</label>
                          <input type="email" class="form-control" placeholder="Gladkombi@Musosa.com" required="">
                          <div class="invalid-feedback">
                            Veillez saisir ici votre email svp !
                          </div>
                        </div>
                        <div class="form-group col-md-5 col-12">
                          <label>Numero de telephone</label>
                          <input type="tel" class="form-control" placeholder="EX:+243997019883" required="">
                          <div class="invalid-feedback">
                            Veillez saisir ici votre numero de telephone svp !
                          </div>
                        </div>
                      </div>

                    </div>
                    <div class="card-footer text-right">
                      <button class="btn btn-success">Save Changes</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
      <?php require_once('footer.php') ?>
    </div>
  </div>

  <?php require_once('script.php') ?>
</body>

</html>