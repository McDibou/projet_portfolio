<?php
// récupération du contenus à partir de la base de donnnée.
$controller = afficheCrontrollerTab('contact', $lang, $db);
// insertion du model pour insertion de formulaire
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'model' . DIRECTORY_SEPARATOR . 'request_contact.php';

//Si l utlisateur envoie formulaire
if (isset($_POST['forms'])) {

    //recuperation des données utilisateur
    $user = select('users', 'pseudo_users', $_SESSION['pseudo'], $db);
    $id = $user['id_users'];

    //verification des entrées utilisateur
    $title = analyse($_POST['title_forms']);
    $text = analyse($_POST['text_forms']);

    // Si toutes entrées valide, creation formulaire et envoie de mail de reception
    if ((!empty($title) && (!empty($text))) && (!empty($id))) {

        insertForms($title, $text, $id, $db);

        $to = $user['mail_users'];
        $subject = $controller[0];
        $message = '
<html>
<head>
    <title> '.$controller[0].' </title>
</head>
<body>
<div>
    <img style="width: 20%" src="view/img/logov1.png" alt="logo portfolio">
</div>
<div>
    <div>
        <p>'.$controller[2].' '.$user['pseudo_users'].'</p>
        <p>'.$controller[3].'</p>
        <p>'.$controller[4].'</p>
    </div>
    <div>
        <p>'.$controller[5].'</p>
        <p>De Laet A.</p>
    </div>
    <hr>
    <div>
        <p>'.$controller[6].'</p>
        <a href="http://adrien.webdev-cf2m.be/projet_portfolio/" target="_blank">portfolio.com</a>
    </div>
</div>
</body>
</html>
        ';

        $header = 'MIME-Version: 1.0\r\n';
        $header .= 'Content-type: text/html; charset=UTF-8\r\n';
        $header .= 'From: ROBOT.CONTACT <robot.portfolio@gmail.com>\r\n';
        $header .= 'X-Mailer: PHP/' . phpversion() . '\r\n';

        mail($to, $subject, $message, $header);

        $reception = $controller[1];

    }

}