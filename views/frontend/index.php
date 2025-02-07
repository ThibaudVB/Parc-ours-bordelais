<?php
require_once '../../header.php';
require_once '../../config.php';
setlocale(LC_TIME, 'fr_FR.UTF-8', 'fra'); // Définit la locale en français
//sql_connect();
$articles = sql_select("ARTICLE", "LibTitrArt, numArt, dtCreaArt, libChapoArt, urlPhotArt");
$urlPhotArt = html_entity_decode($articles[0]['urlPhotArt']);


//echo ("Evénement");
?>

<!doctype html>
<html lang="fr">

<head>
  <title>Blog &mdash; Studio Verdeaux</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=DM+Sans:300,400,700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="fonts/icomoon/style.css">

  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-datepicker.css">
  <link rel="stylesheet" href="css/jquery.fancybox.min.css">
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">
  <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">
  <link rel="stylesheet" href="css/aos.css">

  <!-- MAIN CSS -->
  <link rel="stylesheet" href="css/style.css">

</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">


  <div class="site-wrap" id="home-section">

    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>



    <div class="ftco-blocks-cover-1"> <!-- BLOCK BIENVENUE + IMAGE DE FOND -->
      <div class="site-section-cover overlay" data-stellar-background-ratio=".5"
        style="background-image: url('img/jardin_botanique.jpg')">
        <div class="container">
          <div class="row align-items-center justify-content-center text-center">
            <div class="col-md-7">
              <h1 class="mb-3">Bienvenue sur notre blog</h1>
              <p>Le Studio Verdeaux vous souhaite une bonne lecture</p>
              <p><a href="#" class="btn btn-success" style="background-color: #409961; border-color: #409961;">En savoir plus</a></p>

            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section bg-light" style="min-height: 100vh; display: flex; flex-direction: column; justify-content: space-between;">
    <div class="container" style="flex-grow: 1;">
        <div class="row">

        <?php foreach ($articles as $article) : ?>
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="post-entry-1 h-100" style="height: 100%; display: flex; flex-direction: column;">
            <a href="article1.php?numArt=<?php echo $article['numArt']; ?>">
                <div class="test" style="height: 100%; display: flex; flex-direction: column;">
                    <!-- Utilisation de $article['urlPhotArt'] pour afficher l'image -->
                    <img src="../../src/uploads/<?php echo $article['urlPhotArt']; ?>" alt="Image de l'article">
                </div>
            </a>
            <div class="post-entry-1-contents" style="flex-grow: 1;">
                <h2><a href="article1.php?numArt=<?php echo $article['numArt']; ?>">
                    <?php echo html_entity_decode($article['LibTitrArt']); ?>
                </a></h2>
                <span class="meta d-inline-block mb-3">
                    <?php echo date("d F Y", strtotime($article['dtCreaArt'])); ?> 
                    <span class="mx-2">by</span> <a href="#">Admin</a>
                </span>
                <p><?php echo html_entity_decode($article['libChapoArt']); ?></p>
            </div>
        </div>
    </div>
<?php endforeach; ?>


        </div>
    </div>
</div>

  <?php

include $_SERVER['DOCUMENT_ROOT'] . '/footer.php';

  ?>

  </div>

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-migrate-3.0.0.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.sticky.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/jquery.fancybox.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/bootstrap-datepicker.min.js"></script>
  <script src="js/aos.js"></script>

  <script src="js/main.js"></script>

</body>

</html>