<?php
// insertion du model pour traitement CRUD reference
require_once dirname(__DIR__) .DIRECTORY_SEPARATOR. 'model' .DIRECTORY_SEPARATOR. 'request_reference.php';

//CONTENU CLIQUE READ
if (isset ($_POST['read']) && isset($_SESSION['role'])) {
    $read = readReference($_POST['read'], 'reference', $db);
}

// VIEW_UPDATE
if (isset($_POST['view_update']) && isset($_SESSION['role'])) {
    $view_update = readReference($_POST['view_update'], 'reference', $db);
}

// VIEW UPDATE PICS
if (isset($_POST['view_update_pics']) && isset($_SESSION['role'])) {
    $view_update_pics = select('pics','id_pics',$_POST['view_update_pics'], $db);
}

// CREATE
if (isset($_POST['create']) && isset($_SESSION['role'])) {

    $title_fr = analyse($_POST['title_contents_fr']);
    $text_fr = analyse($_POST['text_contents_fr']);
    $title_en = analyse($_POST['title_contents_en']);
    $text_en = analyse($_POST['text_contents_en']);
    $link = analyse($_POST['link_contents']);

    $img = date('U') . '_' . basename($_FILES['name_pics']['name']);

    if (!empty($title_fr) && !empty($text_fr) && !empty($title_en) && !empty($text_en) && !empty($link) && !empty($img)) {

        createReference($title_fr, $text_fr, $title_en, $text_en, $link, $img, $db);

        $move_img = "view/img/$img";
        move_uploaded_file($_FILES['name_pics']['tmp_name'], $move_img);

        header('Location: ?p=admin_reference');
        exit();
    }
}

// UPDATE
if (isset($_POST['update']) && isset($_SESSION['role'])) {

    $title = analyse($_POST['title_contents']);
    $text = analyse($_POST['text_contents']);
    $link = analyse($_POST['link_contents']);

    if (!empty($title) && !empty($text) && !empty($link)) {
        updateReference($_POST['update'], $title, $text, $link, $db);
    }

    header('Location: ?p=admin_reference');
    exit();
}


//UPDATE PICS
if (isset($_POST['update_pics']) && isset($_SESSION['role'])) {

    $img_up = date('U') . '_' . basename($_FILES['name_update_pics']['name']);

    $img = crudImgName($_POST['update_pics'], $db);
    $img = $img['name_pics'];

    if (!empty($img_up) && ($img != $img_up)) {

        $img = "view/img/$img";

        if (file_exists($img)) {
            unlink($img);
        }

        updatePicsReference($_POST['update_pics'], $img_up, $db);

        $move_img = "view/img/$img_up";
        move_uploaded_file($_FILES['name_update_pics']['tmp_name'], $move_img);
    }

    header('Location: ?p=admin_reference');
    exit();
}

// DELETE
if (isset($_POST['oui']) && isset($_SESSION['role'])) {

    $img = imgDeleteReference($_POST['oui'], $db);
    $img = $img['name_pics'];
    $img = "view/img/$img";

    if (file_exists($img)) {
        unlink($img);
    }

    deleteReference($_POST['oui'], $db);

    header('Location: ?p=admin_reference');
    exit();

}


// UPDATE VIEW CONTENTS IN PAGES REFERENCES
if (isset($_POST['visible']) && isset($_SESSION['role'])) {
    visibleReference($_POST['visible'], 0, $db);

    header('Location: ?p=admin_reference');
    exit();
}

if (isset($_POST['invisible']) && isset($_SESSION['role'])) {
    visibleReference($_POST['invisible'], 1, $db);

    header('Location: ?p=admin_reference');
    exit();
}