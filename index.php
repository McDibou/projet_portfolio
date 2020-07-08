<?php
session_start();
//dependance general
require_once __DIR__ . DIRECTORY_SEPARATOR . 'model' . DIRECTORY_SEPARATOR . 'config.php';

require_once __DIR__ . DIRECTORY_SEPARATOR . 'model' . DIRECTORY_SEPARATOR . 'request_global.php';

require_once __DIR__ . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR . 'interface' . DIRECTORY_SEPARATOR . 'header.php';


//si utilisateur n'est pas connecter sinon acces au site && si admin acces espace admin

if (!isset($_GET["p"])) {

    include __DIR__ . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR . 'home.php';

} else {

    $p = $_GET["p"];

    switch ($p) {

        case "gallery":
            include __DIR__ . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR . 'gallery.php';
            break;

        case "reference":
            include __DIR__ . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR . 'reference.php';
            break;

        case "tutorial":
            include __DIR__ . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR . 'tutorial.php';
            break;

        case "contact":
            include __DIR__ . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR . 'contact.php';
            break;

        case "resume":
            include __DIR__ . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR . 'resume.php';
            break;

        case "admin":
            if (empty($_SESSION['pseudo'])) {
                include __DIR__ . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR . 'registration_login.php';
            } else if (isset($_SESSION['role'])) {
                include __DIR__ . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'admin_space.php';
            } else {
                include __DIR__ . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR . 'error404.php';
            }
            break;

        case "admin_forms":
            if (isset($_SESSION['role'])) {
                include __DIR__ . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'admin_forms.php';
            } else {
                include __DIR__ . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR . 'error404.php';
            }
            break;

        case "admin_gallery":
            if (isset($_SESSION['role'])) {
                include __DIR__ . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'admin_gallery.php';
            } else {
                include __DIR__ . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR . 'error404.php';
            }
            break;

        case "admin_reference":
            if (isset($_SESSION['role'])) {
                include __DIR__ . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'admin_reference.php';
            } else {
                include __DIR__ . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR . 'error404.php';
            }
            break;

        default:
            include __DIR__ . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR . 'error404.php';
            break;
    }

}

require_once __DIR__ . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR . 'interface' . DIRECTORY_SEPARATOR . 'footer.php';