<?php

if (isset($_POST['send_me']) && isset($_SESSION['role'])) {

    $item = selectForms(($_POST['send_me']), $db);

    $to = 'web2020.adrien@gmail.com';
    $subject = $item['title_forms'];
    $message = $item['text_forms'] . '' . $item['name_users'] . '' . $item['username_users'] . '' . $item['mail_users'];
    $message = str_replace("\n.", "\n..", $message);

    $header = 'MIME-Version: 1.0\r\n';
    $header .= 'Content-type: text/html; charset=UTF-8\r\n';
    $header .= 'From: WEB2020 <web2020.adrien@gmail.com>\r\n';

    mail($to, $subject, $message, $header);

    header('location: ?p=admin_forms');
    exit();
}


if (isset($_POST['oui']) && isset($_SESSION['role'])) {

    deleteForms($_POST['oui'], $db);

    header('location: ?p=admin_forms');
    exit();

}

if (isset($_POST['read']) && isset($_SESSION['role'])) {
    $read = selectForms($_POST['read'], $db);
}