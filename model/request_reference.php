<?php

// CRUD_reference.php
function imgDeleteReference($id, $db)
{
    return mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM pics JOIN pics_has_contents ON id_pics = pics_id JOIN contents ON contents_id = id_contents AND id_contents = $id"));
}

// CRUD_reference.php
function readReference($id, $page_name, $db)
{
    return mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM pages AS i JOIN contents AS c ON i.id_pages = c.pages_id JOIN pics_has_contents AS pc ON c.id_contents = pc.contents_id JOIN pics AS p ON pc.pics_id = p.id_pics WHERE i.link_pages = '$page_name' AND c.id_contents = $id"));
}

// CRUD_reference.php
function createReference($title_fr, $text_fr, $title_en, $text_en, $link, $img, $db)
{
    mysqli_begin_transaction($db, MYSQLI_TRANS_START_READ_WRITE);

    mysqli_query($db, "INSERT INTO contents(title_contents, text_contents, link_contents, active_contents, pages_id, langages_id) VALUES('$title_fr','$text_fr','$link',1,13,1),('$title_en','$text_en','$link',1,14,2);");
    mysqli_query($db, "INSERT INTO pics(name_pics,active_pics) VALUES ('$img',1);");
    mysqli_query($db, "INSERT INTO pics_has_contents(pics_id, contents_id) VALUES((SELECT id_pics FROM pics WHERE name_pics = '$img'),(SELECT id_contents FROM contents WHERE title_contents ='$title_fr' AND langages_id = 1)),((SELECT id_pics FROM pics WHERE name_pics = '$img'), (SELECT id_contents FROM contents WHERE title_contents ='$title_en' AND langages_id = 2));");

    mysqli_commit($db);
    mysqli_close($db);

}

// CRUD_reference.php
function updateReference($id, $title, $text, $link, $db)
{
    mysqli_query($db, "UPDATE contents SET title_contents='$title', text_contents=' $text', link_contents='$link' WHERE id_contents = $id");
}

// CRUD_reference.php
function updatePicsReference($id, $img_up, $db)
{
    mysqli_query($db, "UPDATE pics SET name_pics = '$img_up' WHERE id_pics = $id");
}

// CRUD_reference.php
function visibleReference($id, $active, $db)
{
    mysqli_query($db, "UPDATE contents SET active_contents = $active WHERE id_contents = $id");
}

// CRUD_reference.php
function deleteReference($delete, $db)
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