<?php
// récupération du contenus à partir de la base de donnnée.
$page = affichePage('admin_gallery', $lang, $db);
$content = afficheContentTab('admin_gallery', $lang, $db);
$option = selectOption($lang, $db);
$category = selectOption($lang, $db);

// insertion du model pour traitement CRUD galerie
require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'controller' . DIRECTORY_SEPARATOR . 'CRUD_gallery.php';

?>
<style>
    body {
        background: linear-gradient(45deg, rgba(45, 169, 202, 1) -15%, rgba(134, 211, 103, 1) 95%) fixed;
    }
</style>
<title><?= $page['title_pages'] ?></title>


<div class="container text-center mt-5">
    <h1 class="display-4 my-3"><?= $page['title_pages'] ?></h1>
</div>

<!--option et insert img galerie-->
<div class="container col-md-8">
    <div class="modal-content text-center mt-5 p-5">
        <form method="post" enctype="multipart/form-data" class="content gallery">

            <h3><?= $content[0] ?></h3>

            <div class="d-flex justify-content-around flex-wrap">
                <select class="custom-select m-4 col-md-4" name="gallery" required>
                    <option value="">--<?= $content[1] ?>--</option>
                    <?php while ($item = mysqli_fetch_assoc($option)) { ?>
                        <option value="<?= $item['link_contents'] ?>"><?= $item['title_contents'] ?></option>
                    <?php } ?>
                </select>

                <div class="custom-file m-4 col-md-4">
                    <input type="file" class="custom-file-input" id="customFile" name="name_pics" accept="image/*"
                           required>
                    <label class="custom-file-label" for="customFile">...</label>
                </div>

                <button class="btn m-4 btn-outline-info" name="import"
                        type="submit"><?= $content[2] ?></button>
            </div>
        </form>
    </div>
</div>

<!--affichage confirmation delete image-->
<?php if (isset($_POST['delete'])) { ?>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data" class="popup">

                <?php $id = $_POST['delete'];
                $info = select('pics', 'id_pics', $id, $db) ?>

                <div class="modal-header">
                    <h3><?= $content[3] ?></h3>
                </div>
                <div class="modal-body">
                    <p><?= $content[4] . ' ' . $info['name_pics'] ?></p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-danger btn-lg" type="submit" name="oui"
                            value="<?= $_POST['delete'] ?>"><?= $content[5] ?></button>

                    <button class="btn btn-outline-info btn-lg" type="submit" name="non"><?= $content[6] ?></button>
                </div>
            </form>
        </div>
    </div>
<?php } ?>

<!--boucle affichage categorie-->
<?php while ($item = mysqli_fetch_assoc($category)) { ?>
    <div class="container col-md-8">
        <div class="modal-content text-center mt-5 p-5">
            <h1 class="mb-5"><?= $item['title_contents'] ?></h1>

            <!--boucle affichage categorie galerie-->
            <?php $img = selectGallery($item['title_contents'], $lang, $db) ?>
            <div class="table-responsive">
                <div class="d-flex flex-row">
                    <!--boucle affichage img galerie-->
                    <?php while ($value = mysqli_fetch_assoc($img)) { ?>
                        <div class="gallery-crud">
                            <img style="height: 400px" class="m-3" src="view/img/<?= $value['name_pics'] ?>">

                            <form method="post" enctype="multipart/form-data" class="gallery-crud-button">
                                <div class="btn-group my-4">
                                    <?php if ($value['active_pics'] === '1') { ?>
                                        <button class="btn btn-outline-light btn-lg" type="submit" name="visible"
                                                value="<?= $value['id_pics'] ?>"><img style="width: 30px;"
                                                                                      src="view/img/validate.png">
                                        </button>
                                    <?php } else { ?>
                                        <button class="btn btn-outline-light btn-lg" type="submit" name="invisible"
                                                value="<?= $value['id_pics'] ?>"><img style="width: 30px;"
                                                                                      src="view/img/invalidate.png">
                                        </button>
                                    <?php } ?>

                                    <button class="btn btn-outline-light btn-lg" type="submit" name="delete"
                                            value="<?= $value['id_pics'] ?>"><img style="width: 30px;"
                                                                                  src="view/img/delete.png"></button>
                                </div>
                            </form>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<div class="p-5"></div>