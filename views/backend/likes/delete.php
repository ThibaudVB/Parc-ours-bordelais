<?php
include '../../../header.php';

$numArt = $_GET["numArt"];
$numMemb = $_GET["numMemb"];

$like = sql_select("LIKEART", "*", "numArt = $numArt AND numMemb = $numMemb");
$article = sql_select("ARTICLE", "*", "numArt = $numArt");
$libTitrArt = $article[0]["libTitrArt"];
$membre = sql_select("MEMBRE", "*", "numMemb = $numMemb");
$pseudoMemb = $membre[0]["pseudoMemb"];
?>

<!-- Formulaire de suppression -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Suppression d'un Like</h1>
            <p>Voulez-vous vraiment supprimer le like de <strong><?php echo $pseudoMemb; ?></strong> sur l'article <strong><?php echo $libTitrArt; ?></strong> ?</p>
        </div>
        <div class="col-md-12">
        <form action="<?php echo ROOT_URL . '/api/likes/delete.php' ?>" method="POST">
    <input type="hidden" name="numArt" value="<?php echo $numArt; ?>">
    <input type="hidden" name="numMemb" value="<?php echo $numMemb; ?>">
    <button type="submit" class="btn btn-danger">Supprimer</button>
    <a href="../../views/backend/likes/list.php" class="btn btn-secondary">Annuler</a>
</form>

        </div>
    </div>
</div>
