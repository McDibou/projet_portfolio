<?php
$page = affichePage('gallery_inktober', $lang, $db);
$content = afficheImg('gallery_inktober', $lang, $db);
?>

<title><?= $page['title_pages'] ?></title>

<h1><?= $page['title_pages'] ?></h1>

<div>
    <?php while ($item = mysqli_fetch_assoc($content)) { ?>
        <img style="max-width: 20%" src="bin/img/gallery_inktober/<?= $item['name_pics'] ?>" alt="">
    <?php } ?>
</div>