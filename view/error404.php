<?php

// récupération du contenus à partir de la base de donnnée.
$page = affichePage('error404', $lang, $db);
$content = afficheContentTab('error404', $lang, $db);

?>

<title><?= $page['title_pages'] ?></title>

<div>
    <h1><?= $page['title_pages'] ?></h1>

    <div>
        <p><?= $content[0] ?></p>

        <div>
            <a onclick="history.go(-1)"><?= $content[1] ?></a>

            <p>-</p>

            <a href="./"><?= $content[2] ?></a>
        </div>
    </div>
</div>