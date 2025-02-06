<?php
include '../../../header.php';

$articles = sql_select('ARTICLE', '*');
$membres = sql_select('MEMBRE', '*');
$pseudoMemb = $_SESSION['pseudoMemb'];


if(isset($pseudoMemb)){
    $membre = sql_select("MEMBRE", "*", "pseudoMemb = '" . $pseudoMemb . "'");

    $prenomMemb = $membre[0]['prenomMemb'];
    $nomMemb = $membre[0]['nomMemb'];
    $numMemb = $membre[0]['numMemb'];
}


?>


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Création Commentaire / Article (Admin)</h1>
        </div>

        <div class="col-md-12">
            <form action="<?php echo ROOT_URL . '/api/comments/create.php'; ?>" id="form-recaptcha" method="post"
                enctype="multipart/form-data">

                                <input id="numMemb" name="numMemb" class="form-control" style="display: none" type="text" value="<?php echo ($numMemb); ?>"/>


                <p class="form-group">
                    <label for="pseudoMemb">Pseudo</label>
                    <input id="pseudoMemb" name="pseudoMemb" class="form-control" type="text"
                        value="<?php echo isset($_SESSION['pseudoMemb']) ? $_SESSION['pseudoMemb'] : "Veuillez vous connecter"; ?>"
                        readonly>
                </p>

                <p class="form-group">
                    <label for="prenomMemb">Prénom</label>
                    <input id="prenomMemb" name="prenomMemb" class="form-control" type="text" value="<?php if (isset($prenomMemb)) {
                        echo $prenomMemb;
                    } else {
                        echo 'Veuillez vous connecter';
                    } ?>" readonly>
                </p>

                <p class="form-group">
                    <label for="nomMemb">Nom</label>
                    <input id="nomMemb" name="nomMemb" class="form-control" type="text" value="<?php if (isset($nomMemb)) {
                        echo $nomMemb;
                    } else {
                        echo 'Veuillez vous connecter';
                    } ?>" readonly>
                </p>

                <div class="form-group">
                    <label for="numArt">Liste des articles</label>
                    <select class="form-select" name="numArt" required>
                        <?php foreach ($articles as $article) { ?>
                            <option value="<?php echo $article['numArt']; ?>"><?php echo $article['libTitrArt']; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <br>

                <div class="form-group">
                    <textarea id="libCom" name="libCom" class="form-control" type="text" rows="6"
                        placeholder="Saisissez votre commentaire" style="resize: vertical;"></textarea>
                </div>

                <br>

                <?php
                if (isset($_SESSION['pseudoMemb'])):
                    ?>
                    <button class="btn btn-primary" type="submit">Postez</button>
                <?php else: ?>
                    <a class="btn btn-primary m-1" href="/views/backend/security/login.php" role="button">Connectez-vous</a>
                <?php endif; ?>

            </form>
        </div>
    </div>
</div>