<?php
$page = affichePage('admin_forms', $lang, $db);
$content = afficheContentTab('admin_forms', $lang, $db);
$content_mail = selectMail($db);

require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'controller' . DIRECTORY_SEPARATOR . 'CRUD_forms.php';

?>

<title><?= $page['title_pages'] ?></title>

<h1><?= $page['title_pages'] ?></h1>


<table>
    <thead>
    <tr>
        <th><?= $content[0] ?></th>
        <th><?= $content[1] ?></th>
        <th><?= $content[2] ?></th>
        <th><?= $content[3] ?></th>
        <th><?= $content[4] ?></th>
        <th><?= $content[5] ?></th>

    </tr>
    </thead>
    <tbody>
    <?php while ($item = mysqli_fetch_assoc($content_mail)) { ?>
        <tr>
            <td><?= $item['date_forms'] ?></td>
            <td><?= more($item['title_forms']) ?></td>
            <td><?= more($item['text_forms']) ?></td>
            <td><?= more($item['name_users']) ?></td>
            <td><?= more($item['username_users']) ?></td>
            <td><?= more($item['mail_users']) ?></td>
            <td>
                <a href="mailto :<?= $item['mail_users'] ?>subject=PORFOLIO%20WEB%202020" target="_blank">repondre</a>
            </td>
            <td>
                <form method="post">
                    <button type="submit" name="read" value="<?= $item['id_forms'] ?>">lire</button>
                    <button type="submit" name="send_me" value="<?= $item['id_forms'] ?>">Me l envoyer</button>
                    <button type="submit" name="delete" value="<?= $item['id_forms'] ?>">Supprimer</button>
                </form>
            </td>
        </tr>
    <?php } ?>

    </tbody>
</table>

<?php if (isset($_POST['delete'])) { ?>
    <form method="post">
        <p>ATTENTION</p>
        <button type="submit" name="oui" value="<?= $_POST['delete'] ?>">oui</button>
        <button type="submit" name="non">non</button>
    </form>
<?php } ?>

<?php if (isset ($_POST['read'])) { ?>
    <h3> <?= $read['title_forms'] ?> </h3>
    <p> <?= $read['text_forms'] ?> </p>
    <a href="mailto :<?= $read['mail_users'] ?>subject=PORFOLIO%20WEB%202020" target="_blank">repondre</a>
    <form method="post">
        <button type="submit" name="send_me" value="<?= $read['id_forms'] ?>">Me l envoyer</button>
        <button type="submit" name="delete" value="<?= $read['id_forms'] ?>">Supprimer</button>
        <button type="submit" name="back">back</button>
    </form>
<?php } ?>
