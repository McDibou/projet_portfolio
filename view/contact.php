<?php

// récupération du contenus à partir de la base de donnnée.
$page = affichePage('contact', $lang, $db);
$content = afficheContentTab('contact', $lang, $db);

// insertion du controller pour insertion de formulaire
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'controller' . DIRECTORY_SEPARATOR . 'verify_contact.php';

?>

<title><?= $page['title_pages'] ?></title>

<div>
    <h1><?= $page['title_pages'] ?></h1>

    <div>
        <!--Formulaire de contact-->
        <form action="" method="post">
            <input value="<?= (!empty($title)) ? $title : null; ?>" name="title_forms" type="text" placeholder="<?= $content[0] ?>" maxlength="30"
                   pattern="[A-Za-z0-9]+$" required>

            <textarea name="text_forms" placeholder="<?= $content[1] ?>" cols="20" rows="5" maxlength="200"
                      required><?= (!empty($text)) ? $text : null; ?></textarea>

            <input name="forms" type="submit" value="<?= $content[2] ?>">

            <div>
                <?= (!empty($reception)) ? $reception : null; ?>
            </div>
        </form>
    </div>
</div>