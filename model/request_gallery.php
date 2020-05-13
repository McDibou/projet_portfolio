<?php

// CRUD_gallery.php
function createGallery($img, $title, $db)
{
    mysqli_begin_transaction($db, MYSQLI_TRANS_START_READ_WRITE);

    mysqli_query($db, "INSERT INTO pics(name_pics,active_pics) VALUES ('$img',1);");
    mysqli_query($db, "INSERT INTO pics_has_contents(pics_id, contents_id) VALUES((SELECT id_pics FROM pics WHERE name_pics = '$img'),(SELECT id_contents FROM contents WHERE title_contents ='$title' AND langages_id = 1)),((SELECT id_pics FROM pics WHERE name_pics = '$img'), (SELECT id_contents FROM contents WHERE title_contents ='$title' AND langages_id = 2));");

    mysqli_commit($db);
    mysqli_close($db);
}

// CRUD_gallery.php
function visibleGallery($id, $active, $db)
{
    mysqli_query($db, "UPDATE pics SET active_pics = $active WHERE id_pics = $id");
}

// CRUD_gallery.php
function deleteGallery($id, $db)
{
    mysqli_begin_transaction($db, MYSQLI_TRANS_START_READ_WRITE);

    mysqli_query($db, "DELETE FROM pics_has_contents WHERE pics_id = $id");
    mysqli_query($db, "DELETE FROM pics WHERE id_pics = $id");

    mysqli_commit($db);
    mysqli_close($db);
}