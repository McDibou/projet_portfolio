<?php

if (isset($_POST['import'])) {

    $img = date('U') . '_' . basename($_FILES['name_pics']['name']);
    $title = $_POST['gallery'];
    $move_img = "bin/img/$title/$img";
    move_uploaded_file($_FILES['name_pics']['tmp_name'], $move_img);

    crudCreateImg($img, $title, $db);

    header('Location: ?p=admin_gallery');

}

if (isset($_POST['visible'])) {
    imgVisisbility($_POST['visible'], 0, $db);
}

if (isset($_POST['invisible'])) {
    imgVisisbility($_POST['invisible'], 1, $db);
}

if (isset($_POST['oui'])) {

    $img = crudImgName($_POST['oui'], $db);
    $img = $img['name_pics'];

    $dir = selectContentImg($_POST['oui'], $db);
    $dir = $dir['link_contents'];

    $img = "bin/img/$dir/$img";

    if (file_exists($img)) {
        unlink($img);
    }

    crudDeleteImg($_POST['oui'], $db);
    header('Location: ?p=admin_gallery');
}