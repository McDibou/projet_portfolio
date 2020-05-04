<?php
$page = affichePage('reference', $lang, $db);
$content = afficheContentImg('reference', $lang, $db);
?>

<title><?= $page['title_pages'] ?></title>

<h1><?= $page['title_pages'] ?></h1>

<?php while ($item = mysqli_fetch_assoc($content)) { ?>

    <div>
        <a href="<?= $item['link_contents'] ?>" target="_blank">
            <h1><?= $item['title_contents'] ?></h1>
            <p><?= $item['text_contents'] ?></p>
            <img src="bin/img/<?= $item['name_pics'] ?>" alt="">
        </a>
    </div>

<?php } ?>

