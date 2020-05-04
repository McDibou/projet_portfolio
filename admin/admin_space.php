<?php

$page = affichePage('admin_space', $lang, $db);
$content = afficheContent('admin_space', $lang, $db);
?>

    <title><?= $page['title_pages'] ?></title>

<h1><?= $page['title_pages'] ?></h1>

<?php while ($item = mysqli_fetch_assoc($content)) { ?>

    <a href="?p=<?= $item['link_contents'] ?>">
        <h1><?= $item['title_contents'] ?></h1>
        <div><?= $item['text_contents'] ?></div>
    </a>

<?php } ?>

