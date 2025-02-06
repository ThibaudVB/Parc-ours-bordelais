<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';


session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $pseudologin = trim($_POST['pseudo']);
    $password = $_POST['password']; 


    $pseudo = sql_select("MEMBRE", "pseudoMemb");
    $mdp = sql_select("MEMBRE", "passMemb");

  
    foreach ($pseudo as $key => $value) {
        if ($pseudologin == $value["pseudoMemb"]) {
            
       
            foreach ($mdp as $key => $values) {
                if (password_verify($password, $values["passMemb"])) {
                    $_SESSION["pseudoMemb"] = $pseudologin;  
                    header('Location: ../../../index.php');  
                    exit();
                } 
                elseif ($password == $values["passMemb"]) {
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);


                    sql_update("MEMBRE", "passMemb = '$hashedPassword'", "pseudoMemb = '$pseudologin'");


                    $_SESSION["pseudoMemb"] = $pseudologin;  
                    header('Location: ../../../index.php');  
                    exit();
                }
            }
        }
    }

    header('Location: ../../../login.php?error=1');
    exit();
}
?>
