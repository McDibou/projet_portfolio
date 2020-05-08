<?php
$page = affichePage('home', $lang, $db);
$content = afficheContent('home', $lang, $db);

?>
<title><?= $page['title_pages'] ?></title>

<h1><?= $page['title_pages'] ?></h1>

<?php while ($item = mysqli_fetch_assoc($content)) { ?>

    <div style="width:10%"><?= $item['text_contents'] ?></div>
    <div>
        <h1><?= $item['title_contents'] ?></h1>
        <a href="?p=<?= $item['link_contents'] ?>">
            <button>GO</button>
        </a>
    </div>

<?php } ?>

