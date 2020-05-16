<?php
// récupération du contenus à partir de la base de donnnée.
$page = affichePage('admin_forms', $lang, $db);
$content = afficheContentTab('admin_forms', $lang, $db);
$content_forms = selectForms($db);

// insertion du model pour traitement CRUD formulaires
require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'controller' . DIRECTORY_SEPARATOR . 'CRUD_forms.php';

?>

<title><?= $page['title_pages'] ?></title>


<div class="page forms">
    <h1><?= $page['title_pages'] ?></h1>

    <div class="content">
        <!--tableau qui regroupe tout les formulaires et le crud-->
        <div class="entete-forms">
            <p><?= $content[0] ?></p>
            <p class="none"><?= $content[1] ?></p>
            <p class="none"><?= $content[2] ?></p>
            <p class="none"><?= $content[3] ?></p>
            <p class="none"><?= $content[4] ?></p>
            <p><?= $content[5] ?></p>
        </div>

        <!--boucle données formulaire + CRUD-->
        <?php while ($item = mysqli_fetch_assoc($content_forms)) { ?>
            <div class="boucle-forms">
                <div class="info">
                    <p><?= dateTime($item['date_forms']) ?></p>
                    <p class="none"><?= more($item['title_forms']) ?></p>
                    <p class="none"><?= more($item['text_forms']) ?></p>
                    <p class="none"><?= more($item['name_users']) ?></p>
                    <p class="none"><?= more($item['username_users']) ?></p>
                    <p><?= $item['mail_users'] ?></p>
                </div>
                <!--boutons CRUD-->
                <div class="forms-separate"></div>

                <form method="post" class="button-crud">

                    <a href="mailto :<?= $item['mail_users'] ?>subject=PORFOLIO%20WEB%202020"
                       target="_blank">
                        <img src="view/img/answer.png">
                    </a>

                    <!--Si admin n'a pas encore lu le formulaire-->
                    <?php if ($item['active_forms'] === '0') { ?>
                        <button type="submit" name="read" value="<?= $item['id_forms'] ?>"><img
                                    src="view/img/notread.png"></button>
                    <?php } else { ?>
                        <button type="submit" name="read" value="<?= $item['id_forms'] ?>"><img
                                    src="view/img/read.png"></button>
                    <?php } ?>

                    <button type="submit" name="delete" value="<?= $item['id_forms'] ?>"><img
                                src="view/img/delete.png">
                    </button>
                </form>

            </div>
        <?php } ?>
    </div>
</div>


<!--affichage read formulaires-->
<?php if (isset ($_POST['read'])) { ?>
    <div class="trame">
        <form method="post" class="popup">

            <h3> <?= $read['title_forms'] ?> </h3>
            <p> <?= $read['text_forms'] ?> </p>

            <div class="popup-button forms-read">
                <a class="valid-text" href="mailto :<?= $read['mail_users'] ?>subject=PORFOLIO%20WEB%202020"
                   target="_blank"><?= $content[6] ?></a>

                <div>
                    <button class="invalid-text" type="submit" name="delete" value="<?= $read['id_forms'] ?>"><?= $content[8] ?></button>
                    <button class="back" type="submit" name="back"><img src="view/img/back.png"></button>
                </div>
            </div>
        </form>
    </div>
<?php } ?>

<!--affichage confirmation delete formulaires-->
<?php if (isset($_POST['delete'])) { ?>
    <div class="trame">
        <?php $user = afficheInfo($_POST['delete'], $db); ?>

        <form method="post" class="popup">

            <h3><?= $content[9] ?></h3>
            <p><?= $content[10] . ' : ' . $user['mail_users'] ?></p>

            <div class="popup-button">

                <button class="invalid-text" type="submit" name="oui" value="<?= $_POST['delete'] ?>"><?= $content[11] ?></button>
                <button class="valid-text"" type="submit" name="non"><?= $content[12] ?></button>
            </div>
        </form>
    </div>
<?php } ?>
