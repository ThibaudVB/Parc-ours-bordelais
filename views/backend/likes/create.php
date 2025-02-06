<?php
include '../../../header.php';

$articles = sql_select("ARTICLE", "*");
$membres = sql_select("MEMBRE", "*");

?>

<!-- Bootstrap form to create a new statut -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Création nouveau like</h1>
        </div>
        <div class="col-md-12">
            <form action="<?php echo ROOT_URL . '/api/likes/create.php' ?>" method="post">
                <div class="form-group">
                    <label for="numArt">Titre de l'article</label>    
                    <select class="form-select" name="numArt">
                        <?php foreach ($articles as $article) : ?>
                            <option value="<?php echo $article['numArt']; ?>">
                                <?php echo $article['libTitrArt']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <br>
                <div class="form-group">
                    <label for="numMemb">Pseudo de l'utilisateur</label>    
                    <select class="form-select" name="numMemb">
                        <?php foreach ($membres as $membre) : ?>
                            <option value="<?php echo $membre['numMemb']; ?>">
                                <?php echo $membre['pseudoMemb']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <br>
                <div class="form-group">
                    <h3>Choix du like</h3>
                    <input type="radio" id="like" name="choixLike" value="1" checked>
                    <label for="oui">Like</label><br>
                    <input type="radio" id="unlike" name="choixLike" value="0">
                    <label for="non">Unlike</label><br>
                    </input>
                </div>
            <br />
            <div class="form-group mt-2">
                <button type="submit" class="btn btn-primary">Confirmer create ?</button>
            </div>
            </form>
        </div>
    </div>
</div>