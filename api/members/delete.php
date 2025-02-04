<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';

$numMemb = ctrlSaisies($_GET['numMemb']);
$numStat = sql_select("MEMBRE", "numStat", "numMemb = $numMemb")[0]['numStat'];

sql_delete('COMMENT', "numMemb = $numMemb");
sql_delete('LIKEART', "numMemb = $numMemb");
sql_delete('MEMBRE', "numMemb = $numMemb");

header('Location: ../../views/backend/members/list.php');