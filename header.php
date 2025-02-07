<!DOCTYPE html>
<html lang="fr-FR">
<?php
// Démarrer la session seulement si elle n'est pas déjà active
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once 'config.php';
$NumStat = sql_select("MEMBRE", "numStat");
?>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Blog'Art</title>
    <!-- Load CSS -->
    <link rel="stylesheet" href="src/css/style.css" />
    <!-- Bootstrap CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
    <link rel="shortcut icon" type="image/x-icon" href="src/images/article.png" />
    <link href="https://fonts.googleapis.com/css?family=DM+Sans:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" href="css/aos.css">

    
    <style>
        /* Custom Navbar Styles */
        .navbar {
            background-color: #000000 !important; /* Fond noir avec !important */
            padding: 10px 20px !important;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar.bg-light {
            background-color: #000000 !important; /* Override bg-light class with black background */
        }

        .navbar-brand {
            font-size: 1.8rem;
            font-weight: bold;
            color: #f8f9fa !important;
            letter-spacing: 2px;
            transition: color 0.3s ease-in-out;
        }

        .navbar-brand:hover {
            color: #409961 !important;
        }

        .navbar-nav .nav-link {
            color: #409961 !important;
            font-size: 1.1rem;
            margin-right: 15px;
            transition: color 0.3s ease-in-out;
        }

        .navbar-nav .nav-link:hover {
            color: #006400 !important;
            text-decoration: underline;
        }

        .navbar-nav .nav-item.active .nav-link {
            color: #006400 !important;
        }

        .navbar-toggler {
            border-color: #006400 !important;
        }

        .navbar-toggler-icon {
            background-color: #006400 !important;
        }

        .form-control {
            max-width: 300px;
            border-radius: 30px !important;
            border: 2px solid #006400;
            transition: border 0.3s ease-in-out;
        }

        .form-control:focus {
            border-color: #006400 !important;
        }

        .btn {
            border-radius: 30px !important;
            font-size: 1.1rem;
            padding: 8px 20px !important;
            transition: background-color 0.3s ease-in-out;
        }

        .btn-primary {
            background-color: #409961 !important;
            border-color: #409961 !important;
        }

        .btn-primary:hover {
            background-color:rgb(11, 63, 30) !important;
            border-color: #409961 !important;
        }

        .btn-dark {
            background-color: #343a40 !important;
            border-color: #343a40 !important;
        }

        .btn-dark:hover {
            background-color: #23272b !important;
            border-color: #1d2124 !important;
        }

        .btn-danger {
            background-color: #dc3545 !important;
            border-color: #dc3545 !important;
        }

        .btn-danger:hover {
            background-color: #c82333 !important;
            border-color: #bd2130 !important;
        }

    </style>
</head>

<body>
<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="\logo.png" alt="Blog'Art 25" style="height: 50px; width: auto;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="\views\frontend\index.php">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <?php if (isset($_SESSION['pseudoMemb']) && $_SESSION['pseudoMemb'] === 'Admin99'): ?>
                            <a class="nav-link" href="/views/backend/dashboard.php">Admin</a>
                        <?php endif; ?>
                    </li>
                </ul>
            </div>
            <div class="d-flex">
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Rechercher sur le site…" aria-label="Search">
                </form>

                <?php if (!isset($_SESSION['pseudoMemb'])): ?>
                    <a class="btn btn-primary m-1" href="/views/backend/security/login.php" role="button">Login</a>
                    <a class="btn btn-dark m-1" href="/views/backend/security/signup.php" role="button">Sign up</a>
                <?php else: ?>
                    <a class="btn btn-danger m-1" href="/api/security/disconnect.php" role="button">Logout</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
</body>
</html>
