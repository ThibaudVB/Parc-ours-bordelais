<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';

var_dump($_POST);


$pseudoMemb = ctrlSaisies($_POST['pseudoMemb']);
$prenomMemb = ctrlSaisies($_POST['prenomMemb']);
$nomMemb = ctrlSaisies($_POST['nomMemb']);
$passMemb1 = ctrlSaisies($_POST['passMemb1']);
$passMemb2 = ctrlSaisies($_POST['passMemb2']);
$email1 = ctrlSaisies($_POST['email1']);
$email2 = ctrlSaisies($_POST['email2']);
$accordMemb = ctrlSaisies($_POST['accordMemb']);
$libStat = ctrlSaisies($_POST['libStat']);


$attributs = "pseudoMemb, prenomMemb, nomMemb, passMemb1, passMemb2, email1, email2, accordMemb, libStat";
$values = "'$pseudoMemb', '$prenomMemb', '$nomMemb', '$passMemb1', '$passMemb2', '$email1', '$email2', '$accordMemb', '$libStat'";

sql_insert('MEMBRE', $attributs, $values);


header('Location: ../../views/backend/membres/list.php');

