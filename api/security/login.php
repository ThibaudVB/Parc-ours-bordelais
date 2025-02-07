<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $pseudologin = trim($_POST['pseudo']);
    $password = $_POST['password'];

    // Récupérer les informations de l'utilisateur (pseudo et mot de passe)
    $user = sql_select("MEMBRE", "pseudoMemb, passMemb", "pseudoMemb = '$pseudologin'");

    // Vérifier si l'utilisateur existe
    if ($user) {
        // Comparer le mot de passe
        if (password_verify($password, $user[0]['passMemb'])) {
            $_SESSION["pseudoMemb"] = $pseudologin;  
            header('Location: \views\frontend\index.php');  
            exit();
        } else {
            // Mot de passe incorrect
            header('Location: ../../../login.php?error=1');
            exit();
        }
    } else {
        // Utilisateur non trouvé
        header('Location: ../../../login.php?error=1');
        exit();
    }
}
?>
