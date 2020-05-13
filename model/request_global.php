<?php

function more($text)
{
    if (strlen($text) > 9) {
        return substr($text,0,9).'...';
    } else {
        return $text;
    }
}

function dateTime($temps)
{
    $temps = strtotime($temps);

    $day = date('d',$temps);
    $mouth = date('m',$temps);
    $years = date('Y',$temps);

    return $day.'/'.$mouth.'/'.$years;

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

function afficheSousPage($page_name, $lang, $db)
{
    return mysqli_query($db, "SELECT * FROM pages WHERE langages_id = '$lang' AND active_pages = 1 AND pages_id_pages = (SELECT id_pages FROM pages WHERE link_pages = '$page_name' AND langages_id = '$lang' )");
}

function afficheContentTab($page_name, $lang, $db)
{
    $value = mysqli_fetch_assoc(mysqli_query($db, 'SELECT text_contents FROM contents WHERE pages_id = (SELECT id_pages FROM pages WHERE link_pages = "' . $page_name . '" AND langages_id = "' . $lang . '" ) AND active_contents = 1'));
    return explode('|_|', $value['text_contents']);
}

function afficheCrontrollerTab($page_name, $lang, $db)
{
    $value = mysqli_fetch_assoc(mysqli_query($db, 'SELECT text_contents FROM contents WHERE link_contents = "' . $page_name . '" AND langages_id = "' . $lang . '" AND active_contents = 1'));
    return explode('|_|', $value['text_contents']);
}

function afficheContent($page_name, $lang, $db)
{
    return mysqli_query($db, "SELECT * FROM pages AS i JOIN contents AS c ON i.id_pages = c.pages_id JOIN langages AS l ON c.langages_id = l.id_langages WHERE i.link_pages = '$page_name' AND c.langages_id = '$lang' AND c.active_contents = 1 ORDER BY id_contents");
}

function afficheContentImg($page_name, $lang, $db)
{
    return mysqli_query($db, "SELECT * FROM pages AS i JOIN contents AS c ON i.id_pages = c.pages_id JOIN langages AS l ON c.langages_id = l.id_langages JOIN pics_has_contents AS pc ON c.id_contents = pc.contents_id JOIN pics AS p ON pc.pics_id = p.id_pics WHERE i.link_pages = '$page_name' AND c.langages_id = '$lang' AND c.active_contents = 1 ORDER BY id_contents");
}

function afficheInfo($id,$db)
{
    return mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM users JOIN forms ON users_id = id_users AND id_forms = $id"));
}

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

// admin_forms.php
function selectForms($db)
{
    return mysqli_query($db, 'SELECT * FROM forms LEFT JOIN users ON users_id = id_users ORDER BY date_forms DESC');
}

// CRUD_gallery.php
function selectGallery($name, $lang, $db)
{
    return mysqli_query($db, "SELECT * FROM pics JOIN pics_has_contents ON id_pics = pics_id JOIN contents ON contents_id = id_contents AND title_contents = '$name' AND langages_id = $lang");
}

// admin_reference.php
function afficheContentRef($db)
{
    return mysqli_query($db, "SELECT * FROM pages AS i JOIN contents AS c ON i.id_pages = c.pages_id JOIN langages AS l ON c.langages_id = l.id_langages JOIN pics_has_contents AS pc ON c.id_contents = pc.contents_id JOIN pics AS p ON pc.pics_id = p.id_pics WHERE i.link_pages = 'reference' ORDER BY id_contents");
}

