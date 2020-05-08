<?php

$page = affichePage('admin', $lang, $db);

$content1 = affichePage('admin_forms', $lang, $db);
$content2 = affichePage('admin_gallery', $lang, $db);
$content3 = affichePage('admin_reference', $lang, $db);

?>

<title><?= $page['title_pages'] ?></title>

<h1><?= $page['title_pages'] ?></h1>



    <a href="?p=<?= $content1['link_pages'] ?>">
        <h1><?= $content1['title_pages'] ?></h1>
    </a>

    <a href="?p=<?= $content2['link_pages'] ?>">
        <h1><?= $content2['title_pages'] ?></h1>
    </a>

    <a href="?p=<?= $content3['link_pages'] ?>">
        <h1><?= $content3['title_pages'] ?></h1>
    </a>


