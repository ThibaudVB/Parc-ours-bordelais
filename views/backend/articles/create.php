<?php
include '../../../header.php';

if (isset($_GET['libThem'])) {
    $libThem = $_GET['libThem'];
}
?>

<?php
//$bbcode = '[url=mettre le lien]mettre le commentaire[/url]';
//
//$html = str_replace(
//    ["[url=", "[/url]", "]"], 
//    ["<a href=\"", "</a>", "\">"], 
//    $bbcode
//);
//
//echo $html;
?>


<!-- Bootstrap form to create a new statut -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Création d'un article</h1>
        </div>
        <div class="col-md-12">
            <form action="<?php echo ROOT_URL . '/api/articles/create.php' ?>" method="post"
                enctype="multipart/form-data">
                <div class="form-group">
                    <label for="libTitrArt">Titre de l'article</label>
                    <input id="libTitrArt" name="libTitrArt" class="form-control" style="resize: vertical;" type="text"
                        autofocus />
                </div>
                <br />
                <div class="form-group">
                    <label for="libChapoArt">Chapô de l'article</label>
                    <input id="libChapoArt" name="libChapoArt" class="form-control" style="resize: vertical;"
                        type="text" autofocus />
                </div>
                <br />
                <div class="form-group">
                    <label for="libAccrochArt">Accroche de l'article</label>
                    <input id="libAccrochArt" name="libAccrochArt" class="form-control" style="resize: vertical;"
                        type="text" autofocus />
                </div>
                <br />
                <div class="form-group">
                    <label for="parag1Art">Paragraphe 1</label>
                    <textarea id="parag1Art" name="parag1Art" class="form-control" rows="6"
                        style="resize: vertical;"></textarea>
                </div>
                <div class="form-group">
                    <label for="libSsTitr1Art">Sous titre 1</label>
                    <textarea id="libSsTitr1Art" name="libSsTitr1Art" class="form-control" rows="6"
                        style="resize: vertical;"></textarea>
                </div>
                <br />
                <div class="form-group">
                    <label for="parag2Art">Paragraphe 2</label>
                    <textarea id="parag2Art" name="parag2Art" class="form-control" rows="6"
                        style="resize: vertical;"></textarea>
                </div>
                <div class="form-group">
                    <label for="libSsTitr2Art">Sous titre 2</label>
                    <textarea id="libSsTitr2Art" name="libSsTitr2Art" class="form-control" rows="6"
                        style="resize: vertical;"></textarea>
                </div>
                <br />
                <div class="form-group">
                    <label for="parag3Art">Paragraphe 3</label>
                    <textarea id="parag3Art" name="parag3Art" class="form-control" rows="6"
                        style="resize: vertical;"></textarea>
                </div>
                <br />
                <div class="form-group">
                    <label for="libConclArt">Conclusion de l'article</label>
                    <textarea id="libConclArt" name="libConclArt" class="form-control" rows="6"
                        style="resize: vertical;"></textarea>
                </div>
                <br />
                <div class="form-group">
                    <label for="urlPhotArt">Ajouter une image</label>
                    <input type="file" name="urlPhotArt" class="form-control" id="urlPhotArt">
                </div>
                <div class="form-group">
                <br>
    <label for="numMotCle">Choisissez les mots-clés liés à l'article :</label>
    <div class="keywords-container">
        <!-- Liste des mots-clés disponibles -->
        <select id="availableKeywords" class="form-select" multiple>
            <?php
            $motsCles = sql_select('motcle', 'numMotCle, libMotCle');
            foreach ($motsCles as $motCle) {
                echo '<option value="' . $motCle['numMotCle'] . '">' . $motCle['libMotCle'] . '</option>';
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
            <!-- Les mots-clés ajoutés apparaîtront ici -->
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

                <br />
                <br>
                <div class="form-group">
                    <label for="numThem">Thématique de l'article</label>
                    <select class="form-select" name="numThem" >
                        <?php
                        $thematiques = sql_select('thematique', 'numThem, libThem');
                        foreach ($thematiques as $thematique) {
                            echo '<option value="' . $thematique['numThem'] . '">' . $thematique['libThem'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <br />
                <div class="form-group mt-2">
                    <button type="submit" class="btn btn-primary">Confirmer create ?</button>
                </div>
            </form>
        </div>
    </div>
</div>