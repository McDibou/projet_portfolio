<?php
// insertion du ocntroller pour le switch langage, déconnexion session & menu
require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'controller' . DIRECTORY_SEPARATOR . 'verify_header.php';

// récupération du contenus à partir de la base de donnnée.
$menu = afficheMenu($lang, $db);
$content = afficheContentTab('menu', $lang, $db);

?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/product.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<header>
    <div class="header">
        <div class="menu">
            <!--Switch langages-->
            <div class="menu-burger">
                <?php if (!empty($_SESSION['pseudo'])) { ?>
                    <img src="view/img/burger.png" alt="">

                    <div class="menu-hidden">
                        <a href="./"><?= $content[0] ?></a>
                        <a href="?p=<?= $menu[1][0] ?>"><?= $content[1] ?></a>
                        <a href="?p=<?= $menu[2][0] ?>"><?= $content[2] ?></a>
                        <a href="?p=<?= $menu[3][0] ?>"><?= $content[3] ?></a>
                        <a href="?p=<?= $menu[4][0] ?>"><?= $content[4] ?></a>
                        <a href="?p=<?= $menu[5][0] ?>"><?= $content[5] ?></a>
                        <?php if (!empty($_SESSION['role'])) { ?>
                            <a href="?p=<?= $menu[6][0] ?>"><?= $content[6] ?></a>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>

            <!--Switch langages-->
            <form method="post">
                <?php if ($lang == 1) { ?>
                    <button type="submit" name="lang" value="2"><p><?= $content[7] ?></p></button>
                <?php } else { ?>
                    <button type="submit" name="lang" value="1"><p><?= $content[8] ?></p></button>
                <?php } ?>
            </form>
        </div>

        <div class="menu menu-right">
            <!--affichage Pseudo-->
            <p><?= (!empty($_SESSION['pseudo'])) ? $_SESSION['pseudo'] : null; ?></p>

            <!--button déconnexion-->
            <?php if (!empty($_SESSION['pseudo'])) { ?>
                <form method="post">
                    <button type="submit" name="logout"><img src="view/img/disconnect.png" alt=""></button>
                </form>
            <?php } ?>
        </div>
    </div>

</header>
<div>
    <!--affiche confirmation déconnexion-->
    <?php if (isset($_POST['logout'])) { ?>
        <form method="post">
            <p><?= $content[9] ?></p>

            <div>
                <button type="submit" name="disconnect"><?= $content[10] ?></button>
                <button type="submit" name="non"><?= $content[11] ?></button>
            </div>
        </form>
    <?php } ?>
</div>
