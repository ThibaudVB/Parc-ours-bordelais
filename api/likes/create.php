<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';

$numArt = ctrlSaisies($_POST['numArt']);
$numMemb = ctrlSaisies($_POST['numMemb']);
$likeA = ctrlSaisies($_POST['choixLike']);

sql_insert('LIKEART', "numMemb, numArt, likeA", "'$numMemb', '$numArt', '$likeA'");

header('Location: ../../views/backend/likes/list.php');
?>