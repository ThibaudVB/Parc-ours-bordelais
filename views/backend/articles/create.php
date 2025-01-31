<?php
include '../../../header.php';

if (isset($_GET['libThem'])) {
    $libThem = $_GET['libThem'];
}
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
                    <label for="parag1Art">Premier paragraphe de l'article</label>
                    <textarea id="parag1Art" name="parag1Art" class="form-control" rows="6" style="resize: vertical;"></textarea>
                </div>
                <br />
                <div class="form-group">
                    <label for="libSsTitr1Art">Titre du second paragraphe</label>
                    <input id="libSsTitr1Art" name="libSsTitr1Art" class="form-control" style="resize: vertical;" type="text" autofocus />
                </div>
                <br />
                <div class="form-group">
                    <label for="parag2Art">Second paragraphe de l'article</label>
                    <textarea id="parag2Art" name="parag2Art" class="form-control" rows="6" style="resize: vertical;"></textarea>
                </div>
                <br />
                <div class="form-group">
                    <label for="libSsTitr2Art">Titre du troisième paragraphe</label>
                    <input id="libSsTitr2Art" name="libSsTitr2Art" class="form-control" style="resize: vertical;"  type="text" autofocus />
                </div>
                <br />
                <div class="form-group">
                    <label for="parag3Art">Troisième paragraphe de l'article</label>
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
                        <?php foreach ($thematiques as $thematique) : ?>
                            <option value="<?php echo $thematique['numThem']; ?>">
                                <?php echo $libThem['libThem']; ?>
                            </option>
                        <?php endforeach; ?>
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
