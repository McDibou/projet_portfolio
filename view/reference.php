<?php

// récupération du contenus à partir de la base de donnnée.
$page = affichePage('reference', $lang, $db);
$content = afficheContentImg('reference', $lang, $db);

?>
<style>
    body {
        background: linear-gradient(340deg, rgb(158, 121, 255) 10%, rgb(139, 244, 195) 80%) fixed;
    }
</style>
<title><?= $page['title_pages'] ?></title>

<body>

<div class="container d-flex flex-column text-center col-lg-6 col-8">

    <div class="my-5">
        <h1 class="display-4 my-3"><?= $page['title_pages'] ?></h1>
        <p><?= $page['text_pages'] ?></p>
    </div>

    <!--Boucle affichage favoris-->
    <?php while ($item = mysqli_fetch_assoc($content)) { ?>
        <div class="card mb-4 text-center" style="background-color: rgba(255,255,255,0.87)">
            <a class="nav-link" style="color: black" href="<?= $item['link_contents'] ?>" target="_blank">
                <div class="row d-flex  align-items-center">
                    <div class="col-md-4">
                        <img class="card-img p-2" style="max-width: 170px; max-height: 170px;"
                             src="view/img/<?= $item['name_pics'] ?>">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title text-right"><?= $item['title_contents'] ?></h5>
                            <p class="card-text text-justify"><?= $item['text_contents'] ?></p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    <?php } ?>
</div>

</body>

