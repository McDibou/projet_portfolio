<?php

// récupération du contenus à partir de la base de donnnée.
$page = affichePage('home', $lang, $db);
$content = afficheContent('home', $lang, $db);

?>
<style>
    body {
        background: linear-gradient(45deg, rgba(45, 169, 202, 1) -15%, rgba(134, 211, 103, 1) 95%);
        height: 95vh;
    }

    .card:nth-child(1) {
        background: linear-gradient(340deg, rgb(158, 121, 255) 10%, rgb(139, 244, 195) 80%);
    }

    .card:nth-child(2) {
        background: linear-gradient(350deg, rgba(243, 160, 131, 1) 10%, rgba(216, 131, 243, 1) 80%);
    }

    .card:nth-child(3) {
        background: linear-gradient(350deg, rgb(235, 160, 76) 10%, rgb(239, 233, 89) 80%);
    }

</style>
<title><?= $page['title_pages'] ?></title>
<div class="mt-lg-5">
    <img class="img-fluid p-5 offset-lg-2 col-lg-4" src="view/img/logov1.png">

    <div class="container d-flex flex-lg-row flex-column justify-content-lg-around justify-content-center">
        <!--Boucle affichage menu home-->
        <?php while ($item = mysqli_fetch_assoc($content)) { ?>

            <div class="card col-lg-4 m-2">
                <a class="nav-link" style="color: white" href="?p=<?= $item['link_contents'] ?>">
                    <div class="row align-items-center">
                        <div class="col-6 p-0">
                            <img class="card-img p-3" src="view/img/<?= $item['text_contents'] ?>">
                        </div>
                        <div class="col-6 p-0">
                            <div class="card-body d-inline">
                                <h3 class="card-title text-right pr-3 m-0 font-weight-bold"><?= $item['title_contents'] ?></h3>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

        <?php } ?>
    </div>
</div>
