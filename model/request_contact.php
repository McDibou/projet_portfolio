<?php

// verify_contact.php
function insertForms($title, $text, $mailUser, $id, $db)
{
    mysqli_query($db, "INSERT INTO forms ( title_forms, text_forms, mail_forms, users_id) VALUES ( '$title', '$text', '$mailUser', $id);");
}

function insertNoUserForms($title, $text, $mailUser, $db)
{
    mysqli_query($db, "INSERT INTO forms ( title_forms, text_forms, mail_forms) VALUES ( '$title', '$text', '$mailUser');");
}