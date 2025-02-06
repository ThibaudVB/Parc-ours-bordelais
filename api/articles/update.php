<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';

var_dump($_POST);

$dtMajArt = date("Y-m-d H:i:s");  
$numArt = ctrlSaisies($_GET['numArt']); 
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

if (isset($_FILES['urlPhotArt']) && $_FILES['urlPhotArt']['size'] > 0) {
    $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/src/uploads/';
    $urlPhotArt = $_FILES['urlPhotArt']['name'];
    $uploadPath = $uploadDir . $urlPhotArt;
    move_uploaded_file($_FILES['urlPhotArt']['tmp_name'], $uploadPath);

    
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


sql_delete("MOTCLEARTICLE", "numArt = '$numArt'");


foreach ($motsClesSelectionnes as $numMotCle) {
    sql_insert("MOTCLEARTICLE", "numArt, numMotCle", "'$numArt', '$numMotCle'");
}

header('Location: ../../views/backend/articles/list.php');
?>