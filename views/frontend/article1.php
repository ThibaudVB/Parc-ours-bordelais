<?php
require_once '../../header.php';
require_once '../../config.php';


// Vérifier si "numArt" est bien dans l'URL
if (!isset($_GET['numArt']) || empty($_GET['numArt'])) {
  echo "Article introuvable.";
  exit;
}

// Sécuriser l'entrée
$numArt = intval($_GET['numArt']);

// Récupérer l'article correspondant depuis la BDD
$article = sql_select("ARTICLE", "*", "numArt = $numArt");
$thematique = sql_select("THEMATIQUE", "*");
$comments = sql_select("COMMENT", "*", "NumArt = $numArt ORDER BY dtCreaCom DESC");
// var_dump($article); 

// Vérifier si l'article existe
if (empty($article)) {
  echo "Article non trouvé.";
  exit;
}

// Extraire les données de l'article
$libTitrArt = html_entity_decode($article[0]['libTitrArt']);
$libChapoArt = html_entity_decode($article[0]['libChapoArt']);
$libAccrochArt = html_entity_decode($article[0]['libAccrochArt']);
$parag1Art = nl2br(html_entity_decode($article[0]['parag1Art']));
$libSsTitr1Art = html_entity_decode($article[0]['libSsTitr1Art']);
$parag2Art = nl2br(html_entity_decode($article[0]['parag2Art']));
$libSsTitr2Art = html_entity_decode($article[0]['libSsTitr2Art']);
$parag3Art = nl2br(html_entity_decode($article[0]['parag3Art']));
$libConclArt = nl2br(html_entity_decode($article[0]['libConclArt']));
$urlPhotArt = html_entity_decode($article[0]['urlPhotArt']);


$thematiqueAssoc = [];
foreach ($thematique as $them) {
  $thematiqueAssoc[$them['numThem']] = $them['libThem'];
}

if (isset($article[0]['numThem']) && isset($thematiqueAssoc[$article[0]['numThem']])) {
  $thematiqueLib = $thematiqueAssoc[$article[0]['numThem']];
} else {
  $thematiqueLib = 'Non attribué';
}

// Récupérer numArt depuis l'URL
$numArt = isset($_GET['numArt']) ? intval($_GET['numArt']) : 0;

// Vérifier que l'article existe
$article = sql_select("ARTICLE", "*", "numArt = $numArt");
if (empty($article)) {
  echo "Article non trouvé.";
  exit;
}

// Récupérer les mots-clés associés à l'article
$motsClesAssocies = sql_select(
  "MOTCLEARTICLE INNER JOIN MOTCLE ON MOTCLEARTICLE.numMotCle = MOTCLE.numMotCle",
  "MOTCLE.libMotCle",
  "MOTCLEARTICLE.numArt = $numArt"
);

// Transformer les résultats en texte
$motCleLib = !empty($motsClesAssocies) ? implode(', ', array_column($motsClesAssocies, 'libMotCle')) : 'Non attribué';

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




    <span class="d-inline-block d-lg-none"><a href="#"
        class="text-white site-menu-toggle js-menu-toggle py-5 text-white"><span
          class="icon-menu h3 text-white"></span></a></span>


    <div class="ftco-blocks-cover-1">
      <style>
        /* CSS pour l'image dans le div */
        .ftco-cover-1.innerpage.overlay img {
          width: 100%;
          /* L'image occupe toute la largeur de son conteneur */
          height: auto;
          /* L'image conserve ses proportions */
          object-fit: cover;
          /* L'image remplit le conteneur sans être déformée */
          max-height: 80vh;
          /* Limite la hauteur de l'image à 80% de la hauteur de la fenêtre */
        }

        /* CSS pour le texte */
        .container {
          position: relative;
          z-index: 1;
        }

        .ftco-cover-1 .text-center {
          color: white;
          /* Texte en blanc */
        }
      </style>
      </head>

      <body>

        <div class="ftco-cover-1 innerpage overlay">
          <!-- Image de l'article -->
          <img src="../../src/uploads/<?php echo $urlPhotArt; ?>" alt="Image de l'article">
          <div class="container">
            <div class="row align-items-center justify-content-center">
              <div class="col-lg-6 text-center">
                <span class="d-block mb-3 text-white" data-aos="fade-up">July 17, 2019 <span
                    class="mx-2 text-primary">&bullet;</span> by James Miller</span>
                <h1 class="mb-4" data-aos="fade-up" data-aos-delay="100">Single Blog Posts Title</h1>
              </div>
            </div>
          </div>
        </div>
    </div>
    <div class="site-section">
      <div class="container-fluid mt-4">
        <div class="row">
          <div class="col-md-8 blog-content">
            <p class="lead"
              style="font-size: 4rem !important; font-weight: bold !important; text-align: center !important;">
              <?php echo $libTitrArt; ?>
            </p>
            <br>
            <p style="font-size: 2rem !important;  text-align: center !important; font-style: italic !important;">
              <?php echo $libChapoArt; ?>
            </p>
            <br>
            <blockquote>
              <p style="font-size: 2rem !important;  text-align: center !important; font-weight: bold !important;">
                <?php echo $libAccrochArt; ?>
              </p>
            </blockquote>
            <br>

            <p style="font-size: 1.5rem !important;  text-align: center !important;"><?php echo $parag1Art; ?></p>
            <br>

            <p style="font-size: 2rem !important;  text-align: center !important; font-weight: bold !important;">
              <?php echo $libSsTitr1Art; ?>
            </p>
            <br>

            <p style="font-size: 1.5rem !important;  text-align: center !important;"><?php echo $parag2Art; ?></p>
            <br>

            <blockquote>
              <p style="font-size: 2rem !important;  text-align: center !important; font-weight: bold !important;">
                <?php echo $libSsTitr2Art; ?>
              </p>
            </blockquote>
            <br>

            <p style="font-size: 1.5rem !important;  text-align: center !important;"><?php echo $parag3Art; ?></p>
            <br>

            <p
              style="font-size: 2rem !important;  text-align: center !important; font-weight: bold !important; font-style: italic !important;">
              <?php echo $libConclArt; ?>
            </p>
            <br>




            <div class="pt-5">
              <p>Catégories: <a href=""><?php echo $thematiqueLib; ?></a>, Mots Clés <a
                  href="#"><?php echo $motCleLib ?></a>, <a href="#">#trends</a></p>
            </div>


            <h3 class="mb-5"><?php echo count($comments); ?> Comments</h3>
            <ul class="comment-list">
              <?php
              // Affichage dynamique des commentaires récupérés
              foreach ($comments as $comment) {
                // Vérification de la condition avant d'afficher le commentaire
                if ($comment['notifComKOAff'] !== NULL && $comment['attModOK'] == 0) {
                  // Récupération de chaque commentaire
                  $content = htmlspecialchars($comment['libCom']);
                  $date = date('F j, Y \a\t g:i a', strtotime($comment['dtCreaCom']));
                  $numMemb = htmlspecialchars($comment['numMemb']);

                  // Si numMemb est défini, on récupère les informations du membre
                  if (isset($numMemb)) {
                    $membre = sql_select("MEMBRE", "*", "numMemb = '" . $numMemb . "'");
                    $pseudoMemb = $membre[0]['pseudoMemb'];
                  }
                  ?>
                  <li class="comment">
                    <div class="comment-body">
                      <h3><?php echo $pseudoMemb; ?></h3>
                      <div class="meta"><?php echo $date; ?></div>
                      <p><?php echo $content; ?></p>
                    </div>
                  </li>
                  <?php
                }
              }
              ?>
            </ul>

            <!-- END comment-list -->

            <div class="comment-form-wrap pt-5">
              <h3 class="mb-5">Laissez un commentaire</h3>
              <form action="../../api/comments/create_front.php" method="POST">
                <div class="form-group">

                  <?php
                  $articles = sql_select('ARTICLE', '*');
                  $membres = sql_select('MEMBRE', '*');
                  $comments = sql_select('COMMENT', '*');
                  $pseudoMemb = $_SESSION['pseudoMemb'];


                  if (isset($pseudoMemb)) {
                    $membre = sql_select("MEMBRE", "*", "pseudoMemb = '" . $pseudoMemb . "'");

                    $prenomMemb = $membre[0]['prenomMemb'];
                    $nomMemb = $membre[0]['nomMemb'];
                    $numMemb = $membre[0]['numMemb'];
                  }


                  if (isset($_GET['numCom'])) {
                    $numCom = $_GET['numCom'];

                    $comment = sql_select("COMMENT", "*", "numCom = '" . $numCom . "'");

                    $dtCreaCom = $comment[0]['dtCreaCom'];
                    $attModOK = $comment[0]['attModOK'];
                    $numArt = $comment[0]['numArt'];
                  }

                  $article = sql_select("ARTICLE", "*", "numArt = '" . $numArt . "'");
                  $libTitrArt = $article[0]['libTitrArt'];

                  $dtModCom = date('Y-m-d H:i:s');
                  $dtDelLogCom = date('Y-m-d H:i:s');
                  ?>



                  <input id="numArt" name="numArt" class="form-control" style="display: none" type="text"
                    value="<?php echo $numArt; ?>" />
                  <input id="numMemb" name="numMemb" class="form-control" style="display: none" type="text"
                    value="<?php echo $numMemb; ?>" />
                  <input id="dtModCom" name="dtModCom" class="form-control" style="display: none" type="text"
                    value="<?php echo $dtModCom; ?>" />
                  <input id="dtDelLogCom" name="dtDelLogCom" class="form-control" style="display: none" type="text"
                    value="<?php echo $dtDelLogCom; ?>" />
                  <input id="prenomMemb" name="prenomMemb" class="form-control" style="display: none" type="text"
                    value="<?php echo $prenomMemb; ?>" />
                  <input id="nomMemb" name="nomMemb" class="form-control" style="display: none" type="text"
                    value="<?php echo $nomMemb; ?>" />


                  <label for="name">
                    <?php
                    if (isset($_SESSION['pseudoMemb'])) {
                      $pseudoMemb = $_SESSION['pseudoMemb'];
                      echo "Pseudo : $pseudoMemb";
                      $disabled = "";
                    } else {
                      echo "Connectez-vous pour laisser un commentaire";
                      $disabled = "disabled";
                    }
                    ?>
                  </label>
                  <input type="text" class="form-control" id="name" name="pseudoMemb"
                    value="<?php echo $pseudoMemb ?? ''; ?>" <?php echo $disabled; ?> readonly>
                </div>

                <div class="form-group">
                  <label for="message">Votre commentaire</label>
                  <textarea name="libCom" id="libCom" cols="30" rows="10" class="form-control" <?php echo $disabled; ?>></textarea>
                </div>

                <div class="form-group">
                  <input type="submit" value="Post Comment" class="btn btn-primary btn-md text-white" id="submitBtn"
                    disabled>
                </div>
              </form>

              <script>
                const messageField = document.getElementById("libCom");
                const submitBtn = document.getElementById("submitBtn");

                function checkFields() {
                  if (messageField.value.trim() !== "") {
                    submitBtn.removeAttribute("disabled");
                  } else {
                    submitBtn.setAttribute("disabled", "disabled");
                  }
                }

                messageField.addEventListener("input", checkFields);
              </script>


            </div>
          </div>
          <div class="col-md-4 sidebar <svisibility: hidden;">
            <div class="sidebar-box">
              <form action="#" class="search-form">
                <div class="form-group">
                  <span class="icon fa fa-search"></span>
                  <input type="text" class="form-control" placeholder="Type a keyword and hit enter">
                </div>
              </form>
            </div>
            <div class="sidebar-box">
              <div class="categories">
                <h3>Catégories</h3>
                <ul>
                  <?php foreach ($thematique as $them): ?>
                    <li>
                      <a href="articles_par_thematique.php?numThem=<?= $them['numThem']; ?>">
                        <?= htmlspecialchars($them['libThem']); ?>
                      </a>
                    </li>
                  <?php endforeach; ?>
                </ul>
              </div>
            </div>

            <div class="author" style="voso>
            <div class=" sidebar-box">
              <h3 class="text-black">About The Author</h3>
              <p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life
                One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World
                of Grammar.</p>
              <p><a href="#" class="btn btn-primary btn-md text-white">Read More</a></p>
            </div>

            <div class="sidebar-box">
              <h3 class="text-black">Paragraph</h3>
              <p>When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of
                her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own road, the Line
                Lane. Pityful a rethoric question ran over her cheek, then she continued her way.</p>
            </div>
          </div>
        </div>
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