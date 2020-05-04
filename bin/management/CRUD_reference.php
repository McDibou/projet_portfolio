<?php

//CONTENU CLIQUE READ
if (isset ($_POST['read'])) {
    $read = crudRead($_POST['read'], 'reference', $db);
}

// VIEW_UPDATE
if (isset($_POST['view_update'])) {
    $view_update = crudRead($_POST['view_update'], 'reference', $db);
}

// VIEW UPDATE PICS
if (isset($_POST['view_update_pics'])) {
    $view_update_pics = select('pics','id_pics',$_POST['view_update_pics'], $db);
}

// CREATE
if (isset($_POST['create'])) {

    $title_fr = analyse($_POST['title_contents_fr']);
    $text_fr = analyse($_POST['text_contents_fr']);
    $title_en = analyse($_POST['title_contents_en']);
    $text_en = analyse($_POST['text_contents_en']);
    $link = analyse($_POST['link_contents']);

    $img = date('U') . '_' . basename($_FILES['name_pics']['name']);

    if (!empty($title_fr) && !empty($text_fr) && !empty($title_en) && !empty($text_en) && !empty($link) && !empty($img)) {

        crudCreate($title_fr, $text_fr, $title_en, $text_en, $link, $img, $db);

        $move_img = "bin/img/$img";
        move_uploaded_file($_FILES['name_pics']['tmp_name'], $move_img);

        header('Location: ?p=admin_reference');
    }
}

// UPDATE
if (isset($_POST['update'])) {

    $title = analyse($_POST['title_contents']);
    $text = analyse($_POST['text_contents']);
    $link = analyse($_POST['link_contents']);

    if (!empty($title) && !empty($text) && !empty($link)) {
        crudUpdate($_POST['update'], $title, $text, $link, $db);
    }
}


//UPDATE PICS
if (isset($_POST['update_pics'])) {

    $img_up = date('U') . '_' . basename($_FILES['name_update_pics']['name']);
    $img = crudImgName($_POST['update_pics'], $db);
    $img = $img['name_pics'];

    if (!empty($img_up) && ($img != $img_up)) {

        $img = "bin/img/$img";

        if (file_exists($img)) {
            unlink($img);
        }
        crudUpdatePics($_POST['update_pics'], $img_up, $img, $db);

        $move_img = "bin/img/$img_up";
        move_uploaded_file($_FILES['name_update_pics']['tmp_name'], $move_img);

        header('Location: ?p=admin_reference');
    }
}

// DELETE
if (isset($_POST['oui'])) {

    $img = selectDeleteImg($_POST['oui'], $db);
    $img = $img['name_pics'];
    $img = "bin/img/$img";

    if (file_exists($img)) {
        unlink($img);
    }

    crudDelete($_POST['oui'], $db);

}


// UPDATE VIEW CONTENTS IN PAGES REFERENCES
if (isset($_POST['visible'])) {
    crudVisisbility($_POST['visible'], 0, $db);
}

if (isset($_POST['invisible'])) {
    crudVisisbility($_POST['invisible'], 1, $db);
}