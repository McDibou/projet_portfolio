<?php
// récupération du contenus à partir de la base de donnnée.
$page = affichePage('admin_gallery', $lang, $db);
$content = afficheContentTab('admin_gallery', $lang, $db);
$option = selectOption($lang, $db);
$category = selectOption($lang, $db);

// insertion du model pour traitement CRUD galerie
require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'controller' . DIRECTORY_SEPARATOR . 'CRUD_gallery.php';

?>

<title><?= $page['title_pages'] ?></title>

<div class="page admin-gallery">
    <h1><?= $page['title_pages'] ?></h1>

    <!--option et insert img galerie-->
    <form method="post" enctype="multipart/form-data" class="content gallery">

        <p><?= $content[0] ?></p>

        <select name="gallery" required>
            <option value="">--<?= $content[1] ?>--</option>
            <?php while ($item = mysqli_fetch_assoc($option)) { ?>
                <option value="<?= $item['link_contents'] ?>"><?= $item['title_contents'] ?></option>
            <?php } ?>
        </select>

        <input name="name_pics" type="file" accept="image/*" required>

        <button name="import" type="submit"><?= $content[2] ?></button>
    </form>

    <!--boucle affichage categorie-->
    <?php while ($item = mysqli_fetch_assoc($category)) { ?>
        <div class="content">
            <h2><?= $item['title_contents'] ?></h2>

            <!--boucle affichage categorie galerie-->
            <?php $img = selectGallery($item['title_contents'], $lang, $db) ?>
            <div class="gallery-cadre">
                <!--boucle affichage img galerie-->
                <?php while ($value = mysqli_fetch_assoc($img)) { ?>
                    <div class="gallery-crud">
                        <img src="view/img/<?= $value['name_pics'] ?>">

                        <form method="post" enctype="multipart/form-data" class="gallery-crud-button">

                            <?php if ($value['active_pics'] === '1') { ?>
                                <button type="submit" name="visible" value="<?= $value['id_pics'] ?>"><img
                                            src="view/img/validate.png"></button>
                            <?php } else { ?>
                                <button type="submit" name="invisible" value="<?= $value['id_pics'] ?>"><img
                                            src="view/img/invalidate.png"></button>
                            <?php } ?>

                            <button type="submit" name="delete" value="<?= $value['id_pics'] ?>"><img
                                        src="view/img/delete.png"></button>
                        </form>

                    </div>
                <?php } ?>
            </div>
        </div>
    <?php } ?>

</div>

<!--affichage confirmation delete image-->
<?php if (isset($_POST['delete'])) { ?>
    <div class="trame">
        <form method="post" enctype="multipart/form-data" class="popup">

            <?php $id = $_POST['delete'];
            $info = select('pics', 'id_pics', $id, $db) ?>

            <h3><?= $content[3] ?></h3>
            <p><?= $content[4] . ' ' . $info['name_pics'] ?></p>

            <div class="popup-button">
                <button class="invalid-text" type="submit" name="oui" value="<?= $_POST['delete'] ?>"><?= $content[5] ?></button>

                <button class="valid-text" type="submit" name="non"><?= $content[6] ?></button>
            </div>
        </form>
    </div>
<?php } ?>
