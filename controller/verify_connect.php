<?php
// récupération du contenus à partir de la base de donnnée.
$controller = afficheCrontrollerTab('registration_login', $lang, $db);

// insertion du model d'inscription et de connexion.
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'model' . DIRECTORY_SEPARATOR . 'request_connect.php';

//Si l utlisateur creer un nouveau compte
if (isset($_POST['new'])) {

    //verification des entrées utilisateur
    $name_users = analyse($_POST['name_users']);
    $username_users = analyse($_POST['username_users']);

    // verification si les données existe dans la base de donnée
    $value = select('users', 'pseudo_users', $_POST['pseudo_users'], $db);
    $compare_pseudo = $value['pseudo_users'];

    $value = select('users', 'mail_users', $_POST['mail_users'], $db);
    $compare_mail = $value['mail_users'];


    $regex_mail = preg_match('/^[A-Za-z0-9.-_]+@[A-za-z]+\.[a-z]{2,}/', $_POST['mail_users']);
    $regex_pseudo = preg_match('/^[A-Za-z0-9]+$/', $_POST['pseudo_users']);


    if ($regex_mail === 1) {
        $mail_users = analyse($_POST['mail_users']);
    } else {
        $error_mail = $controller[0];
    }

    if ($regex_pseudo === 1) {
        $pseudo_users = analyse($_POST['pseudo_users']);
    } else {
        $error_psd = $controller[1];
    }


    if (!empty($mail_users) && $mail_users == $compare_mail) {
        $error_mail = $controller[0];
    }

    if (!empty($pseudo_users) && $pseudo_users == $compare_pseudo) {
        $error_psd = $controller[1];
    }


    if ($_POST['password_1'] != $_POST['password_2']) {
        $error_mdp = $controller[2];
    } else {
        $password_users = analyse($_POST['password_1']);
        $password_users = password_hash($password_users, PASSWORD_DEFAULT);
    }

    // Si toutes entrées valide, creation utilisateur et envoie de mail d'inscription
    if (!empty($name_users) && !empty($username_users) && !empty($mail_users) && !empty($pseudo_users) && !empty($password_users)) {

        //creation d'un cle de validation
        $key = md5(microtime(TRUE) * 100000);

        createUsers($name_users, $username_users, $mail_users, $pseudo_users, $password_users, $key, $db);

        $to = $mail_users;
        $subject = $controller[4];

        $message = '
<html lang="fr">
<body>
<style type="text/css"></style>
<div style=" width: 600px; padding: 3%; background: linear-gradient(40deg, rgba(45,169,202,1) -15%, rgba(134,211,103,1) 95%);; border-radius: 2rem;">
    <p style="font-size: 3rem; font-family: sans-serif">PORTFOLIO</p>
    <div style="margin: 5%; padding: 2%; background-color: #ffffff; border-radius: 0.5rem">
        <p>' . $controller[6] . ' <em>' . $pseudo_users . '</em></p>
        <div style="padding: 1%"></div>
        <div style="margin-left: 4%">
            <p>' . $controller[7] . '</p>
            <a href="http://adrien.webdev-cf2m.be/projet_portfolio/?log=' . urlencode($pseudo_users) . '&key=' . urlencode($key) . '">' . $controller[8] . '</a>
            <div style="padding: 2%"></div>
            <div style="margin-left: 4%">
                <p>' . $controller[9] . '</p>
                <p>De Laet A.</p>
            </div>
        </div>
        <hr>
    </div>
    <div style="margin: 1%; text-align: center">
        <p>' . $controller[10] . ' ' . '<a href="http://adrien.webdev-cf2m.be/projet_portfolio/" target="_blank">portfolio.com</a></p>
    </div>
</div>
</body>
</html>
        ';


        $header[] = 'MIME-Version: 1.0';
        $header[] = 'Content-type: text/html; charset=UTF-8';
        $header[] = 'From: ROBOT.VERIFY <robot.portfolio@gmail.com>';
        $header[] = 'X-Mailer: PHP/' . phpversion();

        mail($to, $subject, $message, implode("\r\n", $header));

        $validation = $controller[3];
    }
}

//Si l utlisateur se connecte
if (isset($_POST['connect'])) {

    //verification d'entrées utilisateur et comparaison dans la base de donnée
    $pseudo_enter = analyse($_POST['pseudo']);
    $password_enter = analyse($_POST['password']);

    $value = select('users', 'pseudo_users', $pseudo_enter, $db);
    $id = $value['roles_id'];

    $value = select('roles', 'name_roles', 'admin', $db);
    $id_admin = $value['id_roles'];

    $value = select('users', 'pseudo_users', $pseudo_enter, $db);
    $active = $value['active_users'];

    $value = (isset($id)) ? compareUsers($pseudo_enter, $id, $db) : null;
    $pseudo = $value['pseudo_users'];
    $password = $value['password_users'];

    //si entrée valide et utilisateur admin, creation session admin
    if (($pseudo_enter === $pseudo) && (password_verify($password_enter, $password)) && ($id === $id_admin) && ($active == '1')) {

        $_SESSION['pseudo'] = $pseudo;
        $_SESSION['role'] = $id;

        header('Location: ./');

        //si entrée valide et utilisateu, creation session
    } elseif (($pseudo_enter === $pseudo) && (password_verify($password_enter, $password)) && ($active == '1')) {

        $_SESSION['pseudo'] = $pseudo;

        header('Location: ./');

        //si entrée non valide
    } else {

        $error_connect = $controller[5];

    }

}
