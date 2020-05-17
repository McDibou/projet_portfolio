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
<html lang="fr">
<body>
<div style=" width: 600px; padding: 3%; background-color: #ebebeb;">
    <div>
        <img style="width: 400px; margin: 2%" src="view/img/logov1.png" alt="logo portfolio">
    </div>
    <div style="margin: 5%; padding: 2%; background-color: #fefefe; border-radius: 0.5rem">
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
        $header[] = 'Content-type: text/html; charset="UTF-8"';
        $header[] = 'From: ROBOT.CONTACT <robot.portfolio@gmail.com>';
        $header[] = 'X-Mailer: PHP/' . phpversion();

        mail($to, $subject, $message, implode('\r\n',$header));

        $reception = $controller[1] . ' ' . $controller[3];

    }

}