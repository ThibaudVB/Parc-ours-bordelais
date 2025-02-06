<?php
include '../../../header.php'; // contains the header and call to config.php
include __DIR__ . '/../../../perm/permission_admin.php';

//Load all statuts
$article = sql_select("ARTICLE", "*");
$motCle = sql_select("MOTCLE", "*");
$thematique = sql_select("THEMATIQUE", "*");

$motCleAssoc = [];
foreach ($motCle as $mot) {
    $motCleAssoc[$mot['numMotCle']] = $mot['libMotCle'];
}

$thematiqueAssoc = [];
foreach ($thematique as $them) {
    $thematiqueAssoc[$them['numThem']] = $them['libThem'];
}
?>

<!-- Bootstrap default layout to display all statuts in foreach -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Articles</h1>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Date</th>
                        <th>Titre</th>
                        <th>Chapeau</th>
                        <th>Accroche</th>
                        <th>Mots clés</th>
                        <th>Thématique</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($article as $article) {

                        if (isset($article['numMotCle']) && isset($motCleAssoc[$article['numMotCle']])) {
                            $motCleLib = $motCleAssoc[$article['numMotCle']];
                        } else {
                            $motCleLib = 'Non attibué';
                        }

                        if (isset($article['numThem']) && isset($thematiqueAssoc[$article['numThem']])) {
                            $thematiqueLib = $thematiqueAssoc[$article['numThem']];
                        } else {
                            $thematiqueLib = 'Non attibué';
                        }

                        ?>
                        <tr>
                            <td><?php echo ($article['numArt']); ?></td>
                            <td><?php echo ($article['dtCreaArt']); ?></td>
                            <td><?php echo ($article['libTitrArt']); ?></td>
                            <td><?php echo ($article['libChapoArt']); ?></td>
                            <td><?php echo ($article['libAccrochArt']); ?></td>
                            <td><?php echo ($motCleLib); ?></td>
                            <td><?php echo ($thematiqueLib); ?></td>
                            <td>
                                <a href="edit.php?numArt=<?php echo ($article['numArt']); ?>"
                                    class="btn btn-primary">Edit</a>
                                <a href="delete.php?numArt=<?php echo ($article['numArt']); ?>"
                                    class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <a href="create.php" class="btn btn-success">Create</a>
        </div>
    </div>
</div>
<?php
include '../../../footer.php'; // contains the footer