<?php

$page = affichePage('admin_reference', $lang, $db);
$content = afficheContentTab('admin_reference', $lang, $db);
$content_rf = afficheContentRef($db);

require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'bin' . DIRECTORY_SEPARATOR . 'management' . DIRECTORY_SEPARATOR . 'CRUD_reference.php';

?>
<title><?= $page['title_pages'] ?></title>

<h1><?= $page['title_pages'] ?></h1>

<form action="" method="post" enctype="multipart/form-data">
    <label><?= $content[12] ?>
        <input name="title_contents_fr" type="text" pattern="[A-Za-z0-9 ]+$" maxlength="80" required>
    </label>
    <label><?= $content[13] ?>
        <textarea name="text_contents_fr" cols="20" rows="5" maxlength="200" required></textarea>
    </label>
    <label><?= $content[14] ?>
        <input name="title_contents_en" type="text" pattern="[A-Za-z0-9 ]+$" maxlength="80" required>
    </label>
    <label><?= $content[15] ?>
        <textarea name="text_contents_en" cols="20" rows="5" maxlength="200" required></textarea>
    </label>
    <label><?= $content[4] ?>
        <input name="link_contents" type="url" placeholder="https://example.com" required>
    </label>
    <label><?= $content[5] ?>
        <input name="name_pics" type="file" accept="image/*" required>
    </label>
    <input name="create" type="submit" value="<?= $content[16] ?>">
</form>

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
    <?php while ($item = mysqli_fetch_assoc($content_rf)) { ?>

        <tr>
            <td><?= $item['name_langages'] ?></td>
            <td><?= $item['date_contents'] ?></td>
            <td><?= $item['title_contents'] ?></td>
            <td><?= $item['text_contents'] ?></td>
            <td><a href="<?= $item['link_contents'] ?>" target="_blank"><?= $item['link_contents'] ?></a></td>
            <td><?= $item['name_pics'] ?>
                <form method="post">
                    <button type="submit" name="view_update_pics" value="<?= $item['id_pics'] ?>">*</button>
                </form>
            </td>
            <td></td>
            <td>
                <form method="post">
                    <button type="submit" name="read" value="<?= $item['id_contents'] ?>"><?= $content[6] ?></button>
                    <button type="submit" name="view_update"
                            value="<?= $item['id_contents'] ?>"><?= $content[7] ?></button>
                    <button type="submit" name="delete" value="<?= $item['id_contents'] ?>"><?= $content[8] ?></button>
                    <?php if ($item['active_contents'] === '1') { ?>
                        <button type="submit" name="visible"
                                value="<?= $item['id_contents'] ?>"><?= $content[9] ?></button>
                    <?php } else { ?>
                        <button type="submit" name="invisible" value="<?= $item['id_contents'] ?>">yes</button>
                    <?php } ?>
                </form>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>

<?php if (isset ($_POST['read'])) { ?>
    <h3> <?= $read['title_contents'] ?> </h3>
    <p> <?= $read['text_contents'] ?> </p>
    <a href="<?= $read['link_contents'] ?>" target="_blank"><?= $read['link_contents'] ?></a>
    <img src="bin/img/<?= $read['name_pics'] ?>" alt="">
    <form method="post">
        <button type="submit" name="view_update" value="<?= $read['id_contents'] ?>"><?= $content[7] ?></button>
        <button type="submit" name="delete" value="<?= $read['id_contents'] ?>"><?= $content[8] ?></button>
        <button type="submit" name="back"><?= $content[17] ?></button>
    </form>
<?php } ?>

<?php if (isset ($_POST['view_update'])) { ?>
    <form method="post">
        <label><?= $content[2] ?>
            <input name="title_contents" type="text" pattern="[A-Za-z0-9 ]+$" maxlength="80"
                   value="<?= $view_update['title_contents'] ?>">
        </label>
        <label><?= $content[3] ?>
            <textarea name="text_contents" cols="20" rows="5"
                      maxlength="200"><?= $view_update['text_contents'] ?></textarea>
        </label>
        <label><?= $content[4] ?>
            <input name="link_contents" type="url" value="<?= $view_update['link_contents']; ?>"
                   placeholder="https://example.com">
        </label>
        <button type="submit" name="update" value="<?= $view_update['id_contents']; ?>"><?= $content[7] ?></button>
        <button type="submit" name="back"><?= $content[17] ?></button>
    </form>
<?php } ?>

<?php if (isset ($_POST['view_update_pics'])) { ?>
    <form method="post" enctype="multipart/form-data">
        <img src="bin/img/<?= $view_update_pics['name_pics'] ?>" alt="">
        <?= $content[5] ?><input name="name_update_pics" type="file" accept="image/*">
        <button type="submit" name="update_pics" value="<?= $view_update_pics['id_pics'] ?>"><?= $content[7] ?></button>
        <button type="submit" name="back"><?= $content[17] ?></button>
    </form>
<?php } ?>

<?php if (isset($_POST['delete'])) { ?>
    <form method="post" enctype="multipart/form-data">
        <p>ATTENTION</p>
        <button type="submit" name="oui" value="<?= $_POST['delete'] ?>"><?= $content[10] ?></button>
        <button type="submit" name="non"><?= $content[11] ?></button>
    </form>
<?php } ?>


