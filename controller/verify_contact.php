<?php
if (isset($_POST['forms'])) {

    $user = select('users','pseudo_users',$_SESSION['pseudo'],$db);

    $id = $user['id_users'];
    $title = analyse($_POST['title_forms']);
    $text = analyse($_POST['text_forms']);

    if ((!empty($title) && (!empty($text))) && (!empty($id))) {

        insertMail($title, $text, $id, $db);

    }

    $to = $user['mail_users'];
    $subject = 'Recepection avis';
    $message = 'email bien recu. merci';

    $header = 'MIME-Version: 1.0\r\n';
    $header .= 'Content-type: text/html; charset=UTF-8\r\n';
    $header .= 'From: WEB2020 <web2020.adrien@gmail.com>\r\n';

    mail($to, $subject, $message, $header);

}