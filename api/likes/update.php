<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!isset($_GET["numArt"]) || !isset($_GET["numMemb"])) {
        die("Erreur : Paramètres manquants.");
    }

    $numArt = ctrlSaisies($_GET["numArt"]);
    $numMemb = ctrlSaisies($_GET["numMemb"]);

    sql_delete("LIKEART", "numArt = $numArt AND numMemb = $numMemb");

    header('Location: ../../views/backend/likes/list.php');
    exit();
} else {
    die("Requête invalide.");
}
?>
