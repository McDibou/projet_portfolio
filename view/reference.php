<?php

// récupération du contenus à partir de la base de donnnée.
$page = affichePage('reference', $lang, $db);
$content = afficheContentImg('reference', $lang, $db);

?>

<title><?= $page['title_pages'] ?></title>

<div>

    <div>
        <h1><?= $page['title_pages'] ?></h1>
        <p><?= $page['text_pages'] ?></p>
    </div>

    <div>
        <!--Boucle affichage favoris-->
        <?php while ($item = mysqli_fetch_assoc($content)) { ?>

            <a href="<?= $item['link_contents'] ?>" target="_blank">

                <button>
                    <img style="width: 10%" src="view/img/<?= $item['name_pics'] ?>">

                    <div>
                        <h1><?= $item['title_contents'] ?></h1>
                        <p><?= $item['text_contents'] ?></p>
                        <p><?= dateTime($item['date_contents']) ?></p>
                    </div>
                </button>
            </a>
        <?php } ?>
    </div>
</div>