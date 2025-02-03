<?php
include '../../../header.php';
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
    <label for="numMotCle">Mots-clés</label>
    <select class="form-select" name="numMotCle[]" multiple>
        <?php
        $motsCles = sql_select('motcle', 'numMotCle, libMotCle');
        foreach ($motsCles as $motCle) {
            echo '<option value="' . $motCle['numMotCle'] . '">' . $motCle['libMotCle'] . '</option>';
        }
        ?>
    </select>
    <small>Maintenez la touche Ctrl (Cmd sur Mac) pour sélectionner plusieurs mots-clés.</small>
</div>


        
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