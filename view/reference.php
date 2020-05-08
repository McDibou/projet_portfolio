<?php
$page = affichePage('reference', $lang, $db);
$content = afficheContent('reference', $lang, $db);
?>

<title><?= $page['title_pages'] ?></title>

<h1><?= $page['title_pages'] ?></h1>
<p><?= $page['text_pages'] ?></p>

<?php while ($item = mysqli_fetch_assoc($content)) { ?>

    <div>
        <a href="<?= $item['link_contents'] ?>" target="_blank">
            <h1><?= $item['title_contents'] ?></h1>
            <p><?= $item['text_contents'] ?></p>
        </a>
    </div>

<?php } ?>

