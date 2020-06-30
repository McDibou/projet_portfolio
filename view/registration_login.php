<?php

// récupération du contenus à partir de la base de donnnée.
$page = affichePage('registration_login', $lang, $db);
$content = afficheContentTab('registration_login', $lang, $db);

// insertion du controller pour la vérification d'inscription, de connexion et validation d'inscription
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'controller' . DIRECTORY_SEPARATOR . 'verify_connect.php';
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'controller' . DIRECTORY_SEPARATOR . 'validation.php';

?>
<style>
    body {
        background: linear-gradient(45deg, rgba(45, 169, 202, 1) -15%, rgba(134, 211, 103, 1) 95%);
        height: 95vh;
    }
</style>
<title><?= $page['title_pages'] ?></title>

<div class="card container-sm col-lg-8 col-xl-6 mt-5 mb-5 p-5">

    <?= (!empty($validation_key)) ? '<div class="alert alert-success text-center">' . $validation_key . '</div>' : null; ?>
    <?= (!empty($validation_error)) ? '<div class="alert alert-danger text-center">' . $validation_error . '</div>' : null; ?>

    <?= (!empty($validation)) ? '<div class="alert alert-success text-center">' . $validation . '</div>' : null; ?>

    <h1 class="text-center mt-5"><?= $page['title_pages'] ?></h1>

    <!--formulaire d'inscription-->
    <div class="container mt-5 col-lg-10 col-xl-9">
        <form method="post">
            <div class="form-group input-group-lg">
                <input class="form-control" value="<?= (!empty($name_users)) ? $name_users : null; ?>" type="text"
                       name="name_users"
                       placeholder="<?= $content[0] ?>" pattern="^[A-Za-zàáâæçèéêëìíîïñòóôœùúûüýÿ '-]+$" maxlength="80"
                       required>
            </div>
            <div class="form-group input-group-lg">
                <input class="form-control" value="<?= (!empty($username_users)) ? $username_users : null; ?>"
                       type="text"
                       name="username_users"
                       placeholder="<?= $content[1] ?>" pattern="^[A-Za-zàáâæçèéêëìíîïñòóôœùúûüýÿ '-]+$" maxlength="80"
                       required>
            </div>
            <div class="form-group input-group-lg">
                <input class="form-control" value="<?= (!empty($mail_users)) ? $mail_users : null; ?>" type="email"
                       name="mail_users"
                       placeholder="<?= $content[2] ?>" pattern="[A-Za-z0-9.-_]+@[A-za-z0-9]+\.[a-z0-9]{2,}"
                       maxlength="255"
                       required>
            </div>

            <?= (!empty($error_mail)) ? '<div class="alert alert-danger text-center">' . $error_mail . '</div>' : null; ?>

            <div class="form-group input-group-lg">
                <input class="form-control" value="<?= (!empty($pseudo_users)) ? $pseudo_users : null; ?>" type="text"
                       name="pseudo_users"
                       placeholder="<?= $content[3] ?>" pattern="[A-Za-z0-9]+$" maxlength="60" required>
            </div>
            <?= (!empty($error_psd)) ? '<div class="alert alert-danger text-center">' . $error_psd . ' </div>' : null; ?>

            <div class="form-group input-group-lg">
                <input class="form-control" type="password" name="password_1" placeholder="<?= $content[4] ?>"
                       maxlength="20" required>
            </div>
            <div class="form-group input-group-lg">
                <input class="form-control" type="password" name="password_2" placeholder="<?= $content[5] ?>"
                       maxlength="20" required>
            </div>
            <?= (!empty($error_mdp)) ? '<div class="alert alert-danger text-center">' . $error_mdp . '</div>' : null; ?>

            <div class="form-group text-center">
                <button type="submit" name="new" class="btn btn-lg btn-outline-info col-md-6"><?= $content[6] ?></button>
            </div>
        </form>
    </div>

    <!--formulaire de connexion-->
    <div class="container mt-5 col-lg-10 col-xl-9">
        <form method="post">
            <div class="form-group input-group-lg">
                <input class="form-control" value="<?= (!empty($pseudo_enter)) ? $pseudo_enter : null; ?>" type="text"
                       name="pseudo"
                       placeholder="<?= $content[3] ?>" required>
            </div>
            <div class="form-group input-group-lg">
                <input class="form-control" type="password" name="password" placeholder="<?= $content[4] ?>" required>
            </div>
            <div class="form-group text-center">
                <button type="submit" name="connect"
                        class="btn btn-lg btn-outline-info col-md-6"><?= $content[7] ?></button>
            </div>
            <?= (!empty($error_connect)) ? '<div class="alert alert-danger text-center">' . $error_connect . '</div>' : null; ?>

        </form>
    </div>

</div>


