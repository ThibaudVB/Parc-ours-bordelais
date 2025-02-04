<?php
include '../../../header.php';
require_once '../../../functions/ctrlSaisies.php';

if (!isset($_GET['numMemb']) || empty($_GET['numMemb'])) {
    die("Erreur : Aucun membre sélectionné.");
}

$numMemb = intval($_GET['numMemb']);
$membre = sql_select("MEMBRE", "*", "numMemb = $numMemb")[0] ?? null;

if (!$membre) {
    die("Erreur : Membre introuvable.");
}

$statut = sql_select('STATUT', 'libStat', "numStat = {$membre['numStat']}")[0]['libStat'] ?? 'Inconnu';

if ($membre['numStat'] == 1) {
    echo "<div class='container'><label>Un administrateur ne peut pas être supprimé</label></div>";
    exit;
}
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Suppression d'un membre</h1>
            <form action="<?= ROOT_URL . '/api/members/delete.php?numMemb=' . $numMemb ?>" method="post">
                <?php
                $champs = ['pseudoMemb' => 'Pseudo', 'prenomMemb' => 'Prénom', 'nomMemb' => 'Nom', 'eMailMemb' => 'Email'];
                foreach ($champs as $key => $label) {
                    echo "<div class='form-group'><label for='$key'>$label</label>
                        <input id='$key' name='$key' class='form-control' type='text' value='{$membre[$key]}' disabled/></div><br/>";
                }
                ?>
                <div class="form-group">
                    <label for="numStat">Statut</label>
                    <input id="numStat" name="numStat" class="form-control" type="text" value="<?= $statut; ?>"
                        disabled />
                </div>
                <br>
                <div class="form-group mt-2">
                    <button type="submit" class="btn btn-danger">Confirmer la suppression</button>
                </div>
            </form>
        </div>
    </div>
</div>