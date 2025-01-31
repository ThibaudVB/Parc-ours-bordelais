<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';

var_dump($_POST);

$libTitrArt = ctrlSaisies($_POST['libTitrArt']);
$dtCreaArt = ctrlSaisies($_POST['dtCreaArt']);
$libChapoArt = ctrlSaisies($_POST['libChapoArt']);
$libAccrochArt = ctrlSaisies($_POST['libAccrochArt']);
$parag1Art = ctrlSaisies($_POST['parag1Art']);
$libSsTitr1Art = ctrlSaisies($_POST['libSsTitr1Art']);
$parag2Art = ctrlSaisies($_POST['parag2Art']);
$libSsTitr2Art = ctrlSaisies($_POST['libSsTitr2Art']);
$parag3Art = ctrlSaisies($_POST['parag3Art']);
$libConclArt = ctrlSaisies($_POST['libConclArt']);
$urlPhotArt = ctrlSaisies($_POST['urlPhotArt']);


$attributs = "libTitrArt, dtCreaArt, libChapoArt, libAccrochArt, parag1Art, libSsTitr1Art, parag2Art, libSsTitr2Art, parag3Art, libConclArt, urlPhotArt";
$values = "$libTitrArt, $dtCreaArt, $libChapoArt, $libAccrochArt, $parag1Art, $libSsTitr1Art, $parag2Art, $libSsTitr2Art, $parag3Art, $libConclArt, $urlPhotArt";

sql_insert('ARTICLE', $attributs, $values);


header('Location: ../../views/backend/articles/list.php');