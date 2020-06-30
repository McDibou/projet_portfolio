<?php

// récupération du contenus à partir de la base de donnnée.
$page = affichePage('tutorial', $lang, $db);
$content = afficheContent('tutorial', $lang, $db);

?>
<style>
    body {
        background: linear-gradient(350deg, rgb(235, 160, 76) 10%, rgb(239, 233, 89) 80%);
    }
</style>
<title><?= $page['title_pages'] ?></title>

<body>
<div class="container text-center mt-5">
    <h1 class="display-4 my-3"><?= $page['title_pages'] ?></h1>

    <!--Boucle affichage tutoriel-->
    <?php while ($item = mysqli_fetch_assoc($content)) { ?>
        <div class="card mx-auto my-3 p-4 col-lg-8 col-12">
            <h3 class="my-4"><?= $item['title_contents'] ?></h3>
            <?php include("view/article/" . $item['text_contents']) ?>
        </div>

    <?php } ?>

</div>
</body>