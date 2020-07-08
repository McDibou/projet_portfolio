<?php

// récupération du contenus à partir de la base de donnnée.
$page = affichePage('error404', $lang, $db);
$content = afficheContentTab('error404', $lang, $db);

?>
<style>
    body {
        background: linear-gradient(45deg, rgba(45, 169, 202, 1) -15%, rgba(134, 211, 103, 1) 95%) fixed;
    }
</style>
<title><?= $page['title_pages'] ?></title>

<div class="container text-center">
    <h1 class="display-1 my-5"><?= $page['title_pages'] ?></h1>

    <div>
        <p><?= $content[0] ?></p>

        <p>
            <a class="text-uppercase" href="#" onclick="history.go(-1)"><?= $content[1] ?></a>
            -
            <a  class="text-uppercase" href="./"><?= $content[2] ?></a>
        </p>
    </div>
</div>