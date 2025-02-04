<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';

if (!isset($_POST['numMemb'])) {
    die("Utilisateur non spécifié.");
}

$numMemb = ctrlSaisies($_POST['numMemb']);
$nom = ctrlSaisies($_POST['nomMemb']);
$prenom = ctrlSaisies($_POST['prenomMemb']);
$email = ctrlSaisies($_POST['email1']);
$numStat = ctrlSaisies($_POST['numStat']);
$password = !empty($_POST['passMemb']) ? password_hash($_POST['passMemb'], PASSWORD_DEFAULT) : null;

// Mise à jour des infos utilisateur
$setValues = "nomMemb='$nom', prenomMemb='$prenom', eMailMemb='$email', numStat='$numStat'";
if ($password) {
    $setValues .= ", passMemb='$password'";
}

sql_update('MEMBRE', $setValues, "numMemb='$numMemb'");

header('Location: ../../views/backend/members/list.php');
?>
