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
  $thematiqueLib = 'Non attribué';}

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


              

              <span class="d-inline-block d-lg-none"><a href="#" class="text-white site-menu-toggle js-menu-toggle py-5 text-white"><span class="icon-menu h3 text-white"></span></a></span>


    <div class="ftco-blocks-cover-1">
      <div class="ftco-cover-1 innerpage overlay" style="background-image: url('img/parc_bordeaux.jpg')">
        <div class="container">
          <div class="row align-items-center justify-content-center">
            <div class="col-lg-6 text-center">
              <span class="d-block mb-3 text-white" data-aos="fade-up">July 17, 2019 <span class="mx-2 text-primary">&bullet;</span> by James Miller</span>
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
          <p class="lead" style="font-size: 4rem !important; font-weight: bold !important; text-align: center !important;">
    <?php echo $libTitrArt; ?>
</p>
<br>
            <p style="font-size: 2rem !important;  text-align: center !important; font-style: italic !important;"><?php echo $libChapoArt; ?></p>
            <br>
            <blockquote><p style="font-size: 2rem !important;  text-align: center !important; font-weight: bold !important;"><?php echo $libAccrochArt; ?></p></blockquote>
            <br>

            <p style="font-size: 1.5rem !important;  text-align: center !important;"><?php echo $parag1Art; ?></p>
            <br>

            <p style="font-size: 2rem !important;  text-align: center !important; font-weight: bold !important;"><?php echo $libSsTitr1Art; ?></p>
            <br>

            <p style="font-size: 1.5rem !important;  text-align: center !important;"><?php echo $parag2Art; ?></p>
            <br>

            <blockquote><p style="font-size: 2rem !important;  text-align: center !important; font-weight: bold !important;"><?php echo $libSsTitr2Art; ?></p></blockquote>
            <br>

            <p style="font-size: 1.5rem !important;  text-align: center !important;"><?php echo $parag3Art; ?></p>
            <br>
            
            <p style="font-size: 2rem !important;  text-align: center !important; font-weight: bold !important; font-style: italic !important;"><?php echo $libConclArt; ?></p>
            <br>


            <div class="pt-5">
              <p>Catégories:  <a href=""><?php echo $thematiqueLib; ?></a>, Mots Clés <a href="#"><?php echo $motCleLib ?></a>, <a href="#">#trends</a></p>
            </div>


    <h3 class="mb-5"><?php echo count($comments); ?> Comments</h3>
    <ul class="comment-list">
        <?php
        // Affichage dynamique des commentaires récupérés
        foreach ($comments as $comment) {
            // Récupération de chaque commentaire
            $content = htmlspecialchars($comment['libCom']);
            $date = date('F j, Y \a\t g:i a', strtotime($comment['dtCreaCom']));
        ?>
            <li class="comment">
                <div class="comment-body">
                    <h3>Anonymous</h3>
                    <div class="meta"><?php echo $date; ?></div>
                    <p><?php echo $content; ?></p>
                    <p><a href="#" class="reply">Reply</a></p>
                </div>
            </li>
        <?php
        }
        ?>
    </ul>
    <!-- END comment-list -->
    
    <div class="comment-form-wrap pt-5">
        <h3 class="mb-5">Leave a comment</h3>
        <form action="#" class="">
            <div class="form-group">
                <label for="name">Name *</label>
                <input type="text" class="form-control" id="name">
            </div>
            <div class="form-group">
                <label for="email">Email *</label>
                <input type="email" class="form-control" id="email">
            </div>
            <div class="form-group">
                <label for="website">Website</label>
                <input type="url" class="form-control" id="website">
            </div>

            <div class="form-group">
                <label for="message">Message</label>
                <textarea name="" id="message" cols="30" rows="10" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <input type="submit" value="Post Comment" class="btn btn-primary btn-md text-white">
            </div>

        </form>
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
            <div class="sidebar-box">
              <img src="images/person_1.jpg" alt="Free Website Template by Free-Template.co" class="img-fluid mb-4 w-50 rounded-circle">
              <h3 class="text-black">About The Author</h3>
              <p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.</p>
              <p><a href="#" class="btn btn-primary btn-md text-white">Read More</a></p>
            </div>

            <div class="sidebar-box">
              <h3 class="text-black">Paragraph</h3>
              <p>When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own road, the Line Lane. Pityful a rethoric question ran over her cheek, then she continued her way.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>



    <footer class="site-footer">
      <div class="container">
        <div class="row">
          <div class="col-lg-3">
            <img src="images/img_1.jpg" alt="Image" class="img-fluid mb-5">
            <h2 class="footer-heading mb-3">About Us</h2>
                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. </p>
          </div>
          <div class="col-lg-8 ml-auto">
            <div class="row">
              <div class="col-lg-6 ml-auto">
                <h2 class="footer-heading mb-4">Quick Links</h2>
                <ul class="list-unstyled">
                  <li><a href="#">About Us</a></li>
                  <li><a href="#">Testimonials</a></li>
                  <li><a href="#">Terms of Service</a></li>
                  <li><a href="#">Privacy</a></li>
                  <li><a href="#">Contact Us</a></li>
                </ul>
              </div>
              <div class="col-lg-6">
                <h2 class="footer-heading mb-4">Newsletter</h2>
                <form action="#" class="d-flex" class="subscribe">
                  <input type="text" class="form-control mr-3" placeholder="Email">
                  <input type="submit" value="Send" class="btn btn-primary">
                </form>
              </div>
              
            </div>
          </div>
        </div>
        <div class="row pt-5 mt-5 text-center">
          <div class="col-md-12">
            <div class="border-top pt-5">
              <p>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart text-danger" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank" >Colorlib</a>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            </p>
            </div>
          </div>

        </div>
      </div>
    </footer>

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
