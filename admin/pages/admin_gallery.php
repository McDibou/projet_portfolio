<?php

$page = affichePage('admin_gallery', $lang, $db);

$option = selectOption($lang, $db);

$img_ink = selectImg('gallery_inktober', $lang, $db);
$img_post = selectImg('gallery_poster', $lang, $db);
$img_web = selectImg('gallery_web_site', $lang, $db);

require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'bin' . DIRECTORY_SEPARATOR . 'management' . DIRECTORY_SEPARATOR . 'CRUD_gallery.php';

?>

<title><?= $page['title_pages'] ?></title>

<h1><?= $page['title_pages'] ?></h1>

<form method="post" enctype="multipart/form-data">
    <label>rajouter image
        <select name="gallery" required>
            <option>--choose an option--</option>
            <?php while ($item = mysqli_fetch_assoc($option)) { ?>
                <option value="<?= $item['link_contents'] ?>"><?= $item['title_contents'] ?></option>
            <?php } ?>
        </select>
    </label>
    <input name="name_pics" type="file" accept="image/*" required>
    <button name="import" type="submit">Import</button>
</form>

<hr>
    gallery_inktober
<div>
    <?php while ($item = mysqli_fetch_assoc($img_ink)) { ?>
        <img style="max-width: 20%" src="bin/img/gallery_inktober/<?= $item['name_pics'] ?>" alt="">
        <form method="post" enctype="multipart/form-data">
            <?php if ($item['active_pics'] === '1') { ?>
                <button type="submit" name="visible" value="<?= $item['id_pics'] ?>">no</button>
            <?php } else { ?>
                <button type="submit" name="invisible" value="<?= $item['id_pics'] ?>">yes</button>
            <?php } ?>
            <button type="submit" name="delete" value="<?= $item['id_pics'] ?>">delete</button>
        </form>
    <?php } ?>
</div>
<hr>
    gallery_poster
<div>
    <?php while ($item = mysqli_fetch_assoc($img_post)) { ?>
        <img style="max-width: 20%" src="bin/img/gallery_poster/<?= $item['name_pics'] ?>" alt="">
        <form method="post" enctype="multipart/form-data">
            <?php if ($item['active_pics'] === '1') { ?>
                <button type="submit" name="visible" value="<?= $item['id_pics'] ?>">no</button>
            <?php } else { ?>
                <button type="submit" name="invisible" value="<?= $item['id_pics'] ?>">yes</button>
            <?php } ?>
            <button type="submit" name="delete" value="<?= $item['id_pics'] ?>">delete</button>
        </form>
    <?php } ?>
</div>
<hr>
    gallery_web_site
<div>
    <?php while ($item = mysqli_fetch_assoc($img_web)) { ?>
        <img style="max-width: 20%" src="bin/img/gallery_web_site/<?= $item['name_pics'] ?>" alt="">
        <form method="post" enctype="multipart/form-data">
            <?php if ($item['active_pics'] === '1') { ?>
                <button type="submit" name="visible" value="<?= $item['id_pics'] ?>">no</button>
            <?php } else { ?>
                <button type="submit" name="invisible" value="<?= $item['id_pics'] ?>">yes</button>
            <?php } ?>
            <button type="submit" name="delete" value="<?= $item['id_pics'] ?>">delete</button>
        </form>
    <?php } ?>
</div>

<?php if (isset($_POST['delete'])) { ?>
    <form method="post" enctype="multipart/form-data">
        <p>ATTENTION</p>
        <button type="submit" name="oui" value="<?= $_POST['delete'] ?>">oui</button>
        <button type="submit" name="non">non</button>
    </form>
<?php } ?>