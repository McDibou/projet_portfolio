<?php

// récupération du contenus à partir de la base de donnnée.
$page = affichePage('home', $lang, $db);
$content = afficheContent('home', $lang, $db);

?>

<title><?= $page['title_pages'] ?></title>
<div class="page home-page">
    <img class="logo" src="view/img/logov1.png">

    <div class="home-block">
    <!--Boucle affichage menu home-->
    <?php while ($item = mysqli_fetch_assoc($content)) { ?>

        <div class="content home">
            <a href="?p=<?= $item['link_contents'] ?>">
                <div class="home-menu">
                    <div>
                        <img src="view/img/<?= $item['text_contents'] ?>">
                    </div>

                    <div>
                        <h2><?= $item['title_contents'] ?></h2>
                    </div>
                </div>
            </a>
        </div>
    <?php } ?>
</div>

</div>