<?php
include '../../../header.php';
include __DIR__ . '/../../../perm/permission_admin.php';
require_once '../../../functions/ctrlSaisies.php';


if(isset($_GET['numArt'])){
    $numArt = $_GET['numArt'];
    $thematiques = sql_select('THEMATIQUE', '*');
    $libTitrArt = sql_select("ARTICLE", "libTitrArt", "numArt = $numArt")[0]['libTitrArt'];
    $libChapoArt = sql_select("ARTICLE", "libChapoArt", "numArt = $numArt")[0]['libChapoArt'];
    $libAccrochArt = sql_select("ARTICLE", "libAccrochArt", "numArt = $numArt")[0]['libAccrochArt'];
    $parag1Art = sql_select("ARTICLE", "parag1Art", "numArt = $numArt")[0]['parag1Art'];
    $libSsTitr1Art = sql_select("ARTICLE", "libSsTitr1Art", "numArt = $numArt")[0]['libSsTitr1Art'];
    $parag2Art = sql_select("ARTICLE", "parag2Art", "numArt = $numArt")[0]['parag2Art'];
    $libSsTitr2Art = sql_select("ARTICLE", "libSsTitr2Art", "numArt = $numArt")[0]['libSsTitr2Art'];
    $parag3Art = sql_select("ARTICLE", "parag3Art", "numArt = $numArt")[0]['parag3Art'];
    $libConclArt = sql_select("ARTICLE", "libConclArt", "numArt = $numArt")[0]['libConclArt'];
    $urlPhotArt = sql_select("ARTICLE", "urlPhotArt", "numArt = $numArt")[0]['urlPhotArt'];
    $numThem = sql_select("ARTICLE", "numThem", "numArt = $numArt")[0]['numThem'];
}
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Editer l'article</h1>
        </div>
        <div class="col-md-12">
        <form action="<?php echo ROOT_URL . '/api/articles/update.php?numArt=' . $numArt ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="libTitrArt">Titre de l'article</label>
                    <input id="libTitrArt" name="libTitrArt" class="form-control" type="text" value="<?php echo $libTitrArt; ?>" />
                </div>
                <br />
                <div class="form-group">
                    <label for="libChapoArt">Chapô de l'article</label>
                    <input id="libChapoArt" name="libChapoArt" class="form-control" type="text" value="<?php echo $libChapoArt; ?>" />
                </div>
                <br />
                <div class="form-group">
                    <label for="libAccrochArt">Accroche de l'article</label>
                    <input id="libAccrochArt" name="libAccrochArt" class="form-control" type="text" value="<?php echo $libAccrochArt; ?>" />
                </div>
                <br/>
                <div class="form-group">
                    <label for="parag1Art">Premier paragraphe de l'article</label>
                    <textarea id="parag1Art" name="parag1Art" class="form-control" type="text"><?php echo ($parag1Art); ?></textarea>
                </div>
                <br />
                <div class="form-group">
                    <label for="libSsTitr1Art">Titre du second paragraphe</label>
                    <input id="libSsTitr1Art" name="libSsTitr1Art" class="form-control" type="text" value="<?php echo $libSsTitr1Art; ?>" />
                </div>
                <br/>
                <div class="form-group">
                    <label for="parag2Art">Second paragraphe de l'article</label>
                    <textarea id="parag2Art" name="parag2Art" class="form-control" type="text"><?php echo($parag2Art); ?></textarea>
                </div>
                <br />
                <div class="form-group">
                    <label for="libSsTitr2Art">Titre du troisième paragraphe</label>
                    <input id="libSsTitr2Art" name="libSsTitr2Art" class="form-control" type="text" value="<?php echo $libSsTitr2Art; ?>" />
                </div>
                <br/>
                <div class="form-group">
                    <label for="parag3Art">Troisième paragraphe de l'article</label>
                    <textarea id="parag3Art" name="parag3Art" class="form-control" type="text"><?php echo ($parag3Art); ?></textarea>
                </div>
                <div class="form-group">
                    <label for="libConclArt">Conclusion de l'article</label>
                    <textarea id="libConclArt" name="libConclArt" class="form-control" type="text"><?php echo ($libConclArt); ?></textarea>
                </div>
                <div class="form-group">
                    <p>Image actuelle</p>
                    <img width="500px" src="<?php echo ROOT_URL . '/src/uploads/' . $urlPhotArt  ?>">
                    <label for="urlPhotArt">Modifier l'image</label>
                    <input type="file" name="urlPhotArt" class="form-control" id="urlPhotArt" accept="image/*">
                </div>

                <div class="form-group">
    <br>
    <label for="numMotCle">Choisissez les mots-clés liés à l'article :</label>
    <div class="keywords-container">
        <!-- Liste des mots-clés disponibles -->
        <select id="availableKeywords" class="form-select" multiple>
            <?php
            $motsCles = sql_select('motcle', 'numMotCle, libMotCle');
            $motsClesSelectionnes = sql_select('MOTCLEARTICLE', 'numMotCle', "numArt = '$numArt'");
            $motsClesSelectionnesArray = array_column($motsClesSelectionnes, 'numMotCle');
            
            foreach ($motsCles as $motCle) {
                if (!in_array($motCle['numMotCle'], $motsClesSelectionnesArray)) {
                    echo '<option value="' . $motCle['numMotCle'] . '">' . $motCle['libMotCle'] . '</option>';
                }
            }
            ?>
        </select>

        <!-- Boutons d'action -->
        <div class="buttons">
            <button type="button" id="addKeyword">Ajouter >></button>
            <button type="button" id="removeKeyword"><< Supprimer</button>
        </div>

        <!-- Liste des mots-clés sélectionnés -->
        <select id="selectedKeywords" class="form-select" name="numMotCle[]" multiple>
            <?php
            foreach ($motsCles as $motCle) {
                if (in_array($motCle['numMotCle'], $motsClesSelectionnesArray)) {
                    echo '<option value="' . $motCle['numMotCle'] . '">' . $motCle['libMotCle'] . '</option>';
                }
            }
            ?>
        </select>
    </div>
    <small>Utilisez les boutons pour ajouter ou retirer des mots-clés.</small>
</div>

<style>
    .keywords-container {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .form-select {
        width: 200px;
        height: 150px;
    }
    .buttons {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }
</style>

<script>
    document.getElementById("addKeyword").addEventListener("click", function () {
        moveOptions("availableKeywords", "selectedKeywords");
    });
    
    document.getElementById("removeKeyword").addEventListener("click", function () {
        moveOptions("selectedKeywords", "availableKeywords");
    });

    function moveOptions(fromId, toId) {
        let from = document.getElementById(fromId);
        let to = document.getElementById(toId);
        
        Array.from(from.selectedOptions).forEach(option => {
            to.appendChild(option);
        });
    }
</script>


        
                <div class="form-group">
                    <label for="numThem">Thématique de l'article</label>    
                    <select class="form-select" name="numThem">
                        <?php foreach ($thematiques as $thematique) : ?>
                            <?php 
                                $selectedThematique = $numThem;
                                $selected = ($thematique['numThem'] == $selectedThematique) ? 'selected' : ''; 
                            ?>
                            <option value="<?php echo $thematique['numThem']; ?>" <?php echo $selected; ?>>
                                <?php echo $thematique['libThem']; ?>
                            </option>
                        <?php endforeach; ?>
                        </select>
                </div>
                <br/>
                <div class="form-group mt-2">
                    <button type="submit" class="btn btn-primary">Confirmer les modification ?</button>
                </div>
            </form>
        </div>
    </div>
</div>