<?php

// récupération du contenus à partir de la base de donnnée.
$page = affichePage('error404', $lang, $db);
$content = afficheContentTab('error404', $lang, $db);

?>

<title><?= $page['title_pages'] ?></title>

<div class="page error">
    <h1><?= $page['title_pages'] ?></h1>

    <div class="content">
        <p><?= $content[0] ?></p>

        <p>
            <a href="#" onclick="history.go(-1)"><?= $content[1] ?></a>
            -
            <a href="./"><?= $content[2] ?></a>
        </p>
    </div>
</div>