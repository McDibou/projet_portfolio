<?php

// récupération du contenus à partir de la base de donnnée.
$page = affichePage('gallery', $lang, $db);
$content = afficheContent('gallery', $lang, $db);

?>

<title><?= $page['title_pages'] ?></title>

<div>
    <div>
        <h1><?= $page['title_pages'] ?></h1>
        <p><?= $page['text_pages'] ?></p>
    </div>

    <div>
        <!--Boucle affichage catégories galerie-->
        <?php while ($item = mysqli_fetch_assoc($content)) { ?>
            <div>
                <div>
                    <h1><?= $item['title_contents'] ?></h1>
                    <p><?= $item['text_contents'] ?></p>
                </div>
                <div>
                    <!--Boucle affichage images liées à sa catégorie-->
                    <?php $img = selectGallery($item['title_contents'], $lang, $db) ?>

                    <?php while ($affiche = mysqli_fetch_assoc($img)) { ?>
                        <img style="max-width: 20%" src="view/img/<?= $affiche['name_pics'] ?>">
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    </div>
</div>