<?php

$page = affichePage('contact', $lang, $db);
$content = afficheContentTab('contact', $lang, $db);

require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'controller' . DIRECTORY_SEPARATOR . 'verify_contact.php';
?>

<title><?= $page['title_pages'] ?></title>

<h1><?= $page['title_pages'] ?></h1>

<form action="" method="post">
    <input name="title_forms" type="text" placeholder="<?= $content[0]?>" maxlength="30" pattern="[A-Za-z0-9]+$" required>
    <textarea name="text_forms" placeholder="<?= $content[1]?>" cols="20" rows="5" maxlength="200" required></textarea>
    <input name="forms" type="submit" value="<?= $content[2]?>">
</form>

