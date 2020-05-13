<?php

// récupération du contenus à partir de la base de donnnée.
$page = affichePage('tutorial', $lang, $db);
$content = afficheContent('tutorial', $lang, $db);

?>

<title><?= $page['title_pages'] ?></title>

<div>
    <h1><?= $page['title_pages'] ?></h1>

    <!--Boucle affichage tutoriel-->
    <?php while ($item = mysqli_fetch_assoc($content)) { ?>

        <div>
            <h3><?= $item['title_contents'] ?></h3>
            <?php include("view/article/".$item['text_contents']) ?>
        </div>

    <?php } ?>
</div>