<?php
include '../../../header.php'; // contains the header and call to config.php
include __DIR__ . '/../../../perm/permission_admin.php';

// Load all statuts
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
                    <tr>
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
                    <?php foreach ($membres as $membre) { ?>
                        <tr>
                            <td><?php echo ($membre['numMemb']); ?></td>
                            <td><?php echo ($membre['prenomMemb'] . ' ' . $membre['nomMemb']); ?></td>
                            <td><?php echo ($membre['pseudoMemb']); ?></td>
                            <td><?php echo ($membre['eMailMemb']); ?></td>
                            <td><?php echo str_replace([1, 0], ["oui", "non"], $membre['accordMemb']); ?></td>
                            <td>
                                <?php
                                echo isset($assoc[$membre['numStat']]) ? $assoc[$membre['numStat']] : "Inconnu";
                                ?>
                            </td>
                            <td>
                                <a href="edit.php?numMemb=<?php echo ($membre['numMemb']); ?>" class="btn btn-primary">Edit</a>
                                <a href="delete.php?numMemb=<?php echo ($membre['numMemb']); ?>" class="btn btn-danger">Delete</a>
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
?>
