<?php
include '../../../header.php';
session_start(); // S'assurer que la session est démarrée

$articles = sql_select('ARTICLE', '*'); // Récupération des articles
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Création Commentaire / Article (Admin)</h1>
        </div>
        
        <div class="col-md-12">
            <form action="<?php echo ROOT_URL . '/api/comments/create.php'; ?>" id="form-recaptcha" method="post" enctype="multipart/form-data">
                
                <p class="form-group">
                    <label for="pseudoMemb">Pseudo</label>
                    <input id="pseudoMemb" name="pseudoMemb" class="form-control" type="text"
                        value="<?php echo isset($_SESSION['pseudoMemb']) ? $_SESSION['pseudoMemb'] : "Veuillez vous connecter"; ?>" 
                        disabled>
                </p>

                <p class="form-group">
                    <label for="prenomMemb">Prénom</label>
                    <input id="prenomMemb" name="prenomMemb" class="form-control" type="text"
                        value="<?php echo isset($_SESSION['prenomMemb']) ? $_SESSION['prenomMemb'] : "Veuillez vous connecter"; ?>" 
                        disabled>
                </p>

                <p class="form-group">
                    <label for="nomMemb">Nom</label>
                    <input id="nomMemb" name="nomMemb" class="form-control" type="text"
                        value="<?php echo isset($_SESSION['nomMemb']) ? $_SESSION['nomMemb'] : "Veuillez vous connecter"; ?>" 
                        disabled>
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
                    <textarea id="com" name="com" class="form-control" rows="6" placeholder="Saisissez votre commentaire"
                        style="resize: vertical;"></textarea>
                </div>

                <br>

                <button class="btn btn-primary" type="submit">Postez</button>

            </form>
        </div>
    </div>
</div>
