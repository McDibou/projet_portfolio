<?php

// récupération du contenus à partir de la base de donnnée.
$page = affichePage('gallery', $lang, $db);
$content = afficheContent('gallery', $lang, $db);

?>
<style>
    body {
        background: linear-gradient(350deg, rgba(243, 160, 131, 1) 10%, rgba(216, 131, 243, 1) 80%) fixed;
    }
</style>
<title><?= $page['title_pages'] ?></title>
<body>
<div class="container d-flex flex-column text-center col-lg-5 col-md-8 col-sm-10">

    <h1 class="display-4 my-3"><?= $page['title_pages'] ?></h1>
    <p><?= $page['text_pages'] ?></p>

    <!--Boucle affichage catégories galerie-->
    <?php while ($item = mysqli_fetch_assoc($content)) { ?>

        <div class="card m-3 p-4">
            <div class="container col-8 my-5">
                <h3 class="card-title"><?= $item['title_contents'] ?></h3>
                <p class="card-text text-justify"><?= $item['text_contents'] ?></p>
            </div>

            <div id="demo" class="carousel slide carousel-fade" data-ride="carousel">
                <div class="carousel-inner">
                    <?php $img = selectGallery($item['title_contents'], $lang, $db) ?>
                    <?php $counter = 1;
                    while ($affiche = mysqli_fetch_assoc($img)) { ?>
                        <div class="carousel-item <?php if ($counter <= 1) {
                            echo " active";
                        } ?>">
                            <img class="d-block w-100" src="view/img/<?= $affiche['name_pics'] ?>">
                        </div>
                        <?php $counter++;
                    } ?>
                </div>
            </div>
        </div>

    <?php } ?>
</div>
</body>
