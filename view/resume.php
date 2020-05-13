<?php

// récupération du contenus à partir de la base de donnnée.
$page = affichePage('resume', $lang, $db);
$content = afficheContent('resume', $lang, $db);

?>

<title><?= $page['title_pages'] ?></title>

<div>
    <h1><?= $page['title_pages'] ?></h1>
</div>