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

<div>
    <h1><?= $page['title_pages'] ?></h1>

    <div>
        <!--option et insert img galerie-->
        <form method="post" enctype="multipart/form-data">

            <div>
                <?= $content[0] ?>

                <select name="gallery" required>
                    <option>--<?= $content[1] ?>--</option>
                    <?php while ($item = mysqli_fetch_assoc($option)) { ?>
                        <option value="<?= $item['title_contents'] ?>"><?= $item['title_contents'] ?></option>
                    <?php } ?>
                </select>
            </div>

            <div>
                <input name="name_pics" type="file" accept="image/*" required>

                <button name="import" type="submit"><?= $content[2] ?></button>
            </div>
        </form>
    </div>

    <div>
        <!--boucle affichage categorie-->
        <?php while ($item = mysqli_fetch_assoc($category)) { ?>
            <div>
                <h3><?= $item['title_contents'] ?></h3>

                <!--boucle affichage img galerie-->
                <?php $img = selectGallery($item['title_contents'], $lang, $db) ?>

                <?php while ($value = mysqli_fetch_assoc($img)) { ?>
                    <div>
                        <img style="max-width: 20%" src="view/img/<?= $value['name_pics'] ?>">
                        <div>
                            <form method="post" enctype="multipart/form-data">

                                <?php if ($value['active_pics'] === '1') { ?>
                                    <button type="submit" name="visible" value="<?= $value['id_pics'] ?>"><img style="width: 10%" src="view/img/validate.svg"></button>
                                <?php } else { ?>
                                    <button type="submit" name="invisible" value="<?= $value['id_pics'] ?>"><img style="width: 10%" src="view/img/invalidate.svg"></button>
                                <?php } ?>

                                <button type="submit" name="delete" value="<?= $value['id_pics'] ?>"><img style="width: 10%" src="view/img/delete.svg"></button>
                            </form>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</div>
<div>
    <!--affichage confirmation delete image-->
    <?php if (isset($_POST['delete'])) { ?>
        <form method="post" enctype="multipart/form-data">

            <?php $id = $_POST['delete'];
            $info = select('pics', 'id_pics', $id, $db) ?>

            <h3><?= $content[3] ?></h3>
            <p><?= $content[4] . ' ' . $info['name_pics'] ?></p>

            <div>
                <button type="submit" name="oui" value="<?= $_POST['delete'] ?>"><?= $content[5] ?></button>

                <button type="submit" name="non"><?= $content[6] ?></button>
            </div>
        </form>
    <?php } ?>
</div>