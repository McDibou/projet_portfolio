<?php
$page = affichePage('tutorial', $lang, $db);
$content = afficheContent('tutorial', $lang, $db);
?>

<title><?= $page['title_pages'] ?></title>

<h1><?= $page['title_pages'] ?></h1>

<?php while ($item = mysqli_fetch_assoc($content)) { ?>

    <div>
        <a href="?p=<?= $item['link_contents'] ?>">
            <h1><?= $item['title_contents'] ?></h1>
            <p><?= $item['text_contents'] ?></p>
        </a>
    </div>

<?php } ?>

