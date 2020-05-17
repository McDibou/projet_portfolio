<?php

// récupération du contenus à partir de la base de donnnée.
$page = affichePage('admin', $lang, $db);
$sousPage = afficheSousPage('admin', $lang, $db);

?>

<title><?= $page['title_pages'] ?></title>


<div class="page admin">
    <h1><?= $page['title_pages'] ?></h1>

    <div class="admin-block">
    <!--Boucle affichage sous pages admin-->
    <?php while ($item = mysqli_fetch_assoc($sousPage)) { ?>

        <div class="content button-admin">
            <a href="?p=<?= $item['link_pages'] ?>">
                <h2><?= $item['title_pages'] ?></h2>
            </a>
        </div>
    <?php } ?>
    </div>
</div>