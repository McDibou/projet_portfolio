<?php

// récupération du contenus à partir de la base de donnnée.
$page = affichePage('admin_reference', $lang, $db);
$content = afficheContentTab('admin_reference', $lang, $db);
$content_rf = afficheContentRef($db);

// insertion du controller pour traitement CRUD reference
require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'controller' . DIRECTORY_SEPARATOR . 'CRUD_reference.php';

?>

<title><?= $page['title_pages'] ?></title>

<div class="page admin-reference">

    <h1><?= $page['title_pages'] ?></h1>

    <!--formulaire insertion reference-->
    <form method="post" enctype="multipart/form-data" class="content">

        <div class="reference-input">
            <div class="reference-input">
                <p><?= $content[0] ?> :</p>
                <input name="title_contents_fr" type="text" pattern="[A-Za-z0-9 ]+$" maxlength="80" required>
            </div>

            <div class="reference-input">
                <p><?= $content[1] ?> :</p>
                <textarea name="text_contents_fr" cols="20" rows="5" maxlength="200" required></textarea>
            </div>
        </div>

        <div>
            <div class="reference-input">
                <p><?= $content[2] ?> :</p>
                <input name="title_contents_en" type="text" pattern="[A-Za-z0-9 ]+$" maxlength="80" required>
            </div>

            <div class="reference-input">
                <p><?= $content[3] ?> :</p>
                <textarea name="text_contents_en" cols="20" rows="5" maxlength="200" required></textarea>
            </div>
        </div>

        <div>
            <div class="reference-input">
                <p><?= $content[4] ?> :</p>
                <input name="link_contents" type="url" placeholder="https://example.com" required>
            </div>

            <div class="reference-input">
                <p><?= $content[5] ?> :</p>
                <input name="name_pics" type="file" accept="image/*" required>
            </div>
            <div class="reference-input">
                <button type="submit" name="create"><?= $content[6] ?></button>
            </div>
        </div>
    </form>

    <div class="content table">
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

                <tr class="ligne">
                    <td><?= $item['name_langages'] ?></td>
                    <td><?= dateTime($item['date_contents']) ?></td>
                    <td><?= more($item['title_contents']) ?></td>
                    <td><?= more($item['text_contents']) ?></td>
                    <td><a href="<?= $item['link_contents'] ?>" target="_blank"><?= more($item['link_contents']) ?></a>
                    </td>

                    <td>
                        <div class="table-button">
                            <?= more($item['name_pics']) ?>
                            <form method="post">
                                <button class="read-pics" type="submit" name="view_update_pics"
                                        value="<?= $item['id_pics'] ?>"><img
                                            src="view/img/reload.png"></button>
                            </form>
                        </div>
                    </td>

                    <td>
                        <!--bontons CRUD reference-->
                        <form method="post" class="table-button">

                            <button type="submit" name="read" value="<?= $item['id_contents'] ?>"><img
                                        src="view/img/readREF.png"></button>

                            <button type="submit" name="view_update" value="<?= $item['id_contents'] ?>"><img
                                        src="view/img/reload.png"></button>

                            <button type="submit" name="delete" value="<?= $item['id_contents'] ?>"><img
                                        src="view/img/delete.png"></button>

                            <?php if ($item['active_contents'] === '1') { ?>
                                <button type="submit" name="visible" value="<?= $item['id_contents'] ?>"><img
                                            src="view/img/validate.png"></button>
                            <?php } else { ?>
                                <button type="submit" name="invisible" value="<?= $item['id_contents'] ?>"><img
                                            src="view/img/invalidate.png"></button>
                            <?php } ?>
                        </form>

                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>


<!--affichage reference-->
<?php if (isset ($_POST['read'])) { ?>
    <div class="trame">
        <form method="post" class="popup">

            <img src="view/img/<?= $read['name_pics'] ?>">

            <div>
                <h1> <?= $read['title_contents'] ?> </h1>
                <p> <?= $read['text_contents'] ?> </p>
                <a href="<?= $read['link_contents'] ?>" target="_blank"><?= $read['link_contents'] ?></a>
            </div>

            <div class="popup-button">
                <button class="valid-text" type="submit" name="view_update"
                        value="<?= $read['id_contents'] ?>"><?= $content[14] ?></button>
                <div class="reference-button">
                    <button class="invalid-text  read" type="submit" name="delete"
                            value="<?= $read['id_contents'] ?>"><?= $content[15] ?></button>

                    <button class="back back-reference" type="submit" name="back"><img src="view/img/back.png"></button>
                </div>
            </div>
        </form>
    </div>
<?php } ?>

<!--affichage reference update-->
<?php if (isset ($_POST['view_update'])) { ?>
    <div class="trame">
        <form method="post" class="popup">

            <div class="reference-input">
                <p><?= $content[9] ?></p>
                <input name="title_contents" type="text" pattern="[A-Za-z0-9 '.-]+$" maxlength="80"
                       value="<?= $view_update['title_contents'] ?>">
            </div>

            <div class="reference-input">
                <p><?= $content[10] ?></p>
                <textarea name="text_contents" cols="20" rows="5"
                          maxlength="200"><?= $view_update['text_contents'] ?></textarea>
            </div>

            <div class="reference-input">
                <p><?= $content[11] ?></p>
                <input name="link_contents" type="url" value="<?= $view_update['link_contents']; ?>"
                       placeholder="https://example.com">
            </div>

            <div class="popup-button reference-button">
                <button class="valid-text" type="submit" name="update"
                        value="<?= $view_update['id_contents']; ?>"><?= $content[14] ?></button>

                <button class="back" type="submit" name="back"><img src="view/img/back.png"></button>
            </div>
        </form>
    </div>
<?php } ?>

<!--affichage image reference update-->
<?php if (isset ($_POST['view_update_pics'])) { ?>
    <div class="trame">
        <form method="post" enctype="multipart/form-data" class="popup">

            <img src="view/img/<?= $view_update_pics['name_pics'] ?>">

            <div class="reference-input">
                <input name="name_update_pics" type="file" accept="image/*">
            </div>
            <div class="popup-button reference-button">
                <button class="valid-text" type="submit" name="update_pics"
                        value="<?= $view_update_pics['id_pics'] ?>"><?= $content[14] ?></button>

                <button class="back" type="submit" name="back"><img src="view/img/back.png"></button>
            </div>
        </form>
    </div>
<?php } ?>

<!--affichage confirmation delete reference-->
<?php if (isset($_POST['delete'])) { ?>
    <div class="trame">
        <form method="post" enctype="multipart/form-data" class="popup">

            <h3><?= $content[16] ?></h3>
            <p><?= $content[17] ?></p>
            <div class="popup-button">
                <button class="invalid-text" type="submit" name="oui"
                        value="<?= $_POST['delete'] ?>"><?= $content[18] ?></button>

                <button class="valid-text" type="submit" name="non"><?= $content[19] ?></button>
            </div>
        </form>
    </div>
<?php } ?>


