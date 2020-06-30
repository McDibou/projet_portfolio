<?php
// récupération du contenus à partir de la base de donnnée.
$page = affichePage('admin_forms', $lang, $db);
$content = afficheContentTab('admin_forms', $lang, $db);
$content_forms = selectForms($db);

// insertion du model pour traitement CRUD formulaires
require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'controller' . DIRECTORY_SEPARATOR . 'CRUD_forms.php';

?>
<style>
    body {
        background: linear-gradient(45deg, rgba(45, 169, 202, 1) -15%, rgba(134, 211, 103, 1) 95%);
        height: 95vh;
    }
</style>
<div class="container text-center mt-5">
    <h1 class="display-4 my-3"><?= $page['title_pages'] ?></h1>
</div>
<!--affichage read formulaires-->
<?php if (isset ($_POST['read'])) { ?>

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h3 class="modal-title"> <?= $read['title_forms'] ?> </h3>
                </div>
                <div class="modal-body">
                    <p> <?= $read['text_forms'] ?> </p>
                </div>
                <div class="modal-footer">
                    <div>
                        <a class="btn btn-outline-info btn-lg"
                           href="mailto :<?= $read['mail_users'] ?>subject=PORFOLIO%20WEB%202020"
                           target="_blank"><?= $content[6] ?></a>

                        <button class="btn btn-outline-danger btn-lg" type="submit" name="delete"
                                value="<?= $read['id_forms'] ?>"><?= $content[8] ?></button>
                        <button class="btn btn-outline-light btn-lg" type="submit" name="back"><img style="width: 30px;"
                                                                                                    src="view/img/back.png">
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>


<?php } ?>

<!--affichage confirmation delete formulaires-->
<?php if (isset($_POST['delete'])) { ?>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?php $user = afficheInfo($_POST['delete'], $db); ?>

            <form method="post">
                <div class="modal-header">
                    <h3><?= $content[9] ?></h3>
                </div>
                <div class="modal-body">
                    <p><?= $content[10] . ' : ' . $user['mail_users'] ?></p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-danger btn-lg" type="submit" name="oui"
                            value="<?= $_POST['delete'] ?>"><?= $content[11] ?></button>
                    <button class="btn btn-outline-info btn-lg" type="submit" name="non"><?= $content[12] ?></button>
                </div>
            </form>
        </div>
    </div>
<?php } ?>

<title><?= $page['title_pages'] ?></title>


<div class="container text-center mt-5">

    <div class="table-responsive my-5">
        <table class="table">
            <!--tableau qui regroupe tout les formulaires et le crud-->
            <thead class="thead bg-white">
            <tr>
                <th style="width: 10%"><?= $content[0] ?></th>
                <th style="width: 10%"><?= $content[1] ?></th>
                <th style="width: 15%"><?= $content[2] ?></th>
                <th style="width: 15%"><?= $content[3] ?></th>
                <th style="width: 20%"><?= $content[4] ?></th>
                <th style="width: 15%"><?= $content[5] ?></th>
                <th style="width: 15%"></th>
            </tr>
            </thead>
            <!--boucle données formulaire + CRUD-->
            <?php while ($item = mysqli_fetch_assoc($content_forms)) { ?>
                <tbody>
                <tr>
                    <th class="align-middle"><?= dateTime($item['date_forms']) ?></th>
                    <td class="align-middle"><?= more($item['title_forms']) ?></td>
                    <td class="align-middle"><?= more($item['text_forms']) ?></td>
                    <td class="align-middle"><?= $item['name_users'] ?></td>
                    <td class="align-middle"><?= $item['username_users'] ?></td>
                    <td class="align-middle"><?= $item['mail_users'] ?></td>

                    <!--boutons CRUD-->
                    <td class="align-middle">
                        <form method="post">
                            <div class="btn-group">
                                <!--Si admin n'a pas encore lu le formulaire-->
                                <?php if ($item['active_forms'] === '0') { ?>
                                    <button class="btn bg-transparent" type="submit" name="read"
                                            value="<?= $item['id_forms'] ?>"><img style="width: 30px;"
                                                                                  src="view/img/notread.png"></button>
                                <?php } else { ?>
                                    <button class="btn bg-transparent" type="submit" name="read"
                                            value="<?= $item['id_forms'] ?>"><img style="width: 30px;"
                                                                                  src="view/img/read.png"></button>
                                <?php } ?>
                                <button class="btn bg-transparent" type="submit" name="delete"
                                        value="<?= $item['id_forms'] ?>"><img style="width: 30px;"
                                                                              src="view/img/delete.png"></button>
                            </div>
                        </form>
                    </td>
                </tr>
                </tbody>
            <?php } ?>
        </table>
    </div>
</div>

