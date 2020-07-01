<?php
// récupération du contenus à partir de la base de donnnée.
$controller = afficheCrontrollerTab('contact', $lang, $db);
// insertion du model pour insertion de formulaire
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'model' . DIRECTORY_SEPARATOR . 'request_contact.php';

//Si l utlisateur envoie formulaire
if (isset($_POST['forms'])) {

    //recuperation des données utilisateur
    if (!empty($_SESSION['pseudo'])) {
        $user = select('users', 'pseudo_users', $_SESSION['pseudo'], $db);
        $id = $user['id_users'];
    } else {
        $user['pseudo_users'] = 'User';
    }

    //verification des entrées utilisateur
    $title = analyse($_POST['title_forms']);
    $text = analyse($_POST['text_forms']);

    if (empty($_SESSION['pseudo'])) {
        $mail = analyse($_POST['mail_users']);
    }

    // Si toutes entrées valide, creation formulaire et envoie de mail de reception
    if ((!empty($title) && (!empty($text)))) {

        if (empty($_SESSION['pseudo'])) {
            $mailUser = $mail;
            insertNoUserForms($title, $text, $mailUser, $db);
        } else {
            $mailUser = $user['mail_users'];
            insertForms($title, $text, $mailUser, $id, $db);
        }

        $to = $mailUser;
        $subject = $controller[0];

        $message = '
<html lang="fr">
<body>
<style type="text/css"></style>
<div style=" width: 600px; padding: 3%; background: linear-gradient(40deg, rgba(45,169,202,1) -15%, rgba(134,211,103,1) 95%);; border-radius: 2rem;">
    <p style="font-size: 3rem; font-family: sans-serif">PORTFOLIO</p>
    <div style="margin: 5%; padding: 2%; background-color: #ffffff; border-radius: 0.5rem">
        <p>' . $controller[2] . ' <em>' . $user['pseudo_users'] . '</em></p>
        <div style="padding: 1%"></div>
        <div style="margin-left: 4%">
            <p>' . $controller[3] . '</p>
            <p>' . $controller[4] . '</p>
            <div style="padding: 2%"></div>
            <div style="margin-left: 4%">
                <p>' . $controller[5] . '</p>
                <p>De Laet A.</p>
            </div>
        </div>
        <hr>
    </div>
    <div style="margin: 1%; text-align: center">
        <p>' . $controller[6] . ' ' . '<a href="http://adrien.webdev-cf2m.be/projet_portfolio/"
                                target="_blank">portfolio.com</a></p>
    </div>
</div>
</body>
</html>
        ';

        $header[] = 'MIME-Version: 1.0';
        $header[] = 'Content-type: text/html; charset=UTF-8';
        $header[] = 'From: ROBOT.CONTACT <robot.portfolio@gmail.com>';
        $header[] = 'X-Mailer: PHP/' . phpversion();

        mail($to, $subject, $message, implode("\r\n", $header));

        $reception = $controller[1] . ' ' . $controller[3];

    }
}