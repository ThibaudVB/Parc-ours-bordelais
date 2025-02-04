<?php
include '../../../header.php';
require_once '../../../functions/ctrlSaisies.php';

if(isset($_GET['numArt'])){
    $numArt = $_GET['numArt'];
    $thematiques = sql_select('THEMATIQUE', '*');
    $article = sql_select("ARTICLE", "*", "numArt = $numArt")[0];
    $motsClesSelectionnes = sql_select('MOTCLEARTICLE', 'numMotCle', "numArt = '$numArt'");
    $motsClesSelectionnesArray = array_column($motsClesSelectionnes, 'numMotCle');
    $motsCles = sql_select('motcle', 'numMotCle, libMotCle');
}
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Supprimer l'article</h1>
        </div>
        <div class="col-md-12">
            <form action="<?php echo ROOT_URL . '/api/articles/delete.php?numArt=' . $numArt ?>" method="post">
                <div class="form-group">
                    <label for="libTitrArt">Titre de l'article</label>
                    <textarea id="libTitrArt" name="libTitrArt" class="form-control" rows="2" readonly><?php echo $article['libTitrArt']; ?></textarea>
                </div>
                <br />
                <div class="form-group">
                    <label for="libChapoArt">Chapô de l'article</label>
                    <textarea id="libChapoArt" name="libChapoArt" class="form-control" rows="3" readonly><?php echo $article['libChapoArt']; ?></textarea>
                </div>
                <br />
                <div class="form-group">
                    <label for="libAccrochArt">Accroche de l'article</label>
                    <textarea id="libAccrochArt" name="libAccrochArt" class="form-control" rows="2" readonly><?php echo $article['libAccrochArt']; ?></textarea>
                </div>
                <br />
                <div class="form-group">
                    <label for="parag1Art">Premier paragraphe de l'article</label>
                    <textarea id="parag1Art" name="parag1Art" class="form-control" rows="5" readonly><?php echo $article['parag1Art']; ?></textarea>
                </div>
                <br />
                <div class="form-group">
                    <label for="libSsTitr1Art">Titre du second paragraphe</label>
                    <textarea id="libSsTitr1Art" name="libSsTitr1Art" class="form-control" rows="2" readonly><?php echo $article['libSsTitr1Art']; ?></textarea>
                </div>
                <br />
                <div class="form-group">
                    <label for="parag2Art">Second paragraphe de l'article</label>
                    <textarea id="parag2Art" name="parag2Art" class="form-control" rows="5" readonly><?php echo $article['parag2Art']; ?></textarea>
                </div>
                <br />
                <div class="form-group">
                    <label for="libSsTitr2Art">Titre du troisième paragraphe</label>
                    <textarea id="libSsTitr2Art" name="libSsTitr2Art" class="form-control" rows="2" readonly><?php echo $article['libSsTitr2Art']; ?></textarea>
                </div>
                <br />
                <div class="form-group">
                    <label for="parag3Art">Troisième paragraphe de l'article</label>
                    <textarea id="parag3Art" name="parag3Art" class="form-control" rows="5" readonly><?php echo $article['parag3Art']; ?></textarea>
                </div>
                <br />
                <div class="form-group">
                    <label for="libConclArt">Conclusion de l'article</label>
                    <textarea id="libConclArt" name="libConclArt" class="form-control" rows="5" readonly><?php echo $article['libConclArt']; ?></textarea>
                </div>
                <br />
                <div class="form-group">
                    <p>Image actuelle</p>
                    <img width="500px" src="<?php echo ROOT_URL . '/src/uploads/' . $article['urlPhotArt']; ?>">
                </div>
                <br />
                <div class="form-group">
                    <label>Mots-clés liés à l'article :</label>
                    <div class="keywords-container d-flex align-items-center">
                        <select id="availableKeywords" class="form-select" multiple size="8" disabled>
                            <?php
                            foreach ($motsCles as $motCle) {
                                if (!in_array($motCle['numMotCle'], $motsClesSelectionnesArray)) {
                                    echo '<option value="' . $motCle['numMotCle'] . '">' . $motCle['libMotCle'] . '</option>';
                                }
                            }
                            ?>
                        </select>
                        <div class="buttons d-flex flex-column mx-2">
                            <button type="button" id="addKeyword" disabled>Ajouter >></button>
                            <button type="button" id="removeKeyword" disabled><< Supprimer</button>
                        </div>
                        <select id="selectedKeywords" class="form-select" multiple size="8" disabled>
                            <?php
                            foreach ($motsCles as $motCle) {
                                if (in_array($motCle['numMotCle'], $motsClesSelectionnesArray)) {
                                    echo '<option value="' . $motCle['numMotCle'] . '" selected>' . $motCle['libMotCle'] . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <br />
                <div class="form-group">
                    <label for="numThem">Thématique de l'article</label>
                    <select class="form-select" name="numThem" disabled>
                        <?php foreach ($thematiques as $thematique) : ?>
                            <?php $selected = ($thematique['numThem'] == $article['numThem']) ? 'selected' : ''; ?>
                            <option value="<?php echo $thematique['numThem']; ?>" <?php echo $selected; ?>>
                                <?php echo $thematique['libThem']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <br />
                <div class="form-group mt-2">
                    <button type="submit" class="btn btn-danger">Supprimer l'article</button>
                </div>
            </form>
        </div>
    </div>
</div>