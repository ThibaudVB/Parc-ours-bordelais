<?php
include '../../../header.php';
include __DIR__ . '/../../../perm/permission_admin.php';

if (isset($_GET['numMotCle'])) {
    $numMotCle = $_GET['numMotCle'];
    $libMotCle = sql_select("MOTCLE", "libMotCle", "numMotCle = $numMotCle")[0]['libMotCle'];
    $fk = sql_select("motclearticle", "numMotCle", "numMotCle = $numMotCle");
}
?>



<!-- Bootstrap form to create a new statut -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Suppression thématique</h1>
        </div>
        <div class="col-md-12">
            <!-- Form to create a new statut -->
            <form action="<?php echo ROOT_URL . '/api/keywords/delete.php' ?>" method="post">
                <div class="form-group">
                    <label for="libMotCle">Nom de la thématique</label>
                    <input id="numMotCle" name="numMotCle" class="form-control" style="display: none" type="text"
                        value="<?php echo ($numMotCle); ?>" readonly="readonly" />
                    <input id="libMotCle" name="libMotCle" class="form-control" type="text"
                        value="<?php echo ($libMotCle); ?>" readonly="readonly" disabled />
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
                    if (count($fk) != 0) {
                        echo '<button type="submit" class="btn btn-danger" disabled> Annulation impossible</button>';
                    } else {
                        echo '<button type="submit" class="btn btn-danger">Confirmer delete ? </button>';
                    }
                    ?>
                </div>
            </form>
        </div>
    </div>
</div>