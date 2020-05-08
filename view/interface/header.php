<?php

require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR .'controller'. DIRECTORY_SEPARATOR . 'verify_header.php';

$menu = afficheMenu($lang, $db);
$content = afficheContentTab('menu',$lang,$db);

?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="bin/css/style.css">
</head>
<body>
<header>

    <form method="post">
        <button type="submit" name="lang" value="1"><?= $content[8] ?></button>
        <button type="submit" name="lang" value="2"><?= $content[9] ?></button>
    </form>

    <p><?= (!empty($_SESSION['pseudo'])) ? $_SESSION['pseudo'] : null; ?></p>

    <?php if (!empty($_SESSION['pseudo'])) { ?>
        <form method="post"><input type="submit" name="disconnect" value="<?= $content[7] ?>"></form>
    <?php } ?>

    <?php if (!empty($_SESSION['pseudo'])) { ?>
        <div>
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
</header>