<?php
// récupération du contenus à partir de la base de donnnée.
$content = afficheContentTab('registration_login', $lang, $db);

// insertion du model d'inscription et de connexion.
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'model' . DIRECTORY_SEPARATOR . 'request_connect.php';

//si utilisateur tente de valider son compte
if (!empty($_GET['log']) && !empty($_GET['key'])) {

    // verification si utilisateur actif sinon compare et active
    $value = select('users', 'pseudo_users', $_GET['log'], $db);
    $active = $value['active_users'];
    if ($active == '1') {

        $validation_key = $content[8];

    } else {

        // verification et comparaison d'entrer utilisateur
        $value = select('users', 'pseudo_users', $_GET['log'], $db);
        $compare_key = $value['key_users'];
        $value = select('users', 'key_users', $_GET['key'], $db);
        $compare_log = $value['pseudo_users'];

        if ($_GET['log'] == $compare_log) {
            $log = analyse($_GET['log']);
        }

        if ($_GET['key'] == $compare_key) {
            $key = analyse($_GET['key']);
        }

        if (!empty($log) && !empty($key)) {

            updateUsers($log, $db);
            $validation_key = $content[9];

        } else {

            $validation_key = $content[10];

        }
    }
}

