<?php
include '../../../header.php';

if (isset($_GET['numArt'])) {
    $numArt = $_GET['numArt'];
    $libTitrArt = sql_select("ARTICLE", "libTitrArt", "numArt = $numArt")[0]['libTitrArt'];
    $fk = sql_select("comment, likeart, motclearticle", "numArt", "numArt = $numArt");
}
?>



<!-- Bootstrap form to create a new statut -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Suppression Article</h1>
        </div>
        <div class="col-md-12">
            <!-- Form to create a new statut -->
            <form action="<?php echo ROOT_URL . '/api/articles/delete.php' ?>" method="post">
                <div class="form-group">
                    <label for="libTitrArt">Nom de l'article</label>
                    <input id="numArt" name="numArt" class="form-control" style="display: none" type="text"
                        value="<?php echo ($numArt); ?>" readonly="readonly" />
                    <input id="libTitrArt" name="libTitrArt" class="form-control" type="text"
                        value="<?php echo ($libTitrArt); ?>" readonly="readonly" disabled />
                </div>
                <br />
                <div class="form-group mt-2">
                    <?php
                    if ($sql = "SELECT * FROM table WHERE fk IS NULL") {
                        $desactiver = true;
                    }
                    ?>

                    <a href="list.php" class="btn btn-primary">List</a>
                    <?php 
                    if (count($fk)!=0){
                        echo '<button type="submit" class="btn btn-danger" disabled> Annulation impossible</button>';
                    }
                    else {
                        echo '<button type="submit" class="btn btn-danger">Confirmer delete ? </button>';
                    }
                    ?>
                </div>
            </form>
        </div>
    </div>
</div>