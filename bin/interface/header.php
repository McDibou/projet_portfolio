<?php

require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'management' . DIRECTORY_SEPARATOR . 'verify_header.php';

$menu = afficheMenu($lang, $db);
//var_dump($menu);
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
        <button type="submit" name="lang" value="1">fr</button>
        <button type="submit" name="lang" value="2">en</button>
    </form>

    <p><?= (!empty($_SESSION['pseudo'])) ? $_SESSION['pseudo'] : null; ?></p>
    <?php if (!empty($_SESSION['pseudo']) && !empty($_SESSION['role'])) { ?>
        <form method="post"><input type="submit" name="admin" value="admin"></form>
        <form method="post"><input type="submit" name="disconnect" value="deconnecter"></form>
    <?php }
    if (!empty($_SESSION['pseudo']) && empty($_SESSION['role'])) { ?>
        <form method="post"><input type="submit" name="disconnect" value="deconnecter"></form>
    <?php } ?>

    <?php if (!empty($_SESSION['pseudo'])) { ?>
        <div>
            <a href="./"><?= $menu[0][2] ?></a>
            <a href="?p=<?= $menu[1][1] ?>"><?= $menu[1][2] ?></a>
            <a href="?p=<?= $menu[5][1] ?>"><?= $menu[5][2] ?></a>
            <a href="?p=<?= $menu[6][1] ?>"><?= $menu[6][2] ?></a>
            <a href="?p=<?= $menu[9][1] ?>"><?= $menu[9][2] ?></a>
            <a href="?p=<?= $menu[10][1] ?>"><?= $menu[10][2] ?></a>
        </div>
    <?php } ?>
</header>