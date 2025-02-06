<?php


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Si l'utilisateur n'est pas connecté, redirige vers la page de connexion
if (!isset($_SESSION['pseudoMemb'])) {
    header('Location: /views/backend/security/login.php');
    exit();
}
// Récupérer les informations de l'utilisateur connecté
$pseudo = $_SESSION['pseudoMemb'];
$user = sql_select("MEMBRE", "*", "pseudoMemb = '$pseudo'");

    // Si l'utilisateur est Admin99, il peut accéder directement à la page
    if ($pseudo === 'Admin99' || $numStat == 1) {
        // Laisser l'accès à la page
    } else {
        // Sinon, redirige vers index.php
        header('Location: /index.php');
        exit();
}

?>