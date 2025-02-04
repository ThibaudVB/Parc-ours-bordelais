<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';

var_dump($_POST);

$dtMajArt = date("Y-m-d H:i:s");  // Date de mise à jour
$numArt = ctrlSaisies($_GET['numArt']); // ID de l'article à mettre à jour
$libTitrArt = ctrlSaisies($_POST['libTitrArt']);
$libChapoArt = ctrlSaisies($_POST['libChapoArt']);
$libAccrochArt = ctrlSaisies($_POST['libAccrochArt']);
$parag1Art = ctrlSaisies($_POST['parag1Art']);
$libSsTitr1Art = ctrlSaisies($_POST['libSsTitr1Art']);
$parag2Art = ctrlSaisies($_POST['parag2Art']);
$libSsTitr2Art = ctrlSaisies($_POST['libSsTitr2Art']);
$parag3Art = ctrlSaisies($_POST['parag3Art']);
$libConclArt = ctrlSaisies($_POST['libConclArt']);
$numThem = ctrlSaisies($_POST['numThem']);
$motsClesSelectionnes = isset($_POST['numMotCle']) ? $_POST['numMotCle'] : [];

// Gestion de l'image (si une nouvelle image est uploadée)
if (isset($_FILES['urlPhotArt']) && $_FILES['urlPhotArt']['size'] > 0) {
    $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/src/uploads/';
    $urlPhotArt = $_FILES['urlPhotArt']['name'];
    $uploadPath = $uploadDir . $urlPhotArt;
    move_uploaded_file($_FILES['urlPhotArt']['tmp_name'], $uploadPath);

    // Mettre à jour l'article avec l'image
    sql_update(
        "ARTICLE",
        "libTitrArt = '$libTitrArt',
        dtMajArt = '$dtMajArt',
        libChapoArt = '$libChapoArt',
        libAccrochArt = '$libAccrochArt',
        parag1Art = '$parag1Art',
        libSsTitr1Art = '$libSsTitr1Art',
        parag2Art = '$parag2Art',
        libSsTitr2Art = '$libSsTitr2Art',
        parag3Art = '$parag3Art',
        libConclArt = '$libConclArt',
        urlPhotArt = '$urlPhotArt',
        numThem = '$numThem'",
        "numArt = '$numArt'"
    );
} else {
    // Mettre à jour l'article sans toucher à l'image
    sql_update(
        "ARTICLE",
        "libTitrArt = '$libTitrArt',
        dtMajArt = '$dtMajArt',
        libChapoArt = '$libChapoArt',
        libAccrochArt = '$libAccrochArt',
        parag1Art = '$parag1Art',
        libSsTitr1Art = '$libSsTitr1Art',
        parag2Art = '$parag2Art',
        libSsTitr2Art = '$libSsTitr2Art',
        parag3Art = '$parag3Art',
        libConclArt = '$libConclArt',
        numThem = '$numThem'",
        "numArt = '$numArt'"
    );
}

// Mise à jour des mots-clés associés à l'article
// 1. Supprimer les anciens mots-clés de l'article
sql_delete("MOTCLEARTICLE", "numArt = '$numArt'");

// 2. Associer les nouveaux mots-clés sélectionnés
foreach ($motsClesSelectionnes as $numMotCle) {
    sql_insert("MOTCLEARTICLE", "numArt, numMotCle", "'$numArt', '$numMotCle'");
}

// Redirection vers la liste des articles après mise à jour
header('Location: ../../views/backend/articles/list.php');
?>