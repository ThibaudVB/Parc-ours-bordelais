<?php
session_start();
include '../../../header.php';
include '../../../config.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
</head>
<body style="margin: 0; padding: 0; height: 100vh; display: flex; flex-direction: column; justify-content: flex-start;">
    <!-- Le formulaire centré et agrandi -->
    <div style="flex: 1; display: flex; justify-content: center; align-items: center; background-color: #f9f9f9;">
        <div style="width: 400px; padding: 30px; background-color: white; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            <h2 style="font-size: 30px; text-align: center; margin-bottom: 30px;">Connexion</h2>
            <form action="<?php echo ROOT_URL . '/api/security/login.php' ?>" method="POST">
                <div style="margin-bottom: 20px;">
                    <label for="pseudo" style="font-size: 18px;">Pseudo :</label><br>
                    <input type="text" name="pseudo" id="pseudo" required minlength="6" maxlength="70" 
                        style="width: 100%; padding: 15px; font-size: 16px; border: 1px solid #ccc; border-radius: 6px; box-sizing: border-box;">
                </div>

                <div style="margin-bottom: 30px;">
                    <label for="password" style="font-size: 18px;">Mot de passe :</label><br>
                    <input type="password" name="password" id="password" required minlength="8" maxlength="15" 
                        style="width: 100%; padding: 15px; font-size: 16px; border: 1px solid #ccc; border-radius: 6px; box-sizing: border-box;">
                </div>

                <button type="submit" 
                    style="width: 100%; background-color: #4CAF50; color: white; padding: 15px; font-size: 18px; border: none; border-radius: 6px; cursor: pointer;">
                    Se connecter
                </button>
            </form>
        </div>
    </div>
</body>
</html>
