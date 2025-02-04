<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';

$numArt = ctrlSaisies($_GET['numArt']);

// Suppression des dépendances avant de supprimer l'article
sql_delete('MOTCLEARTICLE', "numArt = $numArt");  // Supprime les mots-clés liés
sql_delete('COMMENT', "numArt = $numArt");        // Supprime les commentaires liés
sql_delete('LIKEART', "numArt = $numArt");        // Supprime les likes liés
sql_delete('ARTICLE', "numArt = $numArt");        // Supprime l'article lui-même

// Redirection vers la liste des articles
header('Location: ../../views/backend/articles/list.php');
exit;
