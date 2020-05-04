<?php
$page = affichePage('gallery_web_site', $lang, $db);
$content = afficheImg('gallery_web_site', $lang, $db);
?>

<title><?= $page['title_pages'] ?></title>

<h1><?= $page['title_pages'] ?></h1>

<div>
    <?php while ($item = mysqli_fetch_assoc($content)) { ?>
        <img style="max-width: 20%" src="bin/img/gallery_web_site/<?= $item['name_pics'] ?>" alt="">
    <?php } ?>
</div>
