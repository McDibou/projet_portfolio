<?php

// récupération du contenus à partir de la base de donnnée.
$page = affichePage('home', $lang, $db);
$content = afficheContent('home', $lang, $db);

?>

<title><?= $page['title_pages'] ?></title>
<div>
    <img style="width: 30%" src="../view/img/logov1.png">

    <div>
        <!--Boucle affichage menu home-->
        <?php while ($item = mysqli_fetch_assoc($content)) { ?>

            <div>
                <img style="width: 10%" src="view/img/<?= $item['text_contents'] ?>">

                <div>
                    <h1><?= $item['title_contents'] ?></h1>

                    <a href="?p=<?= $item['link_contents'] ?>">

                        <button>
                            GO
                        </button>
                    </a>
                </div>
            </div>
        <?php } ?>
    </div>
</div>