<?php
include '../../../header.php'; // contains the header and call to config.php

//Load all statuts
$membres = sql_select("MEMBRE", "*");
$statuts = sql_select("STATUT", "*");

$assoc = [];
foreach ($statuts as $statut) {
    $assoc[$statut['numStat']] = $statut['libStat'];
}
?>

<!-- Bootstrap default layout to display all statuts in foreach -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Membres</h1>
            <table class="table table-striped">
                <thead>
                        <th>Id</th>
                        <th>Nom des Membres</th>
                        <th>Pseudos</th>
                        <th>E-mails</th>
                        <th>Accord RGPD</th>
                        <th>Statut</th>
                        <th>Actions</th>
                        </tr>
                </thead>
                <tbody>
                    <?php foreach ($membres as $membres) { ?>
                        <tr>
                            <td><?php echo ($membres['numMemb']); ?></td>
                            <td><?php echo ($membres['prenomMemb'] . ' ' . $membres['nomMemb']); ?></td>
                            <td><?php echo ($membres['pseudoMemb']); ?></td>
                            <td><?php echo ($membres['eMailMemb']); ?></td>
                            <td><?php echo str_replace([1, 0], ["oui", "non"], $membres['accordMemb']); ?></td>
                            <td>
                                <?php
                                if (isset($assoc[$membres['numStat']])) {
                                    echo $assoc[$membres['numStat']];
                                } else {
                                    echo "Inconnu";
                                }
                                ?>
                            </td>
                            <td>
                                <a href="edit.php?numArt=<?php echo ($membres['numMemb']); ?>"
                                    class="btn btn-primary">Edit</a>
                                <a href="delete.php?numArt=<?php echo ($membres['numMemb']); ?>"
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