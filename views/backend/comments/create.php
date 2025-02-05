<?php
include '../../../header.php';

$articles = sql_select('ARTICLE', '*');
$membre = sql_select('MEMBRE', '*');

$prenomMemb = sql_select('MEMBRE', 'prenomMemb', 'pseudoMemb' == $_SESSION['username']);
$nomMemb = sql_select('MEMBRE', 'nomMemb', 'pseudoMemb' == $_SESSION['username']);

?>


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Création Commentaire / Article (Admin)</h1>
        </div>

        <div class="col-md-12">
            <form action="<?php echo ROOT_URL . '/api/comments/create.php'; ?>" id="form-recaptcha" method="post"
                enctype="multipart/form-data">

                <p class="form-group">
                    <label for="username">Pseudo</label>
                    <input id="username" name="username" class="form-control" type="text"
                        value="<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : "Veuillez vous connecter"; ?>"
                        readonly>
                </p>

                <p class="form-group">
                    <label for="prenomMemb">Prénom</label>
                    <input id="prenomMemb" name="prenomMemb" class="form-control" type="text" value="<?php if (isset($prenomMemb)) {
                        echo $prenomMemb;
                    } else {
                        echo "Veuillez vous connecter";
                    } ?>" readonly>
                </p>

                <p class="form-group">
                    <label for="nomMemb">Nom</label>
                    <input id="nomMemb" name="nomMemb" class="form-control" type="text"
                        value="<?php if (isset($nomMemb)) {
                        echo $nomMemb;
                    } else {
                        echo "Veuillez vous connecter";
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
                    <textarea id="com" name="com" class="form-control" rows="6"
                        placeholder="Saisissez votre commentaire" style="resize: vertical;"></textarea>
                </div>

                <br>

                <?php
                if (isset($_SESSION['pseudoMemb']) && isset($_SESSION['prenomMemb']) && isset($_SESSION['nomMemb']) && isset($_POST['numArt']) && isset($_POST['com'])):
                    ?>
                    <button class="btn btn-primary" type="submit">Postez</button>
                <?php else: ?>
                    <a class="btn btn-primary m-1" href="/views/backend/security/login.php" role="button">Connectez-vous</a>
                <?php endif; ?>

            </form>
        </div>
    </div>
</div>