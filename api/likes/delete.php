<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!isset($_POST["numArt"]) || !isset($_POST["numMemb"])) {
        die("Erreur : Paramètres manquants.");
    }

    $numArt = ctrlSaisies($_POST["numArt"]);
    $numMemb = ctrlSaisies($_POST["numMemb"]);

    if (empty($numArt) || empty($numMemb)) {
        die("Erreur : Paramètres vides.");
    }

    sql_delete("LIKEART", "numArt = $numArt AND numMemb = $numMemb");

    header('Location: ../../views/backend/likes/list.php');
    exit();
} else {
    die("Requête invalide.");
}
?>
