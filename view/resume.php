<?php

// récupération du contenus à partir de la base de donnnée.
$page = affichePage('resume', $lang, $db);
$content = afficheContent('resume', $lang, $db);

?>

<title><?= $page['title_pages'] ?></title>

<div class="page">
    <h1><?= $page['title_pages'] ?></h1>
</div>