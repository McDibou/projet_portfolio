<?php

// récupération du contenus à partir de la base de donnnée.
$page = affichePage('tutorial', $lang, $db);
$content = afficheContent('tutorial', $lang, $db);

?>

<title><?= $page['title_pages'] ?></title>

<body class="fond-tutorial">
<div class="page">
    <h1><?= $page['title_pages'] ?></h1>

    <!--Boucle affichage tutoriel-->
    <?php while ($item = mysqli_fetch_assoc($content)) { ?>

        <div class="content tutorial">
            <h2><?= $item['title_contents'] ?></h2>
            <?php include("view/article/".$item['text_contents']) ?>
        </div>

    <?php } ?>
</div>
</body>