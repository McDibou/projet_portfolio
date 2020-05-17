<?php

// récupération du contenus à partir de la base de donnnée.
$page = affichePage('registration_login', $lang, $db);
$content = afficheContentTab('registration_login', $lang, $db);

// insertion du controller pour la vérification d'inscription, de connexion et validation d'inscription
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'controller' . DIRECTORY_SEPARATOR . 'verify_connect.php';
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'controller' . DIRECTORY_SEPARATOR . 'validation.php';

?>
<title><?= $page['title_pages'] ?></title>

<?= (!empty($validation_key)) ? '<div class="valid-text">' . $validation_key . '</div>' : null; ?>
<?= (!empty($validation_error)) ? '<div class="invalid-text">' . $validation_error . '</div>' : null; ?>

<?= (!empty($validation)) ? '<div class="valid-text">' . $validation . '</div>' : null; ?>

<div class="page login">
    <h1><?= $page['title_pages'] ?></h1>

    <!--formulaire de connexion-->
    <form method="post" class="login-form">

        <input value="<?= (!empty($pseudo_enter)) ? $pseudo_enter : null; ?>" type="text" name="pseudo"
               placeholder="<?= $content[3] ?>" required>

        <input type="password" name="password" placeholder="<?= $content[4] ?>" required>

        <button type="submit" name="connect"><?= $content[7] ?></button>

        <?= (!empty($error_connect)) ? '<div class="invalid-text">' . $error_connect . '</div>' : null; ?>

    </form>

    <div class="forms-separate"></div>

    <!--formulaire d'inscription-->
    <form method="post" class="login-form">
        <input value="<?= (!empty($name_users)) ? $name_users : null; ?>" type="text" name="name_users"
               placeholder="<?= $content[0] ?>" pattern="[A-Za-z '-]+$" maxlength="80" required>

        <input value="<?= (!empty($username_users)) ? $username_users : null; ?>" type="text" name="username_users"
               placeholder="<?= $content[1] ?>" pattern="[A-Za-z '-]+$" maxlength="80" required>

        <input value="<?= (!empty($mail_users)) ? $mail_users : null; ?>" type="email" name="mail_users"
               placeholder="<?= $content[2] ?>" pattern="[A-Za-z0-9.-_]+@[A-za-z]+\.[a-z]{2,}" maxlength="255" required>

        <?= (!empty($error_mail)) ? '<div class="invalid-text">' . $error_mail . '</div>' : null; ?>

        <input value="<?= (!empty($pseudo_users)) ? $pseudo_users : null; ?>" type="text" name="pseudo_users"
               placeholder="<?= $content[3] ?>" pattern="[A-Za-z0-9]+$" maxlength="60" required>

        <?= (!empty($error_psd)) ? '<div class="invalid-text">' . $error_psd . ' </div>' : null; ?>

        <input type="password" name="password_1" placeholder="<?= $content[4] ?>" maxlength="20" required>
        <input type="password" name="password_2" placeholder="<?= $content[5] ?>" maxlength="20" required>

        <?= (!empty($error_mdp)) ? '<div class="invalid-text">' . $error_mdp . '</div>' : null; ?>

        <button type="submit" name="new"><?= $content[6] ?></button>

    </form>
</div>


