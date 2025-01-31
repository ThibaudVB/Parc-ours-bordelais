<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';

$libTitrArt = ctrlSaisies($_POST['libTitrArt']);

sql_insert('ARTICLE', 'libTitrArt', "'$libTitrArt'");


header('Location: ../../views/backend/articles/list.php');