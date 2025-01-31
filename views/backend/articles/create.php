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
            <form action="<?php echo ROOT_URL . '/api/articles/create.php' ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="libTitrArt">Titre de l'article</label>
                    <input id="libTitrArt" name="libTitrArt" class="form-control" style="resize: vertical;" type="text" autofocus />
                </div>
                <br />
                <div class="form-group">
                    <label for="datecreation">Date de création</label>
                    <input id="datecreation" name="dtCreaArt" class="form-control" style="resize: vertical;" type="text" autofocus />
                </div>
                <div class="form-group">
                    <label for="libChapoArt">Chapô de l'article</label>
                    <input id="libChapoArt" name="libChapoArt" class="form-control" style="resize: vertical;" type="text" autofocus />
                </div>
                <br />
                <div class="form-group">
                    <label for="libAccrochArt">Accroche de l'article</label>
                    <input id="libAccrochArt" name="libAccrochArt" class="form-control" style="resize: vertical;" type="text" autofocus />
                </div>
                <br />
                <div class="form-group">
                    <label for="parag1Art">Paragraphe 1</label>
                    <textarea id="parag1Art" name="parag1Art" class="form-control" rows="6" style="resize: vertical;"></textarea>
                </div>
                <div class="form-group">
                    <label for="sousparag1Art">Sous titre 1</label>
                    <textarea id="sousparag1Art" name="sousparag1Art" class="form-control" rows="6" style="resize: vertical;"></textarea>
                </div>
                <br />
                <div class="form-group">
                    <label for="parag2Art">Paragraphe 2</label>
                    <textarea id="parag2Art" name="parag2Art" class="form-control" rows="6" style="resize: vertical;"></textarea>
                </div>
                <div class="form-group">
                    <label for="sousparag2Art">Sous titre 2</label>
                    <textarea id="sousparag2Art" name="sousparag2Art" class="form-control" rows="6" style="resize: vertical;"></textarea>
                </div>
                <br />
                <div class="form-group">
                    <label for="parag3Art">Paragraphe 3</label>
                    <textarea id="parag3Art" name="parag3Art" class="form-control" rows="6" style="resize: vertical;"></textarea>
                </div>
                <br />
                <div class="form-group">
                    <label for="libConclArt">Conclusion de l'article</label>
                    <textarea id="libConclArt" name="libConclArt" class="form-control" rows="6" style="resize: vertical;"></textarea>
                </div>
                <br />
                <div class="form-group">
                    <label for="urlPhotArt">Ajouter une image</label>
                    <input type="file" name="urlPhotArt" class="form-control" id="urlPhotArt">
                </div>
                <br />
                <div class="form-group">
                    <label for="numThem">Thématique de l'article</label>
                    <select class="form-select" name="numThem">
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
