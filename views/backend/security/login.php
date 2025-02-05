<?php

include '../../../config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Se connecter</title>
    <link rel="stylesheet" href="../../../src/css/login.css">
</head>
<body>
    <div class="login">
        <button class="return" onclick="previousPage(1)"><img class="button-return" src="/src/images/Vector.png" alt="return"> Retour </button>
        <br><br>
        <img src="/src/images/logo-marron.svg" alt="Logo" width="158.465px" height="128.826px">
        <br>
        <h1>Se connecter</h1>
        <p>Petite phrase de début pour donner envie</p>
        <form action="<?php echo ROOT_URL . '/api/security/login.php' ?>" id="form-recaptcha" method="post">
            <p><input type="text" name="pseudoMemb" value="" placeholder="nom.prenom@mail.com"></p>
            <p><input type="password" name="passMemb"id="mdp" value="" placeholder="* * * * *"></p>
            <div class="form-group">
                <input type="checkbox" id="visuMdp2" name="visuMdp" onchange="togglePasswordVisibility('mdp', 'visuMdp2')">
                <label for="visuMdp2">Afficher le mot de passe</label>
            </div>
            <div class="envoie centered">
                <p><input type="submit" name="commit" value="Se connecter"></p>
            </div>    
            <div class="signup">
                <br>
                <p>Pas encore de compte ?<a class="singup" href="signup.php">Inscrivez-vous</a></p>
            </div>
        </form>
    </div>
</body>

<script>
function previousPage(nbPage){
    window.history.go(-(nbPage));
}
function togglePasswordVisibility(passId, visuId) {
    var passInput = document.getElementById(passId);
    var visuCheckbox = document.getElementById(visuId);
    if (visuCheckbox.checked) {
        passInput.type = 'text';
    } else {
        passInput.type = 'password';
    }
}
</script>
</html>