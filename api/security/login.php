<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $pseudologin = trim($_POST['pseudo']);
    $password = $_POST['password']; 
}

$pseudo = sql_select("MEMBRE", "pseudoMemb");
$mdp = sql_select("MEMBRE", "passMemb");

foreach ($pseudo as $key => $value) {
    if ($pseudologin == $value["pseudoMemb"]) {
        foreach ($mdp as $key => $values) {
            if (password_verify($password, $values["passMemb"])) {
                $_SESSION["pseudo"] = $pseudologin;
                header('Location: ../../../index.php');
                exit();
            }
        }
    }
    
}

header('Location: ../../../login.php?error=1');
exit();
