<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';
require_once '../../functions/getExistPseudo.php';

$pseudo = $_POST["pseudoMemb"];
$pass = $_POST["passMemb"];

if (get_ExistPseudo($pseudo)){
    $resultat = sql_select("MEMBRE", "*", "pseudoMemb = '$pseudo'");

    $numMemb = $resultat[0]["numMemb"];
    $passMembHash = $resultat[0]['passMemb'];

    if (password_verify($pass, $passMembHash)) {
        setcookie('pseudo', $pseudoMemb, time() + (86400 * 30), "/");

        session_start();
        $_SESSION['logged'] = true;
        $_SESSION['username'] = $pseudo;
        $_SESSION['numMemb'] = $numMemb;

        $numStat = sql_select("membre", "numStat", "pseudoMemb = '$pseudo'");
        $numStat = $numStat[0]["numStat"];

        $_SESSION['numStat'] = $numStat;
        $_SESSION['likeArt'] = array();
        
        header('Location: ../../index.php');

    } else {
        die("Compte inexistant");
    }
}else {
    die("Compte inexistant");
}