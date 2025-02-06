<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';

var_dump($_POST);

$dtCreaArt = date("Y-m-d H:i:s");  
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

if (isset($_FILES['urlPhotArt'])) {
    $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/src/uploads/';
    $urlPhotArt = $_FILES['urlPhotArt']['name'];
    $uploadPath = $uploadDir . $urlPhotArt;
    move_uploaded_file($_FILES['urlPhotArt']['tmp_name'], $uploadPath);
}


$attributs = "libTitrArt, dtCreaArt, libChapoArt, libAccrochArt, parag1Art, libSsTitr1Art, parag2Art, libSsTitr2Art, parag3Art, libConclArt, urlPhotArt, numThem";
$values = "'$libTitrArt', '$dtCreaArt', '$libChapoArt', '$libAccrochArt', '$parag1Art', '$libSsTitr1Art', '$parag2Art', '$libSsTitr2Art', '$parag3Art', '$libConclArt', '$urlPhotArt', '$numThem'";

sql_insert('ARTICLE', $attributs, $values);
$numArt = sql_select("ARTICLE", "MAX(numArt)")[0][0];
if ($numArt) {
    foreach ($motsClesSelectionnes as $numMotCle) {
        sql_insert("MOTCLEARTICLE", "numArt, numMotCle", "$numArt, $numMotCle");
    }
}

header('Location: ../../views/backend/articles/list.php');
