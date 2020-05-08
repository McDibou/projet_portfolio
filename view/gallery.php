<?php
$page = affichePage('gallery', $lang, $db);
$content = afficheContent('gallery', $lang, $db);

?>

    <title><?= $page['title_pages'] ?></title>

    <h1><?= $page['title_pages'] ?></h1>
    <p><?= $page['text_pages'] ?></p>

<?php while ($item = mysqli_fetch_assoc($content)) { ?>

    <div>
        <h1><?= $item['title_contents'] ?></h1>
        <p><?= $item['text_contents'] ?></p>
    </div>

<?php } ?>