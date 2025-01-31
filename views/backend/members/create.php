<?php
include '../../../header.php';

$membres = sql_select('MEMBRE', '*');
$statuts = sql_select('STATUT', '*');
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Création d'un membre</h1>
        </div>
        <div class="col-md-12">
            <form action="<?php echo ROOT_URL . '/api/members/create.php' ?>" id="form-recaptcha" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="pseudoMemb">Pseudo (non modifiable)</label>
                    <input id="pseudoMemb" name="pseudoMemb" class="form-control" type="text" autofocus="autofocus" />
                    <small id="emailHelp" class="form-text text-muted">(Entre 6 et 70 car.)</small>
                </div>
                <br/>
                <div class="form-group">
                    <label for="prenomMemb">Prénom</label>
                    <input id="prenomMemb" name="prenomMemb" class="form-control" type="text" autofocus="autofocus" />
                </div>
                <br />
                <div class="form-group">
                    <label for="nomMemb">Nom</label>
                    <input id="nomMemb" name="nomMemb" class="form-control" type="text" autofocus="autofocus" />
                </div>
                <br />
                <div class="form-group">
                    <label for="passMemb1">Mot de passe</label>
                    <input id="passMemb1" name="passMemb1" class="form-control" type="password" autofocus="autofocus">
                    <small id="passHelp" class="form-text text-muted">(Entre 8 et 15 caractères, au moins une majuscule, une minuscule, un chiffre, caractères spéciaux acceptés)</small>
                </div>
                <div class="form-group">
                    <input type="checkbox" id="visuMdp1" name="visuMdp" onchange="togglePasswordVisibility('passMemb1', 'visuMdp1')">
                    <label for="visuMdp1">Afficher le mot de passe</label>
                </div>
                <br />
                <div class="form-group">
                    <label for="passMemb2">Confirmer le mot de passe</label>
                    <input id="passMemb2" name="passMemb2" class="form-control" type="password" autofocus="autofocus">
                    <small id="passHelp" class="form-text text-muted">(Entre 8 et 15 caractères, au moins une majuscule, une minuscule, un chiffre, caractères spéciaux acceptés)</small>
                </div>
                <div class="form-group">
                    <input type="checkbox" id="visuMdp2" name="visuMdp" onchange="togglePasswordVisibility('passMemb2', 'visuMdp2')">
                    <label for="visuMdp2">Afficher le mot de passe</label>
                </div>
                <br>
                <div class="form-group">
                    <label for="email1">Email</label>
                    <input id="email1" name="email1" class="form-control" type="text" autofocus="autofocus" />
                </div>
                <br>
                <div class="form-group">
                    <label for="email2">Confimation de l'email</label>
                    <input id="email2" name="email2" class="form-control" type="text" autofocus="autofocus"></input>
                </div>
                <br>
                <div class="form-group">
                    <label for="accord">J'accepte que mes données soient collectées et stockées.</label><br>
                    <input type="radio" id="oui" name="accordMemb" value="1">
                    <label for="accordMemb">Oui</label><br>
                    <input type="radio" id="non" name="accordMemb" value="0" checked >
                    <label for="accordMemb">Non</label><br>
                </div>
                <br>
                <div class="form-group">
                    <label for="numStat">Type de profil</label>    
                    <select class="form-select" name="numStat">
                        <?php foreach ($statuts as $statut) : 
                            $disabled = !($statut['numStat'] == '1') ? 'selected' : 'disabled';  ?>
                            <option value="<?php echo $statut['numStat']; ?>" <?php echo $disabled?>>
                                <?php echo $statut['libStat']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <!-- <div class="form-group">
                    <div class="form-group mt-2">
                        <button class="g-recaptcha btn btn-primary" data-sitekey="6LdQWmopAAAAAE0tYo7g6WU0cr5IGUXoke253uka" data-callback='onSubmit' data-action='submit'>Submit</button>
                    </div>
                </div> -->
                <br>
                <div class="form-group mt-2">
                    <button type="submit" class="btn btn-primary">Créer un compte</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function onSubmit(token) {
    document.getElementById("form-recaptcha").submit();
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