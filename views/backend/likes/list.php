
<?php
include '../../../header.php'; 

$likes = sql_select("LIKEART", "*");
?>

<!-- Bootstrap default layout to display all statuts in foreach -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Likes</h1>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Pseudo</th>
                        <th>Titre article</th>
                        <th>Etats</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($likes as $like){ ?>
                        <tr>
                            <td><?php 
                                $numMemb = $like['numMemb'];
                                $membres = sql_select("MEMBRE", "*", "numMemb = $numMemb");
                                foreach($membres as $membre){
                                    echo($membre['pseudoMemb']);
                                }
                            ?></td>
                            <td><?php 
                                $numArt = $like['numArt'];
                                $articles = sql_select("ARTICLE", "*", "numArt = $numArt");
                                foreach($articles as $article){
                                    echo($article['libTitrArt']);
                                }
                            ?></td>
                            <td><?php
                                if ($like['likeA'] == 1){
                                    echo "Like";
                                }else{
                                    echo "unlike";
                                }
                            ?></td>
                            <td>
                                <a href="edit.php?numMemb=<?php echo($like['numMemb']); ?>& numArt=<?php echo($like['numArt']); ?>" class="btn btn-primary">Edit</a>
                                <a href="delete.php?numMemb=<?php echo($like['numMemb']); ?>& numArt=<?php echo($like['numArt']); ?>" class="btn btn-danger">Delete</a>
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
