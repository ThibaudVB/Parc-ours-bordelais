<?php

$numStat = ctrlSaisies($_POST['numStat']);
$libStat = ctrlSaisies($_POST['libStat']);
sql_update(table :'STATUT', $attributs :'libStat = "'.$libStat.'"', where: "numStat = $numStat");


header('Location: ../../views/backend/statuts/list.php');