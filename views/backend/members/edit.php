<?php
include '../../../header.php';
include __DIR__ . '/../../../perm/permission_admin.php';

if (!isset($_GET['numMemb'])) {
    die("Aucun utilisateur sélectionné.");
}

$numMemb = $_GET['numMemb'];
$membre = sql_select('MEMBRE', '*', "numMemb = '$numMemb'")[0]; // Récupérer les infos du membre
$statuts = sql_select('STATUT', '*');
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Modification d'un membre</h1>
        </div>

        <div class="col-md-12">
            <form action="<?php echo ROOT_URL . '/api/members/update.php' ?>" id="form-update" method="post">
                <input type="hidden" name="numMemb" value="<?php echo $membre['numMemb']; ?>">

                <!-- Pseudo -->
                <div class="form-group">
                    <label for="pseudoMemb">Pseudo (non modifiable)</label>
                    <input id="pseudoMemb" name="pseudoMemb" class="form-control" type="text" value="<?php echo $membre['pseudoMemb']; ?>" readonly>
                </div>
                <br/>

                <!-- Prénom -->
                <div class="form-group">
                    <label for="prenomMemb">Prénom</label>
                    <input id="prenomMemb" name="prenomMemb" class="form-control" type="text" value="<?php echo $membre['prenomMemb']; ?>" required>
                    <ul>
                        <li id="prenom-valid" class="invalid">Un prénom doit être saisi</li>
                    </ul>
                </div>
                <br/>

                <!-- Nom -->
                <div class="form-group">
                    <label for="nomMemb">Nom</label>
                    <input id="nomMemb" name="nomMemb" class="form-control" type="text" value="<?php echo $membre['nomMemb']; ?>" required>
                    <ul>
                        <li id="nom-valid" class="invalid">Un nom doit être saisi</li>
                    </ul>
                </div>
                <br/>

                <!-- Email -->
                <div class="form-group">
                    <label for="email1">Email</label>
                    <input id="email1" name="email1" class="form-control" type="email" value="<?php echo $membre['eMailMemb']; ?>" required>
                    <ul>
                        <li id="email-valid" class="invalid">Format valide</li>
                    </ul>
                </div>
                <br/>

                <!-- Mot de passe (optionnel) -->
                <div class="form-group">
                    <label for="passMemb">Nouveau mot de passe (laisser vide pour ne pas changer)</label>
                    <input id="passMemb" name="passMemb" class="form-control" type="password">
                    <ul>
                        <li id="pass-valid" class="invalid">Au moins 8 caractères et un caractère spécial</li>
                    </ul>
                </div>
                <br/>

                <!-- Confirmation du mot de passe -->
                <div class="form-group">
                    <label for="passConfirm">Confirmer le mot de passe</label>
                    <input id="passConfirm" name="passConfirm" class="form-control" type="password">
                    <ul>
                        <li id="pass-match" class="invalid">Les mots de passe doivent correspondre</li>
                    </ul>
                </div>
                <br/>

                <!-- Statut -->
                <div class="form-group">
                    <label for="numStat">Type de profil</label>    
                    <select class="form-select" name="numStat">
                        <?php foreach ($statuts as $statut) : ?>
                            <option value="<?php echo $statut['numStat']; ?>" <?php echo ($membre['numStat'] == $statut['numStat']) ? 'selected' : ''; ?>>
                                <?php echo $statut['libStat']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <br/>

                <!-- Bouton Valider -->
                <div class="form-group mt-2">
                    <button type="submit" class="btn btn-primary" disabled>Mettre à jour</button>
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
    document.getElementById("email1").addEventListener("input", function() {
        const email = this.value;
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        document.getElementById("email-valid").className = emailPattern.test(email) ? "valid" : "invalid";
        checkFormValidity();
    });

    document.getElementById("prenomMemb").addEventListener("input", function() {
        document.getElementById("prenom-valid").className = this.value.trim() ? "valid" : "invalid";
        checkFormValidity();
    });

    document.getElementById("nomMemb").addEventListener("input", function() {
        document.getElementById("nom-valid").className = this.value.trim() ? "valid" : "invalid";
        checkFormValidity();
    });

    document.getElementById("passMemb").addEventListener("input", function() {
        document.getElementById("pass-valid").className = this.value.length >= 8 || this.value === "" ? "valid" : "invalid";
        checkPasswords();
    });

    document.getElementById("passConfirm").addEventListener("input", checkPasswords);

    function checkPasswords() {
        const pass = document.getElementById("passMemb").value;
        const passConfirm = document.getElementById("passConfirm").value;
        document.getElementById("pass-match").className = (pass === passConfirm) ? "valid" : "invalid";
        checkFormValidity();
    }

    function checkFormValidity() {
        const isValidEmail = document.getElementById("email-valid").className === "valid";
        const isValidPrenom = document.getElementById("prenom-valid").className === "valid";
        const isValidNom = document.getElementById("nom-valid").className === "valid";
        const isValidPass = document.getElementById("pass-valid").className === "valid";
        const isMatchPass = document.getElementById("pass-match").className === "valid";

        document.querySelector("button[type=submit]").disabled = !(isValidEmail && isValidPrenom && isValidNom && isValidPass && isMatchPass);
    }

    document.addEventListener("DOMContentLoaded", function () {
    checkInitialValues(); // Vérifie les valeurs chargées

    document.getElementById("email1").addEventListener("input", function() {
        validateEmail();
        checkFormValidity();
    });

    document.getElementById("prenomMemb").addEventListener("input", function() {
        validateNotEmpty("prenomMemb", "prenom-valid");
        checkFormValidity();
    });

    document.getElementById("nomMemb").addEventListener("input", function() {
        validateNotEmpty("nomMemb", "nom-valid");
        checkFormValidity();
    });

    document.getElementById("passMemb").addEventListener("input", function() {
        validatePassword();
        checkPasswords();
    });

    document.getElementById("passConfirm").addEventListener("input", checkPasswords);
});

function validateEmail() {
    const email = document.getElementById("email1").value;
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    document.getElementById("email-valid").className = emailPattern.test(email) ? "valid" : "invalid";
}

function validateNotEmpty(inputId, validationId) {
    const value = document.getElementById(inputId).value.trim();
    document.getElementById(validationId).className = value ? "valid" : "invalid";
}

function validatePassword() {
    const pass = document.getElementById("passMemb").value;
    document.getElementById("pass-valid").className = pass.length >= 8 || pass === "" ? "valid" : "invalid";
}

function checkPasswords() {
    const pass = document.getElementById("passMemb").value;
    const passConfirm = document.getElementById("passConfirm").value;
    document.getElementById("pass-match").className = (pass === passConfirm) ? "valid" : "invalid";
    checkFormValidity();
}

function checkFormValidity() {
    const isValidEmail = document.getElementById("email-valid").className === "valid";
    const isValidPrenom = document.getElementById("prenom-valid").className === "valid";
    const isValidNom = document.getElementById("nom-valid").className === "valid";
    const isValidPass = document.getElementById("pass-valid").className === "valid";
    const isMatchPass = document.getElementById("pass-match").className === "valid";

    document.querySelector("button[type=submit]").disabled = !(isValidEmail && isValidPrenom && isValidNom && isValidPass && isMatchPass);
}

// Vérifie les valeurs initiales au chargement
function checkInitialValues() {
    validateEmail();
    validateNotEmpty("prenomMemb", "prenom-valid");
    validateNotEmpty("nomMemb", "nom-valid");
    validatePassword();
    checkPasswords();
}

</script>

<?php include '../../../footer.php'; ?>
