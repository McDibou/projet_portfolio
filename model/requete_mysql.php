<?php

//============================================================================================//
//REQUETE SELECT GLOBAL
//============================================================================================//

function more($text)
{
    if (strlen($text) > 9) {
        return substr($text,0,9).'...';
    } else {
        return $text;
    }
}

function analyse($name)
{
    return htmlspecialchars(strip_tags(trim($name)), ENT_QUOTES, 'UTF-8');
}

function select($tab,$sql,$name,$db)
{
    return mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM $tab WHERE $sql = '$name'"));
}

function affichePage($page_name, $lang, $db)
{
    return mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM pages WHERE link_pages = '$page_name' AND langages_id = '$lang' AND active_pages = 1"));
}

function afficheContentTab($page_name, $lang, $db)
{
    $value = mysqli_fetch_assoc(mysqli_query($db, 'SELECT text_contents FROM contents WHERE pages_id = (SELECT id_pages FROM pages WHERE link_pages = "' . $page_name . '" AND langages_id = "' . $lang . '" ) AND active_contents = 1'));
    return explode('|_|', $value['text_contents']);
}

function afficheContent($page_name, $lang, $db)
{
    return mysqli_query($db, "SELECT * FROM pages AS i JOIN contents AS c ON i.id_pages = c.pages_id JOIN langages AS l ON c.langages_id = l.id_langages WHERE i.link_pages = '$page_name' AND c.langages_id = '$lang' AND c.active_contents = 1 ORDER BY id_contents");
}

function afficheImg($page_name, $lang, $db)
{
    return mysqli_query($db, "SELECT * FROM pages AS i JOIN contents AS c ON i.id_pages = c.pages_id JOIN langages AS l ON c.langages_id = l.id_langages JOIN pics_has_contents AS pc ON c.id_contents = pc.contents_id JOIN pics AS p ON pc.pics_id = p.id_pics WHERE c.link_contents = '$page_name' AND c.langages_id = '$lang' AND c.active_contents = 1 ORDER BY id_contents");
}

function afficheContentImg($page_name, $lang, $db)
{
    return mysqli_query($db, "SELECT * FROM pages AS i JOIN contents AS c ON i.id_pages = c.pages_id JOIN langages AS l ON c.langages_id = l.id_langages JOIN pics_has_contents AS pc ON c.id_contents = pc.contents_id JOIN pics AS p ON pc.pics_id = p.id_pics WHERE i.link_pages = '$page_name' AND c.langages_id = '$lang' AND c.active_contents = 1 ORDER BY id_contents");
}

//============================================================================================//
//REQUETE SELECT
//============================================================================================//

// header.php
function afficheMenu($id, $db)
{
    return mysqli_fetch_all(mysqli_query($db, "SELECT link_pages, title_pages FROM pages WHERE langages_id = $id"));
}

// CRUD_gallery.php & CRUD_reference.php
function crudImgName($id, $db)
{
    return mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM pics WHERE id_pics = $id"));
}

// admin_gallery.php
function selectOption($lang, $db)
{
    return mysqli_query($db, "SELECT * FROM contents WHERE pages_id IN (5,6) AND langages_id = $lang");
}

// verify_connect.php
function connectCompare( $enter, $id, $db)
{
    return mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM users WHERE pseudo_users = '$enter' AND roles_id = $id"));
}

// admin_forms.php
function selectMail($db)
{
    return mysqli_query($db, 'SELECT * FROM forms LEFT JOIN users ON users_id = id_users ORDER BY date_forms DESC');
}

// CRUD_forms.php
function selectForms($id, $db)
{
    return mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM forms JOIN users ON users_id = id_users AND id_forms = $id"));
}

// admin_gallery.php
function selectImg( $lang, $db)
{
    return mysqli_query($db, "SELECT * FROM pics JOIN pics_has_contents ON id_pics = pics_id JOIN contents ON contents_id = id_contents AND langages_id = $lang");
}

// CRUD_reference.php
function selectDeleteImg($id, $db)
{
    return mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM pics JOIN pics_has_contents ON id_pics = pics_id JOIN contents ON contents_id = id_contents AND id_contents = $id"));
}

// CRUD_gallery.php
function selectContentImg($id, $db)
{
    return mysqli_fetch_assoc(mysqli_query($db, "SELECT link_contents FROM pics JOIN pics_has_contents ON id_pics = pics_id JOIN contents ON contents_id = id_contents AND id_pics = $id GROUP BY link_contents"));
}

// admin_reference.php
function afficheContentRef($db)
{
    return mysqli_query($db, "SELECT * FROM pages AS i JOIN contents AS c ON i.id_pages = c.pages_id JOIN langages AS l ON c.langages_id = l.id_langages JOIN pics_has_contents AS pc ON c.id_contents = pc.contents_id JOIN pics AS p ON pc.pics_id = p.id_pics WHERE i.link_pages = 'reference' ORDER BY id_contents");
}

// CRUD_reference.php
function crudRead($id, $page_name, $db)
{
    return mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM pages AS i JOIN contents AS c ON i.id_pages = c.pages_id JOIN pics_has_contents AS pc ON c.id_contents = pc.contents_id JOIN pics AS p ON pc.pics_id = p.id_pics WHERE i.link_pages = '$page_name' AND c.id_contents = $id"));
}

//============================================================================================//
//REQUETE INSERT
//============================================================================================//

// CRUD_reference.php
function crudCreate($title_fr, $text_fr, $title_en, $text_en, $link, $img, $db)
{
    mysqli_begin_transaction($db, MYSQLI_TRANS_START_READ_WRITE);

    mysqli_query($db, "INSERT INTO contents(title_contents, text_contents, link_contents, name_contents, active_contents, pages_id, langages_id) VALUES('$title_fr','$text_fr','$link','card_horizontal',1,13,1),('$title_en','$text_en','$link','card_horizontal',1,14,2);");
    mysqli_query($db, "INSERT INTO pics(name_pics,active_pics) VALUES ('$img',1);");
    mysqli_query($db, "INSERT INTO pics_has_contents(pics_id, contents_id) VALUES((SELECT id_pics FROM pics WHERE name_pics = '$img'),(SELECT id_contents FROM contents WHERE title_contents ='$title_fr' AND langages_id = 1)),((SELECT id_pics FROM pics WHERE name_pics = '$img'), (SELECT id_contents FROM contents WHERE title_contents ='$title_en' AND langages_id = 2));");

    mysqli_commit($db);
    mysqli_close($db);

}

// verify_connect.php
function userCreate($name_users, $username_users, $mail_users, $pseudo_users, $password_users, $db)
{
    mysqli_query($db, "INSERT INTO users ( name_users, username_users, mail_users, pseudo_users, password_users, roles_id ) VALUES ( '$name_users', '$username_users', '$mail_users', '$pseudo_users', '$password_users', 1 );");
}

// verify_contact.php
function insertMail($title, $text, $id, $db)
{
    mysqli_query($db, "INSERT INTO forms ( title_forms, text_forms, users_id) VALUES ( '$title', '$text', $id);");
}

// CRUD_gallery.php
function crudCreateImg($img, $title, $db)
{
    mysqli_begin_transaction($db, MYSQLI_TRANS_START_READ_WRITE);

    mysqli_query($db, "INSERT INTO pics(name_pics,active_pics) VALUES ('$img',1);");
    mysqli_query($db, "INSERT INTO pics_has_contents(pics_id, contents_id) VALUES((SELECT id_pics FROM pics WHERE name_pics = '$img'),(SELECT id_contents FROM contents WHERE link_contents ='$title' AND langages_id = 1)),((SELECT id_pics FROM pics WHERE name_pics = '$img'), (SELECT id_contents FROM contents WHERE link_contents ='$title' AND langages_id = 2));");

    mysqli_commit($db);
    mysqli_close($db);
}

//============================================================================================//
//REQUETE UPDATE
//============================================================================================//

// CRUD_reference.php
function crudUpdate($id, $title, $text, $link, $db)
{
    mysqli_query($db, "UPDATE contents SET title_contents='$title', text_contents=' $text', link_contents='$link' WHERE id_contents = $id");
}

// CRUD_reference.php
function crudUpdatePics($id, $img_up, $img, $db)
{
    mysqli_query($db, "UPDATE pics SET name_pics = '$img_up' WHERE id_pics = $id");
}

// CRUD_reference.php
function crudVisisbility($id, $active, $db)
{
    mysqli_query($db, "UPDATE contents SET active_contents = $active WHERE id_contents = $id");
}

// CRUD_gallery.php
function imgVisisbility($id, $active, $db)
{
    mysqli_query($db, "UPDATE pics SET active_pics = $active WHERE id_pics = $id");
}

//============================================================================================//
//REQUETE DELETE
//============================================================================================//

// CRUD_reference.php
function crudDelete($delete, $db)
{
    mysqli_begin_transaction($db, MYSQLI_TRANS_START_READ_WRITE);

    $value = mysqli_fetch_assoc(mysqli_query($db, "SELECT pics_id FROM pics_has_contents WHERE contents_id = $delete"));
    $id_pics = (isset($value)) ? (int)implode($value) : null;

    mysqli_query($db, "DELETE FROM pics_has_contents WHERE contents_id = $delete");
    mysqli_query($db, "DELETE FROM pics WHERE id_pics = $id_pics");
    mysqli_query($db, "DELETE FROM contents WHERE id_contents = $delete");

    mysqli_commit($db);
    mysqli_close($db);
}

// CRUD_forms.php
function deleteForms($id, $db)
{
    return mysqli_query($db, " DELETE FROM forms WHERE id_forms = $id");
}

// CRUD_gallery.php
function crudDeleteImg($id, $db)
{
    mysqli_begin_transaction($db, MYSQLI_TRANS_START_READ_WRITE);

    mysqli_query($db, "DELETE FROM pics_has_contents WHERE pics_id = $id");
    mysqli_query($db, "DELETE FROM pics WHERE id_pics = $id");

    mysqli_commit($db);
    mysqli_close($db);
}