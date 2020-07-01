<?php

// récupération du contenus à partir de la base de donnnée.
$page = affichePage('contact', $lang, $db);
$content = afficheContentTab('contact', $lang, $db);

// insertion du controller pour insertion de formulaire
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'controller' . DIRECTORY_SEPARATOR . 'verify_contact.php';

?>
<style>
    body {
        background: linear-gradient(45deg, rgba(45, 169, 202, 1) -15%, rgba(134, 211, 103, 1) 95%);
        height: 95vh;
    }
</style>
<title><?= $page['title_pages'] ?></title>


<div class="card container-sm col-lg-8 col-xl-6 mt-5 mb-5 p-5 text-center">
    <h1 class="display-4 my-3"><?= $page['title_pages'] ?></h1>

    <?= (!empty($reception)) ? '<div class="container alert alert-success text-center col-6">' . $reception . '</div>' : null; ?>

    <!--Formulaire de contact-->
    <div class="container mt-5 col-lg-10 col-xl-9">
        <form method="post">
            <div class="form-group input-group-lg">
                <input class="form-control" value="<?= (!empty($title)) ? $title : null; ?>" name="title_forms" type="text" placeholder="<?= $content[0] ?>" maxlength="30" pattern="[A-Za-z0-9 '-]+$" required>
            </div>
            <?php if (empty($_SESSION['pseudo'])) { ?>
                <div class="form-group input-group-lg">
                    <input class="form-control" value="<?= (!empty($mail)) ? $mail : null; ?>" name="mail_users" type="email" placeholder="E-mail" maxlength="30" pattern="[A-Za-z0-9.-_]+@[A-za-z0-9]+\.[a-z0-9]{2,}" required>
                </div>
            <?php } ?>
            <div class="form-group input-group-lg">
                <textarea class="form-control" name="text_forms" placeholder="<?= $content[1] ?>" cols="20" rows="5" maxlength="255" required><?= (!empty($text)) ? $text : null; ?></textarea>
            </div>
            <div class="form-group text-center">
                <button class="btn btn-lg btn-outline-info col-md-6" name="forms" type="submit"><?= $content[2] ?></button>
            </div>
        </form>
    </div>
</div>
