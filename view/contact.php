<?php

// récupération du contenus à partir de la base de donnnée.
$page = affichePage('contact', $lang, $db);
$content = afficheContentTab('contact', $lang, $db);

// insertion du controller pour insertion de formulaire
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'controller' . DIRECTORY_SEPARATOR . 'verify_contact.php';

?>

<title><?= $page['title_pages'] ?></title>

<div class="page contact">
    <h1><?= $page['title_pages'] ?></h1>

    <?= (!empty($reception)) ? '<div class="valid-text">' . $reception . '</div>' : null; ?>

    <!--Formulaire de contact-->
    <form method="post" class="content contact">
        <input value="<?= (!empty($title)) ? $title : null; ?>" name="title_forms" type="text"
               placeholder="<?= $content[0] ?>" maxlength="30"
               pattern="[A-Za-z0-9]+$" required>

        <textarea name="text_forms" placeholder="<?= $content[1] ?>" cols="20" rows="5" maxlength="255"
                  required><?= (!empty($text)) ? $text : null; ?></textarea>

        <button name="forms" type="submit"><?= $content[2] ?></button>

    </form>
</div>