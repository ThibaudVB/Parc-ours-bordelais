<?php
include '../../../header.php';

$numArt = $_GET["numArt"];
$numMemb = $_GET["numMemb"];

$like = sql_select("LIKEART", "*", "numArt = $numArt AND numMemb = $numMemb");
$article = sql_select("ARTICLE", "*", "numArt = $numArt");
$libTitrArt = $article[0]["libTitrArt"];
$membre = sql_select("MEMBRE", "*", "numMemb = $numMemb");
$pseudoMemb = $membre[0]["pseudoMemb"];

$likeA = $like[0]["likeA"];

?>

<!-- Bootstrap form to create a new statut -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Modification d'un like</h1>
        </div>
        <div class="col-md-12">
            <form action="<?php echo ROOT_URL . '/api/likes/update.php?numArt='.$numArt ?>" method="post">
                <div class="form-group">
                    <label for="numArt">Titre de l'article</label> 
                    <input id="numArt" name="numArt" class="form-control" type="text" value="<?php echo $libTitrArt ?>" disabled></input>
                </div>
                <br>
                <div class="form-group">
                    <label for="numMemb">Pseudo de l'utilisateur</label>
                    <input id="numArt" name="numArt" class="form-control" type="text" value="<?php echo $pseudoMemb ?>" disabled></input>
                </div>
                <br>
                <div class="form-group">
                    <h3>Choix du like</h3>
                        <input type="radio" id="like" name="choixLike" value="1" <?php if ($likeA == 1) echo "checked"; ?>>
                    <label for="oui">Like</label><br>
                    <input type="radio" id="unlike" name="choixLike" value="0"  <?php if ($likeA == 0) echo "checked"; ?>>
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