<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';

$libTitrArt = ctrlSaisies($_POST['libTitrArt']);
$dtCreaArt = ctrlSaisies($_POST['dtCreaArt']);
$libChapoArt = ctrlSaisies($_POST['libChapoArt']);
$libAccrochArt = ctrlSaisies($_POST['libAccrochArt']);
$parag1Art = ctrlSaisies($_POST['parag1Art']);
$libSsTitr1Art = ctrlSaisies($_POST['sousparag1Art']);
$parag2Art = ctrlSaisies($_POST['parag2Art']);
$libSsTitr2Art = ctrlSaisies($_POST['sousparag2Art']);
$parag3Art = ctrlSaisies($_POST['parag3Art']);
$libConclArt = ctrlSaisies($_POST['libConclArt']);
$urlPhotArt = ctrlSaisies($_POST['urlPhotArt']);

$nom = 
$values = 

sql_insert('ARTICLE', $noms, $values);


header('Location: ../../views/backend/articles/list.php');