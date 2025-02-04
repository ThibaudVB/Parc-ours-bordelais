<?php
include '../../../header.php';

$membres = sql_select('MEMBRE', '*');
$statuts = sql_select('STATUT', '*');
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Création d'un </h1>
        </div>
        <div class="col-md-12">
            <form action="<?php echo ROOT_URL . '/api/members/create.php' ?>" id="form-recaptcha" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="pseudoMemb">Pseudo (non modifiable)</label>
                    <input id="pseudoMemb" name="pseudoMemb" class="form-control" type="text" minlength="6" maxlength="70" required>
                    <ul>
                        <li id="pseudo-length" class="invalid">Entre 6 et 70 caractères</li>
                        <li id="pseudo-unique" class="invalid">Le pseudo est disponible</li>
                    </ul>
                </div>
                <br/>
                <div class="form-group">
                    <label for="prenomMemb">Prénom</label>
                    <input id="prenomMemb" name="prenomMemb" class="form-control" type="text" required>
                </div>
                <br />
                <div class="form-group">
                    <label for="nomMemb">Nom</label>
                    <input id="nomMemb" name="nomMemb" class="form-control" type="text" required>
                </div>
                <br />
                <div class="form-group">
                    <label for="passMemb1">Mot de passe</label>
                    <div class="input-group">
                        <input id="passMemb1" name="passMemb1" class="form-control" type="password" required>
                        <button type="button" class="btn btn-outline-secondary" id="togglePassword1">👁️</button>
                    </div>
                    <ul>
                        <li id="mdp-length" class="invalid">8 à 15 caractères</li>
                        <li id="mdp-upper" class="invalid">Une majuscule</li>
                        <li id="mdp-lower" class="invalid">Une minuscule</li>
                        <li id="mdp-digit" class="invalid">Un chiffre</li>
                        <li id="mdp-special" class="invalid">Un caractère spécial (@$!%*?&)</li>
                    </ul>
                </div>
                <br />
                <div class="form-group">
                    <label for="passMemb2">Confirmer le mot de passe</label>
                    <div class="input-group">
                        <input id="passMemb2" name="passMemb2" class="form-control" type="password" required>
                        <button type="button" class="btn btn-outline-secondary" id="togglePassword2">👁️</button>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label for="email1">Email</label>
                    <input id="email1" name="email1" class="form-control" type="email" required>
                </div>
                <br>
                <div class="form-group">
                    <label for="email2">Confimation de l'email</label>
                    <input id="email2" name="email2" class="form-control" type="email" required>
                </div>
                <br>
                <div class="form-group">
                    <label for="accord">J'accepte que mes données soient collectées et stockées.</label><br>
                    <input type="radio" id="oui" name="accordMemb" value="1">
                    <label for="oui">Oui</label><br>
                    <input type="radio" id="non" name="accordMemb" value="0" checked>
                    <label for="non">Non</label><br>
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
                <br>
                <div class="form-group mt-2">
                    <button type="submit" class="btn btn-primary" disabled>Créer un compte</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .valid { color: green; }
    .invalid { color: red; }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const form = document.getElementById("form-recaptcha");
        const submitButton = document.querySelector("button[type=submit]");
        const accordOui = document.getElementById("oui");
        const pseudoInput = document.getElementById("pseudoMemb");
        const pseudoUnique = document.getElementById("pseudo-unique");

        function checkFormValidity() {
            const allValid = document.querySelectorAll(".invalid").length === 0;
            const isAccordChecked = accordOui.checked;
            submitButton.disabled = !(allValid && isAccordChecked);
            const prenomMemb = document.getElementById("prenomMemb").value.trim();
const nomMemb = document.getElementById("nomMemb").value.trim();
const areNamesFilled = prenomMemb !== "" && nomMemb !== "";

            
        }

        pseudoInput.addEventListener("input", function() {
    const pseudo = this.value;
    document.getElementById("pseudo-length").className = (pseudo.length >= 6 && pseudo.length <= 70) ? "valid" : "invalid";

    if (pseudo.length >= 6 && pseudo.length <= 70) {
        // Vérification du pseudo en appelant `create.php`
        fetch(`<?php echo ROOT_URL; ?>/api/members/create.php?pseudo=${pseudo}`)
            .then(response => response.json())
            .then(data => {
                pseudoUnique.className = data.exists ? "invalid" : "valid";
            });
    } else {
        pseudoUnique.className = "invalid";
    }
});


        document.getElementById("passMemb1").addEventListener("input", function() {
            const mdp = this.value;
            document.getElementById("mdp-length").className = (mdp.length >= 8 && mdp.length <= 15) ? "valid" : "invalid";
            document.getElementById("mdp-upper").className = /[A-Z]/.test(mdp) ? "valid" : "invalid";
            document.getElementById("mdp-lower").className = /[a-z]/.test(mdp) ? "valid" : "invalid";
            document.getElementById("mdp-digit").className = /\d/.test(mdp) ? "valid" : "invalid";
            document.getElementById("mdp-special").className = /[@$!%*?&]/.test(mdp) ? "valid" : "invalid";
        });

        form.addEventListener("input", checkFormValidity);

        document.querySelectorAll("input[name='accordMemb']").forEach(input => {
            input.addEventListener("change", checkFormValidity);
        });

        document.getElementById("togglePassword1").addEventListener("click", function() {
            const passInput = document.getElementById("passMemb1");
            passInput.type = passInput.type === "password" ? "text" : "password";
        });

        document.getElementById("togglePassword2").addEventListener("click", function() {
            const passInput = document.getElementById("passMemb2");
            passInput.type = passInput.type === "password" ? "text" : "password";
        });

        checkFormValidity();
    });
</script>

<?php include '../../../footer.php'; ?>


