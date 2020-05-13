<?php
// insertion du model d'inscription et de connexion.
require_once dirname(__DIR__) .DIRECTORY_SEPARATOR. 'model' .DIRECTORY_SEPARATOR .'request_forms.php';

//Si admin supprime un formulaire
if (isset($_POST['oui']) && isset($_SESSION['role'])) {

    deleteForms($_POST['oui'], $db);

    header('location: ?p=admin_forms');
    exit();

}

//si admin lit un formulaire
if (isset($_POST['read']) && isset($_SESSION['role'])) {

    $read = readForms($_POST['read'], $db);
    visibleForms($_POST['read'],$db);

}