<?php

// récupération du contenus à partir de la base de donnnée.
$page = affichePage('admin', $lang, $db);
$sousPage = afficheSousPage('admin', $lang, $db);

?>

<title><?= $page['title_pages'] ?></title>

<div>
    <h1><?= $page['title_pages'] ?></h1>

    <div>
        <!--Boucle affichage sous pages admin-->
        <?php while ($item = mysqli_fetch_assoc($sousPage)) { ?>

            <a href="?p=<?= $item['link_pages'] ?>">

                <button>
                    <h1><?= $item['title_pages'] ?></h1>
                </button>
            </a>
        <?php } ?>
    </div>
</div>