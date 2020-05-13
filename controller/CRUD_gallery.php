<?php

require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'model' . DIRECTORY_SEPARATOR . 'request_gallery.php';

if (isset($_POST['import']) && isset($_SESSION['role'])) {

    $img = date('U') . '_' . basename($_FILES['name_pics']['name']);
    $title = $_POST['gallery'];
    $move_img = "view/img/$img";
    move_uploaded_file($_FILES['name_pics']['tmp_name'], $move_img);

    createGallery($img, $title, $db);

    header('Location: ?p=admin_gallery');
    exit();
}

if (isset($_POST['visible']) && isset($_SESSION['role'])) {
    visibleGallery($_POST['visible'], 0, $db);

    header('Location: ?p=admin_gallery');
    exit();
}

if (isset($_POST['invisible']) && isset($_SESSION['role'])) {
    visibleGallery($_POST['invisible'], 1, $db);

    header('Location: ?p=admin_gallery');
    exit();
}

if (isset($_POST['oui']) && isset($_SESSION['role'])) {

    $img = crudImgName($_POST['oui'], $db);
    $img = $img['name_pics'];

    $img = "view/img/$img";

    if (file_exists($img)) {
        unlink($img);
    }

    deleteGallery($_POST['oui'], $db);

    header('Location: ?p=admin_gallery');
    exit();
}