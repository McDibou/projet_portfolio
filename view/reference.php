<?php

// récupération du contenus à partir de la base de donnnée.
$page = affichePage('reference', $lang, $db);
$content = afficheContentImg('reference', $lang, $db);

?>

<title><?= $page['title_pages'] ?></title>
<body class="fond-reference">
<div class="page page-reference">

    <h1><?= $page['title_pages'] ?></h1>
    <p><?= $page['text_pages'] ?></p>

    <!--Boucle affichage favoris-->
    <?php while ($item = mysqli_fetch_assoc($content)) { ?>
        <div class="content reference">
            <a href="<?= $item['link_contents'] ?>" target="_blank">

                <img src="view/img/<?= $item['name_pics'] ?>">

                <div>
                    <h2><?= $item['title_contents'] ?></h2>
                    <p><?= $item['text_contents'] ?></p>
                </div>
            </a>
        </div>
    <?php } ?>
</div>
</body>