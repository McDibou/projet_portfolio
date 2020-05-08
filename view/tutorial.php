<?php
$page = affichePage('tutorial', $lang, $db);
$content = afficheContent('tutorial', $lang, $db);

?>

<title><?= $page['title_pages'] ?></title>

<h1><?= $page['title_pages'] ?></h1>

<?php while ($item = mysqli_fetch_assoc($content)) { ?>

    <div>
        <h3><?= $item['title_contents'] ?></h3>
        <p><?= $item['text_contents'] ?></p>
    </div>

<?php } ?>


