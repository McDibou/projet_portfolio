<?php

// récupération du contenus à partir de la base de donnnée.
$page = affichePage('admin', $lang, $db);
$sousPage = afficheSousPage('admin', $lang, $db);

?>
<style>
    body {
        background: linear-gradient(45deg, rgba(45, 169, 202, 1) -15%, rgba(134, 211, 103, 1) 95%) fixed;
    }
</style>
<div class="m-5"></div>
<div class="p-5"></div>
<title><?= $page['title_pages'] ?></title>


<div class="card col-lg-8 col-sm-10 mx-auto text-center my-5">
    <h1 class="display-4 my-5"><?= $page['title_pages'] ?></h1>

    <div class="d-flex flex-lg-row flex-column justify-content-around">
        <!--Boucle affichage sous pages admin-->
        <?php while ($item = mysqli_fetch_assoc($sousPage)) { ?>

            <div class="card col-lg-3 col-8 p-3 my-5 mx-auto shadow-sm bg-white rounded">
                <a class="my-auto text-decoration-none" href="?p=<?= $item['link_pages'] ?>">
                    <h3 class="text-uppercase text-dark"><?= $item['title_pages'] ?></h3>
                </a>
            </div>

        <?php } ?>
    </div>
</div>