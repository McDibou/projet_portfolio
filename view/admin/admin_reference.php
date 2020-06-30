<?php

// récupération du contenus à partir de la base de donnnée.
$page = affichePage('admin_reference', $lang, $db);
$content = afficheContentTab('admin_reference', $lang, $db);
$content_rf = afficheContentRef($db);

// insertion du controller pour traitement CRUD reference
require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'controller' . DIRECTORY_SEPARATOR . 'CRUD_reference.php';

?>
<style>
    body {
        background: linear-gradient(45deg, rgba(45, 169, 202, 1) -15%, rgba(134, 211, 103, 1) 95%);
    }
</style>
<title><?= $page['title_pages'] ?></title>

<div class="container text-center my-5">
    <h1 class="display-4 my-3"><?= $page['title_pages'] ?></h1>
</div>

<div class="container card col-md-8 col-lg-6 p-5">
    <!--formulaire insertion reference-->
    <form method="post" enctype="multipart/form-data" class="content">
        <div class="form-group">

            <div class="form-group">
                <p><?= $content[0] ?> :</p>
                <input class="form-control" name="title_contents_fr" type="text" pattern="[A-Za-z0-9 ]+$" maxlength="80" required>
            </div>

            <div class="form-group">
                <p><?= $content[1] ?> :</p>
                <textarea class="form-control" name="text_contents_fr" cols="20" rows="5" maxlength="200" required></textarea>
            </div>

            <div class="form-group">
                <p><?= $content[2] ?> :</p>
                <input class="form-control" name="title_contents_en" type="text" pattern="[A-Za-z0-9 ]+$" maxlength="80" required>
            </div>

            <div class="form-group">
                <p><?= $content[3] ?> :</p>
                <textarea class="form-control" name="text_contents_en" cols="20" rows="5" maxlength="200" required></textarea>
            </div>

            <div class="form-group">
                <p><?= $content[4] ?> :</p>
                <input class="form-control" name="link_contents" type="url" placeholder="https://example.com" required>
            </div>

            <div class="form-group">
                <p><?= $content[5] ?> :</p>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="customFile" name="name_pics" accept="image/*" required>
                    <label class="custom-file-label" for="customFile">...</label>
                </div>
            </div>

            <div>
                <button class="btn btn-outline-info btn-lg btn-block my-5" type="submit" name="create"><?= $content[6] ?></button>
            </div>

        </div>
    </form>
</div>


<!--affichage reference-->
<?php if (isset ($_POST['read'])) { ?>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" class="popup">

                <img style="height: 200px" class="img-thumbnail m-3" src="view/img/<?= $read['name_pics'] ?>">

                <div class="modal-body">
                    <h1> <?= $read['title_contents'] ?> </h1>
                    <p> <?= $read['text_contents'] ?> </p>
                    <a href="<?= $read['link_contents'] ?>" target="_blank"><?= $read['link_contents'] ?></a>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-outline-info btn-lg" type="submit" name="view_update"
                            value="<?= $read['id_contents'] ?>"><?= $content[14] ?></button>
                    <button class="btn btn-outline-danger btn-lg" type="submit" name="delete"
                            value="<?= $read['id_contents'] ?>"><?= $content[15] ?></button>
                    <button class="btn btn-outline-light btn-lg" type="submit" name="back"><img style="width: 30px;"
                                                                                                src="view/img/back.png">
                    </button>
                </div>
            </form>
        </div>
    </div>
<?php } ?>

<!--affichage reference update-->
<?php if (isset ($_POST['view_update'])) { ?>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <form method="post">

                    <div class="form-group">
                        <h3><?= $content[9] ?></h3>
                        <input class="form-control" name="title_contents" type="text" pattern="[A-Za-z0-9 '.-]+$"
                               maxlength="80" value="<?= $view_update['title_contents'] ?>">
                    </div>

                    <div class="form-group">
                        <h3><?= $content[10] ?></h3>
                        <textarea class="form-control" name="text_contents" cols="20" rows="5"
                                  maxlength="200"><?= $view_update['text_contents'] ?></textarea>
                    </div>

                    <div class="form-group">
                        <h3><?= $content[11] ?></h3>
                        <input class="form-control" name="link_contents" type="url"
                               value="<?= $view_update['link_contents']; ?>" placeholder="https://example.com">
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-outline-info btn-lg" type="submit" name="update"
                                value="<?= $view_update['id_contents']; ?>"><?= $content[14] ?></button>
                        <button class="btn btn-outline-light btn-lg" type="submit" name="back"><img style="width: 30px;"
                                                                                                    src="view/img/back.png">
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>

<!--affichage image reference update-->
<?php if (isset ($_POST['view_update_pics'])) { ?>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data" class="popup">

                <img style="height: 200px" class="img-thumbnail m-3"
                     src="view/img/<?= $view_update_pics['name_pics'] ?>">

                <div class="modal-body m-5">
                    <input type="file" class="custom-file-input" id="customFile" name="name_update_pics"
                           accept="image/*" required>
                    <label class="custom-file-label" for="customFile">...</label>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-outline-info btn-lg" type="submit" name="update_pics"
                            value="<?= $view_update_pics['id_pics'] ?>"><?= $content[14] ?></button>
                    <button class="btn btn-outline-light btn-lg" type="submit" name="back"><img style="width: 30px;"
                                                                                                src="view/img/back.png">
                    </button>
                </div>
            </form>
        </div>
    </div>
<?php } ?>

<!--affichage confirmation delete reference-->
<?php if (isset($_POST['delete'])) { ?>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data" class="popup">
                <div class="modal-header">
                    <h3><?= $content[16] ?></h3>
                </div>
                <div class="modal-body">
                    <p><?= $content[17] ?></p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-lg btn-outline-danger font-weight-bold" type="submit" name="oui"
                            value="<?= $_POST['delete'] ?>"><?= $content[18] ?></button>
                    <button class="btn btn-lg btn-outline-info font-weight-bold" type="submit"
                            name="non"><?= $content[19] ?></button>
                </div>
            </form>
        </div>
    </div>
<?php } ?>

<div class="container text-center">
    <!--tableau CRUD reference-->
    <div class="table-responsive my-5">
        <table class="table">
            <thead class="thead bg-light">
            <tr>
                <th style="width: 10%"><?= $content[7] ?></th>
                <th style="width: 10%"><?= $content[8] ?></th>
                <th style="width: 15%"><?= $content[9] ?></th>
                <th style="width: 15%"><?= $content[10] ?></th>
                <th style="width: 10%"><?= $content[11] ?></th>
                <th style="width: 15%"><?= $content[12] ?></th>
                <th style="width: 25%"></th>
            </tr>
            </thead>

            <tbody>
            <!--boucle recuperation contenu reference-->
            <?php while ($item = mysqli_fetch_assoc($content_rf)) { ?>

                <tr>
                    <th class="align-middle"><?= $item['name_langages'] ?></th>
                    <td class="align-middle"><?= dateTime($item['date_contents']) ?></td>
                    <td class="align-middle"><?= more($item['title_contents']) ?></td>
                    <td class="align-middle"><?= more($item['text_contents']) ?></td>
                    <td class="align-middle"><a href="<?= $item['link_contents'] ?>"
                                                target="_blank"><?= more($item['link_contents']) ?></a>
                    </td>

                    <td class="align-middle">

                        <form method="post">
                            <?= more($item['name_pics']) ?>
                            <button class="btn bg-transparent" type="submit" name="view_update_pics"
                                    value="<?= $item['id_pics'] ?>"><img style="width: 30px;" src="view/img/reload.png">
                            </button>
                        </form>

                    </td>

                    <td class="align-middle">
                        <!--bontons CRUD reference-->
                        <div class="btn-group">
                            <form method="post" class="table-button">

                                <button class="btn bg-transparent" type="submit" name="read"
                                        value="<?= $item['id_contents'] ?>"><img style="width: 30px;"
                                                                                 src="view/img/readREF.png"></button>

                                <button class="btn bg-transparent" type="submit" name="view_update"
                                        value="<?= $item['id_contents'] ?>"><img style="width: 30px;"
                                                                                 src="view/img/reload.png"></button>

                                <button class="btn bg-transparent" type="submit" name="delete"
                                        value="<?= $item['id_contents'] ?>"><img style="width: 30px;"
                                                                                 src="view/img/delete.png"></button>

                                <?php if ($item['active_contents'] === '1') { ?>
                                    <button class="btn bg-transparent" type="submit" name="visible"
                                            value="<?= $item['id_contents'] ?>"><img style="width: 30px;"
                                                                                     src="view/img/validate.png">
                                    </button>
                                <?php } else { ?>
                                    <button class="btn bg-transparent" type="submit" name="invisible"
                                            value="<?= $item['id_contents'] ?>"><img style="width: 30px;"
                                                                                     src="view/img/invalidate.png">
                                    </button>
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

