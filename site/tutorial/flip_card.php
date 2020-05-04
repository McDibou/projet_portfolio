<?php
$page = affichePage('tutorial_flip_card', $lang, $db);
$content = afficheContent('tutorial_flip_card', $lang, $db);
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $page['title_pages'] ?></title>
</head>
<body>
<h1><?= $page['title_pages'] ?></h1>

<p><?= $page['date_pages'] ?></p>
</body>
</html>