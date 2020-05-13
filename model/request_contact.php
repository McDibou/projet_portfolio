<?php

// verify_contact.php
function insertForms($title, $text, $id, $db)
{
    mysqli_query($db, "INSERT INTO forms ( title_forms, text_forms, users_id) VALUES ( '$title', '$text', $id);");
}