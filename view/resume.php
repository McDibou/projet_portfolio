<?php

// récupération du contenus à partir de la base de donnnée.
$page = affichePage('resume', $lang, $db);
$content = afficheContent('resume', $lang, $db);

?>
<style>
    body {
        background: linear-gradient(45deg, rgba(45, 169, 202, 1) -15%, rgba(134, 211, 103, 1) 95%);
        height: 95vh;
    }
</style>
<title><?= $page['title_pages'] ?></title>

<div class="text-center mt-5">
    <h1 class="display-4 my-3"><?= $page['title_pages'] ?></h1>
</div>