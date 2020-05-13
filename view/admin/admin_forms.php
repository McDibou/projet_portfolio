<?php
// récupération du contenus à partir de la base de donnnée.
$page = affichePage('admin_forms', $lang, $db);
$content = afficheContentTab('admin_forms', $lang, $db);
$content_forms = selectForms($db);

// insertion du model pour traitement CRUD formulaires
require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'controller' . DIRECTORY_SEPARATOR . 'CRUD_forms.php';

?>

<title><?= $page['title_pages'] ?></title>

<div>
    <h1><?= $page['title_pages'] ?></h1>
    <div>
        <!--tableau qui regroupe tout les formulaires et le crud-->
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
            <!--boucle données formulaire + CRUD-->
            <?php while ($item = mysqli_fetch_assoc($content_forms)) { ?>
                <tr>
                    <td><?= dateTime($item['date_forms']) ?></td>
                    <td><?= more($item['title_forms']) ?></td>
                    <td><?= more($item['text_forms']) ?></td>
                    <td><?= more($item['name_users']) ?></td>
                    <td><?= more($item['username_users']) ?></td>
                    <td><?= more($item['mail_users']) ?></td>

                    <td>
                        <!--boutons CRUD-->
                        <div>
                            <form method="post">

                                <a href="mailto :<?= $item['mail_users'] ?>subject=PORFOLIO%20WEB%202020"
                                   target="_blank">
                                    <button>
                                            <img style="width: 10%" src="view/img/answer.svg">
                                    </button>
                                </a>

                                <!--Si admin n'a pas encore lu le formulaire-->
                                <?php if ($item['active_forms'] === '0') { ?>
                                    <button type="submit" name="read" value="<?= $item['id_forms'] ?>"><img
                                                style="width: 10%" src="view/img/notread.svg"></button>
                                <?php } else { ?>
                                    <button type="submit" name="read" value="<?= $item['id_forms'] ?>"><img
                                                style="width: 10%" src="view/img/read.svg"></button>
                                <?php } ?>

                                <button type="submit" name="delete" value="<?= $item['id_forms'] ?>"><img
                                            style="width: 10%"
                                            src="view/img/delete.svg">
                                </button>
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
    <!--affichage read formulaires-->
    <?php if (isset ($_POST['read'])) { ?>
        <form method="post">

            <h3> <?= $read['title_forms'] ?> </h3>
            <p> <?= $read['text_forms'] ?> </p>

            <div>
                <a href="mailto :<?= $read['mail_users'] ?>subject=PORFOLIO%20WEB%202020"
                   target="_blank"><?= $content[6] ?></a>

                <button type="submit" name="delete" value="<?= $read['id_forms'] ?>"><?= $content[8] ?></button>

                <button type="submit" name="back"><img style="width: 10%" src="view/img/back.svg"></button>
            </div>
        </form>
    <?php } ?>
</div>

<div>
    <!--affichage confirmation delete formulaires-->
    <?php if (isset($_POST['delete'])) { ?>
        <?php $user = afficheInfo($_POST['delete'], $db); ?>

        <form method="post">

            <h3><?= $content[9] ?></h3>
            <p><?= $content[10] . ' ' . $user['name_users'] . ' ' . $user['username_users'] ?></p>

            <div>
                <button type="submit" name="oui" value="<?= $_POST['delete'] ?>"><?= $content[11] ?></button>

                <button type="submit" name="non"><?= $content[12] ?></button>
            </div>
        </form>
    <?php } ?>
</div>