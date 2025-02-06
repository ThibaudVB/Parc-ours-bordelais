<?php
include '../../../header.php';



$articles = sql_select('ARTICLE', '*');
$membres = sql_select('MEMBRE', '*');
$comments = sql_select('COMMENT','*');
$pseudoMemb = $_SESSION['pseudoMemb'];


if (isset($pseudoMemb)) {
    $membre = sql_select("MEMBRE", "*", "pseudoMemb = '" . $pseudoMemb . "'");

    $prenomMemb = $membre[0]['prenomMemb'];
    $nomMemb = $membre[0]['nomMemb'];
    $numMemb = $membre[0]['numMemb'];
}


if (isset($_GET['numCom'])) {
    $numCom = $_GET['numCom'];

    $comment = sql_select("COMMENT", "*", "numCom = '" . $numCom . "'");

    $dtCreaCom = $comment[0]['dtCreaCom'];
    $libCom = $comment[0]['libCom'];
    $attModOK = $comment[0]['attModOK'];
    $numArt = $comment[0]['numArt'];
}

    $article = sql_select("ARTICLE", "*", "numArt = '" . $numArt . "'");
    $libTitrArt = $article[0]['libTitrArt'];

    $dtModCom = date('Y-m-d H:i:s');
    $dtDelLogCom = date('Y-m-d H:i:s');
?>


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Contrôle commentaire en attente : à valider</h1>
        </div>

        <div class="col-md-12">
            <form action="<?php echo ROOT_URL . '/api/comments/delete.php'; ?>" id="form-recaptcha" method="POST"
                enctype="multipart/form-data">

                <input id="numArt" name="numArt" class="form-control" style="display: none" type="text" value="<?php echo $numArt; ?>"/>
                <input id="numMemb" name="numMemb" class="form-control" style="display: none" type="text" value="<?php echo $numMemb; ?>"/>
                <input id="dtModCom" name="dtModCom" class="form-control" style="display: none" type="text" value="<?php echo $dtModCom; ?>"/>
                <input id="numCom" name="numCom" class="form-control" style="display: none" type="text" value="<?php echo $numCom; ?>"/>
                <input id="dtDelLogCom" name="dtDelLogCom" class="form-control" style="display: none" type="text" value="<?php echo $dtDelLogCom; ?>"/>


                <p class="form-group">
                    <label for="libTitrArt">Titre de l'article</label>
                    <input id="libTitrArt" name="libTitrArt" class="form-control" type="text"
                        value="<?php echo $libTitrArt; ?>"
                        readonly>
                </p>

                <p class="form-group">
                    <label for="pseudoMemb">Pseudo</label>
                    <input id="pseudoMemb" name="pseudoMemb" class="form-control" type="text"
                        value="<?php echo $pseudoMemb?>"
                        readonly>
                </p>

                <p class="form-group">
                    <label for="dtCreaCom">Date de création</label>
                    <input id="dtCreaCom" name="dtCreaCom" class="form-control" type="text"
                        value="<?php echo $dtCreaCom ?>"
                        readonly>
                </p>

                <p class="form-group">
                    <label for="libCom">Contenu du commentaire</label>
                    <input id="libCom" name="libCom" class="form-control" type="text"
                        value="<?php echo $libCom?>"
                        readonly>
                </p>

<button type="submit" class="btn btn-danger">Supprimer définitivement
</button>

</form>


<a href="/views/backend/comments/list.php" class="btn btn-primary">List</a>