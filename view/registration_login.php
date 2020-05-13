<?php

// récupération du contenus à partir de la base de donnnée.
$page = affichePage('registration_login', $lang, $db);
$content = afficheContentTab('registration_login', $lang, $db);

// insertion du controller pour la vérification d'inscription, de connexion et validation d'inscription
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'controller' . DIRECTORY_SEPARATOR . 'verify_connect.php';
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'controller' . DIRECTORY_SEPARATOR . 'validation.php';

?>
<title><?= $page['title_pages'] ?></title>
<div>
    <h1><?= $page['title_pages'] ?></h1>

    <div>
        <?= (!empty($validation_key)) ? $validation_key : null; ?>
    </div>

    <div>
        <!--formulaire d'inscription-->
        <form action="" method="post">
            <input value="<?= (!empty($name_users)) ? $name_users : null; ?>" type="text" name="name_users"
                   placeholder="<?= $content[0] ?>" pattern="[A-Za-z '-]+$" maxlength="80" required>

            <input value="<?= (!empty($username_users)) ? $username_users : null; ?>" type="text" name="username_users"
                   placeholder="<?= $content[1] ?>" pattern="[A-Za-z '-]+$" maxlength="80" required>

            <input value="<?= (!empty($mail_users)) ? $mail_users : null; ?>" type="email" name="mail_users"
                   placeholder="<?= $content[2] ?>" pattern="[A-Za-z0-9]+@{1}[A-Za-z]+.{1}[A-Za-z]{2,}+$" maxlength="255" required>

            <div>
                <?= (!empty($error_mail)) ? $error_mail : null; ?>
            </div>

            <input value="<?= (!empty($pseudo_users)) ? $pseudo_users : null; ?>" type="text" name="pseudo_users"
                   placeholder="<?= $content[3] ?>" pattern="[A-Za-z0-9]+$" maxlength="60" required>

            <div>
                <?= (!empty($error_psd)) ? $error_psd : null; ?>
            </div>

            <input type="password" name="password_1" placeholder="<?= $content[4] ?>" maxlength="20" required>
            <input type="password" name="password_2" placeholder="<?= $content[5] ?>" maxlength="20" required>

            <div>
                <?= (!empty($error_mdp)) ? $error_mdp : null; ?>
            </div>

            <button type="submit" name="new"><?= $content[6] ?></button>

            <div>
                <?= (!empty($validation)) ? $validation : null; ?>
            </div>
        </form>
    </div>

    <div>
        <!--formulaire de connexion-->
        <form action="" method="post">
            <input value="<?= (!empty($pseudo_enter)) ? $pseudo_enter : null; ?>" type="text" name="pseudo"
                   placeholder="<?= $content[3] ?>" required>

            <input type="password" name="password" placeholder="<?= $content[4] ?>" required>

            <button type="submit" name="connect"><?= $content[7] ?></button>

            <div>
                <?= (!empty($error_connect)) ? $error_connect : null; ?>
            </div>
        </form>
    </div>
</div>


