<?php

// récupération du contenus à partir de la base de donnnée.
$page = affichePage('admin_reference', $lang, $db);
$content = afficheContentTab('admin_reference', $lang, $db);
$content_rf = afficheContentRef($db);

// insertion du controller pour traitement CRUD reference
require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'controller' . DIRECTORY_SEPARATOR . 'CRUD_reference.php';

?>

<title><?= $page['title_pages'] ?></title>

<div>

    <h1><?= $page['title_pages'] ?></h1>

    <div>
        <!--formulaire insertion reference-->
        <form action="" method="post" enctype="multipart/form-data">

            <div>
                <div>
                    <?= $content[0] ?>
                    <input name="title_contents_fr" type="text" pattern="[A-Za-z0-9 ]+$" maxlength="80" required>
                </div>

                <div>
                    <?= $content[1] ?>
                    <textarea name="text_contents_fr" cols="20" rows="5" maxlength="200" required></textarea>
                </div>
            </div>

            <div>
                <div>
                    <?= $content[2] ?>
                    <input name="title_contents_en" type="text" pattern="[A-Za-z0-9 ]+$" maxlength="80" required>
                </div>

                <div>
                    <?= $content[3] ?>
                    <textarea name="text_contents_en" cols="20" rows="5" maxlength="200" required></textarea>
                </div>
            </div>

            <div>
                <div>
                    <?= $content[4] ?>
                    <input name="link_contents" type="url" placeholder="https://example.com" required>
                </div>

                <div>
                    <?= $content[5] ?>
                    <input name="name_pics" type="file" accept="image/*" required>
                </div>
                <button type="submit" name="create"><?= $content[6] ?></button>
            </div>
        </form>
    </div>
    <div>
        <!--tableau CRUD reference-->
        <table>
            <thead>

            <tr>
                <th><?= $content[7] ?></th>
                <th><?= $content[8] ?></th>
                <th><?= $content[9] ?></th>
                <th><?= $content[10] ?></th>
                <th><?= $content[11] ?></th>
                <th><?= $content[12] ?></th>
            </tr>

            </thead>
            <tbody>
            <!--boucle recuperation contenu reference-->
            <?php while ($item = mysqli_fetch_assoc($content_rf)) { ?>

                <tr>
                    <td><?= $item['name_langages'] ?></td>
                    <td><?= dateTime($item['date_contents']) ?></td>
                    <td><?= more($item['title_contents']) ?></td>
                    <td><?= more($item['text_contents']) ?></td>
                    <td><a href="<?= $item['link_contents'] ?>" target="_blank"><?= more($item['link_contents']) ?></a></td>

                    <td>
                        <div>
                            <?= more($item['name_pics']) ?>
                            <form method="post">
                                <button type="submit" name="view_update_pics" value="<?= $item['id_pics'] ?>"><img
                                            style="width: 10%" src="view/img/reload.svg"></button>
                            </form>
                        </div>
                    </td>

                    <td>
                        <div>
                            <!--bontons CRUD reference-->
                            <form method="post">
                                <button type="submit" name="read" value="<?= $item['id_contents'] ?>"><img
                                            style="width: 10%"
                                            src="view/img/readREF.svg">
                                </button>

                                <button type="submit" name="view_update"
                                        value="<?= $item['id_contents'] ?>"><img style="width: 10%"
                                                                                 src="view/img/reload.svg">
                                </button>

                                <button type="submit" name="delete" value="<?= $item['id_contents'] ?>"><img
                                            style="width: 10%"
                                            src="view/img/delete.svg">
                                </button>

                                <?php if ($item['active_contents'] === '1') { ?>
                                    <button type="submit" name="visible"
                                            value="<?= $item['id_contents'] ?>"><img style="width: 10%"
                                                                                     src="view/img/validate.svg">
                                    </button>

                                <?php } else { ?>

                                    <button type="submit" name="invisible" value="<?= $item['id_contents'] ?>"><img
                                                style="width: 10%" src="view/img/invalidate.svg"></button>

                                <?php } ?>
                            </form>
                        </div>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<div>
    <!--affichage reference-->
    <?php if (isset ($_POST['read'])) { ?>
        <form method="post">

            <img style="width: 10%" src="view/img/<?= $read['name_pics'] ?>">

            <div>
                <h3> <?= $read['title_contents'] ?> </h3>
                <p> <?= $read['text_contents'] ?> </p>
                <a href="<?= $read['link_contents'] ?>" target="_blank"><?= $read['link_contents'] ?></a>
            </div>

            <div>
                <button type="submit" name="view_update"
                        value="<?= $read['id_contents'] ?>"><?= $content[14] ?></button>

                <button type="submit" name="delete" value="<?= $read['id_contents'] ?>"><?= $content[15] ?></button>

                <button type="submit" name="back"><img style="width: 10%" src="view/img/back.svg"></button>
            </div>
        </form>
    <?php } ?>
</div>
<div>
    <!--affichage reference update-->
    <?php if (isset ($_POST['view_update'])) { ?>
        <form method="post">

            <div>
                <?= $content[9] ?>
                <input name="title_contents" type="text" pattern="[A-Za-z0-9 ]+$" maxlength="80"
                       value="<?= $view_update['title_contents'] ?>">
            </div>

            <div>
                <?= $content[10] ?>
                <textarea name="text_contents" cols="20" rows="5"
                          maxlength="200"><?= $view_update['text_contents'] ?></textarea>
            </div>

            <div>
                <?= $content[11] ?>
                <input name="link_contents" type="url" value="<?= $view_update['link_contents']; ?>"
                       placeholder="https://example.com">
            </div>

            <div>
                <button type="submit" name="update"
                        value="<?= $view_update['id_contents']; ?>"><?= $content[14] ?></button>

                <button type="submit" name="back"><img style="width: 10%" src="view/img/back.svg"></button>
            </div>
        </form>
    <?php } ?>
</div>
<div>
    <!--affichage image reference update-->
    <?php if (isset ($_POST['view_update_pics'])) { ?>
        <form method="post" enctype="multipart/form-data">

            <img style="width: 10%" src="view/img/<?= $view_update_pics['name_pics'] ?>">
            <div>
                <?= $content[5] ?>
                <input name="name_update_pics" type="file" accept="image/*">
            </div>

            <div>
                <button type="submit" name="update_pics"
                        value="<?= $view_update_pics['id_pics'] ?>"><?= $content[14] ?></button>

                <button type="submit" name="back"><img style="width: 10%" src="view/img/back.svg"></button>
            </div>
        </form>
    <?php } ?>
</div>
<div>
    <!--affichage confirmation delete reference-->
    <?php if (isset($_POST['delete'])) { ?>
        <form method="post" enctype="multipart/form-data">

            <h3><?= $content[16] ?></h3>
            <p><?= $content[17] ?></p>
            <div>
                <button type="submit" name="oui" value="<?= $_POST['delete'] ?>"><?= $content[18] ?></button>

                <button type="submit" name="non"><?= $content[19] ?></button>
            </div>
        </form>
    <?php } ?>
</div>

