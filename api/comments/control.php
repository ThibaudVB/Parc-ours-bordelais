<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';

var_dump($_POST);

$attModOK = ctrlSaisies($_POST['attModOK']);
$notifComKOAff = ctrlSaisies($_POST['notifComKOAff']);
$numArt = ctrlSaisies($_POST['numArt']);
$numMemb = ctrlSaisies($_POST['numMemb']);
$dtModCom = ctrlSaisies($_POST['dtModCom']);
$libCom = ctrlSaisies($_POST['libCom']);



$attributs = "attModOK, notifComKOAff, numArt, numMemb, dtModCom, libCom";
$values = "'$attModOK', '$notifComKOAff', '$numArt', '$numMemb', '$dtModCom', '$libCom'";

sql_insert('COMMENT', $attributs, $values);



header('Location: ../../views/backend/comments/list.php');
exit();