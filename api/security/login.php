<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';

// Démarre la session pour avoir accès aux variables de session
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $pseudologin = trim($_POST['pseudo']);
    $password = $_POST['password']; 

    // Récupère les données de l'utilisateur depuis la base de données
    $pseudo = sql_select("MEMBRE", "pseudoMemb");
    $mdp = sql_select("MEMBRE", "passMemb");

    // On parcourt les pseudos récupérés pour trouver celui correspondant à l'utilisateur qui se connecte
    foreach ($pseudo as $key => $value) {
        if ($pseudologin == $value["pseudoMemb"]) {
            
            // On parcourt les mots de passe pour vérifier celui correspondant
            foreach ($mdp as $key => $values) {
                // Si le mot de passe est haché
                if (password_verify($password, $values["passMemb"])) {
                    $_SESSION["pseudoMemb"] = $pseudologin;  
                    header('Location: ../../../index.php');  
                    exit();
                } 
                // Si le mot de passe n'est pas haché (en clair)
                elseif ($password == $values["passMemb"]) {
                    // On le hache et on met à jour le mot de passe dans la base de données
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                    // Mise à jour du mot de passe haché dans la base de données
                    sql_update("MEMBRE", "passMemb = '$hashedPassword'", "pseudoMemb = '$pseudologin'");

                    // On enregistre l'utilisateur en session et on redirige
                    $_SESSION["pseudoMemb"] = $pseudologin;  
                    header('Location: ../../../index.php');  
                    exit();
                }
            }
        }
    }
    // Si aucun utilisateur trouvé, on redirige vers la page de connexion avec un message d'erreur
    header('Location: ../../../login.php?error=1');
    exit();
}
?>
