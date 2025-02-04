<?php
include '../../../header.php';
require_once '../../../functions/ctrlSaisies.php';

if (
    isset($_POST['numMemb']) &&
    isset($_POST['prenomMemb']) &&
    isset($_POST['nomMemb']) &&
    isset($_POST['email1']) &&
    isset($_POST['numStat'])
) {
    // Récupération et sécurisation des données
    $numMemb = ctrlSaisies($_POST['numMemb']);
    $prenomMemb = ctrlSaisies($_POST['prenomMemb']);
    $nomMemb = ctrlSaisies($_POST['nomMemb']);
    $emailMemb = ctrlSaisies($_POST['email1']);
    $numStat = ctrlSaisies($_POST['numStat']);

    // Vérification et hashage du mot de passe si fourni
    if (!empty($_POST['passMemb1']) && $_POST['passMemb1'] === $_POST['passMemb2']) {
        $passMemb = password_hash(ctrlSaisies($_POST['passMemb1']), PASSWORD_DEFAULT);
        sql_update("MEMBRE", "prenomMemb = '$prenomMemb', nomMemb = '$nomMemb', eMailMemb = '$emailMemb', passMemb = '$passMemb', numStat = $numStat", "numMemb = $numMemb");
    } else {
        sql_update("MEMBRE", "prenomMemb = '$prenomMemb', nomMemb = '$nomMemb', eMailMemb = '$emailMemb', numStat = $numStat", "numMemb = $numMemb");
    }

    // Redirection après modification
    header("Location: " . ROOT_URL . "/views/members/list.php");
    exit;
} else {
    echo "Erreur : Tous les champs obligatoires doivent être remplis.";
}
?>
