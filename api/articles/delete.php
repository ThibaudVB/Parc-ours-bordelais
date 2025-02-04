<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';

$numArt = ctrlSaisies($_POST['numArt']);
$motCles = sql_select("MOTCLEARTICLE", "*");

$ancienneImage = sql_select("ARTICLE", "urlPhotArt", "numArt = $numArt")[0]['urlPhotArt'];
if (!empty($ancienneImage)) {
    $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/src/uploads/';
    unlink($uploadDir . $ancienneImage);
}

foreach($motCles as $motCle){
    $numMotCle = $motCle["numMotCle"];
    $motCleArt = $motCle["numArt"];
    if($motCleArt == $numArt){
        sql_delete('MOTCLEARTICLE', "numArt = $numArt AND numMotCle = $numMotCle");
    }
}
sql_delete('ARTICLE', "numArt = $numArt");

header('Location: ../../views/backend/articles/list.php');