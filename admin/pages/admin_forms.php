<?php
$page = affichePage('admin_forms', $lang, $db);
$content_mail = selectMail($db);

require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'bin' . DIRECTORY_SEPARATOR . 'management' . DIRECTORY_SEPARATOR . 'CRUD_forms.php';

?>

<title><?= $page['title_pages'] ?></title>

<h1><?= $page['title_pages'] ?></h1>


<table>
    <thead>
    <tr>
        <th>date</th>
        <th>title</th>
        <th>text</th>
        <th>name</th>
        <th>username</th>
        <th>mail</th>

    </tr>
    </thead>
    <tbody>
    <?php while ($item = mysqli_fetch_assoc($content_mail)) { ?>
        <tr>
            <td><?= $item['date_forms'] ?></td>
            <td><?= $item['title_forms'] ?></td>
            <td><?= $item['text_forms'] ?></td>
            <td><?= $item['name_users'] ?></td>
            <td><?= $item['username_users'] ?></td>
            <td><?= $item['mail_users'] ?></td>
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
