<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';
require_once '../../functions/getExistPseudo.php';


//Fonctionne
$error = false;
if (!empty($_POST['nomMemb']) || !empty($_POST['prenomMemb'])) {
    $nom = ctrlSaisies($_POST['nomMemb']);
    $prenom = ctrlSaisies($_POST['prenomMemb']);
}else{
    die("Les champs nom et prénom sont obligatoires.");
    
}

//Fonctionne
$pseudo = ctrlSaisies($_POST['pseudoMemb']);
if (strlen($pseudo) < 6 || strlen($pseudo) > 70) {
    die("Le pseudo doivent être compris entre 6 et 70 caractères");
    $error = true;
}
elseif (get_ExistPseudo($pseudo) > 0) {
    die("Le pseudo existe déjà.");
    $error = true;
}

$dateCreation = date("Y-m-d H:i:s"); 
$dtMajMemb = NULL; 


//Fonctionne
if (isset($_POST['email1']) && isset($_POST['email2'])) {

    $email1 = $_POST['email1'];
    $email2 = $_POST['email2'];
    
    $patternMail = '/^[^\s@]+@[^\s@]+\.[^\s@]+$/';

    if (!preg_match($patternMail, $email1) || !preg_match($patternMail, $email2)) {
        die("Veuillez saisir des adresses email valides.");
        $error = true;
    }
    
    if ($email1 !== $email2) {
        die("Les adresses email ne correspondent pas.");
        $error = true;
    }

}else{
    die("Veuillez saisir des adresses email.");
    $error = true;
}

//Fonctionne
$mdp1 = $_POST['passMemb1'];
$mdp2 = $_POST['passMemb2'];
if (!empty($_POST['passMemb1']) && !empty($_POST['passMemb2'])) {

    $mdp1 = $_POST['passMemb1'];
    $mdp2 = $_POST['passMemb2'];

    $patternMdp = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,15}$/';

    if (!preg_match($patternMdp, $mdp1) || !preg_match($patternMdp, $mdp2)) {
        die("Les mots de passe doivent être compris entre 8 et 15 caractères, avec au moins une majuscule, une minuscule, un chiffre et un caractère spécial.");
        $error = true;
    }
    
    if ($mdp1 !== $mdp2) {
        die("Les mots de passe ne correspondent pas.");
        $error = true;
    }
    
}else{
    die("Veuillez saisir un mot de passe");
    $error = true;
}

$accordMemb = $_POST["accordMemb"];
if ($accordMemb !== '1') {
    die("Vous devez accepter que vos données soient conservées pour créer un compte.");
}

$numStat = $_POST['numStat'];

if(isset($_POST['g-recaptcha-response'])){
    $token = $_POST['g-recaptcha-response'];
    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $data = array(
    'secret' => '6LdQWmopAAAAAFJwZcwJIeIXMggmABmNB26d20wg8',
    'response' => $token
    );
    $options = array(
    'http' => array (
    
    'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
    
    'method' => 'POST',
    'content' => http_build_query($data)
    )
    );
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    $response = json_decode($result);
    
    if ($response->success && $response->score >= 0.5) {
   
    var_dump(array('success' => true, "msg"=>"You are not a robot!",
    "response"=>$response));
    }else{
    var_dump(array('success' => false, "msg"=>"You are a robot!",
    "response"=>$response));
    die("Vous êtes un robot");
    }
}


if (!$error){
    $mdpHash = password_hash($mdp1, PASSWORD_DEFAULT);
    sql_insert('MEMBRE', 'nomMemb, prenomMemb, pseudoMemb, passMemb, eMailMemb, accordMemb, numStat', " '$nom', '$prenom', '$pseudo', '$mdpHash', '$email1', 1, '$numStat'");

    session_start();
    $_SESSION['logged_in'] = true;
    $_SESSION['username'] = $pseudo;
    ?>

    <?php
}else{
    die("erreur");
}

header('Location: ../../views/backend/members/list.php');
?>