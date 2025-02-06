<?php
include '../../../header.php';

$membres = sql_select("MEMBRE", "*");
$articles = sql_select("ARTICLE", "*");
$comments = sql_select("COMMENT", "*");

$assoc = [];
foreach ($membres as $membre) {
    $assoc[$membre['numMemb']] = $membre['pseudoMemb'];
}
?>


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Commentaires</h1>
            <a href="create.php" class="btn btn-success">Create</a>
            <h2>Commentaires en attente</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Titre article</th>
                        <th>Pseudo</th>
                        <th>Date</th>
                        <th>Contenu</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($comments as $com) {
                        if ($com['dtModCom'] === NULL && $com['attModOK'] === 0) { ?>
                            <tr>
                                <td>
                                    <?php
                                    foreach ($articles as $art) {
                                        if ($art['numArt'] == $com['numArt']) {
                                            echo $art['libTitrArt'];
                                            break;
                                        }
                                    }
                                    ?>
                                </td>
                                <td><?php echo isset($assoc[$com['numMemb']]) ? $assoc[$com['numMemb']] : "Inconnu"; ?></td>
                                <td><?php echo ($com['dtCreaCom']); ?></td>
                                <td><?php echo htmlspecialchars($com['libCom']); ?></td>
                                <td>
                                    <a href="control.php?numCom=<?php echo ($com['numCom']); ?>" class="btn btn-primary" name="control">Control</a>
                                    </td>
                            </tr>
                        <?php }
                    } ?>
                </tbody>
            </table>
            <br>
            <h2>Commentaires controlés</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Pseudo</th>
                        <th>Dernière modif</th>
                        <th>Contenu</th>
                        <th>Publication</th>

                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($comments as $com) {
                        if ($com['attModOK'] == 1) { ?>
                            <tr>
                                <td><?php echo isset($assoc[$com['numMemb']]) ? $assoc[$com['numMemb']] : "Inconnu"; ?></td>
                                <td><?php echo ($com['dtModCom']); ?></td>
                                <td><?php echo ($com['libCom']); ?></td>
                                <td><?php echo str_replace([1, 0], ["oui", "refus"], $com['attModOK']); ?></td>
                                <td>
                                <a href="edit.php?numCom=<?php echo ($com['numCom']); ?>&etat=controlés" class="btn btn-warning">Edit</a>
                                </td>
                            </tr>
                        <?php }
                    } ?>
                </tbody>
            </table>
            <br>
            <h2>Suppression logique</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Pseudo</th>
                        <th>Date supression logique</th>
                        <th>Contenu</th>
                        <th>Publication</th>
                        <th>Raison Refus</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($comments as $com) {
                        if ($com['notifComKOAff'] !== NULL && $com['attModOK'] == 0) { ?>
                            <tr>
                                <td><?php echo isset($assoc[$com['numMemb']]) ? $assoc[$com['numMemb']] : "Inconnu"; ?></td>
                                <td><?php echo ($com['dtDelLogCom']); ?></td>
                                <td><?php echo ($com['libCom']); ?></td>
                                <td><?php echo str_replace([1, 0], ["oui", "refus"], $com['attModOK']); ?></td>
                                <td><?php echo ($com['notifComKOAff']); ?></td>
                                <td>
                                <a href="edit.php?numCom=<?php echo ($com['numCom']); ?>&etat=supr_log" class="btn btn-warning">Edit</a>
                                </td>
                            </tr>
                        <?php }
                    } ?>
                </tbody>
            </table>
            <br>
            <h2>Suppression physique</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Pseudo</th>
                        <th>Date supression logique</th>
                        <th>Contenu</th>
                        <th>Publication</th>
                        <th>Raison Refus</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($comments as $com) {
                        if ($com['notifComKOAff'] !== NULL && $com['attModOK'] == 0) { ?>
                            <tr>
                                <td><?php echo isset($assoc[$com['numMemb']]) ? $assoc[$com['numMemb']] : "Inconnu"; ?></td>
                                <td><?php echo ($com['dtDelLogCom']); ?></td>
                                <td><?php echo ($com['libCom']); ?></td>
                                <td><?php echo str_replace([1, 0], ["oui", "refus"], $com['attModOK']); ?></td>
                                <td><?php echo ($com['notifComKOAff']); ?></td>
                                <td>
                                    <a href="delete.php?numCom=<?php echo ($com['numCom']); ?>"
                                        class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        <?php }
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
include '../../../footer.php';
?>