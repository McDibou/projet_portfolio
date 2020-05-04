<?php
if (isset($_POST['new'])) {

    $name_users = analyse($_POST['name_users']);
    $username_users = analyse($_POST['username_users']);

    $value = select('users', 'pseudo_users', $_POST['pseudo_users'], $db);
    $compare_pseudo = $value['pseudo_users'];

    $value = select('users', 'mail_users', $_POST['mail_users'], $db);
    $compare_mail = $value['mail_users'];


    if ($_POST['mail_users'] == $compare_mail) {
        $error_mail = 'email deja utiliser';
    } else {
        $mail_users = analyse($_POST['mail_users']);
    }

    if ($_POST['pseudo_users'] == $compare_pseudo) {
        $error_psd = 'pseudo deja utiliser';
    } else {
        $pseudo_users = analyse($_POST['pseudo_users']);
    }

    if ($_POST['password_1'] != $_POST['password_2']) {
        $error_mdp = 'mot de passe pas identique';
    } else {
        $password_users = analyse($_POST['password_1']);
        $password_users = password_hash($password_users, PASSWORD_DEFAULT);
    }


    if (!empty($name_users) && !empty($username_users) && !empty($mail_users) && !empty($pseudo_users) && !empty($password_users)) {

        userCreate($name_users, $username_users, $mail_users, $pseudo_users, $password_users, $db);
        $validation = 'Merci pour votre incription vous pouvez vous connecter';

        $to = $mail_users;
        $subject = 'Validation inscription';
        $message = ' ' . $name_users . ' ' . $username_users . ' ' . $mail_users . ' ' . $password_users . ' ';

        $header = 'MIME-Version: 1.0\r\n';
        $header .= 'Content-type: text/html; charset=UTF-8\r\n';
        $header .= 'From: WEB2020 <web2020.adrien@gmail.com>\r\n';

        mail($to, $subject, $message, $header);

    }
}

if (isset($_POST['connect'])) {

    $pseudo_enter = analyse($_POST['pseudo']);
    $password_enter = analyse($_POST['password']);

    $value = select('users','pseudo_users',$pseudo_enter, $db);
    $id = $value['roles_id'];

    $value = select('roles','name_roles','admin', $db);
    $id_admin = $value['id_roles'];

    $value = (isset($id)) ? connectCompare($pseudo_enter, $id, $db) : null;
    $pseudo = $value['pseudo_users'];
    $password = $value['password_users'];

    if (($pseudo_enter === $pseudo) && (password_verify($password_enter, $password)) && ($id === $id_admin)) {

        $_SESSION['pseudo'] = $pseudo;
        $_SESSION['role'] = $id;

        header('Location: ./');

    } elseif (($pseudo_enter === $pseudo) && (password_verify($password_enter, $password))) {

        $_SESSION['pseudo'] = $pseudo;

        header('Location: ./');

    } else {

        $error_connect = 'invalide';

    }

}
