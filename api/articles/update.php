<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';

$numArt = ctrlSaisies($_POST['numArt']);
$libTitrArt = ctrlSaisies($_POST['libTitrArt']);

sql_update('ARTICLE', 'libTitrArt = "'.$libTitrArt.'"', where: "numArt = $numArt");


header('Location: ../../views/backend/articles/list.php');
