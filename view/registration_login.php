<?php

$page = affichePage('registration_login', $lang, $db);
$content = afficheContentTab('registration_login', $lang, $db);

require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'controller' . DIRECTORY_SEPARATOR . 'verify_connect.php';

?>

<title><?= $page['title_pages'] ?></title>
<h1><?= $page['title_pages'] ?></h1>

<form action="" method="post">
    <label for="name_users">
        <input value="<?= (!empty($name_users)) ? $name_users : null; ?>" type="text" name="name_users"
               placeholder="<?= $content[0] ?>" pattern="[A-Za-z '-]+$" maxlength="80" required>
    </label
    <label for="username_users">
        <input value="<?= (!empty($username_users)) ? $username_users : null; ?>" type="text" name="username_users"
               placeholder="<?= $content[1] ?>" pattern="[A-Za-z '-]+$" maxlength="80" required>
    </label>
    <label for="mail_users">
        <input value="<?= (!empty($mail_users)) ? $mail_users : null; ?>" type="email" name="mail_users"
               placeholder="<?= $content[2] ?>" pattern="[A-Za-z0-9]+@{1}[A-Za-z]+.{1}[A-Za-z]{2,}+$" maxlength="255"
               required>
        <?= (!empty($error_mail)) ? $error_mail : null; ?>
    </label>
    <label for="pseudo_users">
        <input value="<?= (!empty($pseudo_users)) ? $pseudo_users : null; ?>" type="text" name="pseudo_users"
               placeholder="<?= $content[3] ?>" pattern="[A-Za-z0-9]+$" maxlength="60" required>
        <?= (!empty($error_psd)) ? $error_psd : null; ?>
    </label>
    <label for="password">
        <input type="password" name="password_1" placeholder="<?= $content[4] ?>" maxlength="20" required>
        <input type="password" name="password_2" placeholder="<?= $content[5] ?>" maxlength="20" required>
        <?= (!empty($error_mdp)) ? $error_mdp : null; ?>
    </label>
    <input type="submit" name="new" value="<?= $content[6] ?>">
    <?= (!empty($validation)) ? $validation : null; ?>
</form>

<form action="" method="post">
    <label for="pseudo">
        <input value="<?= (!empty($pseudo_enter)) ? $pseudo_enter : null; ?>" type="text" name="pseudo"
               placeholder="<?= $content[3] ?>" required>
    </label>
    <label for="password">
        <input type="password" name="password" placeholder="<?= $content[4] ?>" required>
    </label>
    <input type="submit" name="connect" value="<?= $content[7] ?>">
    <?= (!empty($error_connect)) ? $error_connect : null; ?>
</form>



