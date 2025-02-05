<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';

var_dump($_POST);

$username = ctrlSaisies($_POST['username']);
$prenomMemb = ctrlSaisies($_POST['prenomMemb']);
$nomMemb = ctrlSaisies($_POST['nomMemb']);
$numArt = ctrlSaisies($_POST['numArt']);

$attributs = "username, prenomMemb, nomMemb, numArt";
$values = "'$username', '$prenomMemb', '$nomMemb', '$numArt'";

sql_insert('COMMENT', $attributs, $values);


