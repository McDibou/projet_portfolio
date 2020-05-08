<?php

$page = affichePage('admin_gallery', $lang, $db);
$content = afficheContentTab('admin_gallery', $lang, $db);

$option = selectOption($lang, $db);
$img = selectImg($lang, $db);

require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'controller' . DIRECTORY_SEPARATOR . 'CRUD_gallery.php';

?>

    <title><?= $page['title_pages'] ?></title>

    <h1><?= $page['title_pages'] ?></h1>

    <form method="post" enctype="multipart/form-data">
        <label><?= $content[0] ?>
            <select name="gallery" required>
                <option>--<?= $content[1] ?>--</option>
                <?php while ($item = mysqli_fetch_assoc($option)) { ?>
                    <option value="<?= $item['link_contents'] ?>"><?= $item['title_contents'] ?></option>
                <?php } ?>
            </select>
        </label>
        <input name="name_pics" type="file" accept="image/*" required>
        <button name="import" type="submit"><?= $content[2] ?></button>
    </form>

    <div>
        <?php while ($item = mysqli_fetch_assoc($img)) { ?>
            <img style="max-width: 20%" src="view/img/<?= $item['name_pics'] ?>" alt="">
            <form method="post" enctype="multipart/form-data">
                <?php if ($item['active_pics'] === '1') { ?>
                    <button type="submit" name="visible" value="<?= $item['id_pics'] ?>">no</button>
                <?php } else { ?>
                    <button type="submit" name="invisible" value="<?= $item['id_pics'] ?>">yes</button>
                <?php } ?>
                <button type="submit" name="delete" value="<?= $item['id_pics'] ?>">delete</button>
            </form>
            <hr>
        <?php } ?>
    </div>

<?php if (isset($_POST['delete'])) { ?>
    <form method="post" enctype="multipart/form-data">
        <h3><?= $content[3] ?></h3>
        <p><?= $content[4] ?></p>
        <button type="submit" name="oui" value="<?= $_POST['delete'] ?>"><?= $content[5] ?></button>
        <button type="submit" name="non"><?= $content[6] ?></button>
    </form>
<?php } ?>