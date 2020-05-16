<?php

// récupération du contenus à partir de la base de donnnée.
$page = affichePage('gallery', $lang, $db);
$content = afficheContent('gallery', $lang, $db);

?>

<title><?= $page['title_pages'] ?></title>
<body class="fond-gallery">
<div class="page page-gallery">

    <h1><?= $page['title_pages'] ?></h1>
    <p><?= $page['text_pages'] ?></p>

    <!--Boucle affichage catégories galerie-->
    <?php while ($item = mysqli_fetch_assoc($content)) { ?>
        <div class="content gallery-content">
            <div>
                <h2><?= $item['title_contents'] ?></h2>
                <p><?= $item['text_contents'] ?></p>
            </div>
            <div class="affiche-gallery">
                <!--Boucle affichage images liées à sa catégorie-->
                <?php $img = selectGallery($item['title_contents'], $lang, $db) ?>

                <button class="slide-left" onclick="plusDivs<?= $item['link_contents'] ?>(-1)">&#10094;</button>

                <?php while ($affiche = mysqli_fetch_assoc($img)) { ?>
                    <img class="slide-<?= $item['link_contents'] ?>" src="view/img/<?= $affiche['name_pics'] ?>">
                <?php } ?>

                <button class="slide-right" onclick="plusDivs<?= $item['link_contents'] ?>(+1)">&#10095;</button>
            </div>

        </div>
    <?php } ?>
</div>
</body>