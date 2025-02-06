<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';

var_dump($_POST);

$numArt = ctrlSaisies($_POST['numArt']);
$numMemb = ctrlSaisies($_POST['numMemb']);
$dtModCom = ctrlSaisies($_POST['dtModCom']);
$libCom = ctrlSaisies($_POST['libCom']);
$numCom = ctrlSaisies($_POST['numCom']);
$dtDelLogCom = ctrlSaisies($_POST['dtDelLogCom']);


    $attributs ="numArt = '$numArt', 
                numMemb = '$numMemb', 
                dtModCom = '$dtModCom', 
                libCom = '$libCom',
                dtDelLogCom = '$dtDelLogCom'";


$where = "numCom = '$numCom'";

sql_delete('COMMENT', $where);

header('Location: ../../views/backend/comments/list.php');
exit();
